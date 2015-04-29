<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$data->delete ( "Website_Offers" , array ( "WebsiteID" => intval ( $_GET["id"] ) ) , 100 ) ;
		$_SESSION["str_system_message"] = "Offers deleted successfully." ;
	}
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>