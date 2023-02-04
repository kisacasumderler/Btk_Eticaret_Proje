<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    $YoneticiGuncelleSorgu = $db->prepare("SELECT * FROM yoneticiler WHERE id=?");
    $YoneticiGuncelleSorgu->execute([$GelenID]);
    $YoneticiGuncelle_KS = $YoneticiGuncelleSorgu->rowCount();
    $YoneticilerKayit = $YoneticiGuncelleSorgu->fetch(PDO::FETCH_ASSOC);

    if($YoneticiGuncelle_KS>0){
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">
        Yönetici Güncelle
    </h1>
    <form action="index.php?SKD=0&SKI=75" method="post" enctype="multipart/form-data"
        class="FormClass flexColumnCenter gap1">
        <input type="hidden" name="YoneticiID" id="YoneticiID"
            value="<?php echo DonusumleriGeriDondur($YoneticilerKayit["id"]); ?>">
        <div class="formGrup">
            <label for="kullaniciAdi">Kullanıcı Adı</label>
            <input type="text" name="kullaniciAdi" id="kullaniciAdi" value="<?php echo DonusumleriGeriDondur($YoneticilerKayit["kullaniciAdi"]); ?>" disabled>
        </div>
        <div class="formGrup">
            <label for="isimSoyisim">İsim Soyisim</label>
            <input type="text" name="isimSoyisim" id="isimSoyisim" value="<?php echo DonusumleriGeriDondur($YoneticilerKayit["isimSoyisim"]); ?>">
        </div>
        <div class="formGrup">
            <label for="sifre">Şifre</label>
            <input type="text" name="sifre" id="sifre" placeholder="Şifre güncellenmek istenmiyorsa bu alan boş bırakılmalıdır.">
        </div>
        <div class="formGrup">
            <label for="telefonNumarasi">Telefon Numarası</label>
            <input type="tel" name="telefonNumarasi" id="telefonNumarasi" value="<?php echo DonusumleriGeriDondur($YoneticilerKayit["telefonNumarasi"]); ?>">
        </div>
        <div class="formGrup">
            <label for="emailAdres">Email </label>
            <input type="email" name="emailAdres" id="emailAdres" value="<?php echo DonusumleriGeriDondur($YoneticilerKayit["emailAdres"]); ?>">
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