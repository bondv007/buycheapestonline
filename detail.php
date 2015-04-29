<?php
	
	if ( intval ( $entity_id ) < 1 )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	
	$data->update ( "Website" , " Views=Views+1" , array ( "WebsiteID" => intval ( $entity_id ) ) ) ;
	
	$website = $data->select ( "Website" ,"*" , array ( "WebsiteID" => intval ( $entity_id ) ) ) ;
	
	if ( empty ( $website ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	$website = $website[0] ;
	
	
	
	if ( $_POST )
	{
		if ( intval ( $_POST["WebsiteID"] ) > 0 )
		{
			if ( strtolower ( $_POST["capSecurity"] ) != $_SESSION["capCode"] )
			{
				$_SESSION["str_system_message"] = "Invalid security code." ;
			}
			else
			{
				$dataValues = array ( 
										"WebsiteID" => intval ( $_POST["WebsiteID"] ),
										"CouponCode" => $_POST["f_code"] ,
										"IsApproved" => substr ( $app_init_data["DefaultStatus"] , 0 , 5 ) ,
										"Description" => addslashes ( $_POST["f_description"] ) ,
									) ;
									
				$id = $data->insert ( "Coupon" , $dataValues ) ;
				if ( intval ( $id ) > 0 )
				{
					$_SESSION["str_system_message"] = "Thank You for posting coupon." ;
				}
				header ( "location:". $_SERVER['HTTP_REFERER'] ) ;
				exit();
			}
		}
	}
	
	$app_init_data["SiteTitle"] = $website["SEOTitle"] != "" ? $website["SEOTitle"] : $website["WebsiteName"]." ".$app_init_data["SiteTitle"] ;
	$app_init_data["SiteKeyword"] = $website["SEOKeyword"] != "" ? $website["SEOKeyword"] : $app_init_data["SiteKeyword"] ;
	$app_init_data["SiteDescription"] = $website["Description"] != "" ? $website["Description"] : $app_init_data["SiteDescription"] ;
	
	
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/detail.php" ) ;

?>