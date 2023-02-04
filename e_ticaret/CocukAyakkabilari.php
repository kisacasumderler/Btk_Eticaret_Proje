<?php 
if(isset($_REQUEST["ID"])){
    $GelenID = Guvenlik(SayiliIcerikFiltrele($_REQUEST["ID"]));
    $MenuKosulu = " AND MenuId=" . $GelenID;
    $SayfalamaKosulu = "&ID=". $GelenID;
}else {
    $GelenID = "";
    $MenuKosulu = "";
    $SayfalamaKosulu = "";
}

if(isset($_REQUEST["aramaIcerik"])){
    $GElenAramaIcerik = Guvenlik($_REQUEST["aramaIcerik"]);
    $AramaKosulu = " AND urunAdi LIKE '%" . $GElenAramaIcerik."%' ";
    $SayfalamaKosulu .= "&aramaIcerik=". $GElenAramaIcerik;
}else {
    $GElenAramaIcerik = "";
    $AramaKosulu = "";
    $SayfalamaKosulu .= "";
}

$SayfalamaIcinSolveSagButonSayisi = 2;
$SayfaBasinaKayitSayisi = 10;
$ToplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM urunler WHERE urunTuru='Çocuk Ayakkabısı' AND Durumu='1' {$MenuKosulu} {$AramaKosulu} ORDER BY id DESC"); 
$ToplamKayitSayisiSorgusu->execute();
$Toplam_KS = $ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaKayitSayisi) - $SayfaBasinaKayitSayisi;
$BulunanSayfaSayisi = ceil($Toplam_KS / $SayfaBasinaKayitSayisi);

$AnamMenuTumKayitlarSayiSorgu = $db->prepare("SELECT SUM(urunSayisi) AS MenununToplamUrunu FROM menuler WHERE urunTuru='Çocuk Ayakkabısı'");
$AnamMenuTumKayitlarSayiSorgu->execute();
$ToplamSayi = $AnamMenuTumKayitlarSayiSorgu->fetch(PDO::FETCH_ASSOC);
?>
<div class="Kapsam">
    
<ul class="MenuVeBanner">
    <li class="Menuler">
        <div class="menulerHeader">
            MENULER
        </div>
            <nav>
            <a href="index.php?SK=86" class="light" style="">Tüm Ürünler (<?php echo $ToplamSayi["MenununToplamUrunu"]; ?>) </a>
    <?php 
    $MenulerSorgusu = $db->prepare("SELECT * FROM menuler WHERE urunTuru='Çocuk Ayakkabısı' ORDER BY MenuAdi ASC");
    $MenulerSorgusu->execute();
    $MenulerKSayi = $MenulerSorgusu->rowCount();
    $MenulerKayitlar = $MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
    if($MenulerKSayi>0){
        foreach($MenulerKayitlar as $values){
            ?>
        <a href="index.php?SK=86&ID=<?php echo DonusumleriGeriDondur($values["id"]) ?>" class="light" style="color :<?php if ($GelenID == $values["id"]) {echo "#FF7A38";}else{echo "#646465";} ?>;"><?php echo DonusumleriGeriDondur($values["MenuAdi"]) ?> (<?php echo DonusumleriGeriDondur($values["urunSayisi"]) ?>)</a>
            <?php
        }
    }else {
        echo "Hata : Kayıt Alınamıyor. ";
    }
    ?>
        </nav>
    </li>
    <li class="BannerSistemi">
        <div class="BannerHeader">
            Reklamlar
        </div>
    <?php 
    $BannerlarSorgu = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani='Menu Altı' ORDER BY GosterimSayisi ASC LIMIT 1");
    $BannerlarSorgu->execute();
    $Banner_KS = $BannerlarSorgu->rowCount();
    $BannerKayit = $BannerlarSorgu->fetch(PDO::FETCH_ASSOC);
    ?>
    <img src="./resimler/Bannerlar/<?php echo $BannerKayit["BannerResmi"]?>" alt="">
    <?php
        $BannerGG = $db->prepare("UPDATE bannerlar SET GosterimSayisi=GosterimSayisi+1 WHERE id =? LIMIT 1");
        $BannerGG->execute([$BannerKayit["id"]]);
    ?>
    </li>
