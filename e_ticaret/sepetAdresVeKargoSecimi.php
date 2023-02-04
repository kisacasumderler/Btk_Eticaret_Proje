<?php 
if(isset($_SESSION["Kullanici"])){
    ?>
<form action="index.php?SK=99" method="post" class="SepetDetay">
    <ul class="sepet Adresler">
        <li class="sepetHeader">
            <h2>Alışveriş Sepeti</h2>
            <p>Adres ve kargo seçimini aşağıdan belirtebilirsin. </p>
        </li>
        <?php
        $SepettekiUrunler = $db->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC");
        $SepettekiUrunler->execute([$id]);
        $SepettekiUrunler_KS = $SepettekiUrunler->rowCount();
        $SepettekiUrunler_S = $SepettekiUrunler->fetchAll(PDO::FETCH_ASSOC);

        $sepetToplamUrunSayisi = 0;
        $sepetToplamFiyat = 0;
        $kargoToplamFiyat = 0;

        if($SepettekiUrunler_KS>0){
            foreach($SepettekiUrunler_S as $values){
                $SepettekiUrunID = DonusumleriGeriDondur($values["urunId"]); // ürün id 
                $SepettekiUrunVaryantID = DonusumleriGeriDondur($values["VaryantId"]); // varyant id 
                $SepettekiUrunAdedi = DonusumleriGeriDondur($values["urunAdedi"]); // ürün adet 

                    $urunBilgileriSorgu = $db->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
                    $urunBilgileriSorgu->execute([$SepettekiUrunID]);
                    $UrunKaydi = $urunBilgileriSorgu->fetch(PDO::FETCH_ASSOC);
                    // ürün bilgileri

                        $urunParaBirimi = DonusumleriGeriDondur($UrunKaydi["paraBirimi"]);
                        $urunVaryantBasligi = DonusumleriGeriDondur($UrunKaydi["varyantBasligi"]);
                        $urunFiyat = DonusumleriGeriDondur($UrunKaydi["urunFiyati"]);
                        $TLFiyat = TLCevir($urunParaBirimi) * $urunFiyat;
                        $UrunKargoUcreti = DonusumleriGeriDondur($UrunKaydi["kargoUcreti"]);

                    $varyantBilgileriSorgu = $db->prepare("SELECT * FROM urunvaryantlari WHERE id=?  LIMIT 1");
                    $varyantBilgileriSorgu->execute([$SepettekiUrunVaryantID]);
                    $varyantKaydi = $varyantBilgileriSorgu->fetch(PDO::FETCH_ASSOC);

                    $urunStokAdedi = DonusumleriGeriDondur($varyantKaydi["StokAdedi"]);


                $sepetToplamUrunSayisi += $SepettekiUrunAdedi;
                $sepetToplamFiyat += ($TLFiyat * $SepettekiUrunAdedi);
                
                $urunFiyatHesapla = $TLFiyat * $SepettekiUrunAdedi;

                if($sepetToplamFiyat>=$ucretsizKargoBaraji){
                    $kargoToplamFiyat = 0;
                }else {
                    $kargoToplamFiyat += ($UrunKargoUcreti * $SepettekiUrunAdedi);
                }
                
                if($SepettekiUrunAdedi>$urunStokAdedi){
                    $sepetGuncelle = $db->prepare("UPDATE sepet SET urunAdedi=? WHERE id = ? AND UyeId = ? LIMIT 1");
                    $sepetGuncelle->execute([$urunStokAdedi,$values["id"],$id]);
                } 
            }
            // adres sorgusu 
            $KullaniciAdresler = $db->prepare("SELECT * FROM adresler WHERE UyeId=? ORDER BY id DESC");
            $KullaniciAdresler->execute([$id]);
            $Adresler_KS = $KullaniciAdresler->rowCount();
            $AdresKayitlar = $KullaniciAdresler->fetchAll(PDO::FETCH_ASSOC);
            ?>
        <li class="AdresBaslik">
            <h1>Adres Seçimi</h1>
        </li>
        <li>
            <a href="index.php?SK=70" class="light"> + Yeni Adres Ekle </a>
        </li>
        <?php
            if($Adresler_KS>0){
                foreach($AdresKayitlar as $AdresSatirlar){
                    ?>
        <li>
            <input type="radio" id="<?php echo DonusumleriGeriDondur($AdresSatirlar["id"]); ?>" name="AdresSecimi"
                value="<?php echo DonusumleriGeriDondur($AdresSatirlar["id"]); ?>">
            <label for="<?php echo DonusumleriGeriDondur($AdresSatirlar["id"]); ?>">
                <span> <?php echo DonusumleriGeriDondur($AdresSatirlar["AdresBaslik"]); ?></span>
                <span>İsim Soyisim : <?php echo DonusumleriGeriDondur($AdresSatirlar["adiSoyadi"]); ?></span>
                <span><?php echo DonusumleriGeriDondur($AdresSatirlar["Adres"]); ?></span>
                <span><?php echo DonusumleriGeriDondur($AdresSatirlar["Ilce"]); ?> /
                    <?php echo DonusumleriGeriDondur($AdresSatirlar["Sehir"]); ?> </span>
                <span><?php echo DonusumleriGeriDondur($AdresSatirlar["TelefonNumarasi"]); ?></span>
            </label>
        </li>
        <?php
                }

            }else {
                ?>
        <li>
            Sisteme kayıtlı adresiniz bulunmamaktadır. <a href="index.php?SK=70" class="light"
                style="font-weight: bold;"> Buraya </a> tıklayarak
            öncelikle hesabınıza adres ekledikten sora işleme devam edebilirsiniz.
        </li>
        <?php
            }
            ?>
        <li class="AdresBaslik">
            <h1>Kargo Firmaları Seçimi</h1>
        </li>
        <?php
        // kargo firmaları sorgu 
        $KargoFirmalari = $db->prepare("SELECT * FROM kargofirmalari");
        $KargoFirmalari->execute();
        $Adresler_KS = $KargoFirmalari->rowCount();
        $KargolarKayit = $KargoFirmalari->fetchAll(PDO::FETCH_ASSOC);
            foreach($KargolarKayit as $KargolarSatirlar){
                ?>
        <li>
            <input type="radio" id="<?php echo DonusumleriGeriDondur($KargolarSatirlar["id"]);?>" name="KargoSecimi"
                value="<?php echo DonusumleriGeriDondur($KargolarSatirlar["id"]);?>">
            <label for="<?php echo DonusumleriGeriDondur($KargolarSatirlar["id"]);?>">
                <img src="./resimler/<?php echo DonusumleriGeriDondur($KargolarSatirlar["KargoFirmaLogo"]);?>"
                    alt="<?php echo DonusumleriGeriDondur($KargolarSatirlar["KargoFirmaAdi"]);?>">
            </label>
        </li>
        <?php
            }
        }else {
            header("Location:index.php?SK=94");
            exit();
        }
        ?>

    </ul>
    <ul class="SepetUrunBilgiler">
        <li class="sepetHeader">
            <h2>Sipariş Özeti</h2>
            <p>Toplam <?php echo $sepetToplamUrunSayisi; ?> Adet Ürün</p>
        </li>
        <li>
            <?php
            ?>
            <div>Ürünler Toplam Fiyat : <?php echo FiyatBicimlendir($sepetToplamFiyat); ?> </div>
            <div><?php
            if($kargoToplamFiyat==0){
                ?>
                Kargo Ücretsiz
                <?php
            }else {
                ?>
                Kargo Toplam Fiyat : <?php echo FiyatBicimlendir($kargoToplamFiyat); ?>
                <?php
            }
            ?></div>
            <div style="background: #efefef; padding: .5rem 0; font-weight: bold; margin-top: 1rem;">Toplam Ödenecek
                fiyat (KDV Dahil)</div>
            <div><?php echo FiyatBicimlendir($sepetToplamFiyat+$kargoToplamFiyat); ?></div>
        </li>
        <li>
            <button href="index.php?SK=98" class="devamEt"> <img src="./resimler/SepetBeyaz16x16.png" alt=""> Devam
                Et</button>
        </li>
    </ul>
</form>
<?php

}else {
	header("Location:index.php?SK=0"); // Anasayfaya dön
	exit();
}
?>