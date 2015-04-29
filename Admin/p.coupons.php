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
						$data->delete ( "Comment" , array ( "CouponID" => $adID ) ) ;
						$data->delete ( "Coupon" , array ( "CouponID" => $adID ) ) ;
						break;
					case "spon_1" :
						$data->update ( "Coupon" , array ( "IsFeatured" => "1" ) , array ( "CouponID" => $adID ) ) ;
						break;
					case "spon_0" :
						$stt = 0 ;
						$data->update ( "Coupon" , array ( "IsFeatured" => "0" ) , array ( "CouponID" => $adID ) ) ;
						break;
					case "actv_1" :
						$data->update ( "Coupon" , array ( "IsApproved" => "1" ) , array ( "CouponID" => $adID ) ) ;
						break;
					case "actv_0" :
						$stt = 0 ;
						$data->update ( "Coupon" , array ( "IsApproved" => "0" ) , array ( "CouponID" => $adID ) ) ;
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
			$data->update ( "Coupon" , array ( "IsFeatured" => intval ( $_GET["spon"] ) ) , array ( "CouponID" => intval ( $_GET["id"] ) ) ) ;
		if ( isset ( $_GET["actv"] ) )
			$data->update ( "Coupon" , array ( "IsApproved" => $_GET["actv"] ) , array ( "CouponID" => intval ( $_GET["id"] ) ) ) ;
		if ( isset ( $_GET["del"] ) )
		{
			$data->delete ( "Comment" , array ( "CouponID" => $adID ) ) ;
			$data->delete ( "Coupon" , array ( "CouponID" => intval ( $_GET["id"] ) ) ) ;
		}
	}
	$_SESSION["str_system_message"] = "Coupon(s) changed/updated successfully." ;
	
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	exit ( ) ;
?>