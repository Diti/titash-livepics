<?xml version="1.0" encoding="utf-8" ?>

<xsl:stylesheet
  version="2.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/1999/xhtml"
  >

  <xsl:output encoding="utf-8" method="xml" indent="yes"/>

  <xsl:template match="/Livepics">
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Titash Livepics</title>
        <link href="livepics.css" rel="stylesheet" type="text/css"/>
      </head>
      <body>

      <div class="head-presentation">
        <h2>Titash Livepics</h2>
        <p>This XML file is not meant to be viewed in a browser.</p>
        <p><a class="link" href="http://www.titash.net/livepic">http://www.titash.net/livepic</a></p>
      </div>

        <div class="gallery">
          <xsl:for-each select="livepic">

            <!-- Newest Livepic first -->
            <xsl:sort select="position()" data-type="number" order="ascending"/>

            <xsl:if test="not(.[@disabled = 'yes']) and title/text() and date">

              <figure class="gallery-item">

                <!-- Store the current Livepic number in a variable -->
                <xsl:variable name="lp_number">
                  <xsl:number value="last() - position() + 1" format="01" />
                  <!-- If sort is ASC, use `last() - position() + 1`; if DESC, use `position()` -->
                </xsl:variable>

                <xsl:variable name="img_url_full">
                  http://www.titash.net/livepic/livepic/Titash%20<xsl:number value="$lp_number" format="001"/>%20LivePic%20<xsl:value-of select="date"/>.jpg
                </xsl:variable>

                <xsl:variable name="img_url_preview">
                  <xsl:if test="date">
                    http://www.titash.net/livepic/preview/Titash%20<xsl:number value="$lp_number" format="001"/>%20LivePic%20<xsl:value-of select="date"/>.jpg
                  </xsl:if>
                </xsl:variable>

                <xsl:variable name="article_url">
                  <xsl:if test="url and not(url/*)"><xsl:value-of select="url"/></xsl:if>
                  <xsl:if test="url and url/article"><xsl:value-of select="url/article"/></xsl:if>
                  <xsl:if test="not(url)">http://www.titash.net/blog/titash-livepic-<xsl:number value="$lp_number" format="01"/>/</xsl:if>
                </xsl:variable>

                <!-- Now output the gallery item -->
                <a href="{$img_url_full}"><img src="{$img_url_preview}" alt="{title}" title="{title}" /></a>
                <figcaption>
                  <a class="gallery-item-bloglink" href="{$article_url}">
                    Livepic <xsl:number value="$lp_number" format="01"/>
                    <span class="gallery-item-bloglink_date"><xsl:value-of select="date"/></span>
                  </a>
                </figcaption>

              </figure>

            </xsl:if>

          </xsl:for-each>
        </div>

      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
