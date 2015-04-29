<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	
	if ( intval ( $_GET["del"] ) == 1 && intval ( $_GET["id"] ) > 1 )
	{
		if ( intval ( $_SESSION["admin_rights"]["r_account"] ) > 0 )
		{
			$data->delete ( "Admins" , array ( "AdminID" => intval ( $_GET["id"] ) ) ) ;
			$_SESSION["str_system_message"] = "Admin deleted successfully." ;
		}
		else
			$_SESSION["str_system_message"] = "You dont have permision to delete/modify admin." ;
	}
	
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>