<div class="b_hesaplar">
<?php
foreach ($B_Kayitlar as $key=>$Value) {
?>
    <div class="b_card">
        <div class="cardHeader">
            <img src="./resimler/<?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["BankLogo"]); ?>" alt="">
            </div>
            <ul>
                <li><span>Banka Adı : </span> <span><?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["bankaAdi"]); ?></span> </li>
                <li><span>Konum : </span><span><?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["KonumSehir"]); ?> / <?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["KonumUlke"]); ?> </span></li>
                <li><span>Şube : </span><span><?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["SubeAdi"]); ?></span></li>
                <li><span>Birim : </span><span><?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["ParaBirimi"]); ?></span></li>
                <li><span>Hesap Adı : </span><span><?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["HesapSahibi"]); ?></span></li>
                <li><span>Hesap No : </span><span><?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["HesapNumarasi"]); ?></span></li>
                <li><span>Iban No : </span><span><?php echo IBANBicimlendir(DonusumleriGeriDondur($B_Kayitlar[$key]["IbanNumarasi"])); ?></span></li>
            </ul>
    </div>
    <?php
    }

?>
</div>

