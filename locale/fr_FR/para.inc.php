<?php

$para['integrator::welcome'] = <<<_P
Bienvenue sur la page d'intégration de SiteBar. Cette page vous permet d'exploiter SiteBar au maximum. Sur la <a href="http://sitebar.org/">page d'accueil de SiteBar</a> vous pourrez découvrir plus en détail toutes les fonctionnalités de SiteBar.

    'é' (e with an acute accent) gets converted to a 'c'
    'à' (a with a grave accent) gets converted to a 'a'
    'ê' (e with a circumflex accent) gets converted to a 'e'
    'ù' (u with a grave accent) gets converted to a 'u'

_P;

$para['integrator::header'] = <<<_P
SiteBar a été conçu pour respecter les standards et devrait fonctionner sur la majorité des navigateurs supportant le javascript et les cookies. La table suivante vous indique sur quels navigateurs SiteBar a été testé. X
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar utilise le clic droit pour ouvrir le menu contextuel des liens et dossiers.
Les utilisateurs d'Opera doivent activer l'option "Afficher les icônes du menu" dans les paramètres utilisateur
puis utiliser le clic gauche sur l'icône à coté des liens et dossiers pour ouvrir leur menu.
La commande Ctrl + clic gauche sur le titre d'un lien ou dossier devrait également ouvrir ce menu.
_P;

$para['integrator::hint'] = <<<_P
Cliquez sur le lien du navigateur de votre choix ci-dessus pour voir les instructions d'intégration.
Veuillez <a href="http://brablc.com/mailto?o">nous contacter</a> si vous avez pu tester d'autres
navigateurs/systèmes avec succès.
_P;

$para['integrator::hint_window'] = <<<_P
Ceci est un lien ordinaire qui ouvrira SiteBar dans la fenetre courante. SiteBar a été conçu pour une fenêtre verticale et plutôt étroite. L'ouvrir de cette manière pourrait donc faire perdre de la place.
_P;

$para['integrator::hint_dir'] = <<<_P
En plus de l'affichage sous forme de hiérarchie, SiteBar peut etre affiché sous la forme d'un répertoire traditionnel. Cette vue montre un répertoire à la fois ainsi que les détails de chaque lien affiché. Votre navigateur doit supporter <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Si votre navigateur n'offre pas le support de panneau latéral dans lequel SiteBar puisse etre intégré, vous devriez utiliser ce bookmarklet*. Il vous permettra d'ouvrir SiteBar dans une fenetre pop-up similaire à un panneau latéral. Sachez toutefois que votre navigateur pourrait bloquer les fenetres pop-up!
_P;

$para['integrator::hint_iframe'] = <<<_P
L'URL à gauche permet d'ouvrir SiteBar dans une <IFRAME>. Elle est appropriée pour l'intégrer
dans un portail. Par exemple:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a>
<li><a href="http://www.netvibes.com/">Netvibes</a>
</ul>
Visitez le portail, et trouvez un endroit où vous pouvez ajouter du contenu. Copiez à cet endroit cette URL <strong>%s</strong>
et une nouveau contenu devrait être créé (notez que le protocole https n'est habituellement pas géré par les portails,
vous pouvez cependant utiliser https dans iframe.php). Notez que votre nom d'utilisateur/mot de passe ne sont <strong>PAS</strong> communiqués au portail. Les utilisateurs de MS IE peuvent avoir besoin d'autoriser les cookies pour le domaine de leur serveur SiteBar.
_P;

$para['integrator::hint_google'] = <<<_P
Utilise également une IFRAME, mais adaptée pour l'intégration dans la page personnalisée iGoogle. Utilisez <strong>Ajouter des modules</strong> et cette URL <strong>%s</strong>.
_P;

