<?php

$para['integrator::welcome'] = <<<_P
Velkommen til SiteBar Integrering. Her kan du legge inn SiteBars Online Bokmerker som panel i din nettleser, og få mest mulig ut av SiteBar. Du finne bla. også bookmarklet for kjapt å legge inn nye bokmerker - mens du surfer.
_P;

$para['integrator::header'] = <<<_P
SiteBar er utviklet for å fungere med de fleste standard nettlesere som støtter javascript og cookies. Tabellen nedenfor viser nettlesere som er testet og som virker med SiteBar. Velg din nettleser, og følg instruksjonene nedenfor.
_P;

$para['integrator::usage_opera'] = <<<_P
<@>SiteBar bruker høyre + klikk for å åpne kontekstmenyer på lenker og mapper.
Men Opera-brukere må bruke Ctrl + Høyreklikk, eller skru på visning av "Meny-ikonet"
i sine "Brukerinnstillinger", og klikke på det istedet. Grunnen er at Opera ikke støtter
<a href="http://no.wikipedia.org/wiki/XSLT">XSLT</a>.
Operabrukere anbefales også å slå av XSLT i SiteBar-panelets Brukerinnstillinger.
_P;

$para['integrator::hint'] = <<<_P
Klikk over på navnet på din nettleser for å få veiledningen i hvordan du integrerer SiteBar i din nettleser. <a href="http://brablc.com/mailto?o">Meld fra</a> hvis du har verifisert andre nettlesere/platformer.
_P;

$para['integrator::hint_window'] = <<<_P
Vanlig lenke. Klikk på denne for å åpner SiteBar i nettleserens vindu. MERK! Siden SiteBar
er laget for å vises i et panel er dette en løsning bare for brukere som bruker
eldre nettlesere som ikke har panel.
_P;

$para['integrator::hint_dir'] = <<<_P
SiteBar kan nå også vises som en tradisjonell emnekatalog, ved siden av å
kunne vises som et filtre. I denne visningen vises en og en mappe samt
beskrivelsen for hver lenke i mappa. For å kunne bruke denne visningen
må nettleseren din støtte <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Bruke denne bookmarkletten&#42; hvis du har en gammel nettleser uten sidepanel.
Den vil åpne SiteBar i et sprettopp-vindu, på lignende måte som i et panel.
OBS! Virker ikke hvis nettleseren din blokkere sprettoppvinduer.
_P;

$para['integrator::hint_iframe'] = <<<_P
URL-en på venstre side åpner SiteBar i en <IFRAME>. Det er nyttig når du trengerå
bake inn SiteBar på forskjellige portaler som bla:

<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a>
<li><a href="http://www.netvibes.com/">Netvibes</a>
</ul>
Besøk portalen, og finn en plass hvor du kan legge inn innhold. Kopier denne URL-en <strong>%s</strong>
og dermed skulle du ha ny skaffet deg et nytt utstyr (merk at https vanligvis ikke støttes av portaler,
Men, du kan imidlertid bruke https i fila iframe.php). Merk at ditt brukernavn/passord <strong>IKKE</strong>
blir formidlet til portalen. Brukere av MSIE kan måtte tillate cookies for SiteBars tjenerdomene.
_P;

