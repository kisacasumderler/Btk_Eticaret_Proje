<?php 
if(isset($_SESSION["Yonetici"])){
    $BannerlarSorgu = $db->prepare("SELECT * FROM bannerlar ORDER BY id DESC");
    $BannerlarSorgu->execute();
    $Bannerlar_KS = $BannerlarSorgu->rowCount();
    $BannerKayitlar = $BannerlarSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Banner Ayarları</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=34" class="addBtn"> <span>+</span> Banner Ekle</a>
</div>
<ul>
    <?php 
        if($Bannerlar_KS>0){
    foreach($BannerKayitlar as $BannerValues){
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
        <div>
           <img src="../resimler/Bannerlar/<?php echo DonusumleriGeriDondur($BannerValues["BannerResmi"]); ?>" alt="" class="BannerImg">
        </div>
        <div><span class="ListBaslik">Banner Adı : </span><span><?php echo DonusumleriGeriDondur($BannerValues["bannerAdi"]);?></span></div>
        <div><span class="ListBaslik">Banner alanı Adı : </span><span><?php echo DonusumleriGeriDondur($BannerValues["bannerAlani"]);?></span></div>
        <div><span class="ListBaslik">Banner Gösterim Sayısı : </span><span><?php echo DonusumleriGeriDondur($BannerValues["GosterimSayisi"]);?></span></div>
        </div>
        <div class="width25 flexColumnCenter gap1">
           <a href="index.php?SKD=0&SKI=38&ID=<?php echo DonusumleriGeriDondur($BannerValues["id"]); ?>" class="GuncelleBtn">Güncelle</a>
           <a href="index.php?SKD=0&SKI=42&ID=<?php echo DonusumleriGeriDondur($BannerValues["id"]); ?>" class="SilBtn">Sil</a>
        </div>
    </li>
        <?php
    }
}else {
    ?>
            <li>
               Kayıtlı banner bulunmamaktadır.
            </li>
    <?php
}
    ?>

</ul>
<?php
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>