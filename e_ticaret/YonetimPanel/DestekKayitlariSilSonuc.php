<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
    $DestekKayitSilSorgu = $db->prepare("DELETE FROM sorular WHERE id=? LIMIT 1");
    $DestekKayitSilSorgu->execute([$GelenID]);
    $BannerSil_KS = $DestekKayitSilSorgu->rowCount();
    if($BannerSil_KS>0){
        header("location:index.php?SKD=0&SKI=55"); // kayıt silindi 
        exit();
    }else {
        header("location:index.php?SKD=0&SKI=56"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=56"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
