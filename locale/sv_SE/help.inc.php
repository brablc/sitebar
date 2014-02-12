<?php

$help = array();

$help['100'] = <<<_P
SiteBarfunktionerna är nåbara från <strong>Användarmenyn</strong> och från mapp- och länk-<strong>Kontextmenyn</strong>. Användarmenyn visas i nedre delen av SiteBar och kontextmenyerna fås genom att högerklicka på mappar och länkar. Opera- och Appleanvändare kan använda Ctrl-click i stället. I det fall inte Ctrl-click finns att tillgå är det möjligt att kryssa för "Visa Menyikon" som hittas i "Användarinställningar". När denna är förkryssad kommer en liten menyikon att visas bredvid mappen eller länkikonen. Genom att klicka på denna ikon får man upp kontextmenyn.
<p>
Både kontextmenyn och användarmenyn kan visa olika kommandon för olika användare beroende på deras rättigheter i systemet. Vissa delar kan vara avstängda i kontextmenyn baserat på användarrättigheter till noder och programstatus. Kommandon exekveras via kommandofönstret.
_P;

$help['101'] = <<<_P
Klicka på en mapp eller länk med musen och flytta muspekaren över en annan mapp medan du håller knappen nedtryckt. När du drar muspekaren över en mapp visas det genom att mappen markeras. Släpp knappen för att släppa mappen eller länken på den mapp som för närvarande är markerad.
<p>
Drag & Släpp är inte implementerat av SiteBar teamet för webbläsaren Opera. I stället bör Kopiera och Klistra användas.
_P;

$help['103'] = <<<_P
<p><strong>Filtrera</strong> - Filtrerar länkar. Det är möjligt att specificera vad som ska filtreras genom att använda prefixen 
<strong>url:</strong>, <strong>name:</strong>, <strong>desc:</strong>,
<strong>all:</strong>. Standardprefix är <strong>name:</strong> och kan ändras i "Användarinställningar".

<p><strong>Sök</strong> - Tillåter sökning i alla visade länkar. Det är möjligt att specifiera vad som skall sökas genom att använda prefixen
<strong>url:</strong>, <strong>name:</strong>, <strong>desc:</strong>,
<strong>all:</strong>. Standardprefix är <strong>name:</strong> och kan ändras i "Användarinställningar". När en matchande länk eller mapp har hittats, markeras den och
ett meddelande med information visas. Användare har möjlighet att fortsätta söka eller stoppa sökningen.

<p><strong>Sök På Nätet</strong> - Visas om webbsökning är tillåten och konfigurerad.

<p><strong>Minimera Alla</strong> - Minimerar alla noder. När den klickas på för andra gången
(när alla noder redan är minimerade) expanderas alla noder.

<p><strong>Uppdatera Med Gömda Mappar</strong> - Uppdaterar alla länkar från servern inklusive mappar gömda med "Göm Mapp"-kommandot.

<p><strong>Uppdatera</strong> - Uppdaterar alla länkar från servern. Denna funktion finns till
eftersom pluginen finns i en sidopanel där användaren kanske inte (beroende på webbläsare) har möjlighet att uppdatera.

_P;

$help['200'] = <<<_P
Kommandon är grupperade i flera logiska grupper. Var god välj en av grupperna för att se hjälpen för kommandot.
_P;

$help['210'] = <<<_P
<p><strong>Logga In</strong> - Loggar in användaren i systemet. Användaren blir ihågkommen genom cookies och kan specifiera när cookies ska gå ut med hjälp av valen under "Kom Ihåg Mig".

<p><strong>Logga Ut</strong> - Loggar ut användaren från systemet. Denna funktion bör alltid användas på publika terminaler. Ett alternativ är att logga in användaren med cookies satt att gå ut när användaren stänger webbläsaren.

<p><strong>Registrera</strong> - Tillåter en besökare att registrera sig som en användare 
i systemet. Användaren kan kvalificera sig att gå med i en eller flera grupper. I detta fall 
måste epostadressen konfirmeras vilket görs automatiskt genom att sända ett 
verifieringsmeddelande till användaren. Systemadministratören kan stänga av 
registrering av nya användare. Administratörer kan dessutom kräva att epostadressen konfirmeras 
innan användaren kan använda SiteBar.

_P;

