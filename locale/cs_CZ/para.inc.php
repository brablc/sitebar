<?php

$para = array();

$para['integrator::welcome'] = <<<_SBHD
Vítá vás integrační stránka serveru SiteBar. Tato stránka vám pomůže co nejlépe využít všechny možnosti panelu SiteBar. Další informace o funkcích panelu SiteBar naleznete na <a href="http://sitebar.org/">domovské stránce programu SiteBar</a>.
_SBHD;

$para['integrator::header'] = <<<_SBHD
Panel SiteBar je vyvíjen v souladu se standardy a měl by fungovat s většinou prohlížečů, ve kterých je nastaveno používání skriptů Java a souborů cookie. Následující tabulka uvádí prohlížeče, se kterými byl panel testován.
_SBHD;

$para['integrator::usage_opera'] = <<<_SBHD
K zobrazení místních nabídek pro záložky a složky se v programu SiteBar využívá klepnutí pravým tlačítkem myši. Uživatelé prohlížeče Opera musí nejprve v nabídce „Nastavení“ zaškrtnout políčko „Zobrazit ikonu nabídky“. K otevření nabídky pak použijí klepnutí levým tlačíkem myši na ikonu vedle ikony záložky nebo složky. Fungovat může také klepnutí levým tlačítkem na popisek vedle ikony složky nebo záložky.
_SBHD;

$para['integrator::hint'] = <<<_SBHD
Klepnutím na název zvoleného prohlížeče zobrazíte pokyny pro integraci panelu SiteBar do daného prohlížeče. Prosíme uživatele o <a href="http://brablc.com/mailto?o">nahlášení</a> dalších ověřených prohlížečů nebo platforem.
_SBHD;

$para['integrator::hint_window'] = <<<_SBHD
Toto je bežný odkaz, který otevře panel SiteBar v aktuálním okně. Protože je však panel SiteBar navržen pro zobrazení v úzkém svislém pruhu, je tento způsob integrace nevhodný z hlediska využití místa.
_SBHD;

$para['integrator::hint_dir'] = <<<_SBHD
Kromě možnosti zobrazení v podobě stromu se panel SiteBar může zobrazit jako běžný adresář. Tento způsob zobrazení ukazuje v jednom okamžiku pouze jeden adresář s podrobnostmi o zobrazených záložkách. Tento způsob integrace vyžaduje, aby prohlížeč podporoval funkce <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_SBHD;

$para['integrator::hint_popup'] = <<<_SBHD
Pokud prohlížeč nepodporuje funkci postranního panelu, můžete použít bookmarklet*. Ten otevře panel SiteBar v novém místním okně podobném postrannímu panelu. Věnujte pozornost tomu, že prohlížeč může blokovat místní okna.
_SBHD;

$para['integrator::hint_iframe'] = <<<_SBHD
Odkaz vlevo umožňuje integrovat panel SiteBar jako vložený rámec <IFRAME>. To je vhodné pro začlenění do různých portálů. Například:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a>
<li><a href="http://www.netvibes.com/">Netvibes</a>
</ul>
Navštivte portál a najděte místo pro přidání obsahu. Do tohoto místa zkopírujte tuto adresu URL: <strong>%s</strong>. Mělo by být vytvořeno nové okno s obsahem (upozorňujeme, že portály obvykle nepodporují odkazy s protokolem HTTPS, protokol HTTPS však můžete použít uvnitř kódu iframe.php). Vaše uživatelské jméno a heslo <strong>NEBUDE</strong> pro daný portál zpřístupněno. Uživatelé prohlížeče Microsoft Explorer musí povolit použití souborů cookies pro doménu serveru SiteBar.
_SBHD;

$para['integrator::hint_google'] = <<<_SBHD
Také používá rámce IFRAME, avšak s přizpůsobením pro zobrazení vlastní domovské stránky Google. Použijte možnost <strong>Přidat obsah...</strong> a tuto adresu URL <strong>%s</strong>.
_SBHD;

$para['integrator::hint_addpage'] = <<<_SBHD
Tento bookmarklet* může být použit pro přidání záložek na panel SiteBar. Při jeho spuštění dojde k otevření nového místního okna s předem vyplněnými podrobnostmi o aktuální stránce.
_SBHD;

$para['integrator::hint_bookmarklet'] = <<<_SBHD
&#42; <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> je záložka nebo oblíbená položka, která obsahuje kód JavaScript. Klepnutím pravým tlačítkem myši jej můžete přidat do seznamu záložek nebo oblíbených položek prohlížeče. Pozdějším klepnutím na záložku dojde ke spuštění kódu JavaScript.
_SBHD;

