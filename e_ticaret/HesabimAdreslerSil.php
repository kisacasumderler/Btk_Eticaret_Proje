<?php 
if(isset($_SESSION["Kullanici"])){

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!="") {
        $AdresSilSorgu = $db->prepare("DELETE FROM adresler WHERE id = ? LIMIT 1");
        $AdresSilSorgu->execute([$GelenID]);
        $AS_KayitSayisi = $AdresSilSorgu->rowCount();
        if ($AS_KayitSayisi > 0) {
            header("Location:index.php?SK=68");
            exit();
        }else {
            header("Location:index.php?SK=69");
            exit();
        }
    }else {
        header("Location:index.php?SK=69");
        exit();
    }

}else {
    header("location:index.php");
    exit();
}
?>