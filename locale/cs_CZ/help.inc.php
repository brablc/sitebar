<?php

$help['100'] = <<<_P
Funkce programu SiteBar jsou dostupné z <strong>uživatelské nabídky</strong> a z
<strong>místních nabídek</strong> jednotlivých složek a odkazů. Uživatelská nabídka je vždy
zobrazena ve spodní části okna programu SiteBar. Místní nabídky složek a odkazů lze zobrazit klepnutím pravým tlačítkem myši na danou složku nebo odkaz. Uživatelé
prohlížečů Opera nebo prohlížečů pro počítače Apple mohou použít klepnutí levým tlačítkem společně se stisknutou klávesou Ctrl. V případě, že ani tato možnost není prohlížečem
podporována, lze v nabídce <strong>Nastavení</strong> zaškrtnout políčko „Zobrazit ikonu nabídky“.
Tato ikona je zobrazena vedle ikony složky nebo odkazu a místní nabídka se zobrazí po klepnutí na tuto ikonu.
<p>
Místní nabídky i uživatelské nabídky mohou zobrazovat rozdílné podmnožiny příkazů
pro různé uživatele v závislosti na jejich právech v systému. V závislosti na přístupových právech uživatele k jednotlivým složkám a na aktuálním režimu nebo stavu programu mohou být některé položky
v místní nabídce znepřístupněny. Příkazy jsou prováděny prostřednictvím příkazového okna.
_P;

$help['101'] = <<<_P
Chcete-li přesunout složku nebo odkaz, klepněte na ně a přetáhněte je myší. Během přetahování držte stisknuté tlačítko myši. Tažení je signalizováno zvýrazněním cílové složky. Uvolněním tlačítka myši umístíte přesouvaný odkaz nebo složku do aktuálně zvýrazněné složky.
<p>
Funkce přetahování myší není vývojovým týmem programu SiteBar implementována v prohlížečích Opera. Místo toho je nutno použít funkce Kopírovat a Vložit.
_P;

$help['103'] = <<<_P
<p><strong>Hledat</strong> - stejná funkce jako hledání, avšak zpracovaná na straně serveru a zobrazená v jiné podobě.

<p><strong>Hledat na webu</strong> - zobrazí se, pokud je povoleno a nastaveno hledání na webu.

<p><strong>Sbalit nebo rozbalit vše</strong> - sbalí všechny složky. Při dalším klepnutí
(a pokud jsou všechny složky sbalené) se rozbalí všechny složky.

<p><strong>Načíst znovu se skrytými složkami</strong> - načte znovu všechny odkazy ze serveru, včetně
složek skrytých příkazem „Skrýt složku“.

<p><strong>Načíst znovu</strong> - načte znovu všechny odkazy ze serveru. Tato funkce
je použita proto, že doplněk je umístěn na bočním panelu, takže uživatel nemusí mít možnost jej obnovit (v některých prohlížečích).
_P;

$help['200'] = <<<_P
Příkazy jsou sdruženy do několika logických skupin. Výběrem skupiny lze zobrazit nápovědu
k příslušným příkazům.
_P;

$help['210'] = <<<_P
<p><strong>Přihlásit</strong> - přihlásí uživatele do systému. Přihlášení uživatel je
zaznamenáno pomocí Cookies. Uživatel může při přihlášení specifikovat kdy tato Cookie
vyprší.

<p><strong>Odhlásit</strong> - odhlásí uživatele ze serveru. Tento příkaz by měl být
použit vždy, když je SiteBar používán na veřejných terminálech. Ekvivalentem je
použití přihlášení se zapamatováním dokud je prohlížeč otevřen a potom zavřít všechna
okna použitého prohlížeče.

<p><strong>Založit účet</strong> - umožňuje návštěvníkům stránek založit si vlastní
účet v systému. Na základě e-mailové adresy, která slouží jako uživatelské jméno, je
možné nastavit, aby byl uživatel automaticky zařazen mezi členy nějaké skupiny.
Aby k tomu mohlo dojít, je nezbytné, aby uživatel ověřil svoji e-mailovou adresu.
E-mail s vyžádáním ověření je odesílán automaticky. Administrátor může zakázat
uživatelům vytváření účtů nebo může vyžadovat ověření emailu před použitím SiteBaru či manuální schválení vytvořeného účtu.
_P;

