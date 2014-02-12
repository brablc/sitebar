<?php

$help['100'] = <<<_P
SiteBar functies zijn toegankelijk vanuit het <strong>Gebruikersmenu</strong> en vanuit de
mappen en links <strong>Context menu's</strong>. Het Gebruikersmenu staat onder
de SiteBar en de context menu's zijn toegankelijk door rechts op een map of link
te klikken. Opera en Apple gebruikers kunnen hiervoor in de plaats Ctrl-klik gebruiken.
In het geval dat ook Ctrl-klik niet werkt is het mogelijk om de het "Toon Menu Icoon"
aan te zetten via "Gebruikersinstellingen". Indien deze optie wordt geselecteerd komt er
een klein menu icoon naast iedere link en map te staan. Door hier op te klikken wordt
het context menu zichtbaar.
<p>
Zowel het context als de gebruikers menu's kunnen, afhankelijk van de rechten,
verschillende items tonen. Sommige items zijn wellicht niet toegankelijk
in het op gebruikersrechten gebaseerde context menu voor structuren en de status.
Commando's worden uitgevoerd via het Commando venster.
_P;

$help['101'] = <<<_P
Klik op een map of link met de muis en verplaats de muiscursor over een andere map terwijl
u de knop ingedrukt houdt. Het slepen is zichtbaar door het oplichten van de doelmap. Laat
de muisknop los om de te verplaatsen link of map neer te zetten.
<p>
Drag & Drop werkt niet in Opera browsers. U dient hiervoor via het context menu Kopieer en Plakken
te gebruiken.
_P;

$help['103'] = <<<_P
<p><strong>Filter</strong> - Filtert de links die door de front-end worden getoond.
Het is mogelijk om op te geven wat gefilterd moet worden met behulp van de prefixes
<strong>url:</strong>, <strong>naam:</strong>, <strong>omschr:</strong>,
<strong>alles:</strong>. De standaard is <strong>naam:</strong> en kan aangepast
worden in "Gebruikers Instellingen".

<p><strong>Zoeken</strong> - Hetzelfde als filter maar wordt op de backend server
uitgevoerd en in een ander venster getoond.

<p><strong>Doorzoek het Web</strong> - Wordt getoond in de gevallen waar Web Zoeken
toegestaan en geconfigureerd is.

<p><strong>Klap alles in</strong> - Klapt alle structuren in. Indien er voor een tweede maal
wordt geklikt zullen alle structuren (als deze ingeklapt waren) uitgeklapt worden.

<p><strong>Herlaad met verborgen mappen</strong> - Herlaad alle links van de server,
inclusief de map die verborgen is via het commando "Verberg map".

<p><strong>Herlaad</strong> - Herlaad alle links van de server, deze functie is aanwezig
omdat de plugin in het zijvenster wordt getoond waar de gebruiker, afhankelijk van de browser,
niet altijd de mogelijkheid heeft om het venster te vernieuwen.
_P;

$help['200'] = <<<_P
Commando's zijn gegroepeerd in diverse logische groepen.
Selecteer een van de groepen om de uitleg te zien voor het commando.
_P;

$help['210'] = <<<_P
<p><strong>Aanmelden</strong> - Meld de gebruiker aan, de gebruiker
wordt altijd onthouden met cookies.
De gebruiker kan aangeven wanneer het cookie moet verlopen.

<p><strong>Afmelden</strong> - Meld de gebruiker af. Dit dient altijd
te worden gebruikt op publieke computers. Vergelijkbaar is om het
aanmelden met een sessie te gebruiken en hierna alle vensters te sluiten.

<p><strong>Word lid</strong> - Een bezoeker kan lid worden van het systeem.
Op basis van het e-mail adres kan de gebruiker zich wellicht bij bepaalde
groepen aansluiten. In dit geval dient het e-mail adres geverifieerd te worden.
Dit gaat automatisch door de gebruiker een verificatie e-mail te sturen.
De beheerder van het systeem can het aanmelden van nieuwe gebruikers uitzetten.
Bovendien kan de beheerder verificatie van het email adres verplicht stellen
om SiteBar te kunnen gebruiken, danwel kiezen voor handmatige acceptatie.
_P;

$help['220'] = <<<_P
<p><strong>Installatie</strong> - Het eerste commando dat de beheerder ziet
tijdens de installatie van SiteBar, nadat een database is opgezet.
Een beheerders account zal worden gecreëerd en standaard sitebar parameters
worden ingesteld. Indien de "Persoonlijke mode" optie is gekozen,
is slechts een subset van de functionaliteit beschikbaar.

