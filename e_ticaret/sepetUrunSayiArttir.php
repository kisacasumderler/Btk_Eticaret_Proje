<?php 
if(isset($_SESSION["Kullanici"])){

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!="") {
        $sepetGuncelle = $db->prepare("UPDATE sepet SET urunAdedi=urunAdedi+1 WHERE id = ? AND UyeId = ? LIMIT 1");
        $sepetGuncelle->execute([$GelenID,$id]);
        $sepetGuncelle_KS = $sepetGuncelle->rowCount();
        if ($sepetGuncelle_KS > 0) {
            header("Location:index.php?SK=94");
            exit();
        }else {
            header("Location:index.php?SK=0"); // hata 
            exit();
        }
    }else {
        header("Location:index.php?SK=0"); // eksik alan 
        exit();
    }

}else {
    header("Location:index.php?SK=0");
    exit();
}
?>