<?php

$help = array();

$help['100'] = <<<_P
Die Funktionen der SiteBar sind über das <strong>Benutzermenü</strong>, sowie
die <strong>Kontextmenüs</strong> von Verzeichnissen und Lesezeichen anwählbar. Das
Benutzermenü ist am unteren Ende der SiteBar-Leiste zu finden. Die Kontextmenüs
können über einen Klick mit der rechten Maustaste aufgerufen werden. Nur im Falle
von Opera oder falls Sie einen Apple Computer verwenden, müssen Sie hierfür die "Control"-Taste
und die linke Maustaste benutzen. Sollte auch das nicht funktionieren, können Sie die
Option "Kontextmenü-Icon zeigen" im Menü mit den "Benutzereinstellungen" aktivieren.
Das führt dazu, dass neben jedem Verzeichnis oder Lesezeichen ein kleines Menü-Icon
angezeigt wird. Ein Klick auf dieses Icon öffnet dann ebenfalls das Kontextmenü.
<p>
Sowohl Kontext- als auch Benutzermenü können abhängig von den Benutzereinstellungen
und den Rechten eines Benutzers unterschiedliche Befehle anzeigen. So können
bei Verzeichnissen oder Lesezeichen abhängig von dem Programmstatus oder den
Rechten des Benutzers Einträge fehlen.
<p>
Als <strong>Kommandos</strong> werden die Funktionen von SiteBar bezeichnet, die
über den Kasten am unteren Rand des SiteBar-Fensters verfügbar sind.
_P;

$help['101'] = <<<_P
Verzeichnisse und Lesezeichen können angeklickt und bei gedrücktem Knopf mit der Maus an einen
anderen Ort gezogen werden. Bei diesem "Drag & Drop"-Modus verändert sich der Mauszeiger
nicht, aber das Zielverzeichnis wird farbig unterlegt. Sobald der Mausknopf losgelassen
wird, öffnet sich das Einfügen-Menü für den entsprechenden Zielordner.
<p>
"Drag & Drop" konnte nicht für den Opera Browser entwickelt werden.
Hier muss alternativ "Kopieren" und "Einfügen" verwendet werden.
_P;

$help['103'] = <<<_P
<p><strong>Filtern</strong> - Gefiltert wird über allen verfügbaren Lesezeichen. Der Filter
kann durch eine entsprechende Prefix-Angabe eingegrenzt werden.
Es gibt folgende Möglichkeiten: <strong>url:</strong> (Adresse), <strong>name:</strong> (Name), <strong>desc:</strong>
 (Beschreibung) oder <strong>all:</strong> (Alles). Die Standardeinstellung ist
<strong>name:</strong>. 

<p><strong>Suchen</strong> Ähnlich wie der Filter, aber das Erebnis wird als neue Seite angezeigt.

<p><strong>Web durchsuchen</strong> Durchsucht die Lesezeichen der SiteBar und gleichzeit das Web. Beide Ergebnisse werden parallel angezeigt. Die Funktion ist nur verfügbar, wenn sie in den Benutzereinstellungen aktiviert wird.

<p><strong>Alles kollabieren</strong> - Jeder Baum wird wieder vollständig eingeklappt bis
nur noch der Name des Baumes zu sehen ist. Sind schon alle Bäume kollabiert bewirkt
die nochmalige Auswahl dieser Funktion das vollständige Ausklappen aller Bäume.

<p><strong>Mit verstecken Ordnern neu laden</strong> - Lädt das Display neu (inklusive der versteckten Ordner). Diese Funktion wird normalerweise
vom Browser angeboten, ist aber meist nur für das Hauptfenster verfügbar. Ein entsprechendes
Update des Displays der Sidebar kann also über diese Funktion erreicht werden.

<p><strong>Neu laden</strong> - Lädt das Display neu (exklusive der verstecken Ordner).
_P;

$help['200'] = <<<_P
Kommandos sind in mehrere logische Gruppen unterteilt. Wählen Sie bitte eine
der Gruppen aus, um die Hilfe zu diesen Kommandos aufzurufen.
_P;

$help['210'] = <<<_P
<p><strong>Einloggen</strong> - Hier kann sich der Benutzer einloggen. Die
SiteBar speichert Informationen über die eingeloggten Benutzer in Cookies. Für
diese Cookies kann ein Timeout angegeben werden.

