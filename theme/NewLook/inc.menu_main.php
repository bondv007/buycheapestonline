<?
	$myFile="media/main_menu.txt";
	$handle = fopen($myFile, "rb");
	$menu = '';
	while (!feof($handle)) {
	  $menu .= fread($handle, 8192);
	}
	fclose($handle);
	
	echo $menu;

?>