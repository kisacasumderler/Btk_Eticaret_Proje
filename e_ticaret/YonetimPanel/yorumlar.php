<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_REQUEST["aramaIcerik"])){
        $GElenAramaIcerik = Guvenlik($_REQUEST["aramaIcerik"]);
        $AramaKosulu = "WHERE yorumMetni LIKE '%" . $GElenAramaIcerik."%' ";
        $SayfalamaKosulu = "&aramaIcerik=". $GElenAramaIcerik;
    }else {
        $GElenAramaIcerik = "";
        $AramaKosulu = "";
        $SayfalamaKosulu = "";
    }

    $SayfalamaIcinSolveSagButonSayisi = 2;
    $SayfaBasinaKayitSayisi = 10;
    $ToplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM yorumlar {$AramaKosulu} ORDER BY uyeId DESC"); 
    $ToplamKayitSayisiSorgusu->execute();
    $Toplam_KS = $ToplamKayitSayisiSorgusu->rowCount();
    $SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaKayitSayisi) - $SayfaBasinaKayitSayisi;
    $BulunanSayfaSayisi = ceil($Toplam_KS / $SayfaBasinaKayitSayisi);

    $yorumlarSorgu = $db->prepare("SELECT * FROM yorumlar {$AramaKosulu} ORDER BY uyeId DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi");
    $yorumlarSorgu->execute();
    $yorumlar_KS = $yorumlarSorgu->rowCount();
    $yorumKayitlar = $yorumlarSorgu->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Yorumlar</h1>
</div>
<div class="aramaKutusu width100">
    <form action="index.php?SKD=0&SKI=90" method="POST" class="width100 flexRowCenter">
        <input type="text" name="aramaIcerik" id="aramaIcerik" class="serchBtn" placeholder="Arama Yap">
        <button class="serchBtn">
            <img src="../resimler/AraButonuIciBuyuteci.png" alt="">
        </button>
    </form>
</div>
<ul>
    <?php 
        if($yorumlar_KS>0){
    foreach($yorumKayitlar as $yorumlarValues){
        $urunID = DonusumleriGeriDondur($yorumlarValues["urunId"]);
        $uyeID = DonusumleriGeriDondur($yorumlarValues["uyeId"]);
        $urunPuan = DonusumleriGeriDondur($yorumlarValues["puan"]);
        if($urunPuan==1){
            $ResimDosyasi = "<img src='../resimler/YildizBirDolu.png'>";
        }elseif($urunPuan==2){
            $ResimDosyasi = "<img src='../resimler/YildizIkiDolu.png'>";
        }elseif($urunPuan==3){
            $ResimDosyasi = "<img src='../resimler/YildizUcDolu.png'>";
        }elseif($urunPuan==4){
            $ResimDosyasi = "<img src='../resimler/YildizDortDolu.png'>";
        }elseif($urunPuan==5){
            $ResimDosyasi = "<img src='../resimler/YildizBesDolu.png'>";
        }else {
            $ResimDosyasi = "Hata : Puan alınamıyor.";
        }
            // ürünler sorgusu 
            $UrunlerSorgu = $db->prepare("SELECT * FROM urunler WHERE id=?");
            $UrunlerSorgu->execute([$urunID]);
            $urunlerKS = $UrunlerSorgu->rowCount();
            $urunKayit = $UrunlerSorgu->fetch(PDO::FETCH_ASSOC);
            // üyeler sorgusu 
            $UyelerSorgu = $db->prepare("SELECT * FROM uyeler WHERE id=?");
            $UyelerSorgu->execute([$uyeID]);
            $UyelerKS = $UyelerSorgu->rowCount();
            $uyeKayit = $UyelerSorgu->fetch(PDO::FETCH_ASSOC);

            if($UyelerKS>0){
                if (DonusumleriGeriDondur($urunKayit["urunTuru"])=="Kadın Ayakkabısı") {
                $ResimKlasorAdi = "Kadin";
                }elseif(DonusumleriGeriDondur($urunKayit["urunTuru"])=="Erkek Ayakkabısı"){
                    $ResimKlasorAdi = "Erkek";
                }else {
                    $ResimKlasorAdi = "Cocuk";
                }
            }

            $UrunResmi = DonusumleriGeriDondur($urunKayit["urunResmiBir"]);
            $IsimSoyisim = DonusumleriGeriDondur($uyeKayit["isimSoyisim"]);
        ?>
    <li class="ListGrup flexRowStart">
        <div style="width: 10%;">
            <img src="../resimler/UrunResimleri/<?php echo $ResimKlasorAdi . "/".$UrunResmi; ?>" alt=""
                class="width100">
        </div>
        <div class="width100">
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">İsim Soyisim : </span>
                <span><?php echo $IsimSoyisim; ?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Yorum Puanı: </span>
                <span><?php echo $ResimDosyasi;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Yorum metni : </span>
                <span><?php echo DonusumleriGeriDondur($yorumlarValues["yorumMetni"]);?></span>
            </div>
        </div>
        <div class="width25 flexColumnCenter gap1">
            <a href="index.php?SKD=0&SKI=91&ID=<?php echo DonusumleriGeriDondur($yorumlarValues["id"]); ?>"
                class="SilBtn">Sil</a>
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
                        echo "<span><a href='index.php?SKD=0&SKI=90".$SayfalamaKosulu."&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SKD=0&SKI=90".$SayfalamaKosulu."&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SKD=0&SKI=90".$SayfalamaKosulu."&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SKD=0&SKI=90".$SayfalamaKosulu."&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SKD=0&SKI=90".$SayfalamaKosulu."&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
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