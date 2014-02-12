<?php

$para = array();

$para['integrator::welcome'] = <<<_SBHD
Willkommen auf der SiteBar Integrationsseite. Diese Seite hilft Ihnen das meiste aus SiteBar herauszuholen. Auf der <a href="http://sitebar.org/">SiteBar Homepage</a> können Sie mehr über die SiteBar Features lernen.
_SBHD;

$para['integrator::header'] = <<<_SBHD
SiteBar wurde konform zu etablierten Standards entwickelt und sollte in den meisten Browsern mit eingeschaltetem Javascript und Cookies ohne Probleme funktionieren. Die folgende Tabelle zeigt welche Browser getestet wurden. Einfach den eigenen Browser anklicken um spezifische Hinweise für die bessere
Integration der SiteBar mit dem Browser zu erhalten.
_SBHD;

$para['integrator::usage_opera'] = <<<_SBHD
<@>SiteBar benutzt einen rechte Maustaste-Klick, um Kontextmenüs für Verzeichnisse und Links zu öffnen. Als Opera Nutzer müssen Sie die sogenannten "Menü Icons" in den "Benutzereinstellungen" anschalten und auf das Symbol links des Verzeichnis- bzw. des Linkeintrages klicken. Opera unterstützt <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a> nicht. Es wird empfohlen die Nutzung der XSLT Features in den "Benutzereinstellungen" abzuschalten.
_SBHD;

$para['integrator::hint'] = <<<_SBHD
Klicken Sie oben auf den Namen des Browsers Ihrer Wahl um die Integrationsanweisungen hierfür zu erhalten. Bitte <a href="http://brablc.com/mailto?o">berichten</a> Sie von weiteren erfolgreich getesteten Browsern und Plattformen.
_SBHD;

$para['integrator::hint_window'] = <<<_SBHD
Dies ist ein gewöhnlicher Link der SiteBar im derzeitigen Fenster öffnen wird. SiteBar wurde für ein schmales, senkrechtes Fenster entworfen. Auf diese Art und Weise geht viel wertvoller Platz verloren.
_SBHD;

$para['integrator::hint_dir'] = <<<_SBHD
Abgesehen von der normalen SiteBar-Darstellung als Baum, können die Lesezeichen auch
als Verzeichnis angezeigt werden. Diese Ansicht zeigt zu jeder Zeit die Lesezeichen
nur eines Verzeichnisses. Der Browser muss dafür <a href="http://de.wikipedia.org/wiki/XSLT">XSLT</a> unterstützen.
_SBHD;

$para['integrator::hint_popup'] = <<<_SBHD
Falls Ihr Browser keine Seitenleisten unterstützt, können Sie dieses Bookmarklet* verwenden. Das Bookmarklet öffnet SiteBar in einem Popup Fenster ähnlich einer Seitenleiste. Es kann sein, dass Ihr Browser Popup Fenster blockiert!
_SBHD;

$para['integrator::hint_iframe'] = <<<_SBHD
Die links angegebene URL versetzt SiteBar in ein <IFRAME>. Damit kann man es in verschiedene Portale einbetten. z.B. wie:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a></li>
<li><a href="http://www.netvibes.com/">Netvibes</a></li>
</ul>
Besuche das Portal, finde einen geeigneten Platz zum Einfügen des Inhalts. Kopiere diese URL <strong>%s</strong> dahin und ein neuer Gadget sollte dort erscheinen (Beachte, dass https in Portalen nicht unterstützt werden. Du kannst https dennoch im iframe.php benutzen). Beachte, dass Dein Benutzername und Kennwort <strong>NICHT</strong> an das Portal weitergegeben werden. MS IE Benutzer sollten für die SiteBar-Server-Domain die Cookies erlauben.
_SBHD;

$para['integrator::hint_addpage'] = <<<_SBHD
Dieses Bookmarklet* kann dazu benuzt werden Links zu Ihrem SiteBar hinzuzufügen. Beim Klickenb wird ein neues Pop-Up Fenster geöffnet das schon die Details der Seite enthalten wird.
_SBHD;

$para['integrator::hint_bookmarklet'] = <<<_SBHD
&#42; <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> ist ein Lesezeichen/Favorit der JavaScript Code enthält. Sie können das Bookmark über einen Klick mit der rechten Maustaste ihren Lesezeichen/Favoriten hinzufügen.
Später wird ein Klick auf das Lesezeichen den JavaScript Befehl ausführen.</i>
_SBHD;

$para['integrator::hint_search_engine'] = <<<_SBHD
Fügt die Suche in den SiteBar Lesezeichen dem Web-Suche-Feld hinzu. Erlaubt die SiteBar Lesezeichen zu durchsuchen, ohne dass Sitebar geöffnet sein muss.
_SBHD;

