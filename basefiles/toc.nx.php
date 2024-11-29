<?php
function write_toc_nx()
{
	global $pages, $book_uuid, $book_title, $epub_name;
	
	$toc_header = '<?xml version=\'1.0\' encoding=\'utf-8\'?>
<ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" version="2005-1" xml:lang="deu">
  <head>
    <meta content="'.$book_uuid.'" name="dtb:uid"/>
    <meta content="2" name="dtb:depth"/>
    <meta content="calibre (3.14.0)" name="dtb:generator"/>
    <meta content="0" name="dtb:totalPageCount"/>
    <meta content="0" name="dtb:maxPageNumber"/>
  </head>';
	$toc_doctitle = '<docTitle>
    <text>'.$book_title.'</text>
  </docTitle>
  <navMap>' . '\n';
  
  $toc_navpoints = "";
  for($page_number = 1;$page_number <= $pages;$page_number++)
  {
	  $toc_navpoints .= '   <navPoint class="chapter" id="num_'.$page_number.'" playOrder="'.$page_number.'">
      <navLabel>
        <text>Seite '.$page_number.'</text>
      </navLabel>
      <content src="page_'.$page_number.'.xhtml"/>
    </navPoint>' . "\n";
  }
	

	$toc_foot = "  </navMap>
</ncx>";

	$toc_nx = "";
	$toc_nx .= $toc_header;
	$toc_nx .= $toc_doctitle;
	$toc_nx .= $toc_navpoints;
	$toc_nx .= $toc_foot;
	
	file_put_contents($epub_name."/toc.nx", $toc_nx);
}

write_toc_nx()
?>
