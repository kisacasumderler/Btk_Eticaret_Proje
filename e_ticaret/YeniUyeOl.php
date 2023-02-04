<?php 
if(!isset($_SESSION["Kullanici"])){
    ?>
<div class="hb_Formu UyelikFormu">
    <div class="colLeft">
        <h2>Hesap Oluştur. </h2>
        <p>
            Yeni misin? Aşağıdan hesap oluşturabilirsin. 
        </p>
        <form action="index.php?SK=23" method="post">
            <div class="formgroup">
                <label for="IsimSoyisim">İsim Soyisim <span>(*)</span> </label>
                <input type="text" id="IsimSoyisim" name="IsimSoyisim">
            </div>
            <div class="formgroup">
                <label for="Sifre">Şifre  <span>(*)</span> </label>
                <input type="password" id="Sifre" name="Sifre">
            </div>
            <div class="formgroup">
                <label for="sifreTekrar">Şifre Tekrar <span>(*)</span> </label>
                <input type="password" id="sifreTekrar" name="sifreTekrar">
            </div>
            <div class="formgroup">
                <label for="emailAdresi">E-mail Adresi  <span>(*)</span> </label>
                <input type="email" id="emailAdresi" name="emailAdresi">
            </div>
            <div class="formgroup">
                <label for="TelefonNumarasi">Telefon Numarası  <span>(*)</span> </label>
                <input type="text" id="TelefonNumarasi" name="TelefonNumarasi" maxlength="11">
            </div>
            <div class="formgroup">
                <label for="cinsiyet">Cinsiyet<span>(*)</span> </label>
                <select name="cinsiyet" id="cinsiyet">
                    <option value="Erkek">Erkek</option>
                    <option value="Kadın">Kadın</option>
                </select>
            </div>
            <div class="formgroup">
                <label for="formOnay"> <a href="index.php?SK=2" class="light" target="_blank"> Üyelik Sözleşmesi</a> 'ni Okudum ve Onaylıyorum. </label>
                <input type="checkbox" id="formOnay" name="formOnay" value="1">
            </div>
            <div class="formgroup">
                <button>Üye Ol</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            Neden eStore ? 
        </h2>
        <p>
            Sorusunun cevabı: Çünkü birçok nedeni var! 
        </p>
        <div class="colRightBody">
            <h3>
                <img src="./resimler/RozetYesilSiyah20x20.png" alt=""><span> Kaliteli ve güncel </span>
            </h3>
            <p>
                eStore Türkiye'deki ve Dünya'daki tüm yenilikler ile birlikte tüm teknolojileride sürekli takip eder, araştırır ve öğrenir. Bu sayede daima en kaliteli, en güncel en üstün ürünlerini sunarız. 
            </p>
            <h3>
                <img src="./resimler/CarklarSiyah20x20.png" alt=""><span>Yenilikçi</span>
            </h3>
            <p>
                Tüm ürünler daima en güncel içeriğe sahiptir zaman içerisinde yeni versiyonlar çıkması durumunda satıştan kaldırılarak en son versiyonlar için sıfırdan hazırlanarak yeniden satışa sunulur. 
            </p>
            <h3>
                <img src="./resimler/GulenYuzMavi20x20.png" alt=""><span>Eğlenceli</span>
            </h3>
            <p>
                Tüm ürünler standart ve sıkıcı ürünlerin aksine keyifli ve zamana uygun bir şekilde sunulur. 
            </p>
            <h3>
                <img src="./resimler/MektupMobilKoyuGri20x20.png" alt=""><span>Ulaşılabilirlik. </span>
            </h3>
            <p>
                çalışanlarımız yardımcı olmayı seven aynı zamanda da alanında uzman kişilerdir. Cevap vermekten kaçınmazlar dilediğiniz zaman bizimle rahatlıkla iletişime geçebilirsiniz. Sorularınıza çok kısa bir süre içerisinde yanıt alabilirsiniz. 
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