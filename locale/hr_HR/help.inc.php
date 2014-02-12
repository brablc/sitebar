<?php

$help = array();

$help['100'] = <<<_P
SiteBar funkcije dostupne su preko <strong>korisničkog izbornika</strong> i preko <strong>kontekstnih izbornika</strong> na folderima i linkovima. Korisnički izbornik je prikazan na dnu SiteBara, a kontekstni izbornici dostupni su klikom desnog dugmeta iznad foldera ili linka. Korisnici Opere ili Apple-a mogu alternativno koristiti Ctrl+klik. U slučaju da niti Ctrl+klik nije primjenjiv moguće je uključiti opciju "Prikazuj ikonu izbornika" koja je dostupna u "Korisničkim postavkama". Kad je ova opcija uključena, pokraj ikone foldera ili linka, bit će prikazana i mala ikona izbornika. Klikom na tu ikonu pojavljuje se kontektsni izbornik.
<p>
I kontektsni i korisnički izbornici mogu prikazivati drugačije skupove zadataka za razne korisnike, ovisno o njihovim pravima u sustavu. Neke opcije mogu biti nedostupne u kontektsnim izbornicima ovisno o korisničkim pravima ili o trenutnom načinu rada programa. Zadaci se izvršavaju u "upravljačkom prozoru".
_P;

$help['101'] = <<<_P
Kliknite na folder ili link i držeći dugme miša stisnuto odvucite ga na drugi folder. Odredišni folder bit će označen drugom bojom kada preko njega pređete mišem dok vučete željenji link ili folder. Pustite dugme miša kako biste spustili odvučeni folder ili link u trenutno označeni folder.
<p>
Drag & Drop nije implementiran od strane SiteBar tima za Opera browsere. Umjesto toga koristite opcije "Kopiraj" i "Zalijepi".
_P;

$help['103'] = <<<_P
<p><strong>Traži</strong> - Omogućava pretraživanje svih prikazanih linkova. Moguće je precizno odrediti što će se pretraživati koristeći prefikse <strong>url:</strong> (web adrese), <strong>name:</strong> (nazive), <strong>desc:</strong> (opise), <strong>all:</strong> (sve). Zadani prefiks je <strong>name:</strong> (naziv). Kada je pretraživanje uspješno, traženi link ili folder označen je posebnom bojom i pojavljuje se javascript prozor s još nekim detaljima. Korisnik ima mogućnost nastaviti s pretraživanjem ili ga zaustaviti.

<p><strong>Označi</strong> - Isto kao i "Traži", ali bez javascript upozorenja.

<p><strong>Zatvori/otvori stablo</strong> - Otvara ili zatvara sve foldere kako bi svi linkovi bili prikazani. Kada su folderi otvoreni ova opcija ih zatvara i obratno.

<p><strong>Osvježi s skrivenim folderima</strong> - Ponovo učitava sve linkove sa servera, uključujući i linkove u skrivenim folderima.

<p><strong>Osvježi</strong> - Osvježava stranicu i ponovno učitava sve linkove sa servera. Ova funkcija je ovdje zato što u sidebaru browsera obično nema ugrađene mogućnosti za osvježavanje (ovisno od browera).
_P;

$help['200'] = <<<_P
Zadaci su raspoređeni u nekoliko logičnih grupa. Za pomoć oko određenog zadatka odaberite jednu od grupa.
_P;

$help['210'] = <<<_P
<p><strong>Prijava</strong> - Prijavljuje korisnika na sustav. Upotrebom cookiea korisnik se može zapamtiti za sljedeći put kada otvori SiteBar. Korisnici mogu sami odrediti rok trajanja cookiea putem opcije "Zapamti me".

<p><strong>Odjava</strong> - Odjavljuje korisnika sa sustava. Ovu opciju trebali bi uvijek koristiti na javnim računalima. Alternativno, može se koristiti i opcija "Zapamti me - Dok ne zatvorim browser" i na kraju korištenja zatvoriti sve otvorene prozore browsera.

