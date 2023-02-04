<?php 
if(!isset($_SESSION["Kullanici"])){
    ?>
<div class="hb_Formu GirisFormu">
    <div class="colLeft">
        <h2>Giriş Yap</h2>
        <p>
            Giriş yapmak için formu doldurunuz
        </p>
        <form action="index.php?SK=32" method="post">
            <div class="formgroup">
                <label for="emailAdresi">E-mail Adresi <span>(*)</span> </label>
                <input type="email" id="emailAdresi" name="emailAdresi">
            </div>
            <div class="formgroup">
                <label for="Sifre">Şifre <span>(*)</span> </label>
                <input type="password" id="Sifre" name="Sifre">
            </div>
            <div class="formgroup">
                <span>Şifrenizi mi unuttunuz ? Yeni şifre almak için</span>
                <a href="index.php?SK=37" class="light">tıklayınız</a>
            </div>
            <div class="formgroup">
                <button>Giriş Yap</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            Ürün almak için nelere dikkat etmelisiniz?
        </h2>
        <p>
            Cevabı basit : Birçok etkeni var!
        </p>
        <div class="colRightBody">
            <h3>
                <img src="./resimler/OrjinalSiyahKirmizi20x20.png" alt=""><span> Orijinal Ürün </span>
            </h3>
            <p>
                Ürünün orijinal olmasına dikkat etmelisiniz.
            </p>
            <h3>
                <img src="./resimler/RozetMavi20x20.png" alt=""><span>Katile & Kontrol </span>
            </h3>
            <p>
                Ürünün kalite kontrol işlemlerinden geçmiş ve muhakkak onaylanmış olmasına dikkat etmelisiniz.
            </p>
            <h3>
                <img src="./resimler/SaatHizCizgiliLacivert20x20.png" alt=""><span>Hızlı Sevkiyat </span>
            </h3>
            <p>
                Satın almış olduğunuz ürünün en kısa sürede ve en dikkatli şeklinde tarafınıza ulaştırılabilir olmasına
                dikkat etmelisiniz.
            </p>
            <h3>
                <img src="./resimler/AdamKonusmaBalonluFume20x20.png" alt=""><span>Satış sonrası destek </span>
            </h3>
            <p>
                Satın almış olduğunuz ürün ile alakalı yaşanabilecek her türlü problemde veya aklınıza takılabilecek tüm
                sorularda destek alınabilirliğine dikkat etmelisiniz.
            </p>
        </div>
    </div>
</div>
<?php
}else {
    header("location:index.php");
    exit();
}
?>