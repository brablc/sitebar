<?php

$para = array();

$para['integrator::welcome'] = <<<_SBHD
Welkom bij de SiteBar integratie pagina. Deze pagina helpt u om het meeste uit de SiteBar te halen.
Op de <a href="http://sitebar.org/">SiteBar homepage</a> kunt u meer leren over de mogelijkheden van SiteBar.
_SBHD;

$para['integrator::header'] = <<<_SBHD
SiteBar is ontworpen om te voldoen aan open standaarden en zou moeten werken
in de meeste browsers die JavaScript en cookies geactiveerd hebben.
De volgende tabel toont welke browsers met succes getest zijn.
_SBHD;

$para['integrator::usage_opera'] = <<<_SBHD
SiteBar gebruikt de rechtermuisklik om context menus te open te klappen voor links en mappen.
Als Opera gebruiker moet u het zogenoemde "Menu Icoon" in "Gebruikersinstellingen" activeren.
Daarna op het icoon naast de link of map klikken om het menu open te klappen.
Een control-linkermuisklik op het label naast het link- of map-icoon werkt eventueel ook.
_SBHD;

$para['integrator::hint'] = <<<_SBHD
Klik hierboven op de naam van de browser van uw keuze om de integratie-instructies te zien.
<a href="http://brablc.com/mailto?o">Rapporteer</a> alstublieft andere geteste browsers/platformen.
_SBHD;

$para['integrator::hint_window'] = <<<_SBHD
Dit is een gewone link die de SiteBar in het huidige venster opent.
SiteBar is ontworpen voor een verticale nogal smalle balk.
Op deze manier zou vrij veel venster ruimte worden verspild.
_SBHD;

$para['integrator::hint_dir'] = <<<_SBHD
Behalve als een boomstructuur, kan SiteBar getoond worden als een traditionele folderstructuur.
Dit aanzicht laat een folder per keer zien met details voor de getoonde links.
De browser moet <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a> ondersteunen.
_SBHD;

$para['integrator::hint_popup'] = <<<_SBHD
Indien uw browser geen zijwerkbalk heeft, kunt u deze bookmarklet* gebruiken.
Deze zal Sitebar in een pop-up venster openen dat op een zijwerkbalk lijkt.
Let alstublieft op dat uw browser eventueel pop-ups kan blokkeren!
_SBHD;

$para['integrator::hint_iframe'] = <<<_SBHD
De URL aan de linkerkant toont SiteBar in een <IFRAME>. Dit is geschikt voor het inbedden in diverse portalen, zoals:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a>
<li><a href="http://www.netvibes.com/">Netvibes</a>
</ul>
Bezoek het portaal, bepaal een plek waar u content kan toevoegen.
Kopieer daar deze URL <strong>%s</strong> waarna een nieuw 'gadget' zou moeten zijn aangemaakt
(let er op dat https normaliter niet ondersteund wordt door portalen, u kunt https echter wel toepassen in de iframe.php).
Let er op dat uw gebruikersnaam/wachtwoord <strong>NIET</strong> aan het portaal worden blootgesteld.
MS IE gebruikers zullen eventueel cookies moeten toestaan voor het SiteBar server domein.
_SBHD;

$para['integrator::hint_google'] = <<<_SBHD
Gebruikt ook een IFRAME, maar is aangepast voor Google Gepersonaliseerde Startpagina. Gebruik <strong>Items toevoegen</strong> en deze URL <strong>%s</strong> .
_SBHD;

$para['integrator::hint_addpage'] = <<<_SBHD
Deze bookmarklet* kan worden gebruikt om links aan uw SiteBar toe te voegen.
Bij uitvoeren wordt een nieuw pop-up venster geopend waarvan de velden al
vooraf zijn ingevuld met de gegevens van de actuele pagina.
_SBHD;

$para['integrator::hint_bookmarklet'] = <<<_SBHD
* <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> is een favoriet
die JavaScript code bevat. U kunt op deze link klikken met de rechtermuisknop en hem aan
uw lijst met favorieten toevoegen. Wanneer de favoriet later wordt aangeklikt
zal de JavaScript code worden uitgevoerd.
_SBHD;

$para['integrator::hint_search_engine'] = <<<_SBHD
Voegt SiteBar favorieten doorzoeken toe aan het Web Doorzoeken veld. Maakt het mogelijk
om in de SiteBar-favorieten te zoeken zonder de Sitebar open te hebben.
_SBHD;