<p><strong>Postanite korisnik</strong> - Dozvoljava posjetitelju da se registira za korištenje sustava. Ovisno o e-mail adresi, korisnik se može kvalificirati za pristupanje nekim grupama. U ovom slučaju e-mail adresa mora biti potvrđena. Ovo se izvodi tako da novi korisnik, nakon što se prijavi na sustav, klikne na link "Potvrda e-mail adrese" i automatski će na njegovu e-mail adresu biti poslana poruka u kojoj se nalazi link za potvrdu. Nakon potvrde korisniku će biti dostupne i neke druge opcije. Administrator sustava može onemogućiti registriranje novih korisnika.
_P;

$help['220'] = <<<_P
<p><strong>Set Up</strong> - Prvi zadatak koji će administrator vidjeti nakon instaliranja SiteBara i podešavanja baze podataka. Kreirati će se administratorski korisnički račun i bit će podešene osnovne postavke SiteBara. Kada je uključen "Osobni način rada" bit će dostupne samo neke skupine funkcija.

<p><strong>SiteBar postavke</strong> - Administratori mogu naknadno mjenjati parametre SiteBara. Administratori su članovi administratorske grupe uključujući i korisnika kreiranog "Set Up" zadatkom. Pod temom "Prijava" možete pogledati objašnjenje korištenja e-mail opcija. U budućnosti se planira uvesti i više funkcija za rad s e-mailom.

<p><strong>Kreiraj novo stablo</strong> - Ovisno o SiteBar postavkama samo administratori i/ili korisnici s potvrđenim e-mail adresama mogu kreirati nova stabla foldera. Kada je novo stablo kreirano, ono se mora asocirati s postojećim korisnikom (samo administratori mogu kreirati stabla za nekog drugog). Standardni način za kreiranje timskih linkova je: napraviti novo stablo i povezati ga s korisnikom koji upravlja grupom (moderatorom) grupe, koji se postavlja prilikom kreiranja nove grupe pomoću zadatka "Kreiraj novu grupu". Ovaj korisnik onda može odobravati prava na novo-kreirano stablo grupi korisnika i dodavati članove u tu grupu.
_P;

$help['230'] = <<<_P
<p><strong>Korisničke postavke</strong> - Mijenja korisničke postavke. Kada je opcija "Vanjski upravljački prozor" isključena, upravljački prozor će se otvarati na mjestu SiteBara umjesto u vanjskom prozoru. Neki zadaci se uvijek otvaraju na mjestu SiteBara ("Prijava", "Odjava", "Postanite korisnik", "Korisničke postavke"). Kada je uključena opcija "Isključi poruke izvršavanja", uslijed uspješno izvedenog zadatka, neće se prikazivati konfirmacijska potvrda. Opcijom "Posebno označi ACL foldere" označavaju se folderi na koje su primjenjene sigurnosne postavke (obično kao <u><i>underline</i></u>). Ova opcija uzrokovat će sporije izvršavanje SiteBara.

<p><strong>Članstvo</strong> - Korisnici mogu napustiti bilo koju grupu ili pristupiti otvorenim grupama. Korisnici ne mogu napustiti grupu ako bi tada grupa ostala bez posljednjeg moderatora. U ovom slučaju potrebno je kontaktirati administratora kako bi obrisao grupu.

<p><strong>Potvrda e-mail adrese</strong> - Omogućava korisniku da potvrdi valjanost svoje e-mail adrese kako bi mu bile dostupne i druge sistemske funkcije.
_P;

$help['240'] = <<<_P
<p><strong>Uređivanje korisnika</strong> - Prikazuje padajući izbornik s korisnicima i omogućuje izvršavanje sljedećih zadataka.

<p><strong>Izmjeni postavke korisnika</strong> - Trenutno je jedini način za vraćanje izgubljene lozinke postaviti privremenu lozinku, poslati ju na e-mail adresu korisnika i zamoliti korisnika da ju što prije promjeni. Administratori mogu označiti korisnički račun kao demo, što onemogućava korisniku da mijenja neke postavke, pogotovo lozinku.

