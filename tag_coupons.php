<?php
	
	if ( $qstring[1] == "" )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}

	
		
	$det = $data->select ( "SEF_URL" ,"*" , array ( "URL" => $qstring[1] , "EntityType" => "Tag" ) ) ;
	$det = $det[0] ;
	
	if ( empty ( $det ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	
	$tag = $data->select ( "Tag" ,"*" , array ( "TagID" => $det["EntityID"] ) ) ;
	$tag = $tag[0] ;
	if ( empty ( $tag ) )
	{
		header ( "location:".base_url ) ;
		exit ( ) ;
	}
	
	
	$app_init_data["SiteTitle"] = $tag["SEOTitle"] != "" ? $tag["SEOTitle"] : $tag["TagName"]." ".$app_init_data["SiteTitle"] ;
	$app_init_data["SiteKeyword"] = $tag["SEOKeyword"] != "" ? $tag["SEOKeyword"] : $app_init_data["SiteKeyword"] ;
	$app_init_data["SiteDescription"] = $tag["TagDescription"] != "" ? strip_tags($tag["TagDescription"]) : $app_init_data["SiteDescription"] ;
	
	
	
	include ( "theme/".$app_init_data["CurrentSkin"]."/tag_result.php" ) ;

?>