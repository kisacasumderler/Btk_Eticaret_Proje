<?php 
if(isset($_SESSION["Yonetici"])){
    $SayfalamaIcinSolveSagButonSayisi = 2;
    $SayfaBasinaKayitSayisi = 10;
    $ToplamKayitSayisiSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE OnayDurumu=? AND kargoDurumu=? ORDER BY id ASC"); 
    $ToplamKayitSayisiSorgusu->execute([1,1]);
    $Toplam_KS = $ToplamKayitSayisiSorgusu->rowCount();
    $SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaKayitSayisi) - $SayfaBasinaKayitSayisi;
    $BulunanSayfaSayisi = ceil($Toplam_KS / $SayfaBasinaKayitSayisi);

    $SiparisNolarSorgu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE OnayDurumu=? AND kargoDurumu=? ORDER BY id ASC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi"); 
    $SiparisNolarSorgu->execute([1,1]);
    $SiparisNolarSayisi = $SiparisNolarSorgu->rowCount();
    $SiparisNolarKayitlar = $SiparisNolarSorgu->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Tamamlanan Siparişler</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=106" class="addBtn">Bekleyen Siparişler</a>
</div>
<ul>
    <?php 
        if($SiparisNolarSayisi>0){
    foreach($SiparisNolarKayitlar as $siparislerValues){

        $siparislerSorgu = $db->prepare("SELECT * FROM siparisler WHERE OnayDurumu=? AND siparisNumarasi=? AND kargoDurumu=?");
        $siparislerSorgu->execute([1,DonusumleriGeriDondur($siparislerValues["siparisNumarasi"]),1]);
        $siparisler_KS = $siparislerSorgu->rowCount();
        $siparisKayitlar = $siparislerSorgu->fetchAll(PDO::FETCH_ASSOC);
        if($siparisler_KS>0){
            foreach($siparisKayitlar as $Values){
                    $urunToplamFiyat = FiyatBicimlendir($Values["topamUrunFiyati"]);
                    $siparisTarihi = Tarihbul($Values["siparisTarihi"]);
                }
        ?>
    <li class="ListGrup flexRowStart">
        <div class="width100">
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Sipariş Numarası : </span>
                <span><?php echo DonusumleriGeriDondur($siparislerValues["siparisNumarasi"]);?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Sipariş Tutarı : </span>
                <span><?php echo DonusumleriGeriDondur($urunToplamFiyat);?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Sipariş Tarihi : </span>
                <span><?php echo DonusumleriGeriDondur($siparisTarihi);?></span>
            </div>
        </div>
        <div class="width25 flexColumnCenter gap1">
            <a href="index.php?SKD=0&SKI=109&SepetNo=<?php echo DonusumleriGeriDondur($siparislerValues["siparisNumarasi"]); ?>"
                class="GuncelleBtn width100 textCenter">Siparişi Görüntüle</a>
        </div>
    </li>
    <?php
    
    }else {
        header("location:index.php?SKD=0&SKI=0");
        exit();
    }
    }
}else {
    ?>
    <li>
        Kayıtlı Tamamlanan sipariş bulunmamaktadır.
    </li>
    <?php
}
    ?>

</ul>
<?php 
        if($BulunanSayfaSayisi>1){
        ?>
<div class="sayfalarKapsam">
    <span>
        <?php echo $BulunanSayfaSayisi; ?> Sayfada <?php echo $Toplam_KS; ?> adet Kayıt bulunmaktadır.
    </span>
    <div class="SayfalamaButtons">
        <?php 
                    if($Sayfalama>1){
                        echo "<span><a href='index.php?SKD=0&SKI=108&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SKD=0&SKI=108&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SKD=0&SKI=108&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SKD=0&SKI=108&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SKD=0&SKI=108&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
                    }
                    ?>
    </div>
</div>
<?php 
            }else {
                    echo "<span></span>";
            }
        ?>
<?php
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>