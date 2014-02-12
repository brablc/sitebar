<?php

$help = array();

$help['100'] = <<<_P
SiteBar işlevlerine <strong>Kullanıcı menüsünden</strong> ve klasör-bağlantı <strong>Sağ tuş menüsünden</strong> ulaşılabilir. Kullanıcı menüsü SiteBar'ın altında bulunmaktadır.  Sağ tuş menüsüne ise klasör ya da bağlantılara sağ tuşla tıklanarak ulaşılabilir. Opera ve Apple kullanıcıları ise Ctrl tuşuna basılı tutarak tıkladıklarında bu menüye ulaşabilirler. Ctrl ile tıklama çalışmadığı zaman "Kullanıcı Ayarları" menüsünden "Menü Simgesini Göster" özelliğini etkinleştirebilirler. Bu özellik seçili olduğu zaman klasör ve bağlantıların yanında küçük bir menü simgesi görülecektir, bu simgeye tıklanarak menü çağrılabilir. <p> Sistemde kullanıcıya verilmiş izinlere bağlı olarak hem Sağtuş menüsü hem de kullanıcı menüsünde farklı komutlar görülebilir. Kullanıcı izinlerine ve programın o anki durumuna bağlı olarak bazı seçenekler etkin olmayan bir durumda olabilir. Ayrıca komutlar Komut Penceresi'nden çalıştırılmaktadır.
_P;

$help['101'] = <<<_P
Klasöre veya bağlantıya tıklayıp farenin sol tuşuna basılı tutarak taşıyabilirsiniz. Rengi değişen klasöre taşıdığınız klasör veya bağlantıyı bırakabilirsiniz. <p> Sürükle Bırak; Opera için uygulanamamaktadır. Bunun yerine kes ve yapıştır komutlarını kullanabilirsiniz.
_P;

$help['103'] = <<<_P
<p><strong>Filtrele</strong> - Gösterilen bağlantıları filtreler. Şu ön ekler kullanılarak nelerin filtreleneceği belirlenebilir: <strong>url:</strong>, <strong>Ad:</strong>, <strong>Açıklama:</strong>, <strong>Hepsi:</strong>. Varsayılan ön ek olarak <strong>Ad:</strong> kullanılmaktadır ve bu varsayılan önek "Kullanıcı Ayarları" bölümünden değiştirilebilir.

<p><strong>Arama</strong> - Filtrelenin aynısıdır fakat altta çalışır ve sonuçlar başka bir sayfada gösterilir.

<p><strong>İnternette Ara</strong> - İnternette arama ayarlandıysa ve buna izin verildiyse gösterilir.

<p><strong>Hepsini Daralt</strong> - Bütün dalları kapatır. İkinci sefer tıklandığında (bütün dallar kapalıyken) bütün dalları genişletir.

<p><strong>Saklı Dosyaları Göstererek Yenile</strong> - Saklanmış bağlantıları da göstererek bütün bağlantıları yeniden yükler.

<p><strong>Yenile</strong> - Bütün bağlantıları sunucudan alıp yükler, böyle bir özelliğin olma sebebi eğer tarayıcının sidebar'ına yüklenmişse kullanıcı (tarayıcıya bağlı olarak) başka türlü sayfayı yenileyemiyebilir.


_P;

$help['200'] = <<<_P
Komutlar birkaç gruba ayrıldılar. Komut hakkında yardım konusunu görmek için bir grubu seçiniz.
_P;

$help['210'] = <<<_P
<p><strong>Giriş</strong> - Kullanıcı sisteme giriş yapar ve çerezler(cookies) ile herzaman hatırlanır. Kullanıcı çerezin kullanma süresini belirleyebilir.

<p><strong>Çıkış</strong> - Kullanıcı sistemden çıkar. Genel kullanıma açık olan bilgisayarlarda bu özellik kullanılmalıdır. Bunun yerine girişte Oturum Süresi olarak "Tarayıcımı Kapatıncaya Kadar" seçeneği seçilip tüm tarayıcı pencereleri kapatıldığında da çıkış yapılmış olunur.