$para['integrator::hint_addpage'] = <<<_P
Ce bookmarklet&#42; peut etre utilisé pour ajouter des liens à votre SiteBar. Lorsqu'il est lancé, une nouvelle fenetre pop-up apparaît, pré-remplie avec les détails de la page courante.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <i> Un <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> est un marque-page/favori qui contient du code JavaScript.
Vous pouvez cliquer dessus avec le bouton droit pour l'ajouter à votre barre de favoris. Plus tard lorsque vous cliquerez sur le favori, le code JavaScript sera exécuté.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Ajoute la recherche de favoris SiteBar dans le champ de recherche Web. Permet de rechercher dans les favoris SiteBar sans avoir à ouvrir une vue de SiteBar.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Extension développée spécialement pour SiteBar.
Permet entre autres d'ouvrir tous les liens d'un dossier dans les onglets du navigateur.
Utilisez le menu Affichage/Barre d'outils/Personnaliser pour placer l'icône SiteBar dans votre barre d'outil.
_P;

$para['integrator::hint_bmsync'] = <<<_P
Pour pouvoir réaliser une synchronisation bidirectionnelle avec Firefox, veuillez installer l'extension Bookmark Synchronizer.
Utilisez la commande "Paramètres utilisateur -> Paramètres XBELSync" pour obtenir plus d'informations sur la configuration de la synchronisation.
[<a href="http://sitebar.org/downloads.php">Plus de détails</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Crée un favori qui peut etre utilisé pour ouvrir SiteBar dans un panneau latéral du navigateur.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Téléchargez la structure de dossiers de tout votre SiteBar dans un fichier. Importez ce fichier dans vos favoris.
Chaque dossier est représenté par un favori dynamique. De cette manière vos favoris SiteBar seront intégrés parmis les autres,
à la différence que le contenu des dossiers sera téléchargé de manière dynamique à partir de votre SiteBar. Si
un dossier dynamique contient des sous-dossiers, son contenu sera affiché dans @Content.

_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Ajoute SiteBar dans le panneau latéral. Ce panneau peut etre affiché/caché avec F9. Si le temps chargement de
SiteBar dans le panneau dépasse une certaine durée, son affichage échoue dans Mozilla. Il est recommandé
d'afficher SiteBar dans la fenêtre principale pour permettre aux images (favicons) d'être mises dans le cache
du navigateur ou alors de désactiver l'affichage des favicons via les paramètres utilisateur.
_P;

$para['integrator::hint_sidebar_konqueror'] = <<<_P
Suivez les étapes suivantes:
<ol>
<li>Ouvrez Konqueror
<li>Sélectionnez le menu "Window -> Show Navigation Panel (F9)"
<li>Effectuez un clic droit sur la barre d'icônes la plus à gauche dans le panneau de navigation sous les icônes.
<li>Choisissez "Add New -> Web SideBar Module" - une nouvelle icône appelée "Web SiteBar Plugin" va être ajoutée.
<li>Effectuez un clic droit sur cette nouvelle icône et sélectionnez "Set Name", tapez <b>SiteBar</b> à cet endroit.
<li>Effectuez un clic droit sur cette nouvelle icône et sélectionnez "Set Url", tapez <b>%s</%s> à cet endroit.
<li>Cliquez sur l'icône pour ouvrir SiteBar dans la barre latérale.
</ol>
_P;

$para['integrator::hint_hotlist'] = <<<_P
Un lien vers SiteBar sera ajouté aux signets d'Opera. Si vous cliquez sur ce lien, SiteBar s'ouvrira dans le panneau latéral d'Opera.
_P;

$para['integrator::hint_install'] = <<<_P
Installe SiteBar dans le volet d'exploration et dans le menu contextuel - nécessite des changements
dans la base de registres Windows ainsi qu'un redémarrage pour finaliser l'installation. Selon vos droits
d'accès, vous pourriez n'avoir accès qu'à une partie des fonctionnalités.
<br>
Ouvrez le volet d'exploration SiteBar a partir du menu "Vue/Volet d'exploration" ou utilisez la fonction Personnaliser...
de la barre d'outils pour ajouter le bouton d'activation de SiteBar sur cette barre d'outils. Un clic droit sur une page
ou sur un lien permettra d'ajouter la page ou le lien à SiteBar.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Désinstalle le volet d'exploration (voir ci-dessus).
_P;

$para['integrator::hint_searchbar'] = <<<_P
L'usage de ce bookmarklet* est recommandé dans le cas ou l'utilisateur ne dispose pas de privilèges
suffisants pour installer le volet d'exploration. Il charge SiteBar temporairement dans le volet
d'exploration de votre navigateur.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Télécharge un plugin (a partir d'une URL fixe). L'archive doit etre extraite dans le répertoire "C:Program FilesMaxthonPlugin".
Après redémarrage du navigateur, une nouvelle barre d'exploration est ajoutée.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Télécharge un plugin (a partir d'une URL fixe). L'archive doit etre extraite dans le répertoire "C:Program FilesMaxthonPlugin".
Après redémarrage du navigateur, une nouvelle icône apparaît dans la barre de plugins.
Cette icône permet d'ajouter la page de l'onglet courant à SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Lancez la commande <strong>emerge sitebar</strong> pour installer le logiciel SiteBar.
_P;

