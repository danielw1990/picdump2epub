<?php
require_once("functions.php");

$book_title = "test";
$infiles_folder = scandir($book_title);

$infiles = array();
foreach($infiles_folder as $infile)
{
	if($infile != "." && $infile != "..")
	{
		$infiles[] = $infile;
	}
}

$basefiles_folder = "basefiles/";
$book_uuid = create_uuid();


$epub_name = $book_title;
$extenension = ".epub";


//create all static stuff
$epub_name .= $extenension;
mkdir($epub_name);

$basefiles[] = "cover.jpeg";
$basefiles[] = "mimetype";
$basefiles[] = "page_styles.css";
$basefiles[] = "stylesheet.css";
$basefiles[] = "titlepage.xhtml";
foreach($basefiles as $basefile)
{
	copy($basefiles_folder.$basefile, $epub_name."/".$basefile);
}

recurse_copy($basefiles_folder."META-INF", $epub_name."/META-INF");

//copy the images
$page_number = 1;
foreach($infiles as $infile)
{
	copy($book_title."/".$infile, $epub_name."/".$page_number.".jpg");
	$page_number++;
}
$pages = $page_number;

//dynamic files
$book_uuid = create_uuid();
require_once($basefiles_folder."content.opf.php");
require_once($basefiles_folder."page_n.xhtml.php");
for($i = 1;$i <= $pages;$i++)
{
	write_page_xhtml($i);
}

require_once($basefiles_folder."toc.nx.php");
?>