<?php

$para['integrator::welcome'] = <<<_P
SiteBar ブラウザ統合ページへようこそ。 このページでは SiteBar を有効に活用するためのお手伝いをします。 <a href="http://sitebar.org/">SiteBar ホームページ</a>では SiteBar の各機能についての詳細を確認することができます。
_P;

$para['integrator::header'] = <<<_P
SiteBar は標準仕様に適合するように設計されており JavaScript および Cookie を利用することができるブラウザであればほとんどのブラウザで動作するはずです。 下記の表には動作確認の行われたブラウザが記載されています。

_P;

$para['integrator::usage_opera'] = <<<_P
ブックマークやフォルダに関するコンテキストメニューの呼び出しには右クリックを使用します。
Opera を使っている場合は "ユーザー設定" にある "メニューアイコンの表示" を有効にした上で
ブックマークまたはフォルダの隣にあるアイコンを左クリックする必要があります。
フォルダやブックマークのアイコンの隣に表示されているラベル上で Ctrl+ クリックを行っても同じ動作をします。

_P;

$para['integrator::hint'] = <<<_P
ブラウザへの統合に関する説明を表示する場合は、 上の一覧の中からお使いのブラウザをクリックしてください。 これ以外のブラウザ/プラットフォームに関して動作を確認された場合には<a href="http://brablc.com/mailto?o">ご報告</a>をお願いします。
_P;

$para['integrator::hint_window'] = <<<_P
SiteBar を現在のウィンドウで開くための通常のリンクです。 SiteBar は縦長のバーとしてデザインされています。 そのためこの方法では多くのスペースが無駄になってしまいます。
_P;

$para['integrator::hint_dir'] = <<<_P
ツリーの一部分のような表示です。 SiteBar を従来のディレクトリのように表示することができます。 この表示方法では一度にひとつのディレクトリが表示され各リンクに関する詳細が表示されます。 ブラウザが <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a> をサポートしている必要があります。
_P;

$para['integrator::hint_popup'] = <<<_P
お使いのブラウザにサイドバー機能が搭載されていない場合には、 このブックマークレット&#42; を利用してもよいでしょう。 SiteBar はサイドバーに似たポップアップウィンドウを使って表示されます。 ブラウザの設定によってはポップアップをブロックしている場合がありますのでご注意ください。
_P;

$para['integrator::hint_addpage'] = <<<_P
リンクを SiteBar に追加するためにはこのブックマークレット&#42; を利用するとよいでしょう。 ブックマークレットが実行されると現在表示されているページ関する情報が入力されたポップアップ ウィンドウが新しく開きます。
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <i><a href="http://en.wikipedia.org/wiki/Bookmarklet">ブックマークレット</a>とは JavaScript のコードをブックマーク/お気に入りとして登録したものです。 ブックマークレットは右クリックを使ってブックマーク/お気に入りのツールバーに登録することができます。 登録後はブックマークをクリックすることにより JavaScript のコードが実行されます。</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
SiteBar ブックマーク検索の機能を Web 検索フィールドに追加します。 SiteBar を開かなくても SiteBar に登録されているブックマークを検索することが可能になります。
_P;

$para['integrator::hint_sitebar'] = <<<_P
SiteBar 専用に開発された拡張です。
フォルダ内のすべてのブックマークを個別のタブで開くことができるようになります。
また、 その他の機能も用意されています。
SiteBar アイコンをツールバー上に配置する場合にはメニューから表示/ツールバー/カスタマイズを使用してください。

_P;

$para['integrator::hint_sidebar'] = <<<_P
登録後、クリックすることにより SiteBar をサイドバー パネルで開くことができるブックマークを作成します。
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
SiteBar 全体のフォルダ構造がダウンロードされます。 ブックマークに対しダウンロードされたファイルのインポートを行ってください。 それぞれのフォルダはライブブックマークとして表示されます。 この方法を使った場合、SiteBar に登録したブックマークをその他のブックマークと統合することができますが、 各フォルダの内容は SiteBar からオンラインでダウンロードされることになります。 フォルダ内にサブフォルダが作成されている場合、 実際のフォルダの内容は @Content フォルダに表示されます。
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
サイドバー パネルに SiteBar を追加します。 パネルの表示/非表示は F9 キーで切り替えることができます。 サイドバー内に SiteBar を読み込む際に一定の時間制限を越えた場合には、Mozilla は SiteBar の表示に失敗します。 リンク画像（ファビコン）のキャッシュが行えるよう SiteBar をメイン ウィンドウで開くかまたは「ユーザ別設定」でファビコンの表示をオフにしておいたほうがよいでしょう。
_P;

