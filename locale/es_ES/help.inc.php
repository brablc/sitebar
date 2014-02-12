<?php

$help = array();

$help['100'] = <<<_P
Las funciones de SiteBar están asequibles desde <strong>Menú del Usuario</strong> y desde <strong>El menú contextual</strong> de la vista carpetas y enlaces. El menú del usuario se muestra al fondo de SiteBar y el menú contextual aparece pulsando al botón derecho del ratón sobre las carpetas y enlaces. Los usuarios de Opera y Apple pueden usar ctrl.-Click en lugar del botón derecho del ratón para desplegar este menú contextual. En el caso de que ctrl.-Click no sea reconocido todavía es posible mostrarlo si en "Preferencias de Usuario" hemos seleccionado "Mostrar Icono de Menú"!.Cuando está opción está seleccionada podremos ver un pequeño icono de menú al lado del icono de carpeta o enlace. Pulsando sobre este icono aparecerá el menú contextual. <p> Tanto el menú contextual como el menú del usuario pueden mostrar diferentes subcomandos a los usuarios según sus permisos en el sistema. Los comandos son ejecutados a través de una ventana de comandos.
_P;

$help['101'] = <<<_P
Podemos hacer Clic sobre una carpeta o enlace con el ratón y mover el puntero sobre otra carpeta al mismo tiempo que mantenemos presionado el botón izquierdo del ratón. El proceso de arrastre se muestra resaltando la carpeta destino. Para mover la carpeta o enlace hacia la carpeta destino deberemos soltar el botón del ratón sobre dicha carpeta. <p>Arrastrar y soltar no está implementado para el navegador Opera, los usuarios de este navegador deberán utilizar copiar y pegar en su lugar.
_P;

$help['102'] = <<<_P
Una de las formas más cómodas de añadir enlaces es utilizando el llamado bookmarklet (marcador). Podemos crear un bookmarklet desde la página home de SiteBar. A esta página siempre podremos acceder pulsando sobre el logo de SiteBar. Los usuarios de Internet Explorer pueden usar el menú contextual si usan el instalador descrito en la misma página que el bookmarklet.
_P;

$help['103'] = <<<_P
<@><p><strong>Buscar</strong> - Permite buscar en todos los enlaces mostrados.
Es posible mostrar lo que debe ser buscado mostrando prefijos <strong>url:</strong>, <strong>nombre:</strong>,
<strong>desc:</strong>, <strong>todo:</strong>.
El prefijo por defecto es <strong>nombre:</strong> y puede ser cambiado in "Preferencias de Usuario".
Cuando se encuentra un enlace o carpeta es resaltado y una ventana de confirmación Javascript muestra algunos detalles.
El usuario tiene la posibilidad de continuar la búsqueda o pararla <p><strong>Resaltar</strong> -
En mismo efecto que buscar pero sin la alerta de javascript.
<p><strong>Comprimir todos</strong> - Comprime todos los nodos.
Cuando se hace click por segunda vez (Cuando todos los nodos están comprimidos) entonces expande todos los nodos.
<p><strong>Recargar con carpetas ocultas</strong> - Recarga todos los enlaces que hay en el servidor,
incluyendo las carpetas que han sido ocultas con el comando "Ocultar carpeta.
<p><strong>Recargar</strong> - Recarga todos los enlaces del servidor,
esta función está aquí para dar la oportunidad al usuario de recargarlo sin depender del navegado.
_P;

$help['200'] = <<<_P
Los comandos están agrupados en varios grupos lógicos. Por favor selecciona uno de los grupos para ver la ayuda sobre los comandos.
_P;

