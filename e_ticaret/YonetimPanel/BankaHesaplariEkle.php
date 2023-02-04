<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Site Ayarları
     </h1>
     <form action="index.php?SKD=0&SKI=11" method="post" enctype="multipart/form-data" class="FormClass flexColumnCenter gap1">
     <div class="formGrup">
               <label for="bankaAdi">Banka Adı</label>
               <input type="text" name="bankaAdi" id="bankaAdi">
          </div>
     <div class="formGrup">
               <label for="KonumSehir">Konum Şehir</label>
               <input type="text" name="KonumSehir" id="KonumSehir">
          </div>
          <div class="formGrup">
               <label for="KonumUlke">Konum Ülke</label>
               <input type="text" name="KonumUlke" id="KonumUlke">
          </div>
          <div class="formGrup">
               <label for="SubeAdi">Şube Adı</label>
               <input type="text" name="SubeAdi" id="SubeAdi">
          </div>
          <div class="formGrup">
               <label for="SubeKodu">Şube Kodu</label>
               <input type="text" name="SubeKodu" id="SubeKodu">
          </div>
          <div class="formGrup">
               <label for="ParaBirimi">Para Birimi</label>
               <input type="text" name="ParaBirimi" id="ParaBirimi">
          </div>
          <div class="formGrup">
               <label for="HesapSahibi">Hesap sahibi</label>
               <input type="text" name="HesapSahibi" id="HesapSahibi">
          </div>
          <div class="formGrup">
               <label for="HesapNumarasi">Hesap Numarası</label>
               <input type="text" name="HesapNumarasi" id="HesapNumarasi">
          </div>
          <div class="formGrup">
               <label for="IbanNumarasi">Iban Numarası</label>
               <input type="text" name="IbanNumarasi" id="IbanNumarasi">
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
     header("location:index.php?SKD=1");
     exit();
}
?>