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

    if (($Gelensoru != "") and ($Gelencevap !="")) {
        $DestekEkleSorgu = $db->prepare("INSERT INTO sorular(soru,cevap) values(?,?)");
        $DestekEkleSorgu->execute([$Gelensoru, $Gelencevap]);
        $DestekEkle_KS = $DestekEkleSorgu->rowCount();
        if ($DestekEkle_KS > 0) {
            header("location:index.php?SKD=0&SKI=48"); // hata 
            exit(); 
        } else {
            header("location:index.php?SKD=0&SKI=49"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=49"); // hata 
        exit(); 
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>