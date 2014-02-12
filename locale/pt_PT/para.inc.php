<?php

$para['command::contact'] = <<<_P
Mensagem:

%s


--
SiteBar instalado em %s.
_P;

$para['command::contact_group'] = <<<_P
Grupo: %s
Mensagem:

%s


--
SiteBar instalado em %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>Quer realmente apagar esta conta?</h3>
Não haverá nenhuma de voltar atrás na mudança!<p>
Todas as suas restantes árvores serão dadas ao administrador do sistema.
_P;

$para['command::email_link_href'] = <<<_P
<@><p>Enviar e-mail através do seu
<a href='mailto:?subject=Website: %s&amp;body=Eu encontrei um site que tu poderás estar interessado.
 Dá um vista de olhos em: %s
 --
 Enviado através do SiteBar em %s
 Servidor Bookmark Open Source http://sitebar.org
'>cliente de e-mail predefinido</a>
_P;

$para['command::email_link'] = <<<_P
Eu encontrei um site que tu poderás estar interessado.
Dá um vista de olhos em:

    "%s" %s

%s

--
Enviado através do SiteBar em %s
Servidor Bookmark Open Source http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
<@>Voçê requereu a validação de e-mail que permite juntar-se automáticamente a grupos
com expressões regulares e permite-lhe usar as características de e-mail do SiteBar.

Por favor, clique no link seguinte para verificar o seu e-mail:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer pode importar/exportar bookmarks no formato Netscape Bookmark.
Entretanto, tem de ser na codificação nativa do Windows, a predefinida UTF-8 não funcionará.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
A conversão do código da página não está instalado neste servidor do SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Direitos:
<strong>L</strong>eitura,
<strong>A</strong>dicionar,
<strong>M</strong>odificar,
Apa<strong>g</strong>ar
_P;

$para['command::purge_cache'] = <<<_P
<h3>Quer realmente remover todos os ícones de favoritos da cache?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
O seu endereço de e-mail está para auto juntar para o(s) seguinte(s) grupo(s) fechado(s):
    %s.

Para aprovar a sua sociedade, o seu endereço de e-mail tem de ser verificado. Por favor, clique no link seguinte para o verificar:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
<@>Utilizador "%s" <%s> registou-se na sua instalação do SiteBar em %s.
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
Raizes {roots_total}.
Pastas {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Utilizadores {users}.
Grupos {groups}.
SQL pedidos {queries}.
BD/Tempo total {time_db}/{time_total} seg ({time_pct}%).


_P;

?>
