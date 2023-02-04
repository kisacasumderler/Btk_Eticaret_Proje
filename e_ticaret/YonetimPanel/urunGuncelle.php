<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $UrunGuncelleSorgu = $db->prepare("SELECT * FROM urunler WHERE id=?");
    $UrunGuncelleSorgu->execute([$GelenID]);
    $UrunGuncelleKontrol = $UrunGuncelleSorgu->rowCount();
    $UrunKayit = $UrunGuncelleSorgu->fetch(PDO::FETCH_ASSOC);
    if($UrunGuncelleKontrol>0){

        $urunTuru = DonusumleriGeriDondur($UrunKayit["urunTuru"]);

        if($urunTuru=="Erkek Ayakkabısı"){
            $ResimDosyaKlasor = "Erkek";
        }elseif($urunTuru=="Kadın Ayakkabısı"){
            $ResimDosyaKlasor = "Kadin";
        }else {
            $ResimDosyaKlasor = "Cocuk";
        }
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">
        Ürün Güncelle
    </h1>
    <form action="index.php?SKD=0&SKI=100&UrunID=<?php echo $GelenID; ?>" method="post" enctype="multipart/form-data"
        class="FormClass flexColumnCenter gap1">
        <div class="flexRowCenter imgGroup">
            <?php
            if(DonusumleriGeriDondur($UrunKayit["urunResmiBir"])!=""){
                ?>
            <img src="../resimler/UrunResimleri/<?php echo $ResimDosyaKlasor."/".DonusumleriGeriDondur($UrunKayit["urunResmiBir"]); ?>"
                alt="">
            <?php
            }

            if(DonusumleriGeriDondur($UrunKayit["urunResmiIki"])!=""){
                ?>
            <img src="../resimler/UrunResimleri/<?php echo $ResimDosyaKlasor."/".DonusumleriGeriDondur($UrunKayit["urunResmiIki"]); ?>"
                alt="">
            <?php
            }

            if(DonusumleriGeriDondur($UrunKayit["UrunResmiUc"])!=""){
                ?>
            <img src="../resimler/UrunResimleri/<?php echo $ResimDosyaKlasor."/".DonusumleriGeriDondur($UrunKayit["UrunResmiUc"]); ?>"
                alt="">
            <?php
            }

            if(DonusumleriGeriDondur($UrunKayit["UrunResmiDort"])!=""){
                ?>
            <img src="../resimler/UrunResimleri/<?php echo $ResimDosyaKlasor."/".DonusumleriGeriDondur($UrunKayit["UrunResmiDort"]); ?>"
                alt="">
            <?php
            }
            ?>
        </div>
        <div class="formGrup">
            <label for="urunAdi">Ürün Adı</label>
            <input type="text" name="urunAdi" id="urunAdi"
                value="<?php echo DonusumleriGeriDondur($UrunKayit["urunAdi"]); ?>">
        </div>
        <div class="formGrup">
            <label for="MenuID">Kategori</label>
            <select name="MenuID" id="MenuID">
                <option value="">Lütfen Seçiniz</option>
                <?php
                $menulerSorgu = $db->prepare("SELECT * FROM menuler WHERE urunTuru=? ORDER BY urunTuru ASC, MenuAdi ASC");
                $menulerSorgu->execute([DonusumleriGeriDondur($UrunKayit["urunTuru"])]);
                $menu_Kayitlar = $menulerSorgu->fetchAll(PDO::FETCH_ASSOC);
                foreach($menu_Kayitlar as $values){
                    ?>
                <option value="<?php echo DonusumleriGeriDondur($values["id"]);?>"
                    <?php if ((DonusumleriGeriDondur($UrunKayit["MenuId"]) == DonusumleriGeriDondur($values["id"]))) { echo "selected"; } ?>>
                    <?php echo DonusumleriGeriDondur($values["MenuAdi"]);?> /
                    <?php echo DonusumleriGeriDondur($values["urunTuru"]);?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="formGrup">
            <label for="urunFiyati">Fiyat</label>
            <input type="text" name="urunFiyati" id="urunFiyati"
                value="<?php echo DonusumleriGeriDondur($UrunKayit["urunFiyati"]); ?>">
        </div>
        <div class="formGrup">
            <label for="paraBirimi">Para Birimi</label>
            <select type="text" name="paraBirimi" id="paraBirimi">
                <option value="">Lütfen Seçiniz</option>
                <option value="TRY"
                    <?php if(DonusumleriGeriDondur($UrunKayit["paraBirimi"])=="TRY"){echo "selected"; } ?>>Türk Lirası
                </option>
                <option value="USD"
                    <?php if(DonusumleriGeriDondur($UrunKayit["paraBirimi"])=="USD"){echo "selected"; } ?>>Amerikan
                    Doları</option>
                <option value="EUR"
                    <?php if(DonusumleriGeriDondur($UrunKayit["paraBirimi"])=="EUR"){echo "selected"; } ?>>Euro</option>
            </select>
        </div>
        <div class="formGrup">
            <label for="KdvOrani">KDV Oranı</label>
            <input type="text" name="KdvOrani" id="KdvOrani"
                value="<?php echo DonusumleriGeriDondur($UrunKayit["KdvOrani"]); ?>">
        </div>
        <div class="formGrup">
            <label for="kargoUcreti">Kargo Ücreti</label>
            <input type="text" name="kargoUcreti" id="kargoUcreti"
                value="<?php echo DonusumleriGeriDondur($UrunKayit["kargoUcreti"]); ?>">
        </div>
        <div class="formGrup">
            <label for="urunAciklamasi">Ürün Açıklaması</label>
            <textarea type="text" name="urunAciklamasi" id="urunAciklamasi">
            <?php echo DonusumleriGeriDondur($UrunKayit["urunAciklamasi"]); ?>
            </textarea>
        </div>
        <div class="formGrup">
            <label for="varyantBasligi">Varyant Başlığı</label>
            <input type="text" name="varyantBasligi" id="varyantBasligi"
                value="<?php echo DonusumleriGeriDondur($UrunKayit["varyantBasligi"]); ?>" />
        </div>
        <?php 
            $varyantlarSorgu = $db->prepare("SELECT * FROM urunvaryantlari WHERE urunId=?");
            $varyantlarSorgu->execute([$GelenID]);
            $varyantkarKS = $varyantlarSorgu->rowCount();
            $varyantKayitlar = $varyantlarSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($varyantkarKS>0){
            $Sayi = 0;
                foreach($varyantKayitlar as $varyantValues){
                $Sayi++;
                ?>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi<?php echo $Sayi; ?>" class="width100"><?php echo $Sayi; ?>. Varyant Adı</label>
            <input type="text" name="varyantAdi<?php echo $Sayi; ?>" id="varyantAdi<?php echo $Sayi; ?>"
                class="width100" value="<?php echo DonusumleriGeriDondur($varyantValues["varyantAdi"])?>" />
            <label for="StokAdedi<?php echo $Sayi; ?>" class="width100"><?php echo $Sayi; ?>. Stok Adedi</label>
            <input type="text" name="StokAdedi<?php echo $Sayi; ?>" id="StokAdedi<?php echo $Sayi; ?>" class="width100"
                value="<?php echo DonusumleriGeriDondur($varyantValues["StokAdedi"])?>" />
        </div>
        <?php
                }
            $i = $varyantkarKS+1;
            for ($i; $i <= 5; $i++){
                ?>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi<?php echo $i; ?>" class="width100"><?php echo $i; ?>. Varyant Adı</label>
            <input type="text" name="varyantAdi<?php echo $i; ?>" id="varyantAdi<?php echo $i; ?>" class="width100" />
            <label for="StokAdedi<?php echo $i; ?>" class="width100"><?php echo $i; ?>. Stok Adedi</label>
            <input type="text" name="StokAdedi<?php echo $i; ?>" id="StokAdedi<?php echo $i; ?>" class="width100" />
        </div>
        <?php
            }
            }else {
                for($i=1; $i<=5; $i++){
                    ?>
        <div class="flexRowCenter width100 formCokluGrup">
            <label for="varyantAdi<?php echo $i; ?>" class="width100"><?php echo $i; ?>. Varyant Adı</label>
            <input type="text" name="varyantAdi<?php echo $i; ?>" id="varyantAdi<?php echo $i; ?>" class="width100" />
            <label for="StokAdedi<?php echo $i; ?>" class="width100"><?php echo $i; ?>. Stok Adedi</label>
            <input type="text" name="StokAdedi<?php echo $i; ?>" id="StokAdedi<?php echo $i; ?>" class="width100" />
        </div>
        <?php
                }
                ?>
        <?php
            }
        ?>
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
    header("location:index.php?SKD=0&SKI=102");
    exit();
 }
}else {
     header("location:index.php?SKD=1");
     exit();
}
?>