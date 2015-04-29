<?php
	
	
	if ( $_POST )
	{
		$qry_post = $_POST["query"] ;
		$qry_post = trim ( $qry_post ) ;
		$qry_post = str_replace ( "'" , "" , $qry_post ) ;
		$qry_post = str_replace ( '"' , "" , $qry_post ) ;
		$qry_post = str_replace ( "/" , "" , $qry_post ) ;
		$qry_post = str_replace ( "\\" , "" , $qry_post ) ;
		$qry_post = str_replace ( "&" , "" , $qry_post ) ;
		header ( "location:".base_url."result/".$qry_post."/" ) ;
	}
	else
	{
		header ( "location:".base_url ) ;
	}
	
	

?>