<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["SepetNo"])){
        $GelenSiparisNo = Guvenlik($_GET["SepetNo"]);
    }else {
        $GelenSiparisNo = "";
    }
    if($GelenSiparisNo!=""){
        $SiparislerSorgu = $db->prepare("SELECT * FROM siparisler WHERE siparisNumarasi=?");
        $SiparislerSorgu->execute([$GelenSiparisNo]);
        $siparislerKontrol = $SiparislerSorgu->rowCount();
        $SiparisKayitlar = $SiparislerSorgu->fetchAll(PDO::FETCH_ASSOC);
        if($siparislerKontrol>0){
            foreach($SiparisKayitlar as $values){
                $SiparisID = $values["id"];
                $urunId = $values["urunId"];
                $urunAdedi = $values["urunAdedi"];
                $varyantSecimi = $values["varyantSecimi"];

                $siparisSilSorgu = $db->prepare("DELETE FROM siparisler WHERE id=? LIMIT 1");
                $siparisSilSorgu->execute([$SiparisID]);
                $siparisSilKontrol = $siparisSilSorgu->rowCount();
                if($siparisSilKontrol>0){
                    $urunGuncelleSorgu = $db->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi-? WHERE id=? LIMIT 1");
                    $urunGuncelleSorgu->execute([$urunAdedi,$urunId]);
                    $urunGuncelleKontrol = $urunGuncelleSorgu->rowCount();
                    if($urunGuncelleKontrol>0){
                        $varyantGuncelleSorgu = $db->prepare("UPDATE urunvaryantlari SET StokAdedi=StokAdedi+? WHERE urunId=? AND varyantAdi=? LIMIT 1");
                        $varyantGuncelleSorgu->execute([$urunAdedi,$urunId,DonusumleriGeriDondur($varyantSecimi)]);
                        $varyantGuncelleKontrol = $varyantGuncelleSorgu->rowCount();

                        if($varyantGuncelleKontrol<1){
                        // hata 
                        header("location:index.php?SKD=0&SKI=115"); 
                        exit(); 
                        }
                    }else {
                        // hata 
                        header("location:index.php?SKD=0&SKI=115"); 
                        exit();                    
                    }
                }else {
                    // hata 
                    header("location:index.php?SKD=0&SKI=115"); 
                    exit();
                }
            }
             // başarılı 
             header("location:index.php?SKD=0&SKI=114"); 
             exit();
        }else{
            header("location:index.php?SKD=0&SKI=115"); 
            exit(); 
        }
    }else {
        // hata 
        header("location:index.php?SKD=0&SKI=115"); 
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>