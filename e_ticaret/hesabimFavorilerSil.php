<?php 
if(isset($_SESSION["Kullanici"])){

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!="") {
        $FavoriSilSorgu = $db->prepare("DELETE FROM favoriler WHERE id = ? AND uyeId = ? LIMIT 1");
        $FavoriSilSorgu->execute([$GelenID,$id]);
        $favoriSil_KS = $FavoriSilSorgu->rowCount();
        if ($favoriSil_KS > 0) {
            header("Location:index.php?SK=90"); // silindi başarılı 
            exit();
        }else {
            header("Location:index.php?SK=81"); // hata 
            exit();
        }
    }else {
        header("Location:index.php?SK=82"); // eksik alan 
        exit();
    }

}else {
    header("location:index.php");
    exit();
}
?>