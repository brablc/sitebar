<?php

$help[100] = <<<_H
SiteBar functions are accessible from the <strong>User menu</strong> and from
folder and link <strong>Context menus</strong>. The User menu is shown at the
bottom of the SiteBar, and context menus are accessible by right clicking on
folders or links. Opera and Apple users can use Ctrl-click instead. In case when
even Ctrl-click is not recognized it is possible to set switch "Show Menu Icon"
from command "User Settings". When this option is checked there will be show a small
menu icon beside folder or link icon. Clicking on this icon bring the context menu.
<p>
Both context and user menus can show different subset of commands for  different
users based on their rights in the system. Some items might be disabled  in  the
context menu based on user rights to nodes and on current program mode/state.
Commands are executed via Command Window.
_H;

$help[101] = <<<_H
Click on a folder or a link with mouse and move mouse cursor over another folder while holding
the button pressed. Dragging is signalled by highlighting the target folder. Release the mouse
button to drop the dragged link or folder to the currently highlighted folder.
<p>
Drag &amp; Drop is not implemented by SiteBar team for Opera browsers. Copy and Paste
should be used instead.
_H;

$help[103] = <<<_H
<p><strong>Search</strong> - The same as search but processed on the backend
and displayed in another form.

<p><strong>Search Web</strong> - Shown in case Web Search is allowed and configured.

<p><strong>Collapse All</strong> - Collapses all nodes. When clicked for the second
time (when all nodes are alredy collapsed) then expands all nodes.

<p><strong>Reload with Hidden Folders</strong> - Reloads all links from server,
including the folder hidden with "Hide Folder" command.

<p><strong>Reload</strong> - Reloads all links from server, this function is
here because the  plugin is hosted in sidebar where the user might not have
(depending on the  browser) possibility to reload it.
_H;

$help[200] = <<<_H
Commands are grouped into several logical groups. Please select one of the
groups to see help for the command.
_H;

$help[210] = <<<_H
<p><strong>Log In</strong> - Logs user in the system, the user is always
remembered using cookies. User can specify when the cookie should expire.

<p><strong>Log Out</strong> - Logs out the user. This should be always used on
public terminals. An equivalent is to use login with session duration and to
close all browser windows.

<p><strong>Sign Up</strong> - Allows a visitor to sign up to the system. Based
on the email  address to user might qualify to join some groups. In this case
the email  must be verified. This is done automatically by sending a
verification email  to the user. Admin of the system can disable sign-up of
new users. Additionally admins can require email to be verified before using
SiteBar and/or manual account approval.
_H;

$help[220] = <<<_H
<p><strong>Set Up</strong> - The first command an administrator will see when
installing SiteBar  and after setting up a database. An admin account will be
created and basic sitebar parameters will be set up.

<p><strong>SiteBar Settings</strong> - Admins can later change SiteBar
parameters. Admins are members of Admins group and the user created using the
"Set Up" command. See "Sign Up" for explanation of email features. There are
more email features planned in future releases.

<p><strong>Create Tree</strong> - Depending on SiteBar settings only admins
and/or users with  verified email can create new trees. When a new tree is
created it must be  associated with an existing user (only admin can create tree
for someone  else). The standard way to create team bookmarks is to create a new
tree and  assign it to the user who moderates the group, created separately
using  "Create Group". This user can then grant rights on the newly created tree
to  the group members and can add members to the group.
_H;

$help[230] = <<<_H
<p><strong>User Settings</strong> - Change user settings. When "External Commander"
is not checked, the Command Window will open in place of SiteBar rather than in an
external window. Some commands always open in place ("Log In", "Log Out",  "Sign Up",
"User Settings"). When "Skip Execution Messages" is checked no confirmation screen is
shown upon successful command execution. "Decorate ACL Folders" will mark those folders
that have security specification.

<p><strong>Membership</strong> - Users can leave any group and join opened
groups. Users cannot  leave groups if the group would then lose the last
moderator. In this case  admin should be contacted to delete the group.

