<?php

require_once("./Ayarlar/Ayar.php");
require_once("./Ayarlar/fonksiyonlar.php");

if(isset($_GET["AktivasyonKodu"])){
    $GelenAktivasyonKodu = Guvenlik($_GET["AktivasyonKodu"]);
   
   }else {
    $GelenAktivasyonKodu = "";
}
 if(isset($_GET["Email"])){
    $GelenemailAdresi = Guvenlik($_GET["Email"]);

}else {
    $GelenemailAdresi = "";
 }

if(($GelenAktivasyonKodu!="") and ($GelenemailAdresi!="")){
 
    $AktivasyonSorgu = $db->prepare("SELECT * FROM uyeler WHERE emailAdres = ? AND AktivasyonKodu = ?");
    $AktivasyonSorgu->execute([$GelenemailAdresi,$GelenAktivasyonKodu]);
    $AS_KayitSayisi = $AktivasyonSorgu->rowCount();
    if ($AS_KayitSayisi > 0) {
?>

<div class="hb_Formu SifreSifirlama">
    <div class="colLeft">
        <h2>Şifre Sıfırlama </h2>
        <p>
            Aşağıdan hesabına giriş şifreni değiştirebilirsin. 
        </p>
        <form action="index.php?SK=44&EmailAdresi=<?php echo $GelenemailAdresi."&AktivasyonKodu=".$GelenAktivasyonKodu; ?>" method="post">
            <div class="formgroup">
                <label for="yeniSifre">Yeni Şifre <span>(*)</span> </label>
                <input type="password" id="yeniSifre" name="yeniSifre">
            </div>
            <div class="formgroup">
                <label for="yeniSifreT">Yeni Şifre <span>(*)</span> </label>
                <input type="password" id="yeniSifreT" name="yeniSifreT" maxlength="11">
            </div>
            <div class="formgroup">
                <button>Şifreyi Güncelle</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            Yeni Şifre oluşturma 
        </h2>
        <p>
            Çalışma ve işleyiş açıklaması. 
        </p>
        <div class="colRightBody">
            <h3>
                <img src="./resimler/CarklarSiyah20x20.png" alt=""><span> Bilgi Kontolü </span>
            </h3>
            <p>
                Kullanıcının form alanına girmiş olduğu değer veya değerler veri tabanımızda tam detaylı olarak filtrelenerek kontrol edilir. 
            </p>
            <h3>
                <img src="./resimler/CarklarSiyah20x20.png" alt=""><span> E-mail gönderimi & İçerik </span>
            </h3>
            <p>
                Bilgi kontrolü başarılı olur ise kullanıcının veri tabanımızda kayıtlı olan email adresine yeni şifre oluşturma içerikli bir mail gönderilir. 
            </p>
            <h3>
                <img src="./resimler/CarklarSiyah20x20.png" alt=""><span> Şifre sıfırlama & Yeni şifre oluşturma  </span>
            </h3>
            <p>
                Kullanıcı kendisine iletilen mail içerisindeki yeni şifre oluştur metnine tıklayacak olur ise site yeni şifre oluşturma sayfası açılır ve kullanıcıdan yeni hesap şifresini oluşturmasını istenir. 
            </p>
            <h3>
                <img src="./resimler/CarklarSiyah20x20.png" alt=""><span>Sonuç </span>
            </h3>
            <p>
                Kullanıcı yeni oluşturmuş olduğu hesap şifresi ile siteye giriş yapmaya hazırdır. 
            </p>
        </div>
    </div>
</div>

<?php 
    }else {
        header("location:index.php?SK=0");
        exit();
    }
}else {
    header("location:index.php?SK=0");
    exit();
}
?>