$para['integrator::hint_addpage'] = <<<_P
Bruk denne bookmarkleten&#42; for å ta bokmerke av den siden du viser i nettleseren
din direkte. Når du legge den opp på verktøylinja di. Klikker du på den når
du vil legge inn en lenke til den i dine SiteBar bokmerkesamling. Du får
da opp et sprettoppvindu som automatisk er fyllt med URL og detaljene
fra den viste siden.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> (favlet) er et bokmerke / favoritt med et spesiell javascriptkode
som gjør at den fungere som en snarvei for å legge inn nye bokmerker i SiteBar med ett klikk. Meningen er at du skal legge opp
denne lenka på verktøylinja i nettleseren, og så bruke den som en snarvei for hver gang du kommer til en side du vil legge inn.
Enten høyreklikker du på bookmarkleten og legger den inn i dine bokmerker, slik at den vises på verktøylinja. Eller så klikk og
dra den opp på vertøyfeltet under menylinja i nettleseren din (OBS! forutsetter at du fra filmenyen i nettleseren din har valgt
å vise Lenker (MSIE) / Bookmarks toolbar (FireFox) / personlig verktøylinje (Opera).</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Legger til SiteBar Bokmerkesøk i ditt websøkefelt. Tillater søking i SiteBar-bokmerker uten å måtte åpne SiteBar først.
_P;

$para['integrator::hint_sitebar'] = <<<_P
<@>Tillegg utviklet spesielt for SiteBar. Tillater deg å åpne alla lenkene i en mappe i hver sin arkfane, og andre nyttige funksjoner. Bruk menyen "View/Toolbar/Customize" for å legge SiteBar-ikoner inn på verktøylinja.
[<a href="http://sitebarsidebar.mozdev.org/">Projektsidan</a>]
_P;

$para['integrator::hint_bmsync'] = <<<_P
For å kunne toveis-synkronisering med Firefox må du installere ekstensjonen Bookmark Synchronizer.
Bruk kommandoen "Brukerinnstillinger -> XBELSync-innstillinger" for nærmere informasjon om hvordan
synkronisering skal settes opp.

[<a href="http://sitebar.org/downloads.php">Mer informasjon</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Oppretter et bokmerke som senere kan klikkes på for å åpen SiteBar-panelet.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Last ned hele mappestrukturen i dine SiteBar online bokmerker, til en fil. Importer denne filen til dine bokmerker. Hver av mappene funker nå som Live Bookmark. Det vil si at på denne måten vil dine bokmerker bli integrert blandt dine andre bokmerker, mens mappeinnholdet vil funke online - nedlastet fra SiteBar. Om en mappe har undermapper, vil innholdet i mappa vises i mappa @Content.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Legger inn SiteBar som sidepanel [sidebar]. Dette panelet kan vises/skjules med [F9]. OBS! Hvis SiteBar ikke lastes ned i panelet innen for en gitt tidsramme, vil Mozilla ikke kunne vise den. Du anbefales å åpne SiteBar i hovedvinduet i nettleseren din og å mellomlagre lenkeikoner (favicons) i webleseren, eller rett og slett å slå av visning av lenkeikoner i dine "Brukerinnstillinger".
_P;

$para['integrator::hint_sidebar_konqueror'] = <<<_P
Følg denne fremgangsmåten:
<ol>
<li>Åpne Konqueror
<li>Gå til menyen "Window -> Show Navigation Panel (F9)"
<li>Høyreklikk på ikonlinja helt til venstre i navigasjonspanelet under ikonene.
<li>Velg "Add New -> Web SideBar Module" - et nytt ikon vil legges til med titelen "Web SiteBar Plugin".
<li>Høyreklikk det nye ikonet og velg "Set Name", og skrive b>SiteBar</b> der.
<li>Høyreklikk på det nye ikonet og velg "Set Url", og skrive <b>%s</b> der.
<li>Klikk på ikonet for å åpne SiteBar i sidepanelet.
</ol>
_P;

$para['integrator::hint_hotlist'] = <<<_P
<@>En lenke til SiteBar vil vises i bokmerkepanelet [Hotlistpanel]. Ett klikk på den vil åpne SiteBar i Operas sidepanel.
_P;

$para['integrator::hint_install'] = <<<_P
Installerer SiteBar til IE's Explorer-felt og kontekstmeny. Siden dette krever endring i registeret må du starte maskinen på nytt for å se alle funksjonene. Hvis du ikke har fulle rettigherer kan noen av funksjonene ikke bli installert.<br> Du åpner SiteBars i Explorer-feltet fra menylinja. Velg Vis/Explorer-felt (View/Explorer Bar). Eller legg til SiteBar som en knapp på verktøylinja slik: På menylinja, velg <b>Verktøylinjer</b> på <b>Vis</b>-menyen. Velg deretter <b>Tilpass</b>. Finn fram til SiteBar i høyre felt og velg legg til.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Avinstallerer SiteBar fra verkttøyfeltet (se over).
_P;

$para['integrator::hint_searchbar'] = <<<_P
For deg som mangler privilegier for å få installert SiteBar i Explorer-feltet. Bruk denne bookmarklett&#42;. Den åpner SiteBar midlertidig i MSIEs Explorer-felt.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Last ned en plugin (med forhåndsinnstilt URL). Arkivet må pakkes ut til mappa "C:Program FilesMaxthonPlugin". Etter at du starter opp på nytt, har du et nytt valg i Explorer-feltet.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Last ned en plugin (med forhåndsinnstilt URL). Arkivet må pakkes ut til mappa "C:Program FilesMaxthonPlugin". Etter ommstart vil et nytt ikon vises i verktøyfeltet Plugin. Klikk på dette ikonet så blir aktiv nettside lagt til SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Kjør kommandoen <strong>emerge sitebar</strong> for å installere SiteBar-pakka.
_P;

$para['integrator::hint_debian'] = <<<_P
Kjør kommandoen <strong>apt-get install sitebar</strong> for å installere SiteBar-pakka.
_P;

$para['integrator::hint_phplm'] = <<<_P
"PHP Layers Menu" er et meget effektivt hierarkisk menysystem for dynamiska nettsider (DHTML) som sparer båndbredde ved å behandle data på tjeneren, og ikke hos klienten (PHP). SiteBar kan mate den med bokmerker i en korrekt struktur. Hvis det på din tjener er tillatt for fopen å åpne eksterne filer, vil følgende kode laste fil med korrekt struktur:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright &copy; 2003-2005 <a href="http://brablc.com/">Ondřej Brablc</a> og <a href='http://sitebar.org/team.php'>SiteBar-teamet</a>. Support <a href='http://sitebar.org/forum.php'>forum</a> og <a href='http://sitebar.org/bugs.php'>bug</a>-sporing.
_P;

$para['command::welcome'] = <<<_P
%s, velkommen til SiteBar!
%s
<p>
Bruk høyreklikk på mappe eller lenke for å håndtere dine lenker. <p> 
Alternativt kan du skru på alternativet "%s" i "%s" slik at du kan klikke på et menyikon i stedet.<p> 
Du er nå logget inn.
_P;

$para['command::signup_verify'] = <<<_P
<p>
For å aktivere din SiteBar-konto må du verifisere
at epostadressen du oppga er din.
<p>
Du motta straks en epost med en lenke. Klikk
på den for å verifisere.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Før du kan bruke din SiteBar-konto må en administrator
godkjenne den.
<p>
Når den er godkjent, vil du motta en epostmelding om det.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
For å aktivere din konto må du verifisere at
epostadressen du oppga er din. Dernest må en
administrator godkjenne den.
<p>
Du motta straks en epost med en lenke for å
verifisere epostadressen. Klikk på den for å
verifisere. Din konto blir så aktivert såsnart
en administrator godkjenner den. Når det skjer
blir du varslet pr epost.
_P;

$para['command::account_approved'] = <<<_P
Administrator har godtkjent din konto.
Logg deg inn med ditt brukernavn %s.

--
SiteBar-installasjonen ved %s.
_P;

$para['command::account_rejected'] = <<<_P
Administrator har avvist din forespørsel om konto
med brukernavnet %s.

--
SiteBar-installasjonen ved %s.
_P;

$para['command::account_deleted'] = <<<_P
Administrator har slettet din inaktive konto
med brukernavnet %s.

--
SiteBar-installasjonen ved %s.
_P;

$para['command::reset_password'] = <<<_P
Det er bedt om en fornyelse av passordet for din SiteBar-konto med epostadressen "%s".

Hvis det er du som har bedt om dette, og du virkelig ønsker å fornyet passordet,
klikk på følgende lenke:
    %s


--
SiteBar-installasjonen finner du her %s.
_P;

$para['command::leave_group'] = <<<_P
<p>
Når du forlater en gruppe så trenger du en invitasjon for å
kunne slutte deg til gruppa igjen. For å få en invitasjon
må du kontakte gruppens eier - du må da kjenne til 
vedkommendes epostadresse eller brukernavn i SiteBar.
_P;

$para['command::use_comma'] = <<<_P
Bruk komma for å separere brukernavn. Brukere vil bli medlemmer kun når de bekrefter
din invitasjon.
_P;

$para['command::reset_password_hint'] = <<<_P
<p>Fyll inn ditt brukernanv eller din registrerte
epostadresse. Et bevis (token) blir sendt til din registrerte
epostadresse. Bruk dette beviset for å resette passordet ditt.
_P;

$para['command::contact'] = <<<_P
Melding:

%s


--
SiteBar-installasjon %s.
_P;

$para['command::contact_group'] = <<<_P
Gruppe: %s
Melding:

%s


--
SiteBar-installasjon %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Vil du virkelig slette din konto?</h3>
Merk at det ikke er noen måte å angre denne endringen!<p>
_P;

$para['command::email_link_href'] = <<<_P
<p>Klikk <a href="mailto:?subject=Web site: %s&body=Jeg har funnet et nettsted som jeg tror vil interessere deg.
Se: %s
--
 Sendt deg via SiteBar Bokmerkehåndtering ved %s
 Lær mer om SiteBar http://sitebar.org
">her</a> for å sende en epost med din standard epost-leser.
_P;

$para['command::email_link'] = <<<_P
Jeg har funnet et websted som du kansje er interessert i.
Ta en kikk på:

    "%s" %s

%s

--
Sendt deg via SiteBar %s
Bokmerketjener i åpen kildekode http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Du har valgt å bruke epostverifikasjon, noe som 
lar deg bruke SiteBars epost-funksjoner.

Klikk på følgende lenke for å verifisere din epost:

    %s

Se bort fra denne eposten, hvis du ikke har 
startet noen epostverifikasjon fra SiteBar Bokmerkehåndtering
_P;

$para['command::verify_email_must'] = <<<_P
Du har tegnet deg for en SiteBar-konto. Du må verifisere
den oppgitte epostadressen før du kan bruke kontoen.

Klikk på følgende lenke for å verifisere din epostadresse:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer har støtte for å importere og eksportere bokmerker i filformatet for Netscapes bokmerker. Men fila må være i Windows standard tegnkoding. UTF-8 fungerer ikke.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Bokmerker i Internet Explorer kan eksportere til filformatet for Netscapes bokmerker fra menylinja
i menyen "Fil/Importer og Eksporter ...".
Den eksporterte fila har imidlertid den tegnkode som du har på din Windows-innstallasjon - vennligst
velg denne tegnkoden (encoding), når du importerer fila, Standardverdien UTF-8 fungerer ikke.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Tegnkode-konvertering er ikke installert på denne SiteBar-tjeneren. Kun UTF-8 og ISO-8859-1 er støttet.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rights:
L<strong>e</strong>s,
<strong>L</strong>egg til,
<strong>M</strong>odifiser
<strong>S</strong>lett
_P;

$para['command::purge_cache'] = <<<_P
<h3>Vil du virkelig fjerne alle favikoner fra mellomlageret?</h3>
_P;

$para['command::tooltip_allow_addself'] = <<<_P
La brukere legge seg til gruppen.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Skru på direkte nedlastng av bokmerke eller feed for anonym bruker. Kan omgås hvis bruker vet hvordan URL-er dannes!
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Tillat admin å bli kontaktet av anonym bruker.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
La gruppemoderatorer bli kontaktet av ikke-medlemer.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Hvis dette ikke tillates, vil alle brukere bruke søkemaskinen som er satt i dette skjemaet, og vil ikke kunne modifisere den.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Tillat administratorer og moderatorer av grupper jeg tilhører å sende meg epost.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Tillat brukere tilgang til registreringsskjemaet i SiteBar
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
La brukere opprette sine egne grupper. I motsatt fall vil bare admin ha dette privilegiet.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
La brukerne slette deres eksisterende trære.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
La brukere opprette ekstra trær.
_P;

$para['command::tooltip_approved'] = <<<_P
Kontoen er godkjent og kan brukes fullt ut.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Ikke vis kommandokjørestatus i tilfelle suksess.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Hent favicom automatisk når det mangler eller lenke legges til.
_P;

$para['command::tooltip_baseurl'] = <<<_P
URL etter etterfølgende / peker til denne installasjonen
_P;

$para['command::tooltip_default_groups'] = <<<_P
Liste over grupper som vil bli opprettet for brukere som ikke har noen grupper. Bruk | for å separere gruppenavn.
_P;

$para['command::tooltip_public_groups'] = <<<_P
Liste over grupper som vil være tilgjengelige for annonyme brukere.
_P;

$para['command::tooltip_cannot_leave'] = <<<_P
brukere kan ikke forlate denne gruppa, Bare moderator kan avslutte medlemssakap.
_P;

$para['command::tooltip_cmd'] = <<<_P
Legg til de viktigste kommandoene i Sitebar for gjøre det lettere å logge inn.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Vis kommandoer for import og eksport av lenkebeskrivelser.
_P;

$para['command::tooltip_comment_limit'] = <<<_P
Det er mulig å spesifisere maksimum lengde på en lenkekommentar. Det er mulig å lagre små filer som kommentarer.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Neste gang du bruker bookmarklet vil denne mappa være satt som standard.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Slett kun mappas innhold, og ikke mappa selv.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Slett favikon-URL-er fra lenker hvis faviko er ugyldig - bruk dette med forsiktighet.
_P;

$para['command::tooltip_demo'] = <<<_P
Gjør dette til en demokontoen med begrenset funksjonalitet og ikke mulighet til å endre passord.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Analyser siden og finn favikoner (snarveisikoner) som mangler.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Rotmappa vil ikke bli inkludert ved utmating (output) hvis mulig.
_P;

$para['command::tooltip_expert_mode'] = <<<_P
Vis avanserte funksjoner og vis flere diagnostiske meldinger.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Kjør kommandoer i et eksternt vindu - uten gjenopplasting etter hver kommando.
_P;

$para['command::tooltip_filter_groups'] = <<<_P
Bruk filter for brukere i stedet for listeboks
_P;

$para['command::tooltip_filter_users'] = <<<_P
Bruk filter for grupper i stedet for listeboks.
_P;

$para['command::tooltip_flat'] = <<<_P
Eksporter lenkene som om de var i en mappe.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Skjul egenskaper som må ha nettlesere med XSLT-støtte.
_P;

$para['command::tooltip_hits'] = <<<_P
Rut alle klikk og lenker via SiteBar-tjeneren for å generere brukerstatistikk.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Ikke test lenker som nylig er testet - brukes for gjentatt validering når en tidligere ikke ble avsluttet.
_P;

$para['command::tooltip_integrator_url'] = <<<_P
Som standard bruker SiteBar en integrator fra my.sitebar.org, men det er mulig å bruke din lokale integrator når personvernhensyn tilsier det.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Denne lenka bestod ikke validering. Du vil kanskje fortsatt beholde den som aktiv.
_P;

$para['command::tooltip_is_feed'] = <<<_P
Sett lenke som feed - lenka åpnes da i en feed-leser (hvis satt opp) snarere enn direkte i nettleseren.
_P;

$para['command::tooltip_join_on_signup'] = <<<_P
Hver nye bruker vil bli medlem av denne gruppa.
_P;

$para['command::tooltip_load_all_nodes'] = <<<_P
Last alle mapper. Passe for brukere med et lite antall lenker som ønsker å bruke filtrering.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Hvor lenge skal favicon forbli i cacheen før det oppfriskes fra sitt nettsted.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
FIFO-stack. De eldste ikoner kasseres fra systemet - brukes for å kontrollere størrelsen på cacheen.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Maks tillatt størrelse på ikon i byte.
_P;

$para['command::tooltip_max_session_time'] = <<<_P
Administrator kan sette maksimum tillatt sessjonstid. Når denne tiden overskrides, må brukeren logge inn på nytt.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Noen nettlesere/platformer har ikke høyreklikk. Dette vil vise et ikon ved hver lenke som får fram en kontekstmeny når du klikker på den.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Mappe kommer foran lenker i SiteBars tre eller omvendt.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Ikke valider denne lenka - til bruk på intranet-lenker eller lenker som har problemer med validering.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Bruk operasjonen kun på mappas innhold, ikke på mappa selv.
_P;

$para['command::tooltip_private'] = <<<_P
Private lenker blir aldri vist for andre brukere selv om de er i en delt mappe.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Private lenker lastes bare hvis SiteBar kjører over en SSL-forbindelse.
_P;

$para['command::tooltip_rename'] = <<<_P
Ved import, gi nytt navn til alle duplikatlenker slik at alt lastes.
_P;

$para['command::tooltip_respect'] = <<<_P
Send epost kun hvis bruker har tillatt det.
_P;

$para['command::tooltip_search_engine_ico'] = <<<_P
Ikoner som blir vist i SiteBars verktøylinje og foran et websøk.
_P;

$para['command::tooltip_search_engine_url'] = <<<_P
URL-en til søkemaskinen som skal brukes ved søking. Bruk %SEARCH% på steder der søkestrengen skal inn.
_P;

$para['command::tooltip_sender_email'] = <<<_P
SiteBar-generert epost vil bli sendt til denne adressen.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Dekorer mapper med sikkerhetsspesifikasjon.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Vis logo øverst - kan slås av for trege verter, eller kan brukes for avertering.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Vis noe statistikk (ytelse) i panelet.
_P;

$para['command::tooltip_subdir'] = <<<_P
Eksporter alle lenker og mapper rekursivt.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Valider denne mappa rekursivt med alle undermapper.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Sen epost bare til verifiserte adresser.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Sider sendt med SiteBar kan komprimeres for å spare båndbredde. Komprimering blir bare brukt mot nettlesere som støtter det.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Bruk konverteringsmotor (vanligvis en PHP-ekstensjon) for å konvertere sider med forskjellige koding - viktig for import og eksport av bokmerker.  Kan føre til blank skjerm på noen installasjoner dog.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Favikoner lastes ned til tjeneren til databasecacheen og sendes på forespørsel fra klienter. Øker trafikken og setter fart i favikon-cacheen ved å redusere antallet tjenere du har tilkobling til.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Bruk av favikoner gjør Sitebar penere men tregere. Bruker du imidlertid favicon-buffer, vises faviconene betydelig raskere.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Tillatt kommando for å skule mapper. Skjuling brukes for andre brukeres publiserte mapper.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
I tilfelle denne PHP-installasjonen tillater bruk av "mail"-funksjonen - så kan epost-egenskaper settes på.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Noen funksjoner (favicon cache) krever tilgang til fjernadresser fra din tjener.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
La søk bli redirigert eller forsterket med resultater fra din yndlingssøkemaskin.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Resultatene fra din søkemaskin vil bli inkluder i SiteBars søkeresultater i en ramme.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Bruk SiteBars verktøytips i stedet for de som er innebygd i nettleser. Tillater lengere tips og har støtte for flere nettlesere.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Merk sletteder mapper og lenker slik at de kan angres eller ryddes vekk.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Brukere må godkjennes av admin før de kan bruke SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Brukere må verifisere epostadressen før de kan bruke SiteBar
_P;

$para['command::tooltip_verified'] = <<<_P
Kryss av her for å merke denne eposten som verifisert.
_P;

$para['command::tooltip_version_check_interval'] = <<<_P
SiteBar kan regelmessig sjekke om en ny versjon er tilgjengelig. Viktig i tilfelle sårbarhet blir oppdaget i gjeldende versjon. Dette krever en utgående nettforbindelse.
_P;

$para['command::tooltip_web_search_user_agents'] = <<<_P
Et regulært uttrykk for Brukeragenter som trenger en spesiell ikke-javaskriptbasert writer.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Denne SiteBar-installasjonen krever epost-verifikasjon.
Hvis du ikke verifiserer din epost, blir kontoen du opprettet slettet.
_P;

$para['sitebar::tutorial'] = <<<_P
Ikonet med ditt brukernavn over, er rotmappa for dine bokmerker.
Høyreklikk på den og velg kommandoen "%s" for å legge til
ditt første bokmerke.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Din epostadresse passer med regler for automatisk deltakelse i
følgede lukkede gruppe(r):
    %s.

For å godkjenne ditt medlemsskap, må din epostadresse verifiseres.
Vennligst klikk på følgende lenke for å verifisere den:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Brukeren %s har registrert seg på din SiteBar-installasjon ved %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Brukeren %s tegnet seg på din SiteBar-installasjon ved %s.
Brukeren har allerede verifisert sin epostadresse.
_P;

$para['usermanager::signup_approval'] = <<<_P
Bruker %s registrerte seg på din SiteBar-installation ved %s.

Godkjenn konto:
    %s

Avvis konto:
    %s

Se ventende brukere:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Brukeren %s registrerte seg på din SiteBar-installasjon ved %s.
Brukeren har allerede verifisert sin epostadresse.

Godkjenn konto:
    %s

Avvis konto:
    %s

Se ventende brukere:
    %s
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['messenger::cancel'] = <<<_P
Avbryt
_P;

$para['messenger::delete'] = <<<_P
Slett
_P;

$para['messenger::expire'] = <<<_P
Utgar
_P;

$para['messenger::read'] = <<<_P
Lest
_P;

$para['messenger::unread'] = <<<_P
Ulest
_P;

$para['messenger::save'] = <<<_P
Lagre
_P;

$para['messenger::state_unread'] = <<<_P
Ulest
_P;

$para['messenger::state_seen'] = <<<_P
Sett
_P;

$para['messenger::state_read'] = <<<_P
Lest
_P;

$para['messenger::state_saved'] = <<<_P
Lagret
_P;

$para['messenger::state_deleted'] = <<<_P
Slettet
_P;

$para['messenger::state_expired'] = <<<_P
Utgått
_P;

$para['hook::statistics'] = <<<_P
Røtter {roots_total}.
Mapper {nodes_shown}/{nodes_total}.
Lenker {links_shown}/{links_total}.
Brukere {users}.
Grupper {groups}.
SQL-spørringer {queries}.
DB/Total tid {time_db}/{time_total} sec ({time_pct}%).
_P;

$para['groupname::Family'] = <<<_P
Familie
_P;

$para['groupname::Friends'] = <<<_P
Venner
_P;

$para['groupname::Public'] = <<<_P
Offentlig
_P;

?>