$help['210'] = <<<_P
<@><p><strong>Entrar</strong> - Permite que el usuario entre en el sistema, que siempre puede ser recordado usando cookies. El usuario puede especificar cuando expirará la cookie. <p><strong>Salir</strong> - Desconecta al usuario del sistema. Esto debiera de usarse siempre que usemos un terminal público. Una forma equivalente a salir es entrar con una sesión que expire al cerrar todas las ventanas del navegador. <p><strong>Darse de alta</strong> - Permite a un visitante darse de alta en el sistema. Pueden haber grupos abiertos a los que el usuario pueda unirse y en este caso el correo electrónico debe de ser verificado. Esto se hace de forma automática mandando al usuario un mensaje de verificación. El administrador del sistema puede deshabilitar el alta de nuevos usuarios.
_P;

$help['220'] = <<<_P
<p><strong>Preferencias</strong> - El primer comando que un administrador verá cuando instale SiteBar
y después de crear la base de datos. Será creada una cuenta de administrador y establecidos
los parámetros básicos de SiteBar. Cuando "Modo Personal" es seleccionado entonces sólo estarán
disponibles un subconjunto de funciones.
<p><strong>Preferencias de SiteBar</strong> Los administradores pueden cambiar más tarde los partámetros de SiteBar.
Los administradores son miembros del grupo de administradores siendo el primer administrador el usurio creado usando el comando Setup(preferencias) y puden crear un usuario usando el comando "Preferencias"
Ver "Darse de Alta" para la explicación de las características de email.
Hay más características basadas en el correo electrónico pendientes de
implementar en futuras ediciones.

<p><strong>Crear Árbol</strong> - Dependiendo de los parámetros de SiteBar sólo los administradores o usuarios con correo verificado pueden crear nuevos árboles.
Cuando un nuevo árbo es creado debe de ser asociado a un usuario existente (sólamente los adminitradores pueden crear árboles para alguien más).
La manera standar de crear favoritos para compartirlos en equipo es crear un nuevo árbol y asignarlo al usuario que modera el grupo,
creado con la opción "Crear Grupo". Este usuario puede tener privilegios asignados en el nuevo
árbol creado para el grupo y añadir miembros al grupo.
_P;

$help['230'] = <<<_P
<p><strong>Preferencias de Usuario</strong> - Cambia las preferencias de usuario. Cuando "Comandante Externo"
no está seleccionado, la ventana de comandante se abrirá en lugar de la de SiteBar y no en una ventana externa.
Algunos comandos siempre abren en su sitio ("Entrar", "Salir", "Darse de alta", "Parámetros de Usuario"). Cuando
"Saltar ejecución de Mensajes está seleccionado" no se muestra pantalla de confirmación de los comandos en ejecución.
"Decorar Carpetas ACL" marcará aquellas carpetas que tienen especificaciones de seguridad. Esto reduce la velocidad de SiteBar.

<p><strong>Membresía</strong> - Los usuarios pueden dejar cualquier grupo y unirse a los grupos abiertos. Los usuarios
no pueden dejar grupos si el grupo pierde su último moderador. En este caso se debe contactar al administrador para que borre el grupo.

<p><strong>Verificar email</strong> - Permite al usuario verificar su dirección email para usar otras funciones del sistema.
_P;

$help['240'] = <<<_P
<p><strong>Mantenimiento de Usuarios</strong> - Muestra una lista desplegable con los usuarios y permite
que se puedan ejecutar los siguientes comandos.

<p><strong>Modificar Usuario</strong> - Es la única manera por el momento de recuperar una clave olvidada y establecer
una clave temporal, mandarla por correo al usuario y pedirle que la cambie. Los administradores pueden marcar una
cuenta como demo, lo que imposibilita al usuario cambiar algunas propiedades, especialmente claves. <p><strong>Borrar Usuario</strong> - Borra al usuario y todas sus membresías (pertenencias a grupos). Reasigna árboles existentes a otro usuario. No está permitido borrar a un usuario que es el único moderador de un grupo. <p><strong>Crear usuario</strong> - Lo mismo que "Darse de Alta" pero desde aquí lo hace el administrador. Los emails de los usuarios que crea el administrador son tratatos como verificados.

_P;

