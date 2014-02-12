<?php

$para = array();

$para['integrator::welcome'] = <<<_SBHD
Välkommer till SiteBar integrationssida. Denna sida hjälper dig fa ut det mesta ur SiteBar. Pa <a href="http://sitebar.org/">SiteBars hemsida</a> kan du lära dig mer om funktionerna i SiteBar.
_SBHD;

$para['integrator::header'] = <<<_SBHD
SiteBar är utvecklat för att fungera med webbläsare som följer den uppsatta standarden och ska fungera pa de flesta webbläsare med javascript och cookies paslagna. Följande tabell visar vilka webbläsare SiteBar har testats pa.
_SBHD;

$para['integrator::usage_opera'] = <<<_SBHD
SiteBar-användare högerklickar för att visa innehållsmenyerna för länkar och mappar.
Som Operaanvändare maste du markera "Visa Menyikon" i "Användarinställningar och sedan vänsterklicka på bokmärkes- eller mappikonen för att öppna menyn.
Även Ctrl + vänsterklick på texten vid bokmärkes- eller mappikonen fungerar.
_SBHD;

$para['integrator::hint'] = <<<_SBHD
Klicka pa namnet för din webbläsare här ovan för att fa integrationsinstruktioner. Var god <a href="http://brablc.com/mailto?o">rapportera</a> andra testade webbläsare/plattformer.
_SBHD;

$para['integrator::hint_window'] = <<<_SBHD
Detta är en vanlig länk som öppnar SiteBar i det detta fönster.
SiteBar är utvecklad för en vertikal, smal spalt layout. Om du öppnar det i detta fönster kommer mycket fönsterutrymme att vara outnyttjat.
_SBHD;

$para['integrator::hint_dir'] = <<<_SBHD
Förutom det trädlika utseendet kan SiteBar visas som en traditionell katalog.
Detta utseende visar en katalog at gangen och visar detaljer för länkarna.
Webbläsaren maste stödja <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_SBHD;

$para['integrator::hint_popup'] = <<<_SBHD
Om din webbläsare inte har sidopanelfunktionen kan du använda denna bookmarklet* istället.
Den öppnar SiteBar i ett pop-up fönster liknande en sidopanel. Var god observera det faktum att din webbläsare kan vara inställd att blockera pop-ups.
_SBHD;

$para['integrator::hint_iframe'] = <<<_SBHD
URLen på vänster sida ger dig möjlighet att placera SiteBar i en <IFRAME>. Det är lämpligt för att integrera SiteBar i olika portaler som:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a></li>
<li><a href="http://www.netvibes.com/">Netvibes</a></li>
</ul>
Besök portalen, hitta ett ställe där du kan lägga till innehåll. Kopiera och klistra in denna URL <strong>%s</strong> och en ny enhet ska ha skapats (kom ihåg att https normalt inte stöds av portaler, men du kan använda https i en iframe.php). Notera att ditt användarnamn/lösenord <strong>INTE</strong> visas på portalen. MS IE-användare kan behöva tillåta cookies för SiteBar-serverdomänen.
_SBHD;

$para['integrator::hint_google'] = <<<_SBHD
Använder IFRAME också, men är anpassad för visning på Google Personalized Homepage.
Använd <strong>Lägg till</strong> och denna URL <strong>%s</strong>.
_SBHD;

$para['integrator::hint_addpage'] = <<<_SBHD
Denna bookmarklet* kan användas för att lägga till länkar till SiteBar. När den körs visas ett nytt pop-up fönster som kommer att fyllas med detaljer fran den nuvarande sidan.
_SBHD;

$para['integrator::hint_bookmarklet'] = <<<_SBHD
&#42; <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> är ett bokmärke/favorit som innehaller JavaScript-kod. Du kan högerklicka pa den och lägga till det till ditt bokmärke/favorit verktygsfält. Efterföljande klick pa detta bokmärke kommer att köra JavaScript-koden</i>
_SBHD;

$para['integrator::hint_search_engine'] = <<<_SBHD
Lägger till SiteBar bokmärkessökning till webbsökningsfältet. Tillater sökning bland bokmärkena i SiteBar utan att ha SiteBar öppnad.
_SBHD;

