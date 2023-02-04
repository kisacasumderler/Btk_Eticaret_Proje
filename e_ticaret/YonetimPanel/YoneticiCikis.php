<?php 
unset($_SESSION["Yonetici"]);
session_destroy();

header("location:index.php?SKD=1");
exit();

?>