<p><strong>Verify Email</strong> - Allows user to verify his email address to
use other system  functions.
_H;

$help[240] = <<<_H
<p><strong>Maintain Users</strong> - Shows a list box with users and allows the
following commands  to be executed.

<p><strong>Modify User</strong> - Currently the only way to recover a forgotten
password is to  set a temporary password, email it to the user and ask him/her
to change it. Administrator can mark account as demo, what disallows user to
change some properties, especially password.

<p><strong>Delete User</strong> - Deletes the user and all memberships.
Reassigns existing  trees to another user. It is not permitted to delete a user
who is the only  moderator of any group.

<p><strong>Create User</strong> - The same as "Sign Up" but is intended for the
administrator. The  emails of created users are treated as verified.
_H;

$help[250] = <<<_H
<p><strong>Maintain Groups</strong> - Shows a list box with groups and allows
following commands  to be executed.

<p><strong>Group Properties</strong> - Accessible to moderators of the group.
Allows changing group name, comments, and auto joining through an email
regular expression. When the auto  join regexp is filled and matches the
email address on sign-up of a new user  the user is asked to verify the email
and upon verification he becomes automatically group member.

<p><strong>Group Members</strong> - Only moderators can select which users are
members. Another  moderator cannot be unselected, the moderator role must be
firstly removed  using following command.

<p><strong>Group Moderators</strong> - Accessible to moderators of the group.
There must be always  at least one moderator.

<p><strong>Delete Group</strong> - Accessible to admins only, deletes a group
and all memberships.

<p><strong>Create Group</strong> - Accessible to admins only, creates a group
and specifies the  first moderator of a group.
_H;

$help[260] = <<<_H
<p><strong>Add Folder</strong> - Adds a new subfolder to the folder.

<p><strong>Add Link</strong> - Adds a link to the folder. When executed from the
bookmarklet it  allows the user to select a target folder, otherwise it is
created in the  folder from which the command has been called.

<p><strong>Browse Folder</strong> - Browser folder in the directory mode.
Only one directory is shown at a time and details are shown for links.

<p><strong>All Bookmarks</strong> - Shows links of all subfolders at once.

<p><strong>Bookmark News</strong> - Show news about this folder and included
subfolders.

<p>

<p><strong>Hide Folder</strong> - Hides the folder. Is used to hide published
folders of other users or rarely used folders. A click on "Reload with Hidden Folders" icon
will load all folders temporarily. "Unhide Subfolders command" can be used to unhide
hidden folders permanently. Hidden trees can be unhidden using "Maintain Trees -> Unhide Trees".

<p><strong>Unhide Subfolders</strong> - Unhides all subfolders of the clicked folder.

<p><strong>Folder Properties</strong> - Specify folder properties - name and
description.

<p><strong>Delete Folder</strong> - Deletes folder. Deleted folder can be
undeleted using  "Undelete" command or by adding folder with the same name. User
can delete  even his own root folder, however this deletion is only valid after
purge is called in that folder. Deleted root folder can be purged/undeleted
only by its owner.

<p><strong>Purge Folder</strong> - Purges previously deleted folders or links
inside the selected  folder. It is not possible for anyone to undelete anything
what was purged!

<p><strong>Undelete</strong> - Recover previously deleted folders or links,
unless purged. When a  root folder is deleted it is shown usually with greyscale
icon and is  visible to tree owner only. This prevents possible loss of all
shared bookmarks by accidental delete/purge made by other privileged user.

<p>

<p><strong>Copy</strong> - Copy folder and all its content to the internal
clipboard.

<p><strong>Paste</strong> - Available only when "Copy" or "Copy Bookmark" command
has been executed.  The "Paste" command determines whether the user can move the
content or  only copy it and select proper default value. However the user can
still  select copying or moving.

<p>

