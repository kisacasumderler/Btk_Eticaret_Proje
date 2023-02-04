<?php 
if(isset($_SESSION["Yonetici"])){
    $menulerSorgu = $db->prepare("SELECT * FROM menuler ORDER BY MenuAdi ASC");
    $menulerSorgu->execute();
    $menu_KS = $menulerSorgu->rowCount();
    $menu_kayit = $menulerSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Menü Ayarları</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=58" class="addBtn"> <span>+</span> Menü Ekle</a>
</div>
<ul>
    <?php 
        if($menu_KS>0){
    foreach($menu_kayit as $menuValues){
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
            <div><span class="ListBaslik"
                    style="font-size : 1.2rem;"><?php echo DonusumleriGeriDondur($menuValues["urunTuru"]);?></span>
            </div>
            <div><span><?php echo DonusumleriGeriDondur($menuValues["MenuAdi"]);?></span></div>
        </div>
        <div class="width25 flexColumnCenter gap1">
            <a href="index.php?SKD=0&SKI=62&ID=<?php echo DonusumleriGeriDondur($menuValues["id"]); ?>"
                class="GuncelleBtn">Güncelle</a>
            <a href="index.php?SKD=0&SKI=66&ID=<?php echo DonusumleriGeriDondur($menuValues["id"]); ?>"
                class="SilBtn">Sil</a>
        </div>
    </li>
    <?php
    }
}else {
    ?>
    <li>
        Sisteme kayıtlı menü bulunmamaktadır.
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