$help['250'] = <<<_P
<p><strong>Mantenimiento de Grupos</strong> - Muestra una lista desplegable con grupos y permite
que los siguientes comandos sean ejecutados.

<p><strong>Propiedades del Grupo</strong> - Accesible a moderadores del grupo.
Permite cambiar el nombre del grpo, comentarios y la opción Auto Unirse E-Mail RegExp. Cuando la
opción Auto Unirse E-Mail RegExp está completada y concuerda con el correo electrónico de un nuevo
usuario que se ha dado de alta, al usuario se le pide que verifique su email y una vez verificado pasa
a ser de forma automática miembro del grupo. Cuando "Permitir Auto Añadir" está seleccionado, el correo electrónico
no necesita ser verificado para unirse.

<p><strong>Miembros del Grupo</strong> - Solamente los moderadores pueden seleccionar que usuarios son miembros. Otro
moderador no puede ser quitado, el rol de moderador debe ser primero quitado con el siguiente comando.

<p><strong>Grupo Moderadores<</strong> - Accesible a los moderadores del grupo.
Debe de haber siempre al menos un moderador.

<p><strong>Borrar Grupo</strong> - Accesible sólo a los administradores, borra un grupo y
todas sus membersías.

<p><strong>Crear Grupo</strong> - Accesible sólamente a administradores, crea un grupo y especifica el primer moderador
del mismo
_P;

$help['260'] = <<<_P
<@>
<p><strong>Añadir Carpeta</strong> - Añade una nueva subcarpeta a la carpeta.

<p><strong>Añadir enlace</strong> - Añade un enlace a la carpeta. Cuando se ejecuta desde el
bookmarklet permite al usuario seleccionar la carpeta destino, de otra manera es creada en la
carpeta desde la que se ha ejecutado el comando.<p>

<p><strong>Propiedades de carpeta</strong> - Especifica las propiedades de carpeta- nombre y descripción.
<p><strong>Borrar carpeta</strong> - Borra la carpeta. Las carpetas borradas no
pueden ser recuperadas usando el comando "deshacer" o añadiendo carpetas con el mismo nombre,
el usuario puede borrar incluso su propia carpeta raíz, sin embargo esta supresión sólo es válida
una vez que se ha ejecutado el comando purgar para esa carpeta.


<p><strong>Pulgar Carpeta</strong> - Purga una carpeta borrada previamente o enlaces que están
dentro de la carpeta seleccionada. No es posible para nadie restaurar algo que ha sido borrado.

<p><strong>Restaurar</strong> - Recupera carpetas o enlaces previamente borrados,
al menos que hayan sido purgados. Cuando se borra una carpeta raíz se muestra normalmente con un icono gris
y solamente es visible al propietario del árbol. Esto quita los permisos a los miembros de otros grupos
lo que supone otro nivel de seguridad que impidirá la pérdida de favoritos.
<p>

<p><strong>Copiar</strong> - Copia la carpeta y todo su contenido al portapapeles interno.
<p><strong>Pegar</strong> - Disponible solamente cuando el comando "Copiar" o "Copiar Enlace" ha sido ejecutado.
El comando "Pegar" determina si el usuario puede mover los contenidos o sólamente copiarlos y seleccionar los valores
por defecto. Si embargo el usuario puede todavía seleccionar copiar o mover.

<p>

<p><strong>Importar Favoritos</strong> - Importa los favoritos desde un archivo externo a la carpeta.
No se ejecutan validaciones de links con el fini de evitar intervalos de pausa en el servidor.

<p><strong>Exportar Favoritos</strong> - Exporta los contenidos de la carpeta a un archivo externo de favoritos.
Son soportados los favoritos en los formatos Netscape y Opera. Mozilla usa el formato de Nestcape e Internet Explorer
puede importar y exportar desde ese formato.

<p><strong>Seguridad</strong> - Disponible solamente para la carpeta raíz. Permite especificar
los permisos a un árbor. Ver la sección "Administración de Seguridad" para obtener más información.
_P;