$para['integrator::hint_hotlist'] = <<<_P
<@>SiteBar をホットリスト パネルで開くためのリンクです。 リンクをクリックすると Opera サイドバーに SiteBar が表示されます。
_P;

$para['integrator::hint_install'] = <<<_P
エクスプローラ バーおよびコンテキスト メニューに SiteBar をインストールします - レジストリの変更を必要とするためすべての機能を使用するためにはシステムの再起動を行う必要があります。 ユーザの権限によってはいくつかの機能がインストールされない可能性があります。
<br>
SiteBar エクスプローラ バーを開く場合はメニューから [表示] - [エクスプローラ バー] を選択するかツール バーの設定を行ない SiteBar パネル切替ボタンをツール バー上に表示させて使用してください。 SiteBar に対してページやリンクを追加する場合には登録したいページのどこかまたは登録したいリンクの上で右クリックを行います。
_P;

$para['integrator::hint_uninstall'] = <<<_P
エクスプローラ バー（上記参照）のアンインストールを行います。
_P;

$para['integrator::hint_searchbar'] = <<<_P
エクスプローラ バーのインストールをおこなうために必要な権限が与えられていない場合にはこのブックマークレット&#42; を使用するとよいでしょう。 このブックマークレットはブラウザの検索エクスプローラ バーを使って一時的に SiteBar を読み込みます。
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
（左側のリンクから）プラグインのダウンロードを行ってください。 ダウンロードしたアーカイブは "C:\Program Files\Maxthon\Plugin" ディレクトリに展開する必要があります。 ブラウザの再起動を行えばエクスプローラ バーの新規項目が追加されているでしょう。
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
（左側のリンクから）プラグインのダウンロードを行ってください。 ダウンロードしたアーカイブは "C:\Program Files\Maxthon\Plugin" に展開する必要があります。 ブラウザを再起動すればプラグイン ツールバー上に新しいアイコンが追加されているはずです。 このアイコンにより現在のタブに表示されているページを SiteBar に追加することができるようになります。
_P;

$para['integrator::hint_gentoo'] = <<<_P
Sitebarパッケージをインストールするには<strong>emerge sitebar</strong>を実行してください。
_P;

$para['integrator::hint_debian'] = <<<_P
Sitebarパッケージをインストールするには<strong>apt-get install sitebar</strong>を実行してください。
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP レイヤ メニューとは DHTML メニューをその場で作成するための階層型メニュー システムです。 データ項目の処理に関しては PHP スクリプト エンジンに依存しています。 SiteBar では特定の構造を持つブックマーク フィードの提供を行うことができます。 fopen を使ってリモート ファイルを開くことが許可されている場合、 次のコードを使って特定の構造を持つファイルを読み込むことができます：
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>/<a href='http://sitebar.org/team.php'>SiteBar チーム</a> サポート <a href='http://sitebar.org/forum.php'>フォーラム</a>/<a href='http://sitebar.org/bugs.php'>バグ</a>管理
_P;

$para['command::welcome'] = <<<_P
%s さん、SiteBar へようこそ！
%s
<p>
リンクの管理を行う際にはフォルダまたはリンクの上で右クリックを行ってください。
<p>
「%s」オプション（「%s」にあります）を有効にすればメニューアイコンを利用することも出来ます。
<p>
すでにログインが行われた状態になっています。
_P;

$para['command::signup_verify'] = <<<_P
<p>
現在ご利用の SiteBar サーバでは SiteBar の各機能を利用する前に有効な email アドレスの登録と登録された email アドレスの照合が必要になります。
<p>
適切な email アドレスの登録を行った後、しばらくするとあなた宛に email が送信されるはずです。 email に記載されているリンクをクリックしてください。
_P;

