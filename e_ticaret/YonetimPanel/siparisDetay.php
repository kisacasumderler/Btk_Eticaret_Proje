<?php 
if(isset($_SESSION["Yonetici"])){
    if(isset($_REQUEST["SepetNo"])){
        $GelenSepetNo = Guvenlik($_REQUEST["SepetNo"]);
    }else {
        $GelenSepetNo = "";
    }
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">Sipariş Detay</h1>
</div>
<div class="BtnDiv">
    <a href="index.php?SKD=0&SKI=106" class="addBtn">Bekleyen Siparişlere Dön</a>
</div>
<ul>
    <?php 
        $siparislerSorgu = $db->prepare("SELECT * FROM siparisler WHERE OnayDurumu=? AND siparisNumarasi=? AND kargoDurumu=?");
        $siparislerSorgu->execute([0,$GelenSepetNo,0]);
        $siparisler_KS = $siparislerSorgu->rowCount();
        $siparisKayitlar = $siparislerSorgu->fetchAll(PDO::FETCH_ASSOC);
        if($siparisler_KS>0){
        ?>
    <div class="SiteBaslik" style="background: transparent; color: black; border-bottom: 2px dotted black;">
        <span class="ListBaslik" style="font-size : 1.2rem;">Sipariş Numarası : </span>
        <span><?php echo DonusumleriGeriDondur($GelenSepetNo);?></span>
    </div>
    <div class="flexRowStart" style="padding: 1rem; margin: 2rem 0;">
        <div class="width100 displayGrid">
            <?php
             foreach($siparisKayitlar as $Values){

                if (DonusumleriGeriDondur($Values["urunTuru"])=="Kadın Ayakkabısı") {
                    $ResimKlasorAdi = "Kadin";
                    }elseif(DonusumleriGeriDondur($Values["urunTuru"])=="Erkek Ayakkabısı"){
                        $ResimKlasorAdi = "Erkek";
                    }else {
                        $ResimKlasorAdi = "Cocuk";
                    }

                 $urunToplamFiyat = FiyatBicimlendir($Values["topamUrunFiyati"]);
                 $siparisTarihi = Tarihbul($Values["siparisTarihi"]);
                 $AdSoyad = DonusumleriGeriDondur($Values["AdresAdiSoyadi"]);
                 $AdresDetay = DonusumleriGeriDondur($Values["AdresDetay"]);
                 $AdresTelefon = DonusumleriGeriDondur($Values["AdresTelefon"]);
                 $odemeSecimi = DonusumleriGeriDondur($Values["odemeSecimi"]);
                 $TaksitSecimi = DonusumleriGeriDondur($Values["TaksitSecimi"]);
                 $kargoFirmasiSecimi = DonusumleriGeriDondur($Values["kargoFirmasiSecimi"]);

                 ?>
            <div class="uruncard">
                <div>
                    <span class="ListBaslik"
                        style="font-size : 1.2rem;"><?php echo DonusumleriGeriDondur($Values["urunAdi"]);?></span>
                </div>
                <div class="imgGroup">
                    <img src="../resimler/UrunResimleri/<?php echo $ResimKlasorAdi."/".$Values["urunResmiBir"]; ?>"
                        alt="">
                </div>
                <div>
                    <span class="ListBaslik" style="font-size : 1.2rem;">Ürün Fiyatı : </span>
                    <span><?php echo DonusumleriGeriDondur($Values["urunFiyati"]);?></span>
                </div>
                <div>
                    <span class="ListBaslik" style="font-size : 1.2rem;">KDV Oranı : </span>
                    <span>%<?php echo DonusumleriGeriDondur($Values["kdvOrani"]);?></span>
                </div>
                <div>
                    <span class="ListBaslik" style="font-size : 1.2rem;">Ürün Adedi : </span>
                    <span><?php echo DonusumleriGeriDondur($Values["urunAdedi"]);?></span>
                </div>
                <div>
                    <span class="ListBaslik" style="font-size : 1.2rem;">Kargo Ücreti : </span>
                    <span><?php echo DonusumleriGeriDondur(FiyatBicimlendir($Values["kargoUcreti"]));?></span>
                </div>
                <div>
                    <span class="ListBaslik" style="font-size : 1.2rem;">
                        <?php echo DonusumleriGeriDondur($Values["varyantBasligi"]);?> :</span>
                    <span><?php echo DonusumleriGeriDondur($Values["varyantSecimi"]);?></span>
                </div>

            </div>
            <?php
             }
            ?>
        </div>
        <div class="width50 flexColumnCenter gap1 UrunDetaySagTaraf">
            <div>
                <form action="index.php?SKD=0&SKI=110" method="post" class="width100 flexColumnCenter" style="gap: 1rem;">
                    <input type="hidden" value="<?php echo $GelenSepetNo;?>" name="SiparisNo">
                    <input type="text" class="width100 InputClass" name="SiparisKod">
                    <button class="addBtn" style="cursor: pointer;">Kargo Kodu İşle ve Siparişi Tamamla</button>
                </form>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Adı Soyadı : </span>
                <span><?php echo $AdSoyad;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Telefon Numarası : </span>
                <span><?php echo $AdresTelefon;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Adres Detay  : </span>
                <span><?php echo $AdresDetay;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Ödeneme Türü : </span>
                <span><?php echo $odemeSecimi;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Taksit Seçimi : </span>
                <span><?php echo $TaksitSecimi;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Kargo Seçimi : </span>
                <span><?php echo $kargoFirmasiSecimi;?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Sipariş Tarihi : </span>
                <span><?php echo DonusumleriGeriDondur($siparisTarihi);?></span>
            </div>
            <div>
                <span class="ListBaslik" style="font-size : 1.2rem;">Sipariş Toplam Tutarı : </span>
                <span><?php echo DonusumleriGeriDondur($urunToplamFiyat);?></span>
            </div>
        </div>
    </div>
    <?php
    }else {
        header("location:index.php?SKD=0&SKI=0");
        exit();
    }
    ?>
</ul>
<?php
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>