$para['integrator::hint_sitebar'] = <<<_SBHD
Extensie speciaal voor SiteBar ontwikkeld.
Kan alle links uit een map openen in tabbladen, en meer.
Gebruik het menu Beeld/Werkbalk/Aanpassen om SiteBar iconen
aan uw werkbalk toe te voegen.
_SBHD;

$para['integrator::hint_bmsync'] = <<<_SBHD
Om tweeweg synchronisatie met Firefox te kunnen gebruiken moet de Bookmark Synchronizer
extensie worden ge-installeerd. Via "Gebruikersinstellingen -> XBELSync Instellingen"
kan meer informatie worden verkregen over hoe deze synchronisatie ingesteld moet worden.
_SBHD;

$para['integrator::hint_sidebar'] = <<<_SBHD
Maakt een favoriet waarop naderhand kan worden geklikt om SiteBar in een zijwerkbalk te openen.
_SBHD;

$para['integrator::hint_livebookmarks'] = <<<_SBHD
Bewaar de mappenstructuur van uw hele SiteBar in een bestand.
Importeer dit bestand in uw browser's favorietenlijst.
Iedere map wordt gerepresenteerd als een 'live bookmark'.
Op deze manier worden uw SiteBar favorieten ge-integreerd met uw andere favorieten,
terwijl de inhoud van de mappen online gesynchroniseerd blijft met SiteBar.
Indien een map submappen bevat,
wordt de inhoud van de betreffende map getoond in de @Content map.
_SBHD;

$para['integrator::hint_sidebar_mozilla'] = <<<_SBHD
Voegt SiteBar toe aan de zijwerkbalk. Dit paneel kan worden getoond/verborgen met F9.
Indien het laden van de SiteBar in de zijwerkbalk een bepaalde tijdsduur overschrijdt,
zal Mozilla de inhoud niet tonen. In dit geval is het aan te bevelen om de SiteBar eenmaal
in het hoofdvenster te openen zodat de aan de links gekoppelde afbeeldingen (favicons)
in de tussenopslag van de browser kunnen worden opgeslagen; of anders kan
het afbeelden van de favicons worden uitgeschakeld in "Gebruikers Instellingen".
_SBHD;

$para['integrator::hint_sidebar_konqueror'] = <<<_SBHD
Volg deze aanwijzingen:
<ol>
<li>Open Konqueror
<li>Ga naar menu "Venster -> Navigatiepaneel tonen (F9)"
<li>Rechterklik op de meest linkse balk met iconen in het Navigatie Paneel onder de iconen.
<li>Kies "Nieuwe toevoegen -> Webzijbalk Module" - een nieuw icoon genaamd "Web SiteBar Plugin" zal worden toegevoegd.
<li>Rechterklik het nieuwe icoon en kies "Naam instellen", typ daar <b>SiteBar</b>.
<li>Rechterklik het nieuwe icoon en kies "Url-adres Instellen", typ daar <b>%s</b>.
<li>Klik op het icoon om SiteBar te openen in de SideBar. </ol>
_SBHD;

$para['integrator::hint_hotlist'] = <<<_SBHD
Een link naar SiteBar zal worden toegevoegd aan de Opera Favorieten.
Door er op te klikken wordt SiteBar geopend in het Opera zijpaneel.
_SBHD;

$para['integrator::hint_install'] = <<<_SBHD
Installeert de SuiteBar in de Verkenner werkbalk en het context menu. Dit vereist
een aanpassing van het Windows register en een herstart van het systeem om
volledige functionaliteit te verkrijgen. Afhankelijk van uw gebruikersrechten kan
het gebeuren dat slechts een gedeeltelijke functionaliteit beschikbaar komt.
<br>
Open de SiteBar Verkenner werkbalk via het menu "Beeld/Werkbalk" of
gebruik de werkbalk functie "Aanpassen" om een activerings-knop
voor het SiteBar paneel in de werkbalk te plaatsen.
Middels een rechtermuisklik ergens in een web pagina of op een hyperlink
kan de pagina of link dan aan de SiteBar worden toegevoegd.
_SBHD;

$para['integrator::hint_uninstall'] = <<<_SBHD
Verwijdert de Verkenner werkbalk (zie boven).
_SBHD;

$para['integrator::hint_searchbar'] = <<<_SBHD
Toepassing van deze bookmarklet* wordt aangeraden indien de gebruiker onvoldoende
privileges heeft om de Verkenner werkbalk te installeren. Het laadt de SiteBar tijdelijk
in de Zoeken Verkenner werkbalk van uw browser.
_SBHD;

