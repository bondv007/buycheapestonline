<?php
	
		$coupon_id = $qstring[1] ;
		
		$coupon = $data->select ( "Coupon" , "*" , array ( "CouponID" => intval ( $qstring[1] ) ) ) ;
		$coupon = $coupon[0] ;
		if ( ! empty ( $coupon ) )
		{
			$web = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $coupon["WebsiteID"] ) ) ) ;
			$web = $web[0] ;
			
			if ( ! empty ( $web ) )
			{
				header ( "location:".$web["AffilateURL"]) ;
				exit();
			}
			else
			{
				exit ( "Website not found." ) ;
			}
		}
		else
		{
			exit ( "Coupon not found." ) ;
		}
	
?>