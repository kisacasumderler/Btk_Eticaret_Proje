<?php 
if(isset($_SESSION["Yonetici"])){
    $DestekKayitlarSorgu = $db->prepare("SELECT * FROM sorular ORDER BY soru ASC");
    $DestekKayitlarSorgu->execute();
    $Destek_KS = $DestekKayitlarSorgu->rowCount();
    $DestekKayitlar = $DestekKayitlarSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Destek Kayıtları Ayarları</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=46" class="addBtn"> <span>+</span> Destek kaydı Ekle</a>
</div>
<ul>
    <?php 
        if($Destek_KS>0){
    foreach($DestekKayitlar as $DestekValues){
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
        <div><span class="ListBaslik" style="font-size : 1.2rem;"><?php echo DonusumleriGeriDondur($DestekValues["soru"]);?></span></div>
        <div><span><?php echo DonusumleriGeriDondur($DestekValues["cevap"]);?></span></div>
        </div>
        <div class="width25 flexColumnCenter gap1">
           <a href="index.php?SKD=0&SKI=50&ID=<?php echo DonusumleriGeriDondur($DestekValues["id"]); ?>" class="GuncelleBtn">Güncelle</a>
           <a href="index.php?SKD=0&SKI=54&ID=<?php echo DonusumleriGeriDondur($DestekValues["id"]); ?>" class="SilBtn">Sil</a>
        </div>
    </li>
        <?php
    }
}else {
    ?>
            <li>
                Sisteme kayıtlı destek kaydı soru/cevap bulunmamaktadır. 
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