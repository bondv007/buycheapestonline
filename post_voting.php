<?php
	
	if ( $_POST )
	{
		$postdata = array ( ) ;
		$coupon_detail = $data->select ( "VotingLog" , "*" , array ( "CouponID" => intval ( $_POST["CouponID"] ) , "IP" => $_SERVER['REMOTE_ADDR'] ) ) ;
		if ( empty ( $coupon_detail ) )
		{
			$postdata["CouponID"] = intval ( $_POST["CouponID"] ) ;
			$postdata["VotingValue"] = strip_tags($_POST["vote_code"] ) ;
			$postdata["VotingValue"] = intval ( $postdata["VotingValue"] ) ;
			$postdata["IP"] = $_SERVER['REMOTE_ADDR'] ;
			$id = $data->insert ( "VotingLog" , $postdata ) ;
			if ( intval ( $id ) > 0 )
			{
				if ( intval ( $postdata["VotingValue"] ) )
					$data->update ( "Coupon" , " CountSuccess=CountSuccess+1" , array ( "CouponID" => intval ( $_POST["CouponID"] ) ) ) ;
				else
					$data->update ( "Coupon" , " CountFail=CountFail+1" , array ( "CouponID" => intval ( $_POST["CouponID"] ) ) ) ;
				$_SESSION["str_system_message"] = "Your voting posted successfully." ;
			}
			else
				$_SESSION["str_system_message"] = "Cannot be voted." ;
		}
	}
	header ( "location:".$_SERVER['HTTP_REFERER'] ) ;
	
?>