$para['integrator::hint_search_engine'] = <<<_SBHD
Přidá možnost vyhledávání záložek SiteBar do pole Hledání na webu. Umožňuje vyhledávat záložky SiteBar bez nutnosti otevření panelu SiteBar.
_SBHD;

$para['integrator::hint_sitebar'] = <<<_SBHD
Rozšíření vyvinuté speciálně pro panel SiteBar. Umožňuje otevřít všechny záložky z jedné složky na kartách (listech) prohlížeče a poskytuje i další funkce. Chcete-li umístit ikony panelu SiteBar na panel nástrojů, použijte nabídku Zobrazit > Postranní lišta > Přizpůsobit.
_SBHD;

$para['integrator::hint_bmsync'] = <<<_SBHD
Chcete-li používat obousměrnou synchronizaci s prohlížečem Firefox, nainstalujte rozšíření Bookmark Synchronizer. Další informace o nastavení synchronizace naleznete v nabídce Nastavení po klepnutí na tlačítko Nastavení XBELSync.
[<a href="http://sitebar.org/downloads.php">Další informace</a>]
_SBHD;

$para['integrator::hint_sidebar'] = <<<_SBHD
Vytvoří záložku. Pozdějším klepnutím na tuto záložku otevřete panel SiteBar na postranním panelu.
_SBHD;

$para['integrator::hint_livebookmarks'] = <<<_SBHD
Stáhněte celou strukturu složek panelu SiteBar do souboru. Importujte tento soubor mezi záložky. Každá složka je reprezentována živým odkazem (Live Bookmark). Tímto způsobem budou vaše záložky integrovány mezi ostatní záložky, ale obsah složek bude stahován online ze serveru SiteBar. V případě, že má složka podsložky, bude obsah aktuální složky zobrazen ve složce s názvem @Content.
_SBHD;

$para['integrator::hint_sidebar_mozilla'] = <<<_SBHD
Přidá panel SiteBar do postranního panelu. Tento panel lze skrýt a zobrazit stisknutím klávesy F9. V případě, že doba načítání panelu SiteBar překročí určitý časový limit, prohlížeč Mozilla jej vůbec nezobrazí. Doporučujeme otevřít panel SiteBar v hlavním okně, aby se propojené obrázky (ikony odkazů) uložily do mezipaměti prohlížeče, nebo zakázat zobrazení ikon odkazů v nabídce Nastavení.
_SBHD;

$para['integrator::hint_sidebar_konqueror'] = <<<_SBHD
Postupujte takto:
<ol>
<li>Spusťte prohlížeč Konqueror.
<li>Přejděte do nabídky Window -> Show Navigation Panel (F9).
<li>Pravým tlačítkem myši klepněte na panel s ikonami, který je umístěn nejvíce vlevo na navigačním panelu v oblasti pod ikonami.
<li>Vyberte Add New -> Web SideBar Module. Bude přidána nová ikona s názvem „Web SiteBar Plugin“.
<li>Klepněte pravým tlačítkem na novou ikonu a vyberte položku „Set Name“. Vložte text <b>SiteBar</b>.
<li>Klepněte pravým tlačítkem na novou ikonu a vyberte položku „Set Url“. Vložte text <b>%s</b>.
<li>Klepnutím na ikonu otevřete panel SiteBar v postranním panelu.
</ol>
_SBHD;

$para['integrator::hint_hotlist'] = <<<_SBHD
Na panel záložek aplikace Opera bude přidána záložka panelu SiteBar. Klepnutím na odkaz v seznamu záložek přidáte panel SiteBar mezi panely prohlížeče Opera.
_SBHD;

$para['integrator::hint_install'] = <<<_SBHD
Nainstaluje panel SiteBar do panelu aplikace Explorer a do kontextové nabídky. K využití všech funkcí je nutné provést změnu v registru systému Windows a restartovat systém. V závislosti na právech uživatele je možné, že budou instalovány pouze některé vlastnosti.
<br>
Panel SiteBar lze otevřít z nabídky Zobrazit > Panel aplikace Explorer nebo lze na panel nástrojů přidat tlačítko pro přepínání panelu SiteBar pomocí nabídky Zobrazit > Panely nástrojů > Vlastní. Chcete-li přidat stránku nebo odkaz na panel SiteBar, klepněte pravým tlačítkem kdekoliv na stránce nebo na odkaz.
_SBHD;

$para['integrator::hint_uninstall'] = <<<_SBHD
Odebere panel SiteBar z panelu aplikace Explorer (viz výše).
_SBHD;

