<?php

// Force commit

$help = array();

$help['100'] = <<<_P
Funkcje SiteBar dostępne są z <strong>Menu użytkownika</strong> oraz z <strong>Menu kontekstowych</strong> katalogu i linku. Menu użytkownika znajduje się na dole SiteBar, a menu kontekstowe są dostępne poprzez kliknanie prawym przyciskiem na katalogach lub linkach. Użytkownicy Opery i Apple mogą w zamian użyć Ctrl-klik. Na wypadek gdyby nawet Ctrl-klik nie był  rozpoznawany, możliwe jest włączenie "Pokaż ikonę menu" w "Konfiguracji". Jeśli ta opcja jest zaznaczona, mała ikona będzie widoczna obok ikony katalogu lub linku. Klikanie na tej ikonie wywołuje menu kontekstowe.
<p>
Zarówno menu kontekstowe oraz użytkownika mogą wyświetlać różny zestaw poleceń dla różnych użytkowników bazując na ich prawach w systemie. Niektóre elementy mogą być wyłączone w menu kontekstowym w zależności od praw użytkownika do węzłów oraz aktualnego trybu/stanu programu.
Polecenia są uruchamiane poprzez Okno poleceń.
_P;

$help['101'] = <<<_P
Kliknij na katalog lub link przyciskiem myszy i przesuń kursor na inny katalog trzymając przycisk wciśnięty. Przeciąganie jest sygnałowane poprzez podświetlenie katalogu docelowego. Puść przycisk aby upuścić przeciągany link lub katalog do aktualnie podświetlonego katalogu.
<p>
Przeciągnij & Upuść nie jest zaimplementowane przez zespół SiteBar dla przeglądarek Opera. Kopiuj i Wklej powinny być używane w zamian.
_P;

$help['103'] = <<<_P
<p><strong>Filtr</strong> - Filtruje wyświetlane linki.
Możlliwe jest sprecyzowanie, co ma być filtrowane, przy użyciu prefiksów
<strong>url:</strong>, <strong>name:</strong>, <strong>desc:</strong>, <strong>all:</strong>.
Domyślny prefiks to <strong>name:</strong> i może być zmieniony w "Konfiguracji".

<p><strong>Szukaj</strong> - Szukanie wykonywane przez serwer i wyświetlane w innej formie.

<p><strong>Szukaj w Internecie</strong> - Wyświetlane jeśli wyszukiwanie internetowe jest dozwolone i skonfigurowane.

<p><strong>Zwiń wszystkie</strong> - Zwija wszystkie węzły. Po kolejnym kliknięciu (jeśli wszystkie węzły są już zwinięte) rozwija wszystkie węzły.

<p><strong>Odświerz pokazując ukryte katalogi</strong> - Odświerza wszystkie linki z serwera włączjąc katalogi ukryte poleceniem "Ukryj katalog".

<p><strong>Odświerz</strong> - Odświerza wszystkie linki z serwera. Funkcja ta znajduje się tutaj ponieważ plugin jest umieszczony w sidebarze , gdzie może nie być (w zależności od przeglądarki) możliwości odświerzenia.
_P;

$help['200'] = <<<_P
Polecenia są pogrupowane w kilka grup logicznych. Wybierz proszę jedną z grup aby zobaczyć pomoc  dla polecenia.
_P;

$help['305'] = <<<_P
W celu zmigrowania istniejącej instalacji SiteBar na inny serwer potrzebne jest
<ul>
  <li>Eksport tabel sitebar_* z bazy źródłowej do pliku .SQL.
  <li>Import tego pliku do bazy docelowej.
  <li>Usuń oprogramowanie lub zainstaluj dowolną stabilną wersję SiteBar
     (upgrade lub downgrade będzie zrobiony automatycznie).
  <li>Usuń lub zaktualizuj  inc/config.inc.php jeśli szczegóły połączenia do bazy zmieniły się.
</ul>

<p>
Eksport i import może być wykonany przy użyciu <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a>.
Tabela sitebar_favicon (do 3.2.6) lub sitebar_cache (zaczynając z 3.3) nie musi być przetransferowana, jej zawartość będzie odbudowana.
_P;

?>
