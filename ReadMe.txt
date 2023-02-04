Merhabalar 
Btk akademi PHP eğitim (Eğitmen Volkan Alakent ) projesi olarak tasarladığım web sitesi kodlarını sizlerle paylaşmaktayım.
Orijinal proje bana ait olmadığı için ve zaten Btk Akademide tüm kursiyerlere açık bir şekilde paylaşıldığı için bende paylaşmakta bir sakınca görmüyorum. 
Öncelikle bu tasarım basic e ticaret projedir, hepsiburada, trendyol, ebay ve amazon kalitesi beklenemez bir e ticaret sitesinde olması gereken en basit özellikler mevcuttur. Ancak bir e ticaret web sitesi olarak istenirse kullanılabilir mi evet kullanılabilir. 
Bu eğitimi bitirmek benim için zor oldu ancak bu eğitim süresinin uzunluğundan değil tamamen kendi yanlış çalışma şeklimden dolayı, acı bir şekilde öğrendim ki kod yazmak not alınarak çalışılmıyor :) 209 saatlik bir eğitimi not alarak bitirmeye çalışırsanız; bitiremezsiniz. Ve daha da kötü olanı not aldığım hiç bir şeyi hatırlamadığımı fark ettim ne zaman ki not almayı bırakıp bir yandan eğitimi izleyip bir yandan hocayla beraber kodları yazıp ne işe yaradıklarını kendi ellerimle yapıp kendi gözlerimle gördüğümde, öğrendiğim işlemlere kendimce alternatif eklemeler yapıp projeler yaptığımda evet öğreniyorum hem de motor beceri geliştirir gibi öğreniyorum araba sürmeyi bisiklet sürmeyi nasıl unutmazsınız artık yaptığım projeleri zor yoldan öğrenmelerimi debelenmelerimi asla unutmayacağım. (Bu tecrübemi daha kodlamaya yeni başladınız ve bir şekilde projeme denk geldiyseniz asla aynı hataya düşmeyin diye paylaşıyorum umarım sıkmamışımdır.)
Projeden bahsedecek olursak eğitimi bitirmek zor olduğu için arada eğitimden koptum ve javascript sass jquery  öğrendim bu eğitimi bitirene kadar olaydan arada kopsamda eğitimden tamamen kopmamam iyi oldu ve projeyi eğitimde gösterilen şekilde değil, eklemeler yaparak geliştirdim ancak öğrenerek geliştirdiğim bir proje olduğu için kod kalabalığı yapmış olabilirim eğer bana yanlışlarım konusunda destek olmak isterseniz önerilere her zaman açığım her sosyal medya hesabımda kulllanıcı adım @kisacasumderler’dir github gibi (twitter hariç malesef çaldırdım) herhangi bir hesabımdan bana ulaşabilirsiniz frontendmentor'dan bana challenge atabilirsiniz:). 
Öncelikle proje responsive her ekranda kullanılabilir. (kodları css ile yazdım sass ile yazmak projeyi yarıladığımda dank etti beynimde geriye dönemem çaldı bende dönmedim:] )
Ana sayfayı tamamen eğitimde gösterilenden farklı bir şekilde tasarladım sliderlar mobil ve web sitesi farkı olacak şekilde yapıldı ve zaman ayarlı bir şekilde slayt gösterimi hem sliderlarda hemde ürünlerde mevcut. 
javascript kodlamalrını web sitesinde tamamen jquery ile yaptım ancak yönetim panelinde saf javascript yazdım (zaten sadece menüde kod var başka javascriptlik bir şey yok orada)
Volkan hocamız web sitesi en üst banneri siteye gömülü bir şekilde tasarladı ancak ben bunu yönetim panelinden değiştirilebilir bir şekilde tasarladım böylece değiştirmesi daha kolay olacak admin olarak kodlarla haşır neşir olmanıza gerek kalmayacak. 
Yönetim Paneline resim yüklemek :
1-üst Banner:  
Anasayfanın en üstündeki banner alanına resim eklemek için Banner alanı -> Anasayfa Üst seçilmelidir. 
Resim arkaplanı varsayılan olarak #353745 kodlu renktir. Eğer transparan bir png yükleme yaparsanız bu renge göre tasarım yapmanız gerekmektedir. Eğer isterseniz img veya gif dosyası tasarlayıp bu arka plan rengine bağlı kalmadan da dosya yükleyebilirsiniz. 
GenişlikxYükseklik : 1064x60 olarak ayarlanmalıdır. 

