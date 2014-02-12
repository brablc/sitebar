<?php

$para['command::contact'] = <<<_P
Message:

%s


--
SiteBar 安装至 %s.
_P;

$para['command::contact_group'] = <<<_P
群组: %s
消息:

%s


--
SiteBar 安装至 %s.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>确认要删除帐号么?</h3>
无法恢复这个操作!<p>
所有您遗留的目录树将留给管理员.
_P;

$para['command::email_link_href'] = <<<_P
<@><p>寄一封电子邮件到预设
<a href='mailto:?subject=Web site: %s&amp;body=我找到一个您可能有兴趣的网站。
 到这儿看看： %s
 --
 由 SiteBar at %s 寄出
 开源码 Bookmark Server http://sitebar.org
'>电子邮件客户端</a>

_P;

$para['command::email_link'] = <<<_P
我找到一个您可能有兴趣的网站。
到这儿看看：

    "%s" %s

%s

--
由 SiteBar at %s 寄出
开源码 Bookmark Server http://sitebar.org

_P;

$para['command::verify_email'] = <<<_P
<@>您发送了e-mail验证，允许使用自动合并规则合并群组，允许使用Sitebar的e-mail特性。

请点一下联结来验证您的email:
   %s
_P;

$para['command::noiconv'] = <<<_P
<br>
这 SiteBar server 并未安装编码转换功能。
<br>

_P;

$para['command::security_legend'] = <<<_P
权限:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete
_P;

$para['command::purge_cache'] = <<<_P
<h3>您真的要从缓存里清空所有图标么？</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
您的电邮地址符合以下已关闭的群组的 auto join 规则：
    %s。

您的电邮地址必须先被查证，系统才会认可您的会员资格。请按以下连结查证：%s
_P;

$para['usermanager::signup_info'] = <<<_P
<@>用户「%s」已登记
到您的 SiteBar 系统安装 at %s。

_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
Roots {roots_total}.
Folders {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Users {users}.
Groups {groups}.
SQL queries {queries}.
DB/Total time {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
