<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $KargoFirmaGuncelleSorgu = $db->prepare("SELECT * FROM kargofirmalari WHERE id=?");
    $KargoFirmaGuncelleSorgu->execute([$GelenID]);
    $KargoFirmaGuncelle_KS = $KargoFirmaGuncelleSorgu->rowCount();
    $KargoFirmaGuncelleKayit = $KargoFirmaGuncelleSorgu->fetch(PDO::FETCH_ASSOC);

    if($KargoFirmaGuncelle_KS>0){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Kargo Firma Ayarları
     </h1>
     <form action="index.php?SKD=0&SKI=27" method="post" enctype="multipart/form-data" class="FormClass flexColumnCenter gap1">
     <input type="hidden" name="KargoID" id="KargoID" value="<?php echo DonusumleriGeriDondur($KargoFirmaGuncelleKayit["id"]) ?>"> 
     <div class="formGrup">
               <label for="KargoFirmaAdi">Kargo Firma Adı</label>
               <input type="text" name="KargoFirmaAdi" id="KargoFirmaAdi" value="<?php echo DonusumleriGeriDondur($KargoFirmaGuncelleKayit["KargoFirmaAdi"]) ?>"> 
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
        header("location:index.php?SKD=0&SKI=29");
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>