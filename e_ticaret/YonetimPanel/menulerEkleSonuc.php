<?php 
if(isset($_SESSION["Yonetici"])){
    
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

    if (($GelenurunTuru != "") and ($GelenMenuAdi !="")) {
        $menuEkleSorgu = $db->prepare("INSERT INTO menuler(urunTuru,MenuAdi) values(?,?)");
        $menuEkleSorgu->execute([$GelenurunTuru, $GelenMenuAdi]);
        $menuEkle_KS = $menuEkleSorgu->rowCount();
        if ($menuEkle_KS > 0) {
            header("location:index.php?SKD=0&SKI=60"); // ok 
            exit(); 
        } else {
            header("location:index.php?SKD=0&SKI=61"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=61"); // hata 
        exit(); 
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>