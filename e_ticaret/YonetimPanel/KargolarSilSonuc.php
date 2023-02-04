<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
    $KargolarSorgu = $db->prepare("SELECT * FROM kargofirmalari WHERE id=?");
    $KargolarSorgu->execute([$GelenID]);
    $Kargolar_KayitSayisi = $KargolarSorgu->rowCount();
    $KargolarKayitlar = $KargolarSorgu->fetch(PDO::FETCH_ASSOC);
    if($Kargolar_KayitSayisi>0){

    $SilinecekDosyaYolu = "../resimler/" . $KargolarKayitlar["KargoFirmaLogo"];

    $HesapSilSorgu = $db->prepare("DELETE FROM kargofirmalari WHERE id=? LIMIT 1");
    $HesapSilSorgu->execute([$GelenID]);
    $HesapSil_KS = $HesapSilSorgu->rowCount();
    if($HesapSil_KS>0){
        unlink($SilinecekDosyaYolu);
        header("location:index.php?SKD=0&SKI=31"); // kayıt silindi 
        exit();
    }else {
        header("location:index.php?SKD=0&SKI=32"); // hata 
        exit(); 
    }
    }else {
        header("location:index.php?SKD=0&SKI=32"); // hata 
        exit();   
    }
    }else {
        header("location:index.php?SKD=0&SKI=32"); // hata 
        exit();   
    }

}else {
     header("location:index.php?SKD=0&SKI=0"); // giriş yok 
     exit();
}
?>