$para['integrator::hint_debian'] = <<<_P
Lancez la commande <strong>apt-get install sitebar</strong> pour installer le logiciel SiteBar.
_P;

$para['integrator::hint_phplm'] = <<<_P
Le menu PHP Layers est un système de menus hiérarchiques pour générer un menu DHTML
"a la volée" en se basant sur le moteur de PHP pour traiter les données. SiteBar est capable
de fournir un flux de favoris dans la structure correcte. Si la fonction fopen est autorisée
a ouvrir des fichiers distants, le code suivant chargera les données dans le bon format:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright &copy 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> et la <a href='http://sitebar.org/team.php'>SiteBar Team</a>. <a href='http://sitebar.org/forum.php'>Forum</a> de Support et Suivi de <a href='http://sitebar.org/bugs.php'>Bugs</a>.
_P;

$para['command::welcome'] = <<<_P
%s, bienvenue dans SiteBar!
%s
<p>
Utilisez le clic droit sur un dossier ou un lien pour gérér vos favoris
<p>
Vous pouvez également activer l'option "%s" dans "%s" pour afficher des icônes de menu.
<p>
Vous etes maintenant connecté.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Ce serveur SiteBar nécessite la validation de votre
adresse email avant de pouvoir utiliser ses fonctionnalités.
<p>
Si vous avez entré votre adresse email complète, vous devriez
reçevoir un message sous peu. Merci de bien vouloir cliquer
sur le lien qui se trouve dans cet email.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Ce serveur SiteBar nécessite l'approbation par un administrateur
des demandes de nouveaux comptes utilisateurs avant de pouvoir
utiliser ses fonctionnalités.
<p>
Veuillez patienter jusqu'a ce qu'un administrateur ait vérifié la
demande - vous serez informé du status par email.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Ce serveur SiteBar nécessite la validation de votre
adresse email ainsi que l'approbation de votre demande
par un administrateur avant de pouvoir utiliser ses
fonctionnalités.
<p>
Si vous avez entré votre adresse email complète, vous devriez
reçevoir un message sous peu. Merci de bien vouloir cliquer
sur le lien qui se trouve dans cet email et patienter jusqu'a
ce qu'un administrateur ait vérifié la demande - vous serez informé
du status par email.
_P;

$para['command::account_approved'] = <<<_P
L'administrateur a approuvé votre de demande de compte.
Vous pouvez vous connecter en utilisant votre nom d'utilisateur %s.

--
Serveur SiteBar sur %s.
_P;

$para['command::account_rejected'] = <<<_P
L'administrateur a rejeté votre de demande de compte
ayant pour nom d'utilisateur %s.

--
Serveur SiteBar sur %s.
_P;

$para['command::account_deleted'] = <<<_P
L'administrateur a supprimé votre compte resté inactif
ayant pour nom d'utilisateur %s.

--
Serveur SiteBar sur %s.
_P;

$para['command::reset_password'] = <<<_P
Une demande de réinitialisation du mot de passe SiteBar a été
demandée pour l'adresse email "%s".

Si vous souhaitez réellement réinitialiser le mot de passe de
ce compte, veuillez cliquer sur le lien suivant:
    %s

