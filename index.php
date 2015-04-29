<?php
	
	session_start ( ) ;
	
	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	require ( "classes/misc.func.php" ) ;
	
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$app_init_data = array ( ) ;
	foreach ( $siteSettings as $site )
	{
		$app_init_data[$site["SiteVariable"]] = $site["SiteValue"] ;
	}
	if ( intval ( $app_init_data["IsSiteClose"] ) == 1 )
	{
		exit ( "Site is down for maintainance." ) ;
	}
	
	$static_pages = $data->select ( "PageManager" , "PageManagerID , PageName , IncludeFooter, IncludeHeader" , null , 0 , 100 ) ;

	$qstring = explode ( "/" , $_GET["qstr"] ) ;
	
	if ( $qstring[0] != "" )
	{
		$entity = $data->select ( "SEF_URL" , "*" , array ( "URL" => $qstring[0] ) ) ;
		$entity = $entity[0] ;
		
		switch ( $entity["EntityType"] )
		{
			case "StaticPage" :
				$static_page = 1 ;
				$entity_id = $entity["EntityID"] ;
				include ( "st_page.php" ) ;
				break;
			case "Category" :
				$category_id = $entity["EntityID"] ;
				include ( "browse.php" ) ;
				break;
			case "Website" :
				$entity_id = $entity["EntityID"] ;
				include ( "detail.php" ) ;
				break;
			default :
				include ( "sef_redirector.php" ) ;
				break;
		}
	}
	else
	{
		include ( "sef_redirector.php" ) ;
	}
	
	
	

?>