2-Slider resimleri : 
Slider Web görünüm için resim yükleme : Banner alanı -> Anasayfa, 
Slider Mobil görünüm için resim yükleme : Banner alanı -> Anasayfa Mobil seçilmelidir. 
Herhangi bir arkaplan rengi tanımlanmadı ancak png transparan arkaplanlı resim yüklemenizi tavsiye etmem slayt geçişlerinde resimlerin üst üste binmesini sağlayacaktır.
Slider resim gösterim sırası eğitimdeki gibi veritanı hit güncelleme yöntemiyle geliyor yani en az gösterim sayısı olan slider resmi sayfa yüklendiğinde ilk sırada gösterilecek şekilde ayarladım. Slayt süresi 4 sn.’dir app.js dosyasında açıklamalarıyla kodları yazdım istenirse güncellenebilir.
Web görünüm GenişlikxYükseklik : 1064x400
Mobil görünüm GenişlikxYükseklik : 1:1 oranındadır. Yani genişlik yükseklik aynı boyda olduğu sürece boyut fark etmez. Ancak büyük boyutlarda resim yüklemenizi tavsiye etmem sitenin yavaş yüklenmesine neden olacaktır. Tavsiyem 500x500 96 dpi ki zaten o şekilde ayarladım yüksek boyut bile yükleseniz site yükleme yaparken boyut düşürecektir. Çok boyutlu dosya yüklemeniz yine bir eksi olacaktır Fotoğraf çözünürlük ne kadar büyük boyuttan düşerse o kadar kötü gözükür. 

3- Kategori resimleri : 
Web Görünüm Resim yükleme : Banner alanı -> Anasayfa Kategoriler,
Mobil Görünüm Resim Yükleme : Banner alanı -> Anasayfa Kategoriler Mobil  seçilmelidir. 
istenildiği kadar yükleme yapılabilir. Kategori arttıkça buraya fazladan resim eklenebilir. Site erkek, kadın, çocuk olarak örnek tasarlandı eğer 3 kategori kalsın istenirse bir kere yükleme yaptıktan sonra tekrar yükleme yapmaya gerek yok güncelleme yapılabilir. 
Web Görünüm GenişlikxYükseklik : 1:1 oranındadır. Tavsiyem 350x350 96 dpi 
Mobil Görünüm GenişlikxYükseklik : 500x200
img, png, gif olarak yükleme yapılabilir. 
Kategori resimleri link olarak tasarlandı yani erkek kategorisine tıkladığınızda erkek ayakkabıları sayfasına yönlendirilirsiniz. Ancak bunun çalışması için Kategori resmi yüklerken açıklamaya kategori ismini belirtmeniz gerekiyor. Eğer tasarımımı alıp siteyi başka bir ürün için kullanmak isterseniz tasarımda kategorileri(kodlar dahil) buna göre düzenlemeniz gerekecektir. 
4- Ürün resmi : 
GenişlikxYükseklik = 600x800, oranlı olarak daha büyük boyutlar istenirse eklenebilir. 
jpeg, jpg yüklenebilir. 
Ürün resmi ekleme Ana menü -> Ürünler -> Ürün ekle butonundan yapılabilir. 

Resim yüklemeye ek olarak yönetim paneli, üye olma sistemi, sipariş verme, mail alma, kart bilgisi ile alışveriş yapmak bütün işlemler localde denedim çalışmaktadır. Ancak paylaşacağım web sitesi önizlemesi sayfasından bunları yapmanız mümkün olmayacak (eh bedava hostingte bir yere kadar mail atma/alma özelliği premiuma özel:/ )

https://btkegitimeticaret.great-site.net/ adresine giriş yaparak tasarımı inceleyebilirsiniz. 

Sayfadaki görsellerin tasarımı bana aittir (Banner/Slider sadece ürün resmi ikonlar dahil değil) ödünç almanızda bir sakınca yok :)
