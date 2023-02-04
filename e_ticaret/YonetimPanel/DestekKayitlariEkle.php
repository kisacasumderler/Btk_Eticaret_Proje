<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
         Destek Kaydı Ekle 
     </h1>
     <form action="index.php?SKD=0&SKI=47" method="post" class="FormClass flexColumnCenter gap1">
     <div class="formGrup">
               <label for="soru">Soru : </label>
               <textarea name="soru" id="soru" cols="30" rows="5"></textarea>
          </div>
          <div class="formGrup">
               <label for="cevap">Cevap : </label>
               <textarea name="cevap" id="cevap" cols="30" rows="5"></textarea>
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