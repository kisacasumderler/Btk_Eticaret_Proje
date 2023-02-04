<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="SiteBg">
    <h1 class="SiteBaslik">
        Sözleşme ve Metinler
    </h1>
    <form action="index.php?SKD=0&SKI=6" method="post" class="FormClass flexColumnCenter gap1">
        <div class="formGrup">
            <label for="hakkimizda">Hakkımızda Metni : </label>
            <textarea name="hakkimizda" id="hakkimizda" rows="5"><?php echo $hakkimizda;?></textarea>
        </div>
        <div class="formGrup">
            <label for="uyelikSozlesmesi">Üyelik Sözleşmesi : </label>
            <textarea name="uyelikSozlesmesi" id="uyelikSozlesmesi" rows="5"><?php echo $uyelikSozlesmesi;?></textarea>
        </div>
        <div class="formGrup">
            <label for="kullanimKosullari">Kullanım Koşulları : </label>
            <textarea name="kullanimKosullari" id="kullanimKosullari" rows="5"><?php echo $kullanimKosullari;?></textarea>
        </div>
        <div class="formGrup">
            <label for="gizlilikSozlesmesi">Gizlilik Sözleşmesi : </label>
            <textarea name="gizlilikSozlesmesi" id="gizlilikSozlesmesi" rows="5"><?php echo $gizlilikSozlesmesi;?></textarea>
        </div>
        <div class="formGrup">
            <label for="mesafeliSatisSozlesmesi">Mesafeli Satış Sözleşmesi : </label>
            <textarea name="mesafeliSatisSozlesmesi" id="mesafeliSatisSozlesmesi" rows="5"><?php echo $mesafeliSatisSozlesmesi;?></textarea>
        </div>
        <div class="formGrup">
            <label for="teslimat">Teslimat Metni : </label>
            <textarea name="teslimat" id="teslimat" rows="5"><?php echo $teslimat;?></textarea>
        </div>
        <div class="formGrup">
            <label for="iptalIadeDegisim">İptal & İade & Değişim Koşulları : </label>
            <textarea name="iptalIadeDegisim" id="iptalIadeDegisim" rows="5"><?php echo $iptalIadeDegisim;?></textarea>
        </div>
        <div class="formGrup">
            <button>
                Kaydet
            </button>
        </div>
    </form>
</div>
<script src="../Ayarlar/App.js"></script>
<?php 
}else {
     header("location:index.php?SKD=1");
     exit();
}
?>