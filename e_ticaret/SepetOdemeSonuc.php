<?php 
if(isset($_SESSION["Kullanici"])){

    if(isset($_POST["OdemeYontemSec"])){
        $GelenOdemeYontemSec = Guvenlik($_POST["OdemeYontemSec"]);
    }else {
        $GelenOdemeYontemSec = "";
    }
    if(isset($_POST["TaksitSec"])){
        $GelenTaksitSec = Guvenlik($_POST["TaksitSec"]);
    }else {
        $GelenTaksitSec = "";
    }

    if($GelenOdemeYontemSec!=""){
        if($GelenOdemeYontemSec=="Havale"){
            // havale ödemesi 

            $SepetSorgu = $db->prepare("SELECT * FROM sepet WHERE UyeId=?");
            $SepetSorgu->execute([$id]);
            $SepetSorgu_KS = $SepetSorgu->rowCount();
            $SepetUrunler = $SepetSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($SepetSorgu_KS>0){
                foreach($SepetUrunler as $SepetValues){
                    $sepetID = $SepetValues["id"];
                    $SepetsepetNumarasi = $SepetValues["sepetNumarasi"];
                    $SepetUyeId = $SepetValues["UyeId"];
                    $SepeturunId = $SepetValues["urunId"];
                    $SepetVaryantId = $SepetValues["VaryantId"];
                    $SepetAdresId = $SepetValues["AdresId"];
                    $SepeturunAdedi = $SepetValues["urunAdedi"];
                    $SepetKargoFirmaId = $SepetValues["KargoFirmaId"];
                    $SepetodemeSecimi = $SepetValues["odemeSecimi"];

                    $UrunBilgiSorgu = $db->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
                    $UrunBilgiSorgu->execute([$SepeturunId]);
                    $UrunBilgi = $UrunBilgiSorgu->fetch(PDO::FETCH_ASSOC);

                    $urunTuru = $UrunBilgi["urunTuru"];
                    $urunResmiBir = $UrunBilgi["urunResmiBir"];
                    $urunAdi = $UrunBilgi["urunAdi"];
                    $urunFiyati = $UrunBilgi["urunFiyati"];
                    $paraBirimi = $UrunBilgi["paraBirimi"];
                    $varyantBasligi = $UrunBilgi["varyantBasligi"];
                    $KdvOrani = $UrunBilgi["KdvOrani"];
                    $kargoUcreti = $UrunBilgi["kargoUcreti"];

                    $VaryanBilgiSorgu = $db->prepare("SELECT * FROM urunvaryantlari WHERE id=? LIMIT 1");
                    $VaryanBilgiSorgu->execute([$SepetVaryantId]);
                    $VaryantBilgi = $VaryanBilgiSorgu->fetch(PDO::FETCH_ASSOC);

                    $varyantAdi = $VaryantBilgi["varyantAdi"];
                    $varyantSecim = $VaryantBilgi["varyantAdi"];

                    $KargoBilgiSorgu = $db->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
                    $KargoBilgiSorgu->execute([$SepetKargoFirmaId]);
                    $KargoFirmaBilgi = $KargoBilgiSorgu->fetch(PDO::FETCH_ASSOC);

                    $KargoFirmaAdi = $KargoFirmaBilgi["KargoFirmaAdi"];

                    $AdreslerSorgu = $db->prepare("SELECT * FROM adresler WHERE id=? LIMIT 1");
                    $AdreslerSorgu->execute([$SepetAdresId]);
                    $AdreslerDetay = $AdreslerSorgu->fetch(PDO::FETCH_ASSOC);

                    $adiSoyadi = $AdreslerDetay["adiSoyadi"];
                    $Adres = $AdreslerDetay["Adres"];
                    $Ilce = $AdreslerDetay["Ilce"];
                    $Sehir = $AdreslerDetay["Sehir"];
                    $TelefonNumarasi = $AdreslerDetay["TelefonNumarasi"];

                    $TLFiyat = TLCevir($paraBirimi) * $urunFiyati;

                    $AdresDetay = $Adres . "<br> " . $Sehir . " /" . $Ilce;
                    $AdresDetayFiltreli = Guvenlik($AdresDetay);

                    $SiparisEkle = $db->prepare("INSERT INTO siparisler(siparisNumarasi,urunId,urunTuru,UyeId,urunFiyati,urunAdi,kdvOrani,urunAdedi,topamUrunFiyati,kargoFirmasiSecimi,kargoUcreti,urunResmiBir,varyantBasligi,varyantSecimi,AdresAdiSoyadi,AdresDetay,AdresTelefon,odemeSecimi,siparisTarihi,OnayDurumu,kargoDurumu,siparisIdAdresi) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $SiparisEkle->execute([$SepetsepetNumarasi,$SepeturunId,$urunTuru,$id,$TLFiyat,$urunAdi,$KdvOrani,$SepeturunAdedi,$TLFiyat,$KargoFirmaAdi,$kargoUcreti,$urunResmiBir,$varyantBasligi,$varyantSecim,$adiSoyadi,$AdresDetayFiltreli,$TelefonNumarasi,$GelenOdemeYontemSec,$ZamanDamgasi,0,0,$IpAdresi]);
                    $SiparisEkleKontrol = $SiparisEkle->rowCount();

                    if($SiparisEkleKontrol>0){
                        $UrunSepettenKaldirSorgu = $db->prepare("DELETE FROM sepet WHERE id=? AND UyeId=?");
                        $UrunSepettenKaldirSorgu->execute([$sepetID, $id]);

                        $UrunSatisArttirSorgu = $db->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi+? WHERE id=?");
                        $UrunSatisArttirSorgu->execute([$SepeturunAdedi,$SepeturunId]);

                        $StokGuncelle = $db->prepare("UPDATE urunvaryantlari SET StokAdedi=StokAdedi-? WHERE id=? LIMIT 1");
                        $StokGuncelle->execute([$SepeturunAdedi,$SepetVaryantId]);

                    }else {
                        header("Location:index.php?SK=102"); // hata
                        exit();
                    }
                }
                if($SiparisEkleKontrol>0){
                    $SiparisToplaSorgu = $db->prepare("SELECT SUM(urunFiyati) AS ToplamSiparisTutar FROM siparisler WHERE UyeId=? AND siparisNumarasi=?");
                    $SiparisToplaSorgu->execute([$id, $SepetsepetNumarasi]);
                    $SiparisFiyat_K = $SiparisToplaSorgu->fetch(PDO::FETCH_ASSOC);
                    $ToplamSiparisUcret = $SiparisFiyat_K["ToplamSiparisTutar"];

                    if($ToplamSiparisUcret>=$ucretsizKargoBaraji){
                        $kargoFiyat = 0;
                    }else {
                        $kargoFiyat = $kargoUcreti;
                    }

                    $SiparisKargoveUcretGuncelle = $db->prepare("UPDATE siparisler SET topamUrunFiyati=?, kargoUcreti=? WHERE UyeId=? AND siparisNumarasi=?");
                    $SiparisKargoveUcretGuncelle->execute([$ToplamSiparisUcret, $kargoFiyat,$id, $SepetsepetNumarasi]);
                    $SiparisGuncelle_KS = $SiparisKargoveUcretGuncelle->rowCount();
                    if($SiparisGuncelle_KS>0){
                        header("Location:index.php?SK=101"); // islem tamam 
                        exit();
                    }else {
                        header("Location:index.php?SK=102"); // hata
                        exit();
                    }
                }else {
                    header("Location:index.php?SK=102"); // hata
                    exit();
                }
            }else {
                header("Location:index.php?SK=0"); // Anasayfaya dön
                exit();
            }
        }else {
            // kredi kartı ödeme 
            if($GelenTaksitSec!=""){
               // taksit seçimi
               $SepetiGuncelle = $db->prepare("UPDATE sepet SET odemeSecimi=?, TaksitSecimi=? WHERE UyeId=?");
               $SepetiGuncelle->execute([$GelenOdemeYontemSec, $GelenTaksitSec, $id]);
               $SepeteGuncelle_KS = $SepetiGuncelle->rowCount();

               if($SepeteGuncelle_KS>0){
                header("Location:index.php?SK=103"); 
                exit();
               }else {
                header("Location:index.php?SK=0"); // Anasayfaya dön
                exit();
               }

            }else {
                header("Location:index.php?SK=0"); // Anasayfaya dön
                exit();
            }
        }

    }else {
        header("Location:index.php?SK=0"); // Anasayfaya dön
        exit();
    }

}else {
	header("Location:index.php?SK=0"); // Anasayfaya dön
	exit();
}
?>