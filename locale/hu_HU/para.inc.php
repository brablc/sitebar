<?php

$para['integrator::header'] = <<<_P
A SiteBar-t az aktuális szabványokat figyelembe véve terveztük, 
így a legtöbb böngészővel együttműködik, amennyiben a javascript 
és a sütik engedélyezve vannak. A következő táblázatban olvasható, 
hogy mely böngészőkkel teszteltük a SiteBar-t. 
_P;

$para['integrator::hint'] = <<<_P
A beépítési útmutatóhoz fent kattintson a választott böngésző nevére. Kérjük, <a href="http://brablc.com/mailto?o">jelezze</a>, ha egyéb bizonyítottan működő böngészőt/rendszert ismer. 
_P;

$para['integrator::hint_popup'] = <<<_P
Ha a böngészője nem támogatja az oldalsávokat, használhatja ezt a könyvjelzőcskét&#42; is. 
Ez megnyit egy az oldalsávhoz hasonlóan kinéző felugró ablakot. Kérjük, vegye figyelembe, hogy a böngészője lehetséges, hogy letiltja a felugró ablakok megjelenését. 
_P;

$para['integrator::hint_addpage'] = <<<_P
Ezt a könyvjelzőcskét&#42; a SiteBarhoz való könyvjelzőhozzáadásra használhatja. Meghíváskor egy felugró ablak jelenik meg előre kitöltve az adott oldalra vonatkozó paraméterekkel. 
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; A <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Könyvjelzőcske</a> egy JavaScriptet tartalmazó könyvjelző/kedvenc. 
Jobbkattintással hozzáadhatja a könyvjelző/kedvenc eszközsávjához. A későbbiekben erre a könyvjelzőre kattintva hajthatja végre a JavaScriptet.</i>
_P;

$para['command::tooltip_private'] = <<<_P
<@>A magáncélú hivatkozásokat nem exportálja. A magáncélú linkeket minden esetben csak tulajdonosuk exportálhatja.
_P;

$para['command::tooltip_subdir'] = <<<_P
Minden hivatkozás és mappa rekurzív kivitele.
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
{roots_total} gyökérmappa.
{nodes_shown}/{nodes_total} mappa. 
{links_shown}/{links_total} hivatkozás.
{users} felhasználó.
{groups} csoport. 
{queries} SQL lekérdezés.
Adabázis/Összes idő {time_db}/{time_total} mp ({time_pct}%).
_P;

?>
