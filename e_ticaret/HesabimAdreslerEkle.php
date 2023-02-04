<?php 
if(isset($_SESSION["Kullanici"])){
    ?>
    <div class="hb_Formu Hesabim">
        <ul class="hesabimRow">
            <li>
                <a href="index.php?SK=50" class="light">Üyelik Bilgileri</a>
            </li>   
            <li>
                <a href="index.php?SK=58" class="light">Adresler</a>
            </li>   
            <li>
                <a href="index.php?SK=59" class="light">Favoriler</a>
            </li>   
            <li>
                <a href="index.php?SK=60" class="light">Yorumlar</a>
            </li>   
            <li>
                <a href="index.php?SK=61" class="light">Siparişler</a>
            </li>   
        </ul>
    <div class="colLeft">
        <h2>Hesabım > Adres Ekle </h2>
        <p>
            Aşağıdan hesabınıza yeni adres ekleyebilirsiniz.  
        </p>
        <form action="index.php?SK=71" method="post">
        <div class="formgroup">
                <label for="AdresBaslik">Adres Başlığı <span>(*)</span></label>
                <input type="text" id="AdresBaslik" name="AdresBaslik"> 
            </div>
            <div class="formgroup">
                <label for="IsimSoyisim">İsim Soyisim<span>(*)</span></label>
                <input type="text" id="IsimSoyisim" name="IsimSoyisim"> 
            </div>
            <div class="formgroup">
                <label for="Adres">Adres<span>(*)</span></label>
                <textarea type="text" id="Adres" name="Adres" rows="5"> </textarea>
            </div>
            <div class="formgroup">
                <label for="Ilce">İlçe<span>(*)</span></label>
                <input type="text" id="yeniSifre" name="Ilce"> 
            </div>
            <div class="formgroup">
                <label for="Sehir">Şehir<span>(*)</span></label>
                <input type="text" id="Sehir" name="Sehir" > 
            </div>
            <div class="formgroup">
                <label for="TelefonNumarasi">Telefon Numarası   <span>(*)</span></label>
                <input type="text" id="TelefonNumarasi" name="TelefonNumarasi" maxlength="11"> 
            </div>
            <div class="formgroup">
                <button>Adresi Kaydet</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            Reklam 
        </h2>
        <p>
            <?php echo  $SiteAdi." Reklamları"; ?>
        </p>
        <div class="colRightBody">
            <!-- buraya reklam gelicek  -->
        </div>
    </div>
</div>
    <?php
}else {
    header("location:index.php");
    exit();
}
?>




