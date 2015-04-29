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
						$data->delete ( "Comment" , array ( "CommentID" => $adID ) ) ;
						break;
					case "actv_1" :
						$data->update ( "Comment" , array ( "IsApproved" => "1" ) , array ( "CommentID" => $adID ) ) ;
						break;
					case "actv_0" :
						$data->update ( "Comment" , array ( "IsApproved" => "0" ) , array ( "CommentID" => $adID ) ) ;
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
			$data->update ( "Comment" , array ( "IsApproved" => intval ( $_GET["actv"] ) ) , array ( "CommentID" => intval ( $_GET["id"] ) ) ) ;
		if ( intval ( $_GET["del"] ) == 1 )
			$data->delete ( "Comment" , array ( "CommentID" => $_GET["id"] ) ) ;
	}
	
	$_SESSION["str_system_message"] = "Comment(s) changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>