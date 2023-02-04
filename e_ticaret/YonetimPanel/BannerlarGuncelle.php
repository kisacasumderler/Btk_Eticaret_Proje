<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $BannerGuncelleSorgu = $db->prepare("SELECT * FROM bannerlar WHERE id=?");
    $BannerGuncelleSorgu->execute([$GelenID]);
    $BannerGuncelle_KS = $BannerGuncelleSorgu->rowCount();
    $BannerGuncelleKayit = $BannerGuncelleSorgu->fetch(PDO::FETCH_ASSOC);

    if($BannerGuncelle_KS>0){
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">
        Banner Ayarları
    </h1>
    <ul class="width100">
        <li class="ListGrup flexRowStart" style="border : 1px solid transparent;">
            <div class="width100">
                <div class="flexColumnCenter width100">
                    <img src="../resimler/Bannerlar/<?php echo DonusumleriGeriDondur($BannerGuncelleKayit["BannerResmi"]); ?>"
                        alt="" class="BannerImg">
                </div>
            </div>
        </li>
    </ul>
    <form action="index.php?SKD=0&SKI=39" method="post" enctype="multipart/form-data"
        class="FormClass flexColumnCenter gap1">
        <input type="hidden" name="BannerID" id="BannerID"
            value="<?php echo DonusumleriGeriDondur($BannerGuncelleKayit["id"]) ?>">
        <div class="formGrup">
            <label for="bannerAdi">Banner Adı</label>
            <input type="text" name="bannerAdi" id="bannerAdi"
                value="<?php echo DonusumleriGeriDondur($BannerGuncelleKayit["bannerAdi"]); ?>">
        </div>
        <div class="formGrup">
            <label for="BannerResmi">Banner Resmi</label>
            <input type="file" name="BannerResmi" id="BannerResmi"
                value="<?php echo DonusumleriGeriDondur($BannerGuncelleKayit["BannerResmi"]); ?>">
        </div>
        <div class="formGrup">
            <label for="bannerAlani">Banner Alanı</label>
            <select name="bannerAlani" id="bannerAlani">
                <option value="Menu Altı"
                    <?php if (DonusumleriGeriDondur($BannerGuncelleKayit["bannerAlani"]) == "Menu Altı") {echo "selected";}?>>
                    Menu Altı</option>
                <option value="Ana Sayfa"
                    <?php if (DonusumleriGeriDondur($BannerGuncelleKayit["bannerAlani"]) == "Ana Sayfa") {echo "selected";}?>>
                    Ana Sayfa</option>
                <option value="Anasayfa Kategoriler"
                    <?php if (DonusumleriGeriDondur($BannerGuncelleKayit["bannerAlani"]) == "Anasayfa Kategoriler") {echo "selected";}?>>
                    Anasayfa Kategoriler</option>
                    <option value="Anasayfa Kategoriler Mobil"
                    <?php if (DonusumleriGeriDondur($BannerGuncelleKayit["bannerAlani"]) == "Anasayfa Kategoriler Mobil") {echo "selected";}?>>
                    Anasayfa Kategoriler Mobil</option>
                    <option value="Anasayfa Mobil"
                    <?php if (DonusumleriGeriDondur($BannerGuncelleKayit["bannerAlani"]) == "Anasayfa Mobil") {echo "selected";}?>>
                    Anasayfa Mobil</option>
                    <option value="IndexUst"
                    <?php if (DonusumleriGeriDondur($BannerGuncelleKayit["bannerAlani"]) == "Anasayfa Üst") {echo "selected";}?>>
                    Anasayfa Üst</option>
            </select>
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
        header("location:index.php?SKD=0&SKI=41");
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>