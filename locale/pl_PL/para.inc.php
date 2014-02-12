<?php

$para['integrator::welcome'] = <<<_P
Witamy na stronie integracji SiteBar. Strona ta pomoże Ci poznać najważniejsze cechy SiteBar. Na stronie <a href="http://sitebar.org/">Strona domowa SiteBar</a> możesz dowiedzieć się więcej na temat funkcji SiteBar.
_P;

$para['integrator::header'] = <<<_P
SiteBar jest zaprojektowany w zgodności ze standardami i powinien działać w większości przeglądarek obsługujących javascript oraz cookies. Poniższa tabela pokazuje, na których przeglądarkach został przetestowany.
_P;

$para['integrator::usage_opera'] = <<<_P
<@>SiteBar wykorzystuje prawy przycisk do wywołania menu kontekstowego dla linków i katalogów.
Jako użytkownik Opery musisz włączyć tak zwane "Menu Icon" w "User Settings" i klikać na ikonie obok linku lub katalogu. Opera nie obsługuje <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. Zaleca się wyłączenie funkcjonalności XSLT w "Konfiguracji".
_P;

$para['integrator::hint'] = <<<_P
Kliknij na nazwę przeglądarki aby zobaczyć instrukcje instalacji dla niej.
Proszę <a href="http://brablc.com/mailto?o">zaraportuj</a> inne sprawdzone przeglądarki/platformy.
_P;

$para['integrator::hint_window'] = <<<_P
To jest zwyczajny link, który otworzy SiteBar w obecnym oknie.
W ten sposób dużo przestrzeni zostanie nie wykorzystane, ponieważ
SiteBar jest zaprojektowany dla pionowego raczej wąskiego paska.
_P;

$para['integrator::hint_dir'] = <<<_P
Oprócz widoku podobnego do drzewa, SiteBar może być wyświetlany jako tradycyjny katalog.
Widok ten pokazuje jeden katalog w tym samym czasie oraz detale wyświetlanych linków.
Przeglądarka musi obsługiwać <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Jeśli twoja przeglądarka nie posiada funkcji sidebar, możesz użyć tego bookmarkletu*.
Otworzy on SiteBar jako okno popup podobne do sidebara. Weź proszę pod uwagę fakt, że Twoja przeglądarka może blokować popupy!
_P;

$para['integrator::hint_addpage'] = <<<_P
Ten bookmarklet* może być użyty w celu dodania linków do SiteBara. Po uruchomieniu otworzy się nowe okno popup wypełnione detalami obecnej strony.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> to zakładka, która zawiera kod JavaScript. Możesz kliknąć na niej prawym przyciskiem i dodać do paska zakładek. Późniejsze kliknięcie na tej zakładce uruchomi kod JavaScript.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Dodaj wyszukiwanie w zakładkach SiteBar do pola wyszukiwania w sieci. Pozwala na przeszukiwanie zakładek SiteBar bez konieczności otwierania SiteBara.
_P;

