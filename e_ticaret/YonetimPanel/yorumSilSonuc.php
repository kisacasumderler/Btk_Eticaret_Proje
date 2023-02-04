<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
        $YorumlarSorgu = $db->prepare("SELECT * FROM yorumlar WHERE id=? LIMIT 1");
        $YorumlarSorgu->execute([$GelenID]);
        $Yorumlar_KS = $YorumlarSorgu->rowCount();
        $YorumKayit = $YorumlarSorgu->fetch(PDO::FETCH_ASSOC);
        if($Yorumlar_KS>0){
            $yorumID = $YorumKayit["id"];
            $urunId = $YorumKayit["urunId"];
            $Urunpuan = $YorumKayit["puan"];

            $YorumSilSorgu = $db->prepare("DELETE FROM yorumlar WHERE id=? LIMIT 1");
            $YorumSilSorgu->execute([$GelenID]);
            $SilKontrol = $YorumSilSorgu->rowCount();
            if($SilKontrol>0){
                $UrunGuncelleSorgu = $db->prepare("UPDATE urunler SET yorumSayisi = yorumSayisi-1, toplamyorumpuani = toplamyorumpuani =? WHERE id=? LIMIT 1");
                $UrunGuncelleSorgu->execute([$Urunpuan,$urunId]);
                $UrunGuncelleKontrol = $UrunGuncelleSorgu->rowCount();
                if($UrunGuncelleKontrol>0){
                    header("location:index.php?SKD=0&SKI=92"); // hata 
                    exit();  
                }else {
                    header("location:index.php?SKD=0&SKI=93"); // hata 
                    exit();  
                }
            }else {
                header("location:index.php?SKD=0&SKI=93"); // hata 
                exit();  
            }
        }else {
            header("location:index.php?SKD=0&SKI=93"); // hata 
            exit();   
        }
    }else {
        header("location:index.php?SKD=0&SKI=93"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
