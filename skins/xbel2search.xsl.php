<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2005-2008  Ondrej Brablc <http://brablc.com/mailto?o>       *
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
    </head>

    <body class="siteBar siteBarBaseFont siteBarPageBackground">
      <div class="title cmnTitleColorInverse">
      <xsl:value-of select="xbel/title" />
      </div>
      <xsl:for-each select="xbel/*">
        <xsl:choose>
          <xsl:when test="local-name(.)='folder'">
            <xsl:call-template name="displayFolder" />
          </xsl:when>
        </xsl:choose>
      </xsl:for-each>
      <div class="engine">

      <xsl:if test="string-length(/xbel/info/metadata/@search_engine_url) > 0">
        <xsl:if test="/xbel/info/metadata/@use_search_engine_iframe = 1">
          <xsl:call-template name="displayFooter"/>
          <?php echo SB_T('Web Search Results')?>
          <xsl:element name="iframe">
            <xsl:attribute name="class">cmnTitleColorInverse</xsl:attribute>
            <xsl:attribute name="width">100%</xsl:attribute>
            <xsl:attribute name="height">2048</xsl:attribute>
            <xsl:attribute name="frameborder">0</xsl:attribute>
            <xsl:attribute name="src">
              <xsl:value-of select="/xbel/info/metadata/@search_engine_url" />
            </xsl:attribute>
          </xsl:element>
        </xsl:if>
        <xsl:if test="/xbel/info/metadata/@use_search_engine_iframe != 1">
          <xsl:element name="img">
            <xsl:attribute name="src">
              <xsl:value-of select="/xbel/info/metadata/@search_engine_ico" />
            </xsl:attribute>
          </xsl:element>
          <xsl:element name="a">
            <xsl:attribute name="href">
               <xsl:value-of select="xbel/info/metadata/@search_engine_url" />
            </xsl:attribute>
            <?php echo SB_T('Continue with Web Search ...')?>
          </xsl:element>
          <xsl:call-template name="displayFooter"/>
        </xsl:if>
      </xsl:if>
      </div>
    </body>
  </html>
</xsl:template>

<xsl:template name="displayFolder" match="folder">
  <xsl:for-each select="./bookmark">
    <xsl:call-template name="displayBookmark" />
  </xsl:for-each>
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
  <xsl:value-of select="' [@'" />
  <xsl:element name="a">
    <xsl:attribute name="href">
      <xsl:value-of select="concat('index.php?w=dir&amp;root=',@parent_id)" />
    </xsl:attribute>
    <xsl:value-of select="./@parent_name" />
  </xsl:element>
<?php if (!$um->isAnonymous()) : ?>
  <xsl:value-of select="' '" />
  <xsl:element name="a">
    <xsl:attribute name="href">
      <xsl:value-of select="concat('command.php?command=Properties&amp;lid_acl=',substring(@id,2))" />
    </xsl:attribute>
    <xsl:value-of select="'<?php echo SB_T('Properties'); ?>'" />
  </xsl:element>
<?php endif; ?>
  <xsl:value-of select="']'" />
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

<xsl:template name="displayFooter">
  <div class="footer cmnTitleColorInverse">
  <xsl:text><?php echo SB_T('Bookmarks from SiteBar installation at')?> </xsl:text>
  <xsl:element name="a">
    <xsl:attribute name="class">
      <xsl:value-of select="'url'" />
    </xsl:attribute>
    <xsl:attribute name="href">
      <xsl:value-of select="'<?php echo $baseurl.'index.php'; ?>'" />
    </xsl:attribute>
    <xsl:text><?php echo $baseurl; ?></xsl:text>
  </xsl:element>
  </div>
</xsl:template>

</xsl:stylesheet>
