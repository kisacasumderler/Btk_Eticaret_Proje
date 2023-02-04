<?php 
if(isset($_SESSION["Kullanici"])){
    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }
    if (isset($_GET["SiparisNo"])) {
        $GelenSiparisNo = Guvenlik($_GET["SiparisNo"]);
    }else {
        $GelenSiparisNo = "";
    }
    if (isset($_GET["UrunAdi"])) {
        $GelenUrunAdi = Guvenlik($_GET["UrunAdi"]);
    }else {
        $GelenUrunAdi = "";
    }
    if (isset($_GET["UrunResmi"])) {
        $GelenUrunResmi = Guvenlik($_GET["UrunResmi"]);
    }else {
        $GelenUrunResmi = "";
    }
    if (isset($_GET["UrunResmi"])) {
        $GelenRKAdi = Guvenlik($_GET["RKAdi"]);
    }else {
        $GelenRKAdi = "";
    }
    if(($GelenID!="") and ($GelenSiparisNo!="")and ($GelenUrunAdi!="")and ($GelenUrunResmi!="" and ($GelenRKAdi!=""))) {
    ?>
    <div class="hb_Formu Hesabim YorumYap">
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
        <h2>Hesabım > Yorum Yap </h2>
        <p>
            Şiparişinizle ilgili yorum ve puanlama yaparak geribildirimde bulunabilirsiniz.   
        </p>
        <form action="index.php?SK=76&ID=<?php echo $GelenID; ?>" method="post">
        <div class="formgroup">
            <div class="puan"><label for="1" class="LabelItem">1</label>
                <input type="radio" id="1" name="YorumPuan" value="1"> </div>
            <div class="puan"><label for="2" class="LabelItem">2</label>
                <input type="radio" id="2" name="YorumPuan" value="2"></div>
            <div class="puan"><label for="3" class="LabelItem">3</label>
                <input type="radio" id="3" name="YorumPuan" value="3"></div>
            <div class="puan"><label for="4" class="LabelItem">4</label>
                <input type="radio" id="4" name="YorumPuan" value="4"> </div>
            <div class="puan"><label for="5" class="LabelItem">5</label>
                <input type="radio" id="5" name="YorumPuan" value="5"> </div>
            </div>
            <div class="formgroup">
                <label for="YorumYap">Yorumunuz<span>(*)</span></label>
                <textarea type="text" id="YorumYap" name="YorumYap" rows="5"></textarea> 
            </div>
            <div class="formgroup">
                <button>Yorum Yap</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            Ürün Detayları  
        </h2>
        <p>
           Yorum yapacağınız ürün detayları aşağıda görüntülenmektedir.  
        </p>
        <div class="UrunBody">
            <div class="urunFoto"><img src="./resimler/UrunResimleri/<?php echo $GelenRKAdi."/".$GelenUrunResmi; ?>" alt=""></div>
             <ul>
                <li>
                    <span>Ürün Adı : </span> <span><?php echo $GelenUrunAdi; ?></span>
                </li>
                <li><span>Sipariş Numarası : </span> <span><?php echo $GelenSiparisNo; ?></span></li>
             </ul>
        </div>
    </div>
</div>
    <?php
    }else {
        header("Location:index.php?SK=78");
        exit();
    }
}else {
    header("location:index.php");
    exit();
}
?>




