<?php

$help = array();

$help['100'] = <<<_P
Les fonctions SiteBar sont accessibles à partir du <strong>menu utilisateur</strong> et à partir des <strong>menus
contextuels</strong> du dossier ou du lien. Le menu utilisateur apparaît en bas de la SiteBar, et dans le menu contextuel
accessible en effectuant un clic droit sur un dossier ou un lien. Les utilisateurs du navigateur Opera ainsi que les
utilisateurs Mac peuvent utiliser le CTRL+Clic. Dans ce cas, quand un évenement CTRL+clic n'est pas reconnu il est
possible d'activer la fonction "Afficher les icônes du menu" à partir de la commande "Paramètres utilisateur".
Quand cette option est activée vous pourrez voir un petit menu sous forme d'icône à côté de l'icône du
dossier ou du lien. Cliquer dessus fera apparaître le menu contextuel.
<p>
Le menu utilisateur et les menus contextuels peuvent faire apparaître différentes sous-fonctions pour différents
utilisateurs basées sur leur droits d'accès sur le système. Quelques éléments peuvent être désactivés dans le menu
contextuel du fait des droits de l'utilisateur sur les éléments ainsi que suivant le status courant de l'application.
Les commandes sont executées via la fenêtre commande.
_P;

$help['101'] = <<<_P
Cliquez sur un dossier ou un lien avec la souris et déplacez le curseur sur un autre dossier tout en maintenant le
bouton enfoncé. La fonction saisir est signalée par la mise en surbrillance du dossier cible. Relachez le bouton pour
déposer le lien ou le dossier dans le dossier mis en surbrillance.
<p>
Saisir & déposer n'est pas implémenté pour les navigateurs Opera. La fonction Copier & coller doit être utilisée
en remplacement.
_P;

$help['103'] = <<<_P
<p><strong>Filtrer</strong> - Filtre les liens affichés dans votre SiteBar suivant un critère de recherche. Il est possible de préciser
la portée de la recherche en utilisant les préfixes <strong>url:</strong>, <strong>name:</strong>, <strong>desc:</strong>,
<strong>all:</strong>. Le préfixe utilisé par défaut est <strong>name:</strong> et peut être modifié dans les
"Paramètres utilisateur".

<p><strong>Rechercher</strong> - Effectue une recherche parmi les liens stockés dans SiteBar. Les résultats sont affichés dans
une nouvelle page web.

<p><strong>Recherche Web</strong> - Affiché si la fonction de recherche Web est activée et configurée.

<p><strong>Réduire/Développer tout</strong> - Réduit tous les noeuds de la hiérarchie. Quand un second clic est effectué
sur le bouton (quand tous les noeuds ont été réduits) tous les noeuds de la hiérarchie sont développés.

<p><strong>Recharger avec les dossiers cachés</strong> - Recharge tous les liens à partir du serveur, même les dossiers
qui ont été cachés avec la commande "Cacher le dossier".

