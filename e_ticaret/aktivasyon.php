<?php
require_once("./Ayarlar/Ayar.php");
require_once("./Ayarlar/fonksiyonlar.php");


if(isset($_GET["AktivasyonKodu"])){
    $GelenAktivasyonKodu = Guvenlik($_GET["AktivasyonKodu"]);
   
   }else {
       $GelenAktivasyonKodu = "";
}
 if(isset($_GET["Email"])){
 $GelenemailAdresi = Guvenlik($_GET["Email"]);

}else {
    $GelenemailAdresi = "";
 }


if(($GelenAktivasyonKodu!="") and ($GelenemailAdresi!="")){
    $K_Sorgusu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres = ? AND AktivasyonKodu = ? AND durumu = ?");
    $K_Sorgusu->execute([$GelenemailAdresi,$GelenAktivasyonKodu,0]);
    $Kontrol_KS = $K_Sorgusu->rowCount();
    if ($Kontrol_KS > 0) {
        $DurumGuncellemeSorgu = $db->prepare("UPDATE uyeler SET durumu = ?");
        $DurumGuncellemeSorgu->execute([1]);
        $IslemKontrol = $DurumGuncellemeSorgu->rowCount();
        if($IslemKontrol>0){
            header("location:index.php?SK=30");
            exit();
        }else {
            header("location:index.php?SK=0");
            exit();
        }
    }else {
        header("location:index.php?SK=0");
        exit();
    }
}else {
    header("location:index.php?SK=0");
    exit();
}

// http://localhost/e_ticaret/aktivasyon.php?AktivasyonKodu=9999-10000-9999&Email=sutkuu29@gmail.com

?>