$help['220'] = <<<_P
<p><strong>Ställ In</strong> - Det första kommando en administratör kommer att se vid installation av SiteBar och efter att ha satt upp databasen. Ett administrationskonto kommer att skapas och grundläggande parametrar för SiteBar kommer att ställas in. När "Personligt Mode" har valts så kommer bara en del av funktionerna att vara tillgänliga.

<p><strong>SiteBar Inställningar</strong> - Administratörerna kan senare ändra parametrar för SiteBar. Administratörer är medlemmar i administratörsgruppen och användare som skapats genom "Ställ In" kommandot. Se "Ställ In" för en beskrivning av epostmöjligheter. Det finn fler epostmöjligheter planerade till nästa release.

<p><strong>Skapa Träd</strong> - Beroende på SiteBar inställningar så kan endast administratörer och/eller användare med verifierade epostadresser skapa nya träd. När ett nytt träd skapats så måste det associeras med en existerande användare (endast administratören kan skapa träd för någon annan användare). Gruppbokmärken skapas normalt genom att skapa ett nytt träd och tilldela det till den användare som är moderator för gruppen som skapas separat genom att använda kommandot "Skapa Grupp". Denna användare kan sedan bevilja rättigheter till det nyligen skapade trädet för gruppmedlemmarna och kan lägga till medlemmar till gruppen.

_P;

$help['230'] = <<<_P
<p><strong>Användarinställningar</strong> - Ändra användarinställningar. När "Extern Kommandohanterare" inte är förkryssad kommer kommandohanteraren att öppna i samma fönster som SiteBar i stället för att öppna i ett nytt fönster. Vissa kommandon ("Logga In", "Logga Ut", "Registrera", "Användarinställningar") öppnar alltid i samma fönster som SiteBar. När "Skippa Exekveringsmeddelanden" är förkryssat kommer ingen bekräftelseförfrågning upp vid exekvering av kommandon. "Dekorera ACL Mappar" kommer att markera de mappar som har säkerhetsspecifikationer. Denna funktion slöar ner SiteBar.

<p><strong>Medlemskap</strong> - Användare kan lämna vilken grupp som helst och gå med i öppna grupper. Användare kan inte lämna grupper om gruppen då skulle förlora sin sista moderator. I detta fall ska administratören kontaktas för att ta bort gruppen.

<p><strong>Verifiera Epost</strong> - Tillåter användaren att verifiera sin epostadress för att använda andra systemfunktioner.

_P;

$help['240'] = <<<_P
<p><strong>Underhålla Användare</strong> - Visar en lista med användare och tillåter följande kommandon.

<p><strong>Modifiera Användare</strong> - Det för närvarande enda sättet att återfå ett glömt lösenord är att sätta ett temporärt lösenord, eposta det till användaren och be hon/honom att ändra det. Administratören kan markera kontot som demo vilket förhindrar användaren att ändra vissa egenskaper, speciellt lösenord.

<p><strong>Ta Bort Användare</strong> - Tar bort envändaren och alla medlemskap. Tilldelar existerande träd till en annan användare. Det är inte tillåtet att ta bort en användare som är den enda moderatorn i en grupp.

<p><strong>Skapa Användare</strong> - Samma som "Registrera" men används av administratören. Epostmeddelanden av skapade användare behandlas som verifierade.

_P;

$help['250'] = <<<_P
<p><strong>Underhåll Grupper</strong> - Visar en lista med grupper och tillåter följande kommandon att exekveras.

<p><strong>Gruppegenskaper</strong> - Tillgängliga för moderatorer av gruppen. Tillåter ändring av gruppnamnkommentar och automatiskt deltagande med reguljära uttryck (regular expression) för epostadresser. När reguljärt uttryck av epostadress för automatiskt deltagande är ifyllt och matchar epostadressen för en ny användare så ombeds användaren verifiera sin epostadress. När användaren gjort det blir hon/han automatiskt medlem i gruppen. När "Tillåt Lägga Till Sig Själv" är förbockat behöver inte epostadressen verifieras för automatiskt deltagande.

<p><strong>Gruppmedlemmar</strong> - Endast moderatorer kan välja vilka användare som är medlemmar i en grupp. En annan moderator kan inte avväljas. Moderatorrollen måste först tas bort med följande kommando.

<p><strong>Gruppmoderatorer</strong> - Tillgängliga för moderatorer av gruppen. Det måste alltid finnas minst en moderator för en grupp.

<p><strong>Ta Bort Grupp</strong> - Tillgängliga för administratörer enbart. Tar bort en grupp och all medlemskap till gruppen.

