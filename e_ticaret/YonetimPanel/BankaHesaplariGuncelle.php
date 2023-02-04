<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $BankaGuncelleSorgu = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id=?");
    $BankaGuncelleSorgu->execute([$GelenID]);
    $BankaGuncellKayitSayi = $BankaGuncelleSorgu->rowCount();
    $BankaGuncelleKayit = $BankaGuncelleSorgu->fetch(PDO::FETCH_ASSOC);

    if($BankaGuncellKayitSayi>0){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Site Ayarları
     </h1>
     <form action="index.php?SKD=0&SKI=15" method="post" enctype="multipart/form-data" class="FormClass flexColumnCenter gap1">
     <input type="hidden" name="bankaID" id="bankaID" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["id"]) ?>"> 
     <div class="formGrup">
               <label for="bankaAdi">Banka Adı</label>
               <input type="text" name="bankaAdi" id="bankaAdi" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["bankaAdi"]) ?>"> 
          </div>
     <div class="formGrup">
               <label for="KonumSehir">Konum Şehir</label>
               <input type="text" name="KonumSehir" id="KonumSehir" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["KonumSehir"]) ?>">
          </div>
          <div class="formGrup">
               <label for="KonumUlke">Konum Ülke</label>
               <input type="text" name="KonumUlke" id="KonumUlke" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["KonumUlke"]) ?>">
          </div>
          <div class="formGrup">
               <label for="SubeAdi">Şube Adı</label>
               <input type="text" name="SubeAdi" id="SubeAdi" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["SubeAdi"]) ?>">
          </div>
          <div class="formGrup">
               <label for="SubeKodu">Şube Kodu</label>
               <input type="text" name="SubeKodu" id="SubeKodu" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["SubeKodu"]) ?>">
          </div>
          <div class="formGrup">
               <label for="ParaBirimi">Para Birimi</label>
               <input type="text" name="ParaBirimi" id="ParaBirimi" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["ParaBirimi"]) ?>">
          </div>
          <div class="formGrup">
               <label for="HesapSahibi">Hesap sahibi</label>
               <input type="text" name="HesapSahibi" id="HesapSahibi" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["HesapSahibi"]) ?>">
          </div>
          <div class="formGrup">
               <label for="HesapNumarasi">Hesap Numarası</label>
               <input type="text" name="HesapNumarasi" id="HesapNumarasi" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["HesapNumarasi"]) ?>">
          </div>
          <div class="formGrup">
               <label for="IbanNumarasi">Iban Numarası</label>
               <input type="text" name="IbanNumarasi" id="IbanNumarasi" value="<?php echo DonusumleriGeriDondur($BankaGuncelleKayit["IbanNumarasi"]) ?>">
          </div>
          <div class="formGrup">
               <label for="BankLogo">Banka Logosu</label>
               <input type="file" name="BankLogo" id="BankLogo">
          </div>
          
          <div class="formGrup">
               <button>
                    Kaydet
               </button>
          </div>
     </form>
</div>
<?php 
    }else {
        header("location:index.php?SKD=0&SKI=17");
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>