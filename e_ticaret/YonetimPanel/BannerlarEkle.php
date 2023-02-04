<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Banner Ekle
     </h1>
     <form action="index.php?SKD=0&SKI=35" method="post" enctype="multipart/form-data" class="FormClass flexColumnCenter gap1">
     <div class="formGrup">
               <label for="bannerAdi">Banner Adı</label>
               <input type="text" name="bannerAdi" id="bannerAdi">
          </div>
          <div class="formGrup">
               <label for="bannerAlani">Banner Alanı</label>
               <select name="bannerAlani" id="bannerAlani">
               <option value="">Lütfen Seçiniz</option>
                <option value="Menu Altı">Menu Altı</option>
                <option value="Ana Sayfa">Ana Sayfa</option>
                <option value="Anasayfa Kategoriler">Anasayfa Kategoriler</option>
                <option value="Anasayfa Kategoriler Mobil">Anasayfa Kategoriler Mobil</option>
                <option value="Anasayfa Mobil">Anasayfa Mobil</option>
                <option value="IndexUst">Anasayfa Üst</option>
               </select>
          </div>
          <div class="formGrup">
               <label for="BannerResmi">Banner Resmi</label>
               <input type="file" name="BannerResmi" id="BannerResmi">
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