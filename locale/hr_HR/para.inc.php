<?php

$para['integrator::welcome'] = <<<_P
Dobrodošli na stranicu za integriranje SiteBara. Ova će vam stranica
pomoći da u potpunosti iskoristite SiteBar. Više informacija o mogućnostima
SiteBara možete naći <a href="http://sitebar.org/">ovdje</a>.
_P;

$para['integrator::header'] = <<<_P
SiteBar je dizajniran imajući u vidu poštivanje standarda i trebao bi
raditi sa većinom browsera s uključenom podrškom za javascript i cookie.
Sljedeća tablica prikazuje na kojim je sve browserima SiteBar testiran.
_P;

$para['integrator::usage_opera'] = <<<_P
<@>Sitebar koristi desni klik za pozivanje kontekstnih izbornika na linkovima i folderima.
Kao korisnik Opere za otvaranje kontekstnih izbornika potrebno je koristiti Ctrl + lijevi klik
ili uključiti "Ikonu izbornika" u "Korisničkim postavkama" te klikati na ikonu pokraj linka ili foldera.
Opera ne podržava <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
Preporučeno je da se u korisničkim postavkama isključe opcije vezane za XSLT.
_P;

$para['integrator::hint'] = <<<_P
Kliknite na naziv browsera za prikaz mogućnosti integracije.
_P;

$para['integrator::hint_window'] = <<<_P
Ovo je obični link koji će otvoriti SiteBar u postojećem prozoru.
SiteBar je dizajniran za okomiti prikaz tako da se ovim načinom
gubi dosta na prostoru.
_P;

$para['integrator::hint_dir'] = <<<_P
SiteBar je moguće prikazivati i na tradicionalni način; kao direktorije.
Ovaj pogled prikazuje jedan po jedan direktorij i detalje o linkovima.
Browser mora podržavati <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Ovaj bookmarklet&#42; služi za otvaranje SiteBara u pop-up prozoru.
Imajte u vidu da neki browseri mogu blokirati pop-up prozore.
_P;

$para['integrator::hint_iframe'] = <<<_P
URL s lijeve strane omogućuje vam korištenje SiteBara u <IFRAMEu>.
Ovo je korisno za postavljanje SiteBara u razne portale kao što su:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a>
<li><a href="http://www.netvibes.com/">Netvibes</a>
</ul>
Na portalu pronađite mjesto gdje možete dodavati svoj sadržaj. Kopiranjem ovog URL-a <strong>%s</strong>
na to mjesto trebao bi biti kreiran novi sadržaj (https obično nije podržan na portalima, ali može se
koristiti pomoću iframe.php datoteke). Vaše korisničko ime i lozinka <strong>NIJE</strong> vidljiva portalu.
Korisnici MS IE browsera trebaju dozvoliti kreiranje cookiea za SiteBar server domenu.
_P;

$para['integrator::hint_addpage'] = <<<_P
S ovim bookmarkletom&#42; dodajete linkove u SiteBar. Prilikom aktiviranja, otvara se
novi pop-up prozor u kojemu se nalaze već ispunjeni detalji o odabranoj stranici.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> je bookmark/favorites stavka
koja sadrži JavaScript kod. Desnim klikom možete ga dodati u svoj bookmark/favorites toolbar i
pokretati ga odande. Prilikom pokretanja aktivira se JavaScript kod.
_P;

$para['integrator::hint_search_engine'] = <<<_P
Dodaje mogućnost pretraživanja SiteBar linkova u Web Search polje. Omogućuje pretraživanje
linkova bez otvorenog SiteBara.
_P;

$para['integrator::hint_sitebar'] = <<<_P
<@>Ekstenzija razvijena specijalno za SiteBar.
Omogućuje otvaranje svih linkova iz jednog foldera u tabovima itd.
Za postavljanje SiteBar ikona na toolbar koristite izbornik
View/Toolbar/Customize. [<a href="http://sitebarsidebar.mozdev.org/">Project page</a>]
_P;

