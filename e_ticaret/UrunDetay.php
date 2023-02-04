<?php 
if(isset($_GET["ID"])){
    $GelenID = SayiliIcerikFiltrele(Guvenlik($_GET["ID"]));

    $HitGuncelleS = $db->prepare("UPDATE urunler SET goruntulenmeSayisi = goruntulenmeSayisi + 1 WHERE id=? AND Durumu=? LIMIT 1");
    $HitGuncelleS->execute([$GelenID,1]);


    if(isset($_SESSION["Kullanici"])){
        $FavoriKontrolS = $db->prepare("SELECT * FROM favoriler WHERE urunId=? AND uyeId=? LIMIT 1");
        $FavoriKontrolS->execute([$GelenID,$id]);
        $favoriSil_KS = $FavoriKontrolS->rowCount();
        $favoriKayit = $FavoriKontrolS->fetch(PDO::FETCH_ASSOC);
        if($favoriSil_KS>0){
            $FavImgYol = "./resimler/KalpKirmiziDaireliBeyaz24x24.png";
        }else {
            $FavImgYol = "./resimler/FavoridenCikart.png";
    }
    }


    $UrunlerSorgu = $db->prepare("SELECT * FROM urunler WHERE id = ? AND Durumu = ? LIMIT 1");
    $UrunlerSorgu->execute([$GelenID,1]);
    $UrunKayitSayisi = $UrunlerSorgu->rowCount();
    $urunKayitlari = $UrunlerSorgu->fetch(PDO::FETCH_ASSOC);
    if($UrunKayitSayisi>0){
        if (DonusumleriGeriDondur($urunKayitlari["urunTuru"])=="Kadın Ayakkabısı") {
            $ResimKlasorAdi = "Kadin";
        }elseif(DonusumleriGeriDondur($urunKayitlari["urunTuru"])=="Erkek Ayakkabısı"){
            $ResimKlasorAdi = "Erkek";
        }else {
            $ResimKlasorAdi = "Cocuk";
        }
    ?>
<div class="urunDetaylar">
    <div class="urunResimleri">
        <ul class="resimler">
            <li class="buyukresim">
                <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["urunResmiBir"]?>"
                    alt="" class="b_resim">
                <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["urunResmiIki"]?>"
                    alt="" class="b_resim" style="display: none;">
                <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["UrunResmiUc"]?>"
                    alt="" class="b_resim" style="display: none;">
                <img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["UrunResmiDort"]?>"
                    alt="" class="b_resim" style="display: none;">
            </li>

            <ul class="kucukresimler">
                <?php 
            if($urunKayitlari["urunResmiBir"]!=""){
                ?>
                <li><img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["urunResmiBir"]?>"
                        alt="" class="k_resim"></li>
                <?php
            }
            ?>
                <?php 
            if($urunKayitlari["urunResmiIki"]!=""){
                ?>
                <li><img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["urunResmiIki"]?>"
                        alt="" class="k_resim"></li>
                <?php
            }
            ?>
                <?php 
            if($urunKayitlari["UrunResmiUc"]!=""){
                ?>
                <li><img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["UrunResmiUc"]?>"
                        alt="" class="k_resim"></li>
                <?php
            }
            ?>
                <?php 
            if($urunKayitlari["UrunResmiDort"]!=""){
                ?>
                <li><img src="./resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$urunKayitlari["UrunResmiDort"]?>"
                        alt="" class="k_resim"></li>
                <?php
            }
            ?>
            </ul>
        </ul>
    </div>
    <ul class="urunBilgileri">
        <li><?php echo DonusumleriGeriDondur($urunKayitlari["urunAdi"]); ?></li>
        <li><?php echo FiyatBicimlendir(TLCevir(DonusumleriGeriDondur($urunKayitlari["paraBirimi"])) * DonusumleriGeriDondur($urunKayitlari["urunFiyati"]));?>
        </li>
        <li>
            <a href="<?php echo DonusumleriGeriDondur($FacebookLink); ?>" class="light" target="_blank"><img
                    src="./resimler/Facebook24x24.png" alt=""></a>
            <a href="<?php echo DonusumleriGeriDondur($TwitterLink); ?>" class="light" target="_blank"><img
                    src="./resimler/Twitter24x24.png" alt=""></a>
            <?php 
                if(isset($_SESSION["Kullanici"])){
                    ?>
            <a href="index.php?SK=87&ID=<?php echo DonusumleriGeriDondur($urunKayitlari["id"]); ?>" class="light">
                <img src="<?php echo $FavImgYol; ?>" alt=""></a>
            <?php
                }else {
                    ?>
            <a href="index.php?SK=31" class="light" target="_blank"><img src="<?php echo $FavImgYol; ?>" alt=""></a>
            <?php
                }
                ?>
        </li>
        <li>
            <form action="index.php?SK=91&ID=<?php echo DonusumleriGeriDondur($urunKayitlari["id"])?>" method="post">
                <?php 
                $VaryantSorgu = $db->prepare("SELECT * FROM urunvaryantlari WHERE urunId = ? AND StokAdedi > 0 ORDER BY varyantAdi ASC");
                $VaryantSorgu->execute([$GelenID]);
                $Varyant_KS = $VaryantSorgu->rowCount();
                $VaryantKayit = $VaryantSorgu->fetchAll(PDO::FETCH_ASSOC);
                foreach($VaryantKayit as $value){
                    ?>
                <span class="f_group">
                    <label
                        for="<?php echo DonusumleriGeriDondur($value["id"]);?>"><?php echo DonusumleriGeriDondur($value["varyantAdi"]);?></label>
                    <input type="radio" name="varyantlar" value="<?php echo DonusumleriGeriDondur($value["id"]);?>"
                        id="<?php echo DonusumleriGeriDondur($value["id"]);?>" class="f_groupInput">
                </span>
                <?php
                }
                if($Varyant_KS>0){
            ?>

                <button>
                    <img src="./resimler/SepetBeyaz21x20.png" alt=""> <span>Sepete Ekle</span>
                </button>
                <?php }else {
                    echo "Stok Yok";
                } ?>
            </form>
        </li>
        <li>
            <img src="./resimler/SaatEsnetikGri20x20.png" alt=""> <span>Siparişiniz <?php echo UcGunIleriTarihBul(); ?>
                tarihine kadar kargoya verilecektir. </span>
        </li>
        <li>
            <img src="./resimler/SaatHizCizgiliLacivert20x20.png" alt=""> <span>fast kargo aynı gün teslim kapsamında
                ürün</span>
        </li>
        <li>
            <img src="./resimler/KrediKarti20x20.png" alt=""> <span>Kresi Kartı / Banka kartı ile ödeme</span>
        </li>
        <li>
            <img src="./resimler/Banka20x20.png" alt=""> <span>Havale ile ödeme</span>
        </li>
        <li>
            <h3>Ürün Açıklaması</h3>
            <?php echo $urunKayitlari["urunAciklamasi"]?>
        </li>
    </ul>
</div>
<div class="urunYorumlari">
    <h1>Ürün Yorumları</h1>
    <ul class="yorumlar_">
        <?php 
            $Yorumlar_Sorgu = $db->prepare("SELECT * FROM yorumlar WHERE urunId = ? ORDER BY yorumTarihi DESC");            
            $Yorumlar_Sorgu->execute([$GelenID]);            
            $Yorumlar_KS = $Yorumlar_Sorgu->rowCount();            
            $Yorumlar_Kayitlar = $Yorumlar_Sorgu->fetchAll(PDO::FETCH_ASSOC);
            if($Yorumlar_KS>0){
                foreach($Yorumlar_Kayitlar as $values){
                    $verilenPuan = DonusumleriGeriDondur($values["puan"]);
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
                    $YorumYapanUye_S = $db->prepare("SELECT * FROM uyeler WHERE id = ? LIMIT 1");            
                    $YorumYapanUye_S->execute([$values["uyeId"]]);
                    $Uyeler_Kayit = $YorumYapanUye_S->fetch(PDO::FETCH_ASSOC);
                    ?>
        <li>
            <h2><?php echo DonusumleriGeriDondur($Uyeler_Kayit["isimSoyisim"])?></h2>
            <?php echo $ResimDosyasi; ?>
            <p><?php echo DonusumleriGeriDondur($values["yorumMetni"])?></p>
        </li>
        <?php
                }
            }else {
                ?>
        <li>
            bu ürün için henüz bir yorum eklenmemiş.
        </li>
        <?php
            }
        ?>
    </ul>
</div>
<?php
}else {
        header("Location:index.php?SK=0"); 
        exit();
      }
}else {
    header("Location:index.php?SK=0"); 
    exit();
}
?>