<p><strong>Recharger</strong> - Recharge tous les liens à partir du serveur, cette fonction est disponible parce que
certain navigateurs ou certains plugins SiteBar n'offrent pas d'autre fonction de rechargement (par exemple lorsque
SiteBar est affiché dans le panneau latéral d'un navigateur).
_P;

$help['200'] = <<<_P
Les commandes sont regroupées en différentes catégories logiques. Veuillez sélectionner une des
catégories pour visualiser l'aide correspondant à la commande.
_P;

$help['210'] = <<<_P
<p><strong>Connexion</strong> - Connecte un utilisateur au système, l'utilisateur est alors
mémorisé via un mécanisme de Cookies. Lors de la connexion l'utilisateur a la possibilité de
préciser la durée de vie du Cookie.

<p><strong>Déconnexion</strong> - Déconnecte l'utilisateur courant. Cette fonction devrait
toujours être utilisée sur un ordinateur/terminal public. Une alternative est d'indiquer à
SiteBar de ne "se souvenir de moi" que pour cette session, puis de fermer toutes les fenêtres
du navigateur pour quitter.

<p><strong>Inscription</strong> - Permet à un visiteur de s'inscrire dans le système. Selon
son adresse email, un utilisateur peut éventuellement prétendre à l'adhésion à certains groupes.
Dans ce cas l'adresse email doit être vérifiée. Ceci est effectué de manière automatique par
l'envoi d'un email de confirmation à l'utilisateur. Les administrateurs du système peuvent
désactiver la possibilité d'inscription de nouveaux utilisateurs. De plus les administrateurs peuvent
obliger les utilisateurs à devoir valider leur adresse email avant de pouvoir utiliser SiteBar, et ils
peuvent également configurer une vérification manuelle de chaque nouveau compte.
_P;

$help['220'] = <<<_P
<p><strong>Configurer</strong> - La première commande qu'un administrateur verra lorsque SiteBar a été installé et après
que la base de données ait été configurée. Un compte administrateur va être créé et des paramètres de base vont être
utilisés pour la SiteBar. Quand le "Mode personnel" est activé, il n'y a qu'un sous-ensemble des fonctionnalités qui
seront disponibles aux utilisateurs.

<p><strong>Paramètres de SiteBar</strong> - Les administrateurs peuvent changer les paramètres de SiteBar à n'importe
quel moment. Les administrateurs sont constitués des membres du groupe "Administrateurs" ainsi que de l'utilisateur qui a été
créé à partir de la commande "Configurer". Se référer à "Inscription" pour plus de détails sur les fonctionnalités
utilisant les emails. Un nombre encore plus important de fonctionnalités utilisant les emails est prévu pour les version
futures de SiteBar.

<p><strong>Créer une hiérarchie</strong> - Suivant les paramètres de SiteBar, uniquement les administrateurs et/ou les utilisateurs
ayant confirmé leur adresse email peuvent créer de nouvelles hiérarchies. Quand une nouvelle hiérarchie est créée, elle doit
être associée avec un utilisateur existant (seuls les administrateurs peuvent créer une hiérarchie pour un autre utilisateur).
La manière standard de créer des favoris d'équipe est de créer une nouvelle hiérarchie et l'associer à l'utilisateur qui
sera désigné modérateur du groupe, créé séparément à l'aide de la commande "Créer groupe". Cet utilisateur pourra alors
donner les droits nécessaires sur la nouvelle hiérarchie aux membres du groupe ainsi qu'ajouter des membres au groupe.

_P;

$help['230'] = <<<_P
<p><strong>Paramètres utilisateur</strong> - Permet de changer les paramètres de l'utilisateur
courant. Quand la fonction "Commmandes externes" n'est pas activée, la fenêtre de commandes s'ouvre
à l'emplacement de la SiteBar plutôt que dans une fenêtre externe. Certaines commandes s'ouvrent
dans tous les cas à l'emplacement de la SiteBar (il s'agit de "Connexion", "Déconnexion",
"Inscription", et "Paramètres utilisateurs"). Quand la fonction "Pas de messages d'exécution" est
activée, aucun écran de confirmation n'apparaît après une exécution réussie d'une commande. La
fonction "Décorer les dossiers sécurisés" active la mise en couleur des dossiers qui ont des propriétés
de sécurité associées. Il est à noter que cette fonctionnalité ralentit l'affichage de SiteBar.

<p><strong>Adhésion</strong> - Les utilisateurs peuvent quitter des groupes et adhérer à des groupes
ouverts. Les utilisateurs ne peuvent pas quitter un groupe s'ils sont le dernier modérateur du
groupe. Dans ce cas, l'administrateur du serveur devrait être contacté pour supprimer totalement
de groupe.

<p><strong>Vérifier l'email</strong> - Permet à l'utilisateur de confirmer son adresse email afin
de lui donner accès à d'autres fonctionnalités du système.
_P;

$help['240'] = <<<_P
<p><strong>Maintenir les utilisateurs</strong> - Présente une fenêtre contenant la liste des utilisateurs
et permet d'appliquer les commandes décrites ci-dessous.

<p><strong>Modifier un utilisateur</strong> - Pour l'instant, le seul moyen de régler un problème de mot de passe oublié
est d'assigner un mot de passe temporaire à l'utilisateur, puis de lui envoyer un email en lui demandant de bien
vouloir le modifier. Les administrateurs peuvent désigner un compte comme compte de démonstration, ce
qui a pour effet d'interdire à l'utilisateur de modifier certaines propriétés, et tout particulièrement le mot de passe.

<p><strong>Supprimer un utilisateur</strong> - Supprime l'utilisateur et toutes ses adhésions à des groupes. Les hiérarchies
encore existantes sont réaffectées à un autre utilisateur. Il n'est pas possible de supprimer un utilisateur lorsqu'il s'agit
du seul modérateur d'un groupe.

<p><strong>Créer un utilisateur</strong> - Identique à "Inscription" mais cette option est destinée à l'administrateur.
Elle est particulièrement utile lorsque le mode "Autoriser les inscriptions" n'est pas activé. Les emails associées aux
utilisateurs créés de cette manière sont considérées vérifiées.

