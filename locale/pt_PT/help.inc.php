<?php

$help = array();

$help['100'] = <<<_P
As funções do SiteBar estão acessíveis no <strong>Menu de Utilizador</strong> e pelos <strong>Menus de Contexto</strong>.
O Menu de Utilizador está no fundo do SiteBar, e o menus de contexto estão acessíveis clicando no botão direito sobre as
 pastas e links. Os utilizadores do Opera e Apple podem usar Ctrl-clique. No caso de Ctrl-clique não ser reconhecido, é possivel
definir para trocar o comando "Mostrar Ícone no Menu" nas "Definições do Utilizador". Quando esta opção está escolhida, será
 mostrado um pequeno ícone no menu ao lado do ícone da pasta ou link. Clicando neste ícone abrirá o menu de contexto.
<p>
Ambos os menus de contexto e utilizador podem ser mostrados um subconjunto diferente de comandos para diferentes utilizadores
baseados nos seus direitos no sistema. Alguns itens podem estar desactivados no menu de contexto baseado nos direitos de utilizador
paa nós e para o estado actual do sistema. Os comandos são executados via Janela de Comando.
_P;

$help['101'] = <<<_P
Clique numa pasta ou link com o rato e mova o cursor para cima de outra pasta enquanto pressiona o botão.
O arrastar é sinalizado pelo destaque da pasta alvo. Deixar o botão do rato para largar o link ou pasta
arrastada para a pasta actualmente destacada.
<p>
Arrastar & Largar não está implementado pela equipa SiteBar para browsers Opera. Copiar e Colar devem ser usados.

_P;

$help['102'] = <<<_P
A forma mais conveniente de adicionar links é usar o bookmarklet. Pode criar o bookmarklet
apartir da página pessoal da sua instalação do SiteBar, que deverá estar disponível clicando no logótipo do SiteBar. Os utilizadores do Internet Explorer podem usar o menu de contexto se usarem a instalação descrita na mesma página do bookmarklet.
_P;

$help['103'] = <<<_P
<@><p><strong>Procurar</strong> - Permite procurar em todos os links mostrados. É possivel especificar o que deverá ser procurado usando os prefixos
<strong>url:</strong>, <strong>name:</strong>, <strong>desc:</strong>,
<strong>all:</strong>. O prefixo predefinido é o <strong>name:</strong>.  e pode ser mudado
 nas "Definições de Utilizador". Quando um link ou pasta é encontrado, este é destacado e uma
janela de confirmação é mostrada com alguns detalhes. O utilizador tem a possibilidade de continuar
com a procura ou pará-la.

<p><strong>Destaque</strong> - O mesmo que a procura mas sem a janela de confirmação com alguns detalhes.

<p><strong>Unir/Expandir Todos</strong> - Une todos os nós. Quando clicado pela segunda vez (quando todos os nós estão unidos) então expande todos os nós.

<p><strong>Actualizar</strong> - Actualiza todos os links do servidor. Esta função está aqui porque o plugin está alojado no barra lateral onde o utilizador talvez não tenha (depende do browser) possibilidade de actualizá-lo.
_P;

$help['200'] = <<<_P
Os comandos estão agrupados em vários grupos lógicos.
Por favor, seleccione um dos grupos para ver a ajuda do comando.
_P;

$help['210'] = <<<_P
<@><p><strong>Entrar</strong> - O utilizador entra no sistema. Será sempre lembrado usando coockies. O utilizador pode especificar quando é que o coockie deverá expirar.

<p><strong>Sair</strong> - O utilizador sai do sistema. Este deve ser sempre utilizado em terminais públicos. O equivalente é usar o Entrar com a duração da sessão e fechar todas as janelas do browser.

<p><strong>Registo</strong> - Permite ao visitante, registar-se no sistema. É baseado no endereço de e-mail para o utilizador se poder juntar a alguns grupos. Neste caso o e-mail terá de ser verificado. Isso é feito automaticamente enviando um e-mail de verificação ao utilizador. O Administrador do sistema pode desactivar o registo a novos utilizadores.

_P;

$help['220'] = <<<_P
<p><strong>Configuração</strong> - Será o primeiro comando que um administrador verá quando instalar o SiteBar e depois de definir a base de dados. Uma conta de administrador será criada e o parâmetros básicos do SiteBar serão configurados. Quando a opção "Modo Pessoal" é seleccionada então só um subconjunto de funções estará disponível.

<p><strong>SiteBar - Definições</strong> - Os administradores do SiteBar, podem mais tarde mudar os parâmetros. Os administradores são membros do grupo Administradores e o utilizador criado usará o comando "Configurações". Veja a ajuda para "Registo" para explicações das características de e-mail. Há mais características de e-mail planeadas para futuras versões.

<p><strong>Criar Árvore</strong> - Dependendo das definições do SiteBar, só os administradores e/ou os utilizadores com o e-mail verificado podem criar novas árvores. Quando uma nova árvore é criada terá de ser associada com um utilizador existente (só os administradores podem criar árvores para alguém). A forma padrão de criar equipas de bookmarks é criar uma nova árvore e atribui-la ao utilizador que modera o grupo, criado separadamente usando "Criar Grupo". Este utilizador pode conceder direitos na nova árvore criada aos membros do grupo e pode adicionar membros ao grupo.
_P;

$help['230'] = <<<_P
<p><strong>Definições do Utilizador</strong> - Muda as definições do utilizador. Quando o "Comando Externo"
 não está escolhido, a janela de Comando irá abrir no lugar do SiteBar em vez de abrir numa janela externa.
