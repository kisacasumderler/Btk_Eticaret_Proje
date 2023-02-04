<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
    $uyeSilSorgu = $db->prepare("UPDATE uyeler SET silinmeDurumu=? WHERE id=? LIMIT 1");
    $uyeSilSorgu->execute([0,$GelenID]);
    $uyeSil_KS = $uyeSilSorgu->rowCount();
    if($uyeSil_KS>0){
        header("location:index.php?SKD=0&SKI=88"); // üye aktifleştirildi
        exit(); 
    }else {
        header("location:index.php?SKD=0&SKI=89"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=89"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
