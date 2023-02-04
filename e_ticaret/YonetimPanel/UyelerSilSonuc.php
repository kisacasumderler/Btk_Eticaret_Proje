<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
    $uyeSilSorgu = $db->prepare("UPDATE uyeler SET silinmeDurumu=? WHERE id=? LIMIT 1");
    $uyeSilSorgu->execute([1,$GelenID]);
    $uyeSil_KS = $uyeSilSorgu->rowCount();
    if($uyeSil_KS>0){
        $SepetSilSorgu = $db->prepare("DELETE FROM sepet WHERE UyeId=?");
        $SepetSilSorgu->execute([$GelenID]);

        $YorumlarSorgu = $db->prepare("SELECT * FROM yorumlar WHERE UyeId=?");
        $YorumlarSorgu->execute([$GelenID]);
        $Yorumlar_KS = $YorumlarSorgu->rowCount();
        $YorumKayitlar = $YorumlarSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($Yorumlar_KS>0){
                foreach($YorumKayitlar as $yorumValues){
                    $yorumID = $yorumValues["id"];
                    $urunId = $yorumValues["urunId"];
                    $Urunpuan = $yorumValues["puan"];

                    $UrunGuncelleSorgu = $db->prepare("UPDATE urunler SET yorumSayisi = yorumSayisi-1, toplamyorumpuani = toplamyorumpuani =? WHERE id=? LIMIT 1");
                    $UrunGuncelleSorgu->execute([$Urunpuan,$urunId]);
                    $UrunGuncelleKontrol = $UrunGuncelleSorgu->rowCount();
                    if($UrunGuncelleKontrol<0){
                        header("location:index.php?SKD=0&SKI=85"); // üye yorum ve puan güncellenemedi 
                        exit(); 
                    }

                    $YorumSilmeSorgu = $db->prepare("DELETE FROM yorumlar WHERE id=? LIMIT 1");
                    $YorumSilmeSorgu->execute([$yorumID]);
                    $YorumSilKontrol = $YorumSilmeSorgu->rowCount();
                    if($YorumSilKontrol<0){
                        header("location:index.php?SKD=0&SKI=85"); // hata yorum silinemedi 
                        exit(); 
                    }
                }
            }
        header("location:index.php?SKD=0&SKI=84"); // kayıt silindi 
        exit(); 
    }else {
        header("location:index.php?SKD=0&SKI=85"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=85"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
