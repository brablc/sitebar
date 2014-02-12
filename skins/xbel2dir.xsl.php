<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software: you can redistribute it and/or modify      *
 *  it under the terms of the GNU Affero General Public License as published  *
 *  by the Free Software Foundation, either version 3 of the License, or      *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU Affero General Public License for more details.                       *
 *                                                                            *
 *  You should have received a copy of the GNU Affero General Public License  *
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 ******************************************************************************/

    header('Content-Type: application/xml; charset=utf-8');
    require_once('./inc/localizer.inc.php');
    require_once('./inc/errorhandler.inc.php');
    require_once('./inc/page.inc.php');
    require_once('./inc/usermanager.inc.php');

    $baseurl = str_replace('skins','',SB_Page::absBaseUrl());
    $um = SB_UserManager::staticInstance();
    $dirurl = $baseurl.($um->getParam('config','use_nice_url')?"dir/":"index.php?w=dir&amp;root=");

?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output
    method="html"
    version="4.01"
    encoding="utf-8"
    indent="yes"
    omit-xml-declaration="yes"
    doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" />

<xsl:template match="/">
  <html>
    <head>
      <title>
    <xsl:value-of select="xbel/title" />
      </title>
    <xsl:element name="link">
      <xsl:attribute name="rel">StyleSheet</xsl:attribute>
      <xsl:attribute name="href">
         <xsl:value-of select="xbel/info/metadata/@style" />
      </xsl:attribute>
      <xsl:attribute name="type">text/css</xsl:attribute>
      <xsl:attribute name="media">all</xsl:attribute>
    </xsl:element>
    <xsl:element name="script">
      <xsl:attribute name="type">text/javascript</xsl:attribute>
      <xsl:attribute name="src"><?php echo SB_Page::absBaseUrl()."skins/sitebar.js?version=".STATIC_VERSION ?></xsl:attribute>
    </xsl:element>
    </head>

    <body class="siteBar siteBarBaseFont siteBarPageBackground">
      <div style="display: none" id="sb_absBaseUrl"><?php echo SB_Page::absBaseUrl() ?></div>
      <div class="title cmnTitleColorInverse">
      <xsl:value-of select="xbel/title" />
      </div>
      <xsl:if test="/xbel/folder/@id != 'n'">
        <xsl:call-template name="displayBack" />
      </xsl:if>
      <xsl:for-each select="xbel/folder/*">
        <xsl:choose>
          <xsl:when test="local-name(.)='folder'">
            <xsl:call-template name="displayFolder" />
          </xsl:when>
          <xsl:when test="local-name(.)='bookmark'">
            <xsl:call-template name="displayBookmark" />
          </xsl:when>
        </xsl:choose>
      </xsl:for-each>
      <div class="footer cmnTitleColorInverse">
      <xsl:text><?php echo SB_T('Bookmarks from SiteBar installation at')?> </xsl:text>
      <xsl:element name="a">
        <xsl:attribute name="class">
          <xsl:value-of select="'url'" />
        </xsl:attribute>
        <xsl:attribute name="href">
          <xsl:value-of select="'<?php echo $baseurl?>'" />
        </xsl:attribute>
        <xsl:text><?php echo $baseurl; ?></xsl:text>
      </xsl:element>
      </div>
    </body>
  </html>
</xsl:template>

<xsl:template name="displayBack" match="folder">
  <div class="folder">
  <xsl:element name="img">
    <xsl:attribute name="src">
      <xsl:value-of select="/xbel/info/metadata/@imgnodeopen" />
    </xsl:attribute>
  </xsl:element>
  <xsl:text>&lt;</xsl:text>
  <xsl:element name="a">
    <xsl:attribute name="href">
      <xsl:choose>
        <xsl:when test="/xbel/folder/@id_parent='n0'">
          <?php echo $dirurl ?>
        </xsl:when>
        <xsl:otherwise>
          <xsl:value-of select="concat('<?php echo $dirurl ?>',substring(/xbel/folder/@id_parent,2))" />
        </xsl:otherwise>
      </xsl:choose>
    </xsl:attribute>
    <xsl:text><?php echo SB_T("Up")?></xsl:text>
  </xsl:element>
  <xsl:text>&gt;</xsl:text>
  </div>
</xsl:template>