$para['integrator::hint_sitebar'] = <<<_SBHD
<@>Spezielle Erweiterung für die SiteBar.
Erlaubt das Öffnen aller Lesezeichen eines Verzeichnisses als Tabs
und andere nützliche Features. Benutzer die Menüpunkte View/Toolbar/Customize, 
um die SiteBar Icons zu Deiner Toolbar hinzuzufügen.
_SBHD;

$para['integrator::hint_bmsync'] = <<<_SBHD
Um Zwei-Weg-Synchronisation mit Firefox zu benutzen, installieren Sie die Lesezeichen Synchronisierer Erweiterung. Gehen Sie auf "Benutzer Einstellungen -> XBELSync Einstellungen", um mehr Informationen zum Einrichten der Synchronisation zu bekommen.
_SBHD;

$para['integrator::hint_sidebar'] = <<<_SBHD
Erstellt ein Lesezeichen das später angeklickt werden kann um SiteBar in einem Seitenpanel zu öffnen.
_SBHD;

$para['integrator::hint_livebookmarks'] = <<<_SBHD
Die komplette SiteBar-Verzeichnis-Struktur (nicht die Lesezeichen selbst) kann hier als Datei heruntergeladen werden.
Diese Datei lässt sich dann in den FireFox-Browser laden. Jedes Verzeichnis der SiteBar wird als "LiveBookmark" abgebildet.
Der Inhalt dieser speziellen Verzeichnisse wird automatisch von dem SiteBar-Server geholt, so daß der Inhalt ständig auf
dem neuesten Stand bleibt. Die Lesezeichen von Verzeichnissen mit Unterordnern werden in einem @Content-Ordner angezeigt.
_SBHD;

$para['integrator::hint_sidebar_mozilla'] = <<<_SBHD
Fügt die SiteBar in die Sidebar-Leiste des Browsers ein. Die Leiste kann mit F9 angezeigt bzw. versteckt werden. Sollte das Laden der
SiteBar ein bestimmtes Zeitlimit überschreiten kann der Mozilla-Browser sie nicht anzeigen. Um die SiteBar-Anzeige zu beschleunigen könne
die Icons der Lesezeichen (favicons) in den Browser-Cache geladen werden indem man die SiteBar im Hauptfenster des Browsers öffnet. Alternativ
lassen sich die Icons in den "Benutzereinstellungen" des SiteBar komplett ausstellen.
_SBHD;

$para['integrator::hint_hotlist'] = <<<_SBHD
Ein Lesezeichen zu SiteBar wird zu den Opera Lesezeichen hinzugefügt. Ein Klick hierauf wird SiteBar im Opera Seitenpanel öffnen.
_SBHD;

$para['integrator::hint_install'] = <<<_SBHD
Installiert die SiteBar in die Explorer-Leiste und das Kontext-Menü. Dies erfordert Veränderungen in der Windows-Registry und damit
einen Neustart des Systems. Abhängig von den Benutzer-Rechten auf dem Windows-System können evtl. nicht alle Features installiert werden.
<br>
Die SiteBar-Explorer-Leiste kann über das Menü "Ansicht/Explorer-Leiste" geöffnet werden oder über einen Schalter auf der Toolbar. Dieser kann über die "Benutzerdefiniert..."-Funktion der Toolbar hinzugefügt werden. Lesezeichen können über einen Rechts-Klick auf einen Link zur SiteBar hinzugefügt werden.

_SBHD;

$para['integrator::hint_uninstall'] = <<<_SBHD
Deinstalliert die Explorerleiste (siehe oben)
_SBHD;

$para['integrator::hint_searchbar'] = <<<_SBHD
Die Nutze deses Bookmarklets * wird empfohlen falls der Nutzer nicht berechtigt ist eine Explorerleiste zu installieren. SiteBar wird vorübergehend in die Suchleiste des Browsers.
_SBHD;

$para['integrator::hint_maxthon_sidebar'] = <<<_SBHD
Lädt ein Plugin (mit voreingestellter URL) herunter. Das Archiv muss in das "C:Program FilesMaxthonPlugin" Verzeichnis entpackt werden. Nach dem Neustart wird eine neue Explorerleiste angezeigt.
_SBHD;

$para['integrator::hint_maxthon_toolbar'] = <<<_SBHD
Dieser Link lädt ein Plugin mit einer voreingestellten URL. Das Archiv muß in den Ordner "C:ProgrammeMaxthonPlugin" entpackt werden. Nach dem Neustart des Browsers findet sich ein neues Icon auf der Plugin-Toolbar. Dieses Icon ermöglicht es die derzeit angezeigte Seite zur SiteBar hinzuzufügen.
_SBHD;

$para['integrator::hint_gentoo'] = <<<_SBHD
Befehl <strong>emerge sitebar</strong> ausführen um SiteBar zu installieren.
_SBHD;

