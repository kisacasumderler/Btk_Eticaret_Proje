<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $DestekGuncelleSorgu = $db->prepare("SELECT * FROM sorular WHERE id=?");
    $DestekGuncelleSorgu->execute([$GelenID]);
    $DestekGuncelle_KS = $DestekGuncelleSorgu->rowCount();
    $DestekGuncelle_Kayit = $DestekGuncelleSorgu->fetch(PDO::FETCH_ASSOC);

    if($DestekGuncelle_KS>0){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Kargo Firma Ayarları
     </h1>
     <form action="index.php?SKD=0&SKI=51" method="post" class="FormClass flexColumnCenter gap1">
     <input type="hidden" name="DestekID" id="DestekID" value="<?php echo DonusumleriGeriDondur($DestekGuncelle_Kayit["id"]); ?>"> 
     <div class="formGrup">
               <label for="soru">Soru : </label>
               <textarea name="soru" id="soru" cols="30" rows="5">
                <?php echo DonusumleriGeriDondur($DestekGuncelle_Kayit["soru"]); ?>
               </textarea>
          </div>
          <div class="formGrup">
               <label for="cevap">Cevap : </label>
               <textarea name="cevap" id="cevap" cols="30" rows="5">
                <?php echo DonusumleriGeriDondur($DestekGuncelle_Kayit["cevap"]); ?>
               </textarea>
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
        header("location:index.php?SKD=0&SKI=53");
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>