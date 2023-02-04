<?php 
if(isset($_SESSION["Kullanici"])){
    

        if(isset($_POST["IsimSoyisim"])){
            $GelenIsimSoyisim = Guvenlik($_POST["IsimSoyisim"]);
        }else {
            $GelenIsimSoyisim = "";
        }

        if(isset($_POST["eskiSifre"])){
            $GeleneskiSifre = Guvenlik($_POST["eskiSifre"]);
        
        }else {
            $GeleneskiSifre = "";
        }
        if(isset($_POST["yeniSifre"])){
            $GelenyeniSifre = Guvenlik($_POST["yeniSifre"]);
        
        }else {
            $GelenyeniSifre = "";
        }
        if(isset($_POST["yeniSifreT"])){
            $GelenyeniSifreT = Guvenlik($_POST["yeniSifreT"]);
        
        }else {
            $GelenyeniSifreT = "";
        }
        if(isset($_POST["emailAdresi"])){
        $GelenemailAdresi = Guvenlik($_POST["emailAdresi"]);

        }else {
            $GelenemailAdresi = "";
        }

        if(isset($_POST["TelefonNumarasi"])){
        $GelenTelefonNumarasi = SayiliIcerikFiltrele(Guvenlik($_POST["TelefonNumarasi"]));
        }else {
            $GelenTelefonNumarasi = "";
        }

        if(isset($_POST["cinsiyet"])){
            $Gelencinsiyet = Guvenlik($_POST["cinsiyet"]);
        }else {
            $Gelencinsiyet = "";
        }

        $MD5liEskiSifre = md5($GeleneskiSifre);
        $MD5liSifre =  md5($GelenyeniSifre);

if(($GelenIsimSoyisim!="")and ($GeleneskiSifre!="") and ($GelenyeniSifre!="") and ($GelenyeniSifreT!="") and ($GelenemailAdresi!="") and ($GelenTelefonNumarasi!="") and ($Gelencinsiyet!="")){

    if($GelenyeniSifre!==$GelenyeniSifreT){
        header("location:index.php?SK=54"); // şifreler eşleşmiyor 
        exit();
    }else {

        if($GeleneskiSifre=="eskiSifre"){
                $SifreDegistirmeD = 0;
        }else {
                $SifreDegistirmeD = 1;
        }

        if($GelenemailAdresi!=$emailAdres){
            $KayitSorgu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres = ?");
            $KayitSorgu->execute([$GelenemailAdresi]);
            $K_KayitSayisi = $KayitSorgu->rowCount();
                if ($K_KayitSayisi > 0) {
                header("location:index.php?SK=56");  // kullanılan email başka hesapta mevcut 
                exit();
            }
        }

            if ($SifreDegistirmeD == 1) {
                if($MD5liEskiSifre==$sifre){
                    $UyeGuncelle = $db->prepare("UPDATE uyeler SET  sifre =?, emailAdres =?, isimSoyisim =?, telefonNumarasi =?, cinsiyet=? WHERE id=? LIMIT 1");
                    $UyeGuncelle->execute([$MD5liSifre,$GelenemailAdresi,$GelenIsimSoyisim,$GelenTelefonNumarasi,$Gelencinsiyet,$id]);
                    $KayitKontrolSayisi = $UyeGuncelle->rowCount();
                }else {
                    header("location:index.php?SK=57"); // hesabak kayıtlı şifre ile girilen şifre eşleşmiyor
                    exit();
                }

            }else {
                $UyeGuncelle = $db->prepare("UPDATE uyeler SET emailAdres =?, isimSoyisim =?, telefonNumarasi =?, cinsiyet=? WHERE id=? LIMIT 1");
                $UyeGuncelle->execute([$GelenemailAdresi,$GelenIsimSoyisim,$GelenTelefonNumarasi,$Gelencinsiyet,$id]);
                $KayitKontrolSayisi = $UyeGuncelle->rowCount();
            }

        if ($KayitKontrolSayisi > 0) {
            $_SESSION["Kullanici"] = $GelenemailAdresi;
            header("location:index.php?SK=52"); // güncelleme başarılı 
            exit();
        }else {
            header("location:index.php?SK=53"); // güncelleme başarısız: hata 
            exit();
        }

    }
        }else {
            header("location:index.php?SK=55"); // eksik alan 
            exit();
        }
}else {
    header("location:index.php");
    exit();
}

?>