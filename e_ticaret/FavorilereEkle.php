<?php 
if(isset($_SESSION["Kullanici"])){

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!="") {
        $FavoriKontrolS = $db->prepare("SELECT * FROM favoriler WHERE urunId=? AND uyeId=? LIMIT 1");
        $FavoriKontrolS->execute([$GelenID,$id]);
        $favoriSil_KS = $FavoriKontrolS->rowCount();
        $favoriKayit = $FavoriKontrolS->fetch(PDO::FETCH_ASSOC);
        if($favoriSil_KS>0){
            header("Location:index.php?SK=80&ID=".$favoriKayit["id"].""); // favoriden kaldır 
            exit();
        }else {
        $FavoriSilSorgu = $db->prepare("INSERT INTO favoriler(urunId,uyeId) values(?,?)");
        $FavoriSilSorgu->execute([$GelenID,$id]);
        $favoriSil_KS = $FavoriSilSorgu->rowCount();
        if ($favoriSil_KS > 0) {
            header("Location:index.php?SK=88"); // eklendi
            exit();
        }else {
            header("Location:index.php?SK=89"); // hata 
            exit();
        }
        }
    }else {
        header("Location:index.php"); // id boş  
        exit();
    }

}else {
    header("location:index.php"); // oturum kapalı
    exit();
}
?>