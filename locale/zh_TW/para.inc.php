<?php

$para['integrator::welcome'] = <<<_P
歡迎使用 SiteBar 整合工具箱。這個頁面將會幫助你使用 SiteBar 的大部份功能。
你可以在<a href="http://sitebar.org/">SiteBar首頁</a>學到更多 SiteBar 的功能。
_P;

$para['integrator::header'] = <<<_P
SiteBar 是遵循標準設計而成的。在大部份有支援 Javascript 和 cookies
的瀏覽器上應該都能使用。以下的表格列出已被測試過的瀏覽器。
_P;

$para['integrator::usage_opera'] = <<<_P
<@>SiteBar 的連結及資料夾可使用滑鼠右鍵來打開快顯功能表。
Opera 的使用者必須啟用「使用者設定」裡的「選單圖示」而且
點選的時候要改點連結及資料夾旁的小圖示。此外，Opera 不支援
<a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>。
建議 Opera 的使用者勾選「個人資料及喜好設定」中的「隱藏 XSLT 功能」。
_P;

$para['integrator::hint'] = <<<_P
點擊瀏覽器的名稱來了解整合的步驟。
並請<a href="http://brablc.com/mailto?o">回報</a>其它已驗證過的瀏覽器/平台。
_P;

$para['integrator::hint_window'] = <<<_P
這是一個把 SiteBar 在目前視窗的連結。由於 SiteBar 是被設計成使用直式的工具列，
用整個視窗來開啟 SiteBar 會浪費許多空間。

_P;

$para['integrator::hint_search_engine'] = <<<_P
把 SiteBar 書籤搜尋功能加到網頁搜尋列。如此一來，
你就可以搜尋 SiteBar 裡面書籤而不用打 SiteBar 打開。
_P;

$para['integrator::hint_hotlist'] = <<<_P
<@>一個連往 SiteBar 的連結會被顯示在 Hotlist 面板。點擊它後，SiteBar會被打開在 Opera 的側邊工具列。
_P;

$para['integrator::hint_gentoo'] = <<<_P
執行指令 <strong>emerge sitebar</strong> 以安裝 SiteBar 套件。
_P;

$para['integrator::hint_debian'] = <<<_P
執行指令 <strong>apt-get install sitebar</strong> 以安裝 SiteBar 套件。
_P;

$para['integrator::copyright3'] = <<<_P
版權所有 � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>以及<a href='http://sitebar.org/team.php'>SiteBar 團隊</a>。
技術支援 <a href='http://sitebar.org/forum.php'>論壇</a> 及 <a href='http://sitebar.org/bugs.php'>錯誤報告</a>。
_P;

$para['command::signup_verify'] = <<<_P
<p>
這個 SiteBar 伺服器在驗證你的電子郵件信箱後才會開放 SiteBar 的各項功能。
<p>
當你設定正確的電子郵件信箱後，你將會很快收到一幫通知郵件。
屆時，請你點擊信中所提供的連結。
_P;

$para['command::signup_approve'] = <<<_P
<p>
這個 SiteBar 伺服器的新使用者必須被系統管理者核可後才能使用 SiteBar 的各項功能。
<p>
請耐心等待系統管理者審核。屆時，你會收到電子郵件通知。
_P;

$para['command::account_approved'] = <<<_P
<@>系統管理者已經核可你的帳號申請。
你可以用你的電子郵件地址 %s 登入。

--
SiteBar 伺服器於 %s
_P;

$para['command::account_rejected'] = <<<_P
<@>系統管理者已經拒絕你使用電子郵件地址 %s 的帳號申請。

--
SiteBar 伺服器於 %s
_P;

$para['command::account_deleted'] = <<<_P
<@>系統管理者已經刪除你用電子郵件信箱 %s 所註冊的帳戶。

--
SiteBar 伺服器於 %s。
_P;

$para['command::contact'] = <<<_P
%s


--
SiteBar 伺服器於 %s
_P;

$para['command::contact_group'] = <<<_P
目標群組： %s

%s

--
SiteBar 伺服器於 %s
_P;

$para['command::delete_account'] = <<<_P
<@><h3>你確定要刪除你的帳戶嗎？</h3>
你將不能復原這個變更！<p>
所有目錄樹將會轉移到系統管理員那裡。
_P;

$para['command::email_link_href'] = <<<_P
<@><p>寄一封電子郵件到預設
<a href='mailto:?subject=Web site: %s&amp;body=我找到一個你可能有興趣的網站。
 到這兒看看： %s
 --
 由 SiteBar at %s 寄出
 開放源始碼的書籤伺服器 http://sitebar.org
'>電子郵件用戶端</a>
_P;

$para['command::email_link'] = <<<_P
我找到一個你可能有興趣的網站。
到這兒看看：

    "%s" %s

%s