$para['integrator::hint_searchbar'] = <<<_SBHD
Použití tohoto bookmarkletu* je doporučováno v případě, že uživatel nemá dostatečná oprávnění pro instalaci do panelu aplikace Explorer. Dočasně zobrazí panel SiteBar v panelu Hledat aplikace Explorer.
_SBHD;

$para['integrator::hint_maxthon_sidebar'] = <<<_SBHD
Stáhne doplněk (s přednastavenou adresou URL). Soubor archivu musí být rozbalen do složky „C:Program FilesMaxthonPlugin“. Po restartu bude přidána nová položka panelu aplikace Explorer.
_SBHD;

$para['integrator::hint_maxthon_toolbar'] = <<<_SBHD
Stáhne doplněk (s přednastavenou adresou URL). Archiv musí být rozbalen do složky „C:Program FilesMaxthonPlugin". Po restartu se v panelu doplňků (modulů) zobrazí nová ikona. Pomocí této ikony lze na panel SiteBar přidat odkaz na stránku zobrazenou na aktuálním listu.
_SBHD;

$para['integrator::hint_gentoo'] = <<<_SBHD
Program SiteBar nainstalujete spuštěním příkazu <strong>emerge sitebar</strong>.
_SBHD;

$para['integrator::hint_debian'] = <<<_SBHD
Program SiteBar nainstalujete spuštěním příkazu <strong>apt-get install sitebar</strong>.
_SBHD;

$para['integrator::hint_phplm'] = <<<_SBHD
PHP Layers Menu je systém pro tvorbu hierarchických nabídek DHTML. Využívá skriptovací modul PHP pro zpracování datových záznamů. Panel SiteBar může sloužit jako zdroj záložek v požadované struktuře. Pokud má funkce fopen povoleno otevírat vzdálené soubory, následující kód načte soubor ve správném formátu:
<tt>
LayersMenu::setMenuStructureFile('%s') 
</tt>
_SBHD;

$para['integrator::copyright3'] = <<<_SBHD
Copyright (c) 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> a <a href='http://sitebar.org/team.php'>tým SiteBar</a>. <a href='http://sitebar.org/forum.php'>Fórum</a> podpory a sledování <a href='http://sitebar.org/bugs.php'>chyb</a>.

_SBHD;

$para['command::welcome'] = <<<_SBHD
%s, vítá vás program SiteBar!
%s
<p>
Chcete-li spravovat záložky, klepněte pravým tlačítkem myši na složku nebo záložku.
<p>
Můžete také zaškrtnout políčko „%s“ v nabídce „%s" a použít místo toho ikony nabídky.
<p>
Nyní jste přihlášeni do systému.
_SBHD;

$para['command::signup_verify'] = <<<_SBHD
<p>
Tato instalace programu SiteBar vyžaduje, aby byla před použitím funkcí programu SiteBar ověřena vaše e-mailová adresa.
<p>
Pokud jste zadali správnou e-mailovou adresu, měli byste brzy obdržet e-mailovou zprávu. Klepněte na odkaz uvedený ve zprávě.
_SBHD;

$para['command::signup_approve'] = <<<_SBHD
<p>
Tato instalace programu SiteBar vyžaduje, aby byly před použitím funkcí programu SiteBar vytvořené účty schváleny správcem.
<p>
Počkejte prosím na schválení správcem. Budete informováni e-mailem.
_SBHD;

$para['command::signup_verify_approve'] = <<<_SBHD
<p>
Tato instalace programu SiteBar vyžaduje, aby byla před použitím funkcí programu SiteBar ověřena platnost vaší e-mailové adresy a aby byl vytvořený účet schválen správcem.
<p>
Pokud jste zadali správnou e-mailovou adresu, měli byste brzy obdržet e-mailovou zprávu. Klepněte na odkaz uvedený ve zprávě a počkejte na schválení správcem. Budete informováni e-mailem.
_SBHD;

$para['command::account_approved'] = <<<_SBHD
Správce schválil vaši žádost o vytvoření účtu.
Můžete se přihlásit pomocí uživatelského jména %s.

--
Instalace programu SiteBar na adrese %s.
_SBHD;

$para['command::account_rejected'] = <<<_SBHD
Správce zamítnul vaši žádost o vytvoření účtu 
pro uživatelské jméno %s.

--
Instalace programu SiteBar na adrese %s.
_SBHD;

$para['command::account_deleted'] = <<<_SBHD
Správce odstranil váš neaktivní účet
s uživatelským jménem %s.

--
Instalace programu SiteBar na adrese %s.
_SBHD;

