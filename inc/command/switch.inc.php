<?php
switch (str_replace(" ","",$_REQUEST["command"])) {
case "LogIn": $worker="auth";break;
case "LogOut": $worker="auth";break;
case "AddBookmark": $worker="bookmark";break;
case "MarkasDefault": $worker="bookmark";break;
case "Properties": $worker="bookmark";break;
case "DeleteBookmark": $worker="bookmark";break;
case "AddFolder": $worker="folder";break;
case "FolderProperties": $worker="folder";break;
case "CustomOrder": $worker="folder";break;
case "DeleteFolder": $worker="folder";break;
case "PurgeFolder": $worker="folder";break;
case "Undelete": $worker="folder";break;
case "Paste": $worker="folder";break;
case "SendMessagetoUser": $worker="messenger";break;
case "SendMessagetoAll": $worker="messenger";break;
case "SendMessagetoMembers": $worker="messenger";break;
case "SendMessagetoModerators": $worker="messenger";break;
default: $worker="other";
}
