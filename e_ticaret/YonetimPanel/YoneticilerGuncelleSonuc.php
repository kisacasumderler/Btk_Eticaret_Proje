<?php 
if(isset($_SESSION["Yonetici"])){

    if(isset($_POST["YoneticiID"])){
        $GelenYoneticiID = Guvenlik($_POST["YoneticiID"]);
    }else {
        $GelenYoneticiID = "";
    }

    if(($GelenYoneticiID==$YoneticiID) or ($YoneticiDurumu==1)){

    if(isset($_POST["isimSoyisim"])){
        $GelenisimSoyisim = Guvenlik($_POST["isimSoyisim"]);
    }else {
        $GelenisimSoyisim = "";
    }
    if(isset($_POST["sifre"])){
        $Gelensifre = Guvenlik($_POST["sifre"]);
    }else {
        $Gelensifre = "";
    }
    if(isset($_POST["telefonNumarasi"])){
        $GelentelefonNumarasi = Guvenlik($_POST["telefonNumarasi"]);
    }else {
        $GelentelefonNumarasi = "";
    }
    if(isset($_POST["emailAdres"])){
        $GelenemailAdres = Guvenlik($_POST["emailAdres"]);
    }else {
        $GelenemailAdres = "";
    }

    

    if (($Gelensifre!= "")){
        $SifreMd5li = md5($Gelensifre); // yeni şifre 
    }else {
    // şifre sorgusu 
    $SifreSorgu = $db->prepare("SELECT * FROM yoneticiler WHERE id=?");
    $SifreSorgu->execute([$GelenYoneticiID]);
    $SifreKontrol = $SifreSorgu->rowCount();
    $SifreKayit = $SifreSorgu->fetch(PDO::FETCH_ASSOC);
    if($SifreKontrol>0){
        $SifreMd5li = $SifreKayit["sifre"]; // eski şifre 
    }else {
        header("location:index.php?SKD=0&SKI=0"); // hata  
        exit(); 
    }
    }

    if (($GelenYoneticiID != "") and ($GelenisimSoyisim !="")and ($SifreMd5li !="")and ($GelentelefonNumarasi !="")and ($GelenemailAdres!="")) {

        $YoneticilerSorgusu = $db->prepare("SELECT * FROM yoneticiler WHERE emailAdres=? NOT id=?");
        $YoneticilerSorgusu->execute([$GelenemailAdres,$GelenYoneticiID]);
        $KS_kontrol = $YoneticilerSorgusu->rowCount();

        if($KS_kontrol>0){
            header("location:index.php?SKD=0&SKI=81"); // eşleşen kayıt 
            exit(); 
        }else {
            $YoneticiGuncelleSorgu = $db->prepare("UPDATE yoneticiler SET isimSoyisim=?,sifre=?,telefonNumarasi=?,emailAdres=? WHERE id=? LIMIT 1");
            $YoneticiGuncelleSorgu->execute([$GelenisimSoyisim, $SifreMd5li, $GelentelefonNumarasi, $GelenemailAdres, $GelenYoneticiID]);
            $DestekEkle_KS = $YoneticiGuncelleSorgu->rowCount();
            if ($DestekEkle_KS > 0) {
                header("location:index.php?SKD=0&SKI=76"); // başarılı 
                exit(); 
            } else {
                header("location:index.php?SKD=0&SKI=77"); // hata 
                exit(); 
            }
        }

    }else {
        header("location:index.php?SKD=0&SKI=77"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=0"); // kullanıcı sadece kendi bilgilerini güncelleyebilir veya admin olmalıdır. 
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>