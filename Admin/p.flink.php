<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$data->delete ( "Link_Footer" , array ( "ID" => intval ( $_GET["id"] ) ) ) ;
		
		$_SESSION["str_system_message"] = "Footer links deleted successfully." ;
	}
	
	header ( "location:flinklist.php" ) ;
	exit ( ) ;
?>