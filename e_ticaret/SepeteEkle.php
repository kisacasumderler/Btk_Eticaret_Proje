<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	Guvenlik($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}
	
	if(isset($_POST["varyantlar"])){
		$GelenVaryantID	=	Guvenlik($_POST["varyantlar"]);
	}else{
		$GelenVaryantID	=	"";
	}

	if(($GelenID!="") and ($GelenVaryantID!="")){

		$KullaniciSepetKontrol = $db->prepare("SELECT * FROM sepet WHERE UyeId=? ORDER BY id DESC LIMIT 1");
		$KullaniciSepetKontrol->execute([$id]);
		$KullaniciSepetSayisi = $KullaniciSepetKontrol->rowCount();

		if($KullaniciSepetSayisi>0){
			// kullanıcının sepette herhangi bir veya daha fazla ürünü var 
			$UrunSepetKontrol = $db->prepare("SELECT * FROM sepet WHERE UyeId=? AND urunId=? AND VaryantId=? LIMIT 1");
			$UrunSepetKontrol->execute([$id,$GelenID,$GelenVaryantID]);
			$UrunSepetSayisi = $UrunSepetKontrol->rowCount();
			$UrunSepetKaydi = $UrunSepetKontrol->fetch(PDO::FETCH_ASSOC);
				if($UrunSepetSayisi>0){
					// ürün daha önce sepete eklemişse 
					$urunIDsi = $UrunSepetKaydi["id"];
				$UrunMevcutAdedi = $UrunSepetKaydi["urunAdedi"];
				$urunYeniAdedi = $UrunMevcutAdedi+1;


				$UrunGuncellemeSorgu = $db->prepare("UPDATE sepet SET urunAdedi=? WHERE id=? AND UyeId=? AND urunId=? LIMIT 1");
				$UrunGuncellemeSorgu->execute([$urunYeniAdedi,$urunIDsi,$id,$GelenID]);
				$UrunGuncellemeSayisi = $UrunGuncellemeSorgu->rowCount();
					
				if($UrunGuncellemeSayisi>0){
					// ürün sepete eklendi
					header("Location:index.php?SK=94");
					exit();
				}else {
					// hata sepet güncellenemedi 
					header("Location:index.php?SK=92");
					exit();
				}
					
			}else {
					//ürün daha önce sepete eklenmemişse
			$UrunEklemeSorgu = $db->prepare("INSERT INTO sepet(UyeId,urunId,VaryantId,urunAdedi) values(?,?,?,?)");
			$UrunEklemeSorgu->execute([$id,$GelenID,$GelenVaryantID,1]);
			$UrunEkleSayi = $UrunEklemeSorgu->rowCount();
			$SonIDdegeri = $db->lastInsertId();

			if($UrunEkleSayi>0){
				$SepetSiparisNOguncelle = $db->prepare("UPDATE sepet SET sepetNumarasi=? WHERE UyeId=?");
				$SepetSiparisNOguncelle->execute([$SonIDdegeri, $id]);
					$SepetSiparisNOguncelleSayi = $SepetSiparisNOguncelle->rowCount();
					if($SepetSiparisNOguncelle>0){
						// sepet güncellendi 
						header("Location:index.php?SK=94");
						exit();
					}else {
						// hata sepet güncellenemedi 
						header("Location:index.php?SK=92");
						exit();
					}
			}else {
				// hata ürün eklenemedi 
				header("Location:index.php?SK=92");
				exit();
			}
		}
			
		}else {
			// kullanıcının sepette herhangi bir ürünü yok 
			$UrunEklemeSorgu = $db->prepare("INSERT INTO sepet(UyeId,urunId,VaryantId,urunAdedi) values(?,?,?,?) ");
			$UrunEklemeSorgu->execute([$id,$GelenID,$GelenVaryantID,1]);
			$UrunEkleSayi = $UrunEklemeSorgu->rowCount();
			$SonIDdegeri = $db->lastInsertId();

			if($UrunEkleSayi>0){
				$SepetSiparisNOguncelle = $db->prepare("UPDATE sepet SET sepetNumarasi=? WHERE UyeId=?");
				$SepetSiparisNOguncelle->execute([$SonIDdegeri, $id]);
				$SepetSiparisNOguncelleSayi = $SepetSiparisNOguncelle->rowCount();
				if($SepetSiparisNOguncelle>0){
					// sepet güncellendi 
					header("Location:index.php?SK=94");
					exit();
				}else {
					// hata sepet güncellenemedi 
					header("Location:index.php?SK=92");
					exit();
				}

			}else {
				// hata 
				header("Location:index.php?SK=92");
				exit();
			}
		}

	}else{
		header("Location:index.php");
		exit();
	}
}else{
	header("Location:index.php?SK=93"); // üye girişi yapılmamış 
	exit();
}
?>