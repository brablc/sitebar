<?php

$para['integrator::welcome'] = <<<_P
SiteBar 연동 페이지에 오신 것을 환영합니다. 이 페이지는 SiteBar를 가장 쉽게 사용할 수 있도록 하는 방법에 대해 설명합니다. SiteBar 기능에 대한 것은<a href="http://sitebar.org/">SiteBar 홈페이지</a>에서 찾을 수 있습니다.
_P;

$para['integrator::header'] = <<<_P
SiteBar는 표준을 준수하도록 설계되어 있으며 자바스크립트와 쿠키를 사용할 수 있는 대부분의 브라우저에서 동작합니다. 어떤 브라우저에 대해 테스트가 완료되었는지는 다음 테이블에 나타나 있습니다.
_P;

$para['integrator::usage_opera'] = <<<_P
<@>SiteBar는 링크와 폴더에 대한 팝업 메뉴 호출을 위해 오른클릭을 사용합니다. Opera 사용자는 Ctrl+왼쪽클릭을 사용하거나, "사용자 설정"에서 "메뉴 아이콘"을 활성화한 뒤, 링크 또는 폴더 아이콘 옆에 있는 아이콘을 클릭해야 합니다. Opera는 <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>를 지원하지 않습니다. "사용자 설정"에서 XSLT 관련 기능의 사용을 끄는 것이 좋습니다.
_P;

$para['integrator::hint'] = <<<_P
브라우저의 이름을 클릭하면 해당 브라우저에서 SiteBar를 연동하는 방법을 볼 수 있습니다.
다른 브라우저/플랫폼에서 동작을 확인했을 경우에는 <a href="http://brablc.com/mailto?o">여기</a>에서 알려주시길 부탁드립니다.
_P;

$para['integrator::hint_window'] = <<<_P
현재 윈도우에서 SiteBar를 여는 평범한 링크입니다.
SiteBar는 세로로 다소 좁은 바 형태로 디자인되어 있습니다. 그러므로 이 방법은 많은 공간을 낭비하게 됩니다.
_P;

$para['integrator::hint_dir'] = <<<_P
트리 모양 출력과는 별개로, SiteBar는 고전적인 디렉토리 형태로 출력할 수 있습니다.
이 경우에는 한번에 한 디렉토리만 보여지며 출력된 링크의 상세 내용을 보여줍니다.
브라우저가 <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>를 지원해야만 합니다.
_P;

$para['command::contact'] = <<<_P
메시지:

%s

--
%s에 설치된 SiteBar로부터 전달된 것입니다.
_P;

$para['command::contact_group'] = <<<_P
그룹: %s
메시지:

%s

--
%s에 설치된 SiteBar로부터 전달된 것입니다.
_P;

$para['command::delete_account'] = <<<_P
<@><h3>정말로 당신의 계정을 삭제하시겠습니까?</h3>
나중에 다시 복구할 방법이 없습니다!<p>
당신이 아직 가지고 있는 모든 트리는 시스템 관리자에게 주어질 것입니다.

_P;

$para['command::email_link_href'] = <<<_P
<p>기본 <a href="mailto:?subject=웹사이트 안내: %s&body=당신이 관심있을만한 웹사이트를 찾았습니다.
 한번 들어가보세요 : %s
 --
 %s에 설치된 SiteBar에서 보내진 것입니다.
 SiteBar에 대한 것은 http://sitebar.org
">메일 클라이언트</a>를 사용해서 메일을 보냅니다.
_P;

$para['command::email_link'] = <<<_P
당신이 관심있을만한 웹사이트를 찾았습니다.
 한번 들어가보세요 :

   "%s" %s

%s

--
 %s에 설치된 SiteBar에서 보내진 것입니다.
 Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
<@>자동 가입 정규식을 사용한 그룹 가입과 SiteBar의 메일 관련 기능을 사용하기 위해 메일 주소 확인을 요청했습니다.

메일 주소를 확인하기 위해서는 다음 링크를 클릭해 주세요.
   %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer는 Netscape 북마크 파일 형식에서 북마크를 가져오거나 내보낼 수 있습니다. 그렇지만 그 파일은 반드시 윈도우 인코딩을 사용해야 하며, 기본 설정인 UTF-8은 동작하지 않을 것입니다.
_P;

$para['command::noiconv'] = <<<_P
<br>현재 SiteBar 서버에는 코드페이지 변환이 설치되어있지 않습니다.<br>
_P;

$para['command::security_legend'] = <<<_P
권한: 읽기(<strong>R</strong>), 추가(<strong>A</strong>), 편집(<strong>M</strong>), 삭제(<strong>D</strong>)
_P;

$para['command::purge_cache'] = <<<_P
<h3>정말로 캐시에서 모든 아이콘을 지우시겠습니까?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
당신의 메일 주소는 다음의 제한 그룹에서 사용하는 자동 가입을 위한 규칙에 맞는 주소입니다.
   %s

회원가입을 승인하기 위해서는 메일 주소를 확인해야 합니다. 메일 주소 확인을 위해서 다음 링크를 클릭해주세요.
   %s
_P;

$para['usermanager::signup_info'] = <<<_P
사용자 %s는 %s에 설치된 SiteBar에 가입하였습니다.
_P;

$para['usermanager::alert'] = <<<_P
%s
_P;

$para['hook::statistics'] = <<<_P
최상위 {roots_total}.
폴더 {nodes_shown}/{nodes_total}.
링크 {links_shown}/{links_total}.
사용자 {users}.
그룹 {groups}.
SQL 질의 {queries}.
DB/총 시간 {time_db}/{time_total} 초 ({time_pct}%).
_P;

?>
