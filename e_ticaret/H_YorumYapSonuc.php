<?php 
if(isset($_SESSION["Kullanici"])){
    

        if (isset($_GET["ID"])) {
            $GelenID = Guvenlik($_GET["ID"]);
        }else {
            $GelenID = "";
        }

        if(isset($_POST["YorumPuan"])){
            $gelenYorumPuan = Guvenlik($_POST["YorumPuan"]);
        }else {
            $gelenYorumPuan = "";
        }

        if(isset($_POST["YorumYap"])){
            $GelenYorum = Guvenlik($_POST["YorumYap"]);
        
        }else {
            $GelenYorum = "";
        }

if(($GelenID!="")and($gelenYorumPuan!="")and ($GelenYorum!="")){

    $YorumEkleSorgu = $db->prepare("INSERT INTO yorumlar(urunId,uyeId,puan,yorumMetni,yorumTarihi,YorumIpAdresi) values(?,?,?,?,?,?)");

    $YorumEkleSorgu->execute([$GelenID,$id,$gelenYorumPuan,$GelenYorum,$ZamanDamgasi,$IpAdresi]);
    $YorumEkleSayi = $YorumEkleSorgu->rowCount();
        if ($YorumEkleSayi > 0) {
            $UrunGuncellemeS = $db->prepare("UPDATE urunler SET yorumSayisi=yorumSayisi+1, toplamyorumpuani=? WHERE id=? LIMIT 1");
            $UrunGuncellemeS->execute([$gelenYorumPuan,$GelenID]);
            $Guncellenen_US = $UrunGuncellemeS->rowCount();
            if($Guncellenen_US>0) {
            header("location:index.php?SK=77"); // güncellendi  
            exit();
            }else {
                header("location:index.php?SK=78"); // hata  
                exit(); 
            }
        }else {
            header("location:index.php?SK=78"); // hata 
            exit();
        }
        }else {
            header("location:index.php?SK=79"); // eksik alan 
            exit();
        }

}else {
    header("location:index.php");
    exit();
}

?>