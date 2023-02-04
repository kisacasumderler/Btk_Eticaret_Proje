<?php 
if(isset($_SESSION["Kullanici"])){
    $SayfalamaIcinSolveSagButonSayisi = 2;
    $SayfaBasinaKayitSayisi = 10;
    $ToplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM yorumlar WHERE uyeId=? ORDER BY yorumTarihi DESC"); 
    $ToplamKayitSayisiSorgusu->execute([$id]);
    $Toplam_KS = $ToplamKayitSayisiSorgusu->rowCount();
    $SayfalamayaBaslanacakKayitSayisi = ($Sayfalama * $SayfaBasinaKayitSayisi) - $SayfaBasinaKayitSayisi;
    $BulunanSayfaSayisi = ceil($Toplam_KS / $SayfaBasinaKayitSayisi);
    ?>
<div class="hb_Formu Adresler">
<ul class="hesabimRow" style="border: none;">
            <div class="mobileBar">
                <img src="./resimler/arrowUp.png" alt="">
            </div>
            <li>
                <a href="hesabim/uyelik-bilgilerim" class="light">Üyelik Bilgileri</a>
            </li>   
            <li>
                <a href="hesabim/adresler" class="light">Adresler</a>
            </li>   
            <li>
                <a href="hesabim/favoriler" class="light">Favoriler</a>
            </li>   
            <li>
                <a href="hesabim/yorumlar" class="light">Yorumlar</a>
            </li>   
            <li>
                <a href="hesabim/siparisler" class="light">Siparişler</a>
            </li>   
        </ul>
    <div class="colRight">
        <h2>
            Hesabım > Yorumlar
        </h2>
        <p>
            Buradan tüm yorumları görüntüleyebilirsin.
        </p>
        <div class="Yorumlar">
            <?php 
            $YorumlarSorgu = $db->prepare("SELECT * FROM yorumlar WHERE uyeId=? ORDER BY yorumTarihi DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi"); // limit ve sayfalama 
            $YorumlarSorgu->execute([$id]);
            $YorumlarKayitSayisi = $YorumlarSorgu->rowCount();
            $YorumKayitlar = $YorumlarSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($YorumlarKayitSayisi>0){
                foreach ($YorumKayitlar as $Satirlar){
                $verilenPuan = $Satirlar["puan"];
                if($verilenPuan==1){
                    $ResimDosyasi = "<img src='./resimler/YildizBirDolu.png'>";
                }elseif($verilenPuan==2){
                    $ResimDosyasi = "<img src='./resimler/YildizIkiDolu.png'>";
                }elseif($verilenPuan==3){
                    $ResimDosyasi = "<img src='./resimler/YildizUcDolu.png'>";
                }elseif($verilenPuan==4){
                    $ResimDosyasi = "<img src='./resimler/YildizDortDolu.png'>";
                }elseif($verilenPuan==5){
                    $ResimDosyasi = "<img src='./resimler/YildizBesDolu.png'>";
                }else {
                    $ResimDosyasi = "Hata : Puan alınamıyor.";
                }
                $Urunler = $db->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1"); 
                $Urunler->execute([DonusumleriGeriDondur($Satirlar["urunId"])]);
                $Urunler_KS = $Urunler->rowCount();
                $UrunKayitlar = $Urunler->fetchAll(PDO::FETCH_ASSOC);
                if (DonusumleriGeriDondur($UrunKayitlar[0]["urunTuru"])=="Kadın Ayakkabısı") {
                    $ResimKlasorAdi = "Kadin";
                }elseif(DonusumleriGeriDondur($UrunKayitlar[0]["urunTuru"])=="Erkek Ayakkabısı"){
                    $ResimKlasorAdi = "Erkek";
                }else {
                    $ResimKlasorAdi = "Cocuk";
                }
            ?>
            <ul class="YorumCard">
                <li>
                    <a href="<?php echo DonusumleriGeriDondur(SEO($UrunKayitlar[0]["urunTuru"]))."/".DonusumleriGeriDondur(SEO($UrunKayitlar[0]["urunAdi"]))."/".DonusumleriGeriDondur($Satirlar["urunId"]); ?>">
                        <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/". DonusumleriGeriDondur($UrunKayitlar[0]["urunResmiBir"]); ?>"
                            alt=""></a>
                    <span>Id : </span>
                    <span>#<?php echo DonusumleriGeriDondur($Satirlar["urunId"]); ?></span>
                    <span>
                        <a href="<?php echo DonusumleriGeriDondur(SEO($UrunKayitlar[0]["urunTuru"]))."/".DonusumleriGeriDondur(SEO($UrunKayitlar[0]["urunAdi"]))."/".DonusumleriGeriDondur($Satirlar["urunId"]); ?>" class="light">
                            <?php echo DonusumleriGeriDondur($UrunKayitlar[0]["urunAdi"]); ?></a>

                    </span>
                </li>
                <li>
                    <span>Puan :</span>
                    <?php echo $ResimDosyasi; ?>
                </li>
                <li>
                    <span>Yorum :</span>
                    <span><?php echo DonusumleriGeriDondur($Satirlar["yorumMetni"]); ?></span>
                </li>
                <li>
                    <span>Yorum Tarihi</span>
                    <span><?php echo DonusumleriGeriDondur(TarihSaatbul($Satirlar["yorumTarihi"])); ?></span>
                </li>
            </ul>
            <?php
                    }
            }else {
                ?>
            <p>
                <?php echo "Sisteme kayıtlı yorum bulunmamaktadır. ";?>
            </p>
            <?php 
            }
            ?>

        </div>
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
                        echo "<span><a href='index.php?SK=60&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SK=60&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SK=60&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SK=60&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SK=60&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
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
</div>

<?php
}else {
    header("location:index.php");
    exit();
}
?>