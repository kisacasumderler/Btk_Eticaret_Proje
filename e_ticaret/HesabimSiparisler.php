<?php 
if(isset($_SESSION["Kullanici"])){
    $SayfalamaIcinSolveSagButonSayisi = 2;
    $SayfaBasinaKayitSayisi = 10;
    $ToplamKayitSayisiSorgusu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE UyeId=? ORDER BY siparisNumarasi DESC"); 
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
            Hesabım > Siparişler
        </h2>
        <p>
            Buradan tüm siparişleri görüntüleyebilirsin.
        </p>
        <div class="Adresler">
            <?php 
            $SiparisNolarSorgu = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE UyeId=? ORDER BY siparisNumarasi DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi"); // limit ve sayfalama 
            $SiparisNolarSorgu->execute([$id]);
            $SiparisNolarSayisi = $SiparisNolarSorgu->rowCount();
            $SiparisNolarKayitlar = $SiparisNolarSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($SiparisNolarSayisi>0){
        foreach ($SiparisNolarKayitlar as $Values) {
            $SiparisNo = $Values['siparisNumarasi'];

            $SiparisSorgu = $db->prepare("SELECT * FROM siparisler WHERE UyeId=? AND siparisNumarasi =? ORDER BY id ASC");
            $SiparisSorgu->execute([$id,$SiparisNo]);
            $SiparisSSayisi = $SiparisSorgu->rowCount();
            $SiparisKayitlar = $SiparisSorgu->fetchAll(PDO::FETCH_ASSOC);
                foreach ($SiparisKayitlar as $Satirlar){
                $UrunTuru = DonusumleriGeriDondur($Satirlar["urunTuru"]);
                if ($UrunTuru=="Kadın Ayakkabısı") {
                    $ResimKlasorAdi = "Kadin";
                }elseif($UrunTuru=="Erkek Ayakkabısı"){
                    $ResimKlasorAdi = "Erkek";
                }else {
                    $ResimKlasorAdi = "Cocuk";
                }
                $KargoDurumu = DonusumleriGeriDondur($Satirlar["kargoDurumu"]);
                if($KargoDurumu == 0){
                    $KargoTakipNo = "Beklemede";
                }else {
                    $KargoTakipNo = DonusumleriGeriDondur($Satirlar["kargoGonderiKodu"]);
                }

            ?>
            <ul class="AdresCard SiparisCard">
                <li>
                    Sipariş Numarası :
                    #<?php echo DonusumleriGeriDondur($Satirlar["siparisNumarasi"]); ?>
                </li>
                <li>
                    <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".DonusumleriGeriDondur($Satirlar["urunResmiBir"]); ?>"
                        alt="">
                    <span><?php echo DonusumleriGeriDondur($Satirlar["urunAdi"]); ?></span>
                </li>
                <li>
                    <span>Fiyat :</span>
                    <span><?php echo FiyatBicimlendir(DonusumleriGeriDondur($Satirlar["urunFiyati"])); ?></span>
                </li>
                <li>
                    <span>Sipariş Adeti :</span>
                    <span><?php echo DonusumleriGeriDondur($Satirlar["urunAdedi"]); ?></span>
                </li>
                <li>
                    <span>Sipariş Toplam Fiyat :</span>
                    <span><?php echo FiyatBicimlendir(DonusumleriGeriDondur($Satirlar["topamUrunFiyati"]+($Satirlar["kargoUcreti"]*$Satirlar["urunAdedi"]))); ?></span>
                </li>
                <li>
                    <span>Sipariş Tarihi :</span>
                    <span><?php echo DonusumleriGeriDondur(Tarihbul($Satirlar["siparisTarihi"])); ?></span>
                </li>
                <li>
                    <span>Kargo Durumu :</span>
                    <span><?php echo $KargoTakipNo; ?></span>
                </li>
                <?php
                    if($Satirlar["OnayDurumu"]==0){
                        ?>
                <li>
                    <a href="havale-bildirim-formu" class="light"> Ödeme Bildirimi Yap <img src="./resimler/DokumanKirmiziKalemli20x20.png"alt=""></a>
                </li>
                <?php
                    }else {
                        ?>
                <li>
                    <a
                        href="index.php?SK=75&ID=<?php echo DonusumleriGeriDondur($Satirlar["urunId"])."&SiparisNo=".DonusumleriGeriDondur($Satirlar["siparisNumarasi"])."&UrunAdi=".DonusumleriGeriDondur($Satirlar["urunAdi"])."&UrunResmi=".DonusumleriGeriDondur($Satirlar["urunResmiBir"])."&RKAdi=".$ResimKlasorAdi;?>" class="light">
                        Yorum Yap <img src="./resimler/DokumanKirmiziKalemli20x20.png" alt=""></a>
                </li>
                <?php
                    }
                    ?>

            </ul>
            <?php
                    }
                }
            }else {
                ?>
            <p>
                <?php echo "Sisteme kayıtlı siparişiniz bulunmamaktadır. ";?>
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
                        echo "<span><a href='index.php?SK=61&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SK=61&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SK=61&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SK=61&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SK=61&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
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