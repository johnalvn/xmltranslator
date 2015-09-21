<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match='productos'>
    <Allitems>
        <xsl:apply-templates />
    </Allitems>
  </xsl:template>

  <xsl:template match="producto">
    <Item>
     <titulo><xsl:value-of select="titulo"/></titulo>
     <url><xsl:value-of select="url"/></url>
     <url-imagen><xsl:value-of select="url-imagen"/></url-imagen>
     <marca><xsl:value-of select="marca"/></marca>
     <precio><xsl:value-of select="number(precio)"/></precio>
     <taxonomia><xsl:value-of select="taxonomia"/></taxonomia>
     <id-comercio><xsl:value-of select="id-comercio"/></id-comercio>
     <descripcion><xsl:value-of select="descripcioan"/></descripcion>
    </Item>
  </xsl:template>

</xsl:stylesheet>