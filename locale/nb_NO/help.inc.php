<?php

$help['100'] = <<<_P
SiteBars funksjoner er tilgjengelig fra <strong>brukermenyen</strong> og fra <strong>kontekstmenyer</strong>. Brukermenyen er menyen du finner under bokmerketreet i SiteBar-panelet. Kontekstmenyene får du fram ved å høyreklikke på mapper og lenker. Men i noen nettleser virker dette annerlede. Brukere av Opera og Apple kan kan enten Ctrl+klikke i stedet, eller - hvis det ikke funker - gå inn i sine "Brukerinnstillinger" på brukermenyen, og krysse av for "Vis menyikon". Du får da fram et ekstra menyikon på alle mapper og lenker. Ved å klikke på det få du opp kontekstmenyen.
<p>
Merk at kontekst- og brukemenyene kan viser forskjellige sett av kommandoer for forskjellige typer brukere, og avhengig av om SiteBar kjører i brukermodus eller i standardmodus. Merk også at i kontekstmenyer kan valg være grået ut for vanlige brukere, siden eiere av trær, og moderatorer, kan begrense rettigheter til noder (lenker og mapper). Du kan eksempelvis kun ha rett til å lese, men ikke til å legge inn, slette osv. Når du klikker på et menyvalg, får du opp et kommandovindu. Det er her kommandoer utføres.
_P;

$help['101'] = <<<_P
Klikk på en mappe / lenke med musa og dra muspekeren over en annen mappe - mens du holder knappen nede. Hvis dette virker vil den mappa du drar til, bli markért.
<p>
Opera: Dra & Slipp er ikke implementert for nettleseren Opera. Operabrukere kan bruke kontekstmenyen og velge "Kopier" og "Lim inn", i stedet.
_P;

$help['103'] = <<<_P
<p><strong>Filter</strong> - filtrerer ut lenker som vises fra fronten i
SiteBar.  Det er mulig å angi hva som skal filtreres bort ved følgende 
prefikser <strong>url:</strong>, <strong>navn:</strong>, <strong>beskr:</strong>,
<strong>alle:</strong>. Standarprefikset er <strong>navn:</strong> og kan 
endres i "Brukerinnstillinger"

<p><strong>Søk</strong> - Det samme som søk, men behandlet fra backend 
og vist på en annen måte. 

<p><strong>Websøk</strong> - vises når websøk er tillatt og konfigurert.

<p><strong>Skjul alle</strong> - Skjuler alle noder. Utvides igjen når du
klikker en gang til på en node (når alle noder allerede er skjult).

<p><strong>Oppdater med skjulte mapper</strong> - Oppdaterer alle lenker fra
tjener, inkludert mapper som er skjult med kommandoen "Skjul mapper".

<p><strong>Oppdater</strong> - Oppdaterer alle lenker fra tjeneren. Denne
funksjonen er her fordi en plugin befinner seg i et sidepanel som brukeren
kansje ikke har tilgang til å oppdatere fra (avhengig av nettleser).
_P;

$help['200'] = <<<_P
Kommandoer er ordnet i flere logiske grupper. Vennligst velg en
av disse gruppene for å finne hjelp for kommandoen.
_P;

$help['210'] = <<<_P
<p><strong>Logg inn</strong> - Logger bruker på systemet, og brukeren blir altid
husket ved hjelp av cookies (informasjonskapsler). Brukeren kan spesifisere når
informasjonskapselen skal utgå.

<p><strong>Logg ut</strong> - Logger ut bruker. Dette bør altid brukes på
offentlige terminaler. Det er likeverdig med å bruke logginn med sessjonsvarighet
og til nettleservindu er lukket.

<p><strong>Registrer</strong> - Tillater besøkere å registrere seg på systemet.
Basert på brukerens epostadresse kan brukeren kvalifisere for medlemsskap i visse 
grupper. I slike tilfeller må epostadressen verifiseres. Dette gjøres automatisk
ved å sende en verifikasjonsepost til bruker. Systemets admin kan slå av
registrering for nye brukere. I tillegg kan admin kreve at epostadressen må være 
verifisert før brukeren får tilgang til SiteBar, og også kreve manuell godkjennelse 
av konto.
_P;