<p><strong>SiteBar instellingen</strong> - Beheerders kunnen later de SiteBar
parameters nog veranderen. Beheerders zijn lid van de Beheerders Groep,
net als de gebruiker die tijdens het "Installatie" commando is gecreëerd.
Zie "Word lid" voor een uitleg van de email functie.
Verdere email functionaliteit is gepland voor toekomstige releases.

<p><strong>Maak structuur aan</strong> - Afhankelijk van de SiteBar instellingen
kunnen beheerders en/of gebruikers met geverifiëerde email nieuwe structuren aanmaken.
Wanneer een nieuwe structuur wordt aangemaakt, moet deze worden geassociëerd met
een bestaande gebruiker (alleen een beheerder kan een structuur aanmaken voor iemand anders).
De standaard manier om team-favorieten aan te maken is een nieuwe structuur te creëren,
om die vervolgens aan de gebruiker toe te wijzen die de groep modereert. Deze groep wordt
apart aangemaakt via "Maak groep aan". De moderator kan dan rechten in de nieuw aangemaakte
structuur toekennen aan de groepsleden, en kan tevens leden aan de groep toevoegen.
_P;

$help['230'] = <<<_P
<p><strong>Gebruikersinstellingen</strong> - Verander gebruikers instellingen.
Indien "Externe besturing" niet is aangevinkt, wordt het Commander venster getoond
in het venster van SiteBar, in plaats van een extern venster te openen.
Sommige commando's openen altijd in het bestaande venster ("Aanmelden", "Afmelden",
"Word lid", "Gebruikersinstellingen"). Indien "Geen verwerkt berichten" is aangevinkt
zal geen bevestiging getoond worden van succesvol uitgevoerde commando's.
"Markeer ACL mappen" zal die folders markeren waar beveiligingen aangebracht zijn.
Het activeren van deze instelling vertraagt het afbeeelden van SiteBar op het scherm.

<p><strong>Lidmaatschap</strong> - Gebruikers kunnen elke groep verlaten, en zich
bij geopende groepen aanmelden. Een gebruiker zal een groep niet kunnen verlaten
indien dat zou betekenen dat de groep daarmee de laatste moderator verliest.
In dat geval moet contact worden opgenomen met de beheerder om de groep te laten verwijderen.

<p><strong>E-mail bevestiging</strong> - Hiermee kan de gebruiker zijn email adres bevestigen
om toegang te krijgen tot de overige systeem functies.
_P;

$help['240'] = <<<_P
<p><strong>Gebruikersbeheer</strong> - Toont een lijst van gebruikers,
de volgende commando's kunnen worden uitvoerd:

<p><strong>Bewerk gebruiker</strong> - Momenteel kan een vergeten wachtwoord
alleen worden hersteld door een tijdelijk wachtwoord in te stellen,
dit naar de gebruiker te emailen en hem/haar vragen dit te veranderen.
De beheerder kan een account als demo kenmerken, wat de gebruiker zal
verhinderen een aantal eigenschappen te wijzigen, met name het wachtwoord.

<p><strong>Verwijder gebruiker</strong> - Verwijdert de gebruiker en alle
lidmaatschappen. Wijst bestaande structuren toe aan een andere gebruiker.
Het is niet mogelijk om een gebruiker te verwijderen als die de enige
moderator van een groep is.

<p><strong>Maak gebruiker aan</strong> - Analoog aan "Word lid",
dit is bestemd voor de beheerder. De email adressen van aangemaakte
gebruikers worden door Sitebar gezien als zijnde bevestigd.
_P;

$help['250'] = <<<_P
<p><strong>Groepenbeheer</strong> - Toont een lijst met groepen,
de volgende commando's zijn beschikbaar:

<p><strong>Groep eigenschappen</strong> - Toegankelijk voor moderatoren
van de groep. Veranderd kunnen worden groepsnaam, commentaar en
automatisch aanmelden e-mail reguliere uitdrukkingen (RegExp). Wanneer
het masker "automatisch aanmelden e-mail RegExp" is ingevuld en past op
het email adres bij het aanmelden van een nieuwe gebruiker, zal aan de
gebruiker gevraagd worden het email adres te bevestigen. Na verificatie
wordt de gebruiker automatisch groepslid. Indien "Sta zelf toevoegen toe"
is geactiveerd, hoeft het email adres niet te worden geverifiëerd
om automatisch lid te worden.

