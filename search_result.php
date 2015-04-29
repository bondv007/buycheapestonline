<?php
	
	if ( $qstring[1] == "" )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	$website_found = $data->select ( "Website" , "*", array ( "WebsiteTitle" => $qstring[1]) ) ;
	if ( ! empty ( $website_found ) )
	{
		$ec = get_sef_url ( $website_found[0]["WebsiteID"] , "Website" ) ;
		header ( "location:".base_url.$ec."/" ) ;
		exit();
	}
	
	
	$data->set_like ( array ( "WebsiteTitle" => $qstring[1] , "WebsiteName" => $qstring[1], "Description" => $qstring[1] ) ) ;
	$websites = $data->select ( "Website" , "*" , NULL ) ;
	
	
	$tag_found = $data->select ( "Tag" , "*" , array ( "TagName" => $qstring[1] ) , 0 , 1 ) ;
	if ( ! empty ( $tag_found ) )
	{
		$web_tag = $data->select ( "Website_Tag" , "*" , array ( "TagID" => $tag_found[0]["TagID"] ) ) ;
		if ( ! empty ( $web_tag ) )
		{
			foreach ( $web_tag as $tag_w )
			{
				$web_store_tag = $data->select ( "Website" , "*" , array ( "WebsiteID" => $tag_w["WebsiteID"] ) ) ;
				$websites[] = $web_store_tag[0] ;
			}
		}
	}

	$data->set_like ( array ( "OfferTitle" => $qstring[1] , "Description" => $qstring[1] ) ) ;
	$web_off = $data->select ( "Website_Offers" , "*" , NULL ) ;
	if ( ! empty ( $web_off ) )
	{
		foreach ( $web_off as $of )
		{
			$web_store_of = $data->select ( "Website" , "*" , array ( "WebsiteID" => $of["WebsiteID"] ) ) ;
			$websites[] = $web_store_of[0] ;
		}
	}

	$data->set_like(array ( "CouponCode" => $qstring[1], "Description" => $qstring[1] ));
	$coupon_found = $data->select ( "Coupon" , "*" , NULL ) ;
	if ( ! empty ( $coupon_found ) )
	{

			foreach ( $coupon_found as $coupon_w )
			{
				$web_store_tag = $data->select ( "Website" , "*" , array ( "WebsiteID" => $coupon_w["WebsiteID"] ) ) ;
				$websites[] = $web_store_tag[0] ;
			}

	}
	if (is_array($websites)) sort($websites);
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/search.php" ) ;

?>