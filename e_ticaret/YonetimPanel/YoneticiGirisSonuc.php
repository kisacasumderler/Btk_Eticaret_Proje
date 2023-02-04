<?php
if(empty($_SESSION["Yonetici"])){

 if(isset($_POST["YKAdi"])){
    $GelenYKAdi = Guvenlik($_POST["YKAdi"]);
   
   }else {
       $GelenYKAdi = "";
}
 if(isset($_POST["ySifre"])){
 $GelenySifre = Guvenlik($_POST["ySifre"]);

}else {
    $GelenySifre = "";
 }

$MD5liSifre =  md5($GelenySifre);

if (($GelenYKAdi != "") and ($GelenySifre != "")) {

    $KayitSorgu = $db->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? AND sifre=?");
    $KayitSorgu->execute([$GelenYKAdi, $MD5liSifre]);
    $K_KayitSayisi = $KayitSorgu->rowCount();
    $kKaydi = $KayitSorgu->fetch(PDO::FETCH_ASSOC);

    if ($K_KayitSayisi > 0) {
            $_SESSION["Yonetici"] = $GelenYKAdi;
            header("location:index.php?SKD=0&SKI=0");
            exit();
    }else {
        header("location:index.php?SKD=3");
        exit();
    }

}else{
    header("location:index.php?SKD=1");
    exit();
}
?>
<?php }else {
        header("location:index.php?SKD=1");
        exit();
}
?>
?>