<p><strong>Groepsleden</strong> - Enkel moderatoren kunnen gebruikers
aanwijzen als leden. Een andere moderator kan niet worden de-selecteerd, de
moderator rol moet eerst worden verwijderd met hulp van het volgende commando.

<p><strong>Groepsmoderatoren</strong> - Toegankelijk voor moderatoren van
de groep. Er moet altijd minstens een moderator gedefiniëerd zijn.

<p><strong>Verwijder groep</strong> - Slechts toegankelijk voor beheerders.
Verwijdert een groep en alle ertoe behorende lidmaatschappen.

<p><strong>Maak groep aan</strong> - Slechts toegankelijk voor beheerders.
Maakt een groep aan en specificeert de eerste moderator van de groep.
_P;

$help['260'] = <<<_P
<p><strong>Voeg map toe</strong> - Voegt een nieuwe submap toe aan de map.

<p><strong>Voeg link toe</strong> - Voegt een link toe aan de map.
Indien uitgevoerd vanuit de bookmarklet is de gebruiker in staat
een doel map te selecteren, anders wordt de link gecreëerd in de map
van waaruit het commando werd aangeroepen.

<p><strong>Bekijk map</strong> - Doorloopt een map structuur in "directory" aanzicht.
Slechts een map wordt per keer getoond met daarin details voor de links.

<p><strong>Toon alle links</strong> - Toont alle links van alle onderliggende mappen tegelijkertijd.

<p><strong>Toon link nieuws</strong> - Toont het nieuws over deze map en die er onder.

<p>

<p><strong>Verberg map</strong> - Verbergt de map. Wordt gebruikt om de publieke mappen
van andere gebruikers of zelden gebruikte mappen te verbergen. Een klik op het ikoon voor
"Herlaad met verborgen mappen" zal alle mappen tijdelijk laden.
Het "Toon verborgen submappen" commando kan worden gebruikt om verborgen mappen
permanent zichtbaar te maken. Verborgen structuren kunnen worden zichtbaar gemaakt
via "Beheer structuren -> Toon verborgen structuren".

<p><strong>Toon verborgen submappen</strong> - Maakt alle verborgen submappen
van de aangeklikte map zichtbaar.

<p><strong>Map eigenschappen</strong> - Specificeer map eigenschappen
 - naam en omschrijving.

<p><strong>Verwijder map</strong> - Verwijdert de map. Het verwijderen van
de map kan ongedaan worden gemaakt via het "Maak ongedaan" commando of door
opnieuw een map toe te voegen met dezelfde naam. De gebruiker kan zelfs de
eigen hoofd map verwijderen, de verwijdering wordt pas onherroepelijk wanneer
het "Verwijder map definitief" commando is uitgevoerd in die map.
Het verwijderen van een hoofd map kan slechts worden ongedaan danwel
definitief gemaakt worden door de eigenaar van de map.

<p><strong>Verwijder map definitief</strong> - Hiermee worden eerder verwijderde
mappen en links in de geselecteerde folder definitief en onherroepelijk gewist.
Het is voor niemand nog mogelijk een verwijdering ongedaan te maken,
na een wis commando via "Verwijder map definitief"!

<p><strong>Maak ongedaan</strong> - Haal eerder verwijderde folders of links
terug, tenzij ze "definitief verwijderd" zijn. Indien een hoofd map is verwijderd
wordt die gewoonlijk weergegeven met een uitgegrijsd ikoon, en is enkel nog
zichtbaar voor de eigenaar van de map structuur. Dit laatste beschermt tegen het
ongewilde verlies van gedeelde favorieten na het per ongeluk verwijderen door
een medegebruiker met privileges.

<p>

<p><strong>Kopieer</strong> - Kopieer map met de volledige inhoud naar het interne klembord.

<p><strong>Plak</strong> - Slechts beschikbaar na het uitvoeren van een
"Kopieer" of "Kopieer Link" commando wanneer een object zich in het klembord
bevindt. Het "Plak" commando laat de gebruiker bepalen of het object
verplaatst of gekopieerd moet worden.
Bij "Gebruikersinstellingen" kan hiervoor een standaard gedrag worden ingesteld.

<p>

<p><strong>Importeer favorieten</strong> - Importeert favorieten vanuit een
extern bestand naar de map. In deze fase worden geen link checks uitgevoerd
om timeouts aan de kant van de server te vermijden.

