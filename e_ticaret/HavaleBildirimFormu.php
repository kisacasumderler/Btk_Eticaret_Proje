<div class="hb_Formu">
    <div class="colLeft">
        <h2>Havale Bildirim Formu</h2>
        <p>
            Tamamlanmış olan ödeme işleminizi aşağıdaki Fromdan iletiniz
        </p>
        <form action="index.php?SK=10" method="post">
            <div class="formgroup">
                <label for="IsimSoyisim">İsim Soyisim<span>(*)</span></label>
                <input type="text" id="IsimSoyisim" name="IsimSoyisim">
            </div>
            <div class="formgroup">
                <label for="emailAdresi">E-mail Adresi <span>(*)</span></label>
                <input type="email" id="emailAdresi" name="emailAdresi">
            </div>
            <div class="formgroup">
                <label for="TelefonNumarasi">Telefon Numarası <span>(*)</span></label>
                <input type="text" id="TelefonNumarasi" name="TelefonNumarasi" maxlength="11">
            </div>
            <div class="formgroup">
                <label for="BankaBilgisi">Ödeme Yapılan Banka <span>(*)</span></label>
                <select type="text" id="BankaBilgisi" name="BankaBilgisi">
                    <?php
                    foreach ($B_Kayitlar as $key=>$Value) {
                    ?>
                    <option value="<?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["id"]); ?>">
                        <?php echo DonusumleriGeriDondur($B_Kayitlar[$key]["bankaAdi"]); ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="formgroup">
                <label for="aciklama">Açıklama </label>
                <textarea name="aciklama" id="aciklama" cols="30" rows="10"></textarea>
            </div>
            <div class="formgroup">
                <button>Bildirimi Gönder</button>
            </div>
        </form>
    </div>
    <div class="colRight">
        <h2>
            İşleyiş
        </h2>
        <p>
            Havale/EFT işlemlerinin konrolü
        </p>
        <div class="colRightBody">
            <h3>
                <img src="./resimler/Banka20x20.png" alt=""><span>Havale / Eft İşlemi</span>
            </h3>
            <p>
                Müşteri Tarafından öncelikle banka hesaplarımız sayfasında bulunan herhangi bir hesaba ödeme işlemi gerçekleştirilir.
            </p>
            <h3>
                <img src="./resimler/DokumanKirmiziKalemli20x20.png" alt=""><span>Havale / Eft İşlemi</span>
            </h3>
            <p>
                Ödeme işleminizi tamamladıktan sonra "Havale Bildirim Formu" sayasından müşteri yapmış olduğu ödeme için bildirim forumunu doldurarak on-line olarak gönderir...
            </p>
            <h3>
                <img src="./resimler/CarklarSiyah20x20.png" alt=""><span>Kontroller</span>
            </h3>
            <p>
                Havale bildirim formunuz tarafımıza ulaştığı anda ilgili departman tarafından yapmış olduğunuz havale/EFT işlemi ilgili banka üzerinden kontrol edilir. 
            </p>
            <h3>
                <img src="./resimler/InsanlarSiyah20x20.png" alt=""><span>Onay/Red</span>
            </h3>
            <p>
                Havale bildirimi geçerli ise/hesaba ödeme geçmiş ise, yönetici ilgili ödeme onayını vererek siparişiniz onaylanır ve teslimat birimine iletilir. 
            </p>
            <h3>
                <img src="./resimler/SaatEsnetikGri20x20.png" alt=""><span>sipariş Hazırlama & Teslimat</span>
            </h3>
            <p>
                Yönetici ödeme onayından sonra sayfamız üzerinden vermiş olduğunuz sipariş en kısa sürede hazırlanarak kargoya teslim edilir ve tarafınıza ulaştırılır. 
            </p>
        </div>
    </div>
</div>