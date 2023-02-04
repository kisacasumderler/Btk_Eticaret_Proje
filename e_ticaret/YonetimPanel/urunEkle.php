<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">
        Ürün Ekle
    </h1>
    <form action="index.php?SKD=0&SKI=96" method="post" enctype="multipart/form-data"
        class="FormClass flexColumnCenter gap1">
        <div class="formGrup">
            <label for="urunAdi">Ürün Adı</label>
            <input type="text" name="urunAdi" id="urunAdi">
        </div>
        <div class="formGrup">
            <label for="MenuID">Kategori</label>
            <select name="MenuID" id="MenuID">
                <option value="">Lütfen Seçiniz</option>
                <?php
                $menulerSorgu = $db->prepare("SELECT * FROM menuler ORDER BY urunTuru ASC, MenuAdi ASC");
                $menulerSorgu->execute();
                $menu_Kayitlar = $menulerSorgu->fetchAll(PDO::FETCH_ASSOC);
                foreach($menu_Kayitlar as $values){
                    ?>
                <option value="<?php echo DonusumleriGeriDondur($values["id"]);?>">
                    <?php echo DonusumleriGeriDondur($values["MenuAdi"]);?> /
                    <?php echo DonusumleriGeriDondur($values["urunTuru"]);?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="formGrup">
            <label for="urunFiyati">Fiyat</label>
            <input type="text" name="urunFiyati" id="urunFiyati">
        </div>
        <div class="formGrup">
            <label for="paraBirimi">Para Birimi</label>
            <select type="text" name="paraBirimi" id="paraBirimi">
                <option value="">Lütfen Seçiniz</option>
                <option value="TRY">Türk Lirası</option>
                <option value="USD">Amerikan Doları</option>
                <option value="EUR">Euro</option>
            </select>
        </div>
        <div class="formGrup">
            <label for="KdvOrani">KDV Oranı</label>
            <input type="text" name="KdvOrani" id="KdvOrani">
        </div>
        <div class="formGrup">
            <label for="kargoUcreti">Kargo Ücreti</label>
            <input type="text" name="kargoUcreti" id="kargoUcreti">
        </div>
        <div class="formGrup">
            <label for="urunAciklamasi">Ürün Açıklaması</label>
            <textarea type="text" name="urunAciklamasi" id="urunAciklamasi"></textarea>
        </div>
        <div class="formGrup">
            <label for="varyantBasligi">Varyant Başlığı</label>
            <input type="text" name="varyantBasligi" id="varyantBasligi" />
        </div>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi" class="width100">1. Varyant Adı</label>
            <input type="text" name="varyantAdi" id="varyantAdi" class="width100" />
            <label for="StokAdedi" class="width100">1. Stok Adedi</label>
            <input type="text" name="StokAdedi" id="StokAdedi" class="width100" />
        </div>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi2" class="width100">2. Varyant Adı</label>
            <input type="text" name="varyantAdi2" id="varyantAdi2" class="width100" />
            <label for="StokAdedi2" class="width100">2. Stok Adedi</label>
            <input type="text" name="StokAdedi2" id="StokAdedi2" class="width100" />
        </div>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi3" class="width100">3. Varyant Adı</label>
            <input type="text" name="varyantAdi3" id="varyantAdi3" class="width100" />
            <label for="StokAdedi3" class="width100">3. Stok Adedi</label>
            <input type="text" name="StokAdedi3" id="StokAdedi3" class="width100" />
        </div>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi4" class="width100">4. Varyant Adı</label>
            <input type="text" name="varyantAdi4" id="varyantAdi4" class="width100" />
            <label for="StokAdedi4" class="width100">4. Stok Adedi</label>
            <input type="text" name="StokAdedi4" id="StokAdedi4" class="width100" />
        </div>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi5" class="width100">5. Varyant Adı</label>
            <input type="text" name="varyantAdi5" id="varyantAdi5" class="width100" />
            <label for="StokAdedi5" class="width100">5. Stok Adedi</label>
            <input type="text" name="StokAdedi5" id="StokAdedi5" class="width100" />
        </div>
        <div class="formGrup">
            <label for="urunResmiBir">Resim 1</label>
            <input type="file" name="urunResmiBir" id="urunResmiBir">
        </div>
        <div class="formGrup">
            <label for="urunResmiIki">Resim 2</label>
            <input type="file" name="urunResmiIki" id="urunResmiIki">
        </div>
        <div class="formGrup">
            <label for="UrunResmiUc">Resim 3</label>
            <input type="file" name="UrunResmiUc" id="UrunResmiUc">
        </div>
        <div class="formGrup">
            <label for="UrunResmiDort">Resim 4</label>
            <input type="file" name="UrunResmiDort" id="UrunResmiDort">
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