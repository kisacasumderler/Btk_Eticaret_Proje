<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["SiparisNo"])){
        $GelenSiparisNo = Guvenlik($_POST["SiparisNo"]);
    }else {
        $GelenSiparisNo = "";
    }
    if(isset($_POST["SiparisKod"])){
        $GelenSiparisKod = Guvenlik($_POST["SiparisKod"]);
    }else {
        $GelenSiparisKod = "";
    }
    if(($GelenSiparisNo!="") and ($GelenSiparisKod!="")){
        $siparisGuncelleSorgu = $db->prepare("UPDATE siparisler SET OnayDurumu=?, kargoDurumu=?, kargoGonderiKodu=? WHERE siparisNumarasi=?");
        $siparisGuncelleSorgu->execute([1,1,$GelenSiparisKod,$GelenSiparisNo]);
        $siparisGuncelleKontrol = $siparisGuncelleSorgu->rowCount();
        if($siparisGuncelleKontrol>0){
            // başarılı 
            header("location:index.php?SKD=0&SKI=111"); 
            exit();
        }else {
            // hata 
            header("location:index.php?SKD=0&SKI=112"); 
            exit();
        }
    }else {
        // hata 
        header("location:index.php?SKD=0&SKI=112"); 
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>
