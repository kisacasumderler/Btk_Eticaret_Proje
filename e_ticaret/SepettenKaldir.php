<?php 
if(isset($_SESSION["Kullanici"])){

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!="") {
        $SepettenSil = $db->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
        $SepettenSil->execute([$GelenID,$id]);
        $SepettenSil_KS = $SepettenSil->rowCount();
        if ($SepettenSil_KS > 0) {
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