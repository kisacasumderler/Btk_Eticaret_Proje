<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_POST["KargoFirmaAdi"])){
        $GelenKargoFirmaAdi = Guvenlik($_POST["KargoFirmaAdi"]);
    }else {
        $GelenKargoFirmaAdi = "";
    }
    if(isset($_POST["KargoID"])){
        $GelenKargoID = Guvenlik($_POST["KargoID"]);
    }else {
        $GelenKargoID = "";
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

    if(($GelenKargoFirmaAdi !="") and ($GelenKargoID!="")){

        $HesapGuncelleSorgu = $db->prepare("UPDATE kargofirmalari SET KargoFirmaAdi=? WHERE id=?");
        $HesapGuncelleSorgu->execute([$GelenKargoFirmaAdi,$GelenKargoID]);
        $hesapGuncelle_KS = $HesapGuncelleSorgu->rowCount();
        
        // if($hesapGuncelle_KS>0){
        //     // (sadece bilgiler güncellendi)
        //     header("location:index.php?SKD=0&SKI=28"); // başarılı 
        //     exit();
        // }

        if(($LogoFilename !="") and ($LogoFiletype !="") and ($LogoFiletmp_name !="") and ($LogoFileerror == 0) and ($LogoFilesize>0)){
            $HesapResimSilSorgu = $db->prepare("SELECT * FROM kargofirmalari WHERE id=?");
            $HesapResimSilSorgu->execute([$GelenKargoID]);
            $HesapSil_KS = $HesapResimSilSorgu->rowCount();
            $KargoHesapKayit = $HesapResimSilSorgu->fetch(PDO::FETCH_ASSOC);

            $SilinecekDosyaYolu = "../resimler/" . $KargoHesapKayit["KargoFirmaLogo"];

            if($HesapSil_KS>0){
                unlink($SilinecekDosyaYolu);
            }
            
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
                    $HesapResimGuncelleSorgu = $db->prepare("UPDATE kargofirmalari SET KargoFirmaLogo=? WHERE id=?");
                    $HesapResimGuncelleSorgu->execute([$logoTamAd,$GelenKargoID]);
                    $hesapResimGuncelle_KS = $HesapResimGuncelleSorgu->rowCount();
                    if(($hesapResimGuncelle_KS>0) or ($hesapGuncelle_KS>0)){
                        header("location:index.php?SKD=0&SKI=28"); // resim güncellendi 
                        exit(); 
                    }else {
                        header("location:index.php?SKD=0&SKI=29"); // hata 
                        exit();  
                    }
                } else {
                    header("location:index.php?SKD=0&SKI=29"); // hata 
                    exit(); 
                }
                }
        }else {
            header("location:index.php?SKD=0&SKI=29"); // hata 
            exit();
        }

    }else {
        header("location:index.php?SKD=0&SKI=29"); // hata 
        exit();
    }

}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>