<p><strong>Obriši korisnika</strong> - Briše korisnika i sva njegova članstva. Vlasnik stabla foldera obrisanog korisnika postaje neki drugi korisnik. Ako je korisnik jedini moderator neke grupe nije ga dozvoljeno obrisati.

<p><strong>Kreiraj novog korisnika</strong> - Isto kao i "Postanite korisnik" ali namjenjeno administratorima. E-mail adrese ovako kreiranih korisnika tretiraju se kao potvrđene.
_P;

$help['250'] = <<<_P
<p><strong>Uređivanje grupa</strong> - Prikazuje padajući izbornik s grupama i omogućava izvršavanje sljedećih zadataka:

<p><strong>Postavke grupe</strong> - Dostupno moderatorima grupe. Dozvoljava mijenjanje naziva, komentara i oblika e-mail adresa za koje je osigurano automatsko učlanjivanje u grupu. Oblik e-mail adrese određuje se pomoću tzv. <i>regular expressions</i>. Kada je oblik e-mail adrese za automatsko pristupanje upisan i odgovara e-mail adresi korisnika koji se prijavljuje kao novi korisnik sustava, od njega se onda zahtijeva da potvrdi svoju e-mail adresu i nakon uspješne potvrde on automatski postaje član grupe. Kad je uključena opcija "Dozvoli samo-dodavanje", e-mail adresa ne treba biti potvrđena da bi se korisnik automatski učlanio u grupu.

<p><strong>Članovi grupe</strong> - Samo moderatori mogu odlučivati o članstvu korisnika. Drugi moderatori ne mogu biti ispisani iz grupe osim ako je prethodno uloga moderatora ukinuta sljedećim zadatkom:

<p><strong>Moderatori grupe</strong> - Dostupno moderatorima grupe. Svaka grupa mora imati najmanje jednog moderatora.

<p><strong>Obriši grupu</strong> - Dostupno samo administratorima, briše grupu i sva njena članstva.

<p><strong>Kreiraj novu grupu</strong> - Dostupno samo administratorima, kreira novu grupu i određuje prvog moderatora grupe.
_P;

$help['260'] = <<<_P
<p><strong>Dodaj folder</strong> - Dodaje novi sub folder u folder.

<p><strong>Dodaj link</strong> - Dodaje novi link u folder. Kada je ovaj zadatak pokrenut preko <i>linka za dodavanje stranice u SiteBar</i> korisnik ima mogućnost odabira odredišnog foldera, a kada je pokrenut preko kontektsnog izbornika foldera, link se kreira u folderu na koji je pozvan kontektsni izbornik.

<p>

<p><strong>Postavke foldera</strong> - Omogućuje izmjenu nekih postavki foldera - naziv i opis.

<p><strong>Obriši folder</strong> - Briše folder. Obrisani folderi mogu biti vraćeni pomoću zadatka "Vrati obrisano" ili dodavanjem foldera istog imena. Korisnik može obrisati i svoje stablo foldera s tim da u ovom slučaju obrisano stablo ostaje dostupno ali s zasivljenom ikonom sve dok se ne pozove zadatak "Počisti" kako bi se trajno uklonilo.

<p><strong>Počisti</strong> - Trajno uklanja obrisane foldere i linkove u odabranom folderu. Nakon ovog zadatka više nikako nije moguće vratiti obrisano.

<p><strong>Vrati obrisano</strong> - Vraća obrisane foldere ili linkove ukoliko nisu počišćeni. Kada je obrisano, stablo foldera prikazano je sivom ikonom i vidljivo je samo vlasniku stabla. Ovo također uklanja sva dana prava od drugih članova grupe, što znači drugačiji nivo sigurnosti koji bi trebao onemogućiti nehotično gubljenje linkova.

<p>

<p><strong>Kopiraj</strong> - Kopira folder i sav njegov sadržaj i interni međuspremnik.

