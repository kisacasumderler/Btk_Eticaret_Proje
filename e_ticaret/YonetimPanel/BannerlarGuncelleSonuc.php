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
    if(isset($_POST["BannerID"])){
        $GelenBannerID = Guvenlik($_POST["BannerID"]);
    }else {
        $GelenBannerID = "";
    }

//     BannerID
// bannerAdi
// BannerResmi
// bannerAlani

    $GelenBannerResmi = $_FILES["BannerResmi"];

    $FotoFilename = $GelenBannerResmi["name"];
    $FotoFiletype = $GelenBannerResmi["type"];
    $FotoFiletmp_name = $GelenBannerResmi["tmp_name"];
    $FotoFileerror = $GelenBannerResmi["error"];
    $FotoFilesize = $GelenBannerResmi["size"];

    $GelenResimUzanti = substr($FotoFilename, -4);
    if($GelenResimUzanti=="jpeg"){
        $GelenResimUzanti = "." . $GelenResimUzanti;
    }

    $FotoAdi = ResimAdıOlustur();
    $uzantiAdi = $GelenResimUzanti;

    $FotoTamAd = $FotoAdi . $GelenResimUzanti;

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

    if(($GelenbannerAdi !="") and ($GelenBannerID!="") and ($GelenbannerAlani!="")){
        $BannerSorgu = $db->prepare("SELECT * FROM bannerlar WHERE id=?");
        $BannerSorgu->execute([$GelenBannerID]);
        $BannerResim_KS = $BannerSorgu->rowCount();
        $BannerResimKayit = $BannerSorgu->fetch(PDO::FETCH_ASSOC);

        if($GelenbannerAlani==$BannerResimKayit["bannerAlani"]){
        $BannerGuncelleSorgu = $db->prepare("UPDATE bannerlar SET bannerAdi=?,bannerAlani=? WHERE id=?");
        $BannerGuncelleSorgu->execute([$GelenbannerAdi,$GelenbannerAlani,$GelenBannerID]);
        $BannerGuncelle_KS = $BannerGuncelleSorgu->rowCount();
        if(($FotoFilename !="") and ($FotoFiletype !="") and ($FotoFiletmp_name !="") and ($FotoFileerror == 0) and ($FotoFilesize>0)){

            $SilinecekDosyaYolu = "../resimler/Bannerlar/" . $BannerResimKayit["BannerResmi"];

            if($BannerResim_KS>0){
                unlink($SilinecekDosyaYolu);
            }
            $BannerResimYukle = new \Verot\Upload\Upload($GelenBannerResmi, "tr-TR");
                if ($BannerResimYukle->uploaded) {
                    $BannerResimYukle->file_new_name_body = $FotoAdi; // resim dosyası ismi
                    $BannerResimYukle->image_resize = true; // boyutlandırma true
                    $BannerResimYukle->image_x = $ResimGenislik; // genişlik 
                    $BannerResimYukle->image_y = $ResimYukseklik; // yükseklik 
                    $BannerResimYukle->mime_check = true;
                    $BannerResimYukle->allowed = array('image/*');
                    $BannerResimYukle->file_overwrite = true; // üstüne yaz
                    $BannerResimYukle->image_background_color = "#FFFFFF"; // arka plan rengi 
                    $BannerResimYukle->image_convert = 'jpg';
                    $BannerResimYukle->png_compression = 1;
                    $BannerResimYukle->process($ResimKlasorYolBanner);
                if ($BannerResimYukle->processed) {
                    $BannerResimYukle->clean(); // yükleme tamam
                    $BannerResimGuncelle = $db->prepare("UPDATE bannerlar SET BannerResmi=? WHERE id=?");
                    $BannerResimGuncelle->execute([$FotoTamAd,$GelenBannerID]);
                    $BannerResimGuncelle_KS = $BannerResimGuncelle->rowCount();
                    if(($BannerResimGuncelle_KS>0) or ($BannerGuncelle_KS>0)){
                        header("location:index.php?SKD=0&SKI=40"); // resim güncellendi 
                        exit(); 
                    }else {
                        header("location:index.php?SKD=0&SKI=41"); // hata 
                        exit();  
                    }
                } else {
                    header("location:index.php?SKD=0&SKI=41"); // hata 
                    exit(); 
                }
                }
        }else {
            header("location:index.php?SKD=0&SKI=41"); // hata 
            exit();
        }

        }else {
            header("location:index.php?SKD=0&SKI=38&ID=".$GelenBannerID.""); // resim boyutları aynı değil geri dön
            exit();
        }


    }else {
        header("location:index.php?SKD=0&SKI=41"); // hata 
        exit();
    }

}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>