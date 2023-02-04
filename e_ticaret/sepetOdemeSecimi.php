<?php 
if(isset($_SESSION["Kullanici"])){

    if(isset($_POST["AdresSecimi"])){
        $GelenAdresSecimi = Guvenlik($_POST["AdresSecimi"]);
    }else {
        $GelenAdresSecimi = "";
    }
    if(isset($_POST["KargoSecimi"])){
        $GelenKargoSecimi = Guvenlik($_POST["KargoSecimi"]);
    }else {
        $GelenKargoSecimi = "";
    }

    if($GelenAdresSecimi!="" and $GelenKargoSecimi!=""){

        $SepetAdresVeKargoGuncelle = $db->prepare("UPDATE sepet SET KargoFirmaId=?, AdresId=? WHERE UyeId=?");
        $SepetAdresVeKargoGuncelle->execute([$GelenKargoSecimi,$GelenAdresSecimi,$id]);
        $AdresKargoGuncelle_KS = $SepetAdresVeKargoGuncelle->rowCount();
        
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
        $KargoDahilToplamFiyat = $sepetToplamFiyat + $kargoToplamFiyat;
        $vadeFarki = ($kargoToplamFiyat * 5) / 100; // % kaç vade farkı olsun istersen 5 yerine onu yaz
    ?>
<form action="index.php?SK=100" method="post" class="SepetDetay">
    <ul class="sepet OdemeTuruSecim">
        <li class="sepetHeader">
            <h2>Alışveriş Sepeti</h2>
            <p>Ödeme Türü seçimini Aşağıdan Belirtebilirsin </p>
        </li>
        <li class="AdresBaslik">
            <h1>Ödeme Türü Seçimi</h1>
        </li>
        <li class="OdemeYKapsayici">
            <div class="OdemeYontemiSec">
                <input type="radio" name="OdemeYontemSec" id="kart" value="KrediKarti" checked="checked">
                <label for="kart" id="KartOdeme">
                    <img src="./resimler/KrediKarti92x75.png" alt="">
                    <span>Banka / Kredi Kartı</span>
                </label>
            </div>
            <div class="OdemeYontemiSec">
                <input type="radio" name="OdemeYontemSec" id="havale" value="Havale">
                <label for="havale" id="HavaleOdeme">
                    <img src="./resimler/Banka80x75.png" alt="">
                    <span>Havale/EFT</span>
                </label>
            </div>

        </li>
        <li class="AdresBaslik KartOdemeClass">
            <h1>Kredi Kartı ile Ödeme</h1>
        </li>
        <li class="bnkimg_s KartOdemeClass">
            <div class="bnkimg"><img src="./resimler/AxessCard46x12.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/BonusCard41x12.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/CardFinans78x12.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/MaximumCard46x12.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/WorldCard48x12.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/ParafCard19x12.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/OdemeSecimiDigerKartlar.png" alt=""></div>
            <div class="bnkimg"><img src="./resimler/OdemeSecimiATMKarti.png" alt=""></div>
        </li>
        <li class="AdresBaslik KartOdemeClass" >
            <h1>Taksit Seçimi</h1>
        </li>
        <?php
        for ($i = 1; $i <= 6; $i++) {
            if($i == 1){
                ?>
        <li class="TaksitSatir KartOdemeClass">
            <input type="radio" value="<?php echo $i;?>" id="<?php echo "Taksit".$i;?>" name="TaksitSec" checked="checked">
            <label for="<?php echo "Taksit".$i;?>"> <span>Tek Çekim</span> <span> <?php echo $i . " X"; ?>
                    <?php echo FiyatBicimlendir($KargoDahilToplamFiyat / $i); ?></span> <span>
                    <?php echo FiyatBicimlendir($KargoDahilToplamFiyat); ?></span> </label>
        </li>
        <?php
            }else {
                ?>
        <li class="TaksitSatir KartOdemeClass">
            <input type="radio" value="<?php echo $i;?>" id="<?php echo "Taksit".$i;?>" name="TaksitSec">
            <label for="<?php echo "Taksit".$i;?>"> <span><?php echo $i;?> Taksit </span> <span>
                    <?php echo $i . " X"; ?>
                    <?php echo FiyatBicimlendir(($KargoDahilToplamFiyat / $i)+$vadeFarki); ?></span> <span>
                    <?php echo FiyatBicimlendir($KargoDahilToplamFiyat + ($i*$vadeFarki)); ?></span> </label>
        </li>
        <?php
            }
            ?>
        <?php
        }
        ?>
        <li class="AdresBaslik HavaleOdeme" style="display: none;">
            <h1>Banka Havalesi / EFT ile Ödeme</h1>
        </li>
        <li class="HavaleOdeme" style="display: none;">
        <p>
            Banka Havalesi / EFT ile ürün satın alabilmek için, öncelikle alışveriş sepeti tutarını <q>Banka Hesaplarımız</q> sayfasında bulunan herhangi bir hesaba ödeme yaptıktan sonra <q>Havale Bildirim Formu</q> aracılığı ile lütfen tarafımıza bilgi veriniz. <q>Ödeme Yap</q> butonuna tıkladığınız anda siparişiniz sisteme kayıt edilecektir. 
        </p>
        </li>
        <?php
            
        }else {
            header("Location:index.php?SK=94"); // sepette ürün yok 
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
            <div><?php echo FiyatBicimlendir($KargoDahilToplamFiyat); ?></div>
        </li>
        <li>
            <button href="index.php?SK=98" class="devamEt"> <img src="./resimler/SepetBeyaz16x16.png" alt=""> Ödeme Yap </button>
        </li>
    </ul>
</form>
<script>
    let KartOdeme = document.getElementById("KartOdeme");
    let HavaleOdeme = document.getElementById("HavaleOdeme");
    let KartOdemeClass = document.querySelectorAll(".KartOdemeClass");
    let bnkimg_s = document.querySelector(".bnkimg_s");
    let HavaleOdemeClass = document.querySelectorAll(".HavaleOdeme");

    KartOdeme.addEventListener("click",()=>{
        KartOdemeClass.forEach(e=>{
            e.style.display = "block";
        });
        bnkimg_s.style.display = "grid";
        HavaleOdemeClass.forEach(e=>{
            e.style.display = "none";
        })
    });
    HavaleOdeme.addEventListener("click",()=>{
        KartOdemeClass.forEach(e=>{
            e.style.display = "none";
        });
        HavaleOdemeClass.forEach(e=>{
            e.style.display = "block";
        });
    });
</script>
<?php
    }else {
        header("Location:index.php?SK=0"); // Değerler boş
        exit();
    }
}else {
	header("Location:index.php?SK=0"); // Anasayfaya dön
	exit();
}
?>