<p><strong>Üye Ol</strong> - Ziyaretçinin sisteme üye olmasını sağlar. Kullanıcı Adı olarak e-mail adresi kullanılır. E-mail adresine bağlı olarak kullanıcı bazı gruplara otomatik olarak üye olabilir. Bu durumda email adresi doğrulanmalıdır. Bu kullanıcıya gönderilen bir e-mail ile otomatik olarak yapılır. Sistem yöneticisi yeni kullanıcıların üye olmasını durdurabilir. Ayrıca yöneticiler kullanıcının SiteBar'ı veya hesabını kullanabilmesi için e-mail adresini doğrulanmasını isteyebilir.
_P;

$help['220'] = <<<_P
<p><strong>Kurulum</strong> - Yöneticinin SiteBar'ı kurarken ve bir veritabanını kurduktan sonra göreceği ilk komttur. Bir yönetici hesabı oluşturulur ve sitebar'ın ana parametreleri ayarlanır.  "Kişisel Kullanım" seçeneği seçildiğinde sadece belli özellikler kullanılabilir durumda olur.

<p><strong>SiteBar Ayarları</strong> - Yöneticiler daha sonra SiteBar parametrelerini değiştirebilirler. Yöneticiler ve "Kurulum" komutuyla açılmış kullanıcı hesapları "Yöneticiler" grubunun üyeleridir. E-mail özellikleri için "Üye Ol" kısmının ayrıntılarına bakınız. Ayrıca ilerisi için planlanan daha fazla e-mail özelliği bulunmaktadır.

<p><strong>Ağaç Oluştur</strong> - SiteBar ayarlarına bağlı olarak sadece yöneticiler ve/veya onaylanmış e-mail adresi olan kullanıcılar ağaç oluşturabilirler. Yeni bir ağaç oluşturulduğunda o ağaç kullanıcıya atanır(sadece yöneticiler başka kullanıcıya ağaç atayabilirler). Bir takım için bağlantılar oluşturmanın standart yolu önce bir ağaç oluşturup sonra o ağacı grubun moderatörüne atamaktır(Bu moderatör "Grup Oluştur" komutuyla daha önceden belirlenmiştir). Daha sonra bu kullanıcı(moderatör)  yeni oluşturulan ağacın izinlerini grup üyelerine verir ve bu gruba yeni üyeler ekleyebilir.

_P;

$help['230'] = <<<_P
<p><strong>Kullanıcı Ayarları</strong> - Kullanıcı ayarlarını değiştirir. "Dış Komut Ayarlayıcı" seçeneği seçili olmadığı zaman Komut  Penceresi ayrı bir pencere yerine SiteBar'ın bulunduğu yerde açılacaktır. Bazı komutlar mutlaka SiteBar'ın penceresinde açılır ("Giriş", "Çıkış", "Üye Ol", "Kullanıcı Ayarları"). "Yürütme Mesajlarını Atla" seçeneği seçili olduğu zaman başarılı komutlar sonrasında onaylama ekranı görülmez. "ACL Klasörlerini Süsle" seçeneği seçili olursa güvenlik özelliği olan klasörler işaretlenecektir.

<p><strong>Üyelik</strong> - Kullanıcılar açık bir gruba üye olabilirler veya herhangi bir grubu terkedebilirler. Kullanıcılar grubun son moderatörü olmaları durumunda grubu terkedemezler. Bu durumda yöneticiye grubun kaldırılması için başvurulmalıdır.

<p><strong>E-mail Doğrulama</strong> - Sistemin diğer özelliklerini kullanabilmek için e-mail adresini doğrulamasına izin verir.
_P;

$help['240'] = <<<_P
<p><strong>Kullanıcıları Düzenle</strong> - Kullanıcıların listesini gösterir ve aşağıdaki komutları çalıştırmayı sağlar.

