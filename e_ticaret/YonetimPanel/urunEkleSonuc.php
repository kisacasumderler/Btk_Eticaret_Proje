<?php 
if(isset($_SESSION["Yonetici"])){
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
    if(isset($_POST["varyantAdi"])){
        $GelenvaryantAdi = Guvenlik($_POST["varyantAdi"]);
    }else {
        $GelenvaryantAdi = "";
    }
    if(isset($_POST["StokAdedi"])){
        $GelenStokAdedi = Guvenlik($_POST["StokAdedi"]);
    }else {
        $GelenStokAdedi = "";
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



    if(($GelenurunAdi != "") and ($GelenMenuID != "")and ($GelenurunFiyati != "")and ($GelenparaBirimi != "")and ($GelenKdvOrani != "")and ($GelenkargoUcreti != "")and ($GelenurunAciklamasi != "")and ($GelenvaryantBasligi != "")and ($GelenvaryantAdi != "")and ($GelenStokAdedi != "")and ($GelenurunResmiBir["name"] != "")and ($GelenurunResmiBir["type"] != "")and ($GelenurunResmiBir["tmp_name"] != "")and ($GelenurunResmiBir["error"]==0)and ($GelenurunResmiBir["size"]>0)){
        
        $menuTuruSorgu = $db->prepare("SELECT * FROM menuler where id=? LIMIT 1");
        $menuTuruSorgu->execute([$GelenMenuID]);
        $menuTuruKontrol = $menuTuruSorgu->rowCount();
        $menuTuruKaydi = $menuTuruSorgu->fetch(PDO::FETCH_ASSOC);

        if($menuTuruKontrol>0){
        $BirinciResimDosyaAdi = ResimAdıOlustur();
        $BirinciResimUzanti = substr($GelenurunResmiBir["name"], -4);
        if($BirinciResimUzanti=="jpeg"){
            $BirinciResimUzanti = "." . $BirinciResimUzanti;
        }
        $BirinciResimYeniDosyaAdi = $BirinciResimDosyaAdi . $BirinciResimUzanti;

        if($menuTuruKaydi["urunTuru"]=="Erkek Ayakkabısı"){
                $ResimTamYol = $ResimKlasorYol . "UrunResimleri/Erkek/"; 
        }elseif($menuTuruKaydi["urunTuru"]=="Kadın Ayakkabısı"){
                $ResimTamYol = $ResimKlasorYol . "UrunResimleri/Kadin/";
        }else {
                $ResimTamYol = $ResimKlasorYol . "UrunResimleri/Cocuk/";
        }

        $urunEkleSorgu = $db->prepare("INSERT INTO urunler(MenuId,urunTuru,urunAdi,urunFiyati,paraBirimi,KdvOrani,urunAciklamasi,urunResmiBir,varyantBasligi,kargoUcreti,Durumu) values(?,?,?,?,?,?,?,?,?,?,?)");
        $urunEkleSorgu->execute([$GelenMenuID,$menuTuruKaydi["urunTuru"],$GelenurunAdi,$GelenurunFiyati,$GelenparaBirimi,$GelenKdvOrani,$GelenurunAciklamasi,$BirinciResimYeniDosyaAdi,$GelenvaryantBasligi,$GelenkargoUcreti,1]);
        $urunEkleKontrol = $urunEkleSorgu->rowCount();

        if($urunEkleKontrol>0){
            $SonEklenenUrunID = $db->lastInsertId();

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
              } else {
                header("location:index.php?SKD=0&SKI=98"); // hata 
                exit(); 
              }

            $MenuUrunSayisiGuncelle = $db->prepare("UPDATE menuler SET urunSayisi = urunSayisi+1 WHERE id=? LIMIT 1");
            $MenuUrunSayisiGuncelle->execute([$GelenMenuID]);
            $menuGuncelleKontrol = $MenuUrunSayisiGuncelle->rowCount();

            if($menuGuncelleKontrol>0){
                $BirinciVaryantEkle = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                $BirinciVaryantEkle->execute([$SonEklenenUrunID,$GelenvaryantAdi,$GelenStokAdedi]);
                $BirinciVaryantKontrol = $BirinciVaryantEkle->rowCount();
                if($BirinciVaryantKontrol>0){
                        if(($GelenvaryantAdi2!="") and ($GelenStokAdedi2!="")){
                            $IkinciVaryantEkle = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                            $IkinciVaryantEkle->execute([$SonEklenenUrunID,$GelenvaryantAdi2,$GelenStokAdedi2]);
                            $IkinciVaryantKontrol = $IkinciVaryantEkle->rowCount();
                            if($IkinciVaryantKontrol<1){
                                header("location:index.php?SKD=0&SKI=98"); // hata 
                                exit();   
                            }
                        }
                        if(($GelenvaryantAdi3!="") and ($GelenStokAdedi3!="")){
                            $UcuncuVaryantEkle = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                            $UcuncuVaryantEkle->execute([$SonEklenenUrunID,$GelenvaryantAdi3,$GelenStokAdedi3]);
                            $UcuncuVaryantKontrol = $UcuncuVaryantEkle->rowCount();
                            if($UcuncuVaryantKontrol<1){
                                header("location:index.php?SKD=0&SKI=98"); // hata 
                                exit();   
                            }
                        }
                        if(($GelenvaryantAdi4!="") and ($GelenStokAdedi4!="")){
                            $DorduncuVaryantEkle = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                            $DorduncuVaryantEkle->execute([$SonEklenenUrunID,$GelenvaryantAdi4,$GelenStokAdedi4]);
                            $DorduncuVaryantKontrol = $DorduncuVaryantEkle->rowCount();
                            if($DorduncuVaryantKontrol<1){
                                header("location:index.php?SKD=0&SKI=98"); // hata 
                                exit();   
                            }
                        }
                        if(($GelenvaryantAdi5!="") and ($GelenStokAdedi5!="")){
                            $BesinciVaryantEkle = $db->prepare("INSERT INTO urunvaryantlari (urunId, varyantAdi, StokAdedi) VALUES (?, ?, ?)");
                            $BesinciVaryantEkle->execute([$SonEklenenUrunID,$GelenvaryantAdi5,$GelenStokAdedi5]);
                            $BesinciVaryantKontrol = $BesinciVaryantEkle->rowCount();
                            if($BesinciVaryantKontrol<1){
                                header("location:index.php?SKD=0&SKI=98"); // hata 
                                exit();   
                            }
                        }
                        
                            if (($GelenurunResmiIki["name"] != "") and ($GelenurunResmiIki["type"] != "") and ($GelenurunResmiIki["tmp_name"] != "") and ($GelenurunResmiIki["error"] == 0) and ($GelenurunResmiIki["size"] > 0)) {
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
                                        $IkinciResimGuncelleSorgu->execute([$IkinciResimYeniDosyaAdi, $SonEklenenUrunID]);
                                        $IkinciResimGuncelleKontrol = $IkinciResimGuncelleSorgu->rowCount();
                                        if ($IkinciResimGuncelleKontrol < 1) {
                                            header("location:index.php?SKD=0&SKI=98"); // hata 
                                            exit();
                                        }
                                    } else {
                                        header("location:index.php?SKD=0&SKI=98"); // hata 
                                        exit();
                                    }
                                }
                            }
                            
                            if (($GelenUrunResmiUc["name"] != "") and ($GelenUrunResmiUc["type"] != "") and ($GelenUrunResmiUc["tmp_name"] != "") and ($GelenUrunResmiUc["error"] == 0) and ($GelenUrunResmiUc["size"] > 0)) {
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
                                        $UcuncuResimGuncelleSorgu->execute([$UcuncuResimYeniDosyaAdi, $SonEklenenUrunID]);
                                        $UcuncuResimGuncelleKontrol = $UcuncuResimGuncelleSorgu->rowCount();
                                        if ($UcuncuResimGuncelleKontrol < 1) {
                                            header("location:index.php?SKD=0&SKI=98"); // hata 
                                            exit();
                                        }
                                    } else {
                                        header("location:index.php?SKD=0&SKI=98"); // hata 
                                        exit();
                                    }
                                }
                            }
                            
                            if (($GelenUrunResmiDort["name"] != "") and ($GelenUrunResmiDort["type"] != "") and ($GelenUrunResmiDort["tmp_name"] != "") and ($GelenUrunResmiDort["error"] == 0) and ($GelenUrunResmiDort["size"] > 0)) {
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
                                        $DorduncuResimGuncelleSorgu->execute([$DorduncuResimYeniDosyaAdi, $SonEklenenUrunID]);
                                        $DorduncuResimGuncelleKontrol = $DorduncuResimGuncelleSorgu->rowCount();
                                        if ($DorduncuResimGuncelleKontrol < 1) {
                                            header("location:index.php?SKD=0&SKI=98"); // hata 
                                            exit();
                                        }
                                    } else {
                                        header("location:index.php?SKD=0&SKI=98"); // hata 
                                        exit();
                                    }
                                }
                            }
                            header("location:index.php?SKD=0&SKI=97"); // başarılı 
                            exit();  
                }else {
                    header("location:index.php?SKD=0&SKI=98"); // hata 
                    exit();  
                }
            }else {
                header("location:index.php?SKD=0&SKI=98"); // hata 
                exit();  
            }
            }
        }else {
            header("location:index.php?SKD=0&SKI=98"); // hata 
            exit(); 
        }
        }else {
            header("location:index.php?SKD=0&SKI=98"); // hata 
            exit(); 
        }
    }else {
        header("location:index.php?SKD=0&SKI=98"); // hata 
        exit(); 
    }
}else {
     header("location:index.php?SKD=1&SKI=0");
     exit();
}
?>