_P;

$help['250'] = <<<_P
<p><strong>Maintenir les groupes</strong> - Affiche une liste de sélection de groupes et permet d'exécuter les commandes
décrites ci-dessous.

<p><strong>Propriétés du groupe</strong> - Cette commande est accessible aux modérateurs du groupe. Elle permet de
modifier le nom du groupe, ses commentaires, ainsi que la la règle d'adhésion automatique selon l'adresse email. Lorsque
la règle d'adhésion automatique est renseignée et que l'expression régulère correspond à l'adresse email d'un
nouvel utilisateur lors de son inscription, le système demandera à l'utilisateur de confirmer son adresse email. Quand
l'adresse aura été confirmée, l'utilisateur sera automatiquement promu membre du groupe concerné. Si l'option
"Autoriser l'ajout automatique" est sélectionnée, l'adresse email n'a pas besoin d'être confirmée pour l'adhésion
automatique au groupe.

<p><strong>Membres du groupe</strong> - Seuls les modérateurs peuvent sélectionner quels utilisateurs doivent être
membres du groupe. Il n'est pas possible à un modérateur de supprimer un autre modérateur, il faut passer par la commande
décrite ci-dessous pour pouvoir effectuer cette action.

<p><strong>Modérateurs du groupe</strong> - Cette commande est accessible aux modérateurs du groupe. Il doit toujours
rester au moins un modérateur pour chaque groupe.

<p><strong>Supprimer un groupe</strong> - Cette commande est accessible aux administrateurs uniquement. Elle permet de
supprimer totalement un groupe et toutes les adhésions associées.

<p><strong>Créer un groupe</strong> - Cette commande est accessible aux administrateurs uniquement. Elle permet de créer
un groupe et de préciser le nom d'utilisateur désigné comme premier modérateur d'un groupe.
_P;

$help['260'] = <<<_P
<p><strong>Ajouter un dossier</strong> - Ajoute un nouveau sous-dossier au dossier sélectionné.

<p><strong>Ajouter un lien</strong> - Ajoute un lien au dossier. Lorsque cette commande est exécutée à
partir du bookmarklet, elle propose à l'utilisateur de choisir le dossier de destination. Dans les autres cas, elle
crée le lien dans le dossier à partir duquel la commande a été appelée.

<p><strong>Parcourir le dossier</strong> - Ouvre la navigation dans le mode visualisation dossier. Un seul dossier est
affiché à la fois avec le détail des liens qu'il contient.

<p><strong>Afficher tous les liens</strong> - Affiche tous les liens de tous les sous-dossiers sur une seule page.

<p><strong>Voir les nouveautés</strong> - Affiche les dernières nouveautés du dossier et de ses sous-dossiers, telles que les nouveaux liens ou les liens modifiés récemment.

<p>

<p><strong>Cacher le dossier</strong> - Rend le dossier invisible. Cette commande est utilisée pour cacher des dossiers
publiés d'autres utilisateurs ou rarement utilisés. Un clic sur l'icône "Recharger avec les dossiers cachés" rendra ces
dossiers visibles temporairement. La commande "Montrer les dossiers" du menu contextuel d'un dossier peut être utilisée pour rendre visible tous les sous-dossiers cachés de manière permanente. Les hiérarchies cachées peuvent être rendues visibles à nouveau en choisissant la commande "Maintenir les hiérarchies" puis "Afficher les hiérarchies".

<p><strong>Montrer les dossiers</strong> - Rend visibles de manière permanente tous les sous-dossiers du dossier sélectionné. Cette commande annule les effets de la commande "Cacher le dossier".

<p><strong>Propriétés du dossier</strong> - Permet de configurer les propriétés du dossier telles que son nom et
sa description.

<p><strong>Supprimer le dossier</strong> - Supprime un dossier. Les dossiers supprimés peuvent être récupérés
ultérieurement en utilisant la commande "Restaurer" ou en créant un nouveau dossier portant le même nom. Un utilisateur peut
même supprimer son propre dossier racine, cependant cette suppression ne sera effective qu'après que ce dossier
ait subi une purge. Un dossier racine supprimé ne peut être purgé ou restauré que par son propriétaire.

<p><strong>Purger le dossier</strong> - Supprime définitivement tous les liens ou dossiers précédemment effacés à
l'intérieur du dossier sélectionné. Il n'est plus possible (même pour un administrateur) de restaurer quoi que ce soit
dans un dossier qui a subi une purge!