<xsl:template name="displayFolder" match="folder">
  <div class="folder">
  <xsl:element name="img">
    <xsl:attribute name="src">
      <xsl:value-of select="/xbel/info/metadata/@imgnode" />
    </xsl:attribute>
  </xsl:element>
  <xsl:element name="a">
    <xsl:attribute name="href">
        <xsl:value-of select="concat('<?php echo $dirurl?>',substring(./@id,2))" />
    </xsl:attribute>
    <xsl:value-of select="./title" />
  </xsl:element>
  (<xsl:value-of select="count(./folder)" />/<xsl:value-of select="count(./bookmark)" />)
<?php if (!$um->isAnonymous()) : ?>
  <span class="info">
  [<xsl:element name="a">
    <xsl:attribute name="href">
      <xsl:value-of select="concat('<?php echo $baseurl ?>command.php?command=Folder%20Properties&amp;nid_acl=',substring(@id,2))" />
    </xsl:attribute>
    <xsl:value-of select="'<?php echo SB_T('Properties'); ?>'" />
  </xsl:element>,
  <xsl:element name="a">
    <xsl:attribute name="href">
      <xsl:value-of select="concat('<?php echo $baseurl?>index.php?root=',substring(@id,2))" />
    </xsl:attribute>
    <xsl:value-of select="'<?php echo SB_T('SiteBar'); ?>'" />
  </xsl:element>]
  </span>
<?php endif; ?>
  <xsl:if test="string-length(./desc) > 0">
    <div class="desc">
      <xsl:value-of select="./desc" />
    </div>
  </xsl:if>
  </div>
</xsl:template>

<xsl:template name="displayBookmark" match="bookmark">
  <div class="bookmark">
  <xsl:element name="a">
    <xsl:if test="./@is_dead = 1">
      <xsl:attribute name="class">
          <xsl:value-of select="'dead'" />
      </xsl:attribute>
    </xsl:if>
    <xsl:attribute name="href">
      <xsl:value-of select="./@href" />
    </xsl:attribute>
    <xsl:attribute name="onmousedown">
       <xsl:value-of select="concat('return SB_go(this,',substring(./@id,2),');')" />
    </xsl:attribute>
    <xsl:value-of select="./title" />
  </xsl:element>
  <xsl:if test="string-length(./@hits) != 0">
    [<xsl:value-of select="./@hits" />]
  </xsl:if>
  <xsl:if test="string-length(./desc) > 0">
    <div class="desc">
      <xsl:value-of select="./desc" />
    </div>
  </xsl:if>
    <div class="url">
  <xsl:if test="string-length(./@origin) > 0">
    <xsl:value-of select="./@origin" />
  </xsl:if>
  <xsl:if test="string-length(./@origin) = 0">
    <xsl:value-of select="./@href" />
  </xsl:if>
    </div>
    <div class="info">
  <xsl:call-template name="displayDate">
    <xsl:with-param name="label" select="'added'" />
    <xsl:with-param name="value" select="./@added" />
  </xsl:call-template>
  <xsl:call-template name="displayDate">
    <xsl:with-param name="label" select="' modified'" />
    <xsl:with-param name="value" select="./@modified" />
  </xsl:call-template>
  <xsl:call-template name="displayDate">
    <xsl:with-param name="label" select="' visited'" />
    <xsl:with-param name="value" select="./@visited" />
  </xsl:call-template>
  <xsl:call-template name="displayDate">
    <xsl:with-param name="label" select="' tested'" />
    <xsl:with-param name="value" select="./@tested" />
  </xsl:call-template>
<?php if (!$um->isAnonymous()) : ?>
  [<xsl:element name="a">
    <xsl:attribute name="href">
      <xsl:value-of select="concat('<?php echo $baseurl?>command.php?command=Properties&amp;lid_acl=',substring(@id,2))" />
    </xsl:attribute>
    <xsl:value-of select="'<?php echo SB_T('Properties'); ?>'" />
  </xsl:element>]
<?php endif; ?>
    </div>
  </div>
</xsl:template>

<xsl:template name="displayDate">
  <xsl:param name="label" />
  <xsl:param name="value" />
  <xsl:if test="string-length($value) != 0 and substring-before($value,'T') != '1999-11-30'">
    <xsl:value-of select="concat($label,' ')" />
    <xsl:if test="substring-before($value,'T') = string(/xbel/info/metadata/@curdate)">
      <xsl:value-of select="substring-after($value,'T')" />
    </xsl:if>
    <xsl:if test="substring-before($value,'T') != string(/xbel/info/metadata/@curdate)">
      <xsl:value-of select="substring-before($value,'T')" />
    </xsl:if>
  </xsl:if>
</xsl:template>

</xsl:stylesheet>