$para['command::reset_password'] = <<<_SBHD
Bylo vyžádáno vymazání hesla pro účet programu SiteBar s registrovanou e-mailovou adresou „%s“.

Pokud opravdu chcete vymazat heslo pro tento účet, 
klepněte na následující odkaz:
   %s

--
Instalace programu SiteBar na adrese %s.
_SBHD;

$para['command::leave_group'] = <<<_SBHD
<p>
Pokud se budete chtít znovu vrátit do skupiny, ze které 
jste odešli, budete potřebovat pozvání. Chcete-li obdržet 
pozvání, musíte se obrátit na vlastníka skupiny. K tomu 
potřebujete znát jeho uživatelské jméno na serveru SiteBar 
nebo jeho e-mailovou adresu.
_SBHD;

$para['command::use_comma'] = <<<_SBHD
K oddělení uživatelských jmen použijte čárky. Uživatelé se stanou členy, jakmile přijmou vaše pozvání.
_SBHD;

$para['command::reset_password_hint'] = <<<_SBHD
<p>
Zadejte uživatelské jméno nebo registrovanou e-mailovou adresu.
Na tuto e-mailovou adresu bude odeslán kód.
Pomocí tohoto kódu vymažte heslo.
_SBHD;

$para['command::contact'] = <<<_SBHD
%s


--
Instalace programu SiteBar na adrese %s.
_SBHD;

$para['command::contact_group'] = <<<_SBHD
Cílová skupina: %s

%s


--
Instalace programu SiteBar na adrese %s.
_SBHD;

$para['command::delete_account'] = <<<_SBHD
<h3>Opravdu chcete odstranit svůj účet?</h3>
Tuto změnu nebude možné vrátit.<p>
_SBHD;

$para['command::email_link_href'] = <<<_SBHD
<p>Klepněte
<a href='mailto:?subject=Webova stranka: %s&body=Tato webová stránka by vás mohla zajímat.
 Adresa: %s
 --
 Odesláno programem SiteBar Bookmark Manager na adrese %s.
 Další informace o programu SiteBar: http://sitebar.org.
">sem</a>, chcete-li odeslat e-mail pomocí výchozího poštovního programu.
_SBHD;

$para['command::email_link'] = <<<_SBHD
Tato webová stránka by vás mohla zajímat.
Adresa:

    "%s" %s

%s

--
Odesláno programem SiteBar na adrese %s.
Open Source Bookmark Server http://sitebar.org
_SBHD;

$para['command::verify_email'] = <<<_SBHD
Děkujeme vám, že jste využili možnost ověřit svoji e-mailovou adresu. Díky tomu můžete používat e-mailové funkce panelu SiteBar.

Ověření e-mailové adresy provedete klepnutím na následující odkaz:

    %s

Pokud jste neiniciovali ověření e-mailové adresy v programu SiteBar Bookmark Manager, ignorujte prosím tento e-mail.

_SBHD;

$para['command::verify_email_must'] = <<<_SBHD
Zažádali jste o vytvoření účtu v instalaci programu SiteBar, která vyžaduje 
před prvním použitím programu SiteBar ověření vaší e-mailové adresy.

Ověření e-mailové adresy provedete klepnutím na následující odkaz:
    %s

_SBHD;

$para['command::export_bk_ie_hint'] = <<<_SBHD
Prohlížeč Internet Explorer umožňuje importovat záložky ve formátu souboru záložek programu Netscape pomocí nabídky Soubor > Import a export. Soubor však musí mít nativní kódování systému Windows. Výchozí kódování UTF-8 nebude použitelné.<br>
_SBHD;

$para['command::import_bk_ie_hint'] = <<<_SBHD
Prohlížeč Internet Explorer umožňuje exportovat záložky ve formátu souboru záložek programu Netscape pomocí nabídky Soubor > Import a export.
Exportovaný soubor bude mít nativní kódování systému Windows - při importu proto vyberte správnou kódovou stránku, protože výchozí kódování UTF-8 nebude použitelné.
_SBHD;

$para['command::noiconv'] = <<<_SBHD
<br>
Konverze znakových stránek není na serveru SiteBar instalována. Podporovány jsou pouze znakové stránky UTF-8 a ISO-8859-1.
<br>
_SBHD;

$para['command::security_legend'] = <<<_SBHD
Práva:
<strong>Č</strong>íst,
<strong>P</strong>řidat,
<strong>Z</strong>měnit,
<strong>O</strong>dstranit
_SBHD;

$para['command::purge_cache'] = <<<_SBHD
<h3>Opravdu chcete odebrat všechny ikony odkazů z mezipaměti?</h3>
_SBHD;