$para['integrator::hint_sitebar'] = <<<_SBHD
Tillägg utvecklat speciellt för SiteBar.
Tillåter dig att öppna alla bokmärken i olika flikar från en SideBar samt många andra funktioner.
Använd menyn "Visa/Verktygsfält/Anpassa..." för att lägga till SiteBar-ikoner i ditt verktygsfält.
_SBHD;

$para['integrator::hint_bmsync'] = <<<_SBHD
Var god installera Bokmärkessynkroniseringstillägget för att kunna använda dig av tvavägssynkronisering med Firefox. Använd kommandot "Användarinställningar -> XBELSync Settings" för mer information om hur du ställer in synkroniseringen.
[<a href="http://sitebar.org/downloads.php">Mer information</a>]
_SBHD;

$para['integrator::hint_sidebar'] = <<<_SBHD
Skapar ett bokmärke som senare kan klickas pa för att öppna SiteBar i en sidopanel.
_SBHD;

$para['integrator::hint_livebookmarks'] = <<<_SBHD
Ladda ner mappstrukturen för hela SiteBar till en fil. Importera denna fil till dina bokmärken.
Varje mapp representeras av en "Live Bookmark". Pa detta sätt kommer dina bokmärken att integreras med dina andra bokmärken, men mappinnehallet kommer att laddas ner fran SiteBar.
Om en mapp har undermappar kommer innehallet i mappen att visas i mappen @Content.
_SBHD;

$para['integrator::hint_sidebar_mozilla'] = <<<_SBHD
Lägger till SiteBar till din sidopanel. Denna sidopanel kan visas/gömmas med F9. Om SiteBar laddas i sidopanelen och tidsgränsen överskrids under laddningen kommer Mozilla att misslyckas med att visa den. Du rekommenderas öppna SiteBar i huvudfönstret och tillata länkbilder (favicons) att cachas i webbläsaren eller sla av favicon-visningen i "Användarinställningar".
_SBHD;

$para['integrator::hint_sidebar_konqueror'] = <<<_SBHD
Följ dessa steg:
<ol>
<li>Öppna Konqueror</li>
<li>Gå till menyn "Fönster -> Visa Navigationspanelen (F9)"</li>
<li>Högerklicka på panelen med ikoner i Navigationspanelen nedanför ikonerna.</li>
<li>Välj "Lägg Till Ny -> Web SideBar Modul" - en ny ikon med namnet "Web SiteBar Plugin" kommer läggas till.</li>
<li>Högerklicka på den nya ikonen och välj "Ange Namn". Skriv in <b>SiteBar</b>.</li>
<li>Högerklicka på den nya ikonen och välj "Ange URL". Skriv in <b>%s</b>.</li>
<li>Klicka på ikonen för att öppna SiteBar i en SideBar.</li>
</ol>
_SBHD;

$para['integrator::hint_hotlist'] = <<<_SBHD
Ett bokmärke till siteBar kommer att läggas till i "Opera Bookmarks". Ett klick på en länk i bokmärkeslistan kommer att lägga till SiteBar i "Opera Panels".
_SBHD;

$para['integrator::hint_install'] = <<<_SBHD
Installerar SiteBar till Explorer och högerklicksmenyn - kräver registerändring i Windows och omstart av dator för all funktionalitet. Beroende pa dina rättigheter kan viss funktionalitet utebli.
<br>
Öppna SiteBar i Explorer sidopanelen fran menyn Visa/Explorer-fält eller använd verktygsfältet (vanligtvis en stjärna likt favoriter-ikonen) för att växla mellan att visa/inte visa sidopanelen. Högerklicka var som helst pa en hemsida eller länk för att lägga till sidan eller länken till SiteBar.
_SBHD;

$para['integrator::hint_uninstall'] = <<<_SBHD
Avinstallerar Explorers verktygsfält (se ovan).
_SBHD;

$para['integrator::hint_searchbar'] = <<<_SBHD
Att använda denna bookmarklet* rekommenderas ifall användaren inte har tillräckligt med privilegier för att installera Explorer sidopanelen. Denna öppnar SiteBar temporärt i Explorers sökfält.
_SBHD;

