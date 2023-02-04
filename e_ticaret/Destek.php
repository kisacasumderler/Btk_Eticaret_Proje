<div class="sozlesmeler DestekPage">
    <h2>Sık Sorulan Sorular</h2>
    <p class="ilkP">
        Aklınıza Takılabileceğini düşündüğümüz soruların cevaplarını bu sayfada cevapladık. Fakat farklı bir sorunuz varsa lütfen iletişim alanından bizlere iletiniz. 
    </p>
    <ul class="soruCevap">
<?php 
    if($SC_KayitSayisi>0) {
    foreach($SC_Kayitlar as $Values) {
?>
        <li class="DestekItem">
            <h3 id="<?php echo $Values['id'];?>">
        <span><?php echo DonusumleriGeriDondur($Values["soru"]);?></span> <img src="./resimler/arrowUp.png" alt="">
        </h3>
            <p style="display:none;" class="S_CevapAlani <?php echo "S_CevapAlani".$Values['id'];?>"><?php echo DonusumleriGeriDondur($Values["cevap"]);?></p>
        </li>
<?php
    }
}else {
    // echo "Hata";
}
?>
    </ul>
</div>


