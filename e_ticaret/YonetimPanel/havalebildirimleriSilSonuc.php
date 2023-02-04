<?php 
if(isset($_SESSION["Yonetici"])){
    
    if(isset($_GET["ID"])){
        $GelenID = Guvenlik($_GET["ID"]);
    }else {
        $GelenID = "";
    }

    if($GelenID!=""){
        $HaveleBildirimiSilSorgu = $db->prepare("DELETE FROM havalebildirimleri WHERE id=?");
        $HaveleBildirimiSilSorgu->execute([$GelenID]);
        $havaleBildirimSilKontrol = $HaveleBildirimiSilSorgu->rowCount();
        if($havaleBildirimSilKontrol>0){
            header("location:index.php?SKD=0&SKI=118"); 
            exit(); 
        }else{
            header("location:index.php?SKD=0&SKI=119"); 
            exit(); 
        }
    }else {
        // hata 
        header("location:index.php?SKD=0&SKI=119"); 
        exit();
    }
}else {
     header("location:index.php?SKD=0&SKI=0");
     exit();
}
?>