<p><strong>Ausloggen</strong> - Dieser Befehl loggt den Benutzer aus und sollte
bei öffentlich zugänglichen Rechnern immer verwendet werden. Es können allerdings
auch Sessions mit Timeout geöffnet werden, die nach einiger Zeit automatisch
ausloggen.

<p><strong>Anmelden</strong> - Diese Funktion erlaubt es einem Gast sich beim
System anzumelden. Sobald er seine E-Mail-Adresse angegeben hat, kann er sich bei
Gruppen anmelden für die eine zu seiner Adresse passende Schablone definiert wurde. 
Die Gruppen können auch so eingestellt werden, dass die E-Mail vorher verifiziert 
werden muss. Hierfür kann sich der Benutzer als Gast eine E-Mail an seine Adresse 
senden lassen, um diese über einen mit der E-Mail versendeten Link zu verifizieren.
In den SiteBar-Einstellungen läßt sich die "Anmelden"-Funktion für den Server 
ausschalten. Auch die E-Mail Verifikation kann deaktiviert werden, so dass neue 
Benutzerkonten nur manuell bestätigt werden können.
_P;

$help['220'] = <<<_P
<p><strong>Einrichten</strong> - Dies ist der erste Befehl, der für die
Installation der SiteBar zur Verfügung steht. Hierüber kann der Administator eingerichtet
werden und die Basis-Parameter (der Datenbankzugriff) können festgelegt werden. Wird
der "Einzelbenutzer Modus" gewählt, so werden einige der SiteBar-Features,
die für ein Team wichtig sind, deaktiviert.

<p><strong>SiteBar-Einstellungen</strong> - Der Administrator kann hier die
globalen Einstellungen für die SiteBar festlegen. Zugriffsberechtigt sind alle Benutzer
der Administrator-Gruppe und der anfängliche Benutzer, der beim
"Einrichten"-Befehl angelegt wurde. Für die nächsten SiteBar-Versionen sind noch
deutlich mehr E-Mail-Funktionen geplant.

<p><strong>Baum erstellen</strong> - Abhängig von den SiteBar-Einstellungen
können hier Administratoren und/oder Benutzer neue Bäume erstellen. Jeder neue
Baum muss mit einem Benutzer verknüpft sein, wobei nur der Administrator Bäume
auch im Namen anderer Benutzer erstellen kann. Um einen "Team-Baum" zu erstellen
sollte dieser Baum dem Moderator des Teams gehören. Damit kann er alle erforderlichen
Rechte für den Zugriff vergeben.
_P;

$help['230'] = <<<_P
<p><strong>Benutzereinstellungen</strong> - Hier kann jeder Benutzer seine
persönlichen Einstellungen treffen. "Pop-Up-Fenster verwenden" aktiviert den
Modus bei dem Befehle über ein kleines Pop-Up-Fenster verwendet werden können.
Wird diese Option nicht aktiviert, wird für die Kommandos der Inhalt des SiteBar-Fenster
ausgetauscht. Das Pop-Up-Menü ist dabei die etwas schnellere Variante. Die Befehle
"Einloggen", "Ausloggen" und die "Benutzereinstellungen" werden allerdings immer im
SiteBar-Fenster geöffnet und verwenden nie ein Pop-Up-Menü. Wenn die Option "Programmmeldungen
verwerfen" aktiviert wird, zeigt SiteBar keine Erfolgsmeldungen mehr an. Fehlermeldungen
erscheinen natürlich immer noch. Wird "ACL Ordner markieren" ausgewählt, so
werden Ordner mit Zugriffskontrollen markiert. Die Darstellung erfolgt dann auch etwas
langsamer.

<p><strong>Mitgliedschaften</strong> - Die Benutzer können hier Gruppen beitreten
oder sie verlassen. Kein Benutzer kann eine Gruppe verlassen, sofern er der alleinige
Moderator der Gruppe ist. In dem Fall sollte der Administrator benachrichtigt
werden, damit die Gruppe gelöscht wird.

<p><strong>E-Mail verifizieren</strong> - Dieser Befehl erlaubt es einem Benutzer
sich selbst eine E-Mail zuzusenden, um seine eigene E-Mail-Adresse gegenüber dem
System zu verifizieren.
_P;