Alguns comandos abrem em cima do SiteBar ("Entrar", "Sair",  "Registo",
"Definições do Utilizador"). Quando "Excluir Mensagens de Execução" está escolhido, nenhuma mensagem
de confirmação é mostrada ao executar um comando bem sucedido. "Decorar Pastas ACL" irá marcar as pastas que tiverem
especificação de segurança. Esta troca torna o SiteBar mais lento.

<p><strong>Verificar E-mail</strong> - Permite ao utilizador verificar o seu endereço de e-mail para usar outras funções do sistema.

<p><strong>Sociedade</strong> - Os utilizadores podem deixar qualquer grupo e juntar-se a grupos abertos. Os utilizadores não podem deixar os grupos se o grupo depois perder o último moderador. Neste caso o administrador deverá ser contactado para apagar o grupo.
_P;

$help['240'] = <<<_P
<p><strong>Manter Utilizadores</strong> - Mostra a lista com os utilizadores e permite executar os seguintes comandos:

<p><strong>Modificar Utilizador</strong> - Actualmente a única forma de recuperar uma senha esquecida é definir
uma senha temporária, enviá-la por e-mail ao utilizador e perguntar se quer alterá-la. O administrador pode marcar
a conta como demo(demonstração), que não permitirá ao utilizador modificar algumas propriedades, especialmente a senha.

<p><strong>Apagar Utilizador</strong> - Apaga o utilizador e todas as sociedades.
Atribui árvores existentes a outro utilizador. Não é permitido apagar um utilizador que é o único moderador de qualquer grupo.

<p><strong>Criar Utilizador</strong> - O mesmo que "Registo" mas destina-se ao administrador. Os e-mails dos utilizadores criados são tratados como verificados.

_P;

$help['250'] = <<<_P
<p><strong>Manter Grupos</strong> - Mostra a lista de grupos e permite executar os seguintes comandos:

<p><strong>Propriedades do Grupo</strong> - Acessível a moderadores do grupo.
Permite mudar o comentário do nome do grupo e juntar-se automaticamente
à expressão regular de e-mail. Quando a expressão de registo para se juntar automaticamente
é preenchida e é igual ao endereço de e-mail no registo de um novo utilizador, é sugerido ao utilizador
para verificar o e-mail e depois da verificação ele torna-se automaticamente membro de grupo.
Quando "Permitir Adicionar-se" estiver escolhido, o e-mail não precisa de ser verificado para se juntar automaticamente.

<p><strong>Membros do Grupo</strong> - Só os moderadores podem seleccionar quais os utilizadores que são membros. Outro moderador não pode ser retirado, a regra de moderador tem de ser removida primeiro usando o seguinte comando.

<p><strong>Moderadores do Grupo</strong> - Acessível a moderadores do grupo.
Terá de haver sempre pelo menos um utilizador.

<p><strong>Apagar Grupo</strong> - Só acessível a administradores, apaga grupos e todas as sociedade.

<p><strong>Criar Grupo</strong> - Só acessível a administradores, cria grupos e especifica o primeiro moderador do grupo.

_P;

$help['270'] = <<<_P
<p><strong>E-mail Link</strong> - Permite que um link seja enviado por e-mail para
outra pessoa. Para utilizadores com o e-mail verificado, o sistema interno de e-mail
pode ser usado, For users  with verified email, se não um programa externo terá de ser
iniciado.

<p><strong>Copiar Link</strong> - Copia o link para a área de transferências interna.
Use o comando "Colar" na pasta para copiar/mover o link para o nó.

<p><strong>Apagar Link</strong> - Apaga o link do nó. Um link apagado pode ser recuperado
usando o comando "Anular Apagar" na pasta pai.

<p><strong>Propriedades</strong> - Edita as propriedades de um  link. Permite definir um
 link como privado.
_P;

$help['300'] = <<<_P
O SiteBar 3 é completamente re-escrito da serie 2.x series, representando a grande evolução
do SiteBar.
<p>
O SiteBar 3 já não usa qualquer JavaScript nas árvores de bookmark.
Entretanto, o JavaScript é usado para mostrar o menu de contexto e para unir/expandir os nós
incluindo as mudanças de icones.
O <a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a>
tem de ser suportado pelo browser. A vantagem disto é a velocidade e o incremento do carregamento
dos bookmark. A desvantagem é que os browsers antigos só conseguem ver a árvore de bookmark expandida
e só tem acesso de leitura para eles (O que ainda é uma improvisação da versão
2.x que fracassou para mostrar nos browsers antigos).
<p>
No lado do servidor os dados estão armazenados com a mais simples estrutura
recursiva de dados e é optimizado para as modificações das árvores.
Isto dá uma muito boa performance para a selecção. Graças à tabela de índices da base de dados, não
deverá ficar lenta com um número muito grande de links.
_P;

$help['301'] = <<<_P
O SiteBar foi testado com os seguintes browsers

<ul>
    <li>Mozilla 1.4, 1.5a
    <li>Mozilla Firebird 0.61, 0.7
    <li>Galeon 1.3.7
    <li>Internet Explorer 6.0
    <li>Opera 7.11, 7.21
</ul>

Os seguintes browsers permitem apenas acesso de leitura:

<ul>
    <li>Pocket Internet Explorer 2002
    <li>Netscape Navigator 4.78
</ul>
_P;

?>
