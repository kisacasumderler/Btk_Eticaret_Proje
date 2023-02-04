<?php 
if(isset($_SESSION["Yonetici"])){
?>
<div class="HomePage flexRowStart">
    <div class="solSutun">
    <div class="solmenu minheight100" style="display: none;">
        <div class="butonAlan width100" style="text-align: end;">
            <div class="btnHamburger" id="Close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svgStyle">
                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                    </svg>
            </div>
        </div>
        <div class="menuHeader textCenter">
            <a href="index.php?SKD=0&SKI=0"><img src="<?php echo ".".$SiteLogosu;?>" alt="" class="logo"></a>
        </div>
        <!-- menü -->
        <?php 
             $TumSiparislerQ = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler");
             $TumSiparislerQ->execute();
             $SiparisSayisi = $TumSiparislerQ->rowCount();
             $TamamlananSiparislerQ = $db->prepare("SELECT DISTINCT siparisNumarasi FROM siparisler WHERE OnayDurumu=? AND kargoDurumu=?");
             $TamamlananSiparislerQ->execute([1,1]);
             $TamamlananSiparisSayisi = $TamamlananSiparislerQ->rowCount();
             $HavaleBildirimleriQ = $db->prepare("SELECT * FROM havalebildirimleri");
             $HavaleBildirimleriQ->execute();
             $HavaleBildirimSayisi = $HavaleBildirimleriQ->rowCount();
        ?>
        <ul class="HomeMenu">
            <li><a href="index.php?SKD=0&SKI=106" class="btn MenuItem">Siparişler (<?php echo $SiparisSayisi." / ".$TamamlananSiparisSayisi; ?>)</a></li>
            <li><a href="index.php?SKD=0&SKI=116" class="btn MenuItem">Havale Bildirimleri (<?php echo $HavaleBildirimSayisi; ?>)</a></li>
            <li><a href="index.php?SKD=0&SKI=94" class="btn MenuItem">Ürünler</a></li>
            <li><a href="index.php?SKD=0&SKI=82" class="btn MenuItem">Üyeler</a></li>
            <li><a href="index.php?SKD=0&SKI=90" class="btn MenuItem">Yorumlar</a></li>
            <li><a href="index.php?SKD=0&SKI=1" class="btn MenuItem">Site Ayarları</a></li>
            <li><a href="index.php?SKD=0&SKI=57" class="btn MenuItem">Menüler</a></li>
            <li><a href="index.php?SKD=0&SKI=9" class="btn MenuItem">Banka Hesap Ayarları</a></li>
            <li><a href="index.php?SKD=0&SKI=5" class="btn MenuItem">Sözleşmeler ve Metinler</a></li>
            <li><a href="index.php?SKD=0&SKI=21" class="btn MenuItem">Kargo Ayarları</a></li>
            <li><a href="index.php?SKD=0&SKI=33" class="btn MenuItem">Banner Ayarları</a></li>
            <li><a href="index.php?SKD=0&SKI=45" class="btn MenuItem">Destek İçerikleri</a></li>
            <li><a href="index.php?SKD=0&SKI=69" class="btn MenuItem">Yöneticiler</a></li>
            <li><a href="index.php?SKD=4&SKI=0" class="btn MenuItem">Çıkış</a></li>
        </ul>
    </div>
    <div class="solmenu minheight100" style="width: 3rem;">
        <div class="butonAlan textCenter width100">
            <div class="btnHamburger textCenter width100" id="Open">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svgStyle">
                    <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
            </div>
        </div>
    </div>
    </div>
    <div class="icerikAlan width100">
        <?php
        if((!$IC_SK_Degeri) or ($IC_SK_Degeri=="") or ($IC_SK_Degeri==0)){
            include($SayfaIc[0]);
       }else {
            include($SayfaIc[$IC_SK_Degeri]);
       }
    ?>
    </div>
</div>
<script>
    let MenuItem = document.querySelectorAll(".MenuItem");

    function clearBtn(deger) {
        for (let i = 0; i <= MenuItem.length; i++) {
            if (i != deger) {
                MenuItem[i].classList.remove("active");
                MenuItem[i].classList.add("btn");
            }
        }
    }

    MenuItem.forEach((e, i) => {
        e.addEventListener('click', () => {
            e.classList.add("active");
            e.classList.remove("btn");
            clearBtn(i);
        })
    });
    let Close = document.querySelector("#Close"),
        Open = document.querySelector("#Open");
    solmenu = document.querySelectorAll(".solmenu"),
    solSutun = document.querySelector(".solSutun");

    Open.addEventListener("click", () => {
        solmenu[0].style.display = "block";
        solmenu[1].style.display = "none";
        solSutun.style.width = "18.625rem";
    });
    Close.addEventListener("click",()=>{
        solmenu[0].style.display = "none"; 
        solmenu[1].style.display = "block";
        solSutun.style.width = "3rem";
    })
</script>
<?php 
}else {
     header("location:index.php?SKD=1");
     exit();
}
?>