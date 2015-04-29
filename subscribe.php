<?php
	if ( $qstring[1] !='' ){

		$postdata = array ( ) ;
		$cod = sqlesc($qstring[1]);

		$nl_detail = $data->select ( "Newsletter" , "*" , array ( "email" => sqlesc($qstring[2]) ) ) ;
		if ( ! empty ( $nl_detail ) ){
			foreach ( $nl_detail as $nl ){
				if(md5($nl['code']) == $cod){
					$data_reg = date("Y-m-d H:i:s",time());
					$postdata['date_register'] = $data_reg;
					
					$id = $data->update ( "Newsletter" , $postdata, array ( "ID" => $nl['ID']) ) ;
				} 
			}	
		}

	} 


	include ( "theme/".$app_init_data["CurrentSkin"]."/subscribe.php" ) ;
?>