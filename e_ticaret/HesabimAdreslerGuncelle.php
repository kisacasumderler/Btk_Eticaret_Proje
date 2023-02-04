<?php 
if(isset($_SESSION["Kullanici"])){
    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }
    if($GelenID!="") {
        $AdresSorgu = $db->prepare("SELECT * FROM adresler WHERE id =? AND UyeId =? LIMIT 1");
        $AdresSorgu->execute([$GelenID,$id]);
        $AdresS_Sayi = $AdresSorgu->rowCount();
        $AdresKayit = $AdresSorgu->fetch(PDO::FETCH_ASSOC);
        if($AdresS_Sayi>0) {
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
        <form action="index.php?SK=63&ID=<?php echo $GelenID; ?>" method="post">
        <div class="formgroup">
                <label for="AdresBaslik">Adres Başlığı <span>(*)</span></label>
                <input type="text" id="AdresBaslik" name="AdresBaslik" value="<?php echo $AdresKayit["AdresBaslik"]; ?>"> 
            </div>
            <div class="formgroup">
                <label for="IsimSoyisim">İsim Soyisim<span>(*)</span></label>
                <input type="text" id="IsimSoyisim" name="IsimSoyisim" value="<?php echo $AdresKayit["adiSoyadi"]; ?>"> 
            </div>
            <div class="formgroup">
                <label for="Adres">Adres<span>(*)</span></label>
                <textarea type="text" id="Adres" name="Adres" rows="5"> <?php echo $AdresKayit["Adres"]; ?> </textarea>
            </div>
            <div class="formgroup">
                <label for="Ilce">İlçe<span>(*)</span></label>
                <input type="text" id="yeniSifre" name="Ilce" value="<?php echo $AdresKayit["Ilce"]; ?>"> 
            </div>
            <div class="formgroup">
                <label for="Sehir">Şehir<span>(*)</span></label>
                <input type="text" id="Sehir" name="Sehir"  value="<?php echo $AdresKayit["Sehir"]; ?>"> 
            </div>
            <div class="formgroup">
                <label for="TelefonNumarasi">Telefon Numarası   <span>(*)</span></label>
                <input type="text" id="TelefonNumarasi" name="TelefonNumarasi" maxlength="11" value="<?php echo $AdresKayit["TelefonNumarasi"]; ?>"> 
            </div>
            <div class="formgroup">
                <button>Adresi Güncelle</button>
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
     }
    }else {
        header("Location:index.php?SK=65");
        exit();
    }
}else {
    header("location:index.php");
    exit();
}
?>




