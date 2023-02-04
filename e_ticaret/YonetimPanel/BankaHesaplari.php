<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Banka Hesap Ayarları</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=10" class="addBtn"> <span>+</span> Banka Hesabı Ekle</a>
</div>
<ul>
    <?php 
    if($B_KayitSayisi>0){
    foreach($B_Kayitlar as $BankaValues){
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
        <div>
           <img src="../resimler/<?php echo DonusumleriGeriDondur($BankaValues["BankLogo"]); ?>" alt="">
        </div>
        <div><span class="ListBaslik">Banka Adı : </span><span><?php echo DonusumleriGeriDondur($BankaValues["bankaAdi"]);?></span></div>
        <div><?php echo DonusumleriGeriDondur($BankaValues["KonumSehir"]); ?> / <?php echo DonusumleriGeriDondur($BankaValues["KonumUlke"]); ?> </div>
        <div><span class="ListBaslik">şube adı :</span><span><?php echo DonusumleriGeriDondur($BankaValues["SubeAdi"]); ?></span> </div>
        <div><span class="ListBaslik">şube kodu :</span> <span><?php echo DonusumleriGeriDondur($BankaValues["SubeKodu"]); ?></span> </div>
        <div><span class="ListBaslik"> para birimi: </span><span><?php echo DonusumleriGeriDondur($BankaValues["ParaBirimi"]); ?></span> </div>
        <div><span class="ListBaslik">Hesap Sahibi: </span> <span><?php echo DonusumleriGeriDondur($BankaValues["HesapSahibi"]); ?></span></div>
        <div><span class="ListBaslik">Hesap Numarası: </span> <span><?php echo DonusumleriGeriDondur($BankaValues["HesapNumarasi"]); ?></span></div>
        <div><span class="ListBaslik">iban Numarası: </span> <span><?php echo DonusumleriGeriDondur($BankaValues["IbanNumarasi"]); ?></span></div>
        </div>
        <div class="width25 flexColumnCenter gap1">
           <a href="index.php?SKD=0&SKI=14&ID=<?php echo DonusumleriGeriDondur($BankaValues["id"]); ?>" class="GuncelleBtn">Güncelle</a>
           <a href="index.php?SKD=0&SKI=18&ID=<?php echo DonusumleriGeriDondur($BankaValues["id"]); ?>" class="SilBtn">Sil</a>
        </div>
    </li>
        <?php
    }
}else {
    ?>
    <li>
        Sisteme Kayıtlı Banka Bilgisi Bulunmamaktadır. 
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