--
由 SiteBar at %s 寄出
開源碼 Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
<@>You have requested e-mail validation that allows joining of
groups with auto join regular expressions and allows you to
make use of SiteBar's e-mail features.

Please click on the following link to verify your email:
    %s
_P;

$para['command::noiconv'] = <<<_P
<br>
這個 SiteBar 伺服器並未安裝編碼轉換功能。
<br>
_P;

$para['command::security_legend'] = <<<_P
權限:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete
_P;

$para['command::purge_cache'] = <<<_P
<h3>你確定要移除快取內的所有網頁小圖示嗎？</h3>
_P;

$para['command::tooltip_allow_addself'] = <<<_P
允許使用者把自己加入這個群組。
_P;

$para['command::tooltip_allow_contact'] = <<<_P
允許系統管理員被匿名使用者連絡。
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
允許群組管理者被非會員連絡。
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
允許群組管理者把我加入他們的群組。
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
允許系統管理者和我所屬群組的管理者寄新資訊郵件給我。
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
允許使用者刪除他們的的目錄樹。
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
允許使用者建立新的目錄樹。
_P;

$para['command::tooltip_approved'] = <<<_P
帳號已被核可，可以自由地使用了。
_P;

$para['command::tooltip_auto_close'] = <<<_P
如果指令執行成功的話，不要顯示執行狀態。
_P;

$para['command::tooltip_cmd'] = <<<_P
增加最重要的 SiteBar 指令以讓使用者更容易登入到 SiteBar。
_P;

$para['command::tooltip_delete_content'] = <<<_P
刪除資料夾的內容，保留該資料夾。
_P;

$para['command::tooltip_demo'] = <<<_P
建立一個展示用的帳戶。這個帳戶只有有限的功能，而且不能更改密碼。
_P;

$para['command::tooltip_flat'] = <<<_P
匯入這些連結到同一個資料夾。
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
最大的圖示大小(以位元表示)。
_P;

$para['command::tooltip_respect'] = <<<_P
只送電子郵件給已同意的使用者。
_P;

$para['command::tooltip_subdir'] = <<<_P
遞迴地匯出所有的連結和資料夾。
_P;

$para['command::tooltip_subfolders'] = <<<_P
遞迴地驗證這個資料夾以及它的子資料夾。
_P;

$para['command::tooltip_to_verified'] = <<<_P
只送電子郵件給驗證過的地址。
_P;

$para['command::tooltip_use_trash'] = <<<_P
標示被刪除的資料夾和連結，以便之後可以反刪除或是永久移除。
_P;

$para['command::tooltip_verified'] = <<<_P
檢查這個以標記該電子郵件信箱已被驗證。
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
這個 SiteBar 伺服器要求驗證你的電子郵件信箱。
請驗證電子郵件信箱，否則帳號可能會被刪除。
_P;

$para['usermanager::auto_verify_email'] = <<<_P
你的電子郵件地址符合以下已關閉的群組的自動加入規則：
    %s。

你的電子郵件地址必須先被驗證，系統才會核准你的會員資格。請按以下連結驗證：%s
_P;

$para['usermanager::signup_info'] = <<<_P
<@>使用者「%s」已註冊到你的 SiteBar 伺服器於 %s。
_P;

$para['usermanager::signup_info_verified'] = <<<_P
<@>使用者 「%s」 <%s> 已在你的 SiteBar 伺服器 %s 註冊。
這位使用者也已經驗證過他的電子郵件信箱地址了。
_P;

$para['usermanager::signup_approval'] = <<<_P
<@>使用者 「%s」 <%s> 已在你的 SiteBar 伺服器 %s 註冊。

核可的帳號：
  %s

拒絕的帳號：
  %s

未審核的使用者：
  %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
<@>使用者 「%s」 <%s> 已在你的 SiteBar 伺服器 %s 註冊。
這位使用者已經驗證他的電子郵件信箱。

核可的帳號：
  %s

拒絕的帳號：
  %s

未審核的使用者：
  %s
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['messenger::cancel'] = <<<_P
設消
_P;

$para['messenger::delete'] = <<<_P
刪除
_P;

$para['messenger::expire'] = <<<_P
到期
_P;

$para['messenger::read'] = <<<_P
已讀取
_P;

$para['messenger::unread'] = <<<_P
未讀取
_P;

$para['messenger::save'] = <<<_P
儲存
_P;

$para['messenger::seen'] = <<<_P
已閱讀的
_P;

$para['messenger::deleted'] = <<<_P
被刪除的
_P;

$para['messenger::expired'] = <<<_P
過期的
_P;

$para['hook::statistics'] = <<<_P
目錄樹 {roots_total}。
資料夾 {nodes_shown}/{nodes_total}。
連結 {links_shown}/{links_total}。
使用者 {users}。
群組 {groups}。
SQL查詢 {queries}。
資料庫/所有時間 {time_db}/{time_total} 秒 ({time_pct}%)。
_P;

?>
