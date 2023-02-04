<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_REQUEST["aramaIcerik"])){
        $GElenAramaIcerik = Guvenlik($_REQUEST["aramaIcerik"]);
        $AramaKosulu = "WHERE urunAdi LIKE '%" . $GElenAramaIcerik."%' ";
        $SayfalamaKosulu = "&aramaIcerik=". $GElenAramaIcerik;
    }else {
        $GElenAramaIcerik = "";
        $AramaKosulu = "";
        $SayfalamaKosulu = "";
    }

    $SayfalamaIcinSolveSagButonSayisi = 2;
    $SayfaBasinaKayitSayisi = 10;
    $ToplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM urunler {$AramaKosulu} ORDER BY urunAdi ASC"); 
    $ToplamKayitSayisiSorgusu->execute();
    $Toplam_KS = $ToplamKayitSayisiSorgusu->rowCount();
    $SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaKayitSayisi) - $SayfaBasinaKayitSayisi;
    $BulunanSayfaSayisi = ceil($Toplam_KS / $SayfaBasinaKayitSayisi);

    $urunlerSorgu = $db->prepare("SELECT * FROM urunler {$AramaKosulu} ORDER BY urunAdi ASC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi");
    $urunlerSorgu->execute();
    $urunler_KS = $urunlerSorgu->rowCount();
    $yorumKayitlar = $urunlerSorgu->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Ürünler</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=95" class="addBtn"> <span>+</span> Ürün Ekle</a>
</div>
<div class="aramaKutusu width100">
    <form action="index.php?SKD=0&SKI=94" method="POST" class="width100 flexRowCenter">
        <input type="text" name="aramaIcerik" id="aramaIcerik" class="serchBtn" placeholder="Arama Yap">
        <button class="serchBtn">
            <img src="../resimler/AraButonuIciBuyuteci.png" alt="">
        </button>
    </form>