<p><strong>Skapa Grupp</strong> - Tillgängliga för administratörer enbart. Skapar en grupp och väljer den första moderatorn för gruppen.

_P;

$help['260'] = <<<_P
<p><strong>Lägg Till Mapp</strong> - Lägger till en ny undermapp i mappen.

<p><strong>Lägg Till Länk</strong> - Lägger till en länk i mappen. När kommandot körs från bookmarklet låter det användaren välja målmapp, annars skapas länken i den mapp från vilket kommandot anropades.

<p><strong>Kolla Igenom Mapp</strong> - Kolla igenom mappen i katalogläge. Endast en katalog med tillhörande länkar och länkbeskrivningar visas åt gången.

<p><strong>Visa Alla Länkar</strong> - Visar alla länkar i alla undermappar på en gång.

<p><strong>Visa Länknyheter</strong> - Visar länknyheter i denna mapp och alla undermappar.

<p>

<p><strong>Göm Mapp</strong> - Gömmer mappen. Denna funktion kan användas för att gömma andra användares publicerade mappar eller mappar som sällan används. Ett klick på "Ladda Om Med Gömda Mappar"-ikonen uppdaterar alla mappar temporärt. 
"Ångra Göm Undermappar"-kommandot kan användas för att återigen visa gömda mappar permanent. Gömda träd kan göras synliga genom att använda "Hantera Träd" -> "Ångra Göm Träd".

<p><strong>Ångra Göm Undermappar</strong> - Visar alla gömda undermappar i den mapp som avses.

<p><strong>Mappegenskaper</strong> - Ändra mappegenskaper som namn och beskrivning.

<p><strong>Ta Bort Mapp</strong> - Tar bort mappen. En borttagen mapp kan plockas fram igen genom kommandot "Ångra Ta Bort" eller genom att lägga till en mapp med samma namn. Användaren kan även ta bort sin egen rotmapp även om den borttagningen bara är giltig efter kommandot "Rensa Mapp" anropats i den mappen.

<p><strong>Rensa Mapp</strong> - Rensar tidigare borttagna mappar eller länkar under den valda mappen. Det är inte möjligt att ångra en rensning!

<p><strong>Ångra Ta Bort</strong> - Återuppta tidigare borttagna mappar eller länkar som inte är bortrensade. När en rotmapp tas bort visas den vanligtvis som en grå ikon och är synlig enbart för trädägaren. Detta tar bort givna rättigheter från andra gruppmedlemmar vilket betyder en annan säkerhetsnivå som förhindrar oönskad förlust av bokmärken.

<p>

<p><strong>Kopiera</strong> - Kopiera en mapp med innehåll till klippbordet.

<p><strong>Klistra In</strong> - Endast tillgänglig när kommandona "Kopiera" eller "Kopiera Länk" har anropats. Kommandot "Klistra In" bestämmer om användaren kan flytta innehållet eller enbart kopiera det.

<p>

<p><strong>Importera Bokmärken</strong> - Importerar bokmärken från en bokmärkesfil till mappen. Ingen länkvalidering görs i detta steg för att undvika timeout på serversidan.

<p><strong>Exportera Bokmärken</strong> - Exportera innehållet i en mapp till en bokmärkesfil. Netscape bokmärkesfilformat samt Opera Hotlist stöds. Mozilla använder Netscape bokmärkesfilformat och Internet Explorer kan exportera och importera till och från detta format.

<p><strong>Validera Länkar</strong> - Validerar alla länkar i mappen och undermappar. Valideringen kräver en utgående uppkoppling. Under valideringen är det möjligt att upptäcka faviconer eller ta bort faviconer som aldrig var i favicon cachen (möjligen felaktiga länkar). Valideringssidan visar en lista på alla länkar som testas. Testade länkar visar ikoner. Standardlänkikoner visas när ingen favicon hittas. Om en bruten länk hittas så visas en felikon. Om länken fungerar och en favicon existerar så visas den faviconen. Det kan hända att webbläsaren falerar när man validerar väldigt många länkar. Användaren bör då ladda om sidan så fortsätter länkvalideringen och redan kollade länkar kommer att ignoreras. Brutna länkar tas inte bort utan markeras bara. Dom brutna länkarna kommer att visas som överstrukna i SideBar.

<p><strong>Säkerhet</strong> - Gör det möjligt att sätta åtkomsträttigheter för varje mapp. Rättigheterna gäller för alla undermappar också. Se avsnittet "Säkerhetsmekanism" för mer information.

