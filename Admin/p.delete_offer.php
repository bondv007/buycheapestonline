<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$data->delete ( "Tag_Offers" , array ( "Tag_OffersID" => intval ( $_GET["id"] ) ) , 1 ) ;
		$_SESSION["str_system_message"] = "Offer deleted successfully." ;
	}
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>