<p><strong>Restaurer</strong> - Restaure les dossiers et les liens précédemment supprimés, à moins qu'une purge ne soit
intervenue entre temps. Quand un dossier racine est supprimé il est généralement affiché avec une icône grisée et n'est
visible que par le propriétaire de la hiérarchie. Ce mécanisme prévient la perte possible de tous les favoris partagés par
une suppression ou une purge accidentelle initiée par un autre utilisateur ayant des droits sur le dossier.

<p>

<p><strong>Copier</strong> - Copie le dossier ainsi que tout son contenu vers le presse-papier interne.

<p><strong>Coller</strong> - Disponible uniquement après que la commande "Copier" ou "Copier le lien" ait été exécutée. La
commande "Coller" détermine si l'utilisateur a la possibilité de déplacer le contenu ou uniquement de le copier et
sélectionne automatiquement la valeur appropriée par défaut. Il est toutefois toujours possible à l'utilisateur de choisir
de copier ou de déplacer dans le panneau d'options de la commande.

<p>

<p><strong>Importer les favoris</strong> - Importe dans le dossier sélectionné les favoris à partir d'un fichier externe. Aucune
validation de liens ne s'effectue lors de cette étape afin de minimiser le temps d'importation des données.

<p><strong>Exporter les favoris</strong> - Exporte le contenu du dossier vers un fichier de favoris externe. Le format
de favoris Netscape et le format Hotlist d'Opera sont supportés. Mozila utilise le format de favoris Netscape et Internet
Explorer est capable d'exporter et d'importer également des fichiers dans ce format.

<p><strong>Valider les liens</strong> - Vérifie tous les liens dans le dossier et les sous-dossiers. La validation
nécessite que les connexions sortantes soient autorisées à partir du serveur. Lors de la validation il est possible de
découvrir les Favicons ou de supprimer les Favicons qui n'ont jamais appartenu au cache (probablement de mauvaises
Favicons). La page de validation affiche la liste de tous les liens en cours de test. La validation est effectuée par
le téléchargement et l'affichage de l'icône de chaque lien. Une icône par défaut est affichée lorsque la Favicon
n'existe pas. En cas de lien indisponible, une Favicon d'erreur est affichée. En cas de lien valide et disposant d'une
icône personnalisée, cette dernière est affichée. Il est possible que lorsqu'un grand nombre de liens doivent être
validés, le navigateur ne parvienne pas à la fin de la liste. Dans ce cas l'utilisateur doit simplement recharger la
page, les sites vérifiés récemment seront ignorés et la validation reprendra son cours. Les liens indisponibles seront
uniquement marqués, et ne seront pas supprimés. Ils seront barrés dans l'affichage de SiteBar.

<p><strong>Sécurité</strong> - Autorise des droits particuliers pour chaque dossier. Les droits précisés sont valides
pour tous les sous-dossiers. Veuillez vous référer à la section "Système de sécurité" pour plus d'information.
_P;

$help['270'] = <<<_P
<p><strong>Envoyer le lien par email</strong> - Permet d'envoyer un lien favori par email à une autre personne. Pour
les utilisateurs ayant confirmé leur adresse email il est possible d'utiliser le système de mail interne, pour les
autres il faudra utiliser un programme externe.

<p><strong>Copier le lien</strong> - Copie le lien vers le presse-papier interne. Utilisez la commande "Coller" sur un
dossier pour copier/déplacer le lien vers le noeud.

<p><strong>Supprimer le lien</strong> - Supprime le lien du dossier. Un lien supprimé peut être restauré en utilisant
la commende "Restaurer" du dossier parent.

<p><strong>Propriétés</strong> - Permet de modifier les propriétés d'un lien. Permet également de désigner le lien comme
privé.
_P;

$help['300'] = <<<_P
SiteBar 3 est une réécriture complète de la version 2.x du logiciel, ce qui représente une grande avancée de SiteBar.

<p>SiteBar 3 n'utilise plus de JavaScript pour afficher les hiérarchies de favoris. Cependant JavaScript est utilisé
pour afficher les menus contextuels et pour réduire ou développer les noeuds avec le changement d'icône qui s'en suit.
La recommendation <a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a> doit être supportée
par le navigateur. L'avantage de cette méthode est un chargement très rapide et incrémental des favoris. L'inconvénient
étant que les navigateurs les plus anciens ne pourront afficher les favoris que dans un mode de hiérarchie totalement
développée et n'y avoir qu'un accès en lecture seule (ce qui est tout de même une amélioration par rapport à la version
2.x qui ne pouvait pas afficher les favoris du tout sur ces anciens navigateurs).

