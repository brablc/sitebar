<?php

$para['integrator::welcome'] = <<<_P
Добро пожаловать на страницу интегратора. Эта страница поможет вам узнать кое-что о SiteBar.
На <a href="http://sitebar.org/">домашней странице SiteBar</a> вы, конечно, узнаете больше о возможностях SiteBar.
_P;

$para['integrator::header'] = <<<_P
SiteBar совместим со стандартами и должен работать в большинстве современных браузеров с включенными javascript и cookies.
В таблице перечислены протестированные браузеры.
_P;

$para['integrator::usage_opera'] = <<<_P
<@>В SiteBar для вызова контекстного меню ссылок и папок используется правая кнопка мыши. Пользователи Opera должны использовать Ctrl + левая кнопка мыши, либо необходимо включить вызов "Иконки меню" в "Настройках пользователя" и кликать по иконке для вызова меню управления ссылками и папками. Opera не поддерживает <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. Рекомендуется "Скрыть поддержку XSLT" в настройках пользователя.

_P;

$para['integrator::hint'] = <<<_P
Кликните по названию браузера, чтобы посмотреть инструкции по интеграции SiteBar в выбранный браузер.
Пожалуйста, <a href="http://brablc.com/mailto?o">сообщайте</a> другие проверенные браузеры/платформы.
_P;

$para['integrator::hint_window'] = <<<_P
Это обычная ссылка, которая откроет SiteBar в этом же окне.
SiteBar сделан в виде не очень широкой вертикальной панели и занимает не слишком много места в окне браузера. 
_P;

$para['integrator::hint_dir'] = <<<_P
Вместо древовидной структуры, SiteBar может быть представлен как обычная директория.
Т.е. можно увидеть только то, что внутри одной ветки, включая подробности для отображаемых ссылок.
Браузер должен уметь работать с <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Если ваш браузер не позволяет использовать возможности боковых колонок, вы можете попробовать этот bookmarklet&#42;.
SiteBar будет открыт в похожем всплывающем окне. Убедитесь, что ваш браузер не блокирует всплывающие окна (pop-up).
_P;

$para['integrator::hint_addpage'] = <<<_P
Этот bookmarklet&#42; можно использовать для добавления ссылок в ваш SiteBar.
Во всплывающем окне появится информация о текущей странице.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
&#42; <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> закладка, содержащая код JavaScript.
Вы можете кликнуть правой кнопкой мыши и добавить его в вашу панель закладок.
Затем, кликнув по этой закладке, можете выполнить этот JavaScript код.
_P;

$para['integrator::hint_search_engine'] = <<<_P
Добавление SiteBar Bookmark Search в поле Web Search. Позволяет искать в закладках SiteBar,
не открывая сам SiteBar.
_P;

$para['integrator::hint_sitebar'] = <<<_P
<@>Расширение, разработанное специально для SiteBar.
Используйте меню View/Toolbar/Customize для размещения иконки SiteBar на панели инструментов.
[<a href="http://sitebarsidebar.mozdev.org/">Страница проекта</a>]
_P;

$para['integrator::hint_bmsync'] = <<<_P
В случае использования двусторонней синхронизации с Firefox, пожалуйста установите расширение Bookmark Synchronizer.
Используйте команду "Настройки пользователя->Настройки XBELSync" чтобы получить информацию, как настроить синхронизацию.
[<a href="http://sitebar.org/downloads.php">Подробнее</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Добавляет закладку, при клике по которой откроется SiteBar в панели сбоку.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Сохраните структуру папок вашего SiteBar в файл. Импортируйте этот файл в ваши закладки.
Каждая папка будет изображаться как Live Bookmark. Таким образом, ваши закладок будут размещены наряду с уже существовавшими
но содержимое папки будет загружаться с SiteBar сервера.
Если у папки есть подпапки, содержимое этой папки будет показано в папке @Content.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Добавляет SiteBar в боковую панель. Панель включается/выключается по F9.
Если загрузка SiteBar в боковую панель происходит слишком медленно, Mozilla может и не показать его.
Можно открыть SiteBar в основном окне браузера для того, чтобы иконки попали в кэш браузера, либо отключите иконки вовсе в "Настройках пользователя".
_P;

$para['integrator::hint_hotlist'] = <<<_P
<@>Ссылка на SiteBar будет размещена в панели Hotlist. Кликнув по ней можно открыть SiteBar в боковой панели Opera.
_P;

$para['integrator::hint_install'] = <<<_P
Установка SiteBar в Explorer Bar и контекстное меню нуждается в изменении реестра Windows и перезапуска системы.
<br>
Откройте SiteBar Explorer Bar в меню View/Explorer Bar или используя функцию Customize... панели инструментов и включите 
SiteBar Panel с помощью кнопки. Правой кнопкой мыши можно кликнуть в любом месте страницы или по любой ссылке и добавить страницу или эту ссылку в SiteBar.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Удаление Explorer Bar (см.выше)
_P;

$para['integrator::hint_searchbar'] = <<<_P
Использование этого bookmarklet&#42; рекомендуется, если у вас не достаточно привилегий для установки Explorer Bar.
Он временно загружает SiteBar в Search Explorer Bar вашего браузера.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Загрузка плагина (с предустановленным URL). 
Архив должен быть извлечен в директорию "C:\Program Files\Maxthon\Plugin".
После перезапуска браузера появится повый элемент Explorer Bar.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Загрузка плагина (с предустановленным URL). 
Архив должен быть извлечен в директорию "C:\Program Files\Maxthon\Plugin".
После перезапуска браузера в панели Plugin появится иконка. Эта иконка позволит добавить страницу из таба добавить в SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Выполните команду <strong>emerge sitebar</strong> для установки пакета SiteBar.
_P;

$para['integrator::hint_debian'] = <<<_P
Выполните команду <strong>apt-get install sitebar</strong> для установки пакета SiteBar.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu система иерархического меню для создания "на лету" DHTML меню, связанного с PHP скриптом подготавливающим элементы данных.
SiteBar выстраивает правильную структуру закладок. Если fopen позволяет открывать удаленные файлы, следующий код загрузит файл в правильную структуру:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright &#169; 2003-2005 <a href="http://brablc.com/">Ondřej Brablc</a> и <a href="http://sitebar.org/team.php">SiteBar Team</a>. Поддержка <a href="http://sitebar.org/forum.php">Форум</a> и <a href="http://sitebar.org/bugs.php">bug tracking</a>.
_P;

$para['command::welcome'] = <<<_P
%s, Добро пожаловать в SiteBar!
%s
<p>
SiteBar управляется через контекстное меню, вызываемое с помощью клика правой кнопки мышки по папке или ссылке.
Если ваш браузер/платформа не позволяют использовать правую кнопку, можно попробовать Ctrl-click или включить "Показать иконку меню" в настройках и для вызова меню пользоваться иконкой. 
<p>
Подробнее о SiteBar можно узнать в разделе "Помощь".
<p>
Собствено, Вы уже авторизованы.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Перед использованием SiteBar, система проверит ваш e-mail.
<p>
Если введенный вами при регистрации e-mail существует, вы получите короткое письмо.
Пожалуйста, откройте присланную вам ссылку.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Ваш аккаунт должен быть подтвержден администратором.
<p>
Пожалуйста, дождитесь e-mail от администратора SiteBar.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Перед использованием SiteBar, система проверит ваш e-mail, кроме этого ваш аккаунт должен быть одобрен администратором.
<p>
Если введенный вами при регистрации e-mail существует, вы получите короткое письмо.
Пожалуйста, откройте присланную вам ссылку и ожидайте e-mail от администратора SiteBar.
_P;

$para['command::account_approved'] = <<<_P
Администратор подтвердил ваш запрос на создание аккаунта.
Вы можете авторизоваться, используя ваше имя пользователя %s.

--
SiteBar на сайте %s.
_P;

$para['command::account_rejected'] = <<<_P
Администратор отклонил ваш запрос на создание аккаунта именем пользователя %s.

--
SiteBar на сайте %s.
_P;

$para['command::account_deleted'] = <<<_P
Администратор удалил ваш аккаунт с именем пользователя %s.

--
SiteBar на сайте %s.
_P;

$para['command::reset_password'] = <<<_P
Для e-mail "%s" поступил запрос об изменении пароля.

Если вы действительно желаете изменить пароль, кликните по ссылке:
    %s

--
SiteBar на сайте %s.
_P;

$para['command::reset_password_hint'] = <<<_P
<p>
Пожалуйста, напишите Ваше имя пользователя или e-mail, указанный при регистрации.
Ключ будет отправлен на e-mail, указанный при регистрации.
Используйте этот ключ, чтобы сменить пароль.
_P;

$para['command::contact'] = <<<_P
%s


--
SiteBar на сайте %s.
_P;

$para['command::contact_group'] = <<<_P
Целевая группа: %s

%s


--
SiteBar на сайте %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>Вы действительно желаете удалить аккаунт?</h3>
Эта операция необратима!<p>
Все ваши оставшиеся деревья будут переданы администратору системы.
_P;

$para['command::email_link_href'] = <<<_P
<p>Нажмите <a href="mailto:?subject=Веб-сайт: %s&body=Я нашел веб-сайт, возможно он покажется тебе интересным.
Посмотри: %s
-- Отправлено Менеджером Закладок SiteBar %s
Узнайте больше о SiteBar на http://sitebar.org ">сюда</a>, чтобы отправить письмо, используя Ваш почтовый клиент.
_P;

$para['command::email_link'] = <<<_P
Я нашел веб-сайт, возможно он покажется тебе интересным.
Посмотри:

    "%s" %s

%s

--
Отправлено Менеджером Закладок SiteBar %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
От вас поступил запрос на проверку e-mail, который автоматически позволяет участие в группах,
 т.к. соответствует правилам для групп.

Пожалуйста, кликните по ссылке для подтверждения вашего e-mail:
    %s
_P;

$para['command::verify_email_must'] = <<<_P
Вы зарегистрировались на сервере SiteBar. Перед началом использования сервиса требуется проверка e-mail.

Пожалуйста, кликните по ссылке для продолжения:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer может импортировать закладки из формата Netscape Bookmark File (в меню "File/Import and Export ...")
Однако, выберите кодировку вашей версии Windows, UTF-8 по умолчанию работать не будет.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer может экспортировать закладки в формат Netscape Bookmark File (в меню "File/Import and Export ...")
Экспортируемый файл в оригинальной кодировке Windows - пожалуйста, при импорте файла выберите кодировку, UTF-8 по умолчанию работать не будет.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Перекодировка страниц не установлена на этом сервере. Поддерживается только utf-8 и iso-8859-1.
<br>
_P;

$para['command::security_legend'] = <<<_P
Права: 
<strong>R</strong>ead, 
<strong>A</strong>dd, 
<strong>M</strong>odify, 
<strong>D</strong>elete, 
<strong>P</strong>urge, 
<strong>G</strong>rant
_P;

$para['command::purge_cache'] = <<<_P
<h3>Вы действительно хотите очистить кэш иконок?</h3>
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Разрешить пользователям добавлять себя в группу.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Разрешить загрузку закладок неавторизованным пользователям. Можно обойти, зная конструкцию URL!
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Разрешать анонимным пользователям обращаться к администратору.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Разрешить не участвующим в группе общение с модератором группы.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Если не разрешено, все пользователи должны использовать установленную в этой форме поисковую машину и не могут ее изменить.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Разрешить модераторам добавлять меня в их группы.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Разрешать админам и модераторам группы, в которой я состою отправлять мне информационные email.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Разрешить посетителям доступ к форме регистрации и регистрацию в SiteBar.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Пользователям разрешается создавать собственные группы. Иначе, это разрешено только администратору.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Разрешить пользователям удалять их существующие деревья.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Разрешить пользователям создавать дополнительные деревья.
_P;

$para['command::tooltip_approved'] = <<<_P
Аккаунт допущен и может использовать все разрешенные возможности системы.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Если все прошло удачно, не показывать результат выполнения команды.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Искать иконку favicon автоматически, когда ее нет при добавлении ссылки.
_P;

$para['command::tooltip_baseurl'] = <<<_P
URL без указания на эту инсталляцию.
_P;

$para['command::tooltip_cmd'] = <<<_P
Добавьте важные команды SiteBar для простой авторизации в SiteBar.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Показывать команды импорта и экспорта описаний ссылок.
_P;

$para['command::tooltip_comment_limit'] = <<<_P
Если возможно, определите максимальную длину для комментариев к ссылкам. Если возможно, храните маленькие файлы, как описания.
_P;

$para['command::tooltip_default_folder'] = <<<_P
В следущий раз использования bookmarklet, эта папка будет установлена по умолчанию.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Удалить только содержимое папки, предпочтительнее удаления всей папки.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Удалить URL иконки из ссылки, если она повреждена - использовать с осторожностью.
_P;

$para['command::tooltip_demo'] = <<<_P
Перевести этот аккаунт в demo-режим с ограниченной функциональностью и невозможностью смены пароля.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Попытаться проанализировать страницу и поискать отсутствующие иконки (shortcut icons).
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Не включая корневую папку, по возможности.
_P;

$para['command::tooltip_expert_mode'] = <<<_P
Показать расширенное управление и больше диагностических сообщений.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Выполнять команды, используя внешнее окно - без перезагрузки после каждой команды..
_P;

$para['command::tooltip_filter_groups_limit'] = <<<_P
Когда количество групп исчерпает этот лимит, будет использован фильтр для поиска групп.
_P;

$para['command::tooltip_filter_users_limit'] = <<<_P
Когда количество пользователей исчерпает этот лимит, будет использован фильтр для поиска пользователей.
_P;

$para['command::tooltip_flat'] = <<<_P
Экспорт всех ссылок в одну папку.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Скрывать особенности системы, которые требуют от браузера поддержки XSLT.
_P;

$para['command::tooltip_hits'] = <<<_P
Направлять все клики по ссылкам через SiteBar для сбора статистики кликов.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Не проверять недавно проверенные ссылки - используется при повторной проверке, если она не была завершена.
_P;

$para['command::tooltip_integrator_url'] = <<<_P
По умолчанию SiteBar использует интегратор с my.sitebar.org. Если возможно, из соображений безопасности используйте локальный интегратор.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Эта ссылка не проходит проверку. Может желаете ее все-равно сделать активной?
_P;

$para['command::tooltip_is_feed'] = <<<_P
Отметьте ссылку как "новостная лента" - ссылка будет открыта в фидридере(если указан адрес) прямо в окне браузера.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Как долго иконка находится в кэше до момента ее обновления с удаленного сервера.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
FIFO stack. Старые иконки будут удаляться из системы - используется для управления размером кэша.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Максимально допустимый размер иконок в байтах.
_P;

$para['command::tooltip_max_session_time'] = <<<_P
Администратор может установить максимально допустимое время сессии. Когда время истечет, пользователю необходимо перелогиниться.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Некоторые браузеры/платформы не обрабатывают клик правой кнопкой. Вместо этого можно использовать иконку для вызова контекстных меню.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Папки следуют перед ссылками или наоборот в дереве SiteBar.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Не проверять эту ссылку - используется для ссылок в интранет или при проблемах с проверкой ссылок.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Применить операцию только к содержимому папки, но не к самой папке.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Включить режим SiteBar, предназначенный для инсталляции единственному пользователю.
_P;

$para['command::tooltip_private'] = <<<_P
Игнорировать личные ссылки в экспорте. Личные ссылки всегда игнорируются для всех, кроме владельца.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Личные ссылки будут загружены только если SiteBar использует соединение через SSL.
_P;

$para['command::tooltip_publish'] = <<<_P
Опубликовать эту папку, чтобы все могли ее увидеть.
_P;

$para['command::tooltip_rename'] = <<<_P
При импорте дублировать ссылки, чтобы все были загружены.
_P;

$para['command::tooltip_respect'] = <<<_P
Отправлять почту только если пользователь разрешил прием писем от сервиса.
_P;

$para['command::tooltip_search_engine_ico'] = <<<_P
Иконка появится в панели SiteBar и приведет к поиску в веб.
_P;

$para['command::tooltip_search_engine_url'] = <<<_P
URL движка, используемого для поиска. Напишите %SEARCH% в месте, где должна быть поисковая фраза.
_P;

$para['command::tooltip_sender_email'] = <<<_P
Письма, созданные SiteBar будут отправлены с этого адреса.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Раскрасить папки в соответствии со спецификацией безопасности.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Показывать лого наверху - может быть отключен на медленном хостинге, иначе должен показываться для рекламы.
_P;

$para['command::tooltip_show_public'] = <<<_P
Показать закладки, опубликованные другими пользователями.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Показывать некоторую статичную и динамическую статистику на панели SiteBar.
_P;

$para['command::tooltip_subdir'] = <<<_P
Экспорт всех ссылок и всех папок.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Проверка этой папки затронет и все подпапки.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Отправлять почту только по проверенным адресам.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Страницы, отправлевленные SiteBar могут быть сжаты для экономии трафика. Компрессия используется только если поддерживается на стороне браузера.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Использовать перекодировку (обычно extension for PHP) для перевода страниц в другую кодировку - важно для импорта/экспорта закладок. В некоторых случаях это может привести к пустому экрану.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Иконки (favicon) будут загружены на сервер в кэш базы данных. Увеличение трафика и поднятие скорости кэша иконок можно уменьшением количества подключений.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Использование иконок делает SiteBar красивее, но медленнее. При использовании кэша иконок скорость работы несколько увеличится.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Разрешить команду скрывать папки. Опубликованные папки можно скрывать от других пользователей.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
В случае, если на сервере разрешена отправка email средствами PHP ("mail" function) - e-mail функции могут быть включены и использованы.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Некоторые функции (favicon cache)нуждаются в доступе к удаленным адресам от вашего сервера.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Поиск будет перенаправлен или дополнен результатами, представленными Вашей любимой поисковой машиной.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Найденное Вашей поисковой машиной будет добавлено на страницу результатов поиска SiteBar с помощью iframe.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Использовать подсказки SiteBar вместо подсказок браузера. Разрешены длинные подсказки и показываются в большинстве браузеров.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Помечать удаленные папки и ссылки, чтобы их можно было восстановить или очистить.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Пользователь должен быть разрешен администратором перед использованием SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
E-mail пользователя должен быть проверен перед использованием SiteBar.
_P;

$para['command::tooltip_verified'] = <<<_P
Отметьте, чтобы email стал проверенным.
_P;

$para['command::tooltip_version_check_interval'] = <<<_P
SiteBar может периодически проверять доступность новой версии. Это особенно важно, когда обнаруживаются уязвимости в текущей версии. Требуется исходящее соединение.
_P;

$para['command::tooltip_web_search_user_agents'] = <<<_P
Регулярное выражение для User Agents, написанное специально не на javascript.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Этот SiteBar сервер требует проверки email.
Пожалуйста, проверьте и подтвердите email, иначе ваш аккаунт будет удален.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Ваш e-mail позволяет автоматическое включение в следующие закрытые группы:
    %s.

Если подтверждаете готовность участия в группах, ваш е-mail должен быть проверен.
Кликните по ссылке, чтобы произвести проверку:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Пользователь %s зарегистрировался на вашем SiteBar сервере  %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Пользователь %s  зарегистрировался на вашем SiteBar сервере %s.
E-mail пользователя уже проверен.
_P;

$para['usermanager::signup_approval'] = <<<_P
Пользователь %s  зарегистрировался на вашем SiteBar сервере %s.

Разрешить аккаунт :
    %s

Отклонить аккаунт:
    %s

Посмотреть ожидающих пользователей:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Пользователь %s  зарегистрировался на вашем SiteBar сервере %s.
Email пользователя уже проверен.

Разрешить аккаунт :
    %s

Отклонить аккаунт:
    %s

Посмотреть ожидающих пользователей:
    %s
_P;


$para['usermanager::alert'] = <<<_P
%s
_P;
