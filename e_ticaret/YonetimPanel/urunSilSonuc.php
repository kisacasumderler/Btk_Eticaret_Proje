<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }
    if(isset($_GET["MenuID"])){
        $GelenMenuID = Guvenlik($_GET["MenuID"]);
    }else {
        $GelenMenuID = "";
    }
    if(($GelenID!="") and ($GelenMenuID!="")){
    $urunSilSorgu = $db->prepare("UPDATE urunler SET Durumu=? WHERE id=? LIMIT 1");
    $urunSilSorgu->execute([0,$GelenID]);
    $urunSil_KS = $urunSilSorgu->rowCount();
        if($urunSil_KS>0){
            $sepettenSilSorgu = $db->prepare("DELETE FROM sepet WHERE urunId=?");
            $sepettenSilSorgu->execute([$GelenID]);

            $FavoridenSilSorgu = $db->prepare("DELETE FROM favoriler WHERE urunId=?");
            $FavoridenSilSorgu->execute([$GelenID]);

            $menuGuncelleSorgu = $db->prepare("UPDATE menuler SET urunSayisi=urunSayisi-1 WHERE id=?");
            $menuGuncelleSorgu->execute([$GelenMenuID]);

            header("location:index.php?SKD=0&SKI=104"); // tamam 
            exit(); 
        }else {
            header("location:index.php?SKD=0&SKI=105"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=105"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