$para['integrator::hint_maxthon_sidebar'] = <<<_SBHD
Haalt een plugin op (met vooraf ingestelde URL). Het archiefbestand moet worden uitgepakt
in de "C:Program FilesMaxthonPlugin" folder. Na een herstart zal een nieuw Verkenner
werkbalk item zijn toegevoegd.
_SBHD;

$para['integrator::hint_maxthon_toolbar'] = <<<_SBHD
Haalt een plugin op (met vooraf ingestelde URL). Het archiefbestand moet
worden uitgepakt in de "C:Program FilesMaxthonPlugin" folder.
Na een herstart zal een nieuw icoon aanwezig zijn in de plugin werkbalk.
Via dit icoon kan de huidige web pagina aan de SiteBar worden toegevoegd.
_SBHD;

$para['integrator::hint_gentoo'] = <<<_SBHD
Voer het commando <strong>emerge sitebar</strong> uit om het SiteBar package te installeren.
_SBHD;

$para['integrator::hint_debian'] = <<<_SBHD
Voer het commando <strong>apt-get install sitebar</strong> uit om het SiteBar package te installeren.
_SBHD;

$para['integrator::hint_phplm'] = <<<_SBHD
PHP Layers Menu is een hierarchisch menu systeem dat "on the fly"
DHTML menus genereert op basis van de PHP script-taal voor het
verwerken van gegevens-elementen.
SiteBar kan een goed gestructureerde RSS feed bieden voor uw favorieten.
Indien 'fopen' niet kan worden gebruikt om externe bestanden te openen,
zal de volgende code het bestand ook met de juiste structuur laden:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_SBHD;

$para['integrator::copyright3'] = <<<_SBHD
Copyright ? 2003-2005 <a href="http://brablc.com/">Ondřej Brablc</a>
en het <a href="http://sitebar.org/team.php">SiteBar Team</a>.
Ondersteunings<a href="http://sitebar.org/forum.php">forum</a> en <a href="http://sitebar.org/bugs.php">bug</a> tracking.

_SBHD;

$para['command::welcome'] = <<<_SBHD
%s, welkom bij de SiteBar!
%s
<p>
Gebruik een rechtermuisklik op mappen of links voor bewerkingen hierop.
<p>
Activeer de "%s" optie in de "%s" als alternatief, waarna het menu icoon kan worden gebruikt.
<p>
U bent nu ingelogd.
_SBHD;

$para['command::signup_verify'] = <<<_SBHD
<p>
Deze SiteBar installatie vereist dat uw email adres
geldig en geverifieerd is voordat u van de Sitebar
functionaliteit gebruik kunt maken.
<p>
Indien u een juist email adres opgegeven heeft,
zult u spoedig een email ontvangen. Klikt u
alstublieft op de link in deze email.
_SBHD;

$para['command::signup_approve'] = <<<_SBHD
<p>
Deze SiteBar installatie vereist dat aangemaakte accounts
door een beheerder worden goedgekeurd alvorens u van de
Sitebar functionaliteit gebruik kunt maken.
<p>
Wacht u alstublieft op deze goedkeuring
 - u zult per email hierover worden ge-informeerd.
_SBHD;

$para['command::signup_verify_approve'] = <<<_SBHD
<p>
Deze SiteBar installatie vereist dat uw email adres geldig
en geverifieerd is, en dat een beheerder uw account goedkeurt
voor u van de Sitebar functionaliteit gebruik kunt maken.

<p>
Indien u een juist email adres opgegeven heeft, zult u spoedig
een email ontvangen. Klikt u alstublieft op de link in deze
email en wacht op goedkeuring door de beheerder
- u zult hierover per email worden ge-informeerd.
_SBHD;

$para['command::account_approved'] = <<<_SBHD
De beheerder heeft uw verzoek om een account goedgekeurd.
U kunt inloggen met uw gebruikersnaam %s.

--
SiteBar installatie op %s.
_SBHD;

$para['command::account_rejected'] = <<<_SBHD
De beheerder heeft uw verzoek om een account
met gebruikersnaam %s geweigerd.

--
SiteBar installatie op %s.
_SBHD;

$para['command::account_deleted'] = <<<_SBHD
De beheerder heeft uw inactieve account
met gebruikersnaam %s verwijderd.

--
SiteBar installatie op %s.
_SBHD;