<p>Du coté du serveur, les données sont stockées avec la structure de données récursive la plus simple et est optimisée
pour les opérations de modifications sur des arbres. Ceci permet de très bonnes performances de sélection. Grâce aux
index de base de données la sélection ne devrait plus être un facteur de ralentissement avec un très grand nombre
de liens.
_P;

$help['302'] = <<<_P
SiteBar 3 effectue toujours une double vérification en ce qui concerne les droits d'accès.
L'utilisateur ne dispose dans son interface que d'un sous-ensemble de commandes basées sur ses
autorisations et chaque commande à exécuter est validée pour la seconde fois juste avant d'être
lancée.

<p>Le système dispose de trois rôles de base, les utilisateurs, les modérateurs, et les administrateurs.
Les modérateurs sont des utilisateurs désignés modérateurs lors de la création de groupes ou par d'autres
modérateurs. Le rôle de modérateur est lié à un groupe particulier. Les administrateurs sont les membres du
groupe "Administrateurs" ainsi que le premier utilisateur créé lors de l'exécution de la commande "Configurer"
à l'installation du système. Les administrateurs n'ont pas le droit d'être désignés modérateurs. Ils peuvent
toutefois supprimer totalement des groupes.

<p>SiteBar 3 a été développé afin de satisfaire les besoins d'équipes multiples. Cela signifie qu'un groupe
d'utilisateurs peut partager des favoris. Pour conserver les favoris de l'équipe privés, un système de contrôle
d'accès a été développé.

<p>Le principe fondateur de ce mécanisme est le fait que le propriétaire d'un dossier racine d'une hiérarchie
dispose de droits illimités sur toute l'arborescence de cette hiérarchie. Lors de l'inscription ou la création
d'un utilisateur, un dossier racine est créé et associé à l'utilisateur. De plus, les administrateurs peuvent
créer de nouvelles hiérarchies pour les utilisateurs ou autoriser les utilisateurs à créer leurs propres hiérarchies.

<p>Quand la hiérarchie est créée, l'utilisateur peut préciser les droits sur cette arborescence qui seront données
aux autres groupes d'utilisateurs. Les droits suivants sont disponibles pour n'importe quel groupe d'utilisateurs:

<p><strong>Lire</strong> - Un membre du groupe peut utiliser les favoris. S'il ne veut plus les voir il doit quitter
le groupe.

<p><strong>Ajouter</strong> - Les membres du groupe peuvent ajouter des liens ou des dossiers.

<p><strong>Modifier</strong> - Donne l'autorisation de définir les propriétés des liens ou des dossiers.

<p><strong>Supprimer</strong> - Autorise les membres du groupe à supprimer des liens ou des dossiers.

<p><strong>Purger</strong> - Donne l'autorisation de purger des liens ou dossiers précédemment supprimés. Associé au
droit de "Supprimer" il permet de déplacer les dossiers d'une hiérarchie à une autre.

<p><strong>Habiliter</strong> - Les membres du groupe on les mêmes droits sur la hiérarchie que son propriétaire.

<p>Les droits sont toujours hérités des dossiers parents. Le dossier racine n'a par défaut aucun droit pour
aucun groupe. Les utilisateurs peuvent spécifier des droits plus restreints à un dossier particulier, ce qui n'a
aucune influence sur ses sous-dossiers. Si les droits sur un dossier sont les mêmes que sont parent, la
spécification de droits pour le dossier sont alors supprimés et l'héritage de droits est utilisé en remplacement.

<p>Les modérateurs du groupe on toujours le droit de supprimer n'importe quel droit qu'un utilisateur aurait donné
au groupe.

<p>En plus du système de sécurité sur les dossiers, il existe une solution pour les liens qui permet de garder
certains liens privés dans un dossier publié. Le propriétaire d'une hiérarchie peut marquer chaque lien comme
privé ce qui a pour effet de ne plus lister ce lien ni d'y permettre aucune opération de la part d'autres utilisateurs.
Il n'est pas nécessaire de marque les liens comme privés s'il n'y a pas de partage activé au niveau du dossier (et
par défaut il n'y en a aucun).

<p>Plus les spécifications de contrôle d'accès sur les dossiers sont nombreuses, plus le temps de chargement
des favoris pour tous les utilisateurs sera long. Il ne faut donc pas abuser des spécifications d'accès sur les
hiérarchies comprenant un grand nombre de niveaux.

