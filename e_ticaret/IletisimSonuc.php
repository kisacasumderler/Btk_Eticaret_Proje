<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Frameworks/PHPMailer/src/Exception.php';
require './Frameworks/PHPMailer/src/PHPMailer.php';
require './Frameworks/PHPMailer/src/SMTP.php';

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

 if(isset( $_POST["mesaj"])){
 $GelenMesaj =Guvenlik($_POST["mesaj"]);
}else {
    $GelenMesaj = "";
 }
 if(($GelenIsimSoyisim!="") and ($GelenemailAdresi!="") and ($GelenTelefonNumarasi!="") and ($GelenMesaj!="")) {
    $MailIcerigiHazirla = "<b>İsim Soyisim: </b>".$GelenIsimSoyisim . "<br> <b>Mail Adresi: </b>" . $GelenemailAdresi . "<br> <b>Telefon Numarası: </b>" . $GelenTelefonNumarasi . "<br><b> Mesaj: </b> " . $GelenMesaj . "<br>";
$mailGonder = new PHPMailer(true);

try {
    //Server settings
    $mailGonder->SMTPDebug = 0;
    $mailGonder->isSMTP();
    $mailGonder->Host       = DonusumleriGeriDondur($SiteEmailHostAdresi);
    $mailGonder->SMTPAuth   = true;
    $mailGonder->charset    = 'UTF-8';
    $mailGonder->Username   = DonusumleriGeriDondur($SiteEmailAdresi);
    $mailGonder->Password   = DonusumleriGeriDondur($SiteEmailSifresi);
    $mailGonder->SMTPSecure = 'tls';
    $mailGonder->Port       = 587;
        $mailGonder->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

    $mailGonder->setFrom(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));
    $mailGonder->addAddress(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));
    $mailGonder->addAddress($GelenemailAdresi,$GelenIsimSoyisim);
    $mailGonder->isHTML(true); 
    $mailGonder->Subject = DonusumleriGeriDondur($SiteAdi).'İletişim Formu Mesajı';
    $mailGonder->MsgHtml($MailIcerigiHazirla);

    $mailGonder->send();
    // echo 'Message has been sent';
    header("location:index.php?SK=18");
    exit();
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
    header("location:index.php?SK=19");
    exit();
}
   
 }else {
   header("location:index.php?SK=20");
   exit();
 }
?>