<p><strong>Import Bookmarks</strong> - Imports bookmarks from an external file
to the folder. No  link validations are performed at this step in order to avoid
timeout on  the server side.

<p><strong>Export Bookmarks</strong> - Exports the content of the folder to an
external bookmark  file. Netscape bookmark file format + Opera Hotlist are
supported. Mozilla  uses Netscape bookmark file format and Internet Explorer can
export and  import to and from this format.

<p><strong>Validate Bookmarks</strong> - Validates all links in the folder and
subfolders. The validation requires outbound connection be available. During
validation it is possible to discover favicons or to delete favicons that
were never in the favicon cache (possibly wrong favicons). Validation page shows
a list of all links that are being tested. Validation is done be means of
retrieving and displaing icon for each link. Standard link icon is shown when
no favicon is found, in case of a dead link a wrong-favicon image is shown.
In case the link is valid and favicon exists favicon image will be shown.
It can happen that with many links the browser will fail. In this case the
user should simply reload the page, recently checked sites will be ignored
and the user can per-partes validate all links. Dead links will be only marked
and not deleted. They will be shown in SideBar with line-through.

<p><strong>Security</strong> - Allows specifying rights for every folder, the
rights specified are valid for all subfolders. See "Security Management" section
for more information.
_H;

$help[270] = <<<_H
<p><strong>Email Link</strong> - Allows a link to be sent via email to another
person. For users  with verified email, internal mail system can be utilized,
otherwise  external program must be started.

<p><strong>Copy Link</strong> - Copy link to the internal clipboard. Use "Paste"
command on folder  to copy/move link to the node.

<p><strong>Delete Link</strong> - Delete link from the node. Deleted link can be
undeleted using  the "Undelete" command on the parent folder.

<p><strong>Properties</strong> - Edit properties of a link. Allows to set link
as private.
_H;

$help[300] = <<<_H
SiteBar 3 is a complete re-write from the 2.x series, representing the further
evolution of SiteBar.
<p>
SiteBar 3 no longer uses any JavaScript for rendering of the bookmark trees.
However JavaScript is used havily to display context menus and to
expand/collapse nodes including icon changes.
<a href="http://www.w3.org/TR/DOM-Level-2-Core/">Document Object Model Level 2</a>
must be supported by the browser. The advantage of this is very fast and incremental
bookmark loading. The drawback is that older browsers can only see the bookmark tree
expanded and have only read access to it (what is still an improvement to version
2.x which failed to display on older browsers at all).
<p>
On the server side the data is stored with the most simple recursive data
structure and is optimized for tree modifications. This gives very good
performance for selecting. Thanks to the database table indexes selecting should
not slow down with a very large number of links.
_H;

$help[302] = <<<_H
SiteBar 3 does double-checking when it comes to user rights. The user  is  shown
only a subset of commands for execution based on his  rights  and  every  issued
command is verified for the second time just before execution.
<p>
The system has three basic roles, users, moderators and admins.  Moderators  are
users that were marked as moderator upon group creation or by  other  moderator.
A moderator is a role bound to  a  particular  group  only.  Administrators  are
members of the Admins group plus the first user created by the "Set Up" command.
Administrators do not have right to act as moderators. They can, however, delete
complete groups.
<p>
SiteBar 3 was developed to suit needs of multiple teams. That means that  a  group  of
users can share bookmarks. In order to keep the team's bookmarks private  access
control mechanism has been developed.
<p>
The building stone of this mechanisms is that the owner of a root folder of any tree
has unlimited rights to the complete tree. Upon sign-up or user creation a  root
folder is created for each user. Additionally admins can create additional trees
for any users or allow other users to create their own new trees.
<p>
When the tree is created the user can specify rights to his tree to  other  user
groups. The following rights are available for any user group:

<p><strong>Read</strong> - Group user can use bookmarks, if he does not want to
see them, he must  leave the group.

<p><strong>Add</strong> - User can add folders and links.

<p><strong>Modify</strong> - Define properties of links or folders.