--
Serveur SiteBar sur %s.
_P;

$para['command::leave_group'] = <<<_P
<p>
Lorsque vous quittez un groupe, vous aurez besoin d'une invitation pour
vous y inscrire à nouveau. Pour obtenir une invitation vous devrez contacter
un des modérateurs du groupe, et donc connaître son nom d'utilisateur SiteBar ou son adresse email.
_P;

$para['command::use_comma'] = <<<_P
Utilisez une virgule ou un retour à la ligne pour séparer les noms d'utilisateurs ou adresse emails. Les utilisateurs deviendront des membres après
avoir accepté votre invitation.
_P;

$para['command::reset_password_hint'] = <<<_P
<p>
Veuillez indiquer votre nom d'utilisateur ou votre adresse email enregistrée dans le système.
Un code unique sera envoyé a votre adresse email.
Utilisez ce code pour réinitialiser votre mot de passe.
_P;

$para['command::contact'] = <<<_P
%s


--
Serveur SiteBar sur %s
_P;

$para['command::contact_group'] = <<<_P
Groupe cible: %s

%s


--
Serveur SiteBar sur %s
_P;

$para['command::delete_account'] = <<<_P
<h3>Voulez-vous réellement supprimer votre compte?</h3>
Ceci est une opération irréversible!<p>
_P;

$para['command::email_link_href'] = <<<_P
<p>Cliquer
<a href="mailto:?subject=Site Internet: %s&body=J'ai trouvé un site internet qui pourrait t'intéresser.
 Je te suggère de visiter ce lien: %s
 --
 Envoyé par les gestionnaire de favoris SiteBar sur %s
 Vous pouvez découvrir Sitebar sur http://sitebar.org
">ici</a> pour envoyer un email via votre programme par défaut.
_P;

$para['command::email_link'] = <<<_P
J'ai trouvé un site internet qui pourrait t'intéresser.
Je te suggère de visiter ce lien:

   "%s" %s

%s

--
Envoyé via SiteBar sur %s
Serveur de favoris Open Source http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Merci d'avoir choisi la vérification de votre adresse email. Ceci vous permettra d'utiliser les fonctionnalités email de SiteBar.

Veuillez cliquer sur le lien suivant pour confirmer votre adresse de contact:

    %s
    
Veuillez ignorer ce message, si vous n'avez pas demandé la vérification d'email dans le gestionnaire de favoris SiteBar.
_P;

$para['command::verify_email_must'] = <<<_P
Vous avez effectué une demande de compte SiteBar sur un serveur
SiteBar qui requiert la vérification des adresses email avant de
pouvoir etre utilisé.

Veuillez cliquer sur le lien suivant pour vérifier votre email:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer peut importer/exporter les favoris dans le format de fichier des favoris Netscape. Cependant, ce dernier doit etre encodé dans le format natif de Windows, le format par défaut UTF-8 ne fonctionnera pas.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer peut exporter ses favoris dans le format de fichier Netscape a partir
du menu "Fichier/Importer et Exporter...". Le fichier exporté est encodé dans le
format natif de Windows. Vous devrez spécifier le bon code de page de caractères lors de l'importation
du fichier, car la valeur par défaut UTF-8 ne fonctionnera pas.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
La conversion des Codepage n'a pas été installée sur ce serveur SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Droits:
<strong>L</strong>ire,
<strong>A</strong>jouter,
<strong>M</strong>odifier,
<strong>S</strong>upprimer
_P;

$para['command::purge_cache'] = <<<_P
<h3>Voulez-vous réellement supprimer tous les favicon du cache ?</h3>
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Permet l'accès direct aux favoris ou au flux de favoris pour les utilisateurs non identifiés. Peut etre détourné si l'utilisateur sait reconstruire l'URL!
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Autoriser les utilisateurs anonymes à contacter l'administrateur.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Si ce n'est pas autorisé, les utilisateurs devront utiliser le moteur de recherche défini ici et ne pourront pas le modifier.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Autoriser les administrateurs et modérateurs du groupe auquel j'appartiens à m'envoyer des emails d'information.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Autoriser l'accès au formulaire d'inscription aux visiteurs pour qu'ils puissent s'enregistrer.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Les utilisateurs peuvent créer leurs propres groupes. Sinon seuls les administrateurs disposent de ce privilège.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Autoriser les utilisateurs à supprimer leurs hiérarchies existantes
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Autoriser les utilisateurs à créer des hiérarchies supplémentaires.
_P;