_P;

$help['270'] = <<<_P
<p><strong>Eposta Länk</strong> - Tillåter en länk att skickas via epost till en annan person. För användare med verifierad epostadress kan det interna epostsystemet användas, annars måste ett externt epostprogram användas.

<p><strong>Kopiera Länk</strong> - Kopiera länk till klippbordet. Använd "Klistra In"-kommandot på en mapp för att kopiera/flytta länken till noden.

<p><strong>Ta Bort Länk</strong> - Ta bort länk från noden. Den borttagna länken kan återfås genom att använda kommandot "Ångra Ta Bort" på föregående mapp.

<p><strong>Egenskaper</strong> - Redigera egenskaperna för en länk. Möjligt att sätta länken som privat.

_P;

$help['300'] = <<<_P
SiteBar 3 är en komplett omskrivning av 2.x serien vilket representerar den fortsatta utvecklingen av SiteBar.
<p>
SiteBar 3 använder inte längre JavaSkript för att skapa bokmärkesträden. JavaSkript används dock flitigt för att visa kontextmenyerna och för att expandera/kollapsa noder inklusive ikonändringar.
<a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Nivå 2</a> måste stödjas av webbläsaren. Fördelen med det här är mycket snabbt laddande av bokmärken. Nackdelen är att äldre webbläsare endast kan se bokmärkesträdet expanderat och bara har läsrättigheter till det (vilket ändå är en förbättring jämfört med version 2.x som inte kunde visa bokmärkena alls i äldre webbläsare.
<p>
På serversidan är datat lagrat med den enklaste rekursiva datastrukturen och är optimerat för trädmodifiering. Detta ger en mycket bra prestanda.

_P;

$help['302'] = <<<_P
SiteBar 3 dubbelkollar när det gäller användarrättigheter. Användaren ser bara en delmängd av de kommandon som finns baserat på användarens rättigheter och varje anropat kommando verifieras en andra gång strax före exekvering.
<p>
Systemet har tre grundläggande roller: användare, moderatorer och administratörer. Moderatorer är användare som angavs som moderatorer vid skapande av grupp eller genom en annan moderator. En moderator är en roll som är bunden till en speciell grupp. Administratörer är medlemmar av administratörsgruppen plus den första användare som skapats genom kommandot "Ställ In". Administratörer har ingen rätt att agera som moderatorer. Dom kan däremot ta bort hela grupper.
<p>
SiteBar 3 utvecklades för att möta behoven av flera team. Det betyder att en grupp användare kan dela bokmärken. För att behålla teamets bokmärken privata har säkerhetsmekanismen utvecklats.
<p>
Byggstenen för denna mekanism är att ägaren av en rotmapp för vilket träd som helst har obegränsade rättigheter till hela trädet. Vid registrering eller skapande av användare skapas en rotmapp för varje användare. Administratörer kan skapa ytterligare träd för vilken användare som helst eller tillåta andra användare att skapa deras egna nya träd.
<p>
När trädet skapats kan användaren sätta rättigheterna på sitt träd för andra användargrupper. Följande rättigheter är tillgängliga för alla användargrupper:
<p><strong>Läs</strong> - Gruppanvändaren kan använda bokmärken. Om användaren inte vill se dem måste hon/han lämna gruppen.
<p><strong>Addera</strong> - Användaren kan lägga till mappar och länkar.
<p><strong>Modifiera</strong> - Definiera egenskaper för länkar och mappar.
<p><strong>Ta Bort</strong> - Ta bort länk eller mapp.
<p><strong>Rensa</strong> - Rensa tidigare borttagen länk eller mapp.
<p><strong>Bevilja</strong> - Gruppmedlemmar har samma rättigheter till trädet som dess ägare.
<p>
Rättigheterna ärvs alltid från den föregående mappen. Rotmappen har normalt inga rättigheter för någon grupp. Användaren kan specifiera restriktivare rättigheter till en mapp, vilket påverkar undermappar. Om rättigheterna för en mapp är samma som för den föregående mappen tas rättighetsspecifikationen bort för mappen och den ärver i stället rättigheterna för den föregående mappen.
<p>
Gruppmoderatorer har alltid rättighet att ta bort rättigheter som specifierats för deras grupp av en användare.
<p>
Ju större antalet rättighetsspecifikationer är på mappnivå desto längre tar det att ladda bokmärkena för alla användare. Specifikationer bör inte användas för mycket i väldigt stora träd.
<p>
När SiteBaradministratören bockar för "Personligt Läge" betyder det att säkerhetskommandot inte är tillgängligt. I stället finns då kommandot "Publicera Mapp" som ett val i "Mappegenskaper". I detta mode är det inte möjligt att begränsa rättigheterna för en undermapp om den föregående noden redan är publicerad.

_P;

$help['303'] = <<<_P
SiteBar tillåter dig att skapa nya utseenden, s.k. "skins". 
Du bör ha god kunskap om CSS (Cascading Style-Sheet) för att skapa nya utseenden och 
för full customisering är kunskap i XSLT nödvändig.
För att skapa nya skins så bör en existerande skin användas som mall. 
Ta alltså någon av de existerande skinsen i katalogen "skins" och skapa en kopia av den. 
Varje skin består av:
<ul>
<li>Flera bilder (ändra dom men behåll PNG-formatet. PNG-formatet används beroende på att GIF-rättigheterna i Europa inte är avgjorda till 2004), en CSS "sitebar.css" och en PHP-fil "hook.php". I hook.php är det möjligt att ändra sidhuvud och sidfot på SiteBar-installationen.
<li>Hook-fil "hook.inc.php". Denna fil används av andra delar för att få information om skinnet (t.ex. skaparens namn).
<li>Common style sheet "common.css" innehållande färgdefinition som delas av andra style sheets.
<li>Style-sheet för SiteBar-panelen "sitebar.css".
<li>För XSLT-baserade skärmskrivare finns det style sheets för visning av länknyheter "news.css", 
för visning av kataloginnehåll "directory.css" och för sökning "search.css".
</ul>

<strong>XSL</strong> - Det är möjligt att helt och hållet ändra presentationen av XML-baserad 
SiteBar-data genom att tillhandahålla egna XSL stylesheets. I detta fall är det nödvändigt att kopiera 
en av filerna skins/*xsl.php till skin-katalogen och ändra den.

<p><strong>Cascading</strong> - Med undantag av common stylesheets är alla andra stylesheets skapade 
som ett superset av common stylesheet och motsvarand common stylesheet från skin-katalogen. 
Skin-författaren kan omdefiniera standardvärden här.

<p><strong>Branding</strong> - En del administratörer kan vilja skapa deras egna utseenden för att passa designen på deras hemsida. Du rekommenderas i detta fall ta bort alla andra skins och välja standardutseendet i SiteBar Settings. 

<p>
Om du skulle vilja inkludera ditt skin till SiteBar-installationen så måste du kontakta utvecklingsteamet och testa ditt skin med den senaste stabila utvecklingsversionen av SiteBar. SiteBar och SourceForge logotyperna måste som regel finnas på sidan även om SiteBar logotypen fritt kan uppdateras.

_P;

$help['304'] = <<<_P
SiteBar använder ett ramverk av skärmskrivare som används för att presentera SiteBar-innehållet på valfritt sätt. SiteBars huvudpanel är i sig själv produkten av en skärmskrivare.
<p>
Alla skärmskrivare ärver från klassen <strong>SB_WriterInterface</strong> i <strong>inc/writer.inc.php</strong> och finns placerad i underkatalogen <strong>inc/writers</strong>. För att göra din egen presentation av SiteBar-innehållet behöver du bara åsidosätta några metoder och det är även möjligt att använda en existerande skärmskrivare och ärva från den (som många av SiteBars inbyggda skärmskrivare baserat på XBEL-formatet gör).
_P;

$help['305'] = <<<_P
För att överföra från en existerande SiteBar-installation till en annan server behöver du
<ul>
  <li>Exportera sitebar_* tabellerna från källdatabasen till en .sql fil.
  <li>Importera denna fil till måldatabasen.
  <li>Flytta mjukvaran eller installera en stabil SiteBar-version (nedgradering eller uppgradering kommer att ske automatiskt).
  <li>Ta bort eller uppdatera inc/config.inc.php om databasinställningarna har ändrats.
</ul>

<p>
Exportering och importering kan göras genom <a href='http://www.phpmyadmin.net/' target='_blank'>phpMyAdmin</a>.
Tabellen sitebar_favicon (till och med 3.2.6) eller sitebar_cache (från och med 3.3) behöver inte överföras, dess innehåll kommer att byggas om.
_P;

?>
