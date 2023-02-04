<?php
$IpAdresi = $_SERVER["REMOTE_ADDR"];
$ZamanDamgasi = time();
$TarihSaat = date("d.m.Y H:i:s",$ZamanDamgasi);


function Tarihbul($Deger) {
    $Cevir = date("d.m.Y",$Deger);
    $Sonuc = $Cevir;
    return $Sonuc;
}

function TarihSaatbul($Deger) {
    $Cevir = date("d.m.Y H:i:s",$Deger);
    $Sonuc = $Cevir;
    return $Sonuc;
}

function UcGunIleriTarihBul(){
    global $ZamanDamgasi;
    $Birgun = 86400;
    $Hesapla = $ZamanDamgasi + (4 * $Birgun);
    $Cevir = date("d.m.Y",$Hesapla);
    $Sonuc = $Cevir;
    return $Sonuc;
}

function RakamHaricTemizle($Deger) {
    $Islem = preg_replace("/[^0-9]/","",$Deger);
    $Sonuc = $Islem; 
    return $Islem;
}

function TumBosluklariSil($Deger) {
    $Islem = preg_replace("/\s|&nbsp/","",$Deger);
    $Sonuc = $Islem;
    return $Sonuc;
}

function Guvenlik($Deger) {
    $BoslukSil = trim($Deger);
    $TaglariTemizle = strip_tags($BoslukSil);
    $EtkisizYap = htmlspecialchars($TaglariTemizle,ENT_QUOTES);
    $Sonuc = $EtkisizYap;
    return $Sonuc;
}

function SayiliIcerikFiltrele($Deger) {
    $Filtrele = Guvenlik($Deger);
    $Temizle = RakamHaricTemizle($Filtrele);
    $Sonuc = $Temizle;
    return $Sonuc;
}

function DonusumleriGeriDondur($Deger) {
    $GeriDondur = htmlspecialchars_decode($Deger, ENT_QUOTES);
    $Sonuc = $GeriDondur;
    return $GeriDondur;
}

function IBANBicimlendir($Deger) {
    $BoslukSil = trim($Deger);
    $BoslukTemizle = TumBosluklariSil($BoslukSil);
    $BirinciBlok = substr($BoslukTemizle,0,2);
    $IkinciBlok = substr($BoslukTemizle,2,4);
    $UcuncuBlok = substr($BoslukTemizle,6,4);
    $DorduncuBlok = substr($BoslukTemizle,10,4);
    $BesinciBlok = substr($BoslukTemizle,14,4);
    $AltinciBlok = substr($BoslukTemizle,18,4);
    $YedinciBlok = substr($BoslukTemizle,22,4);
    $Duzenle = $BirinciBlok." ".$IkinciBlok." ".$UcuncuBlok." ".$DorduncuBlok." ".$BesinciBlok." ".$AltinciBlok." ".$YedinciBlok;
    $Sonuc = $Duzenle;
    return $Sonuc;
}

// aktivasyon kodu    

function AktivasyonKoduUret() {
    $IlkBesli = rand(10000,9999);
    $IkinciBesli = rand(10000,9999);
    $UcuncuBesli = rand(10000,9999);
    $Kod = $IlkBesli."-".$IkinciBesli."-".$UcuncuBesli;
    $Sonuc = $Kod;
    return $Sonuc;
}

function FiyatBicimlendir($Deger) {
    $Bicimlendir = number_format($Deger, "2", ",", ".");
    $Sonuc = $Bicimlendir." ₺";
    return $Sonuc;
}

function FiyatBicimlendirTlSiz($Deger){
    $Bicimlendir = number_format($Deger, "2", ",", ".");
    $Sonuc = $Bicimlendir;
    return $Sonuc;
}

function TLCevir($Deger){
    global $DolarKuru;
    global $EuroKuru;
    if($Deger == "USD"){
        return $DolarKuru;
    }elseif($Deger =="EUR"){
        return $EuroKuru;
    }else if($Deger == "TRY"){
        return 1;
    }else {
        return "Hata";
    }
}

function ResimAdıOlustur(){
    $Sonuc = substr(md5(uniqid(time())),0,25);
    return $Sonuc;
}

function SEO($Deger) {
    $icerik = trim($Deger);
    $Degisecekler = array("ö", "ç", "ş", "ı", "ğ", "ü", "Ö", "Ç", "Ş", "İ", "Ğ", "Ü");
    $Degisenler = array("o", "c", "s", "i", "g", "u", "o", "C", "S", "I", "G", "O");
    $icerik = str_replace($Degisecekler, $Degisenler, $icerik);
    $icerik = mb_strtolower($icerik, "UTF-8");
    $icerik = preg_replace("/[^a-z0-9.]/", "-", $icerik);
    $icerik = preg_replace("/-+/", "-", $icerik);
    $icerik = trim($icerik, "-");
    return $icerik;
}

?>