</div>
<ul>
    <?php 
        if($urunler_KS>0){
    foreach($yorumKayitlar as $urunlerValues){
        $urunID = DonusumleriGeriDondur($urunlerValues["id"]);
        
        if((DonusumleriGeriDondur($urunlerValues["toplamyorumpuani"]==0)) and (DonusumleriGeriDondur($urunlerValues["yorumSayisi"]==0))){
            $urunPuan = 0;
        }else {
            $urunPuan = ceil((DonusumleriGeriDondur($urunlerValues["toplamyorumpuani"]))/DonusumleriGeriDondur($urunlerValues["yorumSayisi"]));
        }
        if($urunPuan==1){
            $ResimDosyasi = "<img src='../resimler/YildizCizgiliBirDolu.png' class='width100'>";
        }elseif($urunPuan==2){
            $ResimDosyasi = "<img src='../resimler/YildizCizgiliIkiDolu.png' class='width100'>";
        }elseif($urunPuan==3){
            $ResimDosyasi = "<img src='../resimler/YildizCizgiliUcDolu.png' class='width100'>";
        }elseif($urunPuan==4){
            $ResimDosyasi = "<img src='../resimler/YildizCizgiliDortDolu.png' class='width100'>";
        }elseif($urunPuan==5){
            $ResimDosyasi = "<img src='../resimler/YildizCizgiliBesDolu.png' class='width100'>";
        }elseif($urunPuan==0){
            $ResimDosyasi = "<img src='../resimler/YildizCizgiliBos.png' class='width100'>";
        }else {
            $ResimDosyasi = "Hata : Puan alınamıyor.";
        }

        if (DonusumleriGeriDondur($urunlerValues["urunTuru"])=="Kadın Ayakkabısı") {
            $ResimKlasorAdi = "Kadin";
            }elseif(DonusumleriGeriDondur($urunlerValues["urunTuru"])=="Erkek Ayakkabısı"){
                $ResimKlasorAdi = "Erkek";
            }else {
                $ResimKlasorAdi = "Cocuk";
            }
            
            if(DonusumleriGeriDondur($urunlerValues["Durumu"])==1){
                $urunDurumu = "Satışta / Aktif";
                $SilButonu = "<a href='index.php?SKD=0&SKI=103&MenuID=".DonusumleriGeriDondur($urunlerValues["MenuId"])."&ID=".DonusumleriGeriDondur($urunlerValues["id"])."' class='SilBtn'>Sil</a>";
            }else {
                $urunDurumu = "Pasif";
                $SilButonu = "<span class='disableBtn width100'>Silinmiş</span>";
            }

            $UrunResmi = DonusumleriGeriDondur($urunlerValues["urunResmiBir"]);
            $IsimSoyisim = DonusumleriGeriDondur($urunlerValues["urunAdi"]);

            $menuSorgu = $db->prepare("SELECT * FROM menuler WHERE id=?");
            $menuSorgu->execute([DonusumleriGeriDondur($urunlerValues["MenuId"])]);
            $menu_KS =$menuSorgu->rowCount();
            $MenuKayit = $menuSorgu->fetch(PDO::FETCH_ASSOC);
        ?>
    <li class="ListGrup flexRowStart">
        <div style="width: 150px;" class="textCenter">
            <?php echo $ResimDosyasi;?>
            <img src="../resimler/UrunResimleri/<?php echo $ResimKlasorAdi . "/".$UrunResmi; ?>" alt=""
                class="width100">
        </div>
        <div class="width100">
            <div>
                <span class="ListBaslik"><?php echo $MenuKayit["urunTuru"]; ?> >
                    <?php echo $MenuKayit["MenuAdi"]; ?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Ürün Adı : </span>
                <span><?php echo $IsimSoyisim; ?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Fiyat : </span>
                <span><?php echo FiyatBicimlendirTlSiz(DonusumleriGeriDondur($urunlerValues["urunFiyati"]));?>
                    <?php echo DonusumleriGeriDondur($urunlerValues["paraBirimi"]);?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Durumu : </span>
                <span><?php echo $urunDurumu; ?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Açıklama : </span>
                <span><?php echo DonusumleriGeriDondur($urunlerValues["urunAciklamasi"]); ?></span>
            </div>
            <div>
                <span><?php echo DonusumleriGeriDondur($urunlerValues["ToplamSatisSayisi"]);?> adet satıldı.</span>
                <span><?php echo DonusumleriGeriDondur($urunlerValues["yorumSayisi"]);?> yorumda
                    <?php echo DonusumleriGeriDondur($urunlerValues["toplamyorumpuani"]);?> toplam puan.</span>
                <span><?php echo DonusumleriGeriDondur($urunlerValues["goruntulenmeSayisi"]);?> defa görüntülendi.
                </span>
            </div>
        </div>
        <div class="width25 flexColumnCenter gap1">
            <a href="index.php?SKD=0&SKI=99&MenuID=<?php echo DonusumleriGeriDondur($urunlerValues["MenuId"]);?>&ID=<?php echo DonusumleriGeriDondur($urunlerValues["id"]); ?>"
                class="GuncelleBtn">Güncelle</a>
            <?php echo $SilButonu; ?>
        </div>
    </li>
    <?php
    }
    ?>
    <div class="sayfalama">

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
                        echo "<span><a href='index.php?SKD=0&SKI=94".$SayfalamaKosulu."&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SKD=0&SKI=94".$SayfalamaKosulu."&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SKD=0&SKI=94".$SayfalamaKosulu."&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SKD=0&SKI=94".$SayfalamaKosulu."&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SKD=0&SKI=94".$SayfalamaKosulu."&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
                    }
                    ?>
            </div>
        </div>
        <?php 
            }else {
                    echo "<span></span>";
            }
        ?>
    </div>
    <?php
}else {
    ?>
    <li>
        Sisteme kayıtlı yorum kaydı bulunmamaktadır.
    </li>
    <?php
}
    ?>

</ul>
<script>
    let serchBtn = document.querySelectorAll(".serchBtn");
    let body = document.getElementsByClassName("BODY");
    serchBtn[0].addEventListener('click', () => {
        serchBtn[1].style.display = "block";
    })
</script>
<?php
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>