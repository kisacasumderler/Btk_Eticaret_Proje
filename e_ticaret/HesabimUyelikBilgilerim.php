<?php 
if(isset($_SESSION["Kullanici"])){
    ?>
    <div class="hb_Formu Hesabim">
        <ul class="hesabimRow" style="border: none;">
            <div class="mobileBar">
                <img src="./resimler/arrowUp.png" alt="">
            </div>
            <li>
                <a href="hesabim/uyelik-bilgilerim" class="light">Üyelik Bilgileri</a>
            </li>   
            <li>
                <a href="hesabim/adresler" class="light">Adresler</a>
            </li>   
            <li>
                <a href="hesabim/favoriler" class="light">Favoriler</a>
            </li>   
            <li>
                <a href="hesabim/yorumlar" class="light">Yorumlar</a>
            </li>   
            <li>
                <a href="hesabim/siparisler" class="light">Siparişler</a>
            </li>   
        </ul>
    <div class="colLeft">
        <h2>Hesabım</h2>
        <p>
            Aşağıdan üyelik bilgilerini tamamını veya herhangi birini güncelleyebilirsin. 
            Uyarı : şifreni güncelleyebilmek için eski şifreni doğrulaman gereklidir. 
        </p>
        <form action="index.php?SK=51" method="post">
            <div class="formgroup">
                <label for="IsimSoyisim">İsim Soyisim  </label>
                <input type="text" id="IsimSoyisim" name="IsimSoyisim" value="<?php echo $isimSoyisim; ?>">
            </div>
            <div class="formgroup">
                <label for="eskiSifre">Eski Şifre</label>
                <input type="password" id="eskiSifre" name="eskiSifre" value="eskiSifre">
            </div>
            <div class="formgroup">
                <label for="yeniSifre">Yeni Şifre</label>
                <input type="password" id="yeniSifre" name="yeniSifre" value="yeniSifre">
            </div>
            <div class="formgroup">
                <label for="yeniSifreT">Yeni Şifre Tekrar</label>
                <input type="password" id="yeniSifreT" name="yeniSifreT" value="yeniSifre">
            </div>
            <div class="formgroup">
                <label for="emailAdresi">E-mail Adresi </label>
                <input type="email" id="emailAdresi" name="emailAdresi" value="<?php echo $emailAdres; ?> ">
            </div>
            <div class="formgroup">
                <label for="TelefonNumarasi">Telefon Numarası   </label>
                <input type="text" id="TelefonNumarasi" name="TelefonNumarasi" maxlength="11" value="<?php echo $telefonNumarasi; ?> ">
            </div>
            <div class="formgroup">
                <label for="cinsiyet">Cinsiyet</label>
                <select name="cinsiyet" id="cinsiyet">
                    <option selected="<?php if ($cinsiyet == "Erkek") {echo "selected";} ?>">Erkek</option>
                    <option selected="<?php if ($cinsiyet == "Kadın") {echo "selected";} ?>">Kadın</option>
                </select>
            </div>
            <div class="formgroup">
                <button>Bilgileri Güncelle</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            Hesabım > Üyelik Bilgileri 
        </h2>
        <p>
            Aşağıda üyelik bilgilerini görebilirsin. 
        </p>
        <div class="colRightBody">
            <h3>
                <img src="./resimler/user.png" alt=""><span> İsim soyisim:</span>
            </h3>
            <p>
                <?php echo $isimSoyisim; ?>
            </p>
            <h3>
                <img src="<?php if($cinsiyet=="Kadın"){ echo "./resimler/userwoman.png";}else {echo "./resimler/user.png";}?>" alt=""><span>Cinsiyet: </span>
            </h3>
            <p>
                <?php echo $cinsiyet; ?>
            </p>
            <h3>
                <img src="./resimler/emailicon.png" alt=""><span>E-mail Adresi: </span>
            </h3>
            <p>
                <?php echo $emailAdres; ?> 
            </p>
            <h3>
                <img src="./resimler/phoneIcon.png" alt=""><span>Telefon Numarası: </span>
            </h3>
            <p>
                <?php echo $telefonNumarasi; ?> 
            </p>
            <h3>
                <img src="./resimler/savedIcon.png" alt=""><span>Kayıt Tarihi: </span>
            </h3>
            <p>
                <?php echo Tarihbul($kayitTarihi); ?> 
            </p>
            <h3>
                <img src="./resimler/ipIcon.png" alt=""><span>Kayıt Ip Adresi : </span>
            </h3>
            <p>
                <?php echo $kayitIpAdresi; ?> 
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




