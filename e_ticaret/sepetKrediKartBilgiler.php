<?php 
if(isset($_SESSION["Kullanici"])){

        
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
            $SepetFaturaNO = DonusumleriGeriDondur($values["sepetNumarasi"]);

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

$clientId = DonusumleriGeriDondur($ClientID);	//	Bankadan Sanal Pos Onaylanınca Bankanın Verdiği İşyeri Numarası
$amount = $KargoDahilToplamFiyat;	//	Sepet Ücreti yada İşlem Tutarı yada Karttan Çekilecek Tutar
$oid			=	$SepetFaturaNO;	//	Sipariş Numarası (Tekrarlanmayan Bir Değer) (Örneğin Sepet Tablosundaki IDyi Kullanabilirsiniz) (Her İşlemde Değişmeli ve Asla Tekrarlanmamalı)
$okUrl			=	"http://localhost/e_ticaret/index.php/KrediKartiOdemeTamam";	//	Ödeme İşlemi Başarıyla Gerçekleşir ise Dönülecek Sayfa / buraya kısa kod yazma 
$failUrl		=	"http://localhost/e_ticaret/index.php/KrediKartiOdemeRet";	//	Ödeme İşlemi Red Olur ise Dönülecek Sayfa / buraya kısa kod yazma 
$rnd			=	@microtime();
$storekey		=	DonusumleriGeriDondur($StoreKey);	// Sanal Pos Onaylandığında Bankanın Size Verdiği Sanal Pos Ekranına Girerek Oluşturulacak Olan İş Yeri Anahtarı
$storetype		=	"3d";	//	3D Modeli
$hashstr		=	$clientId.$oid.$amount.$okUrl.$failUrl.$rnd.$storekey;	// Bankanın Kendi Ayarladığı Hash Parametresi
$hash			=	@base64_encode(@pack('H*',@sha1($hashstr)));	// Bankanın Kendi Ayarladığı Hash Şifreleme Parametresi
$description	=	"ürün Satışı";	//	Extra Bir Açıklama Yazmak İsterseniz Çekim İle İlgili Buraya Yazıyoruz / bu alan zorunlu değil 
$xid			=	"";		//	20 bytelik, 28 Karakterli base64 Olarak Boş Bırılınca Sistem Tarafindan Ototmatik Üretilir. Lütfen Boş Bırakın
$lang			=	"";		//	Çekim Gösterim Dili Default Türkçedir. Ayarlamak İsterseniz Türkçe (tr), İngilizce (en) Girilmelidir. Boş Bırakılırsa (tr) Kabu Edilmiş Olur.
$email			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın E-Mail Adresini Gönderebilirsiniz
$userid			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın Idsini Gönderebilirsiniz
    ?>
<form method="post" action="https://<sunucu_adresi>/<3dgate_path>" class="SepetDetay">
    <!-- Bu Adres Banka veya EST Firması Tarafından Verilir -->

    <ul class="sepet OdemeTuruSecim">
        <li class="sepetHeader">
            <h2>Ödeme</h2>
            <p>Kredi Kartı Bilgilerini aşağıdan belirtebilir ve Ödeme yapabilirsin. </p>
        </li>
        <!-- form buraya  -->
        <input type="hidden" name="clientid" value="<?=$clientId?>" />
        <input type="hidden" name="amount" value="<?=$amount?>" />
        <input type="hidden" name="oid" value="<?=$oid?>" />
        <input type="hidden" name="okUrl" value="<?=$okUrl?>" />
        <input type="hidden" name="failUrl" value="<?=$failUrl?>" />
        <input type="hidden" name="rnd" value="<?=$rnd?>" />
        <input type="hidden" name="hash" value="<?=$hash?>" />
        <input type="hidden" name="storetype" value="3d" />
        <input type="hidden" name="lang" value="tr" />
        <li class="CardItem">
            <label for="KartNO">Kredi Kart Numarası</label>
            <input type="text" name="pan" id="KartNO" maxlength="16" />
        </li>

        <li class="CardItem">
            <div>Son Kullanma Tarihi</div>
            <div class="inputgroup">
                <label for="Ay">Ay</label>
                <select name="Ecom_Payment_Card_ExpDate_Month" id="Ay">
                    <option value=""></option>
                    <?php 
            for ($i = 1; $i <= 12; $i++) {
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
            }
            ?>
                </select>
            </div>
            <div class="inputgroup">
                <label for="Yil"> Yıl </label>
                <select name="Ecom_Payment_Card_ExpDate_Year" id="Yil">
                    <option value=""></option>
                    <?php 
            for ($i = 2023; $i <= 2031; $i++) {
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
            }
            ?>
                </select>
            </div>
        </li>
        <li class="CardItem">
            <div>Kart Türü</div>
            <div class="inputgroup">
                <input type="radio" value="1" name="cardType" id="visa"> <label for="visa">Visa</label>
            </div>
            <div class="inputgroup">
                <input type="radio" value="2" name="cardType" id="master"> <label for="master">MasterCard</label>
            </div>
        </li>
        <li class="CardItem">
            <label for="GKodu">Güvenlik Kodu</label>
            <input type="text" name="cv2" size="4" value="" id="GKodu" maxlength="3" />
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
            <button href="index.php?SK=98" class="devamEt"> <img src="./resimler/SepetBeyaz16x16.png" alt=""> Ödeme Yap
            </button>
        </li>
    </ul>
</form>
<?php
    }else {
        header("Location:index.php?SK=0"); 
        exit();
    }
?>