<?php 
if(empty($_SESSION["Yonetici"])){
?>
<div class="UyeGiris flexColumnCenter width100">
    <form action="index.php?SKD=2" method="post" class="flexColumnCenter gap1">
        <h1>Admin Panel</h1>
        <div class="formgroup width100">
            <label for="YKAdi">Kullanıcı Adı</label>
            <input type="text" id="YKAdi" class="width100" name="YKAdi">
        </div>
        <div class="formgroup width100">
            <label for="ySifre">Şifre</label>
            <input type="password" id="ySifre" class="width100" name="ySifre">
        </div>
        <button>Giriş Yap</button>
    </form>
</div>
<?php }
?>