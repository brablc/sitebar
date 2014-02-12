<?php

$para['integrator::welcome'] = <<<_P
Bienvenido a la página de integración de SiteBar, en la que aprenderás a sacarle el máximo partido. Puedes aprender más sobre sus características en la <a href="http://sitebar.org/">página de SiteBar</a>.
_P;

$para['integrator::header'] = <<<_P
SiteBar está diseñado para cumplir con las normas y debería funcionar en la mayoría de los clientes Web siempre que javascript y las <i>cookies</i> estén activas. La siguiente tabla muestra una lista de los clientes Web con los que ha sido probado.
_P;

$para['integrator::usage_opera'] = <<<_P
<@>Haz clic con el botón derecho del ratón para mostrar los menús contextuales de enlaces y carpetas. Sin embargo, si utilizas Opera deberás activar la opción "Icono de menú" en "Opciones de usuario" y hacer clic con el botón izquierdo del ratón sobre en icono que aparece junto al enlace o la carpeta. Opera no comprende <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>, por lo que es recomendable desactivar las características relacionadas con XSLT en "Opciones de usuario".
_P;

$para['integrator::hint'] = <<<_P
Haz clic arriba, en el nombre del cliente Web que escojas, para ver las instrucciones de integración. Por favor, <a href="http://brablc.com/mailto?o">avísamos</a> si conoces algún otro cliente o plataforma en los que SiteBar funcione.
_P;

$para['integrator::hint_window'] = <<<_P
Éste es un enlace normal que abrirá SiteBar en la ventana actual. El diseño de SiteBar es vertical en lugar de horizontal. De lo contrario se desaprovecharía mucho espacio.
_P;

$para['integrator::hint_dir'] = <<<_P
Además de la vista de árbol, SiteBar puede ser visto como un directorio tradicional. En dicha vista se muestra un directorio cada vez, junto con los detalles de los enlaces asociados. The cliente Web debe comprender <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Si tu navegador no tiene la barra lateral, tú puedes usar este programa&#42;. Abrirá SiteBar en una ventana emergente o pop-up. Pero comprueba que tu navegador no bloquee los pop-ups!

_P;

$para['command::contact'] = <<<_P
Mensaje:

%s


--
La instalación de SiteBar en %s.
_P;

$para['command::contact_group'] = <<<_P
Grupo: %s
Mensaje:

%s


--
La instalación de SiteBar en %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>¿Quieres realmente borrar tu cuenta?</h3>
¡No habrá manera deshacer ese cambio! <p> Los restos de tus árboles serán dados al administrador del sistema.
_P;

$para['command::email_link_href'] = <<<_P
<@><p>Enviar e-maila través de tu correo predeterminado
<a href='mailto:?subject=Págia WEb: %s&body=He encontrado una web que te puede interesar.
 Miralá en: %s
 --
 Enviado a través de  SiteBar at %s
 Servidor de Favoritos de Código abierto http://sitebar.org
'>e-mail del cliente</a>
_P;

$para['command::email_link'] = <<<_P
He encontrado una web que te puede interesar.
Miralá en:

    "%s" %s

%s

--
Enviado a través de SiteBar en %s
Servidor de Favoritos de Código abierto http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
<@>Tu has pedido validación por e-mail que te permita unirte
a los grupos y usar las características de e-mail de SiteBar.

Por favor clic en el siguiente enlace para verificar tu correo:
    %s
_P;

$para['command::noiconv'] = <<<_P
<br>
Conversión para el código de página no está instalado en este servidor de SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Derechos:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete
_P;

$para['command::purge_cache'] = <<<_P
<h3>¿Quieres realmente quitar los favoritos de la cache?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Tu dirección de email cumple las reglas para unirse a los siguientes
grupos privado(s):
    %s.

Para que se te apruebe tu membresíá, tu dirección de email
debe ser verificada. Por favor pulsa sobre el siguiente enlace para verificarla:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
<@>El usuario "%s" <%s> se ha dado de alta en tu servicio de SiteBar ubicado en %s.
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
Raíces {roots_total}.
Carpetas {nodes_shown}/{nodes_total}.
Enlaces {links_shown}/{links_total}.
Usuarios {users}.
Grupos {groups}.
Consultas SQL {queries}.
BD/Tiempo total {time_db}/{time_total} segundos ({time_pct}%).
_P;

?>
