<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">
        Menü Ekle
    </h1>
    <form action="index.php?SKD=0&SKI=59" method="post" class="FormClass flexColumnCenter gap1">
        <div class="formGrup">
            <label for="urunTuru">Ürün Türü : </label>
            <select name="urunTuru" id="urunTuru">
                <option value="">Lütfen Seçiniz</option>
                <option value="Erkek Ayakkabısı">Erkek Ayakkabısı</option>
                <option value="Kadın Ayakkabısı">Kadın Ayakkabısı</option>
                <option value="Çocuk Ayakkabısı">Çocuk Ayakkabısı</option>
            </select>
        </div>
        <div class="formGrup">
            <label for="MenuAdi">Menü Adı : </label>
            <input name="MenuAdi" id="MenuAdi" />
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