<p><strong>Exporteer favorieten</strong> - Exporteert de inhoud van de map
naar een extern favorieten bestand. Ondersteund worden het Netscape favorieten
bestandsformaat + Opera Hotlist. Mozilla gebruikt het Netscape favorieten
bestandsformaat en Internet Explorer kan exporteren naar en
importeren vanuit dit bestandsformaat.

<p><strong>Valideer Links</strong> - Valideer alle links in de map en alle submappen.
De validatie vereist de aanwezigheid van een uitgaande netwerk connectie.
Gedurende validatie is het mogelijk om de bijbehorende favicons op te zoeken,
danwel favicons te verwijderen die nooit in de favicon tussenopslag zaten
(mogelijk foute links). De validatie pagina toont een lijst van alle links die
getest worden. Validatie gebeurt door het ophalen en tonen van het icoon voor iedere link.
Een standaard 'link' icoon wordt getoond wanneer geen favicon gevonden werd.
In het geval van een dode link wordt een 'fout' favicon plaatje getoond.
Indien de link verwijzing bestaat en er ook een favicon bij gevonden is,
zal dit favicon getoond worden.
Wanneer het aantal te valideren links erg groot is, kan het gebeuren dat de browser
een foutmelding geeft vanwege de lange tijdsduur. In dat geval is het voldoende
om de pagina opnieuw te laden. De reeds geteste links zullen worden genegeerd
en de gebruiker kan zo alle links in gedeelten valideren. Dode links worden enkel
als zodanig gemarkeerd en niet verwijderd.
Ze zullen in SiteBar als doorgestreepte tekst zichtbaar zijn.

<p><strong>Beveiliging</strong> - Specificeer toegangsrechten voor iedere map.
De rechten op een map gelden ook voor alle onderliggende mappen.
Zie de "Beveiligings beheer" sectie voor meer informatie.
_P;

$help['270'] = <<<_P
<p><strong>E-mail link</strong> - Een link kan naar een ander persoon
worden verstuurd via email. Gebruikers met een geverifiëerde email
zijn bereikbaar via het interne mail systeem,
voor andere gebruikers moet een extern programma worden gestart.

<p><strong>Kopieer link</strong> - Kopieer een link naar het interne
klembord. Gebruik het "Plak" commando op een folder om de link
hier naar toe te verplaatsen danwel te kopiëren.

<p><strong>Verwijder Link</strong> - Verwijder link uit de node.
De verwijderde link kan nog worden terug gehaald door het "Maak ongedaan"
commando uit te voeren op de bovenliggende map.

<p><strong>Eigenschappen</strong> - Wijzig de eigenschappen van een link.
Een link kan hier als "privé" worden gekenmerkt.
_P;

$help['300'] = <<<_P
SiteBar 3 is volledig herschreven sinds de 2.x reeks en representeert
daarmee de voortdurende evolutie van SiteBar.

<p>

SiteBar 3 maakt niet langer gebruik van JavaScript voor het weergeven
van de favorieten structuren. Wel wordt JavaScript veelvuldig ingezet
bij het tonen van context menu's, en om nodes in- en uit te klappen
inclusief de veranderingen in de ikonen.
Het <a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a>
moet wel worden ondersteund door de browser. Het voordeel hiervan is
het zeer snelle en incrementele laden van favorieten. Het nadeel is dat
oudere browsers de favorieten structuur alleen uitgeklapt kunnen zien en
er slechts lees-toegang toe hebben (wat op zich een vooruitgang is omdat
SiteBar in de versies 2.x helemaal niet werkte op oudere browsers).

<p>

Aan de kant van de server worden de gegevens opgeslagen in een zeer
eenvoudige recursieve data structuur die geoptimaliseerd is voor aanpassingen
in boomstructuren. Dit zorgt voor een goede performance bij selecties.
Dankzij de geïndexeerde database tabellen worden selecties niet trager bij grote aantallen links.
_P;

$help['302'] = <<<_P
SiteBar 3 controleert rechten van gebruikers twee maal. De gebruiker
krijgt slechts die commando's in de menu's te zien waar hij toegang
toe heeft, en vervolgens wordt telkens voor het uitvoeren van een
commando nogmaals geverifiëerd of de gebruiker daartoe gerechtigd is.

<p>

