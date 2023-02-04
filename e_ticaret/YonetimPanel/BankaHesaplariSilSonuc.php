<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }
    if($GelenID!=""){
    $HavaleBildirimSorgu = $db->prepare("SELECT * FROM  havalebildirimleri WHERE bankaId=?");
    $HavaleBildirimSorgu->execute([$GelenID]);
    $HavaleBildirimSorgu_KS = $HavaleBildirimSorgu->rowCount();
    
    if($HavaleBildirimSorgu_KS>0){
        header("location:index.php?SKD=0&SKI=20");
        exit();
    }else {
    $BankaHesapSorgu = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id=?");
    $BankaHesapSorgu->execute([$GelenID]);
    $BankaHesap_KS = $BankaHesapSorgu->rowCount();
    $BankaHesapKayit = $BankaHesapSorgu->fetch(PDO::FETCH_ASSOC);

    if($BankaHesap_KS>0){
    $SilinecekDosyaYolu = "../resimler/" . $BankaHesapKayit["BankLogo"];

    $HesapSilSorgu = $db->prepare("DELETE FROM bankahesaplarimiz WHERE id=? LIMIT 1");
    $HesapSilSorgu->execute([$GelenID]);
    $HesapSil_KS = $HesapSilSorgu->rowCount();
    if($HesapSil_KS>0){
        unlink($SilinecekDosyaYolu);
        header("location:index.php?SKD=0&SKI=19");
        exit();
    }else {
        header("location:index.php?SKD=0&SKI=20");
        exit();
    }
    }else {
        header("location:index.php?SKD=0&SKI=20");
        exit();  
    }
    }
    }else {
        header("location:index.php?SKD=0&SKI=20");
        exit();  
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>
