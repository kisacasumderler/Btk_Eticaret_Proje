<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
    $BannerSorgu = $db->prepare("SELECT * FROM bannerlar WHERE id=?");
    $BannerSorgu->execute([$GelenID]);
    $Bannerlar_KS = $BannerSorgu->rowCount();
    $BannerlarKayitlar = $BannerSorgu->fetch(PDO::FETCH_ASSOC);
    if($Bannerlar_KS>0){

    $SilinecekDosyaYolu = "../resimler/Bannerlar/". $BannerlarKayitlar["BannerResmi"];
    $BannerResmiSilSorgu = $db->prepare("DELETE FROM bannerlar WHERE id=? LIMIT 1");
    $BannerResmiSilSorgu->execute([$GelenID]);
    $BannerSil_KS = $BannerResmiSilSorgu->rowCount();
    if($BannerSil_KS>0){
        unlink($SilinecekDosyaYolu);
        header("location:index.php?SKD=0&SKI=43"); // kayıt silindi 
        exit();
    }else {
        header("location:index.php?SKD=0&SKI=44"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=44"); // hata 
        exit();   
    }
    }else {
        header("location:index.php?SKD=0&SKI=44"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
