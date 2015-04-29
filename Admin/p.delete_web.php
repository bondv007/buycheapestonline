<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$coupons = $data->count_record ( "Coupon", array ( "WebsiteID" => intval ( $_GET["id"] ) ) ) ;
		if ( $coupons < 1 )
		{
			$data->delete ( "Website" , array ( "WebsiteID" => intval ( $_GET["id"] ) ) , 1 ) ;
			$data->delete ( "SEF_URL" , array ( "EntityType" => "Website" , "EntityID" => intval ( $_GET["id"] ) ) , 1 ) ;
			
			$_SESSION["str_system_message"] = "Website deleted successfully." ;
		}
		else
			$_SESSION["str_system_message"] = "Website contains coupons. It cannot be deleted." ;
	}
	
	header ( "location:weblisting.php" ) ;
	exit ( ) ;
?>