</ul>
<ul class="urunler">
    <div class="aramaKutusu">
        <form action="index.php?SK=86" method="POST">
            <?php 
            if($GelenID!==""){
                ?>
                <input type="hidden" name="ID" value="<?php echo $GelenID; ?>">
                <?php
            }
            ?>
            <input type="text" name="aramaIcerik" id="aramaIcerik" class="serchBtn" placeholder="Arama Yap">
            <button class="serchBtn">
                <img src="./resimler/AraButonuIciBuyuteci.png" alt="">
            </button>
        </form>
    </div>
    <ul class="urunlerListele">
        <?php 
            $UrunlerSorgu = $db->prepare("SELECT * FROM urunler WHERE urunTuru='Çocuk Ayakkabısı' AND Durumu='1' {$MenuKosulu} {$AramaKosulu} ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi");
            $UrunlerSorgu->execute();
            $UrunlerKS = $UrunlerSorgu->rowCount();
            $UrunlerKayitlar = $UrunlerSorgu->fetchAll(PDO::FETCH_ASSOC);

            if($UrunlerKS>0){
                foreach($UrunlerKayitlar as $values){
                $UrunToplamYorumSayisi = $values["yorumSayisi"];
                $urunToplamYorumPuani = $values["toplamyorumpuani"];
                if($UrunToplamYorumSayisi>0){
                    $puanHesapla = number_format($urunToplamYorumPuani / $UrunToplamYorumSayisi,2,".","");
                }else {
                    $puanHesapla = 0;
                }
                
                if($puanHesapla==0){
                    $puanResmi = "./resimler/YildizCizgiliBos.png";
                }else if(($puanHesapla>0) and ($puanHesapla<=1)){
                    $puanResmi = "./resimler/YildizCizgiliBirDolu.png";
                }else if(($puanHesapla>1) and ($puanHesapla<=2)){
                    $puanResmi = "./resimler/YildizCizgiliIkiDolu.png";
                }else if(($puanHesapla>2) and ($puanHesapla<=3)){
                    $puanResmi = "./resimler/YildizCizgiliUcDolu.png";
                }else if(($puanHesapla>3) and ($puanHesapla<=4)){
                    $puanResmi = "./resimler/YildizCizgiliDortDolu.png";
                }else {
                    $puanResmi = "./resimler/YildizCizgiliBesDolu.png";
                }
                    ?>
                    <li>
                        <div class="urunHeader">
                            <img src="<?php echo $puanResmi; ?>" alt="">
                        </div>
                        <div class="urunimg">
                            <a href="<?php echo DonusumleriGeriDondur(SEO($values["urunTuru"]))."/".DonusumleriGeriDondur(SEO($values["urunAdi"]))."/".DonusumleriGeriDondur($values["id"]); ?>"><img src="./resimler/UrunResimleri/Cocuk/<?php echo DonusumleriGeriDondur($values["urunResmiBir"])?>" alt=""></a>
                            
                        </div>
                        <div class="urunDetay">
                            <span><a href="<?php echo DonusumleriGeriDondur(SEO($values["urunTuru"]))."/".DonusumleriGeriDondur(SEO($values["urunAdi"]))."/".DonusumleriGeriDondur($values["id"]); ?>" class="light"><?php echo $values["urunAdi"]?></a></span>
                            <span><?php echo FiyatBicimlendir(TLCevir(DonusumleriGeriDondur($values["paraBirimi"])) * DonusumleriGeriDondur($values["urunFiyati"]));?> </span>
                        </div>
                    </li>
                    <?php
                }
            }else {
                // echo "Hata : veri Alınamıyor";
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
                        echo "<span><a href='index.php?SK=86".$SayfalamaKosulu."&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SK=86".$SayfalamaKosulu."&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SK=86".$SayfalamaKosulu."&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SK=86".$SayfalamaKosulu."&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SK=86".$SayfalamaKosulu."&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
                    }
                    ?>
                </div>
            </div>
        <?php 
            }else {
                    echo "<span></span>";
            }
        ?>
</ul>
</div>
