<?php

 if(isset($_POST["IsimSoyisim"])){
    $GelenIsimSoyisim = Guvenlik($_POST["IsimSoyisim"]);
 }else {
    $GelenIsimSoyisim = "";
 }

 if(isset($_POST["emailAdresi"])){
 $GelenemailAdresi = Guvenlik($_POST["emailAdresi"]);

}else {
    $GelenemailAdresi = "";
 }

 if(isset($_POST["TelefonNumarasi"])){
 $GelenTelefonNumarasi = Guvenlik($_POST["TelefonNumarasi"]);
}else {
    $GelenTelefonNumarasi = "";
 }

 if(isset($_POST["BankaBilgisi"])){
 $GelenBankaBilgisi = Guvenlik($_POST["BankaBilgisi"]);
}else {
    $GelenBankaBilgisi = "";
 }

 if(isset( $_POST["aciklama"])){
 $Gelenaciklama =Guvenlik($_POST["aciklama"]);
}else {
    $Gelenaciklama = "";
 }
 if(($GelenIsimSoyisim!="") and ($GelenemailAdresi!="") and ($GelenTelefonNumarasi!="") and ($GelenBankaBilgisi!="")) {
   $HavaleBF_Kaydet = $db->prepare("INSERT INTO havalebildirimleri(bankaId, adiSoyadi ,emailAdresi ,telefonNumarasi ,aciklama ,islemTarihi ,durum) values(?,?,?,?,?,?,?)");
   $HavaleBF_Kaydet->execute([$GelenBankaBilgisi,$GelenIsimSoyisim,$GelenemailAdresi,$GelenTelefonNumarasi,$Gelenaciklama,$ZamanDamgasi,0]);
   $HavaleB_SorguSayisi = $HavaleBF_Kaydet->rowCount();
   if($HavaleB_SorguSayisi>0) {
      header("location:index.php?SK=11");
      die();
   }else {
      header("location:index.php?SK=12");
   die();
   }
 }else {
   header("location:index.php?SK=13");
   die();
 }
?>