$para['command::tooltip_allow_anonymous_export'] = <<<_SBHD
Povolit přímé stahování záložek nebo poskytování zdroje záložek anonymním uživatelům. Tuto funkci lze obejít, pokud uživatel zná správnou adresu URL.
_SBHD;

$para['command::tooltip_allow_contact'] = <<<_SBHD
Povolit anonymním uživatelům kontaktovat správce.
_SBHD;

$para['command::tooltip_allow_custom_search_engine'] = <<<_SBHD
Pokud tato možnost není povolena, budou všichni uživatelé používat vyhledávač nastavený v tomto formuláři a nebudou moci jej změnit.
_SBHD;

$para['command::tooltip_allow_info_mails'] = <<<_SBHD
Povolit správcům a moderátorům skupiny, do které patřím, aby mi mohli odesílat informační e-maily.
_SBHD;

$para['command::tooltip_allow_sign_up'] = <<<_SBHD
Povolit návštěvníkům přistup k formuláři pro vytvoření účtu a k registraci na serveru SiteBar.
_SBHD;

$para['command::tooltip_allow_user_groups'] = <<<_SBHD
Uživatelé mohou vytvářet vlastní skupiny. V opačném případě mají toto oprávnění pouze správci.
_SBHD;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_SBHD
Povolit uživatelům odstraňování jejich vlastních existujících stromů.
_SBHD;

$para['command::tooltip_allow_user_trees'] = <<<_SBHD
Povolit uživatelům vytváření dalších stromů.
_SBHD;

$para['command::tooltip_approved'] = <<<_SBHD
Účet byl schválen a je plně funkční.
_SBHD;

$para['command::tooltip_auto_close'] = <<<_SBHD
Nezobrazovat stav úspěšně vykonaného příkazu.
_SBHD;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_SBHD
Při přidání záložky automaticky získat chybějící ikonu odkazu.
_SBHD;

$para['command::tooltip_default_groups'] = <<<_SBHD
Seznam skupin, které budou vytvořeny pro uživatele, který nemá žádné skupiny. K oddělení názvů skupiny použijte znak |.
_SBHD;

$para['command::tooltip_public_groups'] = <<<_SBHD
Seznam skupiny, které budou k dispozici anonymním uživatelům.
_SBHD;

$para['command::tooltip_cmd'] = <<<_SBHD
Přidat nejdůležitějsí příkazy panelu SiteBar za účelem usnadnění přihlášení k serveru SiteBar.
_SBHD;

$para['command::tooltip_comment_impex'] = <<<_SBHD
Zobrazit příkazy pro import a export popisu odkazu.
_SBHD;

$para['command::tooltip_comment_limit'] = <<<_SBHD
Můžete stanovit maximální délku pro komentář odkazu. Malé soubory lze uložit jako komentáře.
_SBHD;

$para['command::tooltip_default_folder'] = <<<_SBHD
Při příštím použití tohoto bookmarkletu bude tato složka nastavena jako výchozí.
_SBHD;

$para['command::tooltip_delete_content'] = <<<_SBHD
Odstranit pouze obsah složky (nikoliv celou složku).
_SBHD;

$para['command::tooltip_delete_favicons'] = <<<_SBHD
Odstranit adresu URL ikony odkazu, pokud je ikona odkazu neplatná (používejte s rozmyslem).
_SBHD;

$para['command::tooltip_demo'] = <<<_SBHD
Vytvořit ukázkový účet s omezenou funkčností a bez možnosti změnit heslo.
_SBHD;

$para['command::tooltip_discover_favicons'] = <<<_SBHD
Pokusit se o analýzu stránky a vyhledání chybějících ikon odkazů.
_SBHD;

$para['command::tooltip_exclude_root'] = <<<_SBHD
Je-li to možné, nebude kořenová složka zahrnuta ve výstupu.
_SBHD;

$para['command::tooltip_expert_mode'] = <<<_SBHD
Zobrazit pokročilé funkce a více diagnostických zpráv.
_SBHD;

$para['command::tooltip_extern_commander'] = <<<_SBHD
Vykonávat příkazy v místním okně - bez obnovování po každém vykonání příkazu.
_SBHD;

$para['command::tooltip_filter_groups'] = <<<_SBHD
Namísto pole se seznamem použít filtr pro uživatele.
_SBHD;

$para['command::tooltip_filter_users'] = <<<_SBHD
Namísto pole se seznamem použít filtr pro skupiny.
_SBHD;

