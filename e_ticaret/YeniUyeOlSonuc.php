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

 if(isset($_POST["Sifre"])){
    $GelenSifre = Guvenlik($_POST["Sifre"]);
   
   }else {
       $GelenSifre = "";
}
if(isset($_POST["sifreTekrar"])){
    $GelensifreTekrar = Guvenlik($_POST["sifreTekrar"]);
   
   }else {
       $GelensifreTekrar = "";
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

if(isset($_POST["formOnay"])){
    $GelenformOnay = Guvenlik($_POST["formOnay"]);
   }else {
       $GelenformOnay = "";
}

$AktivasyonKodu = AktivasyonKoduUret();
$MD5liSifre =  md5($GelenSifre);

if(($GelenIsimSoyisim!="")and ($GelenSifre!="") and ($GelensifreTekrar!="") and ($GelenemailAdresi!="") and ($GelenTelefonNumarasi!="") and ($Gelencinsiyet!="")){
    if($GelenformOnay==0){
        header("location:index.php?SK=29");
        exit();
    }else {
        if($GelenSifre!=$GelensifreTekrar){
            header("location:index.php?SK=28");
            exit();
        }else {
            $KayitSorgu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres = ? LIMIT 1");
            $KayitSorgu->execute([$GelenemailAdresi]);
            $K_KayitSayisi = $KayitSorgu->rowCount();
            if ($K_KayitSayisi > 0) {
                header("location:index.php?SK=27");
                exit();
            }else {
                $UyeEkleSorgu = $db->prepare("INSERT INTO uyeler(emailAdres, sifre, isimSoyisim, telefonNumarasi, cinsiyet, durumu, kayitTarihi, kayitIpAdresi, AktivasyonKodu) VALUES (?,?,?,?,?,?,?,?,?)");
                $UyeEkleSorgu->execute([$GelenemailAdresi,$MD5liSifre,$GelenIsimSoyisim,$GelenTelefonNumarasi,$Gelencinsiyet,0,$ZamanDamgasi,$IpAdresi,$AktivasyonKodu]);
                $KayitKontrolSayisi = $UyeEkleSorgu->rowCount();
                if ($KayitKontrolSayisi > 0) {
                    $mailIcerigiHazirla = "Merhaba Sayın ".$GelenIsimSoyisim."\n \n";
                    $mailIcerigiHazirla .= "Sitemize Yapmış olduğunuz üyelik kaydını tamamlamak için lütfen buraya <a href='".$siteLinki."/aktivasyon.php?AktivasyonKodu=".$AktivasyonKodu."&Email=".$GelenemailAdresi."'> tıklayınız. </a> \n \n";
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
                        header("location:index.php?SK=24");
                        exit();
                    } catch (Exception $e) {
                        // echo "Message could not be sent. Mailer Error: {$mailGonder->ErrorInfo}";
                        header("location:index.php?SK=25");
                        exit();
                    }
                }else {
                    header("location:index.php?SK=25");
                    exit();
                }
            }
        }
    }
}else {
    header("location:index.php?SK=26");
    exit();
}

?>