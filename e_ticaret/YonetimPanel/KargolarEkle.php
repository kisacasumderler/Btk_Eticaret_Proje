<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Site Ayarları
     </h1>
     <form action="index.php?SKD=0&SKI=23" method="post" enctype="multipart/form-data" class="FormClass flexColumnCenter gap1">
     <div class="formGrup">
               <label for="KargoFirmaAdi">Kargo Firma Adı</label>
               <input type="text" name="KargoFirmaAdi" id="KargoFirmaAdi">
          </div>
          <div class="formGrup">
               <label for="KargoFirmaLogo">Kargo Firma Logosu</label>
               <input type="file" name="KargoFirmaLogo" id="KargoFirmaLogo">
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