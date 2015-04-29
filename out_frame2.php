<?php
	session_start ( ) ;
	
	require ( "config.php" ) ;
	require_once ( "classes/manipulate.php" ) ;
	
	$data = new DataManipulator ;
	require ( "classes/misc.func.php" ) ;
	
	$offer_id = $_REQUEST['id'] ;
	$offer = $data->select ( "Website_Offers" , "*" , array ( "Website_OffersID" => intval ( $offer_id ) ) ) ;
	$offer = $offer[0] ;
	if ( ! empty ( $offer ) )
	{
		$web = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $offer["WebsiteID"] ) ) ) ;
		$web = $web[0] ;
		
	}
	else
	{
		exit ( "Offer not found." ) ;
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  <title><? echo($web['WebsiteName']); ?> via codecoupondiscount.com</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    html, body {
      height: 100%;
    }
    body {
      overflow: hidden;
      margin: 0;
    }
    #bar {
      height: 70px;
      width: 100%;
      border-bottom: 1px solid #666;
      background: #0D63A8;
      overflow: hidden;
      font-size: 13px;
      font-family: "Trebuchet MS", Trebuchet, Arial, sans-serif;
      line-height: 125%;
    }
    #iframe {
      height: 100%;
      width: 100%;
      border-width: 0;
    }
	#first{
	  width: 200px;
      height: 70px;
	  float:left;
	}
    #logo img {
      border: none;
      height: 35px;
      margin: 3px 0 0 5px;
	  float:left;
    }
    .lnk {
      float: left;
      font-size: 13px;
      font-weight: bold;
      color: #fff;
      padding: 4px 5px 0 10px;
    }

    #coupon {
      width: 650px;
   	  margin: 3px 0 0 100px;
	  float: left;
    }
    #vot {
      width: 200px;
   	  margin: 12px 20px 0 10px; 
	  float: left;
    }
    .social {
	  width:100px;
   	  margin: 12px 10px 0 30px; 
	  float: left;
    }
    #coupon span {
      display: block;
      float: left;
      font-size: 15px;
      font-weight: bold;
      color: #fff;
      padding: 4px 5px 0 0;
    }
    #coupon strong {
      display: block;
      height: 21px;
      max-width: 185px;
      overflow: hidden;
      float: left;
      font-size: 17px;
      font-weight: bold;
      line-height: 115%;
      color: #553E00;
      border: 1px dashed #FEBF02;
      padding: 1px 26px 0 5px;
      background: #FDEDB4 url(http://codecoupondiscount.com/theme/Freshness/images/sprite.png) right -816px no-repeat;
    }

    #close {
      font-size: 16px;
      text-transform: uppercase;
      color: #fff;
      position: absolute;
      top: 11px;
      right: 10px;
    }
    #close:hover {
      text-decoration: none;
    }
	.com{font-size:11px; color:#fff;}
	.voting{text-align:center;font-size:11px;color:#666;}
	.voting button{width:26px; height:26px; cursor:hand; cursor:pointer; border:none; background:url(http://codecoupondiscount.com/theme/Freshness/images/sprite.png) -254px -293px no-repeat; margin:0 2px;}
	.voting button:hover{background-position:-254px -319px;}
	.voting span{font-size: 11px; color: #fff;}
	.voting .noVote{background-position:-280px -293px;}
	.voting .noVote:hover{background-position:-280px -319px;}

  </style>
</head>
<body>

      <div id="bar">
        <div id="first">
            <a id="logo" href="<? echo(base_url); ?>" target="_top"><img src="http://www.codecoupondiscount.com/media/logo.jpg" alt="codecoupondiscount.com" /></a>
            <a class="lnk" href="<? echo(base_url.$web['WebsiteName'].'/'); ?>"> &raquo; more offers for this store</a>
        </div>
        <div id="coupon">
          <span><? echo($offer['OfferTitle']); ?></span> <br /><br />
          <div class="com"><? echo($offer['Description']); ?></div>
        </div>
        <div class="social">
<!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c250bc37af45494"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c250bc37af45494"></script>
<!-- AddThis Button END -->
        </div>
        <a id="close" href="<? echo($offer["LandingPage"]); ?>" target="_top">Close</a>
      </div>
      <iframe id="iframe" src="<? echo($offer["LandingPage"]); ?>"></iframe>

</body>
</html>