<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["KargoFirmaAdi"])){
        $GelenKargoFirmaAdi = Guvenlik($_POST["KargoFirmaAdi"]);
    }else {
        $GelenKargoFirmaAdi = "";
    }

    $GelenKargoLogo = $_FILES["KargoFirmaLogo"];

    $LogoFilename = $GelenKargoLogo["name"];
    $LogoFiletype = $GelenKargoLogo["type"];
    $LogoFiletmp_name = $GelenKargoLogo["tmp_name"];
    $LogoFileerror = $GelenKargoLogo["error"];
    $LogoFilesize = $GelenKargoLogo["size"];

    $GelenResimUzanti = substr($LogoFilename, -4);
    if($GelenResimUzanti=="jpeg"){
        $GelenResimUzanti = "." . $GelenResimUzanti;
    }

    $LogoAdi = ResimAdıOlustur();
    $uzantiAdi = $GelenResimUzanti;

    $logoTamAd = $LogoAdi . $GelenResimUzanti;

    if(($LogoFilename !="") and ($LogoFiletype !="") and ($LogoFiletmp_name !="") and ($LogoFileerror == 0) and ($LogoFilesize>0) and ($GelenKargoFirmaAdi !="")){

        $KargoHesapEkleSorgu = $db->prepare("INSERT INTO kargofirmalari(KargoFirmaAdi,KargoFirmaLogo) values(?,?)");
        $KargoHesapEkleSorgu->execute([$GelenKargoFirmaAdi,$logoTamAd]);
        $hesapEkle_KS = $KargoHesapEkleSorgu->rowCount();
        
        if($hesapEkle_KS>0){
            $KargoLogoYukle = new \Verot\Upload\Upload($GelenKargoLogo, "tr-TR");
     if ($KargoLogoYukle->uploaded) {
        $KargoLogoYukle->file_new_name_body = $LogoAdi; // resim dosyası ismi
        $KargoLogoYukle->image_resize = true; // boyutlandırma true
        // $KargoLogoYukle->image_x = 36; // genişlik
        $KargoLogoYukle->image_y = 30; // yükseklik 
        $KargoLogoYukle->mime_check = true;
        $KargoLogoYukle->allowed = array('image/*');
        $KargoLogoYukle->file_overwrite = true; // üstüne yaz
        $KargoLogoYukle->image_background_color = "#FFFFFF"; // arka plan rengi 
        $KargoLogoYukle->image_convert = 'png';
        $KargoLogoYukle->png_compression = 1;
        $KargoLogoYukle->process($ResimKlasorYol);
        if ($KargoLogoYukle->processed) {
            $KargoLogoYukle->clean(); // yükleme tamam
            header("location:index.php?SKD=0&SKI=24"); // başarılı 
            exit();
          } else {
            header("location:index.php?SKD=0&SKI=25"); // hata 
            exit(); 
          }
        }
        }else {
            header("location:index.php?SKD=0&SKI=25"); // hata 
            exit(); 
        }

    }else {
        header("location:index.php?SKD=0&SKI=25"); // hata 
        exit();
    }

}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>