$para['integrator::hint_debian'] = <<<_SBHD
Befehl <strong>apt-get install sitebar</strong> ausführen um SiteBar zu installieren.
_SBHD;

$para['integrator::hint_phplm'] = <<<_SBHD
Das PHP-Layer-Menü ist ein hierarchisches Menü-Sytem das ein DHTML-Menü für Webseiten bereitstellen kann. SiteBar kann mit
Hilfe dieses PHP-Tools verwendet werden um ein dynamisches Menü in jede beliebige Webseite einzubinden. Wenn die "fopen"-Funktion
bei PHP gestattet ist, dann lädt folgende Zeile das dynamische Menü:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_SBHD;

$para['integrator::copyright3'] = <<<_SBHD
Copyright � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> und das <a href='http://sitebar.org/team.php'>SiteBar Team</a>. Hilfe <a href='http://sitebar.org/forum.php'>forum</a> und <a href='http://sitebar.org/bugs.php'>Fehlersuche</a>.
_SBHD;

$para['command::welcome'] = <<<_SBHD
<@>%s, Willkommen bei SiteBar!
%s
<p>
SiteBar wird über Kontextmenüs gesteuert die durch einen Klick mit der rechten Maustaste auf ein Verzeichnis oder einen Link geöffnet werden.
Wenn Ihr Browser/Ihre Plattform keinen rechts-Klick unterstützt, versuchen Sie es mit STRG-Klick oder schalten Sie die Einstellung "Zeige Menü Symbol"  in den "Benutzereinstellungen" an.
<p>
Um weitere Informationen über SiteBar zu erhalten, klicken Sie bitte im Menü unten auf "Hilfe".
<p>
Sie sind schon eingeloggt.
_SBHD;

$para['command::signup_verify'] = <<<_SBHD
<p>
Diese SiteBar Installation setzt voraus, dass Ihre E-Mail Adresse gültig ist und überprüft wurde bevor Sie SiteBar verwenden können.
<p>
Vorausgesetzt Sie haben Ihre E-Mail Adresse korrekt angegeben, sollten Sie in kürze E-Mail erhalten. Bitte klicken Sie auf den Link in der E-Mail.
_SBHD;

$para['command::signup_approve'] = <<<_SBHD
<p>
Diese SiteBar Installation setzt voraus, dass neue Accounts vom Administrator angenommen werden müssen bevor Sie SiteBar verwenden können.
<p>
Bitte erwarten Sie die Freischaltung durch den Administrator - Sie werden hierüber per E-Mail informiert.
_SBHD;

$para['command::signup_verify_approve'] = <<<_SBHD
<p>Diese SiteBar Installation verlangt eine gültige E-Mail Adresse die überprüft und vom Administrator freigeschaltet werden muss bevor Sie die SiteBar Funktionen nutzen können.
<p>Vorausgesetzt Sie haben eine gültige E-Mail Adresse angegeben, werden Sie in kürze eine Email erhalten. Bitte klicken Sie auf den Link in der E-Mail Adresse und warten Sie auf die Freischaltung durch den Administrator. Sie werden hierüber per E-Mail benachrichtigt.
_SBHD;

$para['command::account_approved'] = <<<_SBHD
Der Administrator hat den Accountantrag genehmigt.
Sie können sich mit dem Benutzernamen %s einloggen.

--
SiteBar Installation auf %s.
_SBHD;

$para['command::account_rejected'] = <<<_SBHD
Der Administrator hat den Accountantrag mit dem Benutzernamen %s abgelehnt.

--
SiteBar Installation auf %s.
_SBHD;

$para['command::account_deleted'] = <<<_SBHD
Der Administrator hat Ihr inaktives Konto mit dem Benutzernamen %s gelöscht.


--
SiteBar Installation auf %s.
_SBHD;

$para['command::reset_password'] = <<<_SBHD
Ein Passwort Reset für den SiteBar Account mit der E-Mail Adresse "%s" wurde verlangt.

Falls Sie wirklich das Passwort für diesen Account zurücksetzten wollen, klicken Sie bitte auf den folgenden Link:
    %s

--
SiteBar Installation auf dem Server %s.
_SBHD;

$para['command::leave_group'] = <<<_SBHD
<p>
Wenn Sie aus einer Gruppe austreten, benötigen Sie eine Einladung um in ihr wieder einzutreten. Um eine Einladung zu bekommen, müssen Sie sich mit dem Gruppenbesitzer in Verbindung treten - dazu müssen Sie seinen SiteBar Benutzernamen oder seine E-Mail-Adresse kennen.
_SBHD;

$para['command::use_comma'] = <<<_SBHD
Benutze Komma, um Benutzernamen zu trennen. Benutzer werden Mitglieder sein, sobald sie Ihre Einladung bestätigt haben.
_SBHD;

