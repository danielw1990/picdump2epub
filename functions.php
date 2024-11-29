<?php
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

function create_uuid()
{
	#29eeddc3-4149-4249-b053-d7d3f046802a
	#758e65c5-30d7-4a11-9b09-8fbff26ad763
	$index = 0;
	$hex[$index] = bin2hex(random_bytes(4)) ."-";
	$index++;
	$hex[$index] = bin2hex(random_bytes(2)) ."-";
	$index++;
	$hex[$index] = bin2hex(random_bytes(2)) ."-";
	$index++;
	$hex[$index] = bin2hex(random_bytes(2)) ."-";
	$index++;
	$hex[$index] = bin2hex(random_bytes(6));
	
	$uuid = "";
	for($i = 0;$i <= $index;$i++)
	{
		$uuid .= $hex[$i];
	}
	
	return $uuid;
}
?>