$para['command::signup_approve'] = <<<_P
<p>
ご利用の SiteBar サーバでは新規作成されたアカウントに対しては管理者による承認が必要です。 承認が行われた後、SiteBar の各機能をご利用いただけるようになります。
<p>
承認作業が行われるまでしばらくお待ちください - 承認の完了は email でお知らせします。
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
ご利用の SiteBar サーバでは有効な email アドレスの登録と登録された email アドレスの照合および管理者によるアカウントの承認が必要です。 email アドレスの照合とアカウントの承認が完了した後、SiteBar の各機能をご利用いただけるようになります。
<p>
登録していただいた email アドレスが適切なものであれば、すぐにあなた宛の email が送信されるはずです。 email に記載されたリンクをクリックし管理者による承認がｓ完了するまでお待ちください - 承認の完了は email でお知らせします。
_P;

$para['command::account_approved'] = <<<_P
管理者によるアカウントの承認が完了しました。
ログインを行う際はユーザー名 %s をお使いください。

--
SiteBar サーバ（%s）
_P;

$para['command::account_rejected'] = <<<_P
アカウント（ユーザー名：%s）の登録依頼は管理者により却下されました。

--
SiteBar サーバ（%s）
_P;

$para['command::account_deleted'] = <<<_P
管理者はこのアカウント（ユーザー名：%s）の利用が行われていないと判断しました。

--
SiteBar サーバ（%s）
_P;

$para['command::reset_password'] = <<<_P
SiteBar アカウント（email アドレス：%s）に対し
パスワードのリセット要求がありました。

このアカウントのパスワードをリセットする場合には、
下記のリンクをクリックしてください：
  %s

--
SiteBar サーバ（%s）
_P;

$para['command::reset_password_hint'] = <<<_P
<p>
ユーザ名または登録に用いた email アドレスを入力してください。 パスワードをリセットするための URL を記載した email が登録された email アドレス宛に送信されます。
email に記載された URL を用いてパスワードのリセットをおこなってください。
_P;

$para['command::contact'] = <<<_P
%s

--
SiteBar サーバ（%s）
_P;

$para['command::contact_group'] = <<<_P
宛先グループ： %s

%s


--
SiteBar サーバ（%s）
_P;

$para['command::delete_account'] = <<<_P
<h3>アカウントを削除しようとしています。本当によろしいですか？</h3>
削除したアカウントを元に戻すことはできません！<p>

_P;

$para['command::email_link_href'] = <<<_P
<p>
既定の e-mail クライアントを使って email の送信を行う場合は、
<a href="mailto:?subject=Web サイト： %s&&body=面白そうな Web　サイトを見つけました。
一度訪ねてみてください： %s
--
このメールは SiteBar サーバー（%s）のブックマーク管理機能を利用して送信されています。
SiteBar についての詳細は http://sitebar.org でご覧になることができます。
">ここ</a>をクリックしてください。
_P;

$para['command::email_link'] = <<<_P
面白そうな Web　サイトを見つけました。
一度訪ねてみてください：
  "%s" %s

%s

--
このメールは SiteBar（%s）を利用して送信されています。
オープンソース ブックマーク サーバ http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
メールアドレスの確認にご協力をお願いします。確認を行うことにより SiteBar のメール機能をご利用いただけるようになります。

下記のリンクをクリックしていただくことにより確認処理が完了します：

 %s

SiteBar ブックマークマネージャーにおいてメール機能を必要としない場合には、このメールを無視していただいて結構です。
_P;

$para['command::verify_email_must'] = <<<_P
SiteBar アカウントの新規登録を行いました。
ご利用の SiteBar サーバーでは SiteBar の利用を始める前に
e-mail の照合を行う必要があります。

