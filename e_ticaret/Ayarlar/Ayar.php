<?php

$SiteKokDizini = $_SERVER["DOCUMENT_ROOT"];
$ResimKlasorYol = $SiteKokDizini . "/e_ticaret/resimler/";
$ResimKlasorYolBanner = $SiteKokDizini . "/e_ticaret/resimler/Bannerlar/";

    try {
        $db = new PDO("mysql:host=localhost;dbname=e_ticaret_proje;charset=UTF8","root","");
    }catch(PDOException $Hata) {
        echo "Bağlantı Hatası <br>".$Hata->getMessage();
        die();
    }

$AyarlarSorgusu = $db->prepare("SELECT * FROM ayarlar LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayarlar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if($AyarSayisi>0){
    $SiteAdi = $Ayarlar["SiteAdi"];
    $SiteTitle = $Ayarlar["SiteTitle"];
    $SiteDecscription = $Ayarlar["SiteDecscription"];
    $SiteKeywords = $Ayarlar["SiteKeywords"];
    $SiteCopyrightMetni = $Ayarlar["SiteCopyrightMetni"];
    $SiteLogosu = $Ayarlar["SiteLogosu"];
    $SiteEmailHostAdresi = $Ayarlar["SiteEmailHostAdresi"];
    $siteLinki = $Ayarlar["siteLinki"];
    $SiteEmailAdresi = $Ayarlar["SiteEmailAdresi"];
    $SiteEmailSifresi = $Ayarlar["SiteEmailSifresi"];
    $TwitterLink = $Ayarlar["TwitterLink"];
    $LinkedinLink = $Ayarlar["LinkedinLink"];
    $FacebookLink = $Ayarlar["FacebookLink"];
    $InstagramLink = $Ayarlar["InstagramLink"];
    $PinterestLink = $Ayarlar["PinterestLink"];
    $YouTubeLink = $Ayarlar["YouTubeLink"];
    $DolarKuru = $Ayarlar["DolarKuru"];
    $EuroKuru = $Ayarlar["EuroKuru"];
    $ucretsizKargoBaraji = $Ayarlar["ucretsizKargoBaraji"];
    $ClientID = $Ayarlar["ClientID"]; // bu bilgiler bankadan alınacak 
    $StoreKey = $Ayarlar["StoreKey"]; // bu bilgiler bankadan alınacak 
    $ApiKullanicisi = $Ayarlar["ApiKullanicisi"]; // bu bilgiler bankadan alınacak 
    $ApiSifresi = $Ayarlar["ApiSifresi"]; // bu bilgiler bankadan alınacak 
}else {
    // echo "Site ayar sorgusu Hatalı";
    die();
}

$MetinlerSorgusu = $db->prepare("SELECT * FROM sozlesmelervemetinler LIMIT 1");
$MetinlerSorgusu->execute();
$MetinSayisi = $MetinlerSorgusu->rowCount();
$Metinler = $MetinlerSorgusu->fetch(PDO::FETCH_ASSOC);

if($MetinSayisi>0){
    $hakkimizda = $Metinler["hakkimizda"];
    $uyelikSozlesmesi = $Metinler["uyelikSozlesmesi"];
    $kullanimKosullari = $Metinler["kullanimKosullari"];
    $gizlilikSozlesmesi = $Metinler["gizlilikSozlesmesi"];
    $mesafeliSatisSozlesmesi = $Metinler["mesafeliSatisSozlesmesi"];
    $iptalIadeDegisim = $Metinler["iptalIadeDegisim"];
    $teslimat = $Metinler["teslimat"];
}else {
    // echo "Site ayar sorgusu Hatalı";
    die();
}

// bankalar 
$BankalarSorgusu = $db->prepare("SELECT * FROM bankahesaplarimiz");
$BankalarSorgusu->execute();
$B_KayitSayisi = $BankalarSorgusu->rowCount();
$B_Kayitlar = $BankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

// soru cevap 
$SoruCevap_S = $db->prepare("SELECT * FROM sorular");
$SoruCevap_S->execute();
$SC_KayitSayisi = $SoruCevap_S->rowCount();
$SC_Kayitlar = $SoruCevap_S->fetchAll(PDO::FETCH_ASSOC);

// kullanıcı sorgusu   

if(isset($_SESSION["Kullanici"])){

$KullaniciSorgusu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres =? LIMIT 1");
$KullaniciSorgusu->execute([$_SESSION["Kullanici"]]);
$KS_KayitSayisi = $KullaniciSorgusu->rowCount();
$Kullanici = $KullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

if($KS_KayitSayisi>0){
    $id  = $Kullanici["id"];
    $emailAdres = $Kullanici["emailAdres"];
    $sifre = $Kullanici["sifre"];
    $isimSoyisim = $Kullanici["isimSoyisim"];
    $telefonNumarasi = $Kullanici["telefonNumarasi"];
    $cinsiyet = $Kullanici["cinsiyet"];
    $durumu = $Kullanici["durumu"];
    $kayitTarihi = $Kullanici["kayitTarihi"];
    $kayitIpAdresi = $Kullanici["kayitIpAdresi"];
    $AktivasyonKodu = $Kullanici["AktivasyonKodu"];
}else {
    // echo "Site ayar sorgusu Hatalı";
    die();
}}

if(isset($_SESSION["Yonetici"])){

    $YoneticiSorgusu = $db->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi =? LIMIT 1");
    $YoneticiSorgusu->execute([$_SESSION["Yonetici"]]);
    $YS_KayitSayisi =$YoneticiSorgusu->rowCount();
    $Yonetici = $YoneticiSorgusu->fetch(PDO::FETCH_ASSOC);
    
    if($YS_KayitSayisi>0){
        $YoneticiID  = $Yonetici["id"];
        $Yoneticisifre = $Yonetici["sifre"];
        $YoneticiisimSoyisim = $Yonetici["isimSoyisim"];
        $YoneticitelefonNumarasi = $Yonetici["telefonNumarasi"];
        $YoneticiKullaniciAdi = $Yonetici["kullaniciAdi"];
        $YoneticiDurumu = $Yonetici["yoneticiDurumu"];
    }else {
        // echo "Site ayar sorgusu Hatalı";
        die();
    }}

?>