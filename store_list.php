<?php 
	
	$url = $_SERVER['REQUEST_URI'];	
	$parts = explode("/",$_SERVER['REQUEST_URI']);
	$parts = end($parts);
	$parts = explode("-", $parts);
	$char = end($parts);
	
	$show_num = $show_last = 0;
	if ( strtolower($char) == "number" ) {
		$show_num = 1;
	} else if ( strtolower($char) == "xyz" ){
		$show_last = 1;
	}
	
	
	if ( $show_num != 1 ) {
		
		if ( $show_last == 1 ) {
			$websites = $data->select2 ( "select * from Website where LOWER(Website.WebsiteTitle) like 'x%' or LOWER(Website.WebsiteTitle) like 'y%' or LOWER(Website.WebsiteTitle) like 'z%' order by Website.WebsiteTitle" );
			
		} else {
			
			$websites = $data->select2 ( "select * from Website where LOWER(Website.WebsiteTitle) like '".$char."%' order by Website.WebsiteTitle" );
		}	
	} else {
		$websites = $data->select2 ( "select * from Website where Website.WebsiteTitle REGEXP '^[0-9]+'" );
	}
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/store_list.php" ) ;
	
	
	
	
	


?>