$para['command::tooltip_flat'] = <<<_SBHD
Exportovat odkazy, jako kdyby byly v jedné složce.
_SBHD;

$para['command::tooltip_hide_xslt'] = <<<_SBHD
Skryje funkce, které vyžadují podporu funkcí XSLT prohlížečem.
_SBHD;

$para['command::tooltip_hits'] = <<<_SBHD
Při generování statistiky použití směrovat všechna klepnutí na odkazy přes server SiteBar.
_SBHD;

$para['command::tooltip_ignore_https'] = <<<_SBHD
Panel SiteBar nemůže ověřit adresy URL s protokolem HTTPS. Pokud toto políčko není zaškrtnuto, nebude možno ověřit žádné odkazy, ve kterých není adresa URL s protokolem HTTP.
_SBHD;

$para['command::tooltip_ignore_recently'] = <<<_SBHD
Netestovat odkazy, které byly testovány nedávno - používá se pro opakované ověřování, pokud předchozí ověření nebylo úspěšně dokončeno.
_SBHD;

$para['command::tooltip_integrator_url'] = <<<_SBHD
Ve výchozím nastavení se v programu SiteBar používá integrátor ze serveru my.sitebar.org. Za účelem zlepšení ochrany osobních údajů lze použít místní integrátor.
_SBHD;

$para['command::tooltip_is_dead_check'] = <<<_SBHD
Tento odkaz nebyl úspěšně ověřen. Přesto jej můžete ponechat jako aktivní.
_SBHD;

$para['command::tooltip_is_feed'] = <<<_SBHD
Označit odkaz jako zdroj - odkaz bude otevřen ve čtečce zdrojů (je-li nastavena), nikoliv přímo v prohlížeči.
_SBHD;

$para['command::tooltip_load_all_nodes'] = <<<_SBHD
Načíst všechny složky. Je vhodné pro uživatele s malým počtem odkazů, kteří chtějí používat filtrování.
_SBHD;

$para['command::tooltip_popup_params'] = <<<_SBHD
Parametry pro místní okna otevíraná programem SiteBar. Chcete-li obnovit výchozí hodnotu, nechte pole prázdné.
_SBHD;

$para['command::tooltip_max_icon_age'] = <<<_SBHD
Maximální stáří ikony odkazu v mezipaměti před jejím obnovením ze vzdáleného serveru.
_SBHD;

$para['command::tooltip_max_icon_cache'] = <<<_SBHD
Zásobník typu „první dovnitř, první ven“. Nejstarší ikony budou ze systému odstraněny. Používá se pro kontrolu velikosti mezipaměti.
_SBHD;

$para['command::tooltip_max_icon_size'] = <<<_SBHD
Maximální povolená velikost ikony v bajtech.
_SBHD;

$para['command::tooltip_max_session_time'] = <<<_SBHD
Správce může nastavit maximální povolenou dobu trvání relace. Při překročení této doby se uživatel musí znovu přihlásit.
_SBHD;

$para['command::tooltip_menu_icon'] = <<<_SBHD
Některé prohlížeče a platformy neumožňují zpracovat stisknutí pravého tlačítka myši.
Pokud je zaškrtnuto toto políčko, bude se zobrazovat ikona, kterou lze použít k zobrazení kontextových nabídek. Zároveň se zakáže funkce přetahování myší.
_SBHD;

$para['command::tooltip_mix_mode'] = <<<_SBHD
Složky jsou ve stromu panelu SiteBar zobrazeny před odkazy, nebo naopak.
_SBHD;

$para['command::tooltip_novalidate'] = <<<_SBHD
Neověřovat tento odkaz - použito pro intranetové odkazy nebo pro odkazy, které mají problémy s ověřením.
_SBHD;

$para['command::tooltip_paste_content'] = <<<_SBHD
Použít operaci pouze na obsah složky, nikoliv na složku samotnou.
_SBHD;

$para['command::tooltip_private'] = <<<_SBHD
Soukromé odkazy nejsou nikdy zobrazeny jiným uživatelům, ani pokud jsou ve sdílené složce.
_SBHD;

$para['command::tooltip_private_over_ssl_only'] = <<<_SBHD
Soukromé odkazy budou načteny, pouze pokud bude panel SiteBar používán prostřednictvím připojení SSL.
_SBHD;

$para['command::tooltip_rename'] = <<<_SBHD
Při importu přejmenovat duplicitní odkazy, aby byly načteny všechny odkazy.
_SBHD;

$para['command::tooltip_respect'] = <<<_SBHD
Odeslat e-mail, pouze pokud je to uživatelem povoleno.
_SBHD;