$para['command::reset_password'] = <<<_SBHD
Herstel van een wachtwoord is aangevraagd voor het SiteBar account
met geregistreerd e-mail adres "%s".

Ingeval u echt het wachtwoord wilt herstellen voor dit account,
klik dan alstublieft op de volgende link:
  %s
--
SiteBar installatie op %s.
_SBHD;

$para['command::leave_group'] = <<<_SBHD
<p>
Indien u een groep verlaat kunt u alleen weer lid worden na een uitnodiging.
Om een uitnodiging te verkrijgen moet u contact opnemen met de eigenaar
van de groep - en daarvoor moet u zijn SiteBar gebruikersnaam of email adres weten.
_SBHD;

$para['command::use_comma'] = <<<_SBHD
Gebruik een komma om gebruikersnamen te scheiden.
Gebruikers worden lid wanneer ze uw uitnodiging hebben aangenomen.
_SBHD;

$para['command::reset_password_hint'] = <<<_SBHD
<p>
Vul alstublieft uw gebruikersnaam of een geregistreerd email adres in.
Een token wordt naar uw geregistreerde email address gestuurd.
Gebruik dit token om uw wachtwoord te herstellen.
_SBHD;

$para['command::contact'] = <<<_SBHD
Bericht:

%s

--
SiteBar installatie op %s.
_SBHD;

$para['command::contact_group'] = <<<_SBHD
Groep: %s
Bericht:

%s


--
SiteBar installatie op %s.
_SBHD;

$para['command::delete_account'] = <<<_SBHD
<h3>Weet u zeker dat u uw account wilt verwijderen?</h3>
Er is geen manier om deze actie ongedaan te maken!<p>
_SBHD;

$para['command::email_link_href'] = <<<_SBHD
<p>Klik
<a href="mailto:?subject=Website: %s&body=Ik heb een website gevonden waar je wellicht in geinteresseerd in bent.
 Kijk op: %s
--
Verstuurd via my SiteBar Favorieten Beheerder op %s
Lees meer over SiteBar op http://sitebar.org
">hier</a> om een e-mail via uw standaard e-mail programma te versturen.
_SBHD;

$para['command::email_link'] = <<<_SBHD
Ik heb een website gevonden waar je wellicht in geinteresseerd in bent.
Kijk op:

    "%s" %s

%s

--
Verstuurd via SiteBar op %s
Open Source Favorieten Server http://sitebar.org
_SBHD;

$para['command::verify_email'] = <<<_SBHD
U heeft e-mailverificatie aangevraagd, waarmee u
SiteBar's e-mail toepassingen kunt gebruiken.

Klik alstublieft op de volgende link om uw e-mail te bevestigen:
  %s

Beschouw deze email als niet verzonden, indien u geen e-mailverificatie
hebt aangevraagd in SiteBar Bookmark Manager.
_SBHD;

$para['command::verify_email_must'] = <<<_SBHD
U hebt een SiteBar account aangevraagd bij een SiteBar installatie die vereist dat
uw email adres geverifieerd wordt alvorens van de Sitebar gebruik te mogen maken.

Klik alstublieft op onderstaande link om uw email adres te verifieren:
  %s
_SBHD;

$para['command::export_bk_ie_hint'] = <<<_SBHD
Internet Verkenner kan favorieten in het 'Netscape Bookmark File Format' im- en exporteren.
Deze moeten echter wel in de Windows eigen taal-codering zijn, want de standaard UTF-8 zal niet werken.<br>
_SBHD;

$para['command::import_bk_ie_hint'] = <<<_SBHD
Internet Verkenner kan favorieten exporteren in Netscape Bookmark bestandsformaat via het
"Bestand/Import en Export ..." menu. Het ge-exporteerde bestand wordt aangemaakt in de
Windows-eigen codering - kies alstublieft de juiste codepage bij het importeren van het bestand.
De standaard UTF-8 zal niet werken.<br>
_SBHD;

$para['command::noiconv'] = <<<_SBHD
<br>
Codepage conversie is niet geinstalleerd op de SiteBar server.
<br>
_SBHD;

$para['command::security_legend'] = <<<_SBHD
Rechten:
<strong>R</strong>ead (lees),
<strong>A</strong>dd (toevoegen),
<strong>M</strong>odify (aanpassen),
<strong>D</strong>elete (verwijderen)
_SBHD;

$para['command::purge_cache'] = <<<_SBHD
<h3>Wilt u echt alle favicons uit de cache verwijderen?</h3>
_SBHD;