$para['command::tooltip_approved'] = <<<_P
Le compte est approuvé et peut etre utilisé.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Ne pas afficher le résultat de l'éxécution d'une commande en cas de succès.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Obtenir automatiquement la favicon lorsqu'elle est absente et que le lien vient d'etre ajouté.
_P;

$para['command::tooltip_default_groups'] = <<<_P
Liste des groupes qui seront créés pour un utilisateur n'ayant aucun groupe. Utilisez | pour séparer les noms de groupes.
_P;

$para['command::tooltip_public_groups'] = <<<_P
Liste des groupes qui seront disponibles pour les utilisateurs anonymes.
_P;

$para['command::tooltip_cmd'] = <<<_P
Ajoute les commandes principales de SiteBar, pour permettre une connexion facile à SiteBar.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Afficher les commandes d'importation/exportation des descriptions de liens.
_P;

$para['command::tooltip_comment_limit'] = <<<_P
Il est possible de préciser une longueur maximale pour le commentaire d'un lien. Il est possible de stocker de petits fichiers en tant que commentaires.
_P;

$para['command::tooltip_default_folder'] = <<<_P
La prochaine fois que vous utiliserez le bookmarklet, ce dossier sera utilisé comme valeur par défaut.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Supprimer uniquement le contenu du dossier, plutôt que le dossier lui-meme.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Supprimer l'URL de la favicon du lien si elle est invalide - utiliser avec précaution.
_P;

$para['command::tooltip_demo'] = <<<_P
Transformer ce compte en compte de démo, avec des fonctions limitées et sans pouvoir changer le mot de passe.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Essayer d'analyser la page et trouver les favicons (icônes de raccourcis) manquantes.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Le dossier racine ne sera pas inclus dans l'export si cela est possible.
_P;

$para['command::tooltip_expert_mode'] = <<<_P
Montrer les commandes avancées et afficher plus de messages de diagnostics.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Exécuter les commandes en utilisant une fenetre externe - sans rechargement nécessaire après chaque exécution de commande.
_P;

$para['command::tooltip_filter_groups'] = <<<_P
Utiliser un filtre pour les groupes plutôt qu'une liste de sélection.
_P;

$para['command::tooltip_filter_users'] = <<<_P
Utiliser un filtre pour les utilisateurs plutôt qu'une liste de sélection.
_P;

$para['command::tooltip_flat'] = <<<_P
Exporter les liens comme s'il n'appartenaient qu'à un seul dossier.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Cacher les fonctionnalités qui nécessitent un navigateur supportant XSLT.
_P;

$para['command::tooltip_hits'] = <<<_P
Tous les clics sur les liens sont dirigés vers le serveur SiteBar pour génerer des statistiques d'accès.
_P;

$para['command::tooltip_ignore_https'] = <<<_P
SiteBar ne peut pas valider les liens HTTPS. Si cette option n'est pas cochée, les liens sans adresse HTTP ne seront pas validés.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Ne pas tester les liens validés récemments - utiliser pour continuer une validation qui ne s'est pas achevée.
_P;

$para['command::tooltip_integrator_url'] = <<<_P
Par défaut, SiteBar utilise l'intégrateur de my.sitebar.org. Avec cette option il est possible d'utiliser une page locale d'intégrateur pour plus de confidentialité.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Le lien n'a pas pu etre validé. Vous souhaitez peut-être le conserver tout de meme actif.
_P;

$para['command::tooltip_is_feed'] = <<<_P
Marquer le lien comme un flux - le lien sera ouvert dans un lecteur de flux (si configuré) plutôt que directement dans le navigateur.
_P;