$para['integrator::hint_sitebar'] = <<<_P
<@>Rozszerzenie stworzone specjalnie dla SiteBar.
Pozwala na otwarcie wszystkich linków z katalogu jako panele i inne funkcje.
Użyj menu Widok/Paski Narzędzi/Dostosuj aby umieścić ikony SiteBar na Pasku Narzędzi.
[<a href="http://sitebarsidebar.mozdev.org/">Strona projektu</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Tworzy zakładkę, która po kliknięciu otworzy SiteBar w panelu sidebar.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Ściągnij strukturę katalogów całego SiteBar do pliku. Zaimportuj ten plik do swoich zakładek.
Każdy katalog będzie reprezentowany przez aktywną zakładkę. W ten sposób twoje zakładki będą zintegrowane z pozostałymi, ale zawartość katalogu będzie ściągana z SiteBara. Na wypadek gdyby katalog posiadał podkatalogi, zawartość aktualnego katalogu będzie pokazana w katalogu @Content.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Dodaje SiteBar do panelu sidebar. Panel może być ukrywany/odkrywany klawiszem F9. W przypadku gdy ładowanie SiteBar do sidebara przekroczy  określony limit czasu, Mozilla nie wyświetli go. Zaleca się otwarcie SiteBar w głównym oknie aby przeglądarka mogła umieścić w cache'u powiązane obrazki (ikony) lub wyłączenie wyświetlania ikon w "Konfiguracji".
_P;

$para['integrator::hint_hotlist'] = <<<_P
<@>Link do SiteBara będzie wyświetlany w panelu Hotlist. Kliknięcie na niego otworzy SiteBar w sidebarze Opery.
_P;

$para['integrator::hint_install'] = <<<_P
Instalacja SiteBar w pasku i menu kontekstowym Explorera wymaga zmiany w rejestrze systemowym Windows oraz restartu dla wszystkich funkcjonalności. W zalożneści od Twoich praw tylko niektóre funkcjonalności mogą zostać zainstalowane.
<br>
Otwórz pasek SiteBar z menu Widok/Pasek eksploratora lub użyj funkcji Dostosuj... w opcjach paska narzędzi i włącz widoczność przycisku SiteBar na pasku narzędzi. Prawy przycisk w dowolnym miejscu na stronie lub na linku pozwala dodać stronę lub link do SiteBara.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Deinstalacja z paska eksploratora (zobacz powyżej).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Używanie tego bookmarkletu* jest zalecane w sytuacji gdy użytkownik nie posiada wystarczających uprawnień do instalacji paska eksploratora. Ładuje on tymczasowo SiteBar do paska wyszukiwania przeglądarki.

_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Ściąga plugin (z ustawionym adresem URL). Archiwum musi zostać rozpakowane do katalogu "C:\Program Files\Maxthon\Plugin". Po restarcie nowy element paska eksploratora zpstanie dodany.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Ściąga plugin (z ustawionym adresem URL). Archiwum musi zostać rozpakowane do katalogu "C:\Program Files\Maxthon\Plugin". Po restarcie nowa ikona pojawi się na pasku pluginu. Ikona ta pozwala dodać stronę w obecnym panelu do SiteBara.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Uruchom polecenie <strong>emerge sitebar</strong> aby zainstalować pakiet SiteBar.
_P;

$para['integrator::hint_debian'] = <<<_P
Uruchom polecenie <strong>apt-get install sitebar</strong> aby zainstalować pakiet SiteBar.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu to hierarchiczny system menu służący do przygotowania menu DHTML zależnych od silnika PHP do przetwarzania elementów danych. SiteBar może udostępniać dane zakładek we właściwej strukturze. Jeśli możliwe jest wykonanie fopen na odległych plikach, to poniższy kod załaduje dane we właściwej strukturze:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['command::welcome'] = <<<_P
<@>%s, witaj w SiteBar!
%s
<p>
SiteBar jest obsługiwany poprzez menu kontekstowe wywoływane poprzez naciśnięcie prawego przycisku na katalogu lub linku. Jeśli twoja platforma/przeglądarka nie obsługuje prawego przycisku, możesz spróbować Ctrl-przycisk lub włączyć opcję "Pokaż ikonę menu" w "Konfiguracji" i klikać na ikonie.
<p>
Aby przeczytać więcej informacji na temat SiteBar kliknij proszę na pozycji "Pomoc" dolnym menu.
<p>
Jesteś już zalogowany.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Ta instalacja SiteBar wymaga aby Twój aktualny adres email został zweryfikowany zanim będziesz mógł korzystać z funkcji SiteBar.
<p>
Zakładając, że wprowadziłeś poprawny adres email, powinieneś otrzymać maila niebawem. Kliknij proszę na linku w emailu.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Ta instalacja SiteBar wymaga aby stworzone konta zostały zatwierdzone przez administratora zanim będzie można korzystać z funkcji SiteBar.
<p>
Zaczekaj proszę na zatwierdzenie administratora - zostaniesz poinformowany emailem.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Ta instalacja SiteBar wymaga aby Twój aktualny adres email został zweryfikowany oraz zatwierdzony przez administratora zanim będziesz mógł korzystać z funkcji SiteBar.
<p>
Zakładając, że wprowadziłeś poprawny adres email, powinieneś otrzymać maila niebawem. Kliknij proszę na linku w emailu i zaczekaj na zatwierdzenie administratora - zostaniesz poinformowany emailem.
_P;

$para['command::account_approved'] = <<<_P
<@>Administrator zatwierdził Twoją prośbę o konto.
Możesz zalogować się używając swojego adresu email %s.

--
Instalacja SiteBar na %s.
_P;

$para['command::account_rejected'] = <<<_P
<@>Administrator odrzucił Twoją prośbę o konto z emailem %s.

--
Instalacja SiteBar na %s.
_P;

$para['command::reset_password'] = <<<_P
Nadeszła prośba o reset hasła do konta SiteBar dla emaila "%s".

Jeśli naprawdę chcesz zresetować hasło do tego konta, kliknij proszę na poniższy link:
  %s

--
Instalacja SiteBar na %s.
_P;

$para['command::contact'] = <<<_P
%s


--
Instalacja SiteBar na %s.
_P;

$para['command::contact_group'] = <<<_P
Grupa docelowa: %s

%s


--
Instalacja SiteBar na %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>Czy napewno chcesz skasować swoje konto?</h3>
Nie będzie sposobu aby cofnąć tą zmianę!<p>
Wszystkie Twoje pozostałe drzewa zostaną oddane administratorowi systemu.
_P;

$para['command::email_link_href'] = <<<_P
<@><p>Wyślij email poprzez swojego domyślnego
<a href="mailto:?subject=Strona: %s&amp;body=Znalazłem stronę, która może Cię zainteresować.
Wejdź na: %s
--
Wysłane przez SiteBar na %s
Open Source Bookmark Server http://sitebar.org
">klienta poczty</a>
_P;

$para['command::email_link'] = <<<_P
Znalazłem stronę, która może Cię zainteresować.
Wejdź na:

  "%s" %s

%s

--
Wysłane przez SiteBar na %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
<@>Wysłałeś prośbę o potwierdzenie emaila, co pozwala na dołączanie do grup poprzez auto dołączenie z wykorzystaniem wyrażeń regularnych oraz daje możliwość korzystania z funkcjonalności email SiteBar'a.

Kliknij proszę na poniższy link aby zweryfikować swój email:
  %s
_P;

$para['command::verify_email_must'] = <<<_P
Zapisałeś się aby założyć konto w instalacji SiteBar, która wymaga weryfikacji emaila przed pierwszym użyciem SiteBar.

Kliknij proszę na poniższy link aby zweryfikować swój email:
  %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer potrafi importować zakładki w formacie plików Netscape poprzez menu "Plik/Importuj i eksportuj ...". Jednakże, plik musi mieć zestaw znaków w stronie kodowej Windows (cp1250), domyślne UTF-8 nie zadziała.<br>

_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer potrafi eksportować zakładki w formacie plików Netscape poprzez menu  "File/Import and Export ..." menu.
Plik wyeksportowany jest w natywnej stronie kodowej Windows (cp1250) - wybierz proszę stronę kodową podczas importowania pliku, domyślne UTF-8 nie zadziała.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Konwersja stron kodowych nie zainstalowana na tym serwerze SiteBar.
<br>

_P;

$para['command::security_legend'] = <<<_P
Prawa:
<strong>R</strong>-odczyt,
<strong>A</strong>-dodawanie,
<strong>M</strong>-modyfikacja,
<strong>D</strong>-kasowanie
_P;

$para['command::purge_cache'] = <<<_P
<h3>Czy napewno chcesz usunąć wszystkie ikony z cache'u?</h3>
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Pozwól użytkownikom dodawać samych siebie do grupy.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Włącz bezpośrednie ściąganie lub udostępnianie zakładek dla anonimowych użytkowników. Może być ominięte jeśli użytkownik wie jak utworzyć URL!
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Zezwalaj na kontakt z administratorem dla anonimowych użytkowników.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Pozwól aby modaerator grupy mógł by skontaktowany przez nie-członków
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Jeśli nie zezwolone, to wszyscy użytkownicy będą używać wyszukiwarki na tym formularzu i nie będą mogli jej modyfikować.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Zezwalaj moderatorom na dodanie mnie do ich grup.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Zezwalaj adminom i moderatorom grup, do których nalezę na wysyłanie do mnie emaili informacyjnych.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Zezwalaj odwiedzającym na dostęp do formularza rejestracji w SiteBar.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Użytkownicy mogą tworzyć swoje własne grupy. W przeciwnym przypadku tylko administrator będzie miał ten przywilej.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Pozwól użytkownikom kasować ich istniejące drzewa.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Pozwól użytkownikom tworzyć dodatkowe drzewa.
_P;

$para['command::tooltip_approved'] = <<<_P
Konto jest zatwierdzone i może być w pełni używane.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Nie wyświetlaj statusu wykonywania polecenia jeśli zakończone sukcesem.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Pobierz ikonę automatycznie, kiedy jej brak w dodawanym linku.
_P;

$para['command::tooltip_cmd'] = <<<_P
Dodaj najważniejsze polecenia SiteBar w celu łatwego zalogowania do SiteBar.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Pokazuj polecenia dla importu i eksportu opisów linków.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Następnym razem gdy użyjesz bookmarkletu ten katalog będzie ustawiony jako domyślny.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Wykasuj jedynie zawartość katalogu a nie sam katalog.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Wykasuj ikonę URL z linku jeśli ikona jest wadliwa - używaj z rozwagą.
_P;

$para['command::tooltip_demo'] = <<<_P
Zmień w konto demo z ograniczoną funkcjonalnością i bez możliwości zmiany hasła.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Próbuj analizować stronę i znaleźć ikony (skrótów), których brakuje.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
<@>Wykonaj polecenia używając zewnętrznego okna - bez przeładowania po każdym poleceniu.
_P;

$para['command::tooltip_flat'] = <<<_P
Eksportuj linki tak, jakby były w jednym katalogu.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Ukrywa funkcjonalności, które wymagają obsługi XSLT w przeglądarce.
_P;

$para['command::tooltip_hits'] = <<<_P
Przekieruj wszystkie kliknięcia na linkach poprzez serwer SiteBar aby generować statystyki użytkowania.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Nie testuj linków, które były testowane niedawno - używane do powtórnego sprawdzania jeśli poprzednie nie zostało zakończone.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Ten link nie przeszedł sprawdzania. Może nadal chcesz utrzymać go jako aktywny.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Jak długo ikony pozostaną w cache'u przed odświeżeniem ich ze zdalnego serwera.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
FIFO kolejka. Najstarsza ikona zostanie odrzucona z sytemu - używane do kontrolowania rozmiaru cache'u.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Maksymalny dopuszczalny rozmiar ikon w bajtach.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Niektóre przeglądarki/platformy nie obsługują prawego przycisku. To pokaże ikonę, która może być użyta w zamian do wyświetlenia menu kontekstowego.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Katalogi poprzedzają linki w drzewie SiteBar lub vice versa.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Nie sprawdzaj tego linku - użyj do linków intranetowych lub do tych, które mają problemy ze sprawdzaniem.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Zastosuj operację do zawartości katalogu a nie do samego katalogu.
_P;

$para['command::tooltip_private'] = <<<_P
<@>Oznacz link jako prywatny. Jedynie właściciel drzewa może zobaczyć taki link nawet jeśli katalog jest opublikowany.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
<@>Prywatne linki będą pobierane tylko jeśli SiteBar jest wykorzystany poprzez połączenie SSL.
_P;

$para['command::tooltip_rename'] = <<<_P
Podczas importu zmień nazwy duplikujących się linków aby wczytać wszystko.
_P;

$para['command::tooltip_respect'] = <<<_P
Wyślij email jedynie gdy użytkownik na to zezwoli.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Dekoruj katalogi specyfikacjami zabezpieczeń.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Pokazuj logo na szczycie - powinno być wyłączona dla wolnych łącz, w przeciwnym przypadku może być użyte jako reklama.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Wyświetlaj kilka statycznych i wydajnościowych statystyk na głównym panelu SiteBar.
_P;

$para['command::tooltip_subdir'] = <<<_P
Rekursywnie eksportuj wszystkie linki i katalogi.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Sprawdź ten katalog rekursywnie z wszystkimi podkatalogami.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Wysyłaj emaile tylko do zweryfikowanych adresów.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Strony wysyłane przez SiteBar mogą być kompresowane w celu oszczędzenia łącza. Kompresja jest używana jedynie wtedy, gdy jest obsługiwana przez przeglądarkę.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Używaj silnika konwersji (zazwyczaj rozszerzenie PHP) aby konwertować strony w innej stronie kodowej - ważne do importu i eksportu zakładek. Może powodować puste ekrany w niektórych implementacjach.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Ikony będą ściągane przez serwer do cache'u bazy po zapytaniu użytkownika. Zwiększa przepustowość oraz przyspiesza cache ikon poprzez zredukowanie liczby podłączonych serwerów.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Używanie czyni SiteBar przyjemniejszym ale wolniejszym. Kiedy cache ikon jest użyty, wyświetlanie ikon będzie znacznie szybsze.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Pozwala poleceniu ukrywać katalogi. Ukrywanie jest używane do opublikowanych katalogów innych użytkowników.użytkownicy
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Jeśli ta instalacja PHP pozwala na używanie funkcji "mail" - funkcjonalność email może być włączona.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Niektóre funkcje (cache ikon) wymagają dostępu do zdalnych adresów z Twojego serwera.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Pozwól wyszukiwaniu być przekierowanym do lub rozszerzonym przez rezultaty dostarczone przez Twoją ulubioną wyszukiwarkę.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Resultaty Twojej wyszukiwarki będą włączone do strony rezultatów wyszukiwania SiteBar używając wewnętrzej ramki.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Użyj porad SiteBar zamiast wbudowanych w przeglądarkę. Pozwala na dłuższe porady i obsługę większej ilości przeglądarek.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Oznacz wykasowane katalogi i linki tak aby mogły zostać przywrócone lub wykasowane całkowicie.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Użytkownicy muszą być zatwierdzeni przez adminstratora przed użyciem SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Użytkownicy muszą być zweryfikować email przed użyciem SiteBar.
_P;

$para['command::tooltip_verified'] = <<<_P
Włącz aby zaznaczyć mail jako zweryfikowany.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Ta instalacja SiteBar wymaga weryfikacji emaila.
Zweryfikuj proszę swój email, w przeciwnym przypadku Twoje konto może zostać usunięte.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Twój adres email spełnia reguły dołączania do poniższcyh zamkniętych grup:
  %s.

W celu zatwierdzenia Twojego członkowstwa, Twój adres musi zostać zweryfikowany. Kliknij proszę na poniższym linku aby go zweryfikować:
  %s
_P;

$para['usermanager::signup_info'] = <<<_P
<@>Użytkownik "%s" <%s> zapisał się do tej instancji SiteBar o %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
<@>Użytkownik "%s" <%s> zapisał się do tej instancji SiteBar o %s.
Użytkownik potwierdził już swój adres email.
_P;

$para['usermanager::signup_approval'] = <<<_P
<@>Użytkownik "%s" <%s> zapisał się do tej instancji SiteBar o %s.

Zatwierdź konto:
  %s

Odrzuć konto:
  %s

Zobacz oczekujących użytkowników:
  %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
<@>Użytkownik "%s" <%s> zapisał się do tej instancji SiteBar o %s.
Użytkownik potwierdził już swój adres email.

Zatwierdź konto:
  %s

Odrzuć konto:
  %s

Zobacz oczekujących użytkowników:
  %s
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
Drzewa {roots_total}.
Katalogi {nodes_shown}/{nodes_total}.
Linki {links_shown}/{links_total}.
Użytkownicy {users}.
Grupy {groups}.
Zapytania SQL {queries}.
DB/Całkowity czas {time_db}/{time_total} sek. ({time_pct}%).
_P;

?>
