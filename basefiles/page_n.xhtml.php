<?php
function write_page_xhtml($page_number)
{
	global $epub_name;
	
	$page = "<?xml version='1.0' encoding='utf-8'?>\n";
	$page .= '<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Page #'.$page_number.'</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
<link href="page_styles.css" rel="stylesheet" type="text/css"/>
</head>
  <body class="calibre">
        <div class="calibre1">
            <img src="'.$page_number.'.jpg" alt="comic page #'.$page_number.'" class="calibre2"/>
        </div>
    </body>
</html>';

	file_put_contents($epub_name."/page_".$page_number.".xhtml", $page);
}

?>