$para['command::tooltip_load_all_nodes'] = <<<_P
Charger tous les dossiers, ceci s'applique pour les utilisateurs avec un faible nombre de liens et qui souhaitent utiliser la fonction de filtrage.
_P;

$para['command::tooltip_popup_params'] = <<<_P
Paramètres de la fenêtre Pop-Up ouverte par SiteBar. Laissez vide pour utiliser les paramètres par défaut.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Combien de temps les favicons resteront dans le cache avant qu'elles ne soient rechargées du serveur d'origine.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
Pile FIFO. Les icônes les plus anciennes seront supprimées du système - à utiliser pour contrôler la taille du cache.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Taille maximale autorisée pour les icônes en octets.
_P;

$para['command::tooltip_max_session_time'] = <<<_P
L'administrateur peut spécifier le temps maximum pour une session. Lorsque cette limite de temps est dépassée, l'utilisateur doit se reconnecter.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Certains navigateurs ne supportent pas le clic droit. Une icône sera disponible pour ouvrir le menu contextuel.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Les dossiers précèdent les liens dans la hiérarchie SiteBar, ou vice versa.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Ne pas tenter de valider ce lien - utiliser pour des liens vers un intranet ou posant des problèmes de validation.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Appliquer l'opération au contenu du dossier, et non pas au dossier lui-même.
_P;

$para['command::tooltip_private'] = <<<_P
Les liens privés ne sont jamais affichés aux autres utilisateurs, memes s'ils font partie d'un dossier partagé.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Les liens privés ne seront chargés que si SiteBar est utilisé sur une connexion SSL.
_P;

$para['command::tooltip_rename'] = <<<_P
Lors d'une importation, renommer les doublons pour permettre de tout charger.
_P;

$para['command::tooltip_respect'] = <<<_P
Envoyer des emails uniquement si l'utilisateur l'a autorisé.
_P;

$para['command::tooltip_search_engine_ico'] = <<<_P
Icône qui doit s'afficher dans la barre d'outils de SiteBar et qui renvoie vers la recherche web.
_P;

$para['command::tooltip_search_engine_url'] = <<<_P
URL du moteur de recherche a utiliser. Utilisez %SEARCH% a l'endroit ou doit se situer la chaîne à chercher.
_P;

$para['command::tooltip_sender_email'] = <<<_P
Les emails générés par SiteBar seront émis à partir de cette adresse.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Les dossiers ayant des droits d'accès spécifiques seront décorés et ainsi plus facilement identifiables.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Afficher le logo en haut - Désactiver l'option si la bande passante est faible, sinon le conserver pour faire connaitre SiteBar.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Afficher dans le panneau SiteBar principal certaines statistiques sur la performance et le contenu.
_P;

$para['command::tooltip_subdir'] = <<<_P
Exporter tous les liens et dossiers de manière récursive.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Valider ce dossier de manière récursive avec tous ses sous-dossiers.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Envoyer des emails uniquement aux adresses vérifiées.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Les pages générées par SiteBar peuvent etre compressées pour libérer le réseau. La compression n'est utilisée que si le navigateur le supporte.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Utiliser le moteur de conversion (en général une extension de PHP) pour convertir les pages vers un jeu de caractères - important pour importer/exporter des favoris.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Télécharger les favicons de leur serveur d'origine vers le cache de la base de données. Augmente le trafic et accélère le cache des Favicons en réduisant le nombre de serveurs connectés.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Les favicons peuvent ralentir SiteBar. Quand le cache des favicons est utilisé, leur affichage est plus rapide.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Permet de cacher des dossiers. Cette fonction est utilisée pour les dossiers publiés d'autres utilisateurs.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Dans le cas ou la version de PHP utilisée autorise les fonctions mail, les fonctionnalités email peuvent etre activées.
_P;

