<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $menulerGuncelleSorgu = $db->prepare("SELECT * FROM menuler WHERE id=?");
    $menulerGuncelleSorgu->execute([$GelenID]);
    $menuGuncelle_KS = $menulerGuncelleSorgu->rowCount();
    $menuGuncelleKayit = $menulerGuncelleSorgu->fetch(PDO::FETCH_ASSOC);

    if($menuGuncelle_KS>0){
?>
<div class="SiteBg">
     <h1 class="SiteBaslik">
          Menü Güncelle
     </h1>
     <form action="index.php?SKD=0&SKI=63" method="post" class="FormClass flexColumnCenter gap1">
     <input type="hidden" name="menuID" id="menuID" value="<?php echo DonusumleriGeriDondur($menuGuncelleKayit["id"]); ?>"> 
     <div class="formGrup">
            <label for="urunTuru">Ürün Türü : </label>
            <select name="urunTuru" id="urunTuru">
                <option value="">Lütfen Seçiniz</option>
                <option value="Erkek Ayakkabısı" <?php if ($menuGuncelleKayit["urunTuru"] == "Erkek Ayakkabısı") {echo "selected"; } ?>>Erkek Ayakkabısı</option>
                <option value="Kadın Ayakkabısı" <?php if ($menuGuncelleKayit["urunTuru"] == "Kadın Ayakkabısı") {echo "selected"; } ?> >Kadın Ayakkabısı</option>
                <option value="Çocuk Ayakkabısı" <?php if ($menuGuncelleKayit["urunTuru"] == "Çocuk Ayakkabısı") {echo "selected"; } ?> >Çocuk Ayakkabısı</option>
            </select>
        </div>
        <div class="formGrup">
            <label for="MenuAdi">Menü Adı : </label>
            <input name="MenuAdi" id="MenuAdi" value="<?php echo $menuGuncelleKayit["MenuAdi"]; ?>" />
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
        header("location:index.php?SKD=0&SKI=65");
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>