$para['integrator::hint_maxthon_sidebar'] = <<<_SBHD
Laddar ner en plugin (med förinställd URL). Arkivet maste packas upp till katalogen "C:Program FilesMaxthonPlugin". Efter omstart kommer en ny Explorer verktygsfältikon att läggas till.
_SBHD;

$para['integrator::hint_maxthon_toolbar'] = <<<_SBHD
Laddar ner en plugin (med förinställd URL). Arkivet maste packas upp till katalogen "C:Program FilesMaxthonPlugin". Efter omstart kommer en ny ikon att visas i Plugin verktygsfältet. Denna ikon tillater sida i den aktiva fliken att läggas till i SiteBar.
_SBHD;

$para['integrator::hint_gentoo'] = <<<_SBHD
Kör kommandot <strong>emerge sitebar</strong> för att installera SiteBar-paketet.
_SBHD;

$para['integrator::hint_debian'] = <<<_SBHD
Kör kommandot <strong>apt-get install sitebar</strong> för att installera SiteBar-paketet.
_SBHD;

$para['integrator::hint_phplm'] = <<<_SBHD
PHP Layers Menu är ett hierarkiskt menysystem för att förbereda dynamiska HTML (DHTML) menyer som använder sig av PHP-motorn för att processa data.
SiteBar fungerar som server för att leverera bokmärken i en korrekt struktur. Ifall fopen tillats för att fjärröppna filer kan följande kod ladda filer med rätt struktur:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_SBHD;

$para['integrator::copyright3'] = <<<_SBHD
Copyright ? 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>
och <a href='http://sitebar.org/team.php'>SiteBar Teamet</a>.
<a href='http://sitebar.org/forum.php'>Supportforum</a> och <a href='http://sitebar.org/bugs.php'>bugglista</a>.
_SBHD;

$para['command::welcome'] = <<<_SBHD
%s, välkommen till SiteBar!
%s
<p>
Högerklicka på mappar eller länkar för att hantera dina länkar.
<p>
Alternativt kan du slå på valet "%s" i "%s" och använda menyikonen i stället.
<p>
Du är nu inloggad.
_SBHD;

$para['command::signup_verify'] = <<<_SBHD
<p>
Denna SiteBar-installation kräver att din epostadress är korrekt och bekräftad innan du kan använda SiteBar-funktionerna.
<p>
Förutsatt att du angivit korrekt epostadress borde du fa ett epostmeddelande inom kort. Var god klicka pa länken i det meddelandet.
_SBHD;

$para['command::signup_approve'] = <<<_SBHD
<p>
Denna SiteBar-installation kräver att konton godkänns av en administratör innan du kan använda SiteBar-funktionerna.
<p>
Var god vänta pa godkännande av en administratör - du kommer att informeras via epost.
_SBHD;

$para['command::signup_verify_approve'] = <<<_SBHD
<p>
Denna SiteBar-installation kräver att din epostadress är korrekt och bekräftad och att en administratör godkänner ditt konto innan du kan använda SiteBar-funktionerna.
<p>
Förutsatt att du angivit korrekt epostadress borde du fa ett epostmeddelande inom kort. Var god klicka pa länken i epostmeddelandet och vänta pa att en administratör godkänner ditt konto - du kommer att bli informerad via epost.
_SBHD;

$para['command::account_approved'] = <<<_SBHD
Administratören har godkänt ditt konto.
Du kan logga in med ditt användarnamn %s.

--
SiteBar-installation pa %s.
_SBHD;

$para['command::account_rejected'] = <<<_SBHD
Administratören har avslagit ditt konto med användarnamn %s.

--
SiteBar-installation pa %s.
_SBHD;

$para['command::account_deleted'] = <<<_SBHD
Administratören har tagit bort ditt inaktiva konto med användarnamn %s.

--
SiteBar-installation pa %s.
_SBHD;

$para['command::reset_password'] = <<<_SBHD
En lösenordsaterställning för SiteBar-konto har begärts för "%s" epostadress.

