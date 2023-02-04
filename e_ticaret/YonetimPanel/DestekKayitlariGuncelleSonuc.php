<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["soru"])){
        $Gelensoru = Guvenlik($_POST["soru"]);
    }else {
        $Gelensoru = "";
    }
    if(isset($_POST["cevap"])){
        $Gelencevap = Guvenlik($_POST["cevap"]);
    }else {
        $Gelencevap = "";
    }
    if(isset($_POST["DestekID"])){
        $GelenDestekID = Guvenlik($_POST["DestekID"]);
    }else {
        $GelenDestekID = "";
    }
    if (($Gelensoru != "") and ($Gelencevap !="") and ($GelenDestekID !="")) {
        $DestekEkleSorgu = $db->prepare("UPDATE sorular SET soru=?,cevap=? WHERE id=?");
        $DestekEkleSorgu->execute([$Gelensoru, $Gelencevap, $GelenDestekID]);
        $DestekEkle_KS = $DestekEkleSorgu->rowCount();
        if ($DestekEkle_KS > 0) {
            header("location:index.php?SKD=0&SKI=52"); // hata 
            exit(); 
        } else {
            header("location:index.php?SKD=0&SKI=53"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=53"); // hata 
        exit(); 
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>