$help['220'] = <<<_P
<p><strong>Oppsett</strong> - Den første kommando en administrator vil se under
installasjon av SiteBar, og etter å ha fått opp databasen. En adminkonto blir da
være opprettet og grunnleggende parametere for SiteBar. Når alternativet
"Personlig modus" er valgt vil bare en undergruppe av funksjoner være tilgjengelig.

<p><strong>SiteBar-innstillinger</strong> - Administratorer kan senere endre
SiteBars parametere. Administratorer er medlem av Admin-gruppen og brukeren
som settes opp med kommandoen "Oppsett". Se "Registrer" for forklaring av
epostfunksjoner. Det er planlagt flere epostfunksjoner i senere utgiverlser
av programmet.

<p><strong>Opprett tre</strong> - Avhengig av SiteBar-innstillingene, kan bare
admin og/eller brukere med verifisert epostadresse opprette nye trær. Når et
nytt tre blir opprettet, må det tilknyttes en eksisterende bruker (bare admin
kan opprette trær for andre). Måten som er standard for å opprette team-bokmerker
er å opprette et nytt tre og tilknytte det til brukeren som moderere gruppen
som da er opprettet separat gjennom "Opprett gruppe". Denne bruker kan så
tillate (grant) rettigheter for det nye treet til gruppens medlemmer. Moderator
kan også legge til brukere til gruppen.
_P;

$help['230'] = <<<_P
<p><strong>Brukerinstillinger</strong> - Endre brukerinnstillingers. Når det er
krysset av for "Ekstern kommandohåndtering", vil kommandovinduet åpnes der SiteBar
befinner seg i stedet for i et eksternt vindu. Noen kommandovinduer åpnes altid
i samme vindu som SiteBar ("Logg inn", "Logg ut",  "Registrer",
"Brukerinnstillinger"). Når du har krysset av for "Ikke vis kjøringsmeldinger"
vil du ikke få opp noe bekreftelsesvindu når kommandoer blir vellykket utført.
Innstillingen "Dekorer ACL-mapper" vil markere de mapper som det er sikkerhets-
spsifikasjoner på. Denne bryteren gjør SiteBar tregere.

<p><strong>Medlemsskap</strong> - Brukere kan forlate grupper og delta i åpne
grupper. Brukere kan ikke kan ikke forlate en gruppe hvis gruppen da ville miste
sin siste moderator. I slike tilfeller bør admin kontaktes slik at gruppen kan
slettes.

<p><strong>Verifiser epost</strong> - Lar brukere verifisere sin epostadresse
for å kunne bruke andre systemfunksjoner.
_P;

$help['240'] = <<<_P
<p><strong>Vedlikehold brukere</strong> - Viser en liste boks over brukere som
lar følgende kommandoer bli kjørt.

<p><strong>Modifiser bruker</strong> - For tiden er den eneste måten å
gjenvinne et glemt passord å sette et midlertidig, eposte det til brukeren
og be vedkommende om å endre det. Administratorer kan markere en konto som
en demo, noe som fjerner tillatelsern til å endre visse egenskaper, særlig
passord.

<p><strong>Slett bruker</strong> - Sletter brukeren og alle medlesskap.
Tilordner det eksisterende tre til en annen bruker. Det er ikke tillatt å slette
en bruker som er den eneste moderator i en gruppe.

<p><strong>Opprett bruker</strong> - Det samme som "Registrer" men denne
er ment for administratorer. Epostadressene til opprettede brukere anses
som verifisert.
_P;

$help['250'] = <<<_P
<p><strong>Vedlikehold Grupper</strong> - Viser en listeboks med grupper og
lar følgende kommandoer bli kjørt.