<p><strong>Zalijepi</strong> - Dostupno samo kada je prethodno odabran zadatak "Kopiraj" ili "Kopiraj link". Ovim zadatkom folder se kopira ili premješta u odredišni folder s tim da se može odabrati želi li se kopirati ili premjestiti samo sadržaj foldera ili cijeli folder. Korisnik ima mogućnost odabira da li želi premjestiti folder ili samo kopirati.

<p>

<p><strong>Uvezi linkove</strong> - Uvozi linkove iz vanjske datoteke u folder. U ovom koraku valjanost linkova se ne provjerava da bi se izbjegli timeouti servera.

<p><strong>Izvezi linkove</strong> - Izvozi sadržaj foldera u vanjsku datoteku. Podržani su formati <i>Netscape bookmark file format</i> i <i>Opera Hotlist</i>. Mozilla browser i Internet Explorer koriste <i>Netscape bookmark file format</i>.

<p><strong>Provjeri linkove</strong> - Provjera ispravnosti svih linkova u folderima i subfolderima. Provjera ispravnosti linkova zahtijeva dostupnost outbound connection mogućnosti na serveru. Tijekom provjere linkova moguće je pronaći favicone ili obrisati favicone koje nikad nisu bile u privremenom spremniku favicona - cacheu (vjerojatno neispravne favicone). Pri pokretanju provjere otvara se stranica sa popisom testiranih linkova. Provjera se obavlja pronalaženjem i prikazivanjem ikone za svaki link. Kada favicona nije pronađena prikazuje se standardna ikona, a u slučaju neispravnog linka, prikazuje se ikona koja predstavlja neispravnu faviconu. Favicona će biti prikazana u slučaju da je link ispravan i da favicona postoji.
Postoji mogućnost da browser ne uspije završiti provjeru zbog velike količine linkova za provjeru. U ovom slučaju korisnik samo treba osvježiti stranicu; nedavno povjereni linkovi će biti ignorirani, a preostali provjereni. Neispravni linkovi će samo biti označeni kao neispravni, ali ne i obrisani. U Sitebaru oni će biti prikazani prekriženo.

<p><strong>Sigurnost</strong> - Dostupno samo na korijenskom folderu stabla. Omogućuje postavljanje prava korištenja za cijelo stablo. Pogledajte temu "Sigurnosni mehanizam" za više informacija.
_P;

$help['270'] = <<<_P
<p><strong>Pošalji link e-mailom</strong> - Omogućava slanje linka putem e-maila drugoj osobi. Korisnici s potvrđenim e-mail adresama mogu koristiti interni mail sustav, inače se mora pokrenuti vanjski program za slanje e-maila.

<p><strong>Kopiraj link</strong> - Kopira link u interni međuspremnik. Koristite zadatak "Zalijepi" na odabranom folderu kako bi se link kopirao ili premjestio u taj folder.

<p><strong>Obriši link</strong> - Briše link iz foldera. Obrisani linkovi mogu biti vraćeni korištenjem zadatka "Vrati obrisano" na folderu koji je sadržavao obrisani link.

<p><strong>Postavke</strong> - Mijenjanje postavki linka. Dozvoljava označavanje linka kao privatnog.
_P;

$help['300'] = <<<_P
SiteBar 3 kompletno je iznova napisan od 2.x serije predstavljajući daljnju evoluciju SiteBara.
<p>
SiteBar 3 više ne koristi JavaScript za prikazivanje stabala linkova.
JavaScript se i dalje dosta koristi za prikazivanje kontektsnih izbornika i za zatvaranje/otvaranje foldera uključujući i promjenu ikona.
<a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a> mora biti podržan od strane browsera. Prednost toga je vrlo brzo i postupno učitavanje linkova. Nedostatak je to što stariji browseri mogu prikazati samo otvoreno stablo linkova i imaju prava na linkove postavljena samo za čitanje (što je ipak napredak u odnosu na verzije 2.x kod kojih se linkovi nisu uopće prikazivali).
<p>
Na strani servera podaci su spremljeni na najjednostavniji način i prilagođeni za modifikacije stabla. To daje vrlo dobru brzinu za selektiranje. Zahvaljujući indeksima baze podataka selektiranje se ne bi trebalo usporiti čak i sa vrlo velikim brojem linkova.
_P;

