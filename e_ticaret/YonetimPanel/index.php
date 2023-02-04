<?php
session_start(); ob_start();

require_once("../Ayarlar/Ayar.php");
require_once("../Ayarlar/fonksiyonlar.php");
require_once("../Frameworks/Verot/src/class.upload.php");
require_once("../Ayarlar/YonetimIcSayfalar.php");
require_once("../Ayarlar/YonetimDisSayfalar.php");

if(isset($_REQUEST["SKI"])) {
    $IC_SK_Degeri = SayiliIcerikFiltrele($_REQUEST["SKI"]);
}else {
    $IC_SK_Degeri = 0;
}

if(isset($_REQUEST["SKD"])) {
    $DIS_SK_Degeri = SayiliIcerikFiltrele($_REQUEST["SKD"]);
}else {
    $DIS_SK_Degeri = 0;
}

if(isset($_REQUEST["SYF"])) {
    $Sayfalama = SayiliIcerikFiltrele($_REQUEST["SYF"]);
}else {
    $Sayfalama = 1;
}

?>
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset= utf-8">
    <meta http-equiv="Content-Language" content="tr">
    <meta name="Robots" content="noindex, nofollow noarchive">
    <meta name="googlebot" content="noindex, nofollow noarchive">
    <title><?php echo DonusumleriGeriDondur($SiteTitle); ?></title>
    <link rel="icon" type="image/png" href="../resimler/<?php echo DonusumleriGeriDondur($SiteLogosu); ?>">
    <script type="text/javascript" src="../Frameworks/JQuery/jquery-3.6.2.min.js"></script>
    <link rel="stylesheet" href="../Ayarlar/YonetimPanelStill.css">
    <script type="text/javascript" src="../Ayarlar/fonksiyonlar.js"></script>
</head>
<body>
<?php 
if(empty($_SESSION["Yonetici"])){
    //yönetici girişi yok
    if((!$DIS_SK_Degeri) or ($DIS_SK_Degeri=="") or ($DIS_SK_Degeri==0)){
        include($SayfaDis[1]);
   }else {
        include($SayfaDis[$DIS_SK_Degeri]);
   }
}else {
    if((!$DIS_SK_Degeri) or ($DIS_SK_Degeri=="") or ($DIS_SK_Degeri==0)){
        include($SayfaDis[0]);
   }else {
        include($SayfaDis[$DIS_SK_Degeri]);
   }
}
?>
</body>

</html>

<?php
    $db = null;
ob_end_flush();
?>