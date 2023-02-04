<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          yönetici Kaydı Ekle
     </h1>
     <form action="index.php?SKD=0&SKI=71" method="post" class="FormClass flexColumnCenter gap1">
     <div class="formGrup">
               <label for="kullaniciAdi">Kullanıcı Adı</label>
               <input type="text" name="kullaniciAdi" id="kullaniciAdi">
          </div>
     <div class="formGrup">
               <label for="isimSoyisim">İsim Soyisim</label>
               <input type="text" name="isimSoyisim" id="isimSoyisim">
          </div>
          <div class="formGrup">
               <label for="sifre">Şifre</label>
               <input type="text" name="sifre" id="sifre">
          </div>
          <div class="formGrup">
               <label for="telefonNumarasi">Telefon Numarası</label>
               <input type="tel" name="telefonNumarasi" id="telefonNumarasi">
          </div>
          <div class="formGrup">
               <label for="emailAdres">Email </label>
               <input type="email" name="emailAdres" id="emailAdres">
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