<p><strong>Kullanıcı Özelliklerini Değiştir</strong> - Şu an için unutulan parolaları düzeltmek için tek yol şudur: Parola geçici bir değere atanır, bu kullanıcıya e-mail ile gönderilip değiştirmek isteyip istemediği sorulur. Yönetici hesabı deneme hesabı olarak belirleyebilir ve böylece bazı özelliklerin değiştirilmesi engellenir (özellikle parola).

<p><strong>Kullanıcıyı Sil</strong> - Kullanıcıyı ve tüm üyeliklerini siler. Varolan ağaçlarını başka bir kullanıcıya atar. Eğer kullanıcı grubun tek moderatörü ise kullanıcıyı silmek mümkün değildir.

<p><strong>Kullanıcı Oluştur</strong> - "Üye Ol"un aynısıdır, yönetici için yapılmıştır. Oluşturulan kullanıcının e-mail adresi doğrulanmış sayılır.
_P;

$help['250'] = <<<_P
<p><strong>Grupları Düzenle</strong> - Grupların listesini gösterir ve aşağıdaki komutları çalıştırmayı sağlar.

<p><strong>Grup Özellikleri</strong> - Grup moderatörlerinin erişimine açıktır. Grup adının, yorumlarının değiştirilmesine ve email düzgün ifadesi(regular expression) ile gruba otomatik üye olmanın ayarlarına izin verir. Otomatik üye olmak için regexp(düzgün ifade) doldurulduğunda ve yeni bir kullanıcının e-mail adresi buna uyduğu zaman, kullanıcıdan e-mail adresini doğrulaması istenir. Kullanıcı e-mail adresini doğruladıktan sonra otomatik olarak grubun üyesi olur. "Kendiliğinden Eklemeye İzin Ver" seçili olduğu zaman e-mail adresinin doğrulanmasına gerek yoktur.

<p><strong>Grup Üyeleri</strong> - Sadece moderatörler hangi kullanıcıların üye olabileceğini seçebilirler. Diğer moderatörler gruptan çıkartılamazlar, çıkartılmak istenirse önce moderatörlük görevi aşağıdaki komutla kaldırılmalıdır.

<p><strong>Grup Moderatörleri</strong> - Grup moderatörlerinin erişimine açıktır. En az bir moderatör bulunmalıdır.

<p><strong>Grubu Sil</strong> - Sadece yöneticiler bu bölüme erişebilir. Bir grubu ve tüm üyelerini siler.

<p><strong>Grup Oluştur</strong> -  Sadece yöneticiler bu bölüme erişebilir. Bir grup oluşturur ve ilk moderatörünü belirler.
_P;

$help['260'] = <<<_P
<p><strong>Klasör Ekle</strong> - Klasöre yeni bir alt klasör ekler.

<p><strong>Bağlantı Ekle</strong> - Klasöre yeni bir bağlantı ekler. Bookmarklet ile çalıştırıldığı zaman kullanıcının bağlantının ekleneceği klasörü seçmesine izin verir. Aksi takdirde kullanıcının bu komutu çalıştırdığı klasörde bağlantı oluşturulur.

<p><strong>Klasöre Gözat</strong> - Klasöre dizin şeklinde gözatmayı sağlar. Sadece bir klasör ve içindeki bağlantıların ayrıntıları görüntülenir.

<p><strong>Tüm Bağlantıları Göster</strong> - Tüm alt klasörlerin bağlantılarını bir seferde gösterir.

<p><strong>Bağlantı Haberlerini Göster</strong> - Klasörün ve alt klasörlerinin haberlerini gösterir.

<p> 

<p><strong>Klasörü Sakla</strong> - Klasörü saklar. Az kullanılan veya başkalarının yayınladığı klasörleri saklamak için kullanılır.  "Saklı Dosyaları Göstererek Yenile" simgesine tıklanması geçici olarak tüm klasörler yükleyecektir. "Alt Klasörleri Göster" komutu saklı klasörlerin daima gösterilmesi için kullanılabilir. Saklı ağaçlar "Ağaçları Düzenle -> Saklı Ağaçları Göster" komutu ile gösterilebilir.

