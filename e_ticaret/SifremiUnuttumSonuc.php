<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Frameworks/PHPMailer/src/Exception.php';
require './Frameworks/PHPMailer/src/PHPMailer.php';
require './Frameworks/PHPMailer/src/SMTP.php';



 if(isset($_POST["TelefonNumarasi"])){
    $GelenTelefonNumarasi = Guvenlik($_POST["TelefonNumarasi"]);
   
   }else {
       $GelenTelefonNumarasi = "";
}
 if(isset($_POST["emailAdresi"])){
 $GelenemailAdresi = Guvenlik($_POST["emailAdresi"]);

}else {
    $GelenemailAdresi = "";
 }


if (($GelenTelefonNumarasi != "") or ($GelenemailAdresi != "")) {

    $KayitSorgu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres = ? OR telefonNumarasi=? AND silinmeDurumu=?");
    $KayitSorgu->execute([$GelenemailAdresi, $GelenTelefonNumarasi, 0]);
    $K_KayitSayisi = $KayitSorgu->rowCount();
    $kKaydi = $KayitSorgu->fetch(PDO::FETCH_ASSOC);
    if ($K_KayitSayisi > 0) {

            
         $mailIcerigiHazirla = "Merhaba Sayın ".$kKaydi["isimSoyisim"]."\n \n";
         $mailIcerigiHazirla .= "Sitemiz üzerinde bulunan hesabınızın şifresini sıfırlamak için lütfen buraya <a href='".$siteLinki."/index.php?SK=43&AktivasyonKodu=".$kKaydi["AktivasyonKodu"]."&Email=".$kKaydi["emailAdres"]."'> tıklayınız. </a> \n \n";
         $mailIcerigiHazirla .= "Saygılarımızla. İyi çalışmalar. \n";
         $mailIcerigiHazirla .=  $SiteAdi;

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
             $mailGonder->addAddress(DonusumleriGeriDondur($GelenemailAdresi), DonusumleriGeriDondur($GelenIsimSoyisim));
             $mailGonder->addReplyTo(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));
             $mailGonder->isHTML(true); 
             $mailGonder->Subject = DonusumleriGeriDondur($SiteAdi).' Şifre Sıfırlama.';
             $mailGonder->MsgHtml($MailIcerigiHazirla);

             $mailGonder->send();
             // echo 'Message has been sent';
             header("location:index.php?SK=39");
             exit();
         } catch (Exception $e) {
             // echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
             header("location:index.php?SK=40");
             exit();
         }

    }else {
        header("location:index.php?SK=41");
        exit();
    }
}else{
    header("location:index.php?SK=42");
    exit();
}
?>