下記のリンクをクリックし email の照合を行ってください：
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer では [ファイル] - [インポートおよびエクスポート...] メニューから Netscape ブックマーク ファイル形式のブックマークをインポートすることができます。
ただし、インポートが行えるのは Windows のネイティブ エンコードのファイルだけです。
既定値の UTF-8 エンコードではインポートを行うことができません。<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer では [ファイル] - [インポートおよびエクスポート...] メニューから Netscape ブックマーク ファイル形式でブックマークのエクスポートを行うことができます。
エクスポートされたファイルは Windows のネイティブ エンコード形式になります - インポートの際はコードページの選択を行ってください。
既定値の UTF-8 のままではインポートを行うことはできません。<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
ご利用の SiteBar サーバーにはコードページ変換がインストールされていません。utf-8 および iso-8859-1 のみがサポートされています。
<br>
_P;

$para['command::purge_cache'] = <<<_P
<h3>本当にすべてのファビコンをキャッシュから削除しますか？</h3>
_P;

$para['command::tooltip_allow_contact'] = <<<_P
不特定多数のユーザから管理者への連絡を行えるようにします。
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
このオプションが無効になっている場合、このフォームで指定された検索エンジンがすべてのユーザに対して適用され、ユーザが個別に設定することができなくなります。
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
管理者および所属グループのモデレータからの情報メールを受け取ります。
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
訪問者による新規登録フォームへのアクセスを許可し、SiteBar への登録を行えるようにします。
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
ユーザが独自のグループを作成できるようになります。このオプションが無効の場合、グループを作成することができるのは管理者グループのユーザだけです。
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
ユーザに対し所有権のあるツリーの削除を許可します。
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
ユーザに対し新規ツリーの作成を許可します。
_P;

$para['command::tooltip_approved'] = <<<_P
アカウントは承認されすべての機能を使用することができます。
_P;

$para['command::tooltip_auto_close'] = <<<_P
コマンドが正常に処理された場合には実行ステータスが表示されなくなります。
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
ファビコンが見つからない場合やリンク追加時にファビコンを自動的に取得します。
_P;

$para['command::tooltip_cmd'] = <<<_P
SiteBar へのログインを簡単に行えるようにするため最も重要な SiteBar コマンドを追加します。
_P;

$para['command::tooltip_comment_impex'] = <<<_P
リンクに関する説明文のインポートおよびエクスポートを行うためのコマンドを表示します。
_P;

$para['command::tooltip_comment_limit'] = <<<_P
リンクのコメントに対する最大文字数を指定することができます。 コメントとして小さなサイズのファイルを格納することができます。
_P;

$para['command::tooltip_delete_content'] = <<<_P
フォルダを残してフォルダ内を消去する
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
無効なファビコンが指定された場合、そのファビコンに対する URL を削除します - 利用の際はご注意ください。
_P;

$para['command::tooltip_demo'] = <<<_P
このアカウントをデモ用に設定します。 いくつかの機能が制限されパスワードの変更が行えなくなります。
_P;

$para['command::tooltip_exclude_root'] = <<<_P
可能である場合、出力の中にルート フォルダを含めません。
_P;

$para['command::tooltip_expert_mode'] = <<<_P
詳細オプションを表示しより診断的なメッセージを表示します。
_P;

$para['command::tooltip_extern_commander'] = <<<_P
コマンドを実行する際にポップアップ ウィンドウを使用します - コマンド実行後 SiteBar の再読み込みは行われません。
_P;

$para['command::tooltip_flat'] = <<<_P
１つのフォルダ内のリンクをエクスポートする
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
ブラウザによる XSLT サポートが必要とされる機能を無効にします。
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
このリンクは検証に失敗しました。 このリンクをアクティブなままにしておくこともできます。
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
FIFO スタックです。 最も古いアイコンがシステムから破棄されます - キャッシュのサイズを制御するために使用します。
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
アイコン画像の最大バイト数
_P;

$para['command::tooltip_menu_icon'] = <<<_P
ブラウザ/プラットフォームによっては右クリックの処理を行うことができません。 このオプションを有効にするとコンテキスト メニューの呼び出しに利用するためのアイコンが表示されます。
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
SSL 接続を経由して SiteBar が利用されている場合に限りプライベートリンクの読み込みが行われます。
_P;

