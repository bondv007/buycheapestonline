<?php
	
	if ( intval ( $qstring[1] ) < 0 )
		exit( "No coupon selected." );
	
	if ( $web == "Website" )
	{
		$web = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $qstring[1] ) ) ) ;
		$web = $web[0] ;
		
		if ( ! empty ( $web ) )
		{
			$data->update ( "Website" , array ( "Views" => intval ( $web["Views"] ) + 1 ) , array ( "WebsiteID" => intval ( $web["WebsiteID"] ) ) ) ;
			header ( "location:".$web["AffilateURL"] ) ;
			exit();
		}
		else
		{
			exit ( "Website not found. " ) ;
		}
	}elseif ( $tag == "Tag" ){
		$offer_id = $qstring[1] ;
		
		$offer = $data->select ( "Tag_Offers" , "*" , array ( "Tag_OffersID" => intval ( $offer_id ) ) ) ;
		$offer = $offer[0] ;
		if ( ! empty ( $offer ) )
		{
			header ( "location:".$offer["LandingPage"] ) ;
			exit ( ) ;
		}
		else
		{
			exit ( "Offer not found" ) ;
		}
	}elseif ( $tag == "WOffer" ){
		$offer_id = $qstring[1] ;
		
		$offer = $data->select ( "Website_Offers" , "*" , array ( "Website_OffersID" => intval ( $offer_id ) ) ) ;
		$offer = $offer[0] ;
		if ( ! empty ( $offer ) ){
			header ( "location:".$offer["LandingPage"] ) ;
			exit ( ) ;
		}else{

			header ( "location:http://www.coupodon.com/Expired-Offer" ) ;
			exit () ;
		}

	}else{
		//coupon
		
		$coupon_id = $qstring[1] ;
		
		$coupon = $data->select ( "Coupon" , "*" , array ( "CouponID" => intval ( $qstring[1] ) ) ) ;
		$coupon = $coupon[0] ;
		if ( ! empty ( $coupon ) ){
			if($coupon["CouponLink"]!=''){
				header ( "location:".$coupon["CouponLink"] ) ;
			}else{
				$web = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $coupon["WebsiteID"] ) ) ) ;
				$web = $web[0] ;
				
				if ( ! empty ( $web ) )			{
					$data->update ( "Website" , array ( "Views" => intval ( $web["Views"] ) + 1 ) , array ( "WebsiteID" => intval ( $coupon["WebsiteID"] ) ) ) ;
					header ( "location:".$web["AffilateURL"] ) ;
					exit();
				}else{
					exit ( "Website not found." ) ;
				}
			}	
		}else{
			exit ( "Coupon not found." ) ;
		}
	}
	
?>