<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	
	include_once ( "../classes/misc.func.php" ) ;
	
	if ( $_POST )
	{
		if ( ! empty ( $_POST["chkAdID"] ) )
		{
			foreach ( $_POST["chkAdID"] as $adID )
			{
				switch ( $_POST["radOption"] )
				{
					case "del" :
						$data->delete ( "Website" , array ( "WebsiteID" => $adID ) , 1 ) ;
						$data->delete ( "SEF_URL" , array ( "EntityType" => "Website" , "EntityID" => $adID ) , 1 ) ;
						break;
					case "spon_1" :
						$data->update ( "Website" , array ( "IsFeatured" => "1" ) , array ( "WebsiteID" => $adID ) ) ;
						break;
					case "spon_0" :
						$data->update ( "Website" , array ( "IsFeatured" => "0" ) , array ( "WebsiteID" => $adID ) ) ;
						break;
					case "actv_2" :
						$data->update ( "Website" , array ( "IsActive" => "2" ) , array ( "WebsiteID" => $adID ) ) ;
						break;
					case "actv_1" :
						$data->update ( "Website" , array ( "IsActive" => "1" ) , array ( "WebsiteID" => $adID ) ) ;
						break;
					case "actv_0" :
						$data->update ( "Website" , array ( "IsActive" => "0" ) , array ( "WebsiteID" => $adID ) ) ;
						break;
					default:
						break;
				}
			}
		}
	}
	if ( intval ( $_GET["id"] ) > 0  )
	{
		if ( isset ( $_GET["spon"] ) )
			$data->update ( "Website" , array ( "IsFeatured" => intval ( $_GET["spon"] ) ) , array ( "WebsiteID" => intval ( $_GET["id"] ) ) ) ;
		if ( isset ( $_GET["actv"] ) )
			$data->update ( "Website" , array ( "IsActive" => intval ( $_GET["actv"] ) ) , array ( "WebsiteID" => intval ( $_GET["id"] ) ) ) ;
	}
	
	$_SESSION["str_system_message"] = "Website(s) changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>