Het systeem kent drie basis rollen; gebruikers, moderatoren en
beheerders. Moderatoren zijn gebruikers die deze rol toegewezen
hebben gekregen bij het aanmaken van een nieuwe groep, danwel door
een andere moderator. Een moderator is een rol die aan een specifieke
groep gebonden is. Beheerders zijn alle leden van de Beheerders
groep plus de eerste gebruiker die aangemaakt werd bij het
"Installatie" commando. Beheerders bezitten niet de rechten om als
moderatoren op te treden in een groep.
Ze kunnen echter wel hele groepen verwijderen.

<p>

SiteBar 3 is ontwikkeld omdat er behoefte was aan functionaliteit
voor meerdere teams. Dat betekent dat groepen gebruikers hun favorieten
kunnen delen. Om de privacy van team favorieten te kunnen garanderen
is een mechanisme voor toegangscontrole ontwikkeld.

<p>

Het basis principe is dat de eigenaar van de hoofdfolder van een
boomstructuur daarin ook alle rechten bezit. Op het moment van lidworden
of bij het aanmaken van een gebruiker wordt voor hem of haar een
hoofd folder aangemaakt. Tevens hebben beheerders de mogelijkheid
om additionele boomstructuren aan te maken voor een gebruiker en
kunnen eventueel zelfs toestaan dat gebruikers hun eigen
boomstructuren kunnen aanmaken.

<p>

Op een SiteBar boomstructuur kunnen rechten worden toegekend aan aanwezige groepen.
De volgende rechten zijn beschikbaar voor iedere gebruikers groep:

<p><strong>Lezen</strong> - Ieder lid van de groep kan de favorieten
gebruiken. Wil iemand deze favorieten niet zien, dan zal hij of zij
de groep moeten verlaten.

<p><strong>Toevoegen</strong> - Groepsleden kunnen mappen en links toevoegen.

<p><strong>Bewerken</strong> - Groepsleden kunnen de eigenschappen van
links en mappen bewerken.

<p><strong>Verwijderen</strong> - Links en mappen kunnen verwijderd worden.

<p><strong>Definitief verwijderen</strong> - Wis een tevoren verwijderde
link of map definitief. In combinatie met het "Verwijderen" recht
kunnen hiermee mappen van de ene structuur naar de andere worden verplaatst.

<p><strong>Toekenning</strong> - Groepsleden krijgen dezelfde rechten
op de boomstructuur als de eigenaar ervan.

<p>

Rechten worden altijd vererfd van de bovenliggende map. Aan de hoofdmap
is geen enkel recht gekoppeld. Indien de gebruiker de toegang tot een map
beperkt, heeft dit invloed op de daaronder liggende mappen.
Indien toegekende rechten voor een bepaalde map identiek zijn aan die
van de bovenliggende map, worden deze rechten verijderd en wordt in
plaats daarvan het verervings principe gebruikt.

<p>

Het is aan groep moderatoren altijd toegestaan om rechten te verwijderen
die voor hun groep door een andere gebruiker zijn aangebracht.

<p>

Naast het map beveiligings mechanisme is er een instelmogelijkheid
voor links, die ervoor zorgt dat bepaalde links als prive kunnen worden
aangemerkt in een anderszins openbare map. De eigenaar van een boomstructuur
kan een link als prive bestempelen, wat deze link onzichtbaar maakt voor
andere gebruikers. Het is niet nodig om een link als prive te bestempelen
indien er op map niveau toch geen gedeelde toegang is gedefiniëerd
(en standaard is een map zonder gedeelde toegang ingesteld).

<p>

Hoe groter het aantal toegangs controle specificaties op map niveau,
des te langer duurt het voor de gebruikers om de favorieten te laden.
Toegangs specificaties moeten daarom met beleid worden toegepast
op diep vertakte structuren.

<p>

Indien een beheerder van SiteBar de "Persoonlijke mode" activeert,
zijn de commando's voor toegangscontrole niet meer beschikbaar. Wel kunnen
mappen nog openbaar worden gemaakt door "Publiceer map" te selecteren
in de "Map eigenschappen". Wanneer deze mode actief is, kunnen de rechten
op een onderliggende map van een gepubliceerde map niet weer worden ingeperkt.

De beheerder van SiteBar kan onbeperkt wisselen tussen de persoonlijke en
de "enterprise" mode (die standaard geactiveerd is). In de persoonlijke mode
is het echter niet mogelijk om groepsrechten te verwijderen die in de
enterprise mode zijn toegekend - behalve van de groep "Iedereen".
_P;

