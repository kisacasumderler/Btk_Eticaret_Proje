<?php 
if(isset($_SESSION["Yonetici"])){
    $yoneticiKayitlarSorgu = $db->prepare("SELECT * FROM yoneticiler ORDER BY isimSoyisim ASC");
    $yoneticiKayitlarSorgu->execute();
    $yonetici_KS = $yoneticiKayitlarSorgu->rowCount();
    $yoneticiKayitlar = $yoneticiKayitlarSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Yöneticiler</h1>
</div>
<div class="BtnDiv">
    <?php
         if($YoneticiDurumu=="1"){
            ?>
    <a href="index.php?SKD=0&SKI=70" class="addBtn"> <span style="margin-right: .5rem;">+</span>Yönetici kaydı Ekle</a>
    <?php
         }
    ?>
</div>
<ul>
    <?php 
        if($yonetici_KS>0){
    foreach($yoneticiKayitlar as $yoneticiValues){
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Kullanıcı Adı: </span>
                <span><?php echo DonusumleriGeriDondur($yoneticiValues["kullaniciAdi"]);?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">İsim soyisim: </span>
                <span><?php echo DonusumleriGeriDondur($yoneticiValues["isimSoyisim"]);?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Telefon numarası: </span>
                <span><?php echo DonusumleriGeriDondur($yoneticiValues["telefonNumarasi"]);?></span>
            </div>
        </div>
        <div class="width25 flexColumnCenter gap1">
            <?php
            if($yoneticiValues["id"]==$YoneticiID or $YoneticiDurumu=="1"){
                ?>
            <a href="index.php?SKD=0&SKI=74&ID=<?php echo DonusumleriGeriDondur($yoneticiValues["id"]); ?>"
                class="GuncelleBtn">Güncelle</a>
            <?php
            }else {
                ?>
            <span class="disableBtn width100">Güncelle</span>
            <?php
            }
            if($YoneticiDurumu=="1"){
                if($yoneticiValues["id"]==$YoneticiID){
                    ?>
            <span class="disableBtn width100">Sil</span>
            <?php
                }else {
                    ?>
            <a href="index.php?SKD=0&SKI=78&ID=<?php echo DonusumleriGeriDondur($yoneticiValues["id"]); ?>"
                class="SilBtn">Sil</a>
            <?php
                }
            }else {
                ?>
            <span class="disableBtn width100">Sil</span>
            <?php
            }
            ?>

        </div>
    </li>
    <?php
    }
}else {
    ?>
    <li>
        Sisteme kayıtlı yonetici kaydı bulunmamaktadır.
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