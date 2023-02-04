<?php
session_start(); ob_start();

require_once("./Ayarlar/Ayar.php");
require_once("./Ayarlar/fonksiyonlar.php");
require_once("./Ayarlar/SiteSayfalari.php");

if(isset($_REQUEST["SK"])) {
    $SK_Degeri = SayiliIcerikFiltrele($_REQUEST["SK"]);
}else {
    $SK_Degeri = 0;
}

if(isset($_REQUEST["SYF"])) {
    $Sayfalama = SayiliIcerikFiltrele($_REQUEST["SYF"]);
}else {
    $Sayfalama = 1;
}

?>
<!DOCTYPE html>
<html lang="tr-TR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset= utf-8">
    <meta http-equiv="Content-Language" content="tr">
    <meta name="Robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="revisit-after" content="7 Days">
    <base href="/e_ticaret/">
    <title><?php echo DonusumleriGeriDondur($SiteTitle); ?></title>
    <link rel="icon" type="image/png" href="<?php echo DonusumleriGeriDondur($SiteLogosu); ?>">
    <meta name="description" content="<?php echo DonusumleriGeriDondur($SiteDecscription); ?>">
    <meta name="keywords" content="<?php echo DonusumleriGeriDondur($SiteKeywords); ?>">
    <script type="text/javascript" src="./Frameworks/JQuery/jquery-3.6.2.min.js"></script>
    <link rel="stylesheet" href="./Ayarlar/still.css">
    <link rel="stylesheet" href="./Ayarlar/App.css">
</head>

<body>
    <header>
        <?php 
            $UstBannerSorgu = $db->prepare("SELECT * FROM bannerlar WHERE bannerAlani='IndexUst' ORDER BY GosterimSayisi ASC ");
            $UstBannerSorgu->execute();
            $UstBannerKayit = $UstBannerSorgu->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="manset">
            <img src="./resimler/Bannerlar/<?php echo $UstBannerKayit["BannerResmi"]?>" alt="">
        </div>
        <?php
           $UstBannerHitGuncelle = $db->prepare("UPDATE bannerlar SET GosterimSayisi = GosterimSayisi+1 WHERE id=? LIMIT 1");
           $UstBannerHitGuncelle->execute([$UstBannerKayit["id"]]);
        ?>
        <div class="logoandMenu">
            <ul class="uyelik">
                <?php 
                if(isset($_SESSION["Kullanici"])){
                    ?>
                <li>
                    <img src="./resimler/KullaniciBeyaz16x16.png" alt="">
                    <a href="hesabim/uyelik-bilgilerim" class="dark"><?php echo $isimSoyisim; ?></a>
                </li>
                <li>
                    <img src="./resimler/CikisBeyaz16x16.png" alt="">
                    <a href="uyeCikis" class="dark">Çıkış yap</a>
                </li>
                <?php
                }else {
                ?>
                <li>
                    <img src="./resimler/KullaniciBeyaz16x16.png" alt="">
                    <a href="uye-giris" class="dark">Giriş Yap</a>
                </li>
                <li>
                    <img src="./resimler/KullaniciEkleBeyaz16x16.png" alt="">
                    <a href="yeniuyeformu" class="dark">Yeni Üye Ol</a>
                </li>
                <?php 
                                    
                }
                ?>
                <li>
                    <?php 
                        if(isset($_SESSION["Kullanici"])){?>
                    <img src="./resimler/SepetBeyaz16x16.png" alt="">
                    <a href="sepet" class="dark">Sepet</a>
                    <?php
                    }else {
                    ?>
                    <img src="./resimler/SepetBeyaz16x16.png" alt="">
                    <a href="uye-giris" class="dark">Sepet</a> <!-- buradaki linke yönlendirme eklenecek !-->
                    <?php
                    }
                    ?>

                </li>
            </ul>
            <nav>
                <div class="logo">
                    <a href="anasayfa"><img src="<?php echo DonusumleriGeriDondur($SiteLogosu); ?>" alt=""></a>
                </div>
                <div class="navbarIcons">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="OnpenIcon non_select">
                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="closeIcon non_select">
                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path
                            d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                    </svg>
                </div>
                <ul class="navbar">
                    <li>
                        <a href="anasayfa" class="light">Anasayfa</a>
                    </li>
                    <li>
                        <a href="erkek-ayakkabilari" class="light">Erkek Ayakkabı</a>
                    </li>
                    <li>
                        <a href="kadin-ayakkabilari" class="light">Kadın Ayakkabı</a>
                    </li>
                    <li>
                        <a href="cocuk-ayakkabilari" class="light">Çocuk Ayakkabı</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- içerik -->
    <main class="icerik">
        <?php
       if((!$SK_Degeri) or ($SK_Degeri=="") or ($SK_Degeri==0)){
            include($Sayfa[0]);
       }else {
            include($Sayfa[$SK_Degeri]);
       }
       ?>
    </main>
    <!-- içerik -->
    <footer>
    <ul class="HomeFooter">
    <li>
        <img src="./resimler/HizliTeslimat.png" alt="">
        <h2>Bugün Teslimat</h2>
        <p>Saat 14:00'a kadar verdiğiniz sipaişler aynı gün kapınızda.</p>
    </li>
    <li>
        <img src="./resimler/GuvenliAlisveris.png" alt="">
        <h2>Tek Tıkla Güvenli Alışveriş</h2>
        <p>Ödeme ve adres bilgilerinizi kaydedin. Güvenli alışveriş yapın.</p>
    </li>
    <li>
        <img src="./resimler/MobilErisim.png" alt="">
        <h2>Mobil erişim</h2>
        <p>Dilediğiniz her cihazdan sitemize erişebilir ve alışveriş yapabilirsiniz.</p>
    </li>
    <li>
        <img src="./resimler/IadeGarantisi.png" alt="">
        <h2>Kolay iade</h2>
        <p>Aldığınız herhangi bir ürünü 14 gün içerisinde kolaylıkla iade edebilirsiniz.</p>
    </li>