$para['command::tooltip_allow_anonymous_export'] = <<<_SBHD
Activeer directe download van favorieten of nieuwsfeed voor anonieme gebruikers.
Dit kan omzeild worden indien de gebruiker weet hoe de URL geconstrueerd moet worden!
_SBHD;

$para['command::tooltip_allow_contact'] = <<<_SBHD
Sta toe dat de beheerder benaderd kan worden door anonieme gebruikers.
_SBHD;

$para['command::tooltip_allow_custom_search_engine'] = <<<_SBHD
Indien niet toegestaan, beschikken alle gebruikers enkel over de zoekmachine
die in dit formulier wordt ingesteld, zonder dit aan te kunnen passen.
_SBHD;

$para['command::tooltip_allow_info_mails'] = <<<_SBHD
Sta beheerders en moderatoren van een groep waartoe ik behoor, toe om me informatieve emails te sturen.
_SBHD;

$para['command::tooltip_allow_sign_up'] = <<<_SBHD
Sta bezoekers toe om het inschrijfformulier te benaderen en zich bij SiteBar te registereren.
_SBHD;

$para['command::tooltip_allow_user_groups'] = <<<_SBHD
Gebruikers is het toegestaan hun eigen groepen te creëren. Normaal hebben alleen beheerders dit privilege.
_SBHD;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_SBHD
Sta de gebruikers toe om hun bestaande structuren te verwijderen.
_SBHD;

$para['command::tooltip_allow_user_trees'] = <<<_SBHD
Sta de gebruikers toe om additionele structuren te creëren.
_SBHD;

$para['command::tooltip_approved'] = <<<_SBHD
Account is goedgekeurd en kan onbeperkt worden gebruikt.
_SBHD;

$para['command::tooltip_auto_close'] = <<<_SBHD
Toon geen status van de commando uitvoer in geval van succes.
_SBHD;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_SBHD
Haal de favicon automatisch op indien nog niet aanwezig wanneer link wordt toegevoegd.
_SBHD;

$para['command::tooltip_default_groups'] = <<<_SBHD
Lijst van groepen die worden aangemaakt voor een gebruiker zonder groepslidmaatschap.
Gebruik | om groepsnamen te scheiden.
_SBHD;

$para['command::tooltip_public_groups'] = <<<_SBHD
Lijst van groepen die beschikbaar zijn voor anonieme gebruikers.
_SBHD;

$para['command::tooltip_cmd'] = <<<_SBHD
Voeg de belangrijkste SiteBar commandos toe voor een eenvoudige login op SiteBar.
_SBHD;

$para['command::tooltip_comment_impex'] = <<<_SBHD
Toon commandos voor import en export van link beschrijvingen.
_SBHD;

$para['command::tooltip_comment_limit'] = <<<_SBHD
Het is mogelijk om een maximale lengte op te geven voor het commentaar bij een link.
Het is mogelijk om kleine bestanden als commentaar op te slaan.
_SBHD;

$para['command::tooltip_default_folder'] = <<<_SBHD
De volgende keer dat u de bookmarklet gebruikt zal dit de standaard map zijn.
_SBHD;

$para['command::tooltip_delete_content'] = <<<_SBHD
Verwijder enkel de inhoud van de map, en niet de map zelf.
_SBHD;

$para['command::tooltip_delete_favicons'] = <<<_SBHD
Verwijder de URL van de favicon die bij een link hoort indien de favicon ongeldig is - voorzichtig gebruiken.
_SBHD;

$para['command::tooltip_demo'] = <<<_SBHD
Maak dit een demo account met beperkte functionaliteit zonder mogelijkheid om het wachtwoord te veranderen.
_SBHD;

$para['command::tooltip_discover_favicons'] = <<<_SBHD
Probeer de pagina te analyseren om afwezige favicons (iconen voor snelkoppelingen) te vinden.
_SBHD;

$para['command::tooltip_exclude_root'] = <<<_SBHD
De bron map zal niet in de uitvoer worden getoond indien mogelijk.
_SBHD;

$para['command::tooltip_expert_mode'] = <<<_SBHD
Toon gevorderde mogelijkheden en meer diagnostische berichten.
_SBHD;

$para['command::tooltip_extern_commander'] = <<<_SBHD
Voer commandos uit in een pop-up venster - zonder te herladen na uitvoeren van ieder commando.
_SBHD;

$para['command::tooltip_filter_groups'] = <<<_SBHD
Gebruik filter voor gebruikers in plaats van selectie uit lijst
_SBHD;

