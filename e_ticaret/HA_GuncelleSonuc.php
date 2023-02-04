<?php 
if(isset($_SESSION["Kullanici"])){
    

        if (isset($_GET["ID"])) {
            $GelenID = Guvenlik($_GET["ID"]);
        }else {
            $GelenID = "";
        }

        if(isset($_POST["IsimSoyisim"])){
            $GelenIsimSoyisim = Guvenlik($_POST["IsimSoyisim"]);
        }else {
            $GelenIsimSoyisim = "";
        }

        if(isset($_POST["AdresBaslik"])){
            $GelenAdresBaslik = Guvenlik($_POST["AdresBaslik"]);
        
        }else {
            $GelenAdresBaslik = "";
        }
        if(isset($_POST["Adres"])){
            $GelenAdres = Guvenlik($_POST["Adres"]);
        
        }else {
            $GelenAdres = "";
        }
        if(isset($_POST["Ilce"])){
            $GelenIlce = Guvenlik($_POST["Ilce"]);
        
        }else {
            $GelenIlce = "";
        }
        if(isset($_POST["Sehir"])){
        $GelenSehir = Guvenlik($_POST["Sehir"]);

        }else {
            $GelenSehir = "";
        }

        if(isset($_POST["TelefonNumarasi"])){
        $GelenTelefonNumarasi = SayiliIcerikFiltrele(Guvenlik($_POST["TelefonNumarasi"]));
        }else {
            $GelenTelefonNumarasi = "";
        }

if(($GelenID!="")and($GelenIsimSoyisim!="")and ($GelenAdresBaslik!="") and ($GelenAdres!="") and ($GelenIlce!="") and ($GelenSehir!="") and ($GelenTelefonNumarasi!="")){

    $AdresEkleSorgu = $db->prepare("UPDATE adresler SET AdresBaslik=?,adiSoyadi=?,Adres=?,Ilce=?,Sehir=?,TelefonNumarasi=? WHERE id =? AND UyeId=?");

    $AdresEkleSorgu->execute([$GelenAdresBaslik,$GelenIsimSoyisim,$GelenAdres,$GelenIlce,$GelenSehir,$GelenTelefonNumarasi,$GelenID,$id]);
    $EA_Sayisi = $AdresEkleSorgu->rowCount();
        if ($EA_Sayisi > 0) {
            header("location:index.php?SK=64"); // güncellendi  
            exit();
        }else {
            header("location:index.php?SK=65"); // hata 
            exit();
        }
        }else {
            header("location:index.php?SK=66"); // eksik alan 
            exit();
        }

}else {
    header("location:index.php");
    exit();
}

?>