<?php

$para['command::contact'] = <<<_P
Messaggio:

%s


--
Istallazione Sitebar a %s.
_P;

$para['command::contact_group'] = <<<_P
Gruppo: %s
Messaggio:

%s


--
Installazione SiteBar a %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>Vuoi veramente eliminare il tuo account?</h3>
Questa opzione &#232; irreversibile !<p>
Tutti i tuoi link verrano affidati all'amministratore di sistema.
_P;

$para['command::email_link_href'] = <<<_P
<@><p>Spedisci un'e-mail tramite <a href="mailto:?subject=Sito web: %s&amp;body=Ho trovato un sito web che ti potrebbe interessare. Dai un'occhiata a: %s -- Spedito tramite SiteBar a %s Open Source Bookmark Server http://sitebar.org ">il tuo programma e-mail predefinito</a>
_P;

$para['command::email_link'] = <<<_P
Ho trovato un sito web che potrebbe interessarti.
Dai un'occhiata a:

    "%s" %s

%s

--
Spedito via SiteBar a %s
Open Source Bookmark Server http://sitebar.org

_P;

$para['command::verify_email'] = <<<_P
<@>Hai chiesto la verifica dell'e-mail che consente di accedere ai gruppi con espressioni regolari di auto unione e consente di usare le funzionalità e-mail di SiteBar.

Per favore clicca sul collegamento seguente per verificare la tua e-mail:
   %s

_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer può importare/esportare i bookmark nel formato Netscape Bookmark. Nel caso, il file deve usare la codifica Windows nativa,  quella UTF-8 predefinita non funzionerà.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Il convertitore di Codepage non &#232; installato in questo SiteBar server.
<br>
_P;

$para['command::security_legend'] = <<<_P
Diritti:
<strong>R</strong>ead(Lettura),
<strong>A</strong>dd(Aggiunta),
<strong>M</strong>odify(Modifica),
<strong>D</strong>elete(Eliminazione)
_P;

$para['command::purge_cache'] = <<<_P
<h3>Vuoi davvero rimuovere tutte le facicon dalla cache?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Il tuo indirizzo e-mail rientra nelle regole per l'iscrizione automatica ai seguenti gruppi chiusi:
   %s.

Per approvare la tua iscrizione, il tuo indirizzo email deve essere verificato. Per favore clicca sul collegamento seguente per verificarlo:
   %s

_P;

$para['usermanager::signup_info'] = <<<_P
<@>L'utente "%s" <%s> si è registrato presso la tua installazione di SiteBar a %s.
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
Radici {roots_total}.
Cartelle {nodes_shown}/{nodes_total}.
Collegamenti {links_shown}/{links_total}.
Utenti {users}.
Gruppi {groups}.
Query SQL {queries}.
Tempo DB/Totale {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
