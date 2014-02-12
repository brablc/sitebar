<?php

$para['integrator::welcome'] = <<<_P
Welcome on the SiteBar integration page. This page helps you to get
most out of the SiteBar. On the <a href="http://sitebar.org/">SiteBar homepage</a>
you can learn more about SiteBar features.
_P;

$para['integrator::header'] = <<<_P
SiteBar is designed to comply with standards and should work on most browsers with
enabled javascript and cookies. The following table shows on what browsers it has
been tested.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar uses right+click to invoke context menus for bookmarks and folders.
Opera users must check the "Show Menu Icon" option in "User Settings" and then
left-click the icon next to the bookmark or folder icon to open the menu.
Ctrl-left click on the label next to the folder or bookmark icon may work as well.
_P;

$para['integrator::hint'] = <<<_P
Click above on the name of the browser of your choice to see integration instructions.
Please <a href="http://brablc.com/mailto?o">report</a> other verified browsers/platforms.
_P;

$para['integrator::hint_window'] = <<<_P
This is an ordinary bookmark which will open the SiteBar in the current window.
SiteBar is optimized to display as a narrow vertical bar.
This way a lot of space would be wasted.
_P;

$para['integrator::hint_dir'] = <<<_P
Apart of the tree like display, SiteBar can be shown as a traditional directory.
This view shows one directory at a time and shows details for displayed bookmarks.
The browser must support <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
If your browser does not have a sidebar feature, you may use this bookmarklet&#42;.
It will open SiteBar in a pop-up window similar to a sidebar. Please be aware of the fact
that your browser may block pop-ups!
_P;

$para['integrator::hint_iframe'] = <<<_P
The URL at the left side provides SiteBar in a &lt;IFRAME&gt;. It is suitable for embedding
on various portals. Such as:
<ul>
<li><a href="http://www.pageflakes.com/">Pageflakes</a>
<li><a href="http://www.netvibes.com/">Netvibes</a>
</ul>
Visit the portal, find a place where you can add content. Copy there this URL <strong>%s</strong>
and a new gadget should be created (note that https is usually not supported by portals,
you may, however, use https in the iframe.php). Note that your username/password is <strong>NOT</strong>
exposed to the portal. MS IE users may need to allow cookies for the SiteBar server domain.
_P;

$para['integrator::hint_google'] = <<<_P
Uses IFRAME too, but is customized for display on Google Personalized Homepage.
Use <strong>Add stuff</strong> and this URL <strong>%s</strong> .
_P;

$para['integrator::hint_addpage'] = <<<_P
This bookmarklet&#42; may be used to add bookmarks to your SiteBar. When executed a new pop-up
window will occur that will be prefilled with the details of the current page.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> is a bookmark/favorite
that contains JavaScript code. You can right click it and add to your bookmarks/favorites toolbar.
Later click on this bookmark will execute the JavaScript code.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Adds SiteBar Bookmark Search to the Web Search field. Allows searching in SiteBar bookmarks without
having SiteBar opened.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Extension developed especially for SiteBar.
Allows to open all bookmarks from one folder in the tabs and other features.
Use menu View/Toolbar/Customize to put SiteBar icons on your toolbar.
_P;

