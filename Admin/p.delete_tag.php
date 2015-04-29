<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$entities = $data->select ( "Website_Tag" , "*" , array ( "TagID" => intval ( $_GET["id"] ) ) ) ;
		if ( ! empty ( $entities ) )
		{
			$_SESSION["str_system_message"] = "This tag contains some listings. Kindly delete them first." ;
		}
		else
		{
			$data->delete ( "Tag" , array ( "TagID" => intval ( $_GET["id"] ) ) ) ;
			$data->delete ( "SEF_URL" , array ( "EntityType" => "Tag" , "EntityID" => intval ( $_GET["id"] ) ) , 1 ) ;
			$_SESSION["str_system_message"] = "Tag deleted successfully." ;
		}
	}
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>