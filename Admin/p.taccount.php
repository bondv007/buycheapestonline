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
						$data->delete ( "TwitterAccount" , array ( "TwitterAccountID" => $adID ) ) ;
						break;
					case "actv_1" :
						$data->update ( "TwitterAccount" , array ( "IsActive" => "1" ) , array ( "TwitterAccountID" => $adID ) ) ;
						break;
					case "actv_0" :
						$data->update ( "TwitterAccount" , array ( "IsActive" => "0" ) , array ( "TwitterAccountID" => $adID ) ) ;
						break;
					default:
						break;
				}
			}
		}
	}
	if ( intval ( $_GET["id"] ) > 0  )
	{
		if ( isset ( $_GET["actv"] ) )
			$data->update ( "TwitterAccount" , array ( "IsActive" => intval ( $_GET["actv"] ) ) , array ( "TwitterAccountID" => intval ( $_GET["id"] ) ) ) ;
		if ( isset ( $_GET["del"] ) )
			$data->delete ( "TwitterAccount" , array ( "TwitterAccountID" => intval ( $_GET["id"] ) ) ) ;
	}
	
	$_SESSION["str_system_message"] = "Accounts changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>