<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_POST["hakkimizda"])){
        $Gelenhakkimizda = Guvenlik($_POST["hakkimizda"]);
    }else {
        $Gelenhakkimizda = "";
    }
    if(isset($_POST["uyelikSozlesmesi"])){
        $GelenuyelikSozlesmesi = Guvenlik($_POST["uyelikSozlesmesi"]);
    }else {
        $GelenuyelikSozlesmesi = "";
    }
    if(isset($_POST["kullanimKosullari"])){
        $GelenkullanimKosullari = Guvenlik($_POST["kullanimKosullari"]);
    }else {
        $GelenkullanimKosullari = "";
    }
    if(isset($_POST["gizlilikSozlesmesi"])){
        $GelengizlilikSozlesmesi = Guvenlik($_POST["gizlilikSozlesmesi"]);
    }else {
        $GelengizlilikSozlesmesi = "";
    }
    if(isset($_POST["mesafeliSatisSozlesmesi"])){
        $GelenmesafeliSatisSozlesmesi = Guvenlik($_POST["mesafeliSatisSozlesmesi"]);
    }else {
        $GelenmesafeliSatisSozlesmesi = "";
    }
    if(isset($_POST["teslimat"])){
        $Gelenteslimat = Guvenlik($_POST["teslimat"]);
    }else {
        $Gelenteslimat = "";
    }
    if(isset($_POST["iptalIadeDegisim"])){
        $GeleniptalIadeDegisim = Guvenlik($_POST["iptalIadeDegisim"]);
    }else {
        $GeleniptalIadeDegisim = "";
    }

    if(($Gelenhakkimizda !="") and ($GelenuyelikSozlesmesi !="") and ($GelenkullanimKosullari !="") and ($GelengizlilikSozlesmesi !="") and ($GelenmesafeliSatisSozlesmesi !="") and ($Gelenteslimat !="")and ($GeleniptalIadeDegisim !="")){
        $SiteAyarGuncelleSorgu = $db->prepare("UPDATE sozlesmelervemetinler SET hakkimizda=?, uyelikSozlesmesi=?, kullanimKosullari=?, gizlilikSozlesmesi=?, mesafeliSatisSozlesmesi=?, teslimat=?, iptalIadeDegisim=?");
        $SiteAyarGuncelleSorgu->execute([$Gelenhakkimizda,$GelenuyelikSozlesmesi,$GelenkullanimKosullari,$GelengizlilikSozlesmesi,$GelenmesafeliSatisSozlesmesi,$Gelenteslimat,$GeleniptalIadeDegisim]);
        header("location:index.php?SKD=0&SKI=7");
        exit();
    }else {
        header("location:index.php?SKD=0&SKI=8");
        exit();
    }

}else {
     header("location:index.php?SKD=1");
     exit();
}
?>