<p><strong>Egenskaper for gruppe</strong> - Tilgjengelig for moderatorer av
gruppen. Tillater deg å endre gruppenavn, kommentarer, og å sette på
automatisk deltakelse gjennom en epost rexexp (rexexp = "regular expression").
Når autodeltaregexp-en  blir fyllt inn og den matcher den epostadresse en ny
bruker bruker ved registrering, så vil bruker når vedkommende verifiserer
sin epostadresse, automatisk bli et medlem av gruppen. Når det blir merket
av for avkryssingsboksen "Tillat å legge til deg selv", behøver ikke eposten
å bli verifisert for at autodeltakelse.

<p><strong>Gruppemedlemmer</strong> - Bare moderatorer kan velge hvilke
brukere som skal være meldemmer. Du kan ikke fjerne andre moderatorer. Først
må da moderatorens rolle fjernes, og det ved følgende kommandoer.

<p><strong>Gruppemoderatorer</strong> - Tilgjengelig for moderatorer for en
grupper. Det må altid være minst en moderator.

<p><strong>Slett gruppe</strong> - Tilgjengelig kun for administratorer. Sletter
en gruppe og alle medlemsskap.

<p><strong>Opprett gruppe</strong> - Tilgjengelig kun for administratorer.
Oppretter en gruppe og spesifiserer den første moderator for gruppen.
_P;

$help['260'] = <<<_P
<p><strong>Legg til mappe</strong> - Legger til en ny undermappe til mappen.

<p>

<p><strong>legg til lenke</strong> - Legger til lenke til mappen. Når den kjøres
fra "bookmarklets" lar den brukeren velge en målmappe. Hvis ikke blir den opprettes
i dne mappen du klikket på.

<p><strong>Bla i mapper</strong> - Bla i mapper i emneindeksmodus. Bare en mappe vises av gangen og deltaljer vises for lenkene.

<p><strong>Vis alle lenker</strong> - Viser lenker i alle undermapper på en gang.

<p><strong>Vis Lenkenyheter</strong> - Vis nyheter om denne mappen og inkluder undermapper. 

<p>

<p><strong>Skjul mappe</strong> - Skjuler mappen. Dette brukes for å skjule andre brukeres publiserte mapper eller skjelden brukte mapper. Et klikk på ikonet "Oppfrisk med skjulte mapper" vil laste alle mapper midlertidig. Kommandoen "Ta frem undermapper" kan brukes for å få skjulte mapper varig fram. Skjulte trær kan du få fram ved å bruke "Vedlikehold trær -> Få fram Trær". 

<p><strong>Ta fram undermapper</strong> - Ingen av undermapper skjules på den mappa du klikket på. 

<p><strong>Egenskaper for mappe</strong> - Spesifisere egenskaper for mappe - navn
og beskrivelse.

<p><strong>Slett mappe</strong> - Sletter mappe. Den slettede mappen kan gjenopprettes
med kommandoen "Gjenopprett", eller ved å legge til en mappe med samme navn. Brukere
kan slette sin egen rotmappe. Imidlertid er slik sletting kun gyldig etter at en har
kjørt Rens på denne mappen.

<p><strong>Rens mappe</strong> - Renser bort tildligere slettede mapper og lenker,
slik at de ikke kan gjenopprettes, innenfor en valgt mappe. Det er ikke mulig å
gjeopprette i en mappe etter at mappen er renset!

<p><strong>Gjenopprett</strong> - Gjenopprett tidligere slettede mapper og lenker,
såfremt mappen ikke er renset. Når en rotmappe blir slettet, blir ionet vist i en
gråtone, og er synlig kun for eieren av treet. Dette hindrer mulig tap av alle
delte bokmerker ved en tilfeldig sletting/rensing gjort av andre priviligerte
brukere.

<p><strong>Kopier</strong> - Kopier mappe og hele dens innhold til den interne
utklippstavle.