$para['command::reset_password_hint'] = <<<_SBHD
<p>
Bitte geben Sie Ihren Benutzernamen oder Ihre registrierte E-Mail an.
Eine Zeichenfolge wird an Ihre registrierte E-Mail-Adresse zugeschickt.
Benutzen Sie diese Zeichenfolge, um Ihr Kennwort zurück zu setzen.
_SBHD;

$para['command::contact'] = <<<_SBHD
Nachricht:

%s

--
SiteBar Installation auf dem Server %s.
_SBHD;

$para['command::contact_group'] = <<<_SBHD
Gruppe: %s
Nachricht:

%s


--
SiteBar Installation auf dem Server %s.

_SBHD;

$para['command::delete_account'] = <<<_SBHD
<h3>Wollen Sie Ihr Konto wirklich löschen?</h3>
Es gibt keine Möglichkeit, diesen Schritt rückgängig zu machen!<p>
_SBHD;

$para['command::email_link_href'] = <<<_SBHD
<p>Klicken Sie
<a href="mailto:?subject=Webseite: %s&body=Ich habe eine neue Webseite gefunden, die für Dich interessant
 sein könnte.
 Schau mal hier: %s
 --
 Diese automatische E-Mail wurde über die SiteBar Installation des Servers %s versendet.
 Mehr Infos über SiteBar unter http://sitebar.org
">hier</a>, um eine E-Mail über Ihr lokales E-Mail Programm zu versenden.
_SBHD;

$para['command::email_link'] = <<<_SBHD
Ich habe eine neue Webseite gefunden, die für Dich interessant sein könnte.
Hier ist der entsprechende Link:

    "%s" %s

%s