<p><strong>Delete</strong> - Delete link or folder.

<p><strong>Purge</strong> - Purge previously deleted link or folder, together
with 'Delete' allows  folder to be moved from one tree to another.

<p><strong>Grant</strong> - Group members have the same rights to the tree as
its owner.

<p>
The rights are always inherited from the parent folders. The root folder has  by
default no right for any group. User can specify more restrictive access to some
folder, what has influence on child folders. If the rights for a folder are  the
same as for the parent folder, the right specification for the current folder is
removed and inheritance is used instead.
<p>
Group moderators have always right to remove any right specified for their group
by any user.
<p>
Additionally to the folder security mechanism there is  a  solution  for  links,
that allows keeping certain links private in  otherwise  published  folder.  The
owner of a tree can mark any link as private what disables this link from  being
listed and from any other operation from other users. It  is  not  necessary  to
marks the links as private if there is no sharing on folder level  defined  (and
by default there is none).
<p>
The bigger the number of access control specifications on folder  level  is  the
longer it takes to load the bookmarks to all users. Specifications should not be
overused on deep nested trees.
_H;

$help[303] = <<<_H
SiteBar allows user skins to be created. Good knowledge of CSS is required for
skin design and for full customization XSLT knowledge is needed.
In order to create new skins an existing skin should be taken as a
base. This means to take any of the existing skins in directory "skins" and
create a copy of it. Each skin consists
<ul>
<li>Several pictures (simply change them, but keep the PNG format).
<li>Hook file "hook.inc.php", this file is used by some other parts to get
some information about the skin (e.g. author name).
<li>Commmon style sheet "common.css" contaning color definition shared by other style sheets.
<li>Style-sheet for SiteBar panel "sitebar.css".
<li>For XSLT based writers there are sheets for link news display "news.css",
for directory browsing "directory.css" and for backend search "search.css".
</ul>

<strong>XSL</strong> - it is possible to completely change presentation of
XML based SiteBar outputs by providing own XSL stylesheet. In this case it
is necessary to copy one of the skins/*.xsl.php files to the skin directory and change it.

<p>
<strong>Cascading</strong> - with exception of the common stylesheets all
other stylesheets are created as a superset of the common stylesheet and corresponding
common stylesheet from the skins directory. Skin author may redefine default values here.

<p>
<strong>Branding</strong> - some administrators might want to create their own skin to match the design of their
site. In this case it is recommended to remove all other skins and to choose the
default skin in SiteBar Settings.

<p>If you would like to include your skin to
SiteBar distribution then you have to contact development team and test your
skin with the newest stable development version. As a rule SiteBar logo must
be on the page, however SiteBar logo can be freely updated.
_H;

$help[304] = <<<_H
SiteBar uses a framework of writers, which are used to produce SiteBar content
in various ways. The main SiteBar panel is itself a product of a writer.
<p>
All writers inherit from <strong>SB_WriterInterface</strong> class in
<strong>inc/writer.inc.php</strong> and are placed in <strong>inc/writers</strong> subdirectory.
In order to produce some output it is necessary to override only a couple of methods and it is
even possible to use one of the existing writers and inherit from it (as do many of native
SiteBar writers based on XBEL format).
_H;

$help[305] = <<<_H
In order to migrate an existing SiteBar installation to another server it is
needed to
<ul>
    <li>Export the sitebar_* tables from the source database to an .SQL file.
    <li>Import this file to the target database.
    <li>Move the software or install any stable SiteBar version
        (downgrade or upgrade will be done automatically).
    <li>Delete or update inc/config.inc.php in case the database connection
        details have changed.
</ul>

<p>
The export and import can be done using <a href='http://www.phpmyadmin.net/'>phpMyAdmin</a>.
The table sitebar_favicon (to 3.2.6) or sitebar_cache (starting with 3.3) does not need
to be transferred, its content will be rebuilt.
_H;

?>