<p><strong>Lim inn</strong> - Tilgjengelig bare etter kjøring av kommandoene
"Kopier" eller "Kopier lenke".  Kommandoen "Lim inn" styrer om brukeren kan
flytte innholdet eller bare kopiere det, gjennom den standarverdi som er satt
for kommandoen. Men brukeren kan fortsatt velge å kopiere eller flytte.


<p><strong>Importer bokmerker</strong> - Importere bokmerker fra en ekstern
fil til en mappe. Ingen validering av lenker foretas i dette trinnet. Det for
å unngå tidsavbrudd fra tjeneresn side.

<p><strong>Eksporter bokmerker</strong> - Eksporterer innholdet av en mappe til
en ekstern bokmerkefil. Det er også støtte for Netscapes bokmerkefilformat +
Opera Hotlist. Mozilla bruker Netscapes format og Internet Explorer kan eksportere
og importere til og fra dette formatet.

<p><strong>Valider lenker</strong> - Validerer alle lenker i mappe og undermapper.
Valideringen krever en en utgående forbindelse. I løpet av valideringen er det mulig
å oppdage favikoner eller slette favikoner som ikke finnes i mellomlagerer for
favikoner (muligens feil favikon). Valideringssiden viser en liste over alle lenker
som blir testet. Valideringen gjennomføres ved å gjenvinne og vise ikonet for
hver lenke. Standard lenkeikon vises når et favikon ikke blir funnet, i tilfellet
av en død lenke blir et bilde som viser at favikonet er feil. I tilfellet lenka er
gyldig og et favikon eksisterer blir favikonet vist. Det kan forekommet at når det
er mange lenker, at nettleseren kan feile. I slike tilfeller kan brukeren bare
oppdatere siden. Nylig sjekkede sider blir ignorert. Brukeren kan validere lenker
en for en. Døde lenker vil kun bli markert med en gjennomgående linje, og ikke
slettet.

<p><strong>Sikkerhet</strong> - Lar deg spesifisere rettigheter for enhver mappe.
Rettighetene for en mappe blir gjeldende for alle undermapper. Se seksjonen
"Sikkerhetshåndtering" for nærmere informasjon.
_P;

$help['270'] = <<<_P
<p><strong>Epostlenke</strong> - Tillater en lenke å bli sendt via epost til
en annen person. For brukere med verifisert epost kan interne epostfunksjoner
på server brukes. Andre brukere må bruke sin eksterne epostleser.

<p><strong>Kopier lenke</strong> - Kopier lenke til den interne utklippstavla.
Bruk kommandoen "Lim inn" på mapper for å kopiere/flytte lenker til denne noden.

<p><strong>Slett lenke</strong> - Sletter lenke fra noden. Slettet lenke kan
gjenopprettes ved bruk av kommandoen "Gjenopprett" i foreldremappa.

<p><strong>Egenskaper</strong> - Redigere egenskaper for en lenke. Lar deg sette
lenka som privat.
_P;

$help['300'] = <<<_P
SiteBar 3 er fullstendig omskrevet fra versjonene i serien 2.x, noe som
skulle vise at SiteBar virkelig er under utvikling.
<p>
SiteBar 3 bruker ikke lenger noe JavaScript for å generere bokmerke-trær. Javascript
brukes imidlertid tung for visninge av kontekstmenyer og for å utvide/slå sammen noder
herunder endring av ikoner.

<a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a>
må være støttet av nettleseren. Fordelene med det er en raskere og voksende lasting
av bokmerker. Ulempen er at eldre nettlesere kun kan se bokmerketreet utfoldet, og
at de kun har lesetilgang (noe som riktignok fortsatt er en forbedring fra versjon
2.x som ikke viste noe i slike lesere i det hele tatt).
<p>
På tjenersiden blir data lagret i den enkleste mulige rekursive datastruktur, og den
er optimert for å lette endringer i treet. Dette gir meget god ytelse ved selektering.
Takket være databasetabellenes indekser skulle selektering ikke saknes selv om du har
et stort antall lenker.
_P;

