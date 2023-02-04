<?php 
if(isset($_SESSION["Kullanici"])){
    ?>
    <div class="hb_Formu Adresler">
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
    <div class="colRight">
        <h2>
            Hesabım > Adresler 
        </h2>
        <p>
            Tüm adreslerini görüntüleyebilir ve güncelleyebilirsin. 
        </p>
        <div class="adresBtn">
            <a href="index.php?SK=70" class="light">Yeni Adres Ekle</a> <img src="./resimler/ArttirDaireli20x20.png" alt="">
        </div>
        <div class="Adresler">
            <?php 
            $AdreslerSorgu = $db->prepare("SELECT * FROM adresler WHERE UyeId=?");
            $AdreslerSorgu->execute([$id]);
            $A_KayitSayisi = $AdreslerSorgu->rowCount();
            $Adresler = $AdreslerSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($Adresler>0){
        foreach ($Adresler as $Values) {
            ?>
                <ul class="AdresCard">
                    <li class="AdresHeader">
                        <?php echo $Values["AdresBaslik"]; ?>
                    </li>
                    <li>
                        <img src="./resimler/user.png" alt="">
                     <span><?php echo $Values["adiSoyadi"]; ?></span>
                    </li>
                    <li>
                    <img src="./resimler/ipIcon.png" alt="">
                    <span><?php echo $Values["Adres"]; ?></span>
                    </li>
                    <li>
                    <?php echo $Values["Ilce"]; ?> / <?php echo $Values["Sehir"]; ?> 
                    </li>
                    <li>
                        <img src="./resimler/phoneIcon.png" alt="">
                        <span><?php echo $Values["TelefonNumarasi"]; ?></span>
                    
                    </li>
                    <li>
                     <img src="./resimler/Guncelleme20x20.png" alt=""> <a href="index.php?SK=62&ID=<?php echo $Values["id"]; ?>" class="light">Güncelle</a>
                     <img src="./resimler/Sil20x20.png" alt=""> <a href="index.php?SK=67&ID=<?php echo $Values["id"]; ?>" class="light">Sil</a>
                    </li>
                </ul>
                    <?php
                }
            }else {
                ?>
                <p>
                <?php echo "Hesabınıza kayıtlı adres bulunmamaktadır.";?>
                </p>
                <?php 
            }
            ?>
            
        </div>
    </div>
</div>

    <?php
}else {
    header("location:index.php");
    exit();
}
?>