$para['command::tooltip_respect'] = <<<_P
ユーザが受け取りを許可している場合にのみ  email を送信します。
_P;

$para['command::tooltip_show_acl'] = <<<_P
セキュリティ指定が行われているフォルダを判別しやすくします。
_P;

$para['command::tooltip_show_logo'] = <<<_P
最上部にロゴを表示します - ホストの処理能力が低い場合には無効にしておいたほうがよいでしょう。 それ以外の場合には広告用に利用することができます。
_P;

$para['command::tooltip_show_statistics'] = <<<_P
SiteBar のメインパネルに登録数やパフォーマンスに関する統計値を表示します。
_P;

$para['command::tooltip_subdir'] = <<<_P
再帰的な処理を行いすべてのリンクとすべてのフォルダをエクスポートします。

_P;

$para['command::tooltip_to_verified'] = <<<_P
照合済みのアドレスに対してのみ email を送信します。
_P;

$para['command::tooltip_use_compression'] = <<<_P
SiteBar が送信するページの圧縮を行ない転送量を少なくすることができます。 圧縮はブラウザ側でサポートされている場合にのみ使用されます。
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
変換エンジン（通常は PHP 用の拡張です）を使ってページを別のエンコード方式に変換します - ブックマークのインポートおよびエクスポートで重要になります。 場合によっては空のページが表示される原因となります。
_P;

$para['command::tooltip_use_favicons'] = <<<_P
ファビコンを使用することにより SiteBar はより見やすいものになりますが表示速度が低下します。 ご利用の SiteBar サーバーがファビコンのキャッシュを使用している場合、ファビコンの表示が非常に速くなります。
_P;

$para['command::tooltip_use_hiding'] = <<<_P
フォルダを非表示にするためのコマンドが使用できるようになります。 非表示機能は他のユーザが公開しているフォルダに対して使用します。
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
PHP の &ldquo;mail&rdquo; 関数が利用できるようになっている場合 - e-mail 関連機能を有効にすることができます。
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
（ファビコンのキャッシュ等）機能によってはサーバーからリモート アドレスへのアクセスを行う必要があります。
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
ブラウザの組み込みツールチップのかわりに SiteBar のツールチップを使用します。 文字数の多いヒントも使用することができ多くのブラウザでサポートされています。
_P;

$para['command::tooltip_use_trash'] = <<<_P
削除の取り消しやパージを行うことができるように削除されたフォルダやリンクをマークします。
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
ユーザは管理者による承認が完了するまで SiteBar にログインすることができなくなります。
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
ユーザは e-mail の照合を完了するまで SiteBar にログインすることができなくなります。
_P;

$para['command::tooltip_verified'] = <<<_P
email が照合済みの場合にはチェックをつけてください。
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
ご利用の SiteBar サーバーでは email の照合を行う必要があります。
email の照合が行われない場合にはアカウントが削除される可能性があります。

_P;

$para['usermanager::signup_info'] = <<<_P
ユーザー %s が SiteBar サーバ（%s）に対して新規登録を行いました。
_P;

$para['usermanager::signup_info_verified'] = <<<_P
ユーザー %s が SiteBar サーバ（%s）に対して新規登録を行いました。
このユーザーは既に email の照合を完了しています。
_P;

$para['usermanager::signup_approval'] = <<<_P
ユーザー %s が SiteBar サーバ（%s）に対して新規登録を行い間s他。

アカウントの承認：
    %s

アカウントの拒否：
    %s

未承認ユーザーの確認：
    %s

_P;

$para['usermanager::signup_approval_verified'] = <<<_P
ユーザー %s が SiteBar サーバー（%s）に対し新規登録を行いました。
このユーザは既に email 照合を終えています。

アカウントの承認：
    %s

アカウントの却下：
    %s

未承認ユーザーの確認：
    %s

_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
ルート {roots_total}。
フォルダ {nodes_shown}/{nodes_total}。
リンク {links_shown}/{links_total}。
ユーザ {users}。
グループ {groups}。
SQL 問い合わせ {queries}。
DB/合計時間 {time_db}/{time_total} 秒 ({time_pct}%)。
_P;

?>
