<?php
	
	session_start ( ) ;
	
	
	
	set_time_limit ( 5000000 ) ;
	
	
	
	require ( "config.php" ) ;
	
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	
	require ( "classes/misc.func.php" ) ;
	$i = 0 ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		
		$classified_to_copy = $data->select ( "Classified" , "*" , array ( "AdID" => intval ( $_GET["id"] ) ) ) ;
		$classified_to_copy = $classified_to_copy[0] ;
		if ( ! empty ( $classified_to_copy ) )
			for ( ; $i < 1020 ; $i++ )
			{
				$array_of_data = array (
											"AdTitle" => $classified_to_copy["AdTitle"] ,
											"Description" => $classified_to_copy["Description"] ,
											"CategoryStack" => $classified_to_copy["CategoryStack"] ,
											"AddressStreet" => $classified_to_copy["AddressStreet"] ,
											"AddressZip" => $classified_to_copy["AddressZip"] ,
											"PaymentStatus" => $classified_to_copy["PaymentStatus"] ,
											"SearchKeywords" => $classified_to_copy["SearchKeywords"] ,
											"CategoryID" => $classified_to_copy["CategoryID"] ,
											"PriceAlternative" => $classified_to_copy["PriceAlternative"] ,
											"Price" => $classified_to_copy["Price"] ,
											"EmailAddress" => $classified_to_copy["EmailAddress"] ,
											"IsActive" => 1
										) ;
				$last_id = $data->insert ( "Classified" , $array_of_data ) ;
				
				generate_sef_url ( $classified_to_copy["AdTitle"] , $last_id , "Classified" ) ;
				
				$array_of_data = NULL ;
			}
		
	}
	else
	{
		$classified_to_copy = $data->select ( "Classified" , "*" , array ( "AdID" => 1 ) , 0 , 100 ) ;
		echo $classified_to_copy[0]["AdTitle"] ;

	}
	
	echo $i ." Ads Created" ;
	
?>