<p>Quand l'administrateur du SiteBar active l'option "Mode personnel", la commande de sécurité n'est plus disponible,
et l'option "Publier répertoire" de la fenêtre "Propriétés du dossier" devient alors le moyen d'en contrôler l'accès.
Dans ce mode il n'est pas possible de restreindre les droits d'un sous-dossier lorsque l'un de ses parents est déjà
publié. Il est possible de passer librement du mode personnel au mode collaboratif, cependant il n'est
pas possible en mode personnel de supprimer des droits sur des dossiers qui ont été assignés dans le mode
collaboratif à un groupe autre que "Tout le monde".
_P;

$help['303'] = <<<_P
SiteBar permet de créer des thèmes personnels. Pour développer un thème il faut une bonne connaissance de CSS et
une connaissance de XSLT est nécessaire pour une personnalisation complète.
La meilleure façon de créer un nouveau thème est de se baser sur un thème existant. Autrement dit, il faut tout d'abord
créer une copie d'un thème se trouvant dans le répertoire "skins". Chaque thème consiste en:
<ul>
<li>plusieurs images (vous pouvez simplement les modifier, mais conservez le format PNG).
<li>un fichier PHP "hook.inc.php" qui est utilisé par le système pour obtenir des informations sur le thème (p.ex. nom de l'auteur).
<li>une feuille de style commune "common.css" qui contient les définitions de couleur utilisées par les autres feuilles de style.
<li>des feuilles de style pour le panneau SiteBar "sitebar.css".
<li>pour les générateurs basés sur XSLT il y a des feuilles de style pour afficher les nouvelles "news.css", pour la navigation par répertoire "directory.css" et pour la recherche dans le contenu "search.css".
</ul>

<strong>XSL</strong> - il est possible de modifier totalement la présentation du code généré par le composant XML de SiteBar, en
définissant sa propre feuille de style XSL. Dans ce cas, il est nécessaire de copier l'un des fichier skins/*.xsl.php vers le dossier
du nouveau thème puis de le modifier.

<p>
<strong>Extension</strong> - à l'exception des feuilles de style communes, toutes les autres feuilles de style sont considérées comme des
extensions aux feuilles de style communes. Les auteurs de nouveaux thèmes peuvent modifier les valeurs par défaut dans ces nouvelles
feuilles de style.

<p>
<strong>Identité visuelle</strong> - certains administrateurs souhaitent créer un thème qui correspond à l'aspect général de leur site.
Dans ce cas il est recommandé de supprimer tous les autres thèmes et de choisir l'unique thème en tant que valeur par défaut dans
les paramètres de SiteBar. Si vous souhaitez inclure votre thème dans la version redistribuée de SiteBar, il faudra
alors contacter l'équipe de développement et tester votre thème avec la version stable la plus récente du logiciel.
La règle à respecter est de faire apparaître un logo SiteBar sur la page, ce logo peut toutefois être modifié librement.
_P;

$help['304'] = <<<_P
SiteBar utilise un système de générateurs, qui sont utilisés pour produire le contenu de SiteBar
de différentes manières. Le panneau principal de SiteBar est lui-même les résultat d'un générateur.

Tous les générateurs héritent de la classe <strong>SB_WriterInterface</strong> dans <strong>inc/writer.inc.php</strong>
et sont situés dans le sous-répertoire <strong>inc/writers</strong>. Afin de produire du contenu il est nécessaire
de redéfinir un certain nombre de méthodes et il est même possible d'utiliser l'un des générateurs existant et d'en
hériter (de la même façon qu'un certain nombre de générateurs standards de SiteBar basés sur le format XBEL).
_P;

$help['305'] = <<<_P
Pour migrer une installation existante de SiteBar vers un serveur différent, il est nécessaire
<ul>
  <li>d'exporter les tables sitebar_* à partir de la base de données vers un fichier .SQL
  <li>d'importer ce fichier vers la base de données destination
  <li>de déplacer le logiciel ou d'installer une version stable de SiteBar
      (la mise à jour du format de la base de données se fera automatiquement vers la bonne version)
  <li>de supprimer ou mettre à jour inc/config.inc.php dans le cas où les détails de connexion à la
      base de données ont changé.
</ul>

<p>
L'exportation et l'importation peuvent être réalisés en utilisant <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a>.
La table sitebar_favicon (jusqu'à la version 3.2.6) ou sitebar_cache (à partir de la version 3.3) ne doit pas
obligatoirement être transférée, son contenu sera reconstruit.
_P;

?>
