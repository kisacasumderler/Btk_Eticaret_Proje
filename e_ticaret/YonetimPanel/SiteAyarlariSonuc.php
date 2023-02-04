<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["DolarKuru"])){
        $GelenDolarKuru = Guvenlik($_POST["DolarKuru"]);
    }else {
        $GelenDolarKuru = "";
    }
    if(isset($_POST["EuroKuru"])){
        $GelenEuroKuru = Guvenlik($_POST["EuroKuru"]);
    }else {
        $GelenEuroKuru = "";
    }
    if(isset($_POST["SiteAdi"])){
        $GelenSiteAdi = Guvenlik($_POST["SiteAdi"]);
    }else {
        $GelenSiteAdi = "";
    }
    if(isset($_POST["SiteTitle"])){
        $GelenSiteTitle = Guvenlik($_POST["SiteTitle"]);
    }else {
        $GelenSiteTitle = "";
    }
    if(isset($_POST["SiteAciklama"])){
        $GelenSiteAciklama = Guvenlik($_POST["SiteAciklama"]);
    }else {
        $GelenSiteAciklama = "";
    }
    if(isset($_POST["SiteKeywords"])){
        $GelenSiteKeywords = Guvenlik($_POST["SiteKeywords"]);
    }else {
        $GelenSiteKeywords = "";
    }
    if(isset($_POST["siteLinki"])){
        $GelensiteLinki = Guvenlik($_POST["siteLinki"]);
    }else {
        $GelensiteLinki = "";
    }
    if(isset($_POST["SiteEmailAdresi"])){
        $GelenSiteEmailAdresi = Guvenlik($_POST["SiteEmailAdresi"]);
    }else {
        $GelenSiteEmailAdresi = "";
    }
    if(isset($_POST["SiteEmailSifresi"])){
        $GelenSiteEmailSifresi = Guvenlik($_POST["SiteEmailSifresi"]);
    }else {
        $GelenSiteEmailSifresi = "";
    }
    if(isset($_POST["FacebookLink"])){
        $GelenFacebookLink = Guvenlik($_POST["FacebookLink"]);
    }else {
        $GelenFacebookLink = "";
    }
    if(isset($_POST["TwitterLink"])){
        $GelenTwitterLink = Guvenlik($_POST["TwitterLink"]);
    }else {
        $GelenTwitterLink = "";
    }
    if(isset($_POST["LinkedinLink"])){
        $GelenLinkedinLink = Guvenlik($_POST["LinkedinLink"]);
    }else {
        $GelenLinkedinLink = "";
    }
    if(isset($_POST["InstagramLink"])){
        $GelenInstagramLink = Guvenlik($_POST["InstagramLink"]);
    }else {
        $GelenInstagramLink = "";
    }
    if(isset($_POST["PinterestLink"])){
        $GelenPinterestLink = Guvenlik($_POST["PinterestLink"]);
    }else {
        $GelenPinterestLink = "";
    }
    if(isset($_POST["YouTubeLink"])){
        $GelenYouTubeLink = Guvenlik($_POST["YouTubeLink"]);
    }else {
        $GelenYouTubeLink = "";
    }
    if(isset($_POST["ucretsizKargoBaraji"])){
        $GelenucretsizKargoBaraji = Guvenlik($_POST["ucretsizKargoBaraji"]);
    }else {
        $GelenucretsizKargoBaraji = "";
    }
    if(isset($_POST["ClientID"])){
        $GelenClientID = Guvenlik($_POST["ClientID"]);
    }else {
        $GelenClientID = "";
    }
    if(isset($_POST["StoreKey"])){
        $GelenStoreKey = Guvenlik($_POST["StoreKey"]);
    }else {
        $GelenStoreKey = "";
    }
    if(isset($_POST["ApiKullanicisi"])){
        $GelenApiKullanicisi = Guvenlik($_POST["ApiKullanicisi"]);
    }else {
        $GelenApiKullanicisi = "";
    }
    if(isset($_POST["ApiSifresi"])){
        $GelenApiSifresi = Guvenlik($_POST["ApiSifresi"]);
    }else {
        $GelenApiSifresi = "";
    }
    if(isset($_POST["SiteCopyrightMetni"])){
        $GelenSiteCopyrightMetni = Guvenlik($_POST["SiteCopyrightMetni"]);
    }else {
        $GelenSiteCopyrightMetni = "";
    }
    if(isset($_POST["SiteEmailHostAdresi"])){
        $GelenSiteEmailHostAdresi = Guvenlik($_POST["SiteEmailHostAdresi"]);
    }else {
        $GelenSiteEmailHostAdresi = "";
    }

    $GelenSiteLogosu = $_FILES["SiteLogosu"];

    $LogoFilename = $GelenSiteLogosu["name"];
    $LogoFiletype = $GelenSiteLogosu["type"];
    $LogoFiletmp_name = $GelenSiteLogosu["tmp_name"];
    $LogoFileerror = $GelenSiteLogosu["error"];
    $LogoFilesize = $GelenSiteLogosu["size"];

    if(($GelenDolarKuru !="") and ($GelenEuroKuru !="") and ($GelenSiteAdi !="") and ($GelenSiteTitle !="") and ($GelenSiteAciklama !="") and ($GelenSiteKeywords !="") and ($GelensiteLinki !="") and ($GelenSiteEmailAdresi !="") and ($GelenSiteEmailSifresi !="") and ($GelenFacebookLink !="") and ($GelenTwitterLink !="") and ($GelenLinkedinLink !="") and ($GelenInstagramLink !="") and ($GelenPinterestLink !="") and ($GelenYouTubeLink !="") and ($GelenucretsizKargoBaraji !="") and ($GelenClientID !="") and ($GelenStoreKey !="") and ($GelenApiKullanicisi !="") and ($GelenApiSifresi !="") and ($GelenSiteCopyrightMetni !="") and ($GelenSiteEmailHostAdresi !="")){
        $SiteAyarGuncelleSorgu = $db->prepare("UPDATE ayarlar SET SiteAdi=?, SiteTitle=?, SiteDecscription=?, SiteKeywords=?, SiteCopyrightMetni=?, SiteEmailHostAdresi=?, siteLinki=?, SiteEmailAdresi=?, SiteEmailSifresi=?,FacebookLink=?,TwitterLink=?,LinkedinLink=?,InstagramLink=?,PinterestLink=?,YouTubeLink=?,DolarKuru=?,EuroKuru=?,ucretsizKargoBaraji=?,ClientID=?,StoreKey=?,ApiKullanicisi=?,ApiSifresi=?");
        $SiteAyarGuncelleSorgu->execute([$GelenSiteAdi,$GelenSiteTitle,$GelenSiteAciklama,$GelenSiteKeywords,$GelenSiteCopyrightMetni,$GelenSiteEmailHostAdresi,$GelensiteLinki,$GelenSiteEmailAdresi,$GelenSiteEmailSifresi,$GelenFacebookLink,$GelenTwitterLink,$GelenLinkedinLink,$GelenInstagramLink,$GelenPinterestLink,$GelenYouTubeLink,$GelenDolarKuru,$GelenEuroKuru,$GelenucretsizKargoBaraji,$GelenClientID,$GelenStoreKey,$GelenApiKullanicisi,$GelenApiSifresi]);
        
        if(($LogoFilename !="") and ($LogoFiletype !="") and ($LogoFiletmp_name !="") and ($LogoFileerror == 0) and ($LogoFilesize>0)){

            $SiteLogoYukle = new \Verot\Upload\Upload($GelenSiteLogosu, "tr-TR");
     if ($SiteLogoYukle->uploaded) {
        $SiteLogoYukle->file_new_name_body = 'Logo'; // resim dosyası ismi
        $SiteLogoYukle->image_resize = true; // boyutlandırma true
        $SiteLogoYukle->image_x = 80; // yükseklik
        $SiteLogoYukle->image_y = 80; // genişlik 
        $SiteLogoYukle->mime_check = true;
        $SiteLogoYukle->allowed = array('image/*');
        $SiteLogoYukle->file_overwrite = true; // üstüne yaz
        $SiteLogoYukle->image_background_color = null; // arka plan rengi 
        $SiteLogoYukle->image_convert = 'png';
        $SiteLogoYukle->png_compression = 1;
        $SiteLogoYukle->process($ResimKlasorYol);
        if ($SiteLogoYukle->processed) {
            $SiteLogoYukle->clean(); // yükleme tamam
            header("location:index.php?SKD=0&SKI=4");
            exit();
          } else {
            header("location:index.php?SKD=0&SKI=3");
            exit();
          }
            }  
        }else {
            header("location:index.php?SKD=0&SKI=4");
            exit();
        }
    }else {
        header("location:index.php?SKD=0&SKI=3");
        exit();
    }

}else {
     header("location:index.php?SKD=1");
     exit();
}
?>