$help['240'] = <<<_P
<p><strong>Benutzer verwalten</strong> - Zeigt eine Auswahlliste der Benutzer und
den Verwaltungsfunktionen.

<p><strong>Benutzer bearbeiten</strong> - Der derzeit einzige Weg, ein vergessenes
Passwort zu umgehen, ist hier ein temporäres Passwort anzulegen und dem Benutzer
dieses Passwort zuzuschicken. Der Administrator kann den Benutzer auch als Demo-Konto
markieren, was einige Features abschaltet (wie z.B. das Ändern des Passwortes).

<p><strong>Benutzer löschen</strong> - Löscht einen Benutzer mit all seinen
Mitgliedschaften. Die von ihm angelegten Lesezeichen werden einem anderen
Benutzer übertragen. Es kann kein Benutzer gelöscht werden, der alleiniger
Moderator einer Gruppe ist.

<p><strong>Benutzer erstellen</strong> - Hier kann durch den Administrator
ein neuer Benutzer angelegt werden. Die angegebene E-Mail wird als verifiziert
angenommen.
_P;

$help['250'] = <<<_P
<p><strong>Gruppen verwalten</strong> - Zeigt eine Liste der Gruppen und erlaubt
die Auswahl verschiedener Verwaltungsfunktionen.

<p><strong>Gruppeneigenschaften</strong> - Diese Eigenschaften sind nur für die
Moderatoren einer Gruppe zugänglich. Hier kann der Name und die Beschreibung der
Gruppe geändert werden. Ausserdem kann die "regular Expression" zur Beschreibung von E-Mails denen
ein automatischer Beitritt zur Gruppe ermöglicht wird, festgelegt werden. Wenn diese
Wert auf die E-Mail-Adresse eines neuen Benutzers passt, so kann sich dieser nach der
Verifikation seiner Adresse in der Gruppe eintragen. Wenn "Eigenes hinzufügen erlauben"
aktiviert ist, können sich aber auch Benutzer ohne verifizierte Mail-Adresse eintragen.

<p><strong>Gruppenmitglieder</strong> - Nur Moderatoren können hier selektieren,
welche Benutzer zu der Gruppe gehören sollen und welche nicht. Andere Moderatoren können
nicht aus der Gruppe entfernt werden. Hierzu muss erst der Moderatoren-Status
entfernt werden.

<p><strong>Gruppen-Moderatoren</strong> - Hier können die Moderatoren einer Gruppe
gewählt werden. Jede Gruppe muss allerdings ein Minimum von einem Moderator behalten.

<p><strong>Gruppe löschen</strong> - Die Funktion ist nur für Administratoren
verfügbar und erlaubt das Löschen einer Gruppe.

<p><strong>Gruppe erstellen</strong> - Hier können Administratoren eine Gruppe
erstellen und einen ersten Moderator für diese Gruppe einrichten.
_P;

$help['260'] = <<<_P
<p><strong>Verzeichnis hinzufügen</strong> - Dieser Befehl fügt dem ausgewählten
Verzeichnis ein neues Unterverzeichnis hinzu.

<p><strong>Lesezeichen hinzufügen</strong> - Dieser Befehl fügt dem ausgewählten
Verzeichnis ein neues Lesezeichen hinzu. Wird dieser Befehl über das Bookmarklet 
ausgeführt, muss das Verzeichnis in dem das Lesezeichen gespeichert werden soll 
ausgewählt werden. Wird das Kontext-Menü verwandt, wird der Link zum angeklickten 
Verzeichnis hinzugefügt.

<p><strong>Verzeichnis durchsuchen</strong> - Öffnet die Verzeichnis Ansicht, in der jeweils 
nur der Inhalt eines Ordners angezeigt wird.
<p><strong>Zeige alle Links</strong> - Zeigt die Lesezeichen aller Unterordner auf einmal.
<p><strong>Zeige Bookmark News</strong> - Zeigt die Neuigkeiten für den gewählten Ordner und seine
Unterordner an.

<p>

<p><strong>Ordner verstecken</strong> - Versteckt das ausgewählte Verzeichnis. Diese Funktion ist nützlich, um die veröffentlichten Verzeichnisse
anderer Benutzer auszublenden oder selten verwendete Ordner zu verstecken. Wählt man "Mit versteckten Ordnern neu laden" aus der Tool-Leiste an,
werden die versteckten Ordner bis zum nächsten Refresh wieder angezeigt. Einmal versteckte Ordner können mit dem Befehl "Unterordner anzeigen"
wieder sichtbar gemacht werden. Unsichtbare Bäume können im Menü "Bäume verwalten" wieder sichtbar gemacht werden ("Bäume anzeigen").

