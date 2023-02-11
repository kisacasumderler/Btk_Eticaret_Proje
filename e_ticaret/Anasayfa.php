<?php 
    function SliderGoster($deger){
        global $db;
        $BannerlarSorgu = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani='{$deger}' ORDER BY GosterimSayisi ASC ");
        $BannerlarSorgu->execute();
        $BannerKayit = $BannerlarSorgu->fetchAll(PDO::FETCH_ASSOC);

        if($deger == "Ana Sayfa"){
            $sliderId = "WebSlider";
            $SliderBtn = "slider_btn";
            $BtnLClass = "prev";
            $BtnRClass = "next";
            $DotClass = "dots";
            $SliderCircle = "slider_circle";
            $SliderImg = "slider_img";
        }else {
            $sliderId = "MobileSlider";
            $SliderBtn = "MobileSliderBtn";
            $BtnLClass = "Mobileprev";
            $BtnRClass = "Mobilenext";
            $DotClass = "Mobiledots";
            $SliderCircle = "slider_circleMobile";
            $SliderImg = "slider_imgMobile";
        }
        ?>
<div class="sliderContainer" id="<?php echo $sliderId; ?>">
    <div class="imgdiv">
        <!-- slider_img döngüsü buraya  -->
        <?php
        foreach ($BannerKayit as $BannerValues) {
            ?>
        <img src="./resimler/Bannerlar/<?php echo $BannerValues['BannerResmi']; ?>" alt="" class="<?php echo $SliderImg; ?>">
        <?php
        }
?>
    </div>
    <button class="<?php echo $BtnLClass." ".$SliderBtn; ?>"><img src="./resimler/solok.png" alt=""></button>
    <button class="<?php echo $BtnRClass." ".$SliderBtn; ?>"><img src="./resimler/sagok.png" alt=""></button>
    <div class="<?php echo $DotClass; ?>">
        <!-- slider_circle döngüsü buraya  -->
        <?php  
    foreach($BannerKayit as $values){
        ?>
        <div class="<?php echo $SliderCircle; ?>"></div>
        <?php
    }
?>
    </div>
</div>
<?php
   $BannerHitGuncelle = $db->prepare("UPDATE bannerlar SET GosterimSayisi = GosterimSayisi+1 WHERE id=? LIMIT 1");
   $BannerHitGuncelle->execute([$BannerKayit[0]["id"]]);
    }
    SliderGoster("Ana Sayfa");
    SliderGoster("Anasayfa Mobil");
    ?>

<div class="TumUrunler">
    <?php 
        function HomeKategoriler($deger){
        global $db;
            $BannerKategoriSorgu = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani='{$deger}'");
            $BannerKategoriSorgu->execute();
            $KategriBannerlarkayit = $BannerKategoriSorgu->fetchAll(PDO::FETCH_ASSOC);
            foreach($KategriBannerlarkayit as $BannerlarValues){
                if($BannerlarValues["bannerAdi"]=="Kadın"){
                    $BannerLink = "kadin-ayakkabilari";
               }elseif($BannerlarValues["bannerAdi"]=="Erkek"){
                    $BannerLink = "erkek-ayakkabilari";
               }else {
                $BannerLink = "cocuk-ayakkabilari";
               }
               // döngü 
               ?>
    <a href="<?php echo $BannerLink; ?>"><img src="./resimler/Bannerlar/<?php echo $BannerlarValues["BannerResmi"]; ?>"
            alt=""></a>
    <?php
            }
        }
    ?>
    <div class="webKategori HomeKategoriler"><?php HomeKategoriler("Anasayfa Kategoriler"); ?></div>
    <div class="mobileKategori HomeKategoriler"><?php HomeKategoriler("Anasayfa Kategoriler Mobil"); ?></div>

</div>
<!-- ürünler  -->
<?php 
function urunGetir($deger){
    global $db;
    $UrunlerSorgu = $db->prepare("SELECT * FROM urunler WHERE Durumu='1' ORDER BY {$deger} DESC LIMIT 10");
    $UrunlerSorgu->execute();
    $UrunlerKS = $UrunlerSorgu->rowCount();
    $UrunlerKayitlar = $UrunlerSorgu->fetchAll(PDO::FETCH_ASSOC);

    if($UrunlerKS>0){

?>
<div class="UrunLer">
    <?php 
    if($deger=="id"){
        ?>
    <h1>En Yeni Ürünler</h1>
    <?php 
    }elseif($deger=="ToplamSatisSayisi"){
        ?>
    <h1>Çok Satan Ürünler</h1>
    <?php 
    }elseif($deger=="toplamyorumpuani"){
        ?>
    <h1>En çok beğeni alan ürünler</h1>
    <?php  
    }elseif($deger=="goruntulenmeSayisi"){
        ?>
    <h1>En çok görüntülenen ürünler</h1>
    <?php  
    }else {
        echo "veri alınamıyor";
    }
    ?>
    <div class="wrapper" id="<?php echo $deger; ?>">
        <div class="icon" id="LS_Button">
            <i class="non_select">
                < </i>
        </div>
        <ul class="boxkapsayici">
            <?php 
                        foreach($UrunlerKayitlar as $values){
                            $UrunToplamYorumSayisi = $values["yorumSayisi"];
                            $urunToplamYorumPuani = $values["toplamyorumpuani"];
                            $urunTuru = DonusumleriGeriDondur($values["urunTuru"]);
                    
                            if($urunTuru=="Erkek Ayakkabısı"){
                                $ResimDosyaKlasor = "Erkek";
                            }elseif($urunTuru=="Kadın Ayakkabısı"){
                                $ResimDosyaKlasor = "Kadin";
                            }else {
                                $ResimDosyaKlasor = "Cocuk";
                            }
                    
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
            <li class="box">
                <div class="boximg">
                    <img src="<?php echo $puanResmi; ?>" alt="" class="non_select">
                    <a href="<?php echo DonusumleriGeriDondur(SEO($values["urunTuru"]))."/".DonusumleriGeriDondur(SEO($values["urunAdi"]))."/".DonusumleriGeriDondur($values["id"]); ?>"
                        class="non_select"><img
                            src="./resimler/UrunResimleri/<?php echo $ResimDosyaKlasor."/".DonusumleriGeriDondur($values["urunResmiBir"])?>"
                            alt=""></a>
                    <a href="<?php echo DonusumleriGeriDondur(SEO($values["urunTuru"]))."/".DonusumleriGeriDondur(SEO($values["urunAdi"]))."/".DonusumleriGeriDondur($values["id"]); ?>"
                        class="light"><?php echo $values["urunAdi"]?></a>
                    <span><?php echo FiyatBicimlendir(TLCevir(DonusumleriGeriDondur($values["paraBirimi"])) * DonusumleriGeriDondur($values["urunFiyati"]));?></span>
                </div>
            </li>
            <?php
                }
            }else {
                // echo "Hata : veri Alınamıyor";
            }
        ?>
        </ul>
        <div class="icon" id="RS_Button">
            <i class="non_select"> > </i>
        </div>
    </div>
</div>
<?php 
}

urunGetir("id");
urunGetir("ToplamSatisSayisi");
urunGetir("toplamyorumpuani");
urunGetir("goruntulenmeSayisi");

?>