Om du verkligen vill aterställa lösenordet för detta konto, var god klicka pa följande länk:
  %s

--
SiteBar-installation pa %s.
_SBHD;

$para['command::leave_group'] = <<<_SBHD
<p>
När du lämnar en grupp behöver du en inbjudan för att gå med i den igen. För att få en inbjudan måste du kontakta gruppägaren genom dennas användarnamn eller epostadress.
_SBHD;

$para['command::use_comma'] = <<<_SBHD
Använd kommaseparerade användarnamn. Användarna kommer bli medlemmar så snart de bekräftat din inbjudan.
_SBHD;

$para['command::reset_password_hint'] = <<<_SBHD
<p>
Var god fyll i ditt användarnamn eller din registrerade epostadress.
En kod kommer skickas till din registrerade epostadress.
Använd denna kod för att aterställa ditt lösenord.
_SBHD;

$para['command::contact'] = <<<_SBHD
Meddelande:

%s


--
SiteBarinstallation pa %s.
_SBHD;

$para['command::contact_group'] = <<<_SBHD
Grupp: %s
Meddelande:

%s


--
SiteBarinstallation pa %s.
_SBHD;

$para['command::delete_account'] = <<<_SBHD
<h3>Vill du verkligen ta bort ditt konto?</h3>
Det finns inget sätt att ångra sig!<p>
_SBHD;

$para['command::email_link_href'] = <<<_SBHD
<p><a href="mailto:?subject=Webbsida: %s&body=Jag har hittat en webbsida som jag tror du kan vara intresserad av.
 Kolla in: %s
 --
 Skickat via bokmärkeshanteraren SiteBar pa %s
">Klicka här</a> för att skicka ett epostmeddelande genom att använda din vanliga e-postklient.
_SBHD;

$para['command::email_link'] = <<<_SBHD
Jag har hittat en hemsida du kan vara intresserad av.
Kolla in denna:

    "%s" %s

%s

