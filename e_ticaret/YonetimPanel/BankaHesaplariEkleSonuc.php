<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["bankaAdi"])){
        $GelenbankaAdi = Guvenlik($_POST["bankaAdi"]);
    }else {
        $GelenbankaAdi = "";
    }
    if(isset($_POST["KonumSehir"])){
        $GelenKonumSehir = Guvenlik($_POST["KonumSehir"]);
    }else {
        $GelenKonumSehir = "";
    }
    if(isset($_POST["KonumUlke"])){
        $GelenKonumUlke = Guvenlik($_POST["KonumUlke"]);
    }else {
        $GelenKonumUlke = "";
    }
    if(isset($_POST["SubeAdi"])){
        $GelenSubeAdi = Guvenlik($_POST["SubeAdi"]);
    }else {
        $GelenSubeAdi = "";
    }
    if(isset($_POST["SubeKodu"])){
        $GelenSubeKodu = Guvenlik($_POST["SubeKodu"]);
    }else {
        $GelenSubeKodu = "";
    }
    if(isset($_POST["ParaBirimi"])){
        $GelenParaBirimi = Guvenlik($_POST["ParaBirimi"]);
    }else {
        $GelenParaBirimi = "";
    }
    if(isset($_POST["HesapSahibi"])){
        $GelenHesapSahibi = Guvenlik($_POST["HesapSahibi"]);
    }else {
        $GelenHesapSahibi = "";
    }
    if(isset($_POST["HesapNumarasi"])){
        $GelenHesapNumarasi = Guvenlik($_POST["HesapNumarasi"]);
    }else {
        $GelenHesapNumarasi = "";
    }
    if(isset($_POST["IbanNumarasi"])){
        $GelenIbanNumarasi = Guvenlik($_POST["IbanNumarasi"]);
    }else {
        $GelenIbanNumarasi = "";
    }

    $GelenBankLogo = $_FILES["BankLogo"];

    $LogoFilename = $GelenBankLogo["name"];
    $LogoFiletype = $GelenBankLogo["type"];
    $LogoFiletmp_name = $GelenBankLogo["tmp_name"];
    $LogoFileerror = $GelenBankLogo["error"];
    $LogoFilesize = $GelenBankLogo["size"];

    $GelenResimUzanti = substr($LogoFilename, -4);
    if($GelenResimUzanti=="jpeg"){
        $GelenResimUzanti = "." . $GelenResimUzanti;
    }

    $LogoAdi = ResimAdıOlustur();
    $uzantiAdi = $GelenResimUzanti;

    $logoTamAd = $LogoAdi . $GelenResimUzanti;

    if((($LogoFilename !="") and ($LogoFiletype !="") and ($LogoFiletmp_name !="") and ($LogoFileerror == 0) and ($LogoFilesize>0) and $GelenbankaAdi !="") and ($GelenKonumSehir !="") and ($GelenKonumUlke !="") and ($GelenSubeAdi !="") and ($GelenSubeKodu !="") and ($GelenParaBirimi !="") and ($GelenHesapSahibi !="") and ($GelenHesapNumarasi !="") and ($GelenIbanNumarasi !="")){

        $BankaHesapEkleSorgu = $db->prepare("INSERT INTO bankahesaplarimiz(bankaAdi,KonumSehir,KonumUlke,SubeAdi,SubeKodu,ParaBirimi,HesapSahibi,HesapNumarasi,IbanNumarasi,BankLogo) values(?,?,?,?,?,?,?,?,?,?)");
        $BankaHesapEkleSorgu->execute([$GelenbankaAdi,$GelenKonumSehir,$GelenKonumUlke,$GelenSubeAdi,$GelenSubeKodu,$GelenParaBirimi,$GelenHesapSahibi,$GelenHesapNumarasi,$GelenIbanNumarasi,$logoTamAd]);
        $hesapEkle_KS = $BankaHesapEkleSorgu->rowCount();
        
        if($hesapEkle_KS>0){
            $BankaLogoYukle = new \Verot\Upload\Upload($GelenBankLogo, "tr-TR");
     if ($BankaLogoYukle->uploaded) {
        $BankaLogoYukle->file_new_name_body = $LogoAdi; // resim dosyası ismi
        $BankaLogoYukle->image_resize = true; // boyutlandırma true
        // $BankaLogoYukle->image_x = 36; // genişlik
        $BankaLogoYukle->image_y = 30; // yükseklik 
        $BankaLogoYukle->mime_check = true;
        $BankaLogoYukle->allowed = array('image/*');
        $BankaLogoYukle->file_overwrite = true; // üstüne yaz
        $BankaLogoYukle->image_background_color = "#FFFFFF"; // arka plan rengi 
        $BankaLogoYukle->image_convert = 'png';
        $BankaLogoYukle->png_compression = 1;
        $BankaLogoYukle->process($ResimKlasorYol);
        if ($BankaLogoYukle->processed) {
            $BankaLogoYukle->clean(); // yükleme tamam
            header("location:index.php?SKD=0&SKI=12"); // başarılı 
            exit();
          } else {
            header("location:index.php?SKD=0&SKI=13"); // hata 
            exit(); 
          }
        }
        }else {
            header("location:index.php?SKD=0&SKI=13"); // hata 
            exit(); 
        }

    }else {
        header("location:index.php?SKD=0&SKI=13"); // hata 
        exit();
    }

}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>