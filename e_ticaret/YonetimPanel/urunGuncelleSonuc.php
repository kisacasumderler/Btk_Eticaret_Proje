<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["UrunID"])){
        $GelenUrunID = Guvenlik($_GET["UrunID"]);
    }else {
        $GelenUrunID = "";
    }
    if(isset($_POST["urunAdi"])){
        $GelenurunAdi = Guvenlik($_POST["urunAdi"]);
    }else {
        $GelenurunAdi = "";
    }
    if(isset($_POST["MenuID"])){
        $GelenMenuID = Guvenlik($_POST["MenuID"]);
    }else {
        $GelenMenuID = "";
    }
    if(isset($_POST["urunFiyati"])){
        $GelenurunFiyati = Guvenlik($_POST["urunFiyati"]);
    }else {
        $GelenurunFiyati = "";
    }
    if(isset($_POST["paraBirimi"])){
        $GelenparaBirimi = Guvenlik($_POST["paraBirimi"]);
    }else {
        $GelenparaBirimi = "";
    }
    if(isset($_POST["KdvOrani"])){
        $GelenKdvOrani = Guvenlik($_POST["KdvOrani"]);
    }else {
        $GelenKdvOrani = "";
    }
    if(isset($_POST["kargoUcreti"])){
        $GelenkargoUcreti = Guvenlik($_POST["kargoUcreti"]);
    }else {
        $GelenkargoUcreti = "";
    }
    if(isset($_POST["urunAciklamasi"])){
        $GelenurunAciklamasi = Guvenlik($_POST["urunAciklamasi"]);
    }else {
        $GelenurunAciklamasi = "";
    }
    if(isset($_POST["varyantBasligi"])){
        $GelenvaryantBasligi = Guvenlik($_POST["varyantBasligi"]);
    }else {
        $GelenvaryantBasligi = "";
    }
    if(isset($_POST["varyantAdi1"])){
        $GelenvaryantAdi1 = Guvenlik($_POST["varyantAdi1"]);
    }else {
        $GelenvaryantAdi1 = "";
    }
    if(isset($_POST["StokAdedi1"])){
        $GelenStokAdedi1 = Guvenlik($_POST["StokAdedi1"]);
    }else {
        $GelenStokAdedi1 = "";
    }
    if(isset($_POST["varyantAdi2"])){
        $GelenvaryantAdi2 = Guvenlik($_POST["varyantAdi2"]);
    }else {
        $GelenvaryantAdi2 = "";
    }
    if(isset($_POST["StokAdedi2"])){
        $GelenStokAdedi2 = Guvenlik($_POST["StokAdedi2"]);
    }else {
        $GelenStokAdedi2 = "";
    }
    if(isset($_POST["varyantAdi3"])){
        $GelenvaryantAdi3 = Guvenlik($_POST["varyantAdi3"]);
    }else {
        $GelenvaryantAdi3 = "";
    }
    if(isset($_POST["StokAdedi3"])){
        $GelenStokAdedi3 = Guvenlik($_POST["StokAdedi3"]);
    }else {
        $GelenStokAdedi3 = "";
    }
    if(isset($_POST["varyantAdi4"])){
        $GelenvaryantAdi4 = Guvenlik($_POST["varyantAdi4"]);
    }else {
        $GelenvaryantAdi4 = "";
    }
    if(isset($_POST["StokAdedi4"])){
        $GelenStokAdedi4 = Guvenlik($_POST["StokAdedi4"]);
    }else {
        $GelenStokAdedi4 = "";
    }
    if(isset($_POST["varyantAdi5"])){
        $GelenvaryantAdi5 = Guvenlik($_POST["varyantAdi5"]);
    }else {
        $GelenvaryantAdi5 = "";
    }
    if(isset($_POST["StokAdedi5"])){
        $GelenStokAdedi5 = Guvenlik($_POST["StokAdedi5"]);
    }else {
        $GelenStokAdedi5 = "";
    }
    $GelenurunResmiBir = $_FILES["urunResmiBir"];
    $GelenurunResmiIki = $_FILES["urunResmiIki"];
    $GelenUrunResmiUc = $_FILES["UrunResmiUc"];
    $GelenUrunResmiDort = $_FILES["UrunResmiDort"];

    if(($GelenurunAdi != "") and ($GelenUrunID != "") and ($GelenMenuID != "")and ($GelenurunFiyati != "")and ($GelenparaBirimi != "")and ($GelenKdvOrani != "")and ($GelenkargoUcreti != "")and ($GelenurunAciklamasi != "")and ($GelenvaryantBasligi != "")and ($GelenvaryantAdi1 != "")and ($GelenStokAdedi1 != "")){

        $UrunSorgusu = $db->prepare("SELECT * FROM urunler WHERE id=?");
        $UrunSorgusu->execute([$GelenUrunID]);
        $urunKontrol = $UrunSorgusu->rowCount();
        $urunKayit = $UrunSorgusu->fetch(PDO::FETCH_ASSOC);

        $ResimBirAd = $urunKayit["urunResmiBir"];
        $ResimIkiAd = $urunKayit["urunResmiIki"];
        $ResimUcAd = $urunKayit["UrunResmiUc"];
        $ResimDortAd = $urunKayit["UrunResmiDort"];

        if ($urunKontrol > 0) {

            $menuTuruSorgu = $db->prepare("SELECT * FROM menuler where id=? LIMIT 1");
            $menuTuruSorgu->execute([$GelenMenuID]);
            $menuTuruKontrol = $menuTuruSorgu->rowCount();
            $menuTuruKaydi = $menuTuruSorgu->fetch(PDO::FETCH_ASSOC);

            if ($menuTuruKaydi["urunTuru"] == "Erkek Ayakkabısı") {
                $ResimTamYol = $ResimKlasorYol . "UrunResimleri/Erkek/";
                $ResimKlasorYol = "UrunResimleri/Erkek/";
            } elseif ($menuTuruKaydi["urunTuru"] == "Kadın Ayakkabısı") {
                $ResimTamYol = $ResimKlasorYol . "UrunResimleri/Kadin/";
                $ResimKlasorYol = "UrunResimleri/Kadin/";
            } else {
                $ResimTamYol = $ResimKlasorYol . "UrunResimleri/Cocuk/";
                $ResimKlasorYol = "UrunResimleri/Cocuk/";
            }
            
            $Resim1SilinecekYol = "../resimler/".$ResimKlasorYol . $ResimBirAd;
            $Resim2SilinecekYol = "../resimler/".$ResimKlasorYol . $ResimIkiAd;
            $Resim3SilincekYol = "../resimler/".$ResimKlasorYol . $ResimUcAd;
            $Resim4SilinecekYol = "../resimler/".$ResimKlasorYol . $ResimDortAd;

            $urunGuncelleSorgu = $db->prepare("UPDATE urunler SET MenuId=?,urunAdi=?,urunFiyati=?,paraBirimi=?,KdvOrani=?,urunAciklamasi=?,varyantBasligi=?,kargoUcreti=? WHERE id=? LIMIT 1");
            $urunGuncelleSorgu->execute([$GelenMenuID, $GelenurunAdi, $GelenurunFiyati, $GelenparaBirimi, $GelenKdvOrani, $GelenurunAciklamasi, $GelenvaryantBasligi, $GelenkargoUcreti, $GelenUrunID]);
            $urunGuncelleKontrol = $urunGuncelleSorgu->rowCount();

            if (($GelenurunResmiBir["name"] != "") and ($GelenurunResmiBir["type"] != "") and ($GelenurunResmiBir["tmp_name"] != "") and ($GelenurunResmiBir["error"] == 0) and ($GelenurunResmiBir["size"] > 0)) {
                unlink($Resim1SilinecekYol);
                $BirinciResimDosyaAdi = ResimAdıOlustur();
                $BirinciResimUzanti = substr($GelenurunResmiBir["name"], -4);
                if ($BirinciResimUzanti == "jpeg") {
                    $BirinciResimUzanti = "." . $BirinciResimUzanti;
                }
                $BirinciResimYeniDosyaAdi = $BirinciResimDosyaAdi . $BirinciResimUzanti;
            
                $ResimBirYukle = new \Verot\Upload\Upload($GelenurunResmiBir, "tr-TR");
                if ($ResimBirYukle->uploaded) {
                    $ResimBirYukle->file_new_name_body = $BirinciResimDosyaAdi; // resim dosyası ismi
                    $ResimBirYukle->image_resize = true; // boyutlandırma true
                    $ResimBirYukle->image_x = 600; // genişlik
                    $ResimBirYukle->image_y = 800; // yükseklik 
                    $ResimBirYukle->mime_check = true;
                    $ResimBirYukle->allowed = array('image/*');
                    $ResimBirYukle->file_overwrite = true; // üstüne yaz
                    $ResimBirYukle->image_background_color = null; // arka plan rengi 
                    $ResimBirYukle->png_compression = 1;
                    $ResimBirYukle->image_convert = 'jpg';
                    $ResimBirYukle->process($ResimTamYol);
                    if ($ResimBirYukle->processed) {
                        $ResimBirYukle->clean(); // yükleme tamam
                        $BirinciResimGuncelleSorgu = $db->prepare("UPDATE urunler SET urunResmiBir=? WHERE id=? LIMIT 1");
                        $BirinciResimGuncelleSorgu->execute([$BirinciResimYeniDosyaAdi, $GelenUrunID]);
                        $BirinciResimGuncelleKontrol = $BirinciResimGuncelleSorgu->rowCount();
                        if ($BirinciResimGuncelleKontrol < 1) {
                            header("location:index.php?SKD=0&SKI=102"); // hata 
                            exit();
                        }
                    } else {
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit();
                    }
                }
            }
            
            if (($GelenurunResmiIki["name"] != "") and ($GelenurunResmiIki["type"] != "") and ($GelenurunResmiIki["tmp_name"] != "") and ($GelenurunResmiIki["error"] == 0) and ($GelenurunResmiIki["size"] > 0)) {
                unlink($Resim2SilinecekYol);
                $IkinciResimDosyaAdi = ResimAdıOlustur();
                $IkinciResimUzanti = substr($GelenurunResmiIki["name"], -4);
                if ($IkinciResimUzanti == "jpeg") {
                    $IkinciResimUzanti = "." . $IkinciResimUzanti;
                }
                $IkinciResimYeniDosyaAdi = $IkinciResimDosyaAdi . $IkinciResimUzanti;
            
                $ResimIkiYukle = new \Verot\Upload\Upload($GelenurunResmiIki, "tr-TR");
                if ($ResimIkiYukle->uploaded) {
                    $ResimIkiYukle->file_new_name_body = $IkinciResimDosyaAdi; // resim dosyası ismi
                    $ResimIkiYukle->image_resize = true; // boyutlandırma true
                    $ResimIkiYukle->image_x = 600; // genişlik
                    $ResimIkiYukle->image_y = 800; // yükseklik 
                    $ResimIkiYukle->mime_check = true;
                    $ResimIkiYukle->allowed = array('image/*');
                    $ResimIkiYukle->file_overwrite = true; // üstüne yaz
                    $ResimIkiYukle->image_background_color = null; // arka plan rengi 
                    $ResimIkiYukle->png_compression = 1;
                    $ResimIkiYukle->image_convert = 'jpg';
                    $ResimIkiYukle->process($ResimTamYol);
                    if ($ResimIkiYukle->processed) {
                        $ResimIkiYukle->clean(); // yükleme tamam
                        $IkinciResimGuncelleSorgu = $db->prepare("UPDATE urunler SET urunResmiIki=? WHERE id=? LIMIT 1");
                        $IkinciResimGuncelleSorgu->execute([$IkinciResimYeniDosyaAdi, $GelenUrunID]);
                        $IkinciResimGuncelleKontrol = $IkinciResimGuncelleSorgu->rowCount();
                        if ($IkinciResimGuncelleKontrol < 1) {
                            header("location:index.php?SKD=0&SKI=102"); // hata 
                            exit();
                        }
                    } else {
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit();
                    }
                }
            }
            
            if (($GelenUrunResmiUc["name"] != "") and ($GelenUrunResmiUc["type"] != "") and ($GelenUrunResmiUc["tmp_name"] != "") and ($GelenUrunResmiUc["error"] == 0) and ($GelenUrunResmiUc["size"] > 0)) {
                unlink($Resim3SilincekYol);
                $UcuncuResimDosyaAdi = ResimAdıOlustur();
                $UcuncuResimUzanti = substr($GelenUrunResmiUc["name"], -4);
                if ($UcuncuResimUzanti == "jpeg") {
                    $UcuncuResimUzanti = "." . $UcuncuResimUzanti;
                }
                $UcuncuResimYeniDosyaAdi = $UcuncuResimDosyaAdi . $UcuncuResimUzanti;
            
                $ResimUcYukle = new \Verot\Upload\Upload($GelenUrunResmiUc, "tr-TR");
                if ($ResimUcYukle->uploaded) {
                    $ResimUcYukle->file_new_name_body = $UcuncuResimDosyaAdi; // resim dosyası ismi
                    $ResimUcYukle->image_resize = true; // boyutlandırma true
                    $ResimUcYukle->image_x = 600; // genişlik
                    $ResimUcYukle->image_y = 800; // yükseklik 
                    $ResimUcYukle->mime_check = true;
                    $ResimUcYukle->allowed = array('image/*');
                    $ResimUcYukle->file_overwrite = true; // üstüne yaz
                    $ResimUcYukle->image_background_color = null; // arka plan rengi 
                    $ResimUcYukle->png_compression = 1;
                    $ResimUcYukle->image_convert = 'jpg';
                    $ResimUcYukle->process($ResimTamYol);
                    if ($ResimUcYukle->processed) {
                        $ResimUcYukle->clean(); // yükleme tamam
                        $UcuncuResimGuncelleSorgu = $db->prepare("UPDATE urunler SET UrunResmiUc=? WHERE id=? LIMIT 1");
                        $UcuncuResimGuncelleSorgu->execute([$UcuncuResimYeniDosyaAdi, $GelenUrunID]);
                        $UcuncuResimGuncelleKontrol = $UcuncuResimGuncelleSorgu->rowCount();
                        if ($UcuncuResimGuncelleKontrol < 1) {
                            header("location:index.php?SKD=0&SKI=102"); // hata 
                            exit();
                        }
                    } else {
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit();
                    }
                }
            }
            
            if (($GelenUrunResmiDort["name"] != "") and ($GelenUrunResmiDort["type"] != "") and ($GelenUrunResmiDort["tmp_name"] != "") and ($GelenUrunResmiDort["error"] == 0) and ($GelenUrunResmiDort["size"] > 0)) {
                unlink($Resim4SilinecekYol);
                $DorduncuResimDosyaAdi = ResimAdıOlustur();
                $DorduncuResimUzanti = substr($GelenUrunResmiDort["name"], -4);
                if ($DorduncuResimUzanti == "jpeg") {
                    $DorduncuResimUzanti = "." . $DorduncuResimUzanti;
                }
                $DorduncuResimYeniDosyaAdi = $DorduncuResimDosyaAdi . $DorduncuResimUzanti;
            
                $ResimDortYukle = new \Verot\Upload\Upload($GelenUrunResmiDort, "tr-TR");
                if ($ResimDortYukle->uploaded) {
                    $ResimDortYukle->file_new_name_body = $DorduncuResimDosyaAdi; // resim dosyası ismi
                    $ResimDortYukle->image_resize = true; // boyutlandırma true
                    $ResimDortYukle->image_x = 600; // genişlik
                    $ResimDortYukle->image_y = 800; // yükseklik 
                    $ResimDortYukle->mime_check = true;
                    $ResimDortYukle->allowed = array('image/*');
                    $ResimDortYukle->file_overwrite = true; // üstüne yaz
                    $ResimDortYukle->image_background_color = null; // arka plan rengi 
                    $ResimDortYukle->png_compression = 1;
                    $ResimDortYukle->image_convert = 'jpg';
                    $ResimDortYukle->process($ResimTamYol);
                    if ($ResimDortYukle->processed) {
                        $ResimDortYukle->clean(); // yükleme tamam
                        $DorduncuResimGuncelleSorgu = $db->prepare("UPDATE urunler SET UrunResmiDort=? WHERE id=? LIMIT 1");
                        $DorduncuResimGuncelleSorgu->execute([$DorduncuResimYeniDosyaAdi, $GelenUrunID]);
                        $DorduncuResimGuncelleKontrol = $DorduncuResimGuncelleSorgu->rowCount();
                        if ($DorduncuResimGuncelleKontrol < 1) {
                            header("location:index.php?SKD=0&SKI=102"); // hata 
                            exit();
                        }
                    } else {
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit();
                    }
                }
            }




            $varyantlarSorgu = $db->prepare("SELECT * FROM urunvaryantlari WHERE urunId=?");
            $varyantlarSorgu->execute([$GelenUrunID]);
            $varyantKS = $varyantlarSorgu->rowCount();
            $varyantBilgisi = $varyantlarSorgu->fetchAll(PDO::FETCH_ASSOC);

            $varyantIsimDizisi = array();
            $varyantStokDizisi = array();

            foreach($varyantBilgisi as $varyant) {
                $varyantIsimDizisi[] = $varyant["varyantAdi"];
            }

            if(array_key_exists(0,$varyantIsimDizisi)){
                if(($GelenvaryantAdi1 != "")and ($GelenStokAdedi1 != "")){
                    $varyant1GuncelleSorgu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi=?, StokAdedi=? WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant1GuncelleSorgu->execute([$GelenvaryantAdi1,$GelenStokAdedi1,$GelenUrunID,$varyantIsimDizisi[0]]);
                    $varyant1GuncelleKontrol = $varyant1GuncelleSorgu->rowCount();
                }else {
                    header("location:index.php?SKD=0&SKI=102"); // hata 
                    exit(); 
                }
            }
            
            if(array_key_exists(1,$varyantIsimDizisi)){
                if(($GelenvaryantAdi2 != "")and ($GelenvaryantAdi2 != "")){
                    $varyant2GuncelleSorgu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi=?, StokAdedi=? WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant2GuncelleSorgu->execute([$GelenvaryantAdi2,$GelenStokAdedi2,$GelenUrunID,$varyantIsimDizisi[1]]);
                    $varyant2GuncelleKontrol = $varyant2GuncelleSorgu->rowCount();
                }else {
                    $varyant2SilSorgu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant2SilSorgu->execute([$GelenUrunID,$varyantIsimDizisi[1]]);
                    $varyant2SilKontrol = $varyant2SilSorgu->rowCount();
                    if($varyant2SilKontrol<1){
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit(); 
                    }
                }
            }else {
                $varyant2EkleSorgu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                $varyant2EkleSorgu->execute([$GelenUrunID,$GelenvaryantAdi2,$GelenStokAdedi2]);
                $varyantEkleKontrol = $varyant2EkleSorgu->rowCount();
                if($varyantEkleKontrol<1){
                    header("location:index.php?SKD=0&SKI=102"); // hata 
                    exit(); 
                }
            }

            if(array_key_exists(2,$varyantIsimDizisi)){
                if(($GelenvaryantAdi3 != "")and ($GelenvaryantAdi3 != "")){
                    $varyant3GuncelleSorgu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi=?, StokAdedi=? WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant3GuncelleSorgu->execute([$GelenvaryantAdi3,$GelenStokAdedi3,$GelenUrunID,$varyantIsimDizisi[2]]);
                    $varyant2GuncelleKontrol = $varyant3GuncelleSorgu->rowCount();
                }else {
                    $varyant3SilSorgu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant3SilSorgu->execute([$GelenUrunID,$varyantIsimDizisi[2]]);
                    $varyant3SilKontrol = $varyant3SilSorgu->rowCount();
                    if($varyant3SilKontrol<1){
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit(); 
                    }
                }
            }else {
                $varyant3EkleSorgu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                $varyant3EkleSorgu->execute([$GelenUrunID,$GelenvaryantAdi3,$GelenStokAdedi3]);
                $varyant3EkleKontrol = $varyant3EkleSorgu->rowCount();
                if($varyant3EkleKontrol<1){
                    header("location:index.php?SKD=0&SKI=102"); // hata 
                    exit(); 
                }
            }

            if(array_key_exists(3,$varyantIsimDizisi)){
                if(($GelenvaryantAdi4 != "")and ($GelenvaryantAdi4 != "")){
                    $varyant4GuncelleSorgu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi=?, StokAdedi=? WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant4GuncelleSorgu->execute([$GelenvaryantAdi4,$GelenStokAdedi4,$GelenUrunID,$varyantIsimDizisi[3]]);
                    $varyant2GuncelleKontrol = $varyant4GuncelleSorgu->rowCount();
                }else {
                    $varyant4SilSorgu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant4SilSorgu->execute([$GelenUrunID,$varyantIsimDizisi[3]]);
                    $varyant4SilKontrol = $varyant4SilSorgu->rowCount();
                    if($varyant4SilKontrol<1){
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit(); 
                    }
                }
            }else {
                $varyant4EkleSorgu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                $varyant4EkleSorgu->execute([$GelenUrunID,$GelenvaryantAdi4,$GelenStokAdedi4]);
                $varyant4EkleKontrol = $varyant4EkleSorgu->rowCount();
                if($varyant4EkleKontrol<1){
                    header("location:index.php?SKD=0&SKI=102"); // hata 
                    exit(); 
                }
            }

            if(array_key_exists(4,$varyantIsimDizisi)){
                if(($GelenvaryantAdi5 != "")and ($GelenvaryantAdi5 != "")){
                    $varyant5GuncelleSorgu = $db->prepare("UPDATE urunvaryantlari SET varyantAdi=?, StokAdedi=? WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant5GuncelleSorgu->execute([$GelenvaryantAdi5,$GelenStokAdedi5,$GelenUrunID,$varyantIsimDizisi[4]]);
                    $varyant5GuncelleKontrol = $varyant5GuncelleSorgu->rowCount();
                }else {
                    $varyant5SilSorgu = $db->prepare("DELETE FROM urunvaryantlari WHERE urunId=? AND varyantAdi=? LIMIT 1");
                    $varyant5SilSorgu->execute([$GelenUrunID,$varyantIsimDizisi[4]]);
                    $varyant5SilSorgu = $varyant5SilSorgu->rowCount();
                    if($varyant5SilSorgu<1){
                        header("location:index.php?SKD=0&SKI=102"); // hata 
                        exit(); 
                    }
                }
            }else {
                $varyant5EkleSorgu = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                $varyant5EkleSorgu->execute([$GelenUrunID,$GelenvaryantAdi5,$GelenStokAdedi5]);
                $varyant5EkleKontrol = $varyant5EkleSorgu->rowCount();
                if($varyant5EkleKontrol<1){
                    header("location:index.php?SKD=0&SKI=102"); // hata 
                    exit(); 
                }
            }

            header("location:index.php?SKD=0&SKI=101"); // başarılı 
            exit(); 

        }else {
            header("location:index.php?SKD=0&SKI=102"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=102"); // hata 
        exit(); 
    }
}else {
     header("location:index.php?SKD=1&SKI=0");
     exit();
}
?>