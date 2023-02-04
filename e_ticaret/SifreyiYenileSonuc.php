<?php

require_once("./Ayarlar/Ayar.php");
require_once("./Ayarlar/fonksiyonlar.php");

if(isset($_GET["EmailAdresi"])){
    $GelenEmailAdresi = Guvenlik($_GET["EmailAdresi"]);
   
   }else {
       $GelenEmailAdresi = "";
}
 if(isset($_GET["AktivasyonKodu"])){
 $GelenAktivasyonKodu = Guvenlik($_GET["AktivasyonKodu"]);

}else {
    $GelenAktivasyonKodu = "";
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


$MD5liSifre =  md5($GelenyeniSifre);

if (($GelenyeniSifre != "") and ($GelenyeniSifreT != "")  and ($GelenEmailAdresi != "")  and ($GelenAktivasyonKodu != "")) {
    if ($GelenyeniSifre != $GelenyeniSifreT) {
        header("location:index.php?SK=47");
        exit();
    } else {

        $DurumGuncellemeSorgu = $db->prepare("UPDATE uyeler SET sifre = ? WHERE emailAdres =? AND AktivasyonKodu =? LIMIT 1");
        $DurumGuncellemeSorgu->execute([$MD5liSifre,$GelenEmailAdresi,$GelenAktivasyonKodu]);
        $IslemKontrol = $DurumGuncellemeSorgu->rowCount();

        if ($IslemKontrol > 0) {
            header("location:index.php?SK=45");
            exit();

        }else {
            header("location:index.php?SK=46");
            exit();
        }
    }
}else{
    header("location:index.php?SK=48");
    exit();
}
?>