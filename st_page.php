<?php
	
	
	$static_page = $data->select ( "PageManager" ,"*" , array ( "PageManagerID" => intval ( $entity_id ) ) ) ;
	
	$static_page = $static_page[0] ;
	
	$static_page["PageContents"] = stripslashes ( $static_page["PageContents"] ) ;
	
	$app_init_data["SiteTitle"] = $static_page["PageName"] ;
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/static_page.php" ) ;

?>