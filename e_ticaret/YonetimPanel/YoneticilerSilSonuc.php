<?php 
if(isset($_SESSION["Yonetici"])){
    if($YoneticiDurumu==1){

        if(isset($_GET["ID"])){
            $GelenYoneticiID = Guvenlik($_GET["ID"]);
        }else {
            $GelenYoneticiID = "";
        }

        if (($GelenYoneticiID != "")) {
                $YoneticiSilSorgu = $db->prepare("DELETE FROM yoneticiler WHERE id=? AND kullaniciAdi!=? AND yoneticiDurumu=? LIMIT 1");
                $YoneticiSilSorgu->execute([$GelenYoneticiID,$YoneticiKullaniciAdi,0]);
                $YoneticiSil_KS = $YoneticiSilSorgu->rowCount();
                if ($YoneticiSil_KS > 0) {
                    header("location:index.php?SKD=0&SKI=79"); // başarılı 
                    exit(); 
                } else {
                    header("location:index.php?SKD=0&SKI=80"); // hata 
                    exit(); 
                }
            }else {
                header("location:index.php?SKD=0&SKI=80"); // hata 
                exit(); 
            }
    }else {
        header("location:index.php?SKD=0&SKI=0"); // not admin
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>