$para['command::tooltip_use_new_window'] = <<<_P
Ouvre tous les liens dans une nouvelle fenêtre en utilisant la cible _blank.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Certaines fonctionnalités (cache des favicons) nécessitent l'accès à des adresses distantes depuis votre serveur.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Permettre aux recherches d'etre étendues par les résultats fournis par votre moteur de recherche Web préféré.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Les résultats de la recherche Web seront inclus dans la page de résultats de recherche SiteBar en utilisant un cadre inline.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Générer les astuces via SiteBar plutôt que via le navigateur. Cela permet des astuces plus longues et un support de davantage de navigateurs.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Permet de marquer les dossiers et liens supprimés pour qu'ils puissent etre restaurés ou purgés ultérieurement.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Les utilisateurs doivent être approuvés par un administrateur avant de pouvoir utiliser SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Les utilisateurs doivent vérifier leur adresse email avant de pouvoir utiliser SiteBar.
_P;

$para['command::tooltip_verified'] = <<<_P
Cocher cette case pour marquer l'adresse email comme vérifiée.
_P;

$para['command::tooltip_version_check_interval'] = <<<_P
SiteBar peut vérifier de manière régulière si une nouvelle version est disponible. Ceci peut etre très important dans le cas où une vulnérabilité de la version actuelle serait découverte. Une connexion sortante est requise.
_P;

$para['command::tooltip_web_search_user_agents'] = <<<_P
Cette expression régulière pour le User-Agent, précise lesquels doivent utiliser un moteur de rendu spécial n'utilisant pas javascript.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Ce serveur SiteBar demande une vérification de l'adresse email.
Veuillez confirmer votre adresse email, sous peine de suppression du compte utilisateur.
_P;

$para['sitebar::tutorial'] = <<<_P
L'icône ci-dessus avec votre nom d'utilisateur marque votre dossier racine. Effectuez un clic droit sur celle-ci et séléctionnez la command "%s" pour ajouter votre premier favori.
_P;

$para['sitebar::invitation'] = <<<_P
L'utilisateur <strong>%s</strong> souhaite partager des liens avec vous et vous invite à rejoindre son groupe <strong>%s</strong>.
_P;

$para['usermanager::signup_info'] = <<<_P
L'utilisateur %s s'est inscrit à votre serveur SiteBar sur %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
L'utilisateur %s s'est inscrit à votre serveur SiteBar sur %s.
L'utilisateur a déja confirmé son adresse email.
_P;

$para['usermanager::signup_approval'] = <<<_P
L'utilisateur %s s'est inscrit a votre serveur SiteBar sur %s.

Approuver le compte:
    %s

Rejeter le compte:
    %s

Voir les utilisateurs en attente:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
L'utilisateur %s s'est inscrit a votre serveur SiteBar sur %s.
L'utilisateur a déja confirmé son adresse email.

Approuver le compte:
    %s

Rejeter le compte:
    %s

Voir les utilisateurs en attente:
    %s
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['messenger::cancel'] = <<<_P
Annuler
_P;

$para['messenger::delete'] = <<<_P
Supprimer
_P;

$para['messenger::expire'] = <<<_P
Expirer
_P;

$para['messenger::read'] = <<<_P
Lus
_P;

$para['messenger::unread'] = <<<_P
Non lus
_P;

$para['messenger::save'] = <<<_P
Archiver
_P;

$para['messenger::state_unread'] = <<<_P
Non lu
_P;

$para['messenger::state_seen'] = <<<_P
Vu
_P;

$para['messenger::state_read'] = <<<_P
Lu
_P;

$para['messenger::state_saved'] = <<<_P
Archivé
_P;

$para['messenger::state_deleted'] = <<<_P
Supprimé
_P;

$para['messenger::state_expired'] = <<<_P
Expiré
_P;

$para['hook::statistics'] = <<<_P
Racines {roots_total}.
Dossiers {nodes_shown}/{nodes_total}.
Liens {links_shown}/{links_total}.
Utilisateurs {users}.
Groupes {groups}.
Requêtes SQL {queries}.
DB/Temps total {time_db}/{time_total} sec ({time_pct}%).
_P;

$para['groupname::Family'] = <<<_P
Famille
_P;

$para['groupname::Friends'] = <<<_P
Amis
_P;

$para['groupname::Public'] = <<<_P
Public
_P;

?>
