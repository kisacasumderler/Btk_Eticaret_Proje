<?php 
if(isset($_SESSION["Yonetici"])){
    $KargolarSorgu = $db->prepare("SELECT * FROM kargofirmalari ORDER BY KargoFirmaAdi");
    $KargolarSorgu->execute();
    $Kargolar_KS = $KargolarSorgu->rowCount();
    $KargoKayitlar = $KargolarSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Kargo Ayarları</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=22" class="addBtn"> <span>+</span> Kargo Bilgisi Ekle</a>
</div>
<ul>
    <?php 
        if($Kargolar_KS>0){
    foreach($KargoKayitlar as $KargoValues){
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
        <div>
           <img src="../resimler/<?php echo DonusumleriGeriDondur($KargoValues["KargoFirmaLogo"]); ?>" alt="">
        </div>
        <div><span class="ListBaslik">Kargo Firma Adı : </span><span><?php echo DonusumleriGeriDondur($KargoValues["KargoFirmaAdi"]);?></span></div>
        </div>
        <div class="width25 flexColumnCenter gap1">
           <a href="index.php?SKD=0&SKI=26&ID=<?php echo DonusumleriGeriDondur($KargoValues["id"]); ?>" class="GuncelleBtn">Güncelle</a>
           <a href="index.php?SKD=0&SKI=30&ID=<?php echo DonusumleriGeriDondur($KargoValues["id"]); ?>" class="SilBtn">Sil</a>
        </div>
    </li>
        <?php
    }
}else {
    ?>
            <li>
                Sisteme kayıtlı kargo bilgisi bulunmamaktadır.
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