<?php

$help = array();

$help['100'] = <<<_P
Le funzioni di SiteBar sono accesibili dal <strong>menu utente</strong> e dal
<strong>menu contestuale</strong> delle cartelle e dei collegamenti.
Il <strong>menu utente</strong> si trova nella parte bassa del monitor, mentre
il <strong>menu contestuale</strong> &#232; accessibile premendo il tasto destro
del mouse sulle cartelle o sui link. Gli utenti che utilizzano Opera o computers
Apple possono usare la sequenza di tasti Ctrl-click.
Nel caso Ctrl-click non funzioni &#232; possibile impostare "Mostra menu icone"
dal menu "Impostazioni utente". Quando viene selezionata questa opzione verra
visualizzata un'icona menu dietro le icone cartella o link. Cliccando su questa icona menu
accederete al menu contestuale.
<p>
Il menu contestuale e il menu utente visuallizzano differenti sottoinsiemi di comandi
per differenti utenti, secondo i diritti dell'utente registrato nel sistema.
Alcuni elementi nel menu contestuale, potrebbero essere disabilitati in base ai diritti
dell'utente, ai nodi e corrente stato del programma.
I comandi vengono eseguiti attraverso la finestra dei comandi.

_P;

$help['101'] = <<<_P
Cliccate su una cartella o un collegamento e muovete il cursore del mouse su un'altra cartella
mantenendo premuto il pulsante del mouse. Lo spostamento viene evidenziato quando passate
col mouse sulla cartella di destinazione. Rilasciate il pulsante del mouse per muovere la cartella
o il collegamento nella cartella evidenziata.
<p>
Questa opzione non &#232; implementata dal team di SiteBar per il browser Opera. Gli utenti
che utilizzano Opera possono usare la funzione copia e incolla.
_P;

$help['102'] = <<<_P
La via piu conveniente per aggiungere un collegamento &#232; quella di utilizzare bookmarklet.
Potete creare bookmarklet dalla pagina principale della vostra installzione di SiteBar, la quale
dovrebbe essere disponibile cliccando sul logo di SiteBar. Gli utenti di Internet Explorer possono
usare il menu contestuale, se usano l'installer descritto nella stessa pagina di bookmarklet.
_P;

$help['103'] = <<<_P
<@><p><strong>Cerca</strong> - Permette di fare delle ricerche in tuttu i link visualizzati.
E' possibile fare delle ricerche usando prefissi:
<strong>url:</strong>, <strong>nome:</strong>, <strong>desc:</strong>,
<strong>tutto:</strong>. Il prefisso predefinito &#232; <strong>nome:</strong> e puo
essere cambiato in "Impostazioni utente". Quando viene trovato il link o la cartella cercata,
vengono evidenziati e appare un javascript di conferma con alcuni dettagli.
L'utente puo continuare con la ricerca o fermarsi.

<p><strong>Evidenziato</strong> - Come cerca ma senza il javascript di conferma.

<p><strong>Espandi tutto</strong> - Espande tutti i nodi. Quando viene premuto
per la seconda volta (quando tutti i nodi sono gia espansi) allora espande tutti i nodi.

<p><strong>Ricarica con cartelle nascoste</strong> - Ricarica tutti i link dal server,
incluse le cartelle nascoste con il comando "Nascondi cartella".

<p><strong>Ricarica</strong> - Ricarica tutti i link dal server,
questa opzione e qui perch&#233 il plugin risiede in sidebar dove l'utente non
avrebbe la possibilita (dipende dal browser) di ricaricarlo.

_P;

$help['200'] = <<<_P
I comandi sono raggruppati in differenti gruppi logici. Selezionate uno dei gruppi
per visuallizare le informazioni relative al comando.
_P;

$help['301'] = <<<_P
SiteBar &#232; stato testato con i seguenti browser:

<ul>
    <li>Mozilla 1.4, 1.5a
    <li>Mozilla Firebird 0.61, 0.7
    <li>Galeon 1.3.7
    <li>Internet Explorer 6.0
    <li>Opera 7.11, 7.21 </ul> I seguenti navigatori sono accessibili solo in lettura: <ul> <li>Pocket Internet Explorer 2002 <li>Netscape Navigator 4.78 </ul>
_P;

?>
