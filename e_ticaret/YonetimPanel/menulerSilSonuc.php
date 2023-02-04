<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
    $menulerSilSorgu = $db->prepare("DELETE FROM menuler WHERE id=? LIMIT 1");
    $menulerSilSorgu->execute([$GelenID]);
    $menuSil_KS = $menulerSilSorgu->rowCount();
    if($menuSil_KS>0){
        $UrunlerSorgu = $db->prepare("SELECT * FROM urunler WHERE MenuId=?");
        $UrunlerSorgu->execute([$GelenID]);
        $Urunler_KS = $UrunlerSorgu->rowCount();
        $urunlerKayitlar = $UrunlerSorgu->fetchAll(PDo::FETCH_ASSOC);
        if($Urunler_KS>0){
            foreach($urunlerKayitlar as $values){
                    $silinecekUrunID = $urunlerKayitlar["id"];

                    $UrunlerGuncelleSorgu = $db->prepare("UPDATE urunler SET Durumu=? WHERE id=? AND MenuId=?");
                    $UrunlerGuncelleSorgu->execute([0,$silinecekUrunID,$GelenID]);

                    $sepettenSilSorgu = $db->prepare("DELETE FROM sepet WHERE urunId=?");
                    $sepettenSilSorgu->execute([$silinecekUrunID]);

                    $FavoridenSilSorgu = $db->prepare("DELETE FROM favoriler WHERE urunId=?");
                    $FavoridenSilSorgu->execute([$silinecekUrunID]);
            }
        }
        header("location:index.php?SKD=0&SKI=67"); // kayıt silindi 
        exit();
    }else {
        header("location:index.php?SKD=0&SKI=68"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=68"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