--
Diese automatische Mail wurde über die SiteBar Installation des Servers %s versendet.
SiteBar ist ein Open-Source-Lesezeichen-Server (http://sitebar.org)
_SBHD;

$para['command::verify_email'] = <<<_SBHD
<@>Diese E-Mail wurde ausgesandt um diese E-mail-Adresse für den
Zugriff auf Auto-Join Gruppen des Sitebar Servers zu ermöglichen.
Nach der Validierung können auch die E-mail-Features des Servers
verwendet werden.

Bitte auf diesen Link klicken um diese E-mail-Adresse zu validieren:
    %s
_SBHD;

$para['command::verify_email_must'] = <<<_SBHD
Sie haben sich für einen SiteBar Account einer SiteBar Installation angemeldet die vor der ersten Nutzung eine Verifikation der E-Mail Adresse benötigt.

Bitte auf diesen Link klicken um diese E-mail-Adresse zu validieren:
    %s
_SBHD;

$para['command::export_bk_ie_hint'] = <<<_SBHD
Der Internet Explorer kann Lesezeichen im Netscape Lesezeichen Format über das Menü "Datei/Importieren und Exportieren ..." importieren.
In jedem Falle muss es sich bei der Datei um eine standard Windows-Kodierte Datei handeln, UTF-8 wird nicht funktionieren.<br>
_SBHD;

$para['command::import_bk_ie_hint'] = <<<_SBHD
Der Internet Explorer kann Lesezeichen in das Netscape Lesezeichen Format über das Menü "Datei/Importieren und Exportieren ..." exportieren.
Die exportierte Datei besitzt dann eine standard Windows Kodierung - bitte wählen Sie die Codepage beim importieren, UTF-8 wird nicht funktionieren.<br>
_SBHD;

$para['command::noiconv'] = <<<_SBHD
<br>
Die Codepage-Umwandlung ist auf diesem Sitebar-Server nicht verfügbar. Nur utf-8 und iso-8859-1 werden unterstützt.
<br>
_SBHD;

$para['command::security_legend'] = <<<_SBHD
Rechte:
<strong>A</strong>nsehen,
<strong>H</strong>inzufügen,
<strong>M</strong>odifizieren,
<strong>L</strong>öschen
_SBHD;

$para['command::purge_cache'] = <<<_SBHD
<h3>Sollen wirklich alle FavIcons aus dem Cache entfernt werden</h3>
_SBHD;

$para['command::tooltip_allow_anonymous_export'] = <<<_SBHD
Ermöglicht es auch anonymen Benutzern die Lesezeichen herunterzuladen oder den Feed zu verwenden. Diese Sperre kann umgangen werden wenn der Benutzer weiss, wie die entsprechende URL lauten muss.
_SBHD;

$para['command::tooltip_allow_contact'] = <<<_SBHD
Erlaube anonymen Nutzern den Administrator zu kontaktieren.
_SBHD;

$para['command::tooltip_allow_custom_search_engine'] = <<<_SBHD
Erlaubt den Benutzern in Ihren Einstellungen eine eigene Suchmaschine auszuwählen. Wird dies nicht gestattet, wird immer die auf dieser Seite angegebene Suchmaschine verwendet.
_SBHD;

$para['command::tooltip_allow_info_mails'] = <<<_SBHD
Erlaube Administratoren und Moderatoren zu deren Gruppen ich gehöre mit Informations E-Mails zu senden.
_SBHD;

$para['command::tooltip_allow_sign_up'] = <<<_SBHD
Erlaube Besuchern das Aufnahmeformular aufzurufen und sich bei SiteBar anzumelden.
_SBHD;

$para['command::tooltip_allow_user_groups'] = <<<_SBHD
Es ist Benutzern erlaubt ihre eigenen Gruppen zu erstellen. Andernfalls haben nur Administratoren dieses Recht.
_SBHD;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_SBHD
Erlaube Nutzern ihre existierenden Bäume zu löschen.
_SBHD;

$para['command::tooltip_allow_user_trees'] = <<<_SBHD
Erlaube Benutzern zusätzliche Bäume zu erstellen.
_SBHD;

$para['command::tooltip_approved'] = <<<_SBHD
Konto als "akzeptiert" markieren und damit den Zugriff für diesen Nutzer freischalten.
_SBHD;

$para['command::tooltip_auto_close'] = <<<_SBHD
Zeige im Erfolgsfall nicht den Befehls-Ausführungs-Status.
_SBHD;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_SBHD
Empfange Favicon automatisch wenn es fehlt und ein Link hinzugefühgt wird.
_SBHD;

$para['command::tooltip_default_groups'] = <<<_SBHD
Liste der Gruppen, die für die Benutzer ohne Gruppen angelegt werden. Benutzer | , um die Gruppennamen zu trennen.
_SBHD;

$para['command::tooltip_public_groups'] = <<<_SBHD
Liste der Gruppen, die für anonyme Benutzer verfügbar sein werden.
_SBHD;

$para['command::tooltip_cmd'] = <<<_SBHD
Die wichtigsten SiteBar-Befehle hinzufügen um möglichst einfach in die SiteBar einloggen zu können.
_SBHD;

$para['command::tooltip_comment_impex'] = <<<_SBHD
Zeige Befehle für Import und Export von Verweisbeschreibungen.
_SBHD;

$para['command::tooltip_comment_limit'] = <<<_SBHD
Es besteht die Möglichkeit, eine maximale Länge für ein Link-Kommentar zu definieren. Es besteht die Möglichkleit, kleine Dateien als Kommentar zu speichern.
_SBHD;

$para['command::tooltip_default_folder'] = <<<_SBHD
Diese Ordner wird als der Standard-Ordner gesetzt, wenn das Bookmarklet das nächste Mal verwendet wird.
_SBHD;

$para['command::tooltip_delete_content'] = <<<_SBHD
Lösche den Inhalt des Verzeichnisses , nicht jedoch das Verzeichnis selbst.
_SBHD;

$para['command::tooltip_delete_favicons'] = <<<_SBHD
Entfernt die Icon-URL vom Lesezeichen wenn sie ungültig ist. Diese Funktion ist mit Vorsicht zu verwenden.
_SBHD;

$para['command::tooltip_demo'] = <<<_SBHD
Verwandelt das erstellte Konto in einen Demo-Zugang. Die Rechte für den Demo-Nutzer sind eingeschränkt und das Passwort kann nicht geändert werden.
_SBHD;

$para['command::tooltip_discover_favicons'] = <<<_SBHD
Analysiert die angegebene URL und sucht nach fehlenden Icons.
_SBHD;

$para['command::tooltip_exclude_root'] = <<<_SBHD
Der Root-Ordner wird in der Ausgabe nicht enthalten sein, wenn es möglich ist.
_SBHD;

$para['command::tooltip_expert_mode'] = <<<_SBHD
Die erweiterten Einstellungen anzeigen und mehr Diagnosenachrichten zeigen.
_SBHD;

$para['command::tooltip_extern_commander'] = <<<_SBHD
Befehle mit Hilfe eines externen Fensters ausführen - ohne nach jedem Befehl neu laden zu müssen.
_SBHD;

$para['command::tooltip_filter_groups'] = <<<_SBHD
Benutze Suchfilter für Gruppen anstatt einer Auswahlliste.
_SBHD;

$para['command::tooltip_filter_users'] = <<<_SBHD
Benutze Suchfilter für Benutzer anstatt einer Auswahlliste.
_SBHD;

$para['command::tooltip_flat'] = <<<_SBHD
Exportiert die Lesezeichen als wären sie in einem Ordner.
_SBHD;

$para['command::tooltip_hide_xslt'] = <<<_SBHD
Deaktiviert Features der SiteBar die eine XSLT-Unterstützung des Browsers benötigen.
_SBHD;

$para['command::tooltip_hits'] = <<<_SBHD
Aktivieren dieser Funktion leitet jeden Klick durch den SiteBar-Server, so dass eine Statistik über die Verwendung der Links erstellt werden kann.
_SBHD;

$para['command::tooltip_ignore_https'] = <<<_SBHD
SiteBar kann HTTPS nicht prüfen, wenn dies nicht gesetzt ist. Alle Links, die kein HTTP-Url sind, werden die Prüfung nicht bestehen.
_SBHD;

$para['command::tooltip_ignore_recently'] = <<<_SBHD
Lesezeichen die vor kurzem validiert wurden nicht in die Validierung mit einbeziehen. Diese Funktion ist nützlich wenn die vorige Validierung abgebrochen wurde und nun fortgesetzt werden soll.
_SBHD;

$para['command::tooltip_integrator_url'] = <<<_SBHD
SiteBar benutzt standardmäßig Integrator von my.sitebar.org, aus Privatsphäre-Gründen kann ein lokaler Integrator benutzt werden.
_SBHD;

$para['command::tooltip_is_dead_check'] = <<<_SBHD
Dieser Link konnte nicht validiert werden. Er kann entweder entfernt oder wieder als aktiv markiert werden.
_SBHD;

$para['command::tooltip_is_feed'] = <<<_SBHD
Link als Feed definieren - der Link wird in einem Feed-Leser geöffnet (wenn eingerichtet), anstatt direkt in einem Browser.
_SBHD;

$para['command::tooltip_load_all_nodes'] = <<<_SBHD
Lade alle Ordner. Dies ist für Benutzer mit wenigen Lesezeichen geeignet, die das Filtern benutzen möchten.
_SBHD;

$para['command::tooltip_popup_params'] = <<<_SBHD
Die Parameter für das von SiteBar geöffneten Pop-Up Fenster. Leer lassen, um die Standardwerte einzustellen.
_SBHD;

$para['command::tooltip_max_icon_age'] = <<<_SBHD
Maximales Alter der Icons. Bestimmt wie häufig ein Icon vom ursprünglichen Server erneuert wird.
_SBHD;

$para['command::tooltip_max_icon_cache'] = <<<_SBHD
Maximal Anzahl Icons im Cache. Die ältesten Icons werden aus dem System entfernt.
_SBHD;

$para['command::tooltip_max_icon_size'] = <<<_SBHD
Maximal erlaubte Größe eines Bildes (in Bytes), um in den Cache aufgenommen zu werden.
_SBHD;

$para['command::tooltip_max_session_time'] = <<<_SBHD
Administrator kann die maximal erlaubte Session-Zeit festlegen. Wenn diese Zeit überschritten wird, muss sich der Benutzer nochmal anmelden.
_SBHD;

$para['command::tooltip_menu_icon'] = <<<_SBHD
Einige Browser bzw. Plattformen ermöglichen keinen Rechtsklick auf die Lesezeichen der SiteBar. Um die SiteBar trotzdem verwenden zu können aktiviert diese Option ein kleines Icon neben jedem Ordner oder Lesezeichen, der das Kontext-Menü aufruft.
_SBHD;

$para['command::tooltip_mix_mode'] = <<<_SBHD
Ordner werden ober- bzw. unterhalb der Lesezeichen angezeigt.
_SBHD;

$para['command::tooltip_novalidate'] = <<<_SBHD
Dieses Lesezeichnen nicht in die Validierung mit einbeziehen. Diese Funktion ist sinnvoll für Links ins Intranet, die vom externen Server nicht validiert werden können.
_SBHD;

$para['command::tooltip_paste_content'] = <<<_SBHD
Die Operation nur auf den Inhalt des Ordners anwenden, nicht auf den Ordner selbst.
_SBHD;

$para['command::tooltip_private'] = <<<_SBHD
Private Lesezeichen werden niemals an andere Benutzer gezeigt, auch wenn diese Lesezeichen sich in freigegebenen Ordnern befinden.
_SBHD;

$para['command::tooltip_private_over_ssl_only'] = <<<_SBHD
Private Lesezeichen werden nur geladen, wenn eine sichere (SSL) Verbindung zur SiteBar besteht.
_SBHD;

$para['command::tooltip_rename'] = <<<_SBHD
Lesezeichen mit gleichen Namen werden beim Import umbenannt, so dass alles Lesezeichen importiert werden.
_SBHD;

$para['command::tooltip_respect'] = <<<_SBHD
Sende E-Mail nur wenn der Benutzer es erlaubt hat.
_SBHD;

$para['command::tooltip_search_engine_ico'] = <<<_SBHD
Icon, das im SiteBar-Toolbar vor der Web-Suche angezeigt wird.
_SBHD;

$para['command::tooltip_search_engine_url'] = <<<_SBHD
URL der zum Suchen benutzenden Suchmaschine. Benutzen Sie %SEARCH% dort, wo der Suchbegriff eingesetzt wird.
_SBHD;

$para['command::tooltip_sender_email'] = <<<_SBHD
SiteBar generierte E-Mails werden mit dieser E-Mail-Adresse versendet.
_SBHD;

$para['command::tooltip_show_acl'] = <<<_SBHD
Schmücke Verzeichnisse mit Sicherheitsspezifikationen.
_SBHD;

$para['command::tooltip_show_logo'] = <<<_SBHD
Aktiviert das SiteBar-Logo am oberen Bildschirm-Rand. Bei einem langsamen Host macht es Sinn das Logo abzuschalten.
_SBHD;

$para['command::tooltip_show_statistics'] = <<<_SBHD
Zeige einige statische und Performance Statistiken in der Haupt-SiteBar Leiste.
_SBHD;

$para['command::tooltip_subdir'] = <<<_SBHD
Exportiert rekursiv alle Ordner und Lesezeichen
_SBHD;

$para['command::tooltip_subfolders'] = <<<_SBHD
Die Lesezeichen dieses Ordner und aller Unterordner validieren.
_SBHD;

$para['command::tooltip_to_verified'] = <<<_SBHD
Sende E-Mails nur zu überprüften Adressen.
_SBHD;

$para['command::tooltip_use_compression'] = <<<_SBHD
Die Seiten der SiteBar können komprimiert werden um Bandbreite zu sparen. Allerdings setzt dies die Unterstützung des Features durch den Browser vorraus.
_SBHD;

$para['command::tooltip_use_conv_engine'] = <<<_SBHD
Die Zeichensatz-Konvertierung ist notwendig um verschiedene Sprachsysteme in einander zu konvertieren. Dies ist vor allem beim Im- und Export von Lesezeichen
wichtig. Allerdings ist dazu eine PHP-interne Erweiterung (iconv) notwendig, die nicht immer aktiviert ist. Dies kann auf manchen Systemen dazu führen, dass die SiteBar nicht funktioniert.
_SBHD;

$para['command::tooltip_use_favicon_cache'] = <<<_SBHD
Aktiviert den Cache für die Icons. Der Server wird die Icons für Lesezeichen herunterladen und in der Datenbank zwischenspeichern. Ist der Cache aktiviert, wird die SiteBar schneller aufgebaut, da alle Bilder vom SiteBar-Server geliefert werden, aber dafür ist der Traffic über den Server höher. Wird der Cache deaktiviert werden die Icons durch Links auf die Original-Position ersetzt. In dem Fall holt der Browser alle Icons selbst, muss aber dafuer entsprechend viele Server kontaktieren.
_SBHD;

$para['command::tooltip_use_favicons'] = <<<_SBHD
Die Verwendung der Icons von Lesezeichen ist zwar grafisch ansprechend, verlangsamt die SiteBar jedoch merklich. Werden die Icons angezeigt, sollte man den Icon Cache aktivieren, um den Geschwindigkeitsverlust zu reduzieren.
_SBHD;

$para['command::tooltip_use_hiding'] = <<<_SBHD
Erlaubt das Verstecken einzelner Ordner. Diese Funktion ist nützlich, um die veröffentlichten Ordner anderer Benutzer aus dem eigenen Baum auszublenden.
_SBHD;

$para['command::tooltip_use_mail_features'] = <<<_SBHD
Aktiviert die Mailing-Funktion der SiteBar. Diese Funktionalität steht nur zur Verfügung wenn PHP die Verwendung der "mail"-Funktion erlaubt.
_SBHD;

$para['command::tooltip_use_new_window'] = <<<_SBHD
Öffne alle Links im neuen Fenster, indem als Ziel _blank benutzt wird.
_SBHD;

$para['command::tooltip_use_outbound_connection'] = <<<_SBHD
Einige Funktionen (Icon Cache) benötigen den Zugriff auf externe Seiten. Eigenständige Verbindungen durch die SiteBar können mit dieser Option jedoch unterbunden werden.
_SBHD;

$para['command::tooltip_use_search_engine'] = <<<_SBHD
Erlaubt die Verwendung externer Suchmaschinen.
_SBHD;

$para['command::tooltip_use_search_engine_iframe'] = <<<_SBHD
Die Ergebnisse der Suchmaschine werden an das SiteBar-Suchergebnis angehängt.
_SBHD;

$para['command::tooltip_use_tooltips'] = <<<_SBHD
Aktiviert die SiteBar eigene Tooltip-Funktion (anstatt die des Browsers). Das erlaubt zum einen längere Tooltips und funktioniert zum anderen auf mehr Browsern.
_SBHD;

$para['command::tooltip_use_trash'] = <<<_SBHD
Aktiviert den Papierkorb. Gelöschte Lesezeichnen und Ordner werden so anfänglich nur als gelöscht markiert und können dann entweder endgültig gelöscht oder wieder hergestellt werden.
_SBHD;

$para['command::tooltip_users_must_be_approved'] = <<<_SBHD
Benutzer müssen vom Administrator freigeschaltet werden bevor sie SiteBar verwenden können.
_SBHD;

$para['command::tooltip_users_must_verify_email'] = <<<_SBHD
Benutzer müssen ihre E-Mail Adresse bestätigen bevor sie SiteBar benutzen können.
_SBHD;

$para['command::tooltip_verified'] = <<<_SBHD
Hiermit wird die E-Mail Adresse auch ohne Überprüfung als korrekt markiert.
_SBHD;

$para['command::tooltip_version_check_interval'] = <<<_SBHD
SiteBar kann regelmäßig überprüfen, ob eine neuere Version verfügbar ist. Das kann in bestimmten Fällen wichtig sein, wenn eine Verwundbarkeit der jetzigen Verion herausgefunden wurde. Dazu wird eine Verbindung nach aussen benötigt.
_SBHD;

$para['command::tooltip_web_search_user_agents'] = <<<_SBHD
Ein Regular-Expression für die Benutzer-Agenten, die ein ohne-javascript basiertes Textfeld bekommen sollen.
_SBHD;

$para['sitebar::users_must_verify_email'] = <<<_SBHD
Dieser SiteBar-Server erfordert eine verifizierte E-Mail. Bitte Geben verifizieren Sie Ihre E-Mail-Adresse, da der Account ansonsten vielleicht gelöscht wird.
_SBHD;

$para['sitebar::tutorial'] = <<<_SBHD
Das Icon mit Deinem Benutzernamen darüber ist Dein Haupt-Lesezeichen-Ordner.
Klick mit der rechten Maustaste und wähle den Befehl "%s", um Dein erstes Lesezeichen hinzuzufügen.
_SBHD;

$para['sitebar::invitation'] = <<<_SBHD
Der Benutzer <strong>%s</strong> möchte Lesezeichen mit Dir austauschen
und lädt Dich der Gruppe <strong>%s</strong> ein.
_SBHD;

$para['usermanager::signup_info'] = <<<_SBHD
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation auf %s angemeldet.
_SBHD;

$para['usermanager::signup_info_verified'] = <<<_SBHD
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation auf %s angemeldet.
Der Benutzer hat seine E-Mail Adresse schon verifiziert.
_SBHD;

$para['usermanager::signup_approval'] = <<<_SBHD
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation auf %s angemeldet.

Account annehmen:
    %s

Account ablehnen:
    %s

Ausstehende Benutzer sehen:
    %s
_SBHD;

$para['usermanager::signup_approval_verified'] = <<<_SBHD
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation auf %s angemeldet.
Der Benutzer hat seine E-Mail Adresse schon verifiziert.

Account annehmen:
    %s

Account ablehnen:
    %s

Ausstehende Benutzer sehen:
    %s
_SBHD;

$para['usermanager::alert'] = <<<_SBHD
%s
_SBHD;

$para['messenger::cancel'] = <<<_SBHD
abbrechen
_SBHD;

$para['messenger::delete'] = <<<_SBHD
gelöscht
_SBHD;

$para['messenger::expire'] = <<<_SBHD
abgelaufen
_SBHD;

$para['messenger::read'] = <<<_SBHD
gelesen
_SBHD;

$para['messenger::unread'] = <<<_SBHD
ungelesen
_SBHD;

$para['messenger::save'] = <<<_SBHD
speichern
_SBHD;

$para['messenger::state_unread'] = <<<_SBHD
ungelesen
_SBHD;

$para['messenger::state_seen'] = <<<_SBHD
gesehen
_SBHD;

$para['messenger::state_read'] = <<<_SBHD
gelesen
_SBHD;

$para['messenger::state_saved'] = <<<_SBHD
gespeichert
_SBHD;

$para['messenger::state_deleted'] = <<<_SBHD
gelöscht
_SBHD;

$para['messenger::state_expired'] = <<<_SBHD
abgelaufen
_SBHD;

$para['hook::statistics'] = <<<_SBHD
Roots {roots_total}.
Verzeichnisse {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
User {users}.
Gruppen {groups}.
SQL Abfragen {queries}.
DB/Total Zeit {time_db}/{time_total} Sek ({time_pct}%).
_SBHD;

$para['groupname::Family'] = <<<_SBHD
Familie
_SBHD;

$para['groupname::Friends'] = <<<_SBHD
Freunde
_SBHD;

$para['groupname::Public'] = <<<_SBHD
öffentlich
_SBHD;

?>
