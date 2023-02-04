<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Frameworks/PHPMailer/src/Exception.php';
require './Frameworks/PHPMailer/src/PHPMailer.php';
require './Frameworks/PHPMailer/src/SMTP.php';



 if(isset($_POST["Sifre"])){
    $GelenSifre = Guvenlik($_POST["Sifre"]);
   
   }else {
       $GelenSifre = "";
}
 if(isset($_POST["emailAdresi"])){
 $GelenemailAdresi = Guvenlik($_POST["emailAdresi"]);

}else {
    $GelenemailAdresi = "";
 }


$MD5liSifre =  md5($GelenSifre);

if (($GelenSifre != "") and ($GelenemailAdresi != "")) {

    $KayitSorgu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres = ? AND sifre=? AND silinmeDurumu=?");
    $KayitSorgu->execute([$GelenemailAdresi, $MD5liSifre, 0]);
    $K_KayitSayisi = $KayitSorgu->rowCount();
    $kKaydi = $KayitSorgu->fetch(PDO::FETCH_ASSOC);


    if ($K_KayitSayisi > 0) {
        if($kKaydi["durumu"]==1){
            $_SESSION["Kullanici"] = $GelenemailAdresi;
            if($_SESSION["Kullanici"] == $GelenemailAdresi){
                header("location:index.php?SK=50");
                exit();
            }else {
                header("location:index.php?SK=33");
                exit();
            }
        }else {
            
            $mailIcerigiHazirla = "Merhaba Sayın ".$kKaydi["isimSoyisim"]."\n \n";
            $mailIcerigiHazirla .= "Sitemize Yapmış olduğunuz üyelik kaydını tamamlamak için lütfen buraya <a href='".$siteLinki."/aktivasyon.php?AktivasyonKodu=".$kKaydi["AktivasyonKodu"]."&Email=".$kKaydi["emailAdres"]."'> tıklayınız. </a> \n \n";
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
                $mailGonder->Subject = DonusumleriGeriDondur($SiteAdi).'Yeni Üyelik aktivasyonu';
                $mailGonder->MsgHtml($MailIcerigiHazirla);

                $mailGonder->send();
                // echo 'Message has been sent';
                header("location:index.php?SK=36");
                exit();
            } catch (Exception $e) {
                // echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
                header("location:index.php?SK=33");
                exit();
            }
        }
    }else {
        header("location:index.php?SK=34");
        exit();
    }

}else{
    header("location:index.php?SK=35");
    exit();
}
?>