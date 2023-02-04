<?php 
if(isset($_SESSION["Kullanici"])){
    

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

if(($GelenIsimSoyisim!="")and ($GelenAdresBaslik!="") and ($GelenAdres!="") and ($GelenIlce!="") and ($GelenSehir!="") and ($GelenTelefonNumarasi!="")){

    $AdresEkleSorgu = $db->prepare("INSERT INTO adresler(UyeId,AdresBaslik,adiSoyadi,Adres,Ilce,Sehir,TelefonNumarasi) values(?,?,?,?,?,?,?) LIMIT 1");
    $AdresEkleSorgu->execute([$id,$GelenAdresBaslik,$GelenIsimSoyisim,$GelenAdres,$GelenIlce,$GelenSehir,$GelenTelefonNumarasi]);
    $EA_Sayisi = $AdresEkleSorgu->rowCount();
        if ($EA_Sayisi > 0) {
            header("location:index.php?SK=72"); // hata 
            exit();
        }else {
            header("location:index.php?SK=73"); // hata 
            exit();
        }
        }else {
            header("location:index.php?SK=74"); // eksik alan 
            exit();
        }

}else {
    header("location:index.php");
    exit();
}

?>