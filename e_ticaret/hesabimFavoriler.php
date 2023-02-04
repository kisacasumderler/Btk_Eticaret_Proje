<?php 
if(isset($_SESSION["Kullanici"])){
    $SayfalamaIcinSolveSagButonSayisi = 2;
    $SayfaBasinaKayitSayisi = 10;
    $ToplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM favoriler WHERE uyeId=? ORDER BY id DESC"); 
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
            Hesabım > Favoriler 
        </h2>
        <p>
            Favorilerinize eklediğiniz tüm ürünleri bu alandan görüntüleyebilirsiniz.
        </p>
        <div class="Adresler">
            <?php 
            $FavorilerSorgu = $db->prepare("SELECT * FROM favoriler WHERE uyeId=? ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaKayitSayisi"); // limit ve sayfalama 
            $FavorilerSorgu->execute([$id]);
            $FavorilerKayitSayisi = $FavorilerSorgu->rowCount();
            $FavoriKayitlar = $FavorilerSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($FavorilerKayitSayisi>0){
        foreach ($FavoriKayitlar as $Values) {

            $UrunSorgu = $db->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
            $UrunSorgu->execute([$Values["urunId"]]);
            $UrunKayitSayisi = $UrunSorgu->rowCount();
            $UrunKayit = $UrunSorgu->fetch(PDO::FETCH_ASSOC);
                
                $UrunTuru = DonusumleriGeriDondur($UrunKayit["urunTuru"]);
                $urunAdi = DonusumleriGeriDondur($UrunKayit["urunAdi"]);
                $urunFiyati = DonusumleriGeriDondur($UrunKayit["urunFiyati"]);
                $urunResmiBir = DonusumleriGeriDondur($UrunKayit["urunResmiBir"]);
                $paraBirimi = DonusumleriGeriDondur($UrunKayit["paraBirimi"]);
                $urunID = DonusumleriGeriDondur($UrunKayit["id"]);

                if ($UrunTuru=="Kadın Ayakkabısı") {
                    $ResimKlasorAdi = "Kadin";
                }elseif($UrunTuru=="Erkek Ayakkabısı"){
                    $ResimKlasorAdi = "Erkek";
                }else {
                    $ResimKlasorAdi = "Cocuk";
                }
            ?>
                <ul class="AdresCard SiparisCard FavCard">
                    <li>
                        Id :
                        #<?php echo DonusumleriGeriDondur($Values["urunId"]); ?>
                    </li>
                    <li>
                        <a href="index.php?SK=83&ID=<?php echo $urunID; ?>" class="light"><img src="./resimler/UrunResimleri/<?php echo DonusumleriGeriDondur($ResimKlasorAdi)."/".DonusumleriGeriDondur($urunResmiBir); ?>" alt=""></a>
                    </li>
                    <li>
                        <span>Fiyat :</span>
                        <span><?php echo FiyatBicimlendir(TLCevir(DonusumleriGeriDondur($paraBirimi)) * DonusumleriGeriDondur($urunFiyati));?>  </span>
                    </li>
                    <li>
                    <span>Ürün Adı :</span>
                    <span>
                        <a href="index.php?SK=83&ID=<?php echo $urunID; ?>" class="light"><?php echo DonusumleriGeriDondur($urunAdi); ?></a>
                    </span>
                    </li>
                    <li>
                    <li>
                        <a href="index.php?SK=80&ID=<?php echo DonusumleriGeriDondur($Values["id"]); ?>"><img src="./resimler/Sil20x20.png" alt=""></a>
                    </li>
                </ul>
                    <?php
                    
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
                        echo "<span><a href='index.php?SK=59&SYF=1' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></span>";
                        $Sayfa1GeriAl = $Sayfalama - 1;
                        echo "<span><a href='index.php?SK=59&SYF=".$Sayfa1GeriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></span>";
                    }
                    for ($SayfalamaSayfaIndexi = $Sayfalama - $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi <= $Sayfalama + $SayfalamaIcinSolveSagButonSayisi; $SayfalamaSayfaIndexi++){
                                if(($SayfalamaSayfaIndexi>0)and($SayfalamaSayfaIndexi<=$BulunanSayfaSayisi)){
                                    if($SayfalamaSayfaIndexi==$Sayfalama){
                                        echo "<span class='aktif'>".$SayfalamaSayfaIndexi."</span>";
                                    }else {
                                        echo "<span><a href='index.php?SK=59&SYF=" . $SayfalamaSayfaIndexi . "' class='light'>".$SayfalamaSayfaIndexi."</a></span>";
                                    }
                                }
                    }
                    if($Sayfalama!=$BulunanSayfaSayisi){
                        $Sayfa1IleriAl = $Sayfalama + 1;
                        echo "<span><a href='index.php?SK=59&SYF=".$Sayfa1IleriAl."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></span>";

                        echo "<span><a href='index.php?SK=59&SYF=".$BulunanSayfaSayisi."' class='light'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z'/></svg></a></span>";
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