$para['command::tooltip_filter_users'] = <<<_SBHD
Gebruik filter voor groepen in plaats van selectie uit lijst
_SBHD;

$para['command::tooltip_flat'] = <<<_SBHD
Exporteer de links alsof ze in een enkele map staan.
_SBHD;

$para['command::tooltip_hide_xslt'] = <<<_SBHD
Verberg mogelijkheden die XSLT browser-ondersteuning vereisen.
_SBHD;

$para['command::tooltip_hits'] = <<<_SBHD
Leid alle muiskliks op links langs de SiteBar server om gebruiks statistieken te kunnen genereren.
_SBHD;

$para['command::tooltip_ignore_https'] = <<<_SBHD
SiteBar kan HTTPS urls niet valideren. Indien dit niet aangevinkt is, zal de validatie voor alle verwijzingen zonder HTTP url falen.
_SBHD;

$para['command::tooltip_ignore_recently'] = <<<_SBHD
Test geen links die onlangs getest zijn - nuttig bij herhaalde validatie indien een vorige niet met succes eindigde.
_SBHD;

$para['command::tooltip_integrator_url'] = <<<_SBHD
Standaard gebruikt SiteBar de integrator van my.sitebar.org - maar het is mogelijk om de lokale integrator te gebruiken om privacy redenen.
_SBHD;

$para['command::tooltip_is_dead_check'] = <<<_SBHD
Deze link kwam niet door de validatie heen. U wilt hem wellicht toch actief houden.
_SBHD;

$para['command::tooltip_is_feed'] = <<<_SBHD
Markeer link als een feed - de link zal worden geopend in een 'RSS feed' lezer (indien geconfigureerd) en niet direct in de browser.
_SBHD;

$para['command::tooltip_load_all_nodes'] = <<<_SBHD
Laad alle folders; geschikt voor gebruikers met een relatief klein aantal links die filters willen gebruiken.
_SBHD;

$para['command::tooltip_popup_params'] = <<<_SBHD
Parameters voor de pop-up vensters van SiteBar. Maak deze leeg om de standaard waarde terug te krijgen.
_SBHD;

$para['command::tooltip_max_icon_age'] = <<<_SBHD
Hoe lang worden favicons in de tussenopslag bewaard, voordat ze opnieuw worden opgehaald bij de externe server.
_SBHD;

$para['command::tooltip_max_icon_cache'] = <<<_SBHD
FIFO stapel. De oudste iconen worden uit het systeem verwijderd - dit reguleert de maximale grootte van de tussenopslag.
_SBHD;

$para['command::tooltip_max_icon_size'] = <<<_SBHD
Maximale grootte van icoon in bytes.
_SBHD;

$para['command::tooltip_max_session_time'] = <<<_SBHD
De beheerder kan de maximaal toegestane sessie tijd instellen. Indien deze tijd wordt overschreden, moet de gebruiker opnieuw inloggen.
_SBHD;

$para['command::tooltip_menu_icon'] = <<<_SBHD
Sommige browsers/platformen kennen geen rechtermuisklik.
Dit zal een icoon tonen dat in plaats van een rechtermuisklik kan worden gebruikt om de context menus te tonen.
Het schakelt ook het met de muis slepen uit.
_SBHD;

$para['command::tooltip_mix_mode'] = <<<_SBHD
Mappen komen voor links in de SiteBar structuur, of andersom.
_SBHD;

$para['command::tooltip_novalidate'] = <<<_SBHD
Valideer deze link niet - te gebruiken voor links op een Intranet of indien de link problemen heeft met de validatie.
_SBHD;

$para['command::tooltip_paste_content'] = <<<_SBHD
Operatie toepassen op de inhoud van de map, en niet op de map zelf.
_SBHD;

$para['command::tooltip_private'] = <<<_SBHD
Prive links worden nooit getoond aan andere gebruikers, zelfs wanneer ze in een gedeelde map staan.
_SBHD;

$para['command::tooltip_private_over_ssl_only'] = <<<_SBHD
Prive links worden alleen geladen indien SiteBar wordt gebruikt over een SSL connectie.
_SBHD;

$para['command::tooltip_rename'] = <<<_SBHD
Hernoem dubbele links tijdens importeren zodat alles geladen kan worden.
_SBHD;

$para['command::tooltip_respect'] = <<<_SBHD
Verstuur een email enkel indien de gebruiker dit toestaat.
_SBHD;

