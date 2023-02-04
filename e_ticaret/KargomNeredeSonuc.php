<?php
if(isset($_POST["KargomNerede"])) {
    $G_KargoTakipNo = SayiliIcerikFiltrele(Guvenlik($_POST["KargomNerede"]));
}else {
    $G_KargoTakipNo = "";
}

if ($G_KargoTakipNo != "") {
    header("location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code={$G_KargoTakipNo}");

    die();
}else {
    header("location:index.php?SK=14");
    die();
}
?>