<p><strong>Unterordner anzeigen</strong> - Zeigt alle versteckten Unterordner wieder an. 

<p><strong>Verzeichniseigenschaften</strong> - Hier können die Eigenschaften
des Ordners bearbeitet werden (der Name und die Beschreibung).

<p><strong>Verzeichnis löschen</strong> - Dieser Befehl erlaubt das Löschen eines
Verzeichnisses oder eines Baumes. Verzeichnisse sollten immer über diesen Befehl
entfernt werden, da sich der Inhalt im Notfall wieder über die Funktion "Löschen
rückgängig" zurückholen lässt.

<p><strong>Gelöschte Elemente entfernen</strong> - Dies entfernt alle vorher
gelöschten Elemente aus diesem Verzeichnis. Damit kann der Löschvorgang nicht
mehr rückgängig gemacht werden.

<p><strong>Löschen rückgängig</strong> - Hiermit können gelöschte Ordner wieder
zurückgeholt werden, sofern sie nicht vollständig entfernt wurden. Wird ein
vollständiger Baum gelöscht, so verschwindet er nicht sofort, sondern nur der Inhalt
wird entfernt. Die Wurzel wird dann nur noch für den Besitzer des Baumes grau
dargestellt. Da der Inhalt so notfalls wieder erstellt werden kann, sollten
Lesezeichen nicht durch unbedachte Aktionen verloren gehen.

<p>

<p><strong>Kopieren</strong> - Kopiert das Verzeichnis samt Inhalt in die interne
Zwischenablage.

<p><strong>Einfügen</strong> - Diese Option ist nur verfügbar, wenn vorher bei
einem anderen Verzeichnis "Kopieren" oder bei einem Lesezeichen "Lesezeichen kopieren" ausgewählt
wurde und sich das entsprechende Objekt damit in der Zwischenablage befindet. Im
"Einfügen" Dialog kann dann bestimmt werden, ob das Objekt kopiert oder von
einem zum anderen Ort bewegt werden soll.

<p>

<p><strong>Lesezeichen importieren</strong> - Importiert Lesezeichen aus einer
externen Datei in das gewählte Verzeichnis. Bei diesem Import werden die Lesezeichen
jedoch nicht validiert, um einem Timeout des Servers vorzubeugen.

<p><strong>Lesezeichen exportieren</strong> - Mit dieser Funktion lässt sich
der Inhalt eines Baumes oder Verzeichnisses in eine Datei exportieren. Dabei
kann als Format dieser Datei entweder das Netscape-Lesezeichen- oder das
Opera-Hotlist-Format gewählt werden. Der Internet Explorer kann das Netscape-Format
ebenfalls lesen und schreiben.

<p><strong>Lesezeichen validieren</strong> - Dieser Befehl validiert die Links des selektierten Ordners. Hierfür muss ihr Sitebar-Server allerdings erlauben, dass die PHP-Skripte eigenständige Verbindungnen nach außen aufbauen dürfen. Während der Validierung können fehlende Icons für die Links identifiziert werden und fehlerhafte Icons werden gelöscht. Die Seite für die Validierung zeigt dabei alle Lesezeichen die getestet werden an. Kann kein Icon für ein Lesezeichen identifiziert werden, so wird das Standard-Symbol für Lesezeichen angezeigt. Kann das Lesezeichen selbst nicht validiert werden (Seite nicht gefunden oder ähnliches Problem) so wird ein Fehler-Icon für diesen Link gewählt. Bei sehr vielen Links kann der Browser überlastet sein. In dem Fall kann der Prozess unterbrochen werden und einfach neu gestartet werden. Beim Neustart dürfen kürzlich überprüfte Lesezeichen nicht nochmals überprüft werden, d.h. die entsprechende Option muss angewählt werden. Fehlerhafte Lesezeichen werden nicht automatisch gelöscht sondern nur entsprechend markiert.