$para['command::tooltip_search_engine_ico'] = <<<_SBHD
Ikona k zobrazení na panelu nástrojů SiteBar, která aktivuje hledání na webu.
_SBHD;

$para['command::tooltip_search_engine_url'] = <<<_SBHD
Adresa URL webového vyhledávače. V místě, kde má být umístěn hledaný výraz, zadejte %SEARCH%.
_SBHD;

$para['command::tooltip_sender_email'] = <<<_SBHD
E-maily generované programem SiteBar budou odesílány s použitím této adresy.
_SBHD;

$para['command::tooltip_show_acl'] = <<<_SBHD
Označit složky, které mají specifikováno zabezpečení.
_SBHD;

$para['command::tooltip_show_logo'] = <<<_SBHD
Zobrazit logo v záhlaví panelu - pro pomalé hostitelské servery by mělo být zakázáno. V opačném případě lze použít pro reklamu.
_SBHD;

$para['command::tooltip_show_statistics'] = <<<_SBHD
Zobrazit statické a výkonnostní statistiky na hlavním panelu SiteBar.
_SBHD;

$para['command::tooltip_subdir'] = <<<_SBHD
Rekurzivně exportovat všechny odkazy a všechny složky.
_SBHD;

$para['command::tooltip_subfolders'] = <<<_SBHD
Ověřit odkazy v této složce rekurzivně pro všechny podsložky.
_SBHD;

$para['command::tooltip_to_verified'] = <<<_SBHD
Odesílat e-maily pouze na ověřené adresy.
_SBHD;

$para['command::tooltip_use_compression'] = <<<_SBHD
Stránky generované panelem SiteBar lze komprimovat, aby se snížil objem přenášených dat. Komprese je použita pouze v případě, že je podporována prohlížečem.
_SBHD;

$para['command::tooltip_use_conv_engine'] = <<<_SBHD
Používat konverzní modul (obvykle rozšíření PHP) ke konverzi stránek s různým kódováním - důležité pro import a export záložek. V některých implementacích může způsobit zobrazení prázdné obrazovky.
_SBHD;

$para['command::tooltip_use_favicon_cache'] = <<<_SBHD
Ikony odkazů budou staženy serverem do databázové mezipaměti a odeslány na žádost klienta. Díky snížení počtu připojených serverů zvyšuje objem přenesených dat a zrychluje přístup do mezipaměti ikon odkazů.
_SBHD;

$para['command::tooltip_use_favicons'] = <<<_SBHD
Použití ikon odkazů činí panel SiteBar přitažlivějším, ale pomalejším. Je-li v této instalaci použita mezipaměť ikon odkazů, bude zobrazení ikon odkazů výrazně rychlejší.
_SBHD;

$para['command::tooltip_use_hiding'] = <<<_SBHD
Povolí příkaz pro skrytí složek. Skrývání se používá pro složky uveřejněné jinými uživateli.
_SBHD;

$para['command::tooltip_use_mail_features'] = <<<_SBHD
Umožňuje-li tato instalace PHP použít funkci pošty, lze povolit funkce e-mailu.
_SBHD;

$para['command::tooltip_use_new_window'] = <<<_SBHD
Otevře všechny odkazy v novém okně pomocí prázdného cíle.
_SBHD;

$para['command::tooltip_use_outbound_connection'] = <<<_SBHD
Některé funkce (mezipaměť ikon odkazů) vyžadují přístup ke vzdáleným adresám z tohoto serveru.
_SBHD;

$para['command::tooltip_use_search_engine'] = <<<_SBHD
Povolí přesměrování na výsledky z vašeho oblíbeného webového vyhledávače nebo rozšíření hledání o tyto výsledky.
_SBHD;

$para['command::tooltip_use_search_engine_iframe'] = <<<_SBHD
Výsledky hledání webovým vyhledávačem budou zobrazeny společně s výsledky hledání na panelu SiteBar prostřednictvím vloženého rámce.
_SBHD;

$para['command::tooltip_use_tooltips'] = <<<_SBHD
Místo popisů ovládacích prvků prohlížeče zobrazovat popisy ovládacích prvků panelu SiteBar. Umožňuje delší popisy a podporuje více prohlížečů.
_SBHD;

$para['command::tooltip_use_trash'] = <<<_SBHD
Označit odstraněné složky a odkazy tak, aby je bylo možno obnovit nebo přesunout do koše.
_SBHD;

$para['command::tooltip_users_must_be_approved'] = <<<_SBHD
Uživatelé musí být před použitím programu SiteBar schváleni správcem.
_SBHD;