$help['270'] = <<<_P
<p><strong>Enviar Enlace por Email</strong> - Permite que un enlace sea enviado por email a otra persona.
Para los usuarios con email verificado, los usuarios con email verificado pueden usar el sistema interno de correo electrónico de SiteBar, de lo contrario deben de utilizar un programa de correo electrónico externo.

<p><strong>Copiar Enlace</strong> - Copia el enlace al portapapeles. Usar el comando "Pegar" sobre la carpeta que queramos copiar o mover el enlace.

<p><strong>Borrar Enlace</strong> - Borra el Enlace. Un enlace borrado puede ser recuperado con el comando "Restaurar" ejecutado en la carpeta raíz.

<p><strong>Propiedades</strong> - Edita las propiedades de un enlace. Permite establecer un enlace como privado.

_P;

$help['300'] = <<<_P
Sitebar 3 has sido completamente reescrito desde la versión 2.x, representando la mayor evolución de SiteBar.
<p>
SiteBar 3 ya no usa JavaScript para mostrar los árboles de enlaces.
Sin embargo se usa JavaScript para mostrar los menús contextuales y para expandir/comprimir enlaces incluyendo los
cambios en los iconos.
<a href="http://www.w3.org/TR/DOM-Level-2-Core/">DOM Nivel 2</a>
debe ser soportado por el navegador. La ventaja de esto se traduce en una carga muy rápida e incremental de los enlaces.
La contrapartida es que los navegadores antinguos sólo pueden ver el árbol de los favoritos expandido y sólo tienen
acceso de lectura (lo que es una mejora respecto a la versión 2.x que no podía mostrar nada en los navegadores antiguos)
<p>
Por el lado del servidor los datos están almacenados de la manera más simple y  y estructura de datos recursiva y
está optimizada para las modificaciones en el árbol. Esto da un buen rendimiento a la hora de seleccionar.
Gracias a la forma en que están indexadas las tablas en la base de datos navegar por los favoritos no debe ser un proceso
lento incluso con un número elevado de enlaces.


_P;

$help['301'] = <<<_P
SiteBar ha sido probado con los siguientes navegadores

<ul>
    <li>Mozilla 1.4, 1.5a
    <li>Mozilla Firebird 0.61, 0.7
    <li>Galeon 1.3.7
    <li>Internet Explorer 6.0
    <li>Opera 7.11, 7.21
</ul>

Los siguientes navegadores permiten el acceso en modo sólo lectura:

<ul>
    <li>Pocket Internet Explorer 2002
    <li>Netscape Navigator 4.78
</ul>
_P;

$help['302'] = <<<_P
SiteBar 3 dobla la seguridad en el tema de permisos de usuarios. Al usuario
se le muestran sólo los comandos que le corresponden de acuerdo con sus permisos y cada
comando es verificado dos veces antes de su ejecución.
<p>
El sistema tiene tres roles básicos, usuarios, moderadores y administradores. Los moderadores son
los usuarios que han sido marcados como moderadores de un grupo en su creación o por otro moderador.
El rol de moderador está unido a un determinado grupo solamente. Los administradores son miembros del grupo de
Administradores más el primer usuario creado con el comando "Establecer" (El usuario que instaló SiteBar en el Servidor)
Los administradores no tienen permisos para actuar como moderadores. Pero, sin  embargo pueden borrar grupos completos.
<p>
SiteBar 3 has sido creado para satisfacer las necesidades del trabajo en equipo. Eso quiere decir que un grupo de usuarios
pueden compartir los enlaces. Para mantener los enlaces del grupo pivados ha sido desarrollado un mecanismo de control.
<p>
La piedra angular de este mecanismo es que el propietario de una carpeta raíz de cualquier árbol tiene permisos ilimitados
para completar el árbol. Con los usuarios creados a través de "Darse de alta" o creados por el administrador se crea una
carpeta raíz con el nombre de cada usuario. Además los administradores pueden crear árboles adicionales para cualquiera de
los usuarios o permitir a otros usuarios que creen sus propios árboles.
<p>
Cuando se crea un árbol el usuario que lo ha creado puede determinar los permisos para ese árbol a otro grupo de usuarios.
Los siguientes permisos son son accesibles para cualquier grupo de usuarios:
<p><strong>Leer</strong> - Los usuarios de un grupo puede usar los favoritos.
<p><strong>Añadir</strong> - El usuario puede añadir carpetas y enlaces.