$para['command::tooltip_search_engine_ico'] = <<<_SBHD
Icoon in de SiteBar werkbalk dat leidt naar een internet zoekopdracht.
_SBHD;

$para['command::tooltip_search_engine_url'] = <<<_SBHD
URL van de in te zetten zoekmachine. Gebruik %SEARCH% op de plaats waar het zoek-argument moet komen te staan.
_SBHD;

$para['command::tooltip_sender_email'] = <<<_SBHD
Door SiteBar gegenereerde emails zullen worden verstuurd met dit afzender adres.
_SBHD;

$para['command::tooltip_show_acl'] = <<<_SBHD
Markeer mappen met beveilingings indicatie.
_SBHD;

$para['command::tooltip_show_logo'] = <<<_SBHD
Toon een logo bovenin - liever uitzetten voor trage hosting servers, kan anders worden ingezet voor advertentie doeleinden.
_SBHD;

$para['command::tooltip_show_statistics'] = <<<_SBHD
Toon enkele statische en prestatie-statistieken in het SiteBar hoofdpaneel.
_SBHD;

$para['command::tooltip_subdir'] = <<<_SBHD
Recursieve export van alle links en mappen.
_SBHD;

$para['command::tooltip_subfolders'] = <<<_SBHD
Valideer deze map recursief met alle submappen.
_SBHD;

$para['command::tooltip_to_verified'] = <<<_SBHD
Verstuur emails enkel naar geverifieerde adressen.
_SBHD;

$para['command::tooltip_use_compression'] = <<<_SBHD
De paginas die SiteBar verstuurt kunnen worden gecomprimeerd om bandbreedte te sparen.
Compressie wordt alleen toegepast indien de browser dit ondersteunt.
_SBHD;

$para['command::tooltip_use_conv_engine'] = <<<_SBHD
Gebruik een vertaalprogramma (gewoonlijk een PHP extensie) om paginas met een andere encoding te converteren
 - belangrijk bij het importeren en exporteren van favorieten.
Dit kan lege vensters veroorzaken bij enkele browser-implementaties.
_SBHD;

$para['command::tooltip_use_favicon_cache'] = <<<_SBHD
Favicons worden gewoonlijk opgehaald naar de database tussenopslag op de server en verstuurd op verzoek van bezoekende browsers.
Deze setting versnelt dit verkeer en ook de toegang tot de favicon tussenopslag doordat het aantal connecties tot de servers op afstand beperkt wordt.
_SBHD;

$para['command::tooltip_use_favicons'] = <<<_SBHD
Het gebruiken van favicons maakt Sitebar mooier maar ook trager.
Indien een tussenopslag voor favicons wordt geactiveerd, versnelt dat het tonen van favicons aanzienlijk.
_SBHD;

$para['command::tooltip_use_hiding'] = <<<_SBHD
Activeer het commando om mappen te kunnen verbergen.
De gepubliceerde mappen van andere gebruikers kunnen worden verborgen.
_SBHD;

$para['command::tooltip_use_mail_features'] = <<<_SBHD
Indien deze PHP installatie de &ldquo;mail&rdquo; functie toelaat, kunnen e-mail faciliteiten worden geactiveerd.
_SBHD;

$para['command::tooltip_use_new_window'] = <<<_SBHD
Open alle links in een nieuw venster via een _blank doel.
_SBHD;

$para['command::tooltip_use_outbound_connection'] = <<<_SBHD
Sommige faciliteiten (favicon tussenopslag) vereisen toegang tot externe IP adressen vanuit uw server.
_SBHD;

$para['command::tooltip_use_search_engine'] = <<<_SBHD
Sta toe dat zoekopdrachten kunnen worden omgeleid naar,
of dat de zoekresultaten worden uitgebreid met resultaten uit,
een web zoekmachine naar keuze.
_SBHD;

$para['command::tooltip_use_search_engine_iframe'] = <<<_SBHD
De resultaten van uw web zoekmachine worden toegevoegd aan de SiteBar zoekresultaten via een inline frame.
_SBHD;

$para['command::tooltip_use_tooltips'] = <<<_SBHD
Gebruik Sitebar tekstballonnen in plaats van die van de browser.
Dit maakt langere teksten mogelijk, evenals ondersteuning voor meer browsers.
_SBHD;

$para['command::tooltip_use_trash'] = <<<_SBHD
Markeer verwijderde mappen en links zodat hun verwijdering definitief danwel ongedaan gemaakt kan worden.
_SBHD;