--
Skickat via %s driven av bomärkesservern SiteBar (http://sitebar.org/)
_SBHD;

$para['command::verify_email'] = <<<_SBHD
Tack för att du använda e-postbekräftelsen som tillåter dig att använda SiteBars e-postmedellandesystem.

Var god klicka på någon av följande länkar för att bekräfta din e-postadress:

  %s

Var god ignorera detta e-postmeddelande om du inte valt e-postbekräftelse i SiteBar Bokmärkeshanterare.
_SBHD;

$para['command::verify_email_must'] = <<<_SBHD
Du har registrerat ett SiteBar-konto pa en SiteBar-installation som kräver epostbekräftelse före du kan använda SiteBar.

Var god klicka pa följande länk för att bekräfta din epostadress:
  %s
_SBHD;

$para['command::export_bk_ie_hint'] = <<<_SBHD
Internet Explorer kan importera/exportera bokmärken i Netscape Bookmark format. De maste dock vara i standard Windows teckenuppsättning, UTF-8 kommer inte att fungera.<br>
_SBHD;

$para['command::import_bk_ie_hint'] = <<<_SBHD
Internet Explorer kan exportera bokmärken i Netscape Bookmark filformat fran menyn "Arkiv/Importera och exportera...".
Den exporterade filen är i sitt ursprungliga format Windowskodat - var god välj teckenuppsättningskod när du importerar filen, standard UTF-8 kommer inte att fungera.<br>
_SBHD;

$para['command::noiconv'] = <<<_SBHD
<br>
Codepagekonvertering är inte installerat pa denna SiteBar-server. Endast utf-8 och iso-8859-1 stöds.
<br>
_SBHD;

$para['command::security_legend'] = <<<_SBHD
Rättigheter:
<strong>L</strong>äs,
<strong>A</strong>ddera,
<strong>M</strong>odifiera,
<strong>T</strong>a Bort
_SBHD;

$para['command::purge_cache'] = <<<_SBHD
<h3>Vill du verkligen ta bort alla faviconer fran cachen?</h3>
_SBHD;

$para['command::tooltip_allow_anonymous_export'] = <<<_SBHD
Möjliggör direkt bokmärkesnedladdning eller matning för anonyma användare. Kan förbigas om användaren vet hur han ska konstruera URLen!
_SBHD;

$para['command::tooltip_allow_contact'] = <<<_SBHD
Tillat att administratören kontaktas av anonyma användare.
_SBHD;

$para['command::tooltip_allow_custom_search_engine'] = <<<_SBHD
Om ej tillatet, tillats användarna bara använda den sökmotor som angetts i detta formulär.
_SBHD;

$para['command::tooltip_allow_info_mails'] = <<<_SBHD
Tillat administratörer och moderatorer av den grupp jag tillhör att sända mig information via epost.
_SBHD;

$para['command::tooltip_allow_sign_up'] = <<<_SBHD
Tillat besökare att komma at registreringsformuläret för att registrera sig till SiteBar.
_SBHD;

$para['command::tooltip_allow_user_groups'] = <<<_SBHD
Tillat användare att skapa deras egna grupper. Annars har bara administratörerna denna möjlighet.
_SBHD;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_SBHD
Tillat användare att ta bort deras existerande träd.
_SBHD;

$para['command::tooltip_allow_user_trees'] = <<<_SBHD
Tillat användare att skapa ytterligare träd.
_SBHD;

$para['command::tooltip_approved'] = <<<_SBHD
Kontot är godkänt och kan användas fullt ut.
_SBHD;

$para['command::tooltip_auto_close'] = <<<_SBHD
Visa inte kommandoexekveringsstatus om allt gar bra.
_SBHD;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_SBHD
Hämta favicon automatiskt när den saknas och en länk läggs till.
_SBHD;

$para['command::tooltip_default_groups'] = <<<_SBHD
Lista över grupper som kommer skapas för användare som ej har några grupper. Använd | för att separera gruppnamn.
_SBHD;

$para['command::tooltip_public_groups'] = <<<_SBHD
Lista över grupper som blir tillgängliga för anonyma användare.
_SBHD;

$para['command::tooltip_cmd'] = <<<_SBHD
Lägg till de viktigaste SiteBar-kommandona för att möjliggöra enkel login till SiteBar.
_SBHD;

$para['command::tooltip_comment_impex'] = <<<_SBHD
Visa kommandon för import och export av länkbeskrivning.
_SBHD;

$para['command::tooltip_comment_limit'] = <<<_SBHD
Det är möjligt att specificera en maximal längd för länkkommentarer. Det är möjligt att lagra sma filer som kommentarer.
_SBHD;

$para['command::tooltip_default_folder'] = <<<_SBHD
Nästa gang du använder bookmarklet kommer denna mapp sättas som standard.
_SBHD;

$para['command::tooltip_delete_content'] = <<<_SBHD
Ta endast bort innehallet i mappen, ej själva mappen.
_SBHD;

$para['command::tooltip_delete_favicons'] = <<<_SBHD
Ta bort favicon-URLen fran länken om faviconen är ogiltig - används med försiktighet.
_SBHD;

$para['command::tooltip_demo'] = <<<_SBHD
Gör detta konto till ett demokonto med begränsad funktionalitet och utan möjlighet att ändra lösenord.
_SBHD;

$para['command::tooltip_discover_favicons'] = <<<_SBHD
Försök analysera sidan och finna faviconer (genvägsikoner) som saknas.
_SBHD;

$para['command::tooltip_exclude_root'] = <<<_SBHD
Rotmappen kommer inte visas om möjligt.
_SBHD;

$para['command::tooltip_expert_mode'] = <<<_SBHD
Visa avancerade kontroller och visa mer diagnostiska meddelanden.
_SBHD;

$para['command::tooltip_extern_commander'] = <<<_SBHD
Exekvera kommandon genom ett externt fönster - utan omladdning för varje kommando.
_SBHD;

$para['command::tooltip_filter_groups'] = <<<_SBHD
Använd filter för grupper i stället för att välja från listan.
_SBHD;

$para['command::tooltip_filter_users'] = <<<_SBHD
Använd filter för användare i stället för att välja från listan.
_SBHD;

$para['command::tooltip_flat'] = <<<_SBHD
Exportera länkarna som om dom var i en enda mapp.
_SBHD;

$para['command::tooltip_hide_xslt'] = <<<_SBHD
Göm tjänster som behöver XSLT-webbläsarsupport.
_SBHD;

$para['command::tooltip_hits'] = <<<_SBHD
Dirigera alla klick pa länkar genom SiteBar-servern för att generera användarstatistik.
_SBHD;

$para['command::tooltip_ignore_https'] = <<<_SBHD
SiteBar kan inte validera HTTPS URLer. Om denna inte är förkryssad kommer validering av länkar som inte är HTTP-länkar att falera.
_SBHD;

$para['command::tooltip_ignore_recently'] = <<<_SBHD
Testa inte länkar som nyligen har testats - används för upprepad kontroll när föregaende kontroll inte avslutades.
_SBHD;

$para['command::tooltip_integrator_url'] = <<<_SBHD
Som standard använder SiteBar integratorn pa my.sitebar.org. Det är möjligt att använda en lokal integrator.
_SBHD;

$para['command::tooltip_is_dead_check'] = <<<_SBHD
Denna länk klarade inte kontrollen. Du kanske ända vill behalla den som aktiv.
_SBHD;

$para['command::tooltip_is_feed'] = <<<_SBHD
Markera en länk som en RSS-feed - Länken kommer öppnas i en RSS-läsare (om en finns installerad) och ej i webbläsaren.
_SBHD;

$para['command::tooltip_load_all_nodes'] = <<<_SBHD
Ladda alla mappar. Användbart för användare med ett mindre antal länkar och som vill använda filtreringsfunktionen.
_SBHD;

$para['command::tooltip_popup_params'] = <<<_SBHD
Parametrar för pop-up-fönstren som öppnas av SiteBar. Lämna tomt för att återställa till standardvärden.
_SBHD;

$para['command::tooltip_max_icon_age'] = <<<_SBHD
Hur länge en favicon behalls i cachen innan den uppdateras fran servern.
_SBHD;

$para['command::tooltip_max_icon_cache'] = <<<_SBHD
FIFO-stack. De äldsta ikonerna kommer att kastas bort fran systemet - används för att kontrollera storleken pa cachen.
_SBHD;

$para['command::tooltip_max_icon_size'] = <<<_SBHD
Maximalt tillaten storlek pa ikoner i bytes.
_SBHD;

$para['command::tooltip_max_session_time'] = <<<_SBHD
Administratören kan sätta en maximalt tillaten sessionstid. När denna tid överskridits maste användaren logga in igen.
_SBHD;

$para['command::tooltip_menu_icon'] = <<<_SBHD
Vissa webbläsare/plattformar hanterar inte högerklick. Detta val visar en ikon som istället kan användas för att visa innehallsmeny via vänsterklick.
_SBHD;

$para['command::tooltip_mix_mode'] = <<<_SBHD
Mappar föregar länkar i SiteBar-trädet och vice versa.
_SBHD;

$para['command::tooltip_novalidate'] = <<<_SBHD
Kontrollera inte denna länk - används för intranätlänkar eller för länkar som har problem med validering.
_SBHD;

$para['command::tooltip_paste_content'] = <<<_SBHD
Lat operationen ske pa innehallet i mappen och inte pa själva mappen.
_SBHD;

$para['command::tooltip_private'] = <<<_SBHD
Privata länkar visas aldrig för andra användare även om de finns i en delad mapp.
_SBHD;

$para['command::tooltip_private_over_ssl_only'] = <<<_SBHD
Privata länkar kommer endast att laddas om SiteBar används över en SSL-uppkoppling.
_SBHD;

$para['command::tooltip_rename'] = <<<_SBHD
Byt namn pa länkar som är duplikat vid import för att ladda alla länkar.
_SBHD;

$para['command::tooltip_respect'] = <<<_SBHD
Skicka epost endast om användaren tillatit det.
_SBHD;

$para['command::tooltip_search_engine_ico'] = <<<_SBHD
Ikon att visa i SiteBar toolbar och som leder till en webbsökning.
_SBHD;

$para['command::tooltip_search_engine_url'] = <<<_SBHD
URL för sökmotorn som används för sökning. Använd %SEARCH% där söksträngen ska läggas in.
_SBHD;

$para['command::tooltip_sender_email'] = <<<_SBHD
E-postmeddelanden skapade av SiteBar kommer sändas till denna adress.
_SBHD;

$para['command::tooltip_show_acl'] = <<<_SBHD
Dekorera mappar med säkerhetsspecifikation.
_SBHD;

$para['command::tooltip_show_logo'] = <<<_SBHD
Visa logotypen upptill - bör vara avslaget för SiteBar-installationer pa langsamma webbhotell, kan annars användas för reklam.
_SBHD;

$para['command::tooltip_show_statistics'] = <<<_SBHD
Visa statisk statistik och prestandastatistik pa SiteBars huvudpanel.
_SBHD;

$para['command::tooltip_subdir'] = <<<_SBHD
Exportera alla länkar och mappar rekursivt.
_SBHD;

$para['command::tooltip_subfolders'] = <<<_SBHD
Kontrollera denna mapp rekursivt med alla undermappar.
_SBHD;

$para['command::tooltip_to_verified'] = <<<_SBHD
Skicka epost enbart till konfirmerade epostadresser.
_SBHD;

$para['command::tooltip_use_compression'] = <<<_SBHD
Sidor byggda av SiteBar kan komprimeras för att spara bandbredd. Komprimering används endast om det stöds pa webbläsarsidan.
_SBHD;

$para['command::tooltip_use_conv_engine'] = <<<_SBHD
Använd konverteringsmotorn (vanligtvis tillägg till PHP) för att konvertera sidor med olika teckenkodning - viktigt för import och export av bokmärken. Kan medföra blanka sidor i vissa implementationer.
_SBHD;

$para['command::tooltip_use_favicon_cache'] = <<<_SBHD
Favicon-ikoner kommer laddas ner av servern till databas-cachen och vid klientförfragningar som sänts. Ökar trafiken och snabbar upp favicon-cachen genom att reducera antalet inkopplade servrar.
_SBHD;

$para['command::tooltip_use_favicons'] = <<<_SBHD
Användande av faviconer gör SiteBar snyggare men langsammare. När favicon-cachen används av denna installation kommer visning av faviconer bli mycket snabbare.
_SBHD;

$para['command::tooltip_use_hiding'] = <<<_SBHD
Tillat kommando för att gömma mappar. Gömmande av mappar används för mappar publicerade av andra användare.
_SBHD;

$para['command::tooltip_use_mail_features'] = <<<_SBHD
Om denna PHP-installation tillater att epostfunktionen används kan epostfunktioner slas pa.
_SBHD;

$para['command::tooltip_use_new_window'] = <<<_SBHD
Öppna alla länkar i nytt fönster genom att använda _blank som mål.
_SBHD;

$para['command::tooltip_use_outbound_connection'] = <<<_SBHD
Vissa funktioner (favicon cache) kräver access till andra adresser fran din server.
_SBHD;

$para['command::tooltip_use_search_engine'] = <<<_SBHD
Tillat sökningar att omdirigeras till eller utökas med resultat fran din favoritwebbsökmotor.
_SBHD;

$para['command::tooltip_use_search_engine_iframe'] = <<<_SBHD
Resultaten fran din webbsökmotor kommer att inkluderas i SiteBars sökresultatsida genom en inbäddad frame (iframe).
_SBHD;

$para['command::tooltip_use_tooltips'] = <<<_SBHD
Visa SiteBar verktygstips i stället för webbläsarens inbyggda. Tillater längre tips och support för fler webbläsare.
_SBHD;

$para['command::tooltip_use_trash'] = <<<_SBHD
Markera borttagna mappar och länkar sa de kan tas tillbaka eller rensas bort.
_SBHD;

$para['command::tooltip_users_must_be_approved'] = <<<_SBHD
Användare maste godkännas av en administratör innan de kan använda SiteBar.
_SBHD;

$para['command::tooltip_users_must_verify_email'] = <<<_SBHD
Användare maste konfirmera sin epostadress innan de kan använda SiteBar.
_SBHD;

$para['command::tooltip_verified'] = <<<_SBHD
Markera denna för att konfirmera epostadressen.
_SBHD;

$para['command::tooltip_version_check_interval'] = <<<_SBHD
SiteBar kan utföra regelbundna kontroller när en ny version finns tillgänglig. Detta kan vara viktigt när en säkerhetsbrist upptäckts. Utgaende koppling krävs.
_SBHD;

$para['command::tooltip_web_search_user_agents'] = <<<_SBHD
Regular expression för webbläsare som ska fa en icke-javascript baserad skrivare.
_SBHD;

$para['sitebar::users_must_verify_email'] = <<<_SBHD
Denna SiteBar-installation kräver epostbekräftelse. Var god bekräfta din epostadress. I annat fall kan ditt konto komma att tas bort.
_SBHD;

$para['sitebar::tutorial'] = <<<_SBHD
Ikonen med ditt användarnamn ovan är rotmappen för dina bokmärken.
Högerklicka på den och välj kommandot "%s" för att lägga till ditt första bokmärke.
_SBHD;

$para['sitebar::invitation'] = <<<_SBHD
Användare <strong>%s</strong> vill dela bokmärken med dig och bjuder in dig att gå med i hans grupp <strong>%s</strong>.
_SBHD;

$para['usermanager::signup_info'] = <<<_SBHD
Användare %s registrerade sig nyligen pa din SiteBarinstallation vid %s.
_SBHD;

$para['usermanager::signup_info_verified'] = <<<_SBHD
Användare %s registrerade sig pa din SiteBar-installation pa %s.
Användaren har redan bekräftat sin epostadress.
_SBHD;

$para['usermanager::signup_approval'] = <<<_SBHD
Användare %s registrerade sig pa din SiteBar-installation pa %s.

Godkänn konto:
  %s

Avsla konto:
  %s

Se avvaktande användare:
  %s
_SBHD;

$para['usermanager::signup_approval_verified'] = <<<_SBHD
Användare %s registrerade sig pa din SiteBar-installation pa %s.
Användaren har redan bekräftat sin epostadress.

Godkänn konto:
  %s

Avsla konto:
  %s

Se avvaktande användare:
  %s
_SBHD;

$para['usermanager::alert'] = <<<_SBHD
%s
_SBHD;

$para['messenger::cancel'] = <<<_SBHD
Avbryt
_SBHD;

$para['messenger::delete'] = <<<_SBHD
Ta Bort
_SBHD;

$para['messenger::expire'] = <<<_SBHD
Går Ut
_SBHD;

$para['messenger::read'] = <<<_SBHD
Läst
_SBHD;

$para['messenger::unread'] = <<<_SBHD
Oläst
_SBHD;

$para['messenger::save'] = <<<_SBHD
Spara
_SBHD;

$para['messenger::state_unread'] = <<<_SBHD
Oläst
_SBHD;

$para['messenger::state_seen'] = <<<_SBHD
Visad
_SBHD;

$para['messenger::state_read'] = <<<_SBHD
Läst
_SBHD;

$para['messenger::state_saved'] = <<<_SBHD
Sparad
_SBHD;

$para['messenger::state_deleted'] = <<<_SBHD
Borttagen
_SBHD;

$para['messenger::state_expired'] = <<<_SBHD
Förfallen
_SBHD;

$para['hook::statistics'] = <<<_SBHD
Träd: {roots_total}.
Mappar: {nodes_shown}/{nodes_total}.
Länkar: {links_shown}/{links_total}.
Användare: {users}.
Grupper: {groups}.
SQL-förfragningar: {queries}.
Databastid/Total tid: {time_db}/{time_total} sekunder ({time_pct}%).

_SBHD;

$para['groupname::Family'] = <<<_SBHD
Familj
_SBHD;

$para['groupname::Friends'] = <<<_SBHD
Vänner
_SBHD;

$para['groupname::Public'] = <<<_SBHD
Publik
_SBHD;

?>