<p><strong>Sicherheit</strong> - Diese Option ist nur für die Wurzel eines Baumes
verfügbar und erlaubt das Setzen von Zugriffskontrollen. Siehe auch den Abschnitt
"Zugriffskontrolle".
_P;

$help['270'] = <<<_P
<p><strong>Lesezeichen mailen</strong> - Dieser Befehl erlaubt es ein Lesezeichen per E-Mail
zu versenden. Für die Benutzer, die ihre Mail verifiziert haben, kann das interne
Mail-System verwendet werden. Alternativ kann die Mail über ein lokales Mail-Programm
versendet werden.

<p><strong>Lesezeichen kopieren</strong> - Diese Funktion kopiert das Lesezeichen in die
SiteBar-interne Zwischenablage. Mit "Einfügen" aus dem Verzeichnis-Kontextmenü
kann das Lesezeichen dann in ein anderes Verzeichnis kopiert werden.

<p><strong>Lesezeichen löschen</strong> - Dieser Befehl löscht das ausgewählte Lesezeichen.
Ein gelöschtes Lesezeichen kann mit der "Löschen rückgängig"-Funktion aus
dem Kontextmenü des übergeordneten Verzeichnisses wieder gerettet werden.

<p><strong>Eigenschaften</strong> - Erlaubt die Eigenschaften eines Lesezeichens zu
editieren. Hier kann das Lesezeichen auch als "privat" definiert werden.
_P;

$help['300'] = <<<_P
SiteBar 3 wurde auf der Basis der 2.x Serie komplett neu programmiert und stellt
die nächste Evolutionsstufe des SiteBar-Severs dar.
<p>
SiteBar 3 verwendet kein JavaSkript mehr um die Lesezeichen-Bäume darzustellen.
JavaSkript wird aber vor allem bei den Kontext-Menüs eingesetzt und um die einzelnen
Bäume zu öffnen bzw. zu kollabieren. Auch Veränderungen an den Icons werden
über JavaSkript ermöglicht.
Das <a href="http://www.w3.org/TR/DOM-Level-2-Core/">Dokumenten-Objekt-Modell, Level 2</a>
muss vom Browser unterstützt werden. Der Vorteil dieses Modells ist, dass es sehr
schnell ist und ein inkrementelles Laden der Lesezeichen ermöglicht. Der Nachteil
ist, dass ältere Browser die Lesezeichen-Bäume nur in der ausgeklappten Version
darstellen und nur Lese-Zugriff bieten können (Allerdings stellt dies immer noch
eine Verbesserungen zur Version 2.x dar, denn hier konnten ältere Browser gar nichts
darstellen).
<p>
Auf der Server-Seite sind die Daten in der einfachst möglichen, rekursiven Datenstruktur
gespeichert. Diese Struktur wurde für Baum-Modifikationen optimiert. Damit wird von
SiteBar eine sehr gute Performance erreicht. Auch bei einer hohen Zahl an Lesezeichen sollte
das Indexing der Datenbank eine Verlangsamung des Systems verhindern.
_P;

$help['302'] = <<<_P
SiteBar 3 überprüft Zugriffsrechte der Benutzer doppelt. Zum einen werden in den Menüs nur
die Befehle angeboten, die dem Benutzer gewährt wurden und zum anderen wird
nochmals vor dem Ausführen eines Befehls überprüft, ob der Benutzer die Berechtigung
für dieses Kommando besitzt.
<p>
Das System kennt drei unterschiedliche Rollen: Benutzer, Moderatoren und Administratoren.
Moderatoren sind Benutzer, die beim Erstellen von Gruppen als deren Moderatoren
ausgewählt werden. Die Rolle des Moderators ist jeweils an die entsprechende Gruppe
gekoppelt. Administratoren sind Benutzer, die Mitglieder der Administratorengruppe
sind zuzüglich der ersten Benutzers der bei der Installation erstellt wurde.
Administratoren haben nicht automatisch das Recht als Moderatoren zu fungieren, aber
sie haben Zugriff auf alle Elemente der Verwaltung von Gruppen.
<p>
SiteBar 3 wurde für die Teamarbeit entwickelt. Das bedeutet, dass einzelne
Benutzergruppen ihre Lesezeichen gemeinsam verwalten können. Eine Mehrbenutzerumgebung
erfordert aber natürlich auch entsprechende Sicherheitsmechanismen.
<p>
Als grundlegende Regel hat der Besitzer eines Baumes die vollen und uneingeschränkten
Rechte über diesen Baum. Für jeden Benutzer wird bei seiner Anmeldung bei der
SiteBar ein persönlicher Baum angelegt, der diesem neuen Benutzer gehört. Die
Administratoren können SiteBar so konfigurieren, dass auch neue Bäume hinzugefügt
werden können. Jeder Benutzer kann dann seine eigenen Bäume erstellen.
<p>
Für jeden in der SiteBar verfügbaren Baum können Zugriffsrechte für die vorhandenen
Gruppen vergeben werden. Die folgenden Rechte gibt es für die Mitglieder einer Gruppe:

<p><strong>Ansehen</strong> - Mitglieder der Gruppe können die Lesezeichen ansehen
und der Baum ist in ihrem SiteBar-Fenster sichtbar. Wenn der Baum ausgeblendet
werden soll, kann dies entweder unter den Benutzereinstellungen eingestellt werden oder
der Benutzer verlässt die entsprechende Gruppe.

<p><strong>Hinzufügen</strong> - Die Mitglieder können Lesezeichen hinzufügen

<p><strong>Editieren</strong> - Jedes Gruppenmitglied kann die Eigenschaften
der Lesezeichen editieren.

<p><strong>Löschen</strong> - Lesezeichen können von den Mitgliedern der Gruppe
gelöscht werden.

<p><strong>Entfernen</strong> - Entfernen erlaubt das vollständige Löschen
von Lesezeichen und Verzeichnissen. Diese Operation kann im Gegensatz zum
normalen "Löschen" nicht rückgängig gemacht werden.

<p><strong>Gewähren</strong> - Wird dieses Recht gewährt, hat jedes Gruppenmitglied
die gleichen Rechte wie der Besitzer des Baumes und kann ebenfalls Rechte vergeben.

<p>
Die Rechte jedes Ordners werden jeweils vom übergeordneten Ordner übernommen,
wobei die Wurzel jedes Baumes in der Grundeinstellung keine Rechte für irgendeine
Gruppe besitzt. Um den Zugriff auf Teile des Baumes zu modifizieren, können die
Sicherheitseinstellungen jedes einzelnen Ordners verändert werden. Sobald die
Rechte eines Ordners verändert wurden, werden die Rechte übergeordneter Verzeichnisse
nicht mehr auf diesen Ordner und seine Kinder vererbt.
<p>
Die Moderatoren von Gruppen haben immer die Möglichkeit Rechte, die Ihrer Gruppe gewährt
wurden, zu entfernen.
<p>
Unabhängig von den Rechten einzelner Ordner hat jeder Benutzer die Möglichkeit
Lesezeichen, die er hinzugefügt hat, als "Privat" zu markieren. Diese Lesezeichen
sind dann auch in ansonsten öffentlichen Verzeichnissen für andere Benutzer nicht
sichtbar. Natürlich ist es nicht notwendig diesen Mechanismus in Ordnern zu
verwenden, die sowieso nicht öffentlich sind (dies ist die Standardeinstellung).
<p>
Je mehr unterschiedliche Sicherheitseinstellungen ein Baum besitzt, desto länger
dauert die Darstellung dieses Baumes. Bei stark verästelten Bäumen
sollte dieser Aspekt berücksichtigt werden.
<p>
Wählt der Administrator in den Grundeinstellungen der SiteBar-Installation den
"Einzelbenutzer Modus", dann sind die Sicherheitseinstellungen für die Ordner
nicht verfügbar. In diesem Fall können Ordner aber alternativ über den "Ordner veröffentlichen"-Befehl
des Kontextmenüs frei verfügbar gemacht werden. Es ist allerdings nicht möglich
den Zugriff auf Unterverzeichnisse einzuschränken, wenn ein übergeordnetes
Verzeichnis veröffentlicht wurde. Es ist für den Administrator jederzeit möglich
zwischen dem Einzel- und Mehrbenutzermodus zu wechseln. Sollten jedoch spezielle Rechte im
Mehrbenutzermodus vergeben worden sein, so lassen sich diese im Einzelbenutzermodus nicht editieren
(mit Ausnahme der Rechte der Gruppe "Everyone").
_P;

