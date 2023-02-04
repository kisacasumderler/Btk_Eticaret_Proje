<?php 
if(isset($_SESSION["Kullanici"])){
    ?>
<div class="SepetDetay">
    <ul class="SepetUrunler">
        <li class="sepetHeader">
            <h2>Alışveriş Sepeti</h2>
            <p>Alışveriş Sepetine eklemiş olduğunuz Ürünler Aşağıdadır.</p>
        </li>
        <?php

        $SepetSifirla = $db->prepare("UPDATE sepet SET AdresId=?, KargoFirmaId=?, odemeSecimi=?, TaksitSecimi=? WHERE UyeId=? LIMIT 1");
        $SepetSifirla->execute([0,0,0,0,$id]);

        $SepettekiUrunler = $db->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC");
        $SepettekiUrunler->execute([$id]);
        $SepettekiUrunler_KS = $SepettekiUrunler->rowCount();
        $SepettekiUrunler_S = $SepettekiUrunler->fetchAll(PDO::FETCH_ASSOC);

        $sepetToplamUrunSayisi = 0;
        $sepetToplamFiyat = 0;

        if($SepettekiUrunler_KS>0){
            foreach($SepettekiUrunler_S as $values){
                $SepettekiUrunID = DonusumleriGeriDondur($values["urunId"]); // ürün id 
                $SepettekiUrunVaryantID = DonusumleriGeriDondur($values["VaryantId"]); // varyant id 
                $SepettekiUrunAdedi = DonusumleriGeriDondur($values["urunAdedi"]); // ürün adet 

                    $urunBilgileriSorgu = $db->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
                    $urunBilgileriSorgu->execute([$SepettekiUrunID]);
                    $UrunKaydi = $urunBilgileriSorgu->fetch(PDO::FETCH_ASSOC);
                    // ürün bilgileri

                        $urunResmi = DonusumleriGeriDondur($UrunKaydi["urunResmiBir"]); 
                        $urunTuru = DonusumleriGeriDondur($UrunKaydi["urunTuru"]);
                        $urunAdi = DonusumleriGeriDondur($UrunKaydi["urunAdi"]);
                        $urunParaBirimi = DonusumleriGeriDondur($UrunKaydi["paraBirimi"]);
                        $urunVaryantBasligi = DonusumleriGeriDondur($UrunKaydi["varyantBasligi"]);
                        $urunFiyat = DonusumleriGeriDondur($UrunKaydi["urunFiyati"]);
                        $TLFiyat = TLCevir($urunParaBirimi) * $urunFiyat;

                    $varyantBilgileriSorgu = $db->prepare("SELECT * FROM urunvaryantlari WHERE id=?  LIMIT 1");
                    $varyantBilgileriSorgu->execute([$SepettekiUrunVaryantID]);
                    $varyantKaydi = $varyantBilgileriSorgu->fetch(PDO::FETCH_ASSOC);

                        $urunVaryantAdi = DonusumleriGeriDondur($varyantKaydi["varyantAdi"]);
                        $urunStokAdedi = DonusumleriGeriDondur($varyantKaydi["StokAdedi"]);

                if ($urunTuru=="Kadın Ayakkabısı") {
                    $ResimKlasorAdi = "Kadin";
                }elseif($urunTuru=="Erkek Ayakkabısı"){
                    $ResimKlasorAdi = "Erkek";
                }else {
                    $ResimKlasorAdi = "Cocuk";
                }

                $sepetToplamUrunSayisi += $SepettekiUrunAdedi;
                $sepetToplamFiyat += ($TLFiyat * $SepettekiUrunAdedi);
                $urunFiyatHesapla = $TLFiyat * $SepettekiUrunAdedi;
                
                if($SepettekiUrunAdedi>$urunStokAdedi){
                    $sepetGuncelle = $db->prepare("UPDATE sepet SET urunAdedi=? WHERE id = ? AND UyeId = ? LIMIT 1");
                    $sepetGuncelle->execute([$urunStokAdedi,$values["id"],$id]);
                }
            ?>
        <li>
            <span>
                <a href="index.php?SK=83&ID=<?php echo $SepettekiUrunID; ?>">
                    <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi . "/" . $urunResmi; ?>" alt="">
                </a>
            </span>
            <span>
                <a href="index.php?SK=95&ID=<?php echo DonusumleriGeriDondur($values["id"]); ?>">
                    <img src="./resimler/SilDaireli20x20.png" alt="">
                </a>
            </span>
            <span>
                <h1>
                    <?php echo $urunAdi;?>
                </h1>
            </span>
            <span>
                Numara : <?php echo $urunVaryantAdi;?>
            </span>
            <span>
                <?php
                if($SepettekiUrunAdedi>1){
                    ?>
                <a href="index.php?SK=97&ID=<?php echo DonusumleriGeriDondur($values["id"]); ?>"><img
                        src="./resimler/AzaltDaireli20x20.png" alt=""></a>
                <?php
                }else {
                    ?>
                <div style="width: 30px; height: 30px;"></div>
                <?php
                }
                ?>
                <span><?php echo $SepettekiUrunAdedi; ?></span>
                <?php
                if($urunStokAdedi<=$SepettekiUrunAdedi){
                    ?>
                    <div style="width: 30px; height: 30px;"></div>
                    <?php
                }else {
                ?>
                <a href="index.php?SK=96&ID=<?php echo DonusumleriGeriDondur($values["id"]); ?>"><img
                        src="./resimler/ArttirDaireli20x20.png" alt=""></a>
                <?php
                      }          
                ?>

            </span>
            <span>
                <small>Birim Fiyat :</small> <?php echo FiyatBicimlendir($TLFiyat);?>
                <small>Toplam Fiyat :</small> <?php echo FiyatBicimlendir($urunFiyatHesapla);?>
            </span>
        </li>
        <?php
            }
        }else {
            ?>
        <li>
            Alışveriş Sepetinizde ürün bulunmamaktadır.
        </li>
        <?php
        }
        ?>

    </ul>
    <ul class="SepetUrunBilgiler">
        <li class="sepetHeader">
            <h2>Sipariş Özeti</h2>
            <p>Toplam <?php echo $sepetToplamUrunSayisi; ?> Adet Ürün</p>
        </li>
        <li>
            <div>Toplam fiyat (KDV Dahil)</div>
            <div><?php echo FiyatBicimlendir($sepetToplamFiyat); ?> </div>
        </li>
        <li>
            <a href="index.php?SK=98" class="devamEt"> <img src="./resimler/SepetBeyaz16x16.png" alt=""> Devam Et</a>
        </li>
    </ul>
</div>
<?php

}else {
	header("Location:index.php?SK=0"); // Anasayfaya dön
	exit();
}
?>