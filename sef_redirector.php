<?php
	
	$qstring = explode ( "/" , $_GET["qstr"] ) ;
	
	
	//check if listing page is to be opened
	$is_listing_page = "";
	if ( isset($qstring[0]) && !empty($qstring[0]) ) {
		$is_char_list = explode("-",$qstring[0]);
		
		if ( strtolower($is_char_list[0]) == "all" && strtolower($is_char_list[1]) == "stores" ) {
			$is_listing_page = "store_list.php";
		}
	}
	
	
	
	if ( empty($is_listing_page) ) {
		
		switch ( $qstring[0] )
		{
			case "srch_query" :
				include ( "search_query.php" ) ;
				break;
			case "result" :
				include ( "search_result.php" ) ;
				break;
			case "wout" :
				$tag = "WOffer" ;
				include ( "out.php" ) ;
				break;
			case "d" :
				$tag = "WOffer" ;
				include ( "out.php" ) ;
				break;
			case "out" :
				$tag = "Tag" ;
				include ( "out.php" ) ;
				break;
			case "go" :
				$web = "Website" ;
				include ( "out.php" ) ;
				break;
			case "s" :
				$web = "Website" ;
				include ( "out.php" ) ;
				break;
			case "load" :
				include ( "out.php" ) ;
				break;
			case "c" :
				include ( "out.php" ) ;
				break;
			case "load_frame" :
				include ( "load_frame.php" ) ;
				break;
			case "comments_post" :
				include ( "savecomments.php" ) ;
				break;
			case "coupons" :
				include ( "tag_coupons.php" ) ;
				break;
			case "c" :
				include ( "tag_coupons.php" ) ;
				break;
			case "voting_post" :
				include ( "post_voting.php" ) ;
				break;
			case "c-ContactUs" :
				include ( "contact.php" ) ;
				break;
			case "c-WatchList" :
				include ( "watchlist.php" ) ;
				break;
			case "subscribe" :
				include ( "subscribe.php" ) ;
				break;
			case "Admin" :
				header ( "location:".base_url."Admin/index.php" ) ;
				exit ( ) ;
				break;
			default :
				include ( "home.php" ) ;
				break;
		}
		
	} else {
		include ( $is_listing_page ) ;
	}
	
	

?>