$help['220'] = <<<_P
<p><strong>Set Up</strong> - první příkaz, který administrátor spatří po instalaci
SiteBaru a po úspěšném nastavení parametrů databázového připojení. Dovoluje
nastavit základní parametry dané instance SiteBar serveru. Zvolení "Personal Mode"
volby provede restrikci na některé funkce vhodné pro víceuživatelský přístup.

<p><strong>SiteBar nastavení</strong> - umožnuje administrátorovi změnit
nastavení základních parametrů. Adminstrátory jsou členi Admins skupiny
a uživatel vytvoření příkazem "Set Up". Příklad e-mailových funkcí je demonstrován
v příkazu "Založit účet". Více vlastností spojených s e-mailem je plánováno do
budoucna.

<p><strong>Vytvořit strom</strong> - v závislosti na nastavení SiteBaru pouze
administrátoři nebo uživatelé s ověřenou adresou mohou vytvářet další stromy.
Každý nově vytvořený strom mysí být spojen s existujícím účtem (pouze administrátor
může vytvořit strom pro jiného uživatele).
Standardní způsob vytváření týmových odkazů je vytvoření nového stromu a jeho přiřazení
uživateli který je moderátorem dané skupiny (vytvořené pomocí příkazu Správa skupin/Vytvořit
skupinu. Tento uživatel potom může garantovat práva na nově vytvořený strom členům dané skupiny
a může přidávat uživatele do své skupiny.
_P;

$help['230'] = <<<_P
<p><strong>Nastavení</strong> - umožňuje změnit uživatelská nastavení.

Pokud není zašjrtnuta volba "Externí příkazové okno", bude se příkazové okno otevírat
na místě SiteBar okna místo toho, aby se otevíralo v novém okně. Některé příkazy se vždy
zobrazují na místě SiteBaru ("Přihlásit", "Odhlásit",  "Založit účet", "Nastavení").
Pokud je zaškrtnuta volba "Ignorovat zprávy o vykonání" nebude se po úspěšném vykonání
příkazů zobrazovat potvrzovací obrazovka. "Označit zabezpečené složky" označuje graficky
to složky, které mají upraveno zabezpečení sdílení. Zaškrtnutí této volby zpomaluje
načítáné SiteBaru.

<p><strong>Členství ve skupinách</strong> - uživatelé mohou opustit libovolnou
skupinu a připojit se k otevřeným skupinám. Uživatelé nemohou opustit skupinu pouze
tehdy, pokud jsou posledním moderátorem ve skupině. V tomto případě musí kontaktovat
administrátora, který má právo skupinu vymazat.

<p><strong>Ověřit E-mail</strong> - umožňuje uživateli verifikovat svou e-mailovou
adresu, což umožňuje využití některých funkcí systému.
_P;

$help['240'] = <<<_P
<p><strong>Správa uživatelů</strong> - zobrazí seznam s uživateli a umužňuje
provádět následující operace s vybraným uživatelem:

<p><strong>Upravit uživatele</strong> - v současné době jediná možnost jak
vyřešit problém zapomenutého hesla je nastavit nové dočasné heslo a zaslat
jej e-mailem uživateli s žádostí o jeho urychlenou změnu. Administrátor může
označit účet jako demo účet. Tato volba znemožní uživateli změnu některých vlastností
(zejména hesla).

<p><strong>Smazat uživatele</strong> - smaže uživatele a zruší všechna jeho členství
ve skupinách. Při vymazání uživatele je nutné přiřadit všechny jeho stromy jinému uživateli.
Není dovoleno smazat uživatele, který je jediným moderátorem některé ze skupin.

<p><strong>Vytvořit uživatele</strong> - stejná funkce jako "Založit účet", je ovšem
určená pro použití administrátorem.
_P;

$help['250'] = <<<_P
<p><strong>Správa skupin</strong> - zobrazí seznam skupin k nimž má dotyčný uživatel
právo administrátora či moderátora a umožní mu provést některou z následujících
funkcí:

<p><strong>Vlastnosti skupiny</strong> - dostupné moderátorům skupiny.
Umožňuje změnit název skupiny a nastavení pro automatické získání členství na
základě e-mailové adresy. Pokud je "Regulární výraz pro automatické členství na
základě e-mailové adresy" vyplněn a nový uživatel vytvoří své konto, s uživatelským
jménem, které splňuje daný regulátní výraz, získá po ověření e-mailu automaticky
členství v dané skupině. Pokud je zaškrtnuta volba "Povolit osobní přihlášení",
může získat členství ve skupině každý uživatel.

<p><strong>Členové skupiny</strong> - pouze moderátoři mohou určovat členy skupiny.
Není možné odstranit ze skupiny její moderátory. Nejdříve je nutné zrušit jejich
moderátorství pomocí nasledujícího příkazu.

<p><strong>Moderátoři skupiny</strong> - přistupné pro moderátory dané skupiny.
Ve skupině musí vždy zůstat alespoň jeden moderátor.

<p><strong>Smazat skupinu</strong> - skupina může být smazána pouze administrátorem.

<p><strong>Vytvořit skupinu</strong> - přístupné pouze pro administrátory. Umožňuje
vytvořit skupinu a specifikovat jejího moderátora.
_P;

$help['260'] = <<<_P
<p><strong>Přidat složku</strong> - přidání podsložky do jiné složky.

<p><strong>Přidat odkaz</strong> - přidání odkazu do jiné složky. Při vyvolání z
bookmarkletu umožňuje uživateli vybrat cílovou složku. V opačném případě je
odkaz vytvořen ve složce pro kterou byl příkaz vyvolán.

<p><strong>Procházet složku</strong> - zobrazí složku v adresářovém módu. Pouze obsah jedné složky je zobrazen, detaily odkazů jsou zobrazeny. 

<p><strong>Zobraz všechny odkazy</strong> - zobrazí odkazy, jako kdyby byly z jedé složky. 

<p><strong>Novinky o odkazech</strong> - zobrazí novinky o odkazech ve složce a podsložkách.

<p>
<p><strong>Skrýt složku</strong> - skryje složku, používá se pro skrytí publikovaných složek, o které nemá uživatel zájem. Kliknutím na ikony obnovit s + znaménkem dojde k natažení i skrytých odkazů. Skryté složky lze obnovit pomoci příkazu Odhalit podsložky. Skryté stromy lze obnovit pomocí Správa stromů -> Odhalit stromy.

<p><strong>Odhalit podsložky</strong> - odhalí trvale skryté podložky.

<p><strong>Vlastnosti složky</strong> - umožňuje nastavit vlastnosti složky -
název a popis.

<p><strong>Smazat složku</strong> - smaže složku. Smazaná složka může být obnovena
pomocí příkazu "Obnovit smazané" nebo permanetně smazaná pomocí příkazu "Vysypat
smazané". Uživatel může smazat i svůj strom, toto smazaní je pouze platné pokud dojde
následně i k vysypání. Smazaný strom může být obnoven či vysypán pouze svým vlastníkem.

<p><strong>Vysypat smazané</strong> - odstraní navždy složky a odkazy, které byly
předtím smazané. Po vysypání není technicky možné obnovit vysypané odkazy či
složky!

<p><strong>Obnovit smazané</strong> - umožňuje obnovit vymazané složky či odkazy
a to až dokamžiku jejich vysypání. Smazaná kořenová složka je normálně zobrazena
ikonou s odstíny šedi a je viditelná pouze vlastníkovi stromu. Tímto je vlastníkovi
stromu (a pouze jemu) garantována možnost strom obnovit a tím předejít nechtěnému
smazání odkazů.

<p>

<p><strong>Kopírovat</strong> - zkopíruje složku a její obsah do interní schránky.

<p><strong>Vložit</strong> - je dostupné pouze pokud byl předtím vykonán příkaz
"Kopírovat" či kopírovat odkaz. Příkaz "Vložit" rozpozná zda může uživateli povolit
přesunutí, či pouze kopírování zdrojové složky. Uživatel má ovšem v každém případě
možnost zvolit kopírování.

<p>

<p><strong>Importovat odkazy</strong> - importuje odkazy z externího souboru do
zvolené složky. Během importu se neprovádí žádná validace odkazů aby nedošlo
v žádném případě k timeoutu na straně serveru.

<p><strong>Exportovat odkazy</strong> - exportuje odkaz složky do externího souboru.
Podporované formáty jsou Netscape bookmark file + Opera Hotlist. Prohlížeče
Mozilla používají formát stejný jako Netscape. Internet Explorer má možnost
exportu a importu do a z tohoto formátu.

<p><strong>Ověřit odkazy</strong> - ověžuje odkazy ve složce a podsložkách.
Během validace je možné zjistit chybějící ikony odkazů či smazat ty ikony,
které se nenacházejí v mezipaměti ikon a jsou tudíž považované za neplatné.
Zobrazení výsledků testování je prostřednictvím ikon u odkazů. Standarní ikona
odkazu se zobrazí, pokud žádná speciální ikona odkazu není nalezena ale link je funkční.
V případě neplatného odkazu se zobrazí ikona špatného odkazu v ostatních případech
ikona odkazu dané stránky. V případě validace velkého množství odkazů může dojít
k tomu, že nedojde k jejich úplné validaci. V tomto případě by uživatel měl jednoduše
obnovit stránku nebo validaci opakovat. Nedávno otestované odkazy již nebudou testovány.
Odkazy považované za neplatné budou zobrazeny v SiteBaru přeškrtnutě.
<p><strong>Zabezpečení</strong> - dostupné pouze pro složky. Umožňuje specifikovat
přístupová práva k celému stromu či jednotlivým jeho podsložkám. Více informací lze
nalézt v sekci "Bezpečnostní Mechanismus".
_P;

$help['270'] = <<<_P
<p><strong>Poslat odkaz</strong> - umožňuje odeslat odkaz e-mailem jinému uživateli.
Uživatelé s ověřenou e-mailovou adresou mohou používat interní mail systém. Ostatní
uživatelé musí použít externí program pro elektronickou poštu.

<p><strong>Kopírovat odkaz</strong> - zkopíruje odkaz do interní schránky.
Pro zkopírovaní či pšesun je nutné použít příkaz "Vložit" na vybrané cílové složce.

<p><strong>Smazat odkaz</strong> - smaže odkaz ze složky. Smazaný odkaz může být
obnoven příkazem "Obnovit smazané".

<p><strong>Vlastnosti</strong> - umožňuje nastavit vlastnosti odkazu. Především
umožňuje označit odkaz jako privátní, takovýto odkaz je pro ostatní uživatele
neviditelný i ve zveřejněné složce.
_P;

$help['300'] = <<<_P
SiteBar 3 je kompletním přepsáním řady 2.x series, čímž reprezentuje další skok
ve vývoji SiteBaru.
<p>
Na rozdíl od řady 2.x nepoužívá SiteBar 3 pro zobrazení stromu odkazů JavaScript.
JavaScript je nicméně nezbytnou součástí pro zobrazování a skrývání složek včetně
změn ikon. Pro plnou funkčnost musí použitý prohlížeč podporovat
<a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a>.
Výhodou tohoto postupu je velmi rychlé a inkrementální načítání odkazů. Nevýhodou
je, že uživatelé nekomatibilních prohlížečů mají přístup k odkazům pouze na čtení
(což je nicméně stále více než uměla řada 2.x).
<p>
Na serveru jsou data uložena v jednoduché rekurzivní datové struktuře, který je
optimalizovaná pro modifikace. Poskytuje ovšem velmi dobré výsledky pro zobrazování.
Díky použitým indexům by čtení dat nemělo být zpomaleno ani velkým množstvým
zobrazených dat.
_P;

$help['302'] = <<<_P
SiteBar 3 provádí dvojí jištění v otázce uživatelských práv. Každý uživatel vidí
pouze podmnožinu příkazů, které může vzhledem ke svým právům používat. Každý
příkaz je při odeslání ještě jednou zkontrolován a to v okamžiku těsně před
jeho vykonáním.
<p>
Systém disponuje třemi základními rolemi uživatelů: řadový uživatel, moderátor a
administrátor. Moderátoři jsou uživatelů jimž byla svěřena správa skupiny pří jejich
vytvoření administrátorem nebo jimž bylo toto právo uděleno jiným moderátorem.
Role moderátora je svázána vždy pouze s určitou skupinou. Administrátoři jsou
členové skupiny Admin včetně uživatele založeného při vykonání příkazu "Set Up".
Administrátoři nemají právo jednat jako moderátoři. Maji ovšem právo, celou skupinu
smazat.
<p>
SiteBar 3 byl vyvinutr s cílem umožni sdílení odkazů pro více týmů. To znemaná, že
více uživatelů může sdílet mezi sebou odkazy. Pro zajištění úschovy ciltivých
týmových odkazů byl vyvinut bezpočností mechanismus,
<p>
Základní kamenem tohoto mechanismu je fakt, že vlastník kořenové složky kterékoholiv
stromu odkazů má ke všem podřízeným odkazům neomezená práva. Při vytvoření účtu
je pro každého uživatele vytvořena kořenová složka. Administrátor může dodatečně
vytvořit nový strom, či povolit uživatelům vytvářet další vlastní stromy.
<p>
Pro každý strom, jehož je uživatel vlastníkem, může specifikovat jaká práva
mají jednotlivé skupiny ke složkám tohoto stromu:

<p><strong>Číst</strong> - právo na čtení odkazů, pokud nechce uživatel skupiny
tyto odkazy číst, může opustit skupinu.

<p><strong>Přidat</strong> - umožňuje přidat složku či odkaz.

<p><strong>Změnit</strong> - změna vlastností složky či odkazu.

<p><strong>Smazat</strong> - smazání složky či odkazu.

<p><strong>Vysypat</strong> - právo vysypání smazaných odkazů či složek. Spolu s právem
k mazání umožňuje přesun složky do jiného stromu jiného uživatele.

<p><strong>Garantovat</strong> - toto právo umožňuje jeho držiteli specifikovat
práva stejně jako může vlastník stromu.

<p>
Práva jsou vždy zděděná od rodičovské složky. Kořenová složka nemá defaultně
nastavena žádná práva. Uživatel může specifikovat restrikci práv, která je platná
na pro podřízené složky. Pokud jsou právo pro složku stejná jako pro nadřízenou
složku, je tato definice vymazána a požadovaného efektu je dosaženo děděním.
<p>
Moderátor skupiny má vždy právo zkušit jakékoliv právo garantované jeho skupině.
<p>
Dodatečně ke bezpečnostímu mechanismu složek existuje i řešení pro odkazy, které
umožňuje uchovávat privátní odkazy v jinak zveřejněným složkám. Vlastník stromu
odkazů může označit odkaz jako soukromý čímý zmenožní jeho zobrazení a zpracování
jakýmkoliv jiným uživatele. Nezní nezbytně nutné označovat všechny odkazy jako
soukromé pokud není složka sdílená - výchozí nastavení je, že žádná složka není
sdílená.
<p>
Čím vyšší je počet složek s definovanými právy, tím pomalejší je jejich načítání
pro všechny uživatele. Zabezpečení složek by nemělo být používáno z tohoto
důvodu zejmená na hluboko zanořených stromech odkazů.
<p>
Pokud administrátor SiteBaru zvolí "Osobní mód" není příkaz "Zabezpečení"
dostupný. Místo něho se ve vlastnostech složky zobrazí volba "Zvěřejnit složku".
Jejím zaškrtnutím dojde ke zveřejnění složky pro všechny uživatele. V osobním
módu není možné zrušít sdílení podřízené složky, který je sdílená přes složku
rodičovskou. Je možné přepínat bez problému mezi osobní a skupinovým módem,
nicméně není možné v osobním módu odstranit práva pro jinou skupiny než "Everyone".
_P;

$help['303'] = <<<_P
SiteBar umožňuje tvorbu uživatelských témat. Pro jejich tvorbu je nutná dobrá
znalost CSS a pro plnou úupravu je potžebná znalost XSLT. 
Pro tvorbu nového tématu je doporučené zkopírovat existující
a postupně jej upravovat. Zkopírování se provádí kopií vybraného téma v adresáři
"skins". Každé téma se skládá z 
<ul>
<li>Několika obrázků (obrázky lze změnit pouze formát PNG musí být zachován).
<li>Hook soubor "hook.inc.php", používá se pro zjištění některých informací o skinu (například autor).
<li>Obecný style sheet "common.css" obsahující definici barev skinu sdílenou ostatními style sheety.
<li>Style sheet pro SiteBar panel "sitebar.css"
<li>Pro XSLT založené generátory výstupu jsou zde stylesheety pro zobrazení novinek o odkazech "news.css", 
pro procházení složky "directory.css" a pro backednové vyhledávání "search.css". 
</ul> 

<strong>XSL</strong> - pomocí XSLT je možné úplně změnit prezentaci výstupů založených na XML pomocí vlastního XSL stylesheetu. V tomto případě je nutné zkopírovat jeden ze souborů skins/*.xsl.php do složky skinu a změnit jej.
<p> 

<strong>Splývání</strong> - with exception of the common stylesheets all other stylesheets are created as a superset of the common stylesheet and corresponding common stylesheet from the skins directory. Skin author may redefine default values here. 

<p> 
<strong>Branding</strong> - pokud je potřeba z designového hlediska použít právě jeden skin, je doporučené odstranit všechny ostatní složky ze skins složky a změnit dfaultní nastavení skinu v "SiteBar nastavení". 

<p>
Vytvořená témata je možné poslat autorům SiteBaru pro posouzení. Předtím je ovšem
nutné téma vyladit v poslední stabilní vývojové verzi. Zdařilá téma budou
začleněna do distribuce a budou automaticky upravena vývojovým týmem v případě
nutných technických změn v dalších verzích. Podmínka pro distribuci dalších verzí
je přítomnost loga SiteBar. Logo SiteBar může být zobrazeno libovolným
způsobem.
_P;

$help['304'] = <<<_P
SiteBar používá framework generátorů výstupu (writers), které jsou používané pro generévýní obsahu SiteBaru v různých podobách. I hlavní SiteBar panel je produktem writeru.

<p>
Všechny writery jsou potomnky třídy <strong>SB_WriterInterface</strong> se souboru <strong>inc/writer.inc.php</strong> a jsou umístěny do složky <strong>inc/writers</strong>. Pokud chcete vygenerovat SiteBar odkazy v jiném formátu tak je možné využít existující writer a pouze předefinovat některé metody (stejným způsobem jsou vytvořené SiteBar writery založené na XBEL formátu).
_P;

$help['305'] = <<<_P
Pokud hodláte přestěhovat SiteBar na jiný server tak musíte:

<ul>
    <li>Vyexportovat sitebar_* tabulky ze staré databáze do .SQL souboru.
    <li>Naimportujte tento soubor do cílové databáze.
    <li>Přesuňte nebo znovu nainstalujte software (případný downgrade nebo upgrade se provede automaticky).
    <li>Smažte nebo upravte soubor inc/config.inc.php v případě, že se detaily databázového připojení změnily.
</ul>

<p>
Export a import databáze může být proveden pomocí <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a> softwaru. Tabulka sitebar_favicon (do verze 3.2.6) nebo sitebar_cache (od verze 3.3) nemusí být přenesena - její obsah bude obnoven.
_P;

?>