$help['303'] = <<<_P
SiteBar erlaubt es den Anwendern neue Designs zu erstellen. Allerdings sollte man
hierfür einigermaßen mit CSS auskennen. Für ein vollständig benutzerdefiniertes Design
sollte man ebenfalls mit XSLT vertraut sein. Am einfachsten ist die Erstellung
neuer Designs anhand der schon vorhandenen "Skins". Diese befinden sich im Ordner
"skins" der SiteBar-Installation und können einfach kopiert werden. Jedes Design
besteht aus 
<ul>
<li> mehreren Bildern im PNG-Format (GIF's werden aufgrund der patentrechtlichen
Situation nicht verwendet)
<li> einer PHP-Datei mit mehreren "Hooks". Letztere trägt den Namen "hook.php". In der Hook-Datei
können die Kopf- bzw. Fusszeilen der SiteBar-Installation verändert werden.
<li> dem generischen Stylesheet "common.css" das die Farb-Definition für die anderen Stylesheets
enthält.
<li> dem Cascading-Stylesheet "sitebar.css" für das Standard-Fenster der SiteBar
<li> und den Stylesheets "news.css", "directory.css", sowie "search.css" die das Layout für die
entsprechenden Export-Filter liefern. 
</ul>

<strong>XSL</strong> - Es ist möglich die XML-Ausgabe die einige der SiteBar-Exportfilter produzieren vollständig zu modifizieren indem man ein entsprechendes XSL Stylesheet erstellt. Hierfür läßt sich eine der "skins/*.xsl.php " Dateien kopieren und modifizieren. 

<p> 

<strong>Kaskadieren</strong> - Mit der Ausnahme des "Common.css" Stylsheets sind alle anderen Layout-Anweisungen als Superset des "Common"-Stylesheets erstellt. 

<p> 

<strong>Branding</strong> - Wenn man SiteBar dem Design der eigenen Webseite anpassen möchte, sollte man das eigene,
neu erstellte Design als "Default" auswählen. Des weiteren lassen sich die anderen Skins löschen,
um den Benutzern die Wahlmöglichkeit zu entziehen.

<p>
 Wer sein Design auch anderen zur Verfügung stellen möchte, kann gerne die Entwickler der SiteBar kontaktieren.
Um in der stabilen Distribution aufgenommen zu werden, muss das Design zum einen
natürlich funktionieren und zum anderen das SiteBar-, sowie das SourceForge-Logo
enthalten. Das SiteBar-Logo darf allerdings im Aussehen modifiziert werden.
_P;

$help['304'] = <<<_P
SiteBar verwendet ein Klassensystem für verschiedene Exportfilter, die den eigentlichen Inhalt der SiteBar-Datenbank in unterschiedlichen Formaten wiedergeben können. Selbst die Standard-Ausgabe der SiteBar ist nur einer dieser Exportfilter.
<p>
Alle Exportfilter stammen von der <strong>SB_WriterInterface</strong>-Klasse ab (siehe die Datei <strong>inc/writer.inc.php</strong>) und werden in den <strong>inc/writers</strong>-Unterordner abgelegt. Um einen eigenen Exportfilter zu schreiben ist es notwendig einige Methoden der Basis-Klasse zu überschreiben. Es ist auch möglich die eigene Klasse einfach von einem der schon vorhandenen Filter abzuleiten und diesen nur leicht zu modifizieren (so sind z.B. die meisten Exportfilter der SiteBar vom XBEL-Exportfilter abgeleitet).
_P;

$help['305'] = <<<_P
Um eine existierende SiteBar Installation auf einen anderen Server umzuziehen, ist es notwendig
<ul>
    <li>die sitebar_* Tabellen aus der Quelldatenbank in eine .SQL Datei zu exportieren.
    <li>Diese Datei in die Zieldatenbank zu importieren.
    <li>Die Software zu bewegen oder eine stabile SiteBar Version zu installieren. (Downgrade oder Upgrade wird automatisch ausgeführt werden).
    <li>Löschen oder updaten von inc/config.inc.php falls sich die Datenbankverbindungsdetails geändert haben
</ul>

<p>
Der Export und Import kann mit <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a> durchgeführt werden.
Die Tabelle sitebar_favicon (bis 3.2.6) oder sitebar_cache (ab 3.3) muss nicht übertragen werden. Ihr Inhalt wird erneut erstellt werden.
_P;

?>
