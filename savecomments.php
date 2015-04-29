<?php
	
	if ( intval ( $qstring[1] ) < 1 )
	{
		exit ( "No Coupon selected." ) ;
	}
	
	if ( $_POST )
	{
		if ( strtolower ( $_POST["capSecurity"] ) != $_SESSION["posting"]["capCode"] )
		{
			$_SESSION["str_system_message"] = "Invalid security code." ;
		}
		else
		{
			$postdata = array ( ) ;
			
			$coupon_detail = $data->select ( "Coupon" , "*" , array ( "CouponID" => intval ( $_POST["CouponID"] ) ) ) ;
			$coupon_detail = $coupon_detail[0] ;
			if ( ! empty ( $coupon_detail ) )
			{
				foreach ( $_POST as $key=>$val )
					if ( strchr ( $key , "_POST_") )
						$postdata[str_replace ( "_POST_" , "" , $key )] = $val ;
				$postdata["CouponID"] = $_POST["CouponID"] ;
				$postdata["IsApproved"] = intval ( $app_init_data["DefaultStatusComments"] ) ;
				
				$id = $data->insert ( "Comment" , $postdata ) ;
				if ( intval ( $id ) > 0 )
					$_SESSION["str_system_message"] = "Your comment posted successfully." ;
				else
					$_SESSION["str_system_message"] = "Your comment cannot be posted" ;
				header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
			}
		}
	}
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/add_comments_form.php" ) ;

?>