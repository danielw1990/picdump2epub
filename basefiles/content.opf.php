<?php
function create_content_opf()
{
	global $pages, $book_uuid, $book_title, $epub_name;
	$item_id = 0;
	
	$content_opf_page_item = "";
	for($page_number = 1;$page_number <= $pages;$page_number++)
	{
		$item_id++;
		$content_opf_page_item .= '    <item href="page_'.$page_number.'.xhtml" id="id'.$item_id.'" media-type="application/xhtml+xml"/>' . "\n";
	}
	
	$content_opf_image_item = "";
	for($page_number = 1;$page_number <= $pages;$page_number++)
	{
		$item_id++;
		$content_opf_image_item .= '    <item href="'.$page_number.'.jpg" id="id'.$item_id.'" media-type="image/jpeg"/>' . "\n"; #item_ids counted after page_iteme max item_id=pages*2
	}
	
	$content_opf = "";
	
	$content_opf_head = "<?xml version='1.0' encoding='utf-8'?>\n";
	$content_opf_head .= '<package xmlns="http://www.idpf.org/2007/opf" unique-identifier="uuid_id" version="2.0">
  <metadata xmlns:calibre="http://calibre.kovidgoyal.net/2009/metadata" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:opf="http://www.idpf.org/2007/opf" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <dc:creator opf:role="aut">Unknown</dc:creator>
    <dc:date>0101-01-01T00:00:00+00:00</dc:date>
    <meta name="calibre:title_sort" content="'.$book_title.'"/>
    <dc:identifier id="uuid_id" opf:scheme="uuid">'.$book_uuid.'</dc:identifier>
    <dc:identifier opf:scheme="calibre">'.$book_uuid.'</dc:identifier>
    <meta name="calibre:timestamp" content="2017-12-23T00:25:40+00:00"/>
    <meta name="cover" content="cover"/>
    <dc:title>'.$book_title.'</dc:title>
    <dc:language>de</dc:language>
    <dc:contributor opf:role="bkp">calibre (3.14.0) [https://calibre-ebook.com]</dc:contributor>
  </metadata>
  <manifest>
    <item href="cover.jpeg" id="cover" media-type="image/jpeg"/>' . "\n";
	#imageitems
	$content_opf_image_item;
	#pageitem 
	$content_opf_page_item; #this is intended, just a placeholder

	$content_opf_body = '    <item href="page_styles.css" id="page_css" media-type="text/css"/>
    <item href="stylesheet.css" id="css" media-type="text/css"/>
    <item href="titlepage.xhtml" id="titlepage" media-type="application/xhtml+xml"/>
    <item href="toc.ncx" id="ncx" media-type="application/x-dtbncx+xml"/>
  </manifest>
  <spine toc="ncx">
    <itemref idref="titlepage"/>' . "\n";
	$content_opf_itemref = "";
	for($page_number = 1;$page_number <= $pages;$page_number++)
	{
		$content_opf_itemref .= '    <itemref idref="id'.$page_number.'"/>' . "\n";
	}
	$content_opf_foot = '  </spine>
  <guide>
    <reference href="titlepage.xhtml" title="Cover" type="cover"/>
  </guide>
</package>';

	$content_opf .= $content_opf_head;
	$content_opf .= $content_opf_image_item;
	$content_opf .= $content_opf_page_item;
	$content_opf .= $content_opf_body;
	$content_opf .= $content_opf_itemref;
	$content_opf .= $content_opf_foot;
	
	file_put_contents($epub_name."/content.opf", $content_opf);
}

create_content_opf();
?>