$help['302'] = <<<_P
SiteBar 3 har dobbelsjekk på brukerrettigheter. Brukeren vises kun en undergruppe
av kommandoer basert på vedkommendes rettigheter og hver kommando som utføres blir
verifisert for andre gang rett før den kjøres.
<p>
Systemer har tre typer roller: Brukere, moderatorer, og administratorer. Moderatorer
er brukere som blir satt som moderatprer når en gruppe opprettes eller av andre
moderatorer.
En moderator er en rolle knyttet til enkeltgrupper kun. Administratorer er medlemmer
av Admin-gruppen pluss den første bruker opprette med kommandoen "Oppsett".
Administratorer har ikke rett til å fungere som moderatorer. De kan imidlertid
slette hele grupper.
<p>
SiteBar 3 ble utviklet for å tilpasses til behovene for flere team. Det betyr at en
gruppe brukere kan dele bokmerker. For å kunne holde teams bokmerker private, er det
utviklet kontrollmekanismer for privat tilgang.
<p>
Byggestenen for denne mekanismen er at eieren av rotmappa av et hvilket som helst
tre har ubegrensede rettigheter over hele treet. Når brukere registrerer seg, blir
det opprettet en rotmappe for hverenkelt bruker. I tillegg kan administratorer opprette
tilleggstrær for en hvilken som helst bruker eller tillate andre brukere å opprette
sine egne nye trær.
<p>
Når treet er opprettet ka brukeren spesifisere rettigher for sitt tre for andre brukergrupper. Følgende rettigheter er tilgjengelig for enhver brukergruppe:

<p><strong>Lese</strong> - Gruppes brukere kan bruke bokmerker, hvis en bruker ikke
ønsker å se disse bokmerkene må vedkommende forlate gruppen.

<p><strong>Legg til</strong> - Bruker kan legge til mapper og lenker.

<p><strong>Modifisere</strong> - Definere egenskaper for lenker eller mapper.

<p><strong>Slette</strong> - Slette lenker eller mapper.

<p><strong>Rense</strong> - Rensing av tidligere slettede lenker eller mapper,
tillater i sammen med 'Slett' å flytte mapper fra ett tre til et annet.

<p><strong>Tillat</strong> - Gruppens medlemmer har de samme rettigheter til
treet som eieren av det.

<p>
Rettighetene blir altid arvet fra foreldremapper. Rotmappen har som standard
ingen rettigheter for noen gruppe. Brukere kan spesifisere mer restriktiv
tilgang til noen mapper, noe som har betydning for barnmapper. Hvis rettighetene
for mappen er de samme som for foreldremappen, blir rettighetsspesifikasjonenen
for den aktuelle mappen fjernet og arving blir brukt i stedet.
<p>
Gruppemoderatorer har altid rett til å fjerne enhver rettighet spesifisert for
sin gruppe for enhver bruker.
<p>
I tillegg til sikkerhetsmekanismens for mapper er det en løsning også for lenker
som tillater det å holde noe privat i ellers offentlige mapper.  Eieren av treet
kan merke enhver lenke som privat, noe som slår av denne lenka slik at den ikke
listes og er utilgjengelig for enhver annen operasjon for andre brukere. Det er
ikke nødvendig å markere lenene som privat hvis det ikke er definert noen deling
på mappens nivå (og som standard er det ingen slik deling).
<p>
Jo større antallet spesifikasjoner for tilgangskontroll det er på et mappenivå,
jo lengere tar det å laste bokmerkene for alle brukere. Spesifikasjonen skulle
ikke overforbrukes på dypt nøstede trær.
<p>
Når admin for SiteBar krysser av for valget "Personlig modus", blir sikkerhets-
kommandoene ikke tilgjengelig. I stedet får du opp valget "Publiser mappe" i
instillingene for "Egenskaper for mapper". I denne modus er det ikke mulig å
sette restriksjoner på rettigheter fra en barnemappe, når foreldernoden allerede
er publisert.