$para['command::tooltip_users_must_be_approved'] = <<<_SBHD
Gebruikers moeten door de beheerder worden goedgekeurd alvorens ze Sitebar kunnen gebruiken.
_SBHD;

$para['command::tooltip_users_must_verify_email'] = <<<_SBHD
Gebruikers moeten hun email adres verifieren alvorens ze Sitebar kunnen gebruiken.
_SBHD;

$para['command::tooltip_verified'] = <<<_SBHD
Vink dit aan om het email adres als geverifieerd te markeren.
_SBHD;

$para['command::tooltip_version_check_interval'] = <<<_SBHD
SiteBar kan regelmatige controles uitvoeren op de beschikbaarheid van nieuwe versies. Dit kan belangrijk zijn ingeval een zwakte in de huidige versie ontdekt wordt. Een uitgaande verbinding is vereist.
_SBHD;

$para['command::tooltip_web_search_user_agents'] = <<<_SBHD
Een reguliere expressie voor User Agents, voor een speciale niet-javascript gebaseerde schrijver.
_SBHD;

$para['sitebar::users_must_verify_email'] = <<<_SBHD
Deze Sitebar installatie vereist email verificatie.
Verifieer alstublieft uw email adres, anders kan uw account verwijderd worden.
_SBHD;

$para['sitebar::tutorial'] = <<<_SBHD
Het icoon bovenin met uw gebruikersnaam is de bron-map voor uw favorieten.
Klik erop met de rechtermuisknop en kies het commando "%s" om uw eerste favoriet toe te voegen.
_SBHD;

$para['sitebar::invitation'] = <<<_SBHD
Gebruiker <strong>%s</strong> wil zijn favorieten delen
en stuurt een uitnodiging om lid van zijn groep <strong>%s</strong> te worden.
_SBHD;

$para['usermanager::signup_info'] = <<<_SBHD
Gebruiker %s heeft zich aangemeld bij uw SiteBar installatie op %s.
_SBHD;

$para['usermanager::signup_info_verified'] = <<<_SBHD
Gebruiker %s heeft zich aangemeld bij uw SiteBar installatie op %s.
De gebruiker heeft zijn email adres al geverifieerd.
_SBHD;

$para['usermanager::signup_approval'] = <<<_SBHD
Gebruiker %s heeft zich aangemeld bij uw SiteBar installatie op %s.

Account goedkeuren:
  %s

Account weigeren:
  %s

Bekijk wachtende gebruikers:
  %s
_SBHD;

$para['usermanager::signup_approval_verified'] = <<<_SBHD
Gebruiker %s heeft zich aangemeld bij uw SiteBar installatie op %s.
De gebruiker heeft zijn email adres al geverifieerd.

Account goedkeuren:
  %s

Account weigeren:
  %s

Bekijk wachtende gebruikers:
  %s
_SBHD;

$para['usermanager::alert'] = <<<_SBHD
%s
_SBHD;

$para['messenger::cancel'] = <<<_SBHD
Herstel
_SBHD;

$para['messenger::delete'] = <<<_SBHD
Verwijderen
_SBHD;

$para['messenger::expire'] = <<<_SBHD
Laat verlopen
_SBHD;

$para['messenger::read'] = <<<_SBHD
Gelezen
_SBHD;

$para['messenger::unread'] = <<<_SBHD
Ongelezen
_SBHD;

$para['messenger::save'] = <<<_SBHD
Opslaan
_SBHD;

$para['messenger::state_unread'] = <<<_SBHD
Ongelezen
_SBHD;

$para['messenger::state_seen'] = <<<_SBHD
Gezien
_SBHD;

$para['messenger::state_read'] = <<<_SBHD
Gelezen
_SBHD;

$para['messenger::state_saved'] = <<<_SBHD
Opgeslagen
_SBHD;

$para['messenger::state_deleted'] = <<<_SBHD
Verwijderd
_SBHD;

$para['messenger::state_expired'] = <<<_SBHD
Verlopen
_SBHD;

$para['hook::statistics'] = <<<_SBHD
Bronnen {roots_total}.
Mappen {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Gebruikers {users}.
Groepen {groups}.
SQL queries {queries}.
DB/Totale tijd {time_db}/{time_total} sec ({time_pct}%).
_SBHD;

$para['groupname::Family'] = <<<_SBHD
Familie
_SBHD;

$para['groupname::Friends'] = <<<_SBHD
Vrienden
_SBHD;

$para['groupname::Public'] = <<<_SBHD
Publiek
_SBHD;

?>