</ul>
        <ul class="footerNav">
            <li>
                <ul class="Kurumsal">
                    <li>
                        <h1 class="light">Kurumsal</h1>
                    </li>
                    <li><a href="hakkimizda" class="light">Hakkımızda</a></li>
                    <li><a href="banka-hesaplarimiz" class="light">Banka Hesaplarımız</a></li>
                    <li><a href="havale-bildirim-formu" class="light">Havale Bildirim Formu</a></li>
                    <li><a href="kargom-nerede" class="light">Kargom Nerede?</a></li>
                    <li><a href="iletisim" class="light">İletişim</a></li>
                </ul>
            </li>
            <li>
                <ul class="uyelikHizmetler">
                    <li>
                        <h1 class="light">Üyelik & Hizmetler</h1>
                    </li>
                    <?php 
                if(isset($_SESSION["Kullanici"])){
                    ?>
                    <li>
                        <a href="hesabim/uyelik-bilgilerim" class="light">Hesabım</a>
                    </li>
                    <?php
                }else {
                ?>
                    <li>
                        <a href="uye-giris" class="light">Giriş Yap</a>
                    </li>
                    <li>
                        <a href="yeniuyeformu" class="light">Yeni Üye Ol</a>
                    </li>
                    <?php 
                                    
                }
                ?>
                    <li><a href="destek" class="light">Sık Sorulan sorular</a></li>
                </ul>
            </li>
            <li>
                <ul class="sözleşmeler">
                    <li>
                        <h1 class="light">Sözleşmeler</h1>
                    </li>
                    <li><a href="uyelik-sozlesmesi" class="light">Üyelik Sözleşmesi</a></li>
                    <li><a href="kullanim-kosullari" class="light">Kullanım Koşulları</a></li>
                    <li><a href="gizlilik-sozlesmesi" class="light">Gizlilik Sözleşmesi</a></li>
                    <li><a href="mesafeli-satis-sozlesmesi" class="light">Mesafeli Satış sözleşmesi</a></li>
                    <li><a href="teslimat-kosullari" class="light">Teslimat</a></li>
                    <li><a href="iptal-iade-degisim-kosullari" class="light">İptal & İade & Değişim</a></li>
                </ul>
            </li>
            <ul class="followus">
                <li>
                    <h1>Bizi Takip edin</h1>
                </li>
                <li>
                    <img src="./resimler/Facebook16x16.png" alt="">
                    <a href="<?php echo DonusumleriGeriDondur($FacebookLink); ?>" class="light"
                        target="_blank">Facebook</a>
                </li>
                <li>
                    <img src="./resimler/Twitter16x16.png" alt="">
                    <a href="<?php echo DonusumleriGeriDondur($TwitterLink); ?>" class="light"
                        target="_blank">Twitter</a>
                </li>
                <li>
                    <img src="./resimler/LinkedIn16x16.png" alt="">
                    <a href="<?php echo DonusumleriGeriDondur($LinkedinLink); ?>" class="light"
                        target="_blank">Linkedin</a>
                </li>
                <li>
                    <img src="./resimler/Instagram16x16.png" alt="">
                    <a href="<?php echo DonusumleriGeriDondur($InstagramLink); ?>" class="light"
                        target="_blank">Instagram</a>
                </li>
                <li>
                    <img src="./resimler/Pinterest16x16.png" alt="">
                    <a href="<?php echo DonusumleriGeriDondur($PinterestLink); ?>" class="light"
                        target="_blank">Pinterest</a>
                </li>
                <li>
                    <img src="./resimler/YouTube16x16.png" alt="">
                    <a href="<?php echo DonusumleriGeriDondur($YouTubeLink); ?>" class="light"
                        target="_blank">YouTube</a>
                </li>
            </ul>
        </ul>
        <p>
            <?php echo DonusumleriGeriDondur($SiteCopyrightMetni); ?>
        </p>
        <div class="cardImages">
            <img src="./resimler/RapidSSL32x12.png" alt=""><img src="./resimler/InternetteGuvenliAlisveris28x12.png"
                alt=""><img src="./resimler/3DSecure14x12.png" alt=""><img src="./resimler/BonusCard41x12.png"
                alt=""><img src="./resimler/MaximumCard46x12.png" alt=""><img src="./resimler/WorldCard48x12.png"
                alt=""><img src="./resimler/CardFinans78x12.png" alt=""><img src="./resimler/OdemeSecimiParafCard.png"
                alt=""><img src="./resimler/VisaCard37x12.png" alt=""><img src="./resimler/MasterCard21x12.png"
                alt=""><img src="./resimler/AmericanExpiress20x12.png" alt=""><img src="./resimler" alt="">
        </div>
    </footer>
</body>

</html>
<script src="./Ayarlar/App.js"></script>
<?php
    $db = null;
ob_end_flush();
?>