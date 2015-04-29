<?php
	
	require ( "config.php" ) ;
	require_once ( "classes/manipulate.php" ) ;
	$data = new DataManipulator ;
	require ( "classes/misc.func.php" ) ;

	function daysDifference($endDate, $beginDate)
	{
	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
	}



	$active_coupon = $data->select ( "Coupon" , "CouponID,DateAdded,StartDate,EndDate,Expiry" , array ( "IsApproved" => 1 ) , 0 , 100000 ) ;
	if ( ! empty ( $active_coupon ) )
	{
		foreach ( $active_coupon as $ad )
		{
			$expiry_days = intval ( $ad["Expiry"] ) ;
			if((date( "Y-m-d" )>$ad["EndDate"])&&($ad["EndDate"]!='0000-00-00')){
				$data->delete ( "Coupon" , array ( "CouponID" => $ad["CouponID"] ) , 300 ) ;
			}
			
			if ( $expiry_days > 0 )
			{
				$diffr = daysDifference ( date( "Y-m-d" ) , date ( "Y-m-d" , strtotime ( $ad["DateAdded"] ) ) ) ;
				if ( intval ( $diffr ) > $expiry_days )
				{
					$data->delete ( "Coupon" , array ( "CouponID" => $ad["CouponID"] ) , 300 ) ;
				}
			}
		}
	}

	$data->exec_sql ( "DELETE FROM Website_Offers WHERE EndDate<>'0000-00-00' AND EndDate<'".date( "Y-m-d" )."' ") ;

	$data->exec_sql ( "DELETE FROM Website_Offers WHERE `OfferTitle` REGEXP '(125|120|468|160|88)x[0-9]+[^cm]|[0-9]+x(30|60|90|150|250)[^cm]' ") ;

	$sd = date("Y-m-d",strtotime("now")); 
	$ed = date("Y-m-d",strtotime("+3 month"));
	$data->exec_sql ( "UPDATE Website_Offers SET EndDate='$ed', StartDate='$sd' WHERE EndDate='0000-00-00' ");
				

	$sd = date("Y-m-d",strtotime("now")); 
	$data->exec_sql ( "UPDATE Website_Offers SET StartDate='$sd' WHERE StartDate='0000-00-00' ");

/*
	// verify duplicity
	$active_offers = $data->select2("SELECT * FROM Website_Offers GROUP BY OfferTitle, Description HAVING count(*)>1");
	if ( ! empty ( $active_offers ) )
	{
		foreach ( $active_offers as $offer ){
			$offer["OfferTitle"] = str_replace("'","\'",stripslashes($offer["OfferTitle"]));
			$offer["Description"] = str_replace("'","\'",stripslashes($offer["Description"]));
			$data->exec_sql ( "DELETE FROM Website_Offers WHERE OfferTitle LIKE '".$offer["OfferTitle"]."' AND Description LIKE '".$offer["Description"]."' AND Website_OffersID<>'".$offer["Website_OffersID"]."' ") ;
		}
	}
	// end verify
*/

?>