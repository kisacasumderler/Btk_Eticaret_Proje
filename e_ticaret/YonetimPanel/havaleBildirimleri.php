<?php 
if(isset($_SESSION["Yonetici"])){
    $HavaleBildirimSorgu = $db->prepare("SELECT * FROM havalebildirimleri ORDER BY islemTarihi DESC");
    $HavaleBildirimSorgu->execute();
    $HavaleBildirimKontrol = $HavaleBildirimSorgu->rowCount();
    $HavaleBildirimler = $HavaleBildirimSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Havale Bildirimleri</h1>
</div>
<ul>
    <?php 
        if($HavaleBildirimKontrol>0){
    foreach($HavaleBildirimler as $Values){
        $bankaId = $Values["bankaId"];

        $BankaBilgiSorgu = $db->prepare("SELECT * FROM bankahesaplarimiz WHERE id=?");
        $BankaBilgiSorgu->execute([$bankaId]);
        $BankaBilgi = $BankaBilgiSorgu->fetch(PDO::FETCH_ASSOC);
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Adı Soyadı </span>
                <span><?php echo DonusumleriGeriDondur($Values["adiSoyadi"]);?></span> 
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">E mail adresi : </span>
                <span><?php echo DonusumleriGeriDondur($Values["emailAdresi"]);?></span> 
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Açıklama : </span>
                <span><?php echo DonusumleriGeriDondur($Values["aciklama"]);?></span> 
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Ödeme Yapılan Banka : </span>
                <span><?php echo DonusumleriGeriDondur($BankaBilgi["bankaAdi"]);?></span> 
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">İşlem Tarihi : </span>
                <span><?php echo DonusumleriGeriDondur(Tarihbul($Values["islemTarihi"]));?></span> 
            </div>
        </div>
        <div class="width25 flexColumnCenter gap1">
            <a href="index.php?SKD=0&SKI=117&ID=<?php echo DonusumleriGeriDondur($Values["id"]); ?>"
                class="SilBtn">Sil</a>
        </div>
    </li>
    <?php
    }
}else {
    ?>
    <li>
        Sisteme kayıtlı havale bildirimi bulunmamaktadır.
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