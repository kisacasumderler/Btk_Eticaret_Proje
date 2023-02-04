<?php 
if(isset($_SESSION["Yonetici"])){
?>
<?php
     $TumSiparislerQ = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler");
     $TumSiparislerQ->execute();
     $SiparisSayisi = $TumSiparislerQ->rowCount();

     $BekleyenSiparislerQ = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE OnayDurumu=? AND kargoDurumu=?");
     $BekleyenSiparislerQ->execute([0,0]);
     $BekleyenSiparisSayisi = $BekleyenSiparislerQ->rowCount();

     $TamamlananSiparislerQ = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE OnayDurumu=? AND kargoDurumu=?");
     $TamamlananSiparislerQ->execute([1,1]);
     $TamamlananSiparisSayisi = $TamamlananSiparislerQ->rowCount();

     $HavaleBildirimleriQ = $db->prepare("SELECT * FROM havalebildirimleri");
     $HavaleBildirimleriQ->execute();
     $HavaleBildirimSayisi = $HavaleBildirimleriQ->rowCount();

     $BankalarQ = $db->prepare("SELECT * FROM bankahesaplarimiz");
     $BankalarQ->execute();
     $BankalarSayisi = $BankalarQ->rowCount();

     $MenulerQ = $db->prepare("SELECT * FROM menuler");
     $MenulerQ->execute();
     $MenulerSayisi = $MenulerQ->rowCount();

     $UrunlerQ = $db->prepare("SELECT * FROM urunler");
     $UrunlerQ->execute();
     $UrunlerSayisi = $UrunlerQ->rowCount();

     $UyelerQ = $db->prepare("SELECT * FROM uyeler");
     $UyelerQ->execute();
     $UyelerSayisi = $UyelerQ->rowCount();

     $YoneticilerQ = $db->prepare("SELECT * FROM yoneticiler");
     $YoneticilerQ->execute();
     $YoneticilerSayisi = $YoneticilerQ->rowCount();

     $KargolarQ = $db->prepare("SELECT * FROM kargofirmalari");
     $KargolarQ->execute();
     $KargolarSayisi = $KargolarQ->rowCount();

     $BannerlarQ = $db->prepare("SELECT * FROM bannerlar");
     $BannerlarQ->execute();
     $BannerlarSayisi = $BannerlarQ->rowCount();

     $YorumlarQ = $db->prepare("SELECT * FROM yorumlar");
     $YorumlarQ->execute();
     $YorumlarSayisi = $YorumlarQ->rowCount();

     $DestekSorularQ = $db->prepare("SELECT * FROM sorular");
     $DestekSorularQ->execute();
     $DestekSorularSayisi = $DestekSorularQ->rowCount();
?>
<div>
     <h1 class="SiteBaslik">Pano</h1>
    <div class="kutularKapsam">
     <div>
          <span>Bekleyen Siparişler</span>
          <span><?php echo $BekleyenSiparisSayisi; ?></span>
     </div>
     <div>
          <span>Tamamlanan Siparişler</span>
          <span><?php echo $TamamlananSiparisSayisi; ?></span>
     </div>
     <div>
          <span>Tüm Siparişler</span>
          <span><?php echo $SiparisSayisi; ?></span>
     </div>
     <div>
          <span>Havale Bildirimleri</span>
          <span><?php echo $HavaleBildirimSayisi; ?></span>
     </div>
     <div>
          <span>Banka Hesapları</span>
          <span><?php echo $BankalarSayisi; ?></span>
     </div>
     <div>
          <span>Menü Sayısı</span>
          <span><?php echo $MenulerSayisi; ?></span>
     </div>
     <div>
          <span>Ürünler</span>
          <span><?php echo $UrunlerSayisi; ?></span>
     </div>
     <div>
          <span>Üyeler</span>
          <span><?php echo $UyelerSayisi; ?></span>
     </div>
     <div>
          <span>Yöneticiler</span>
          <span><?php echo $YoneticilerSayisi; ?></span>
     </div>
     <div>
          <span>Kargolar</span>
          <span><?php echo $KargolarSayisi; ?></span>
     </div>
     <div>
          <span>Bannerlar</span>
          <span><?php echo $BannerlarSayisi; ?></span>
     </div>
     <div>
          <span>Yorumlar</span>
          <span><?php echo $YorumlarSayisi; ?></span>
     </div>
     <div>
          <span>Destek İçerikleri</span>
          <span><?php echo $DestekSorularSayisi; ?></span>
     </div>
    </div>
</div>
<?php 
}else {
     header("location:index.php?SKD=1");
     exit();
}
?>