<p><strong>Modificar</strong> - Pueden definir las propiedades de los enlaces y carpetas.

<p><strong>Borrar</strong> - Borrar enlaces o carpetas.

<p><strong>Purgar</strong> - Purga una carpeta o enlace previamente borrado, junto con 'borrar' permite que una carpeta
pueda ser movida de un árbo a otro.

<p><strong>Conceder</strong> - Los miembros de un grupo tienen los mismos permisos sobre el árbol que su propietario.
<p> Se heredan siempre los permisos de la carpeta padre. La carpeta raíz (la que lleva el nombre de cada usuario) de
forma predeterminada no concede permisos a ningún grupo.
Un usuario puede especificar un acceso más restricivo sobre una carpeta, que influye en todas las carpetas que dependan
de ellla. Si los permisos sobre una carpeta son los mismo que sobre la padre, la especificación de permisos para esa carpeta
se pierde y hereda los de la carpeta padre.
<p> Los moderadores de los grupos tienen siempre los permisos de quitar cualquier derecho sobre cualquier grupo de usuarios.
<p> Además de los mecanismos de seguridad de las carpetas hay siempre una solución para los enlaces, que permite mantener
ciertos enlaces como privados en carpetas compartidas. El propietario de un árbol puede marcar cualquier enlace como privado
lo que impide que este enlace sea visto por el resto de los usuarios. Sin embargo no se hace necesario marcar los enlaces
como privados sino se comparte ninguna carpeta (y de forma predeterminada no se comparte ninguna).
<p> Cuantos más controles pongamos a una carpeta más tiempo tardarán en cargar los enlaces para todos los usuarios.
Por lo que no debemos de abusar de estas especificaciones en árboles anidados.
<p> Cuando un administrador de SiteBar selecciona "Modo Personal" el comando de seguridad no está disponible. En este modo
no es posible restringir los permisos de una carpeta hija cuando la padre ya ha sido publicada. Es posible conmutar entre
el modo personal y el modo por defecto "enterprise", sin embargo no es posible en el modo personal quitar los permisos
concedidos en el modo enterprise a cualquiera de los grupos menos a grupo Todos.
_P;

$help['303'] = <<<_P
<@>SiteBar permite que el usuario pueda crear temas o skins. Para ello es necesario un
buen conocimiento de las hojas de estilos. A la hora de crear nuevos temas o skins ha
siempre que partir de otra que sirva de base. Esto significa que cualquiera de los temas
del directorio "skins" puede servir como base para generar uno nuevo haciendo una copia del mismo.
Los gráficos de cada tema están en formato PNG y la hoja de estilos se denomina "sitebar.css" Otro archivo
que podemos modificar es "hook.php" En este archivo es posible cambiar la cabecera o pie de la instalación de SiteBar.

<p>
Algunos administradores pueden crear sus propios temas para que esten en consonacia con el diseño de su Web.
En este caso es recomendado quitar el resto de los temas y elegir el tema predeterminado en las preferencias de SiteBar.
Si algún usuario quiere incluir su tema en la distribución oficial de SiteBar debe de contactar con el equipo de desarrollo
y probar su tema con la última versión estable de SiteBar. Como norma el logo de SiteBar y SourceForge deben de estar en la
página, sin embargo el logo de SiteBar puede ser libremente actualizado.
_P;

?>