$help['302'] = <<<_P
SiteBar 3 sve duplo provjerava kada je riječ o korisničkim pravima. Korisniku je omogućen samo određeni skup opcija ovisno o njegovima pravima i svaki zadani zadatak se potvrđuje po drugi put neposredno prije izvršavanja.
<p>
Sustav ima tri osnovna tipa korisnika: korisnike, moderatore i administratore. Moderatori su korisnici koji su prilikom kreiranja grupe ili od strane drugih moderatora označeni kao moderatori. Moderatorova uloga vezana je samo uz određenu grupu. Administratori su članovi grupe Administratori kao i prvi korisnik kreiran zadatkom "Set Up". Administratori nemaju prava da djeluju kao moderatori, ali zato mogu brisati kompletne grupe.
<p>
SiteBar 3 je zamišljen tako da upotpuni potrebe više raznih timova korisnika. To znači da grupa korisnika može međusobno dijeliti svoje linkove. Postoji također i pristupni mehanizam za označavanje timskih linkova kao strogo privatnih.
<p>
Kamen temeljac ovog mehanizma je to što vlasnik korjenskog foldera bilo kojeg stabla ima neograničena prava na kompletno stablo. Za svakog korisnika kreira se poseban korjenski folder kada se netko prijavi da postane novi korisnik ili kada korisnika kreira administrator. Administratori mogu kreirati i dodatna stabla za bilo kojeg korisnika ili mogu dozvoliti korisniku da sam kreira svoja stabla.
<p>
Kada je stablo kreirano, korisnik može postaviti prava na njegovo stablo drugim grupama korisnika. Sljedeća prava dostupna su za bilo koju grupu korisnika:

<p><strong>Read</strong> - (Čitanje) Dozvoljava korištenje linkova. Ako korisnik ne želi vidjeti te linkove, mora napustiti grupu.

<p><strong>Add</strong> - (Dodavanje) Dozvoljava dodavanje novih foldera i linkova.

<p><strong>Modify</strong> - (Mijenjanje) Dozvoljava definiranje postavki foldera i linkova.

<p><strong>Delete</strong> - (Brisanje) Dozvoljava brisanje linkova ili foldera.

<p><strong>Purge</strong> - (Čišćenje) Dozvoljava čišćenje prije obrisanih linkova ili foldera, a ako je zajedno s "Delete" omogućava premještanje foldera iz jednog stabla u drugo.

<p><strong>Grant</strong> - (Odobravanje) Članovi grupe imaju jednaka prava na stablo kao i njegov vlasnik.

<p>
Korjenski folder, po zadanom, nema definirana nikakva prava za nijednu grupu. Korisnik može za neki folder postaviti ograničavajući pristup što utječe i na sub foldere. Ako se postave korisnička prava za neki folder koja su ista kao i za njegov matični folder, postavljena prava na taj folder se uklanjaju i koriste se prava matičnog foldera.
<p>
Moderatori grupe imaju prava ukloniti bilo koja prava postavljena za njihovu grupu od strane bilo kojeg korisnika.
<p>
Kao dodatak sigurnosnom mehanizmu postoji i rješenje za linkove koje omogućuje označavanje  linkova kao privatnih u inače objavljenom folderu. Vlasnik stabla može označiti bilo koji link kao privatni što onemogućuje linku da bude prikazan drugim korisnicima. Isto tako onemogućuje drugim korisnicima bilo kakve postupke na tom linku. Ukoliko folder s linkom nije objavljen ili nisu mijenjanje nikakve druge sigurnosne postavke od onih zadanih, uopće nije potrebno označavati linkove kao privatne jer ih drugi korisnici u ovom slučaju neće vidjeti.
<p>
Što je veći broj foldera s primjenjenim sigurnosnim postavkama, duže će trajati učitavanje linkova svim korisnicima. Preporuka je da se sigurnosne postavke ne upotrebljavaju previše na folderima koji su zakopani duboko u stablo, pošto postavke matičnog foldera također određuju i postavke svih podređenih foldera.
<p>
SiteBar administrator može uključiti opciju "Osobni način rada" u kom slučaju sigurnosne postavke nisu omogućene. Umjesto toga koristi se opcija "Objavi folder" u zadatku "Postavke foldera". U ovom načinu rada nije moguće ograničiti prava na podređeni folder ako je matični folder već objavljen.

