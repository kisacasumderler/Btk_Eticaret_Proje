<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["menuID"])){
        $GelenmenuID = Guvenlik($_POST["menuID"]);
    }else {
        $GelenmenuID = "";
    }
    if(isset($_POST["urunTuru"])){
        $GelenurunTuru = Guvenlik($_POST["urunTuru"]);
    }else {
        $GelenurunTuru = "";
    }
    if(isset($_POST["MenuAdi"])){
        $GelenMenuAdi = Guvenlik($_POST["MenuAdi"]);
    }else {
        $GelenMenuAdi = "";
    }
    if (($GelenmenuID != "") and ($GelenurunTuru !="") and ($GelenMenuAdi !="")) {
        $DestekEkleSorgu = $db->prepare("UPDATE menuler SET urunTuru=?,MenuAdi=? WHERE id=?");
        $DestekEkleSorgu->execute([$GelenurunTuru, $GelenMenuAdi,$GelenmenuID]);
        $DestekEkle_KS = $DestekEkleSorgu->rowCount();
        if ($DestekEkle_KS > 0) {
            header("location:index.php?SKD=0&SKI=64"); // ok 
            exit(); 
        } else {
            header("location:index.php?SKD=0&SKI=65"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=65"); // hata 
        exit(); 
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>