$para['integrator::hint_bmsync'] = <<<_P
Za korištenje obostrane sinhronizacije linkova sa Firefoxom instalirajte Bookmark Synchronizer
ekstenziju. Za informacije o podešavanju ekstenzije koristite "Korisničke postavke" -> "XBELSync Settings".
[<a href="http://sitebar.org/downloads.php">Više informacija</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Kreiranje linka koji se kasnije koristi za otvaranje SiteBara u sidebar panelu.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Izvezite strukturu foldera cijelog SiteBara u dokument. Uvezite taj dokument u vaše bookmarke.
Svaki folder će biti prezentiran kao Live Bookmark. Na ovaj će način linkovi iz SiteBara biti
integrirani među ostalim bookmarkima, ali sadržaj foldera će ostati online; odnosno uvezen iz
SiteBara. U slučaju da folder sadrži subfoldere, sadržaj aktualnog foldera bit će prikazan u
@Content folderu.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Dodaje SiteBar u sidebar panel. Panel se može prikazati/sakriti pritiskom
na tipku F9. U slučaju da učitavanje SiteBara u sidebar panelu traje duže
od određenog vremenskog ograničenja, Mozilla ga neće moći prikazati. U tom
slučaju preporučuje se prvo otvoriti SiteBar u glavnom prozoru kako bi se
učitale sve slike ili isključiti prikaz favicona u "Korisničkim postavkama".
_P;

$para['integrator::hint_sidebar_konqueror'] = <<<_P
Primijenite sljedeće korake:
<ol>
<li>Pokrenite Konqueror
<li>Idite na menu "Window -> Show Navigation Panel (F9)"
<li>Kliknite desnim dugmetom miša na ikone u Navigation Panelu ispod ikona.
<li>Odaberite "Add New -> Web SideBar Module" - bit će dodana nova ikona pod nazivom "Web SiteBar Plugin".
<li>Kliknite desnim dugmetom miša na novu ikonu i odaberite "Set Name" i upišite <b>SiteBar</b>.
<li>Kliknite desnim dugmetom miša na novu ikonu i odaberite "Set Url", i upišite <b>%s</b>.
<li>Kliknite na ikonu kako biste otvorili SiteBar u sidebaru.
</ol>
_P;

$para['integrator::hint_hotlist'] = <<<_P
<@>Dodavanje linka za otvaranje SiteBara u Hotlist panel. Klikom na link otvara se SiteBar u Operinom sidebaru.
_P;

$para['integrator::hint_install'] = <<<_P
Instaliranje SiteBara u Explorer Bar i kontekstni izbornik - zahtjeva promjenu Windows
registrya i restart sistema za aktiviranje svih opcija. Ovisno o vašim pravima moguće je
da budu instalirane samo neke opcije.
<br>
Nakon instalacije otvorite SiteBar Explorer Bar preko izbornika View/Explorer Bar ili
iskoristite mogućnost prilagođavanja toolbara za dodavanje dugmeta, koji otvara SiteBar
Explorer Bar, na toolbar. Dodavanje stranice u SiteBar sada možete obaviti desnim klikom
iznad linka ili bilo gdje na stranici.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Deinstalira Explorer Bar (pogledajte gore).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Korištenje ovog bookmarkleta&#42; preporučuje se u slučaju kada korisnik nema dovoljno
prava za instalaciju SiteBara u Explorer Bar. Klikom na njega SiteBar se privremeno
otvara u Search Explorer Baru vašeg browsera.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Download plugina (s predefiniranim URL-om). Arhiva se mora dekompresirati u "C:\Program Files\Maxthon\Plugin"
folder. Nakon restarta novi bit će dodana nova Explorer Bar stavka.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Download plugina (s predefiniranim URL-om). Arhiva se mora dekompresirati u "C:\Program Files\Maxthon\Plugin"
folder. Nakon restarta nova ikona bit će dodana na Plugin toolbar. Ovom ikonom dodavati stranice u SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Izvršite komandu <strong>emerge sitebar</strong> za instaliranje SiteBar paketa.
_P;

$para['integrator::hint_debian'] = <<<_P
Izvršite komandu <strong>apt-get install sitebar</strong> za instaliranje SiteBar paketa.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu je hijerarhijski sustav izbornika za izradu DHTML izbornika "u letu".
Baziran je na PHP-u. SiteBar je u mogućnosti posluživati bookmark feed odgovarajuće
strukture. U slučaju da je omogućena naredba fopen za udaljene dokumente, sljedeći će
kod učitati dokument odgovarajuće strukture:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> i <a href='http://sitebar.org/team.php'>SiteBar tim</a>.
Podrška: <a href='http://sitebar.org/forum.php'>forum</a> i <a href='http://sitebar.org/bugs.php'>bug</a> tracking.
_P;

$para['command::welcome'] = <<<_P
%s, dobrodošli u SiteBar!
%s
<p>
Za upravljanje linkovima koristite se desnim klikom miša na folder ili link.
<p>
Alternativno, uključite opciju "%s" u izborniku "%s" i koristite ikonu izbornika.
<p>
Upravo ste se ulogirali!
_P;

$para['command::signup_verify'] = <<<_P
<p>
Za korištenje SiteBar funkcija potrebno je imati
ispravnu i proverenu e-mail adresu.
<p>
Ukoliko ste upisali ispravnu e-mail adresu, uskoro ćete
primiti e-mail. Molimo kliknite na link u toj e-mail poruci.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Svi kreirani accounti moraju biti odobreni od strane
administratora prije korištenja SiteBara.
<p>
Molimo pričekajte odobrenje administratora koje će vam
stići e-mailom.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Za korištenje SiteBar funkcija potrebno je imati
ispravnu i proverenu e-mail adresu i odobrenje administratora.
<p>
Ukoliko ste upisali ispravnu e-mail adresu, uskoro ćete
primiti e-mail. Molimo kliknite na link u toj e-mail poruci
i pričekajte odobrenje administratora koje će vam
stići e-mailom.
_P;

$para['command::account_approved'] = <<<_P
Administrator je odobrio vaš zahtjev za otvaranjem korisničkog računa.
Možete se ulogirati koristeći vaše korisničko ime %s.

--
SiteBar instalacija na %s.
_P;

$para['command::account_rejected'] = <<<_P
Administrator je odbio vaš zahtjev za otvaranje
korisničkog računa pod korisničkim imenom %s.

--
SiteBar instalacija na %s.
_P;

$para['command::account_deleted'] = <<<_P
Administrator je obrisao vaš neaktivni korisnički račun
pod korisničkim imenom %s.

--
SiteBar instalacija na %s.
_P;

$para['command::reset_password'] = <<<_P
Zatraženo je poništenje lozinke za SiteBar account s "%s" e-mail adresom.

U slučaju da i dalje želite poništiti lozinku za ovaj account, molimo kliknite
na sljedeći link:
    %s

--
SiteBar instalacija na %s.
_P;

$para['command::reset_password_hint'] = <<<_P
<p>
Upišite svoje korisničko ime ili registriranu e-mail adresu.
Na vašu registriranu e-mail adresu bit će poslan token pomoću kojega
možete resetirati vašu lozinku.
_P;

$para['command::contact'] = <<<_P
Poruka:

%s


--
SiteBar instalacija na %s.
_P;

$para['command::contact_group'] = <<<_P
Grupa: %s
Poruka:

%s


--
SiteBar instalacija na %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>Da li zaista želite obrisati svoj korisnički račun?</h3>
Više neće biti načina da se poništi ova izmjena!<p>
Sva vaša preostala stabla bit će dana administratoru sustava.<br><br>
_P;

$para['command::email_link_href'] = <<<_P
<p>Klikni <a href="mailto:?subject=Web site: %s&body=Možda će te zanimati ovaj web site.
Pogledaj: %s
--
Poslano preko SiteBar Bookmark Managera na %s
Više o SiteBaru http://sitebar.org
">ovdje</a> za slanje e-maila pomoću zadanog e-mail klijenta.
_P;

$para['command::email_link'] = <<<_P
Možda će te interesirati ovaj web site.
Pogledaj:

%s
%s

--
Poslano preko SiteBara na %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Hvala što ste koristili potvrdu e-mail adrese
koja vam omogućava korištenje e-mail opcija u SiteBaru.

Kliknite na sljedeći link kako biste potvrdili vašu e-mail adresu:

   %s

Molimo, zanemarite ovaj e-mail, ako niste inicirali potvrdu
e-mail adrese u SiteBar Bookmark Manageru.
_P;

$para['command::verify_email_must'] = <<<_P
Potvrda ispravnosti e-mail adrese potrebna je prije prvog korištenja SiteBara.

Kliknite na sljedeći link kako biste potvrdili ispravnost vaše e-mail adrese:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer može uvesti linkove u Netscape Bookmark File formatu preko "File/Import and Export ..." izbornika.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer može izvesti linkove u Netscape Bookmark File format preko "File/Import and Export ..." izbornika.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Konverzija kodne stranice nije instalirana na ovaj SiteBar server.
Podržane su samo UTF-8 i ISO-8859-1 kodne stranice.
<br>
_P;

$para['command::security_legend'] = <<<_P
<div align=left>
Prava:<br>
<strong>R</strong> Čitanje (read),<br>
<strong>A</strong> Dodavanje (add),<br>
<strong>M</strong> Mijenjanje (modify),<br>
<strong>G</strong> Odobravanje (grant)
</div>
_P;

$para['command::purge_cache'] = <<<_P
<h3>Da li zaista želite ukloniti sve favicone iz cachea?</h3>
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Omogućava korisnicima da sami sebe dodaju u ovu grupu.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Omogućuje izvoz linkova ili feedova od strane anonimnih korisnika.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Dozvoljava kontaktiranje administratora od strane anonimnih korisnika.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Dozvoljava korisnicima da mogu kontaktirati moderatore bez obzira što nisu korisnici njihove grupe.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Ako nije dozvoljeno, svi korisnici će koristiti tražilicu definiranu na ovoj stranici i neće je moći promijeniti.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Dozvoljava moderatorima da vas učlanjuju u njihove grupe.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Dozvoljava administratorima i moderatorima grupe kojoj pripadate da vam šalju info e-mailove.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Dozvoljava posjetiteljima pristup na formular za prijavu i ragistraciju na SiteBar.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Korisnicima je omogućeno kreirati grupe. U drugom slučaju samo administratori imaju ovu privilegiju.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Dozvoljava brisanje stabala kreiranih od strane korisnika.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Dozvoljava korisnicima kreiranje dodatnih stabala.
_P;

$para['command::tooltip_approved'] = <<<_P
Account je odobren i dozvoljeno je korištenje svih funkcija.
_P;

$para['command::tooltip_auto_close'] = <<<_P
U slučaju da je zadatak izvršen bez greške, status izvršenja zadaka se posebno ne prikazuje.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Automatsko dohvaćanje favicone u slučaju da nedostaje i prilikom dodavanja linka.
_P;

$para['command::tooltip_baseurl'] = <<<_P
URL na ovu instalaciju bez znaka / na kraju
_P;

$para['command::tooltip_cannot_leave'] = <<<_P
Korisnici ne mogu napustiti ovu grupu. Samo moderatori mogu poništiti članstvo.
_P;

$para['command::tooltip_cmd'] = <<<_P
Dodaje najvažnije SiteBar zadatke koji omogućuju laganu prijavu na SiteBar.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Prikazuje zadatke za uvoz i izvoz opisa linka.
_P;

$para['command::tooltip_comment_limit'] = <<<_P
Moguće je odrediti maksimalnu veličinu komentara linka. Također je moguće spremati manje datoteke kao komentare.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Prilikom sljedećeg korištenja ovog bookmarkleta, odabrani folder će biti automatski upisan.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Briše samo sadržaj foldera, ali ne i folder.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Briše adresu favicone, ako je favicona neispravna - upotrebljavati s oprezom.
_P;

$para['command::tooltip_demo'] = <<<_P
Account sa ograničenom funkcionalnošću i bez mogućnosti promjene lozinke.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Pokušava analizirati stranicu i pronaći favicone koje nedostaju.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Ukoliko je to moguće, root folder neće biti uključen.
_P;

$para['command::tooltip_expert_mode'] = <<<_P
Prikazuje napredne kontrole i više dijagnostičkih poruka.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Pokreće zadatke koristeći vanjski pop-up prozor - bez ponovnog učitavanja nakon svakog pokretanja zadatka.
_P;

$para['command::tooltip_filter_groups_limit'] = <<<_P
Nakon što broj grupa prijeđe ovaj limit uključuje se filter za pretraživanje grupa.
_P;

$para['command::tooltip_filter_users_limit'] = <<<_P
Nakon što broj korisnika prijeđe ovaj limit uključuje se filter za pretraživanje korisnika.
_P;

$para['command::tooltip_flat'] = <<<_P
Izvoz linkova kao da su svi u jednom folderu.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Sakriva opcije koje zahtijevaju rad s browserom koji podržava XSLT.
_P;

$para['command::tooltip_hits'] = <<<_P
Usmjeravanje svih klikova na linkove preko SiteBar servera tako da se može pratiti statistika posjeta.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Linkovi koji su nedavno bili testirani bit će isključeni iz provjere.
_P;

$para['command::tooltip_integrator_url'] = <<<_P
SiteBar, kao zadano, koristi integrator sa my.sitebar.org stranice, ali moguće je i korištenje lokalnog integratora zbog privatnosti.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Označava link kao aktivni, iako nije prošao provjeru.
_P;

$para['command::tooltip_is_feed'] = <<<_P
Označi link kao feed - Link će biti otvoren u čitaču feedova (ako je podešen) umjesto u browseru.
_P;

$para['command::tooltip_join_on_signup'] = <<<_P
Svaki novi korisnik postat će član ove grupe.
_P;

$para['command::tooltip_load_all_nodes'] = <<<_P
Učitavanje svih foldera; korisno za korisnike s manjim brojem linkova koji žele koristiti filter za pretraživanje.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Koliko dugo ikone ostaju u cacheu prije nego se osvježe s vanjskog servera.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
Ako je veličina privremenog spremnika (cachea) veća od ovdje upisane, najstarije ikone bit će izbačene iz sistema.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Upisati maksimalnu dozvoljenu veličinu ikona u byteima.
_P;

$para['command::tooltip_max_session_time'] = <<<_P
Administrator može odrediti maksimalno vrijeme sessiona. Nakon isteka tog vremena, korisnik se mora ponovno prijaviti.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Neki browseri ili operativni sustavi ne omogućavaju desni klik. Ovom opcijom, pokraj svakog foldera ili linka, prikazuje se ikona kojom se otvara kontektsni izbornik.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Pikazivanje foldera prije linkova ili obratno.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Ne provjeravaj ovaj link - koristi se kod intranet linkova ili linkova koji imaju problema sa provjerom.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Operacija se odnosi samo na sadržaj foldera, ne i na folder.
_P;

$para['command::tooltip_private'] = <<<_P
Privatne linkove drugi korisnici nikad ne mogu vidjeti, čak i ako se nalaze u objavljenom folderu.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Privatni linkovi će se učitavati samo u slučaju da je SiteBar korišten preko sigurne SSL konekcije.
_P;

$para['command::tooltip_rename'] = <<<_P
Preimenovanje linkova s istim nazivom prilikom uvoza.
_P;

$para['command::tooltip_respect'] = <<<_P
Slanje e-maila samo u slučaju da je to korisnik dozvolio.
_P;

$para['command::tooltip_search_engine_ico'] = <<<_P
Ikona za pretraživanje weba koja će se prikazivati u toolbaru SiteBara.
_P;

$para['command::tooltip_search_engine_url'] = <<<_P
URL tražilice koja će biti korištena za pretraživanje. Koristite %SEARCH% na mjestima gdje treba upisati tražene riječi.
_P;

$para['command::tooltip_sender_email'] = <<<_P
Mailovi generirani preko SiteBara bit će poslani s ovom adresom.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Posebno označavanje foldere sa sigurnosnim postavkama.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Prikazivanje loga na vrhu. Može se upotrebljavati za oglašavanje.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Prikaz nekih statistika u glavnom SiteBar prozoru.
_P;

$para['command::tooltip_subdir'] = <<<_P
Izvoz svih linkova i svih foldera.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Provjera foldera zajedno sa svim subfolderima.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Slanje e-maila samo na potvrđene adrese.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Kompresija se koristi samo ako je podržana od strane browsera.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Korištenje sustava za konverziju (obično ekstenzija za PHP) za konvertiranje stranica s različitim encodingom - važno za uvoz i izvoz linkova.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Favicone će biti downloadane sa servera u privremeni spremnik (cache) baze podataka.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Korištenje favicona uljepšava ali i usporava SiteBar. Puno brži rad omogućit će upotreba privremenog spremnika (cachea) za favicone.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Dozvoljava izvršavanje zadatka za sakrivanje foldera.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Uključuje korištenje PHP "mail" funkcije - omogućava korištenje e-mail opcija.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Neke funkcije zahtijevaju pristup vanjskim adresama s vašeg servera.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Omogućava redirekciju ili dopunjavanje internih rezultata pretrage rezultatima odabrane web tražilice.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Rezultati vaše web pretrage bit će prikazani u istom prozoru pomoću inline framea.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Korištenje SiteBar tooltipsa umjesto onih ugrađenih u browser. Omogućava duži tekst i podršku za više browsera.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Označavanje obrisanih foldera i linkova kako bi se mogli vratiti ili zauvijek očistiti.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Korisnici moraju biti odobreni od strane administratora prije korištenja SiteBara.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Korisnici moraju potvrditi svoje e-mail adrese prije korištenja SiteBara.
_P;

$para['command::tooltip_verified'] = <<<_P
Ako je označeno, e-mail adresa će se voditi kao potvrđena.
_P;

$para['command::tooltip_version_check_interval'] = <<<_P
SiteBar može redovno provjeravati dostupnost nove verzije. Ovo može biti važno u slučaju da se otkriju neke nestabilnosti i ranjivosti trenutne verzije.
_P;

$para['command::tooltip_web_search_user_agents'] = <<<_P
"Regular expression" za "User Agente" koji će koristiti specijalni "Writer" bez korištenja javascripta.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Ova SiteBar instalacija zahtijeva potvrđivanje e-mail adrese.
Molimo potvrdite svoj e-mail, inače će vaš račun biti obrisan.
_P;

$para['sitebar::tutorial'] = <<<_P
Ikona s vašim korisničkim imenom je vaš root folder.
Kliknite na njega desnim dugmetom i odaberite zadatak "%s"
kako biste dodali vaš prvi link.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Vaša e-mail adresa odgovara pravilima za automatsko pristupanje na
sljedeću grupu/grupe:
    %s.

Da bismo dozvolili vaše članstvo, vaša e-mail adresa mora
biti potvrđena. Kliknite na sljedeći link za potvrdu iste.
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Korisnik %s prijavio se na tvoju SiteBar instalaciju na %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Korisnik %s se prijavio na tvoju SiteBar instalaciju na %s.
Korisnik je već potvrdio svoju e-mail adresu.
_P;

$para['usermanager::signup_approval'] = <<<_P
Korisnik %s se prijavio na tvoju SiteBar instalaciju na %s.

Odobri account:
    %s

Odbij account:
    %s

Pogledaj korisnike na čekanju:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Korisnik %s se prijavio na tvoju SiteBar instalaciju na %s.
Korisnik je već potvrdio svoju e-mail adresu.

Odobri account:
    %s

Odbij account:
    %s

Pogledaj korisnike na čekanju:
    %s
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['messenger::cancel'] = <<<_P
Odustani
_P;

$para['messenger::delete'] = <<<_P
Obriši
_P;

$para['messenger::expire'] = <<<_P
Ističe
_P;

$para['messenger::read'] = <<<_P
Pročitano
_P;

$para['messenger::unread'] = <<<_P
Nepročitano
_P;

$para['messenger::save'] = <<<_P
Spremi
_P;

$para['messenger::seen'] = <<<_P
Pogledano
_P;

$para['messenger::deleted'] = <<<_P
Obrisano
_P;

$para['messenger::expired'] = <<<_P
Isteklo
_P;

$para['hook::statistics'] = <<<_P
<div style="padding: 5px;">
<b>Statistika:</b><br>
- Stabala: {roots_total}<br>
- Foldera: {nodes_shown} / {nodes_total}<br>
- Linkova: {links_shown} / {links_total}<br>
- Korisnika: {users}<br>
- Grupa: {groups}<br>
- SQL upita: {queries}<br>
- Vrijeme: {time_db}/{time_total} sek ({time_pct}%)
</div>
_P;

?>
