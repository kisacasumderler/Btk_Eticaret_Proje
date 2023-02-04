<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Site Ayarları
     </h1>
     <form action="index.php?SKD=0&SKI=2" method="post" enctype="multipart/form-data" class="FormClass flexColumnCenter gap1">
     <div class="formGrup">
               <label for="DolarKuru">Dolar Kuru</label>
               <input type="text" value="<?php echo $DolarKuru; ?>" name="DolarKuru" id="DolarKuru">
          </div>
     <div class="formGrup">
               <label for="EuroKuru">Euro Kuru</label>
               <input type="text" value="<?php echo $EuroKuru; ?>" name="EuroKuru" id="EuroKuru">
          </div>
          <div class="formGrup">
               <label for="SiteAdi">Site Adı</label>
               <input type="text" value="<?php echo $SiteAdi; ?>" name="SiteAdi" id="SiteAdi">
          </div>
          <div class="formGrup">
               <label for="SiteTitle">Site Title</label>
               <input type="text" value="<?php echo $SiteTitle; ?>" name="SiteTitle" id="SiteTitle">
          </div>
          <div class="formGrup">
               <label for="SiteAciklama">Site Açıklama</label>
               <input type="text" value="<?php echo $SiteDecscription; ?>" name="SiteAciklama" id="SiteAciklama">
          </div>
          <div class="formGrup">
               <label for="SiteKeywords">Site Keywords</label>
               <input type="text" value="<?php echo $SiteKeywords; ?>" name="SiteKeywords" id="SiteKeywords">
          </div>
          <div class="formGrup">
               <label for="SiteCopyrightMetni">Site Copyright Metni</label>
               <input type="text" value="<?php echo $SiteCopyrightMetni; ?>" name="SiteCopyrightMetni" id="SiteCopyrightMetni">
          </div>
          <div class="formGrup">
               <label for="SiteLogosu">Site Logosu</label>
               <input type="file" value="<?php echo $SiteLogosu; ?>" name="SiteLogosu" id="SiteLogosu">
          </div>
          <div class="formGrup">
               <label for="SiteEmailHostAdresi">Site email host adresi</label>
               <input type="text" value="<?php echo $SiteEmailHostAdresi; ?>" name="SiteEmailHostAdresi" id="SiteEmailHostAdresi">
          </div>
          <div class="formGrup">
               <label for="siteLinki">Site Linki </label>
               <input type="text" value="<?php echo $siteLinki; ?>" name="siteLinki" id="siteLinki">
          </div>
          <div class="formGrup">
               <label for="SiteEmailAdresi">Site email Adresi</label>
               <input type="text" value="<?php echo $SiteEmailAdresi; ?>" name="SiteEmailAdresi" id="SiteEmailAdresi">
          </div>
          <div class="formGrup">
               <label for="SiteEmailSifresi">Site email Şifresi</label>
               <input type="password" value="<?php echo $SiteEmailSifresi; ?>" name="SiteEmailSifresi" id="SiteEmailSifresi">
          </div>
          <div class="formGrup">
               <label for="FacebookLink">Site facebook link</label>
               <input type="text" value="<?php echo $FacebookLink; ?>" name="FacebookLink" id="FacebookLink">
          </div>
          <div class="formGrup">
               <label for="TwitterLink">Site twitter link</label>
               <input type="text" value="<?php echo $TwitterLink; ?>" name="TwitterLink" id="TwitterLink">
          </div>
          <div class="formGrup">
               <label for="LinkedinLink">Site Linkedin link</label>
               <input type="text" value="<?php echo $LinkedinLink; ?>" name="LinkedinLink" id="LinkedinLink">
          </div>
          <div class="formGrup">
               <label for="InstagramLink">Site Instagram link</label>
               <input type="text" value="<?php echo $InstagramLink; ?>" name="InstagramLink" id="InstagramLink">
          </div>
          <div class="formGrup">
               <label for="PinterestLink">Site Pinterest link</label>
               <input type="text" value="<?php echo $PinterestLink; ?>" name="PinterestLink" id="PinterestLink">
          </div>
          <div class="formGrup">
               <label for="YouTubeLink">Site Youtube link</label>
               <input type="text" value="<?php echo $YouTubeLink; ?>" name="YouTubeLink" id="YouTubeLink">
          </div>
          <div class="formGrup">
               <label for="ucretsizKargoBaraji">Ücretsiz Kargo Barajı</label>
               <input type="text" value="<?php echo $ucretsizKargoBaraji; ?>" name="ucretsizKargoBaraji" id="ucretsizKargoBaraji">
          </div>
          <div class="formGrup">
               <label for="ClientID">Client ID</label>
               <input type="text" value="<?php echo $ClientID; ?>" name="ClientID" id="ClientID">
          </div>
          <div class="formGrup">
               <label for="StoreKey">Store Key</label>
               <input type="text" value="<?php echo $StoreKey; ?>" name="StoreKey" id="StoreKey">
          </div>
          <div class="formGrup">
               <label for="ApiKullanicisi">API Adı</label>
               <input type="text" value="<?php echo $ApiKullanicisi; ?>" name="ApiKullanicisi" id="ApiKullanicisi">
          </div>
          <div class="formGrup">
               <label for="ApiSifresi">API Şifresi</label>
               <input type="text" value="<?php echo $ApiSifresi; ?>" name="ApiSifresi" id="ApiSifresi">
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