$para['integrator::hint_bmsync'] = <<<_P
In order to use two way synchronization with Firefox please install Bookmark Synchronizer
extension. Use "User Settings -> XBELSync Settings" command to get more information of how to setup the
synchronization.
[<a href="http://sitebar.org/downloads.php">More info</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Creates a bookmark that can be later clicked to open SiteBar in a sidebar panel.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Download folder structure of your entire SiteBar to a file. Import this file to your bookmarks.
Each folder is represented by a Live Bookmark. This way your bookmarks will be integrated among
your other bookmarks, but folder content will be online downloaded from SiteBar.
In case a folder has subfolders, content of the actual folder will be shown in @Content folder.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Adds SiteBar into the sidebar panel. The panel can be shown/hidden with F9. In
case loading SiteBar into the sidebar exceed certain timelimit, Mozilla fails to
display it. It is recommended to open the SiteBar in the main window to allow
linked images (favicons) be cached in the browser or to switch favicon display
in "User Settings" off.
_P;

$para['integrator::hint_sidebar_konqueror'] = <<<_P
Follow those steps:
<ol>
<li>Open Konqueror
<li>Goto menu "Window -> Show Navigation Panel (F9)"
<li>Right click the left most bar with icons in the Navigation Panel below the icons.
<li>Choose "Add New -> Web SideBar Module" - a new icon will be added named "Web SiteBar Plugin".
<li>Right click the new icon and select "Set Name", put <b>SiteBar</b> there.
<li>Right click the new icon and select "Set Url", put <b>%s</b> there.
<li>Click on the icon to open SiteBar in the SideBar.
</ol>
_P;

$para['integrator::hint_hotlist'] = <<<_P
A bookmark to SiteBar will be added to Opera Bookmarks. Clicking the link in the list of bookmarks will add SiteBar to the Opera Panels.
_P;

$para['integrator::hint_install'] = <<<_P
Installs the SiteBar to the Explorer Bar and context menu - requires Windows registry change
and system restart for all features. Depending on your rights only some features might be
installed.
<br>
Open SiteBar Explorer Bar from the View menu or use View > Toolbars > Customize to place the SiteBar
Panel toggle button on the toolbar. Right click anywhere on the page or
over a link to add the page or link to the SiteBar.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Removes SiteBar from the Explorer Bar (see above).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Using this bookmarklet&#42; is recommended in case that the user does not have enough privileged
to install the explorer bar. It loads SiteBar temporarily to the Search Explorer Bar of your
browser.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Downloads a plugin (with preset URL). The archive must be extracted to the "C:\\Program Files\\Maxthon\\Plugin"
directory. After restart a new Explorer Bar item will be added.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Downloads a plugin (with preset URL). The archive must be extracted to the "C:\\Program Files\\Maxthon\\Plugin"
directory. After restart a new icon will occur on the Plugin toolbar. This icon allows page in the current
tab be added to the SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Run command <strong>emerge sitebar</strong> to install SiteBar package.
_P;

$para['integrator::hint_debian'] = <<<_P
Run command <strong>apt-get install sitebar</strong> to install SiteBar package.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu is a hierarchical menu system to prepare "on the fly" DHTML
menus relying on the PHP scripting engine for the processing of data items.
SiteBar can serve provide bookmark feed in proper structure. In case fopen
is allowed to open remote files, the following code will load file in proper structure:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright &copy; 2003-2005 <a href="http://brablc.com/">Ondřej Brablc</a>
and the <a href="http://sitebar.org/team.php">SiteBar Team</a>.
Support <a href="http://sitebar.org/forum.php">forum</a> and <a href="http://sitebar.org/bugs.php">bug</a> tracking.
_P;

/* Command window */

$para['command::welcome'] = <<<_P
%s, welcome to the SiteBar!
%s
<p>
Use right click on folder or link to manage your bookmarks.
<p>
Alternatively turn on "%s" option in the "%s" and use menu icon instead.
<p>
You are now logged in.
_P;

$para['command::signup_verify'] = <<<_P
<p>
This SiteBar installation requires that your email address
is valid and verified before you can use SiteBar functions.
<p>
Provided you have set correct email address, you should
receive an email shortly. Please click on the link in the
email.
_P;

$para['command::signup_approve'] = <<<_P
<p>
This SiteBar installation requires created accounts be approved
by an administrator before you can use SiteBar functions.
<p>
Please wait for an administrator approval - you will be
informed by an email.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
This SiteBar installation requires that your email address
is valid and verified and that an administrator approves
your account before you can use SiteBar functions.
<p>
Provided you have set correct email address, you should
receive an email shortly. Please click on the link in the
email and wait for an administrator approval - you will be
informed by an email.
_P;

$para['command::account_approved'] = <<<_P
The administrator has approved your account request.
You can login using your username %s.

--
SiteBar installation at %s.
_P;

$para['command::account_rejected'] = <<<_P
The administrator has rejected your account request
with username %s.

--
SiteBar installation at %s.
_P;

$para['command::account_deleted'] = <<<_P
The administrator has deleted your inactive account
with username %s.

--
SiteBar installation at %s.
_P;

$para['command::reset_password'] = <<<_P
A password reset for SiteBar account with registered e-mail
"%s" has been requested.

In case you really want to reset password for this account,
please click on the following link:
    %s

--
SiteBar installation at %s.
_P;

$para['command::leave_group'] = <<<_P
<p>
When you leave a group you will need an invitation to
join it again. To get an invitation you will have to contact
group owner - you must know his SiteBar username or email to do so.
_P;

$para['command::use_comma'] = <<<_P
Use comma or new line to separate usernames or emails. Users will become members once they confirm
your invitation.
_P;

$para['command::reset_password_hint'] = <<<_P
<p>
Please fill in your username or your registered email.
A token will be sent to your registered email address.
Use this token to reset your password.
_P;

$para['command::contact'] = <<<_P
%s


--
SiteBar installation at %s.
_P;

$para['command::contact_group'] = <<<_P
Target group: %s

%s


--
SiteBar installation at %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Do you really want to delete your account?</h3>
There will be no way to undo that change!<p>
_P;

$para['command::email_link_href'] = <<<_P
<p>Click
<a href="mailto:?subject=Web site: %s&amp;body=I have found a web site you may be interested in.
 Take a look at: %s
 --
 Sent via my SiteBar Bookmark Manager at %s
 Learn more about SiteBar at http://sitebar.org
">here</a> to send an email using your default e-mail client.
_P;

$para['command::email_link'] = <<<_P
I have found a web site you may be interested in.
Take a look at:

    "%s" %s

%s

--
Sent via SiteBar at %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::pm_notification'] = <<<_P
You have received a private message:

Subject: %s

Please visit your SiteBar account to read full message:

%s
_P;

$para['command::verify_email'] = <<<_P
Thank you for using email verification which allows you
to use SiteBar email features.

Please click on the following link to verify your email:

    %s

Please disregard this email, if you have not initiated
email verification in SiteBar Bookmark Manager.
_P;

$para['command::verify_email_must'] = <<<_P
You have signed up for a SiteBar account on SiteBar installation
that requires e-mail verification before first use of SiteBar.

Please click on the following link to verify your email:

    %s
_P;

/*
$para['command::import_bk'] = <<<_P
<br>
Local favorites can be exported to a local file using javascript
<a href='javascript:window.external.ImportExportFavorites(false,"")'>function</a>.
_P;

$para['command::export_bk'] = <<<_P
<br>
Exported bookmarks can be imported to local favorties using javascript
<a href='javascript:window.external.ImportExportFavorites(true,"")'>function</a>.
_P;
*/

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer can import bookmarks in Netscape Bookmark File format from "File/Import and Export ..." menu.
However, it must be in the native Windows encoding, the default UTF-8 will not work.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer can export bookmarks in Netscape Bookmark File format from "File/Import and Export ..." menu.
The exported file is in the native Windows encoding - please select the codepage when importing the file,
the default UTF-8 will not work.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Codepage conversion not installed on this SiteBar server. Only utf-8 and iso-8859-1 supported.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rights:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete
_P;

$para['command::purge_cache'] = <<<_P
<h3>Do you really want to remove all favicons from the cache?</h3>
_P;

$para['command::tooltip_allow_anonymous_export'] = 'Enable direct bookmark download or feed for anonymous users. Can be bypassed if user knows how to construct URL!';
$para['command::tooltip_allow_contact'] = 'Allow administrator be contacted by anonymous users.';
$para['command::tooltip_allow_custom_search_engine'] = 'If not allowed, then all users will use the search engine set on this form and will not be able to modify it.';
$para['command::tooltip_allow_info_mails'] = 'Allow admins and moderators of group that I belong to, to send me info emails.';
$para['command::tooltip_allow_sign_up'] = 'Allow visitors to access the sign up form and register to SiteBar.';
$para['command::tooltip_allow_user_groups'] = 'Users are allowed to create their own groups. Otherwise only administrators have this privilege.';
$para['command::tooltip_allow_user_tree_deletion'] = 'Allow the users to delete their existing trees.';
$para['command::tooltip_allow_user_trees'] = 'Allow the users to create additional trees.';
$para['command::tooltip_approved'] = 'Account is approved and can be fully used.';
$para['command::tooltip_auto_close'] = 'Do not display command execution status in case of success.';
$para['command::tooltip_auto_retrieve_favicon'] = 'Retrieve favicon automatically when it is missing and bookmark is being added.';
$para['command::tooltip_default_groups'] = 'List of groups that will be created for user that have no groups. Use | to separate group names.';
$para['command::tooltip_public_groups'] = 'List of groups that will be available to anonymous users.';
$para['command::tooltip_cmd'] = 'Add most important SiteBar Commands to allow easy login to SiteBar.';
$para['command::tooltip_comment_impex'] = 'Show commands for import and export of bookmark description.';
$para['command::tooltip_comment_limit'] = 'It is possible to specify maximum length for a comment of a bookmark. It is possible to store small files as comments.';
$para['command::tooltip_default_folder'] = 'Next time you use the bookmarklet this folder will be set as default.';
$para['command::tooltip_delete_content'] = 'Delete only content of the folder, rather than the folder itself.';
$para['command::tooltip_delete_favicons'] = 'Delete favicon URL from bookmark if the favicon is invalid - use with care.';
$para['command::tooltip_demo'] = 'Make this a demo account with limited functionality and no possibility to change password.';
$para['command::tooltip_discover_favicons'] = 'Try to analyze the page and find favicons (shortcut icons) that are missing.';
$para['command::tooltip_exclude_root'] = 'The root folder will not be included in the output if possible.';
$para['command::tooltip_expert_mode'] = 'Display advanced controls and show more diagnostics messages.';
$para['command::tooltip_extern_commander'] = 'Execute commands using a pop up window - without reload after every command execution.';
$para['command::tooltip_filter_groups'] = 'Use filter for groups instead of select listbox.';
$para['command::tooltip_filter_users'] = 'Use filter for users instead of select listbox.';
$para['command::tooltip_flat'] = 'Export the bookmarks as if they were in one folder.';
$para['command::tooltip_hide_xslt'] = 'Hides features that need XSLT browser support.';
$para['command::tooltip_hits'] = 'Route all clicks on bookmarks through SiteBar server to generate usage statistics.';
$para['command::tooltip_ignore_https'] = 'SiteBar cannot validate HTTPS urls, if this is not checked, all links where there is no HTTP url will fail validation.';
$para['command::tooltip_ignore_recently'] = 'Do not test bookmarks that have been tested recently - used for repeated validation when the previous did not finish.';
$para['command::tooltip_integrator_url'] = 'By default SiteBar uses integrator from my.sitebar.org, it is possible to use local integrator from privacy reasons.';
$para['command::tooltip_is_dead_check'] = 'This bookmark did not pass validation. You may still wanted to keep it as active.';
$para['command::tooltip_is_feed'] = 'Mark bookmark as a feed - the bookmark will be opened in a feed reader (if setup) rather then directly in a browser.';
$para['command::tooltip_load_all_nodes'] = 'Load all folders, suitable for users with smaller number of bookmarks that want to use filtering.';
$para['command::tooltip_popup_params'] = 'Parameters for the pop-up windows opened by SiteBar. Leave empty to get the default value back.';
$para['command::tooltip_max_icon_age'] = 'How long will favicons stay in the cache before it will be refreshed from the remote server.';
$para['command::tooltip_max_icon_cache'] = 'FIFO stack. The oldest icons will be discarded from the system - used to control size of the cache.';
$para['command::tooltip_max_icon_size'] = 'Maximal allowed size of icon in bytes.';
$para['command::tooltip_max_session_time'] = 'Administrator can set maximum allowed session time. When the time is exceeded, user will have to re-login.';
$para['command::tooltip_menu_icon'] = 'Some browsers/platforms do not handle right click. This will show an icon that can be used instead to show context menus. Disables drag&drop.';
$para['command::tooltip_mix_mode'] = 'Folders preceed bookmarks in the SiteBar tree or vice versa.';
$para['command::tooltip_novalidate'] = 'Do not validate this bookmark - use for intranet bookmarks or for bookmarks that have problems with validations.';
$para['command::tooltip_paste_content'] = 'Apply the operation to the content of the folder not to the folder itself.';
$para['command::tooltip_private'] = 'Mark bookmark as private. Only tree owner can see such bookmark even when folder is published.';
$para['command::tooltip_private'] = 'Private bookmarks are never exposed to other users even if they are in shared folder.';
$para['command::tooltip_private_over_ssl_only'] = 'Private bookmarks will be loaded only if SiteBar is used over SSL connection.';
$para['command::tooltip_rename'] = 'On import rename duplicate bookmarks to have everything loaded.';
$para['command::tooltip_respect'] = 'Send email only if user has allowed it.';
$para['command::tooltip_search_engine_ico'] = 'Icon to be shown in the SiteBar toolbar and leading to a web search.';
$para['command::tooltip_search_engine_url'] = 'URL of the engine to be used for searching. Use %SEARCH% on place where searched string should go.';
$para['command::tooltip_sender_email'] = 'SiteBar generated emails will be sent with this address.';
$para['command::tooltip_show_acl'] = 'Decorate folders with security specification.';
$para['command::tooltip_show_logo'] = 'Show logo at the top - should be disabled for slow hostings, otherwise can be used for advertising.';
$para['command::tooltip_show_statistics'] = 'Display some static and performance statistics on the main SiteBar panel.';
$para['command::tooltip_subdir'] = 'Recursively export all bookmarks and all folders.';
$para['command::tooltip_subfolders'] = 'Validate this folder recursively with all subfolders.';
$para['command::tooltip_to_verified'] = 'Send emails only to verified addresses.';
$para['command::tooltip_use_compression'] = 'Pages sent by SiteBar can be compressed to save bandwidth. Compression is only used if supported on browser side.';
$para['command::tooltip_use_conv_engine'] = 'Use conversion engine (usually extension for PHP) to convert pages with different encoding - important for import and export of bookmarks. May cause blank screens on some implementations.';
$para['command::tooltip_use_favicon_cache'] = 'Favicons icons will be downloaded by the server to the database cache and upon client requests sent. Increases traffic and speeds up favicon cache by reducing the number of connected servers.';
$para['command::tooltip_use_favicons'] = 'Usage of favicons makes SiteBar nicer and slower. When favicon cache is used by this installation, display of favicons will be significanlty faster.';
$para['command::tooltip_use_hiding'] = 'Allows command to hide folders. Hiding is used for published folders of other users.';
$para['command::tooltip_use_mail_features'] = 'In case this PHP installation allows &ldquo;mail&rdquo; function to be used - e-mail features can be enabled.';
$para['command::tooltip_use_nice_url'] = 'Allows nicer URLs to be constructed and used on Apache servers with mod_rewrite enabled.';
$para['command::tooltip_use_new_window'] = 'Open all links in new window using _blank target.';
$para['command::tooltip_use_pm_notification'] = 'Notify via email when a PM is received, requires verified email address.';
$para['command::tooltip_use_outbound_connection'] = 'Some functions (favicon cache) require to access remote addresses from your server.';
$para['command::tooltip_use_search_engine'] = 'Allows search be redirected to or extended by results provided with your favorite web search engine.';
$para['command::tooltip_use_search_engine_iframe'] = 'The results of your web search engine will be included in the SiteBar search results page using inline frame.';
$para['command::tooltip_use_tooltips'] = 'Use SiteBar tooltips instead of browser built-in. Allows longer tips and support for more browsers.';
$para['command::tooltip_use_trash'] = 'Mark deleted folders and bookmarks so that they can be undeleted or purged.';
$para['command::tooltip_users_must_be_approved'] = 'Users must be approved by administrator before they can use SiteBar.';
$para['command::tooltip_users_must_verify_email'] = 'Users must verify e-mail before they can use SiteBar.';
$para['command::tooltip_verified'] = 'Check this to mark the email as verified.';
$para['command::tooltip_version_check_interval'] = 'SiteBar can perform regular checks whether a newer version is available. This could be important in case when a vulnerability of current version would be discovered. Outbound connection is required.';
$para['command::tooltip_web_search_user_agents'] = 'A regular expression for User Agents, that should get special non-javascript based writer.';

/* SiteBar */
$para['sitebar::users_must_verify_email'] = <<<_P
This SiteBar installation requires email verification.
Please verify your email, otherwise your account may be deleted.
_P;

$para['sitebar::tutorial'] = <<<_P
The icon with your user name above is your root bookmark folder.
Right-click on it and select command "%s" to add your first
bookmark.
_P;

$para['sitebar::invitation'] = <<<_P
User <strong>%s</strong> wants to share bookmarks with you
and invites you to join the group <strong>%s</strong>.
_P;

/* User manager */

$para['usermanager::signup_info'] = <<<_P
User %s signed up to your SiteBar installation at %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
User %s signed up to your SiteBar installation at %s.
The user has already verified his email address.
_P;

$para['usermanager::signup_approval'] = <<<_P
User %s signed up to your SiteBar installation at %s.

Approve account:
    %s

Reject account:
    %s

See pending users:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
User %s signed up to your SiteBar installation at %s.
The user has already verified his email address.

Approve account:
    %s

Reject account:
    %s

See pending users:
    %s
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

/* Messenger */

$para['messenger::cancel'] = 'Cancel';
$para['messenger::delete'] = 'Delete';
$para['messenger::expire'] = 'Expire';
$para['messenger::read'] = 'Read';
$para['messenger::unread'] = 'Unread';
$para['messenger::save'] = 'Save';

$para['messenger::state_unread'] = 'Unread';
$para['messenger::state_seen'] = 'Seen';
$para['messenger::state_read'] = 'Read';
$para['messenger::state_saved'] = 'Saved';
$para['messenger::state_deleted'] = 'Deleted';
$para['messenger::state_expired'] = 'Expired';

/* Skins */
$para['hook::statistics'] = <<<_P
Roots {roots_total}.
Folders {nodes_shown}/{nodes_total}.
Bookmarks {links_shown}/{links_total}.
Users {users}.
Groups {groups}.
SQL queries {queries}.
DB/Total time {time_db}/{time_total} sec ({time_pct}%).
_P;

/* Context */

$para['groupname::Family'] = <<<_P
Family
_P;

$para['groupname::Friends'] = <<<_P
Friends
_P;

$para['groupname::Public'] = <<<_P
Public
_P;

?>
