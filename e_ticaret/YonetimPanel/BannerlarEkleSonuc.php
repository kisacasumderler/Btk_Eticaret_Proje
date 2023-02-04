<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["bannerAdi"])){
        $GelenbannerAdi = Guvenlik($_POST["bannerAdi"]);
    }else {
        $GelenbannerAdi = "";
    }
    if(isset($_POST["bannerAlani"])){
        $GelenbannerAlani = Guvenlik($_POST["bannerAlani"]);
    }else {
        $GelenbannerAlani = "";
    }

    // Ana Sayfa 1065x400
    // Menu Altı 250x500
    // Anasayfa Kategoriler 350x350

    $GelenBannerResmi = $_FILES["BannerResmi"];

    $LogoFilename = $GelenBannerResmi["name"];
    $LogoFiletype = $GelenBannerResmi["type"];
    $LogoFiletmp_name = $GelenBannerResmi["tmp_name"];
    $LogoFileerror = $GelenBannerResmi["error"];
    $LogoFilesize = $GelenBannerResmi["size"];

    $GelenResimUzanti = substr($LogoFilename, -4);
    if($GelenResimUzanti=="jpeg"){
        $GelenResimUzanti = "." . $GelenResimUzanti;
    }

    $LogoAdi = ResimAdıOlustur();
    $uzantiAdi = $GelenResimUzanti;

    $logoTamAd = $LogoAdi . $GelenResimUzanti;

    if(($LogoFilename !="") and ($LogoFiletype !="") and ($LogoFiletmp_name !="") and ($LogoFileerror == 0) and ($LogoFilesize>0) and ($GelenbannerAdi !="") and ($GelenbannerAlani !="")){

        $BannerEkleSorgu = $db->prepare("INSERT INTO bannerlar(bannerAdi,BannerResmi,bannerAlani) values(?,?,?)");
        $BannerEkleSorgu->execute([$GelenbannerAdi,$logoTamAd,$GelenbannerAlani]);
        $BannerEkle_KS = $BannerEkleSorgu->rowCount();
        
        if($BannerEkle_KS>0){
            if($GelenbannerAlani=="Ana Sayfa"){
                $ResimGenislik = 1065;
                $ResimYukseklik = 400;
            }elseif($GelenbannerAlani=="Menu Altı"){
                $ResimGenislik = 250;
                $ResimYukseklik = 500;
            }elseif($GelenbannerAlani=="Anasayfa Kategoriler"){
                $ResimGenislik = 500;
                $ResimYukseklik = 500;
            }elseif($GelenbannerAlani=="Anasayfa Kategoriler Mobil"){
                $ResimGenislik = 500;
                $ResimYukseklik = 200;
            }elseif($GelenbannerAlani=="Anasayfa Mobil") {
                $ResimGenislik = 500;
                $ResimYukseklik = 500;
            }elseif($GelenbannerAlani=="IndexUst"){
                $ResimGenislik = 1064;
                $ResimYukseklik = 60;
            }else {
                $ResimGenislik = 350;
                $ResimYukseklik = 350;
            }
            if($GelenbannerAlani=="IndexUst"){
                $ArkaPlanRengi = "";
            }else {
                $ArkaPlanRengi = "#FFFFFF";
            }

            $BannerResimYukle = new \Verot\Upload\Upload($GelenBannerResmi, "tr-TR");
     if ($BannerResimYukle->uploaded) {
        $BannerResimYukle->file_new_name_body = $LogoAdi; // resim dosyası ismi
        $BannerResimYukle->image_resize = true; // boyutlandırma true
        $BannerResimYukle->image_x = $ResimGenislik; // genişlik 
        $BannerResimYukle->image_y = $ResimYukseklik; // yükseklik 
        $BannerResimYukle->mime_check = true;
        $BannerResimYukle->allowed = array('image/*');
        $BannerResimYukle->file_overwrite = true; // üstüne yaz
        $BannerResimYukle->image_background_color = $ArkaPlanRengi; // arka plan rengi 
        // $BannerResimYukle->image_convert = jpg;
        $BannerResimYukle->png_compression = 1;
        $BannerResimYukle->process($ResimKlasorYolBanner);
        if ($BannerResimYukle->processed) {
            $BannerResimYukle->clean(); // yükleme tamam
            header("location:index.php?SKD=0&SKI=36"); // başarılı 
            exit();
          } else {
            header("location:index.php?SKD=0&SKI=37"); // hata 
            exit(); 
          }
        }
        }else {
            header("location:index.php?SKD=0&SKI=37"); // hata 
            exit(); 
        }

    }else {
        header("location:index.php?SKD=0&SKI=37"); // hata 
        exit();
    }

}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>