<p><strong>Alt Klasörleri Göster</strong> - Tıklanan klasörün tüm alt klasörlerini gösterir.

<p><strong>Klasör Özellikleri</strong> - Klasör özellikleri(ad ve açıklama) belirlenir.

<p><strong>Klasörü Sil</strong> - Klasörü siler. Silinen klasör "Silme İşlemini Geri Al" komutu ile veya aynı adlı bir klasör oluşturularak tekrar yüklenebilir. Kullanıcı kendi ana dalını dahi silebilir, fakat bu silme işlemi bu klasörden "Klasörü Tamamen Sil" komutunu çağırdığı zaman geçerli olur. Silinen ana dal ancak sahibi tarafından (Klasörü Tamamen Sil komutu ile) tamamen silinebilir veya (Silme İşlemini Geri Al komutu ile) geri yüklenebilir.

<p><strong>Klasörü Tamamen Sil</strong> - Daha önce silinmiş klasörleri veya içerisindeki bağlantıları tamamen siler. Tamamen silinenler geri yüklenemez!

<p><strong>Silme İşlemini Geri Al</strong> - Daha önce silinen klasör ve bağlantıları "Klasörü Tamamen Sil" işlemi yapılmadıysa geri yükler. Eğer bir ana dal silindiyse, bu sadece ağacı oluşturana gri tondaki simge ile  görünür. Böylece paylaşılan bu bağlantıların izin verilen başka kullanıcı tarafından aynı adlı klasörün silinmesi ile kaybolması engellenir.

<p>

<p><strong>Kopyala</strong> - Bir klasörü ve Copy folder and all its content to the internal clipboard.

<p><strong>Yapıştır</strong> - Sadece "Kopyala" ve "Bağlantıyı Kopyala" komutları çalıştırılınca etkin olur. "Yapıştır" komutu kullanıcının kopyalama ya da kesme işlemini yapmasını sağlar ve varsayılan değeri seçmesini sağlar. Yine de kullanıcı kopyalama veya kesme işlemini seçebilir.

<p>

<p><strong>Bağlantıları Al</strong> - Bağlantıları bilgisayarda bulunan bir dosyadan alır. Sunucuda zaman aşımını önlemek için bu aşamada bağlantıların doğrulaması yapılmaz.

<p><strong>Bağlantıları Ver</strong> - Klasörün içeriğini dışarıdaki bir bağlantı dosyasına aktarır. Netscape bağlantı dosyası formatı ve  Opera HotList desteklenmektedir. Mozilla, Netscape bağlantı dosyası formatını desteklemektedir ve Internet Explorer bu formatla bağlantıları alıp verebilir.

<p><strong>Bağlantıları Doğrula</strong> - Bir klasör ve alt klasörlerindeki tüm bağlantıları doğrular. Doğrulama işlemi için sınırüstü(outbound) bağlantıya ihtiyaç vardır. Doğrulama sırasında yeni faviconlar bulunması ve favicon önbelleğinde bulunmayan faviconların silinmesi mümkündür. Doğrulama sayfası denenen tüm bağlantıların bir listesini gösterir. Doğrulama işlemi her bağlantı için simgelerin alınmasını ve gösterilmesini kapsar. Eğer favicon bulunamazsa standart bağlantı simgesi gösterilir, ölü bir bağlantı bulunduğunda yanlış-faviconu gösterilir. Tarayıcı birçok bağlantı için hata yapabilir, bu durumda kullanıcının tarayıcıda sayfayı yeniden yüklemelidir(reload), en son denenen siteler önemsenmeyecektir ve kullanıcı onaylama işini parça parça yapar. Ölü bağlantılar silinmeyecek sadece işaretlenecektir. Bunlar Sidebarda aynı yerde görüntülenecektir.

<p><strong>Güvenlik</strong> - Her klasör için kullanıcı haklarını belirlemeyi sağlar, belirlenen haklar tüm alt klasörler için de geçerlidir. Daha fazla ayrıntı için "Güvenlik Mekanizması" bölümüne bakınız.
_P;

$help['270'] = <<<_P
<p><strong>Bağlantıyı E-mail'le Gönder</strong> - Bir bağlantının başkasına e-mail ile gönderilmesine izin verir. E-mail'i onaylanan kullanıcılar için SiteBar sunucusunda bulunan e-mail sistemi kullanılabilir aksi takdirde bilgisayarda başka program çalıştırılmalıdır.

<p><strong>Bağlantıyı Kopyala</strong> - Bir bağlantıyı içerde kopyalar. Herhangi bir klasör üzerinde "Yapıştır" komutunu kullanarak bağlantıyı başka bir noktaya taşıyıp, kopyalayablirsiniz.

<p><strong>Bağlantıyı Sil</strong> - Bağlantıyı bir noktadan siler. Silinen bağlantı ait olduğu klasörde "Silme İşlemini Geri Al" komutu kullanılarak geri alınabilir. <p><strong>Özellikler</strong> - Bağlantının özellikleri değiştirilebilir. Bir bağlantı "Özel" olarak ayarlanabilir.
_P;

$help['300'] = <<<_P
SiteBar 3, SiteBar 2.x serisinin, yeniden yazılmış ve büyük evrim geçirmiş halidir.
<p>
SiteBar 3 ağaçları oluşturmak için artık JavaScript kullanmamaktadır. Fakat sağ tuş menüsünü göstermek, klasörleri açıp kapatmak, simgeleri değiştirmek için JavaScript oldukça sık kullanılmıştır. <a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a> tarayıcı tarafından desteklenmelidir. Bunun faydası, çok hızlı bir şekilde bağlantıları yüklemesidir. Fakat bunun zararı, eski tarayıcıların bunu desteklememesi, bütün ağaçları açık görmesi ve sadece okuma izni vermesidir. (yine de 2.x'e göre daha iyidir çünkü 2.x sürümü eski tarayıcılarda hiçbirşey göstermemiştir)
<p>
Sunucu tarafında veriler en basit içiçe yapılar şeklinde kaydedilmiştir ve ağaç işlemleri için en uygun hale getirilmiştir. Bu sayede seçerken çok yüksek bir preformans elde edilmiştir. Ayrıca veritabanı tablolarının indexlemesi sayesinde çok fazla bağlantı olması durumunda bile seçme işi yavaşlamamıştır.
_P;

$help['302'] = <<<_P
SiteBar 3 kullanıcı yetkileri konusunda çift denetleme yapmaktadır. Kullanıcıya yetkileriyle ilgili komutların sadece bazı alt komutlarının çalışması gösterilir. Çalıştırılan her komut tekrar çalıştılmadan önce tekrar doğrulanır.

<p> Sistemde üç kimlik belirlenmiştir: kullanıcılar, moderatörler, yöneticiler. Moderatörler grubun kurulumu sırasında moderatör olarak belirlenmiş kullanıcılardır veya başka moderatörler tarafından moderatör olarak atanmışlardır. Bir moderatörün görevi sadece belli bir grup içindir. Yöneticiler ve "Kurulum" komutu ile sistemi ilk kuran kişi, Yöneticiler grubunun üyeleridir. Yöneticiler tüm grupları silebilirler.

<p> SiteBar 3 birçok takımın isteklerini karşılayabilmek için hazırlanmıştır. Yani kullanıcıların grupları bağlantılarını paylaşabilirler. Takımın bağlantılarını özel(gizli) tutabilmek için yetki denetleme mekanizması geliştirilmiştir.

<p> Bu mekanizmanın ana yapıtaşı şudur: Anadalın sahibi diğer alt dalların tüm yetkilerine sahiptir. Üye olma veya üye oluşturma sırasında her kullanıcı için bir anadal oluşturulur. Ayrıca yöneticiler herhangi bir kullanıcı için ağaç oluşturabilir veya diğer kullanıcıların kendi ağaçlarını oluştumalarına izin verir.

<p> Kullanıcı ağaç oluşturma sırasında diğer grupların bu ağaç üzerindeki yetkilerini belirleyebilir. Herhangi bir kullanıcı grubu için şu yetkiler bulunmaktadır:


<p><strong>Oku</strong> - Grup kullanıcısı bağlantıları kullanabilir. Eğer bağlantıları görmek istemiyorsa gruptan çıkmalıdır.

<p><strong>Ekle</strong> - Kullanıcı, klasör ve bağlantı ekleyebilir.

<p><strong>Değiştir</strong> - Kullanıcı, klasörlerin ve bağlantıların özelliklerini tanımlayabilir.

<p><strong>Sil</strong> - Kullanıcı, klasör veya bağlantıyı silebilir

<p><strong>Tamamen Sil</strong> - Daha önce silinen klasör veya bağlantıyı tamamen siler. 'Sil' ile birlikte klasörün bir ağaçtan diğer ağaca taşınmasına izin verir.

<p><strong>İzin Ver</strong> - Grup üyeleri ağacın sahibi ile aynı haklara sahip olur.

<p> Yetkiler herzaman klasörden alt klasörlerine aktarılır. Anadal klasörü varsayılan ayar olarak hiçbir gruba yetki vermemiştir. Kullanıcı bazı klasörler için daha kısıtlayıcı yetki verebilir, bu durumda alt klasörler de bundan etkilenecektir. Eğer bir klasördeki yetkiler bir üstteki klasörle aynı ise yetki tanımlamaları o klasör için kaldırılır ve üst klasör yetki için taban teşkil etmeye başlar.

<p> Grup moderatörleri herhangi bir kullanıcı tarafından kendi grubu için tanımlanmış herhangi bir yetkiyi kaldırma hakkına herzaman sahiptirler.

<p> Klasör güvenlik mekanizmasına ek olarak, yayınlanan klasördeki istenilen bağlantıları özel tutmayı sağlayan bir çözüm de vardır. Ağacın sahibi herhangi bir bağlantıyı özel olarak işaretleyebilir. Böylece diğer kullanıcıların bağlantıyı göstermesi ve bir değişiklik yapması engellenir. Eğer klasör yayınlanmadıysa (ki varsayılan ayarda bunlar yayınlanmamıştır) bağlantıları "özel" olarak tanımlamaya gerek yoktur.

<p> Klasör üzerinde ne kadar çok yetki özelliği tanımlanırsa bağlantıları yüklemek tüm kullanıcılarda o kadar uzun sürer. İçiçe birçok klasör içeren ağaçlarda yetki özellikleri aşırı kullanılmamalıdır. 

<p> Eğer yönetici "Kişisel Kullanım"ı seçtiyse güvenlik komutu yoktur bunun yerine "Klasör Özellikleri" kısmında "Klasörü Yayınla" komutu vardır. Bu durumda klasör yayınlandıysa alt klasörlerin yetkilerini kısıtlamak mümkün değildir. 

Kişisel Kullanım modundan varsayılan mod olan "Girişimci" (Enterprise) moduna geçilebilir (tersi de mümkündür) fakat kişisel modda girişimci modunda verilen yetkileri kaldırmak mümkün olmaz.
_P;

$help['303'] = <<<_P
Sitebar kullanıcı kabukları(skin) tasarlanmasına izin verir. Kabuk tasarlayabilmek için iyi derecede CSS bilgisi gerekmektedir ve tamamen düzenleyebilmek için XSLT bilgisi gerekir. Yeni bir kabuk tasarlamak için varolan kabuklar örnek alınmalıdır. Yani "skins" klasöründeki herhangi bir kabuk  alınıp bir kopyası oluşturulmalıdır. Tüm kabuklar şunlardan oluşur: 
<ul> 
<li>Birkaç resim (basitçe resimleri değiştirin, fakat PNG formatını koruyun).
<li>Hook dosyası "hook.inc.php", bu dosya kabuk hakkında bazı bilgiler almak için (mesela yazar adı) bazı diğer bölümler tarafından kullanılır.
<li>Renk tanmlamalarını içeren ve diğer stil-şablonları tarafından paylaşılan ortak stil-şablonu(common style sheet) 
<li>Style-sheet for SiteBar panel "sitebar.css". 
<li>XSLT'ye dayanan yazarlar için bağlantı haberleri gösterimi şablonu "news.css", klasöre gözatma şablonu "directory.css" ve arama şablonu "search.css" vardır.
</ul> 
<strong>XSL</strong> - XML stil-şablonu kullanarak XML'e dayanan SiteBar çıktılarını tamamen değiştirmek mümkündür. Bu durumda skins/*.xsl.php dosyalarından birini kabuk(skin) klasörüne kopyalayıp değiştirmek gerekir.
<p> 
<strong>İçiçelik</strong> - ortak stil-şablonları dışındaki tüm stil-şablonları ortak stil-şablonlarının (ve skins klasöründeki ortak stil-şablonlarının) altkümesi olarak oluşturulmuştur. Kabuk tasarımcısı varsayılan değerleri buradan yeniden tanımlayabilir.

<p> 
<strong>Uyarlama</strong> - bazı site yöneticileri kendi sitelerine uygun kabuk tasarlamak isteyebilirler. Bu durumda tüm diğer kabukları kaldırıp SiteBar Ayarları bölümünden varsayılan kabuğu seçmeleri önerilir.

<p>Eğer kendi kabuğunuzun SiteBar dağıtımında bulunmasını istiyorsanız SiteBar takımıyla görüşmeli ve tasarladığınız kabuğu SiteBar'ın son kararlı sürümüyle test etmelisiniz. Kural olarak SiteBar logosu sayfada bulunmalıdır ve SiteBar logosu rahatlıkla güncellenebilir.

_P;

$help['304'] = <<<_P
Sitebar SiteBar'ın içeriğini değişik yollardan hazırlayan yazarların bütününü kulanır. Ana SiteBar paneli bir yazarın ürünüdür.

Tüm yazarlar <strong>inc/writer.inc.php</strong> içinde bulunan <strong>SB_WriterInterface</strong> sınıfından gelmektedir ve bunlar <strong>inc/writers</strong> klasöründe bulunmaktadırlar. Bir çıktı oluşturmak için sadece birkaç metodu eklemek  gereklidir ve hatta hazırda varolan yazarlar ve onların uzantıları kullanılabilir (çünkü  birçok ana SiteBar yazarı XBEL formatına dayanmaktadır)
_P;

$help['305'] = <<<_P
Hazırda varolan bir SiteBar kurulumunu başka bir sunucuya taşımak için:
<ul>
    <li>Kaynak veritabanında bulunan sitebar_* tablolarını .SQL dosyasına gönderin.
    <li>Bu dosyayı hedef veritabanına alın.
    <li>Yazılımı taşıyın veya kararlı bir SiteBar sürümünü kurun
        (Yazılımın alçaltılması veya yükseltmesi otomatik olarak yapılacaktır).
    <li>Eğer veritabanı bağlantı ayarları değişecekse inc/config.inc.php dosyasını
       silin veya değiştirin.
</ul>

<p>
Tabloları alma ve verme işi <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a> kullanılarak yapılabilir.
sitebar_favicon tablosunun (3.2.6'e kadar) ve sitebar_cache'in (3.3'den başlayarak) taşınmasına gerek yoktur, bunların içeriği yeniden oluşturulacaktır.

_P;

?>