Moguće je slobodno uključivati i isključivati osobni način rada, ali nije moguće u osobnom načinu rada ukloniti prava koja su dana u timskom načinu rada za bilo koju grupu korisnika osim grupe "Svi".
_P;

$help['303'] = <<<_P
SiteBar omogućuje korisnicima da sami kreiraju izgled (upotrebom tzv. <i>skinova</i>). Za izradu novog izgleda potrebno je vrlo dobro poznavanje CSS-a. Prilikom kreiranja novog izgleda potrebno je kao bazu uzeti već postojeći <i>skin</i> odnosno uzeti bilo koji <i>skin</i> iz "skins" foldera i napraviti njegovu kopiju. Svaki se <i>skin</i> sastoji od nekoliko slika (upotrebljavan je PNG format zbog nadolazećih promjena vezanih uz prava na GIF format u Europi 2004.), jedna CSS datoteka nazvana "sitebar.css" i PHP datoteka s dodacima nazvana "hooks.php". U "hooks.php" datoteci moguće je promijeniti zaglavlje i podnožje SiteBara.
<p>
Pojedini administratori bi zasigurno htjeli kreirati novi izgled koji se podudara s izgledom njihovih web stranica. U ovom slučaju preporučuje se maknuti sve ostale <i>skinove</i> i izabrati kreirani <i>skin</i> kao zadani <i>skin</i> u SiteBar postavkama. Ako želite da vaš <i>skin</i> bude uključen u standardnu SiteBar distribuciju potrebno je kontaktirati razvojni tim i testirati <i>skin</i> s instaliranom najnovijom stabilnom razvojnom verzijom SiteBara. Kao pravilo na stranici moraju postojati SiteBar i SourceForge logo s tim da se izgled SiteBar loga može slobodno mjenjati.
_P;

$help['304'] = <<<_P
SiteBar koristi nekoliko <i>writera</i>, kojima se određuje prikaz SiteBara u raznim oblicima. Glavni SiteBar izgled je također proizvod <i>writera</i>.
<p>
Svi <i>writeri</i> potječu iz <strong>SB_WriterInterface</strong> klase u
<strong>inc/writer.inc.php</strong> datoteci i nalaze se u <strong>inc/writers</strong> subfolderu.
Kako bi se proizveo određeni oblik prikaza SiteBara, potrebno je promijeniti samo nekoliko metoda. Također je moguće iskoristiti jedan od postojećih <i>writera</i> i bazirati novi <i>writer</i> po njemu (kao i mnogi SiteBar <i>writeri</i> koji su bazirani na XBEL formatu).
_P;

$help['305'] = <<<_P
Kako biste preselili postojeću SiteBar instalaciju na drugi server potrebno je da

<ul>
    <li>Izvezete sitebar_* tablice iz baze podataka u .SQL file.
    <li>Uvezete tu datoteku u bazu podataka na novom serveru.
    <li>Prebacite postojeću instalaciju SiteBara na novi server
        ili instalirate bilo koju stabilnu SiteBar verziju
        (downgrade ili upgrade baze podataka se obavlja automatski).
    <li>Obrišete ili uredite inc/config.inc.php datoteku u slučaju da su
        postavke pristupa bazi podataka promjenjene.
</ul>

<p>
Izvoz i uvoz baze podataka moguće je obaviti koristeći <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a>.
Tablice sitebar_favicon (do verzije 3.2.6) i sitebar_cache (od verzije 3.3) nije potrebno prebacivati, njihov sadržaj će automatski biti obnovljen.

_P;

?>
