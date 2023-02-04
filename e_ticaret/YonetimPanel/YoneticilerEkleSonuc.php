<?php 
if(isset($_SESSION["Yonetici"])){
    if ($YoneticiDurumu == 1) {

        if (isset($_POST["kullaniciAdi"])) {
            $GelenkullaniciAdi = Guvenlik($_POST["kullaniciAdi"]);
        } else {
            $GelenkullaniciAdi = "";
        }
        if (isset($_POST["isimSoyisim"])) {
            $GelenisimSoyisim = Guvenlik($_POST["isimSoyisim"]);
        } else {
            $GelenisimSoyisim = "";
        }
        if (isset($_POST["sifre"])) {
            $Gelensifre = Guvenlik($_POST["sifre"]);
        } else {
            $Gelensifre = "";
        }
        if (isset($_POST["telefonNumarasi"])) {
            $GelentelefonNumarasi = Guvenlik($_POST["telefonNumarasi"]);
        } else {
            $GelentelefonNumarasi = "";
        }
        if (isset($_POST["emailAdres"])) {
            $GelenemailAdres = Guvenlik($_POST["emailAdres"]);
        } else {
            $GelenemailAdres = "";
        }

        $SifreMd5li = md5($Gelensifre);

        if (($GelenkullaniciAdi != "") and ($GelenisimSoyisim != "") and ($SifreMd5li != "") and ($GelentelefonNumarasi != "") and ($GelenemailAdres != "")) {

            $YoneticilerSorgusu = $db->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi=? OR emailAdres=?");
            $YoneticilerSorgusu->execute([$GelenkullaniciAdi, $GelenemailAdres]);
            $KS_kontrol = $YoneticilerSorgusu->rowCount();

            if ($KS_kontrol > 0) {
                header("location:index.php?SKD=0&SKI=81"); // eşleşen kayıt 
                exit();
            } else {
                $DestekEkleSorgu = $db->prepare("INSERT INTO yoneticiler(kullaniciAdi,isimSoyisim,sifre,telefonNumarasi,emailAdres) values(?,?,?,?,?)");
                $DestekEkleSorgu->execute([$GelenkullaniciAdi, $GelenisimSoyisim, $SifreMd5li, $GelentelefonNumarasi, $GelenemailAdres]);
                $DestekEkle_KS = $DestekEkleSorgu->rowCount();
                if ($DestekEkle_KS > 0) {
                    header("location:index.php?SKD=0&SKI=72"); // başarılı 
                    exit();
                } else {
                    header("location:index.php?SKD=0&SKI=73"); // hata 
                    exit();
                }
            }

        } else {
            header("location:index.php?SKD=0&SKI=73"); // hata 
            exit();
        }
    }else {
        header("location:index.php?SKD=0&SKI=0"); // admin olmayan ekleme yapamaz 
        exit(); 
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>