$help['303'] = <<<_P
In SiteBar kunnen aangepaste opmaak stijlen worden gecreëerd.
Een gedegen kennis van CSS is vereist bij het ontwerpen van een opmaak
en voor een volledige aanpasssing is kennis van XSLT vereist.
Bij het creëren van een nieuwe opmaak kan een bestaande opmaak als
startpunt worden genomen. Dat betekent dat een willekeurige bestaande
opmaak uit de folder "skins" kan worden gekopieerd naar een nieuwe folder.
Een opmaak bestaat uit
<ul>
<li> Een reeks van plaatjes (pas deze simpelweg aan zolang ze maar in
PNG formaat worden opgeslagen.
<li> Een PHP bestand met plaatshouders "hook.inc.php", dit bestand wordt
door andere onderdelen gebruikt om informatie over de actuele opmaak
op te vragen (bijv. de auteur).
<li> Commmon style sheet "common.css" dat de kleurdefinities bevat die
met andere style sheets wordt gedeeld.
<li> Een Style Sheet voor het Sitebar paneel genaamd "sitebar.css".
<li> De XSLT gebaseerde schrijvers gebruiken sheets voor het tonen van
link nieuws "news.css", voor het bekijken van folders "directory.css"
en voor backend zoekopdrachten "search.css".
</ul>

<strong>XSL</strong> - het is mogelijk om de presentatie van de XML gebaseerde
SiteBar uitvoer compleet te veranderen door een eigen XSL stylesheet
beschikbaar te stellen. In dat geval moet een van de skins/*.xsl.php bestanden
naar de skin folder worden gekopieerd en vervolgens aangepast.

<p>
<strong>CSS</strong> - met uitzondering van de common stylesheets
worden alle andere stylesheets ontworpen als een superset van de
common stylesheet en het corresponderende common stylesheet uit de skins folder.
De auteur van de opmaak kan de standaard waarden hierin opnieuw definieren.

<p>
<strong>Identiteit</strong> - Sommige beheerders willen wellicht een opmaak
creëren die past bij de vormgeving van hun website. In dat geval is het
aan te bevelen om alle andere opmaken te verwijderen en de standaard opmaak
vast te leggen in de SiteBar instellingen.

<p>
Indien U uw eigen opmaak aan de SiteBar distributie toegevoegd zou willen zien,
moet U contact opnemen met de ontwikkelaars en de opmaak testen
met de meest recente stabiele ontwikkelversie. Als vuistregel wordt gesteld
dat het SiteBar logo op de pagina aanwezig moeten zijn, maar
het SiteBar logo mag in principe willekeurig worden aangepast.
_P;

$help['304'] = <<<_P
SiteBar is opgebouwd rond het concept van schrijvers, die worden gebruikt om Sitebar uitvoer te produceren op diverse manieren. Het hoofd SiteBar paneel is zelf het product van een schrijver.
<p>
Alle schrijvers erven van de <strong>SB_WriterInterface</strong> klasse in
<strong>inc/writer.inc.php</strong> en worden geplaatst in de <strong>inc/writers</strong> subfolfer.
Om uitvoer te genereren hoeft slechts een beperkt aantal methoden worden vervangen
en het is zelfs mogelijk om een van de bestaande schrijvers te gebruiken en ervan te
erven (zoals veel van de eigen Sitebar schrijvers doen die gebaseerd zijn op het XBEL formaat).
_P;

$help['305'] = <<<_P
Om een bestaande SiteBar installatie te migreren naar een andere server
moet het volgende gebeuren:
<ul>
  <li>Exporteer de sitebar_* tabellen uit de bron database naar een .SQL bestand.
  <li>Importeer dit bestand in de doel database.
  <li>Verplaats de gebruikte SiteBar software of installeer een willekeurige
      stabiele SiteBar versie (het af- danwel opwaarderen verloopt automatisch).
  <li>Verwijder inc/config.inc.php of pas dit bestand aan in geval
      de database connectie details veranderd zijn.
</ul>

<p>
Het exporteren en importeren kan worden uitgevoerd met <a href="http://www.phpmyadmin.net/">phpMyAdmin</a>.
De tabel sitebar_favicon (tot 3.2.6) of sitebar_cache (vanaf 3.3) hoeft niet
te worden overgezet, omdat zijn inhoud opnieuw zal worden opgebouwd.
_P;

?>