$para['command::tooltip_users_must_verify_email'] = <<<_SBHD
Uživatelé musí před použitím programu SiteBar ověřit svoji e-mailovou adresu.
_SBHD;

$para['command::tooltip_verified'] = <<<_SBHD
Zaškrtnutím toto políčka bude e-mailová adresa označena jako ověřená.
_SBHD;

$para['command::tooltip_version_check_interval'] = <<<_SBHD
Program SiteBar může pravidelně kontrolovat, zda není k dispozici novější verze. To může být důležité v případě, že by bylo v instalované verzi zjištěno slabé místo zabezpečení. Tato funkce vyžaduje povolení odchozího připojení.
_SBHD;

$para['command::tooltip_web_search_user_agents'] = <<<_SBHD
Regulární výraz pro uživatelskou identifikaci (User Agent), který poskytne generátor výstupu nevyžadující skript Java.
_SBHD;

$para['sitebar::users_must_verify_email'] = <<<_SBHD
Tato instalace panelu SiteBar vyžaduje ověření e-mailové adresy. Ověřte prosím svoji e-mailovou adresu, jinak může být váš účet odstraněn.
_SBHD;

$para['sitebar::tutorial'] = <<<_SBHD
Ikona s vaším uživatelským jménem zobrazená výše představuje vaši kořenovou složku se záložkami.
Chcete-li přidat první záložku, klepněte na ni pravým tlačítkem myši a z nabídky vyberte položku „%s“.
_SBHD;

$para['sitebar::invitation'] = <<<_SBHD
Uživatel <strong>%s</strong> chce s vámi sdílet své záložky a zve vás ke vstupu do skupiny <strong>%s</strong>.
_SBHD;

$para['usermanager::signup_info'] = <<<_SBHD
Uživatel %s požádal o vytvoření účtu v instalaci programu SiteBar na adrese %s.
_SBHD;

$para['usermanager::signup_info_verified'] = <<<_SBHD
Uživatel %s požádal o vytvoření účtu v instalaci programu SiteBar na adrese %s.
Uživatel již ověřil svoji e-mailovou adresu.
_SBHD;

$para['usermanager::signup_approval'] = <<<_SBHD
Uživatel %s požádal o vytvoření účtu v instalaci programu SiteBar na adrese %s.

Schválit účet:
  %s

Zamítnout žádost:
  %s

Zobrazit čekající uživatele:
  %s

_SBHD;

$para['usermanager::signup_approval_verified'] = <<<_SBHD
Uživatel %s požádal o vytvoření účtu v instalaci programu SiteBar na adrese %s.
Uživatel již ověřil svoji e-mailovou adresu.

Schválit účet:
  %s

Zamítnout žádost:
  %s

Zobrazit čekající uživatele:
  %s

_SBHD;

$para['usermanager::alert'] = <<<_SBHD
%s
_SBHD;

$para['messenger::cancel'] = <<<_SBHD
Zrušit
_SBHD;

$para['messenger::delete'] = <<<_SBHD
Odstranit
_SBHD;

$para['messenger::expire'] = <<<_SBHD
Označit jako staré
_SBHD;

$para['messenger::read'] = <<<_SBHD
Označit jako přečtené
_SBHD;

$para['messenger::unread'] = <<<_SBHD
Označit jako nepřečtené
_SBHD;

$para['messenger::save'] = <<<_SBHD
Uložit
_SBHD;

$para['messenger::state_unread'] = <<<_SBHD
Nepřečteno
_SBHD;

$para['messenger::state_seen'] = <<<_SBHD
Zobrazeno
_SBHD;

$para['messenger::state_read'] = <<<_SBHD
Přečteno
_SBHD;

$para['messenger::state_saved'] = <<<_SBHD
Uloženo
_SBHD;

$para['messenger::state_deleted'] = <<<_SBHD
Odstraněno
_SBHD;

$para['messenger::state_expired'] = <<<_SBHD
Staré
_SBHD;

$para['hook::statistics'] = <<<_SBHD
Stromy: {roots_total}. Složky: {nodes_shown}/{nodes_total}. Odkazy: {links_shown}/{links_total}. Uživatelé: {users}. Skupiny: {groups}. Dotazy SQL: {queries}. Doba databáze/celkem: {time_db}/{time_total} s ({time_pct} %).
_SBHD;

$para['groupname::Family'] = <<<_SBHD
Rodina
_SBHD;

$para['groupname::Friends'] = <<<_SBHD
Přátelé
_SBHD;

$para['groupname::Public'] = <<<_SBHD
Veřejnost
_SBHD;

?>