Det er muligfritt å slå over mellom personlig og standard "enterprise" modus, men
det er ikke mulig å fjerne rettigher gitt i "enterprise"-modus når du er i
personlig modus, til noen andre enn gruppe Alle.
_P;

$help['303'] = <<<_P
Webmastere kan designe egne drakter for SiteBar. Det krever god kjennskap
til CSS, samt tilltrekkelig kjennskap til XSLT for å kunne tilpasse designet.
Det enkleste er at ta utgangspunkt i en eksisterene drakt, og tilpasse den.
Kopier da en eksisterende drakt fra mappa "skins" og gi mappe et passende 
nytt navn. Hver drakt består av <ul><li>Flere bilder (Bildene må være i 
formatet PNG) <li>Hook-fila "hook.inc.php". Brukes for bla for å få info 
om drakta (fx. forfatternavn). I hook-fila kan du endre hodet og fot etter
behov for din sitebar-installasjon.
<li>Felles stilsett "common.css" - definerer farger for alle drakter.
<li>Stilsettet for SiteBar-panelet "sitebar.css".
<li>For XSLT-baserte skrivere er det stilsett for visning av lenkenytt "news.css",
for emnekatalogen "directory.css" og for backend-søk "search.css".
</ul>

<strong>XSL</strong> - det er mulig å endre presentasjonen fullstendig på XML-baserte 
SiteBar-outputs vha. ditt eget XSL-stilsett. I såfall må du kopiere fila skins/*.xsl.php
fra en av de eksisterende draktene til din draktmappe og gjøre dine endringer der.<p>

<strong>CSS-hierarki</strong> - alle stilsett er undergrupper av det felles 
stilsettet common.css, ja med unntak da av dette felles stilsettet selv.<p>
<strong>Branding</strong> - for de som ønsker å lage sin egen drakt tilpasset sitt eget 
nettsteds design, er det anbefalt å fjerne alle andre drakter og å velge "default skin" i SiteBars innstillinger.
<p>Hvis du skulle ønske å inkludere din drakt i SiteBars distribusjon, må du kontakte utviklingsteamet og teste 
din drakt med den siste stabile utviklerversjon. Som en regel må logoene for SiteBar og SourceForge befinne seg 
på siden. SiteBar-logoen kan du imidlertid fritt tilpasse.
_P;

$help['304'] = <<<_P
SiteBar bruker et rammeverk av skrivere, som brukes til å produsere 
SiteBars innhold på forskjellige måter. SiteBars hovedpanel er selv
et produkt av en skriver.
<p>
Alle skrivere arver fra klassen <strong>SB_WriterInterface</strong> 
i<strong>inc/writer.inc.php</strong> og plasserer i undermappa 
<strong>inc/writers</strong>. For å lage en output trenger du kun
å tilsidesette et par metoder. Det er også mulig å bruke en av de 
eksisterende skrivere og arve fra dem (som mange av de medfølgende
SiteBar-skribenter gjør, som er basert på XBEL-formatet).
_P;

$help['305'] = <<<_P
For å flytte en eksisterende SiteBar-installasjon til en annen
web-tjener gjør du følgende:
<ol>
    <li>Eksporter tabellene sitebar_* fra databasen til en .SQL-fil.
    <li>Importer SQL-fila til den nye databasen.
    <li>Flytt filene fra den eksisterende installasjonen eller installer en ny stabil SiteBar-versjon (eventuelle nedgradering og oppgradering skje automatisk).
    <li>Slett eller oppdater fila inc/config.inc.php i tilfelle detaljene for databaseforbindelsen er endret.
</ol>

<p><b>Tips:</b> Eksport og import av tabeller kan gjøre ved hjelp av databaseadministrasjons-
programmet <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a>. <b>MERK:</b> Tabellen sitebar_favicon 
(til 3.2.6) eller sitebar_cache (fra og med 3.3) behøver du ikke å overføre. Innholdet i de to 
tabellene blir automatisk bygget opp på nytt.
_P;

?>
