<?php

	function split_word( $str, $no_chars ){

		$newtext = wordwrap($str, $no_chars, "\n");

		$tmp=explode("\n",$newtext);

		return $tmp[0];

	}

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php include ( "core/inc.meta.php" ) ?>

</head>



<body>



<div align="center">

<div id="container_big">

	<div id="container">

        <div id="header">

        	<div id="logo">

                <a href="<?php echo base_url ?>"><img src="<?php echo base_url ?>media/logo.png" alt="Logo" /></a>

            </div>

            <div id="top_menu">

            	<?php include ( "inc.menu_top.php" ) ?>

            </div>

            <div id="start_shopp">

            	<a href="<?php echo base_url ?>coupons/accesories/"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/start-shopping-btn.gif" alt="Btn" /></a>

            </div>

            <div id="carousel">

            	<div class="carousel_top_arrow"><button class="prev" onclick="animate_area2 ( 'div_featured_coupons' , 0, 'ul_vertical' ) ;" alt="Previous" ><span>Previous</span></button></div>

            	<h1>Featured Coupons</h1>

            	<div id="carousel_inn">

                	<div class="subject" style="z-index: 1; height:120px;overflow: hidden;position: relative;" id="div_featured_coupons">

                	<div style="z-index:2;overflow: hidden;position: relative;">

                	<table id="ul_vertical">

<?php

					$today_coupons = $data->select ( "Coupon" , "*" , array ( "IsFeatured" => 1 ) , 0 , $app_init_data["FeaturedCouponsHome"] , "DateAdded desc" ) ;

					if ( ! empty ( $today_coupons ) )

						foreach ( $today_coupons as $coupon ) :

						

							$web_detail = $data->select ( "Website" , "*" , array ( "WebsiteID" => $coupon["WebsiteID"] ) ) ;

							if ( empty ( $web_detail ) )

								continue ;

							$web_detail = $web_detail[0] ;

?>

                    	<tr>

                        	<td style="text-align:left;"><a class="thumb" href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/" title="<?php echo $web_detail["WebsiteName"] ?> coupons">

								<img src="<?php echo pic_url."pic65/".str_replace(".","-",strtolower($web_detail['WebsiteTitle'])).".jpg" ?>" alt="<?php echo $web_detail["WebsiteName"] ?>" />

							</a></td>

                            <td><a href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/"><?php echo $data->count_record ( "Coupon" , array ( "IsApproved" => 1 , "WebsiteID" => $web_detail["WebsiteID"] ) ) ; ?> <?php echo $web_detail["WebsiteName"] ?> coupon codes</a></td>

                        </tr>

                        <tr>

                        	<td colspan="2" class="copune_cd_descript" style="text-align:left;"><strong id="coupon_code_feat_<?php echo $coupon["CouponID"] ?>"><?php echo $coupon["CouponCode"] ?></strong>

										<div id="coupon_Tool_tip_action_<?php echo $coupon["CouponID"] ?>" class="couponTooltip">Click to copy &amp; open site</div>

										<script language="javascript">

											set_copy_command ( "<?php echo $coupon["CouponCode"] ?>" , "coupon_code_feat_<?php echo $coupon["CouponID"] ?>" , <?php echo $coupon["CouponID"] ?> ) ;

										</script></td>

                        </tr>

                        <tr>

                        	<td colspan="2" class="copune_cd_descript" style="text-align:left;"><?php echo split_word($coupon["Description"],35); ?><br /><a href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/">More <?php echo $web_detail["WebsiteTitle"] ?> coupons »</a></td> 

                        </tr>

<?php

						endforeach;

?>

                    </table>

                    </div>

                    </div>

                </div>

                <div class="carousel_bottom_arrow"><button class="next" onclick="animate_area2 ( 'div_featured_coupons' , 1, 'ul_vertical' ) ;" alt="Next" id="nextbuttonvertical" ><span>Next</span></button></div>

            </div>

            <div id="main_menu">

            	<?php include ( "inc.menu_main.php" ) ?>

            </div>

            <?php include ( "inc.search_header.php" ) ?>

        </div>

        <div id="content">

        	<div id="content_top"></div>

            <div id="content_inn">

            	<h1>Popular Stores</h1>



			<?php

				$featured_web = $data->select ( "Website" , "*" , array ( "IsActive" => 1 ) , 0 , $app_init_data["PopularStoresHome"] , " Views desc" ) ;

				if ( ! empty ( $featured_web ) )

				{

					$count_rec = count ( $featured_web ) ;

			?>

				<div id="storeCollection">

					<div style="float:left; height:170px; vertical-align:middle; padding:50px 0px 0px 65px;"><button class="prev" onclick="animate_area ( 'div_popular_stores' , 0, 'ul_horizontal' ) ;"><span>Previous</span></button></div>

					<div class="inner" style="float:left">

						<div class="outer" id="div_popular_stores">

							<ul style="margin: 0pt; padding: 0pt; position: relative; list-style-type: none; z-index: 1; width: <?php echo intval ( $count_rec ) * 220 ?>px; left: 0px;" id="ul_horizontal">

								<?php

								foreach ( $featured_web as $web )

								{

						?>

								<li style="overflow: hidden; float: left; width: 220px; height: 170px;">

                                	<div class="content_prod">

									<a class="thumb" href="<?php echo base_url.get_sef_url ( $web["WebsiteID"] , "Website" ) ?>/" title="<?php echo $web["WebsiteTitle"] ?>">

										<img src="<?php echo pic_url."pic110/".str_replace(".","-",strtolower($web['WebsiteTitle'])).".jpg" ?>" alt="<?php echo $web["WebsiteTitle"] ?>" />

									</a>

									<p><?php echo(split_word($web["Description"],200));?><br /><a href="<?php echo base_url.get_sef_url ( $web["WebsiteID"] , "Website" ) ?>/"><?php echo $web["WebsiteName"] ?></a></p>

                                    </div>

								</li>

								<?php

								}

						?>

							</ul>

						</div>

					</div>

					<div style="float:left; height:170px; vertical-align:middle; padding:50px 0px 0px 80px;"><button class="next" onclick="animate_area ( 'div_popular_stores' , 1, 'ul_horizontal' ) ;" id="nextbuttonhorizontal"><span>Next</span></button></div>

				</div>

				

			<?php

				}

			?>

			

            <div style="vertical-align:top;">

				<?php

                    $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Top" ) ) ;

                    if ( ! empty ( $g_ads ) )

                        foreach ( $g_ads as $g_ad )

                            echo $g_ad["MarketingScript"]."<br />" ;

                ?>

            </div>

            

			<table>

            <tr>

            <td style="vertical-align:top; padding-left:5px;">

                <h2>Today's Top Coupons</h2>

                <div class="break"></div>

                <?php

				$q = "SELECT Coupon.WebsiteID FROM Coupon, Website WHERE Website.IsActive='1' AND Coupon.WebsiteID=Website.WebsiteID AND Coupon.IsApproved='1' GROUP BY Coupon.WebsiteID ORDER BY max(Coupon.DateAdded) DESC LIMIT 0,".intval ( $app_init_data["NewCouponsHome"] );

				$webdetail = $data->select2($q) ;

                if ( ! empty ( $webdetail ) )

                {

                    foreach ( $webdetail as $webid ) 

                    {

                        $coupon = $data->select ( "Coupon" , "*" , array ( "WebsiteID" => intval ( $webid["WebsiteID"] ) , "IsApproved" => 1 ) , 0 , 1 , "DateAdded desc" ) ;

                        $coupon = $coupon[0] ;

                        $web = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $coupon["WebsiteID"] ) ) ) ;

                        $web = $web[0] ;

                        if ( intval ( $web["IsActive"] ) == 0 )

                            continue ;

                        $website_link = base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ;

                ?>

                <table class="coupons_tb3">

                    <tr>

                        <td class="new_icon_bk3" style="text-align:left;">

                            <div class="subject">

                                <a class="thumb" href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/" title="<?php echo $web["WebsiteName"] ?> coupons">

                                    <img src="<?php echo pic_url."pic65/".str_replace(".","-",strtolower($web['WebsiteTitle'])).".jpg" ?>" alt="<?php echo $web["WebsiteName"] ?>" />

                                </a>

                                <h3><span><?php echo $web["WebsiteTitle"] ?> </span></h3>

                                <ul>

                                    <li class="viewCoupons">

                                        <a href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/"><?php echo $data->count_record ( "Coupon" , array ( "IsApproved" => 1 , "WebsiteID" => $coupon["WebsiteID"] ) ) ; ?> <?php echo $web["WebsiteName"] ?> coupon codes</a>

                                    </li>

                                </ul>

                            </div>

                        </td>

                        <td class="copune_cd_descript" style="text-align:left;">

                            <strong id="coupon_code_<?php echo $coupon["CouponID"] ?>"><?php echo $coupon["CouponCode"] ?></strong>

                            <div id="coupon_Tool_tip_action_<?php echo $coupon["CouponID"] ?>" class="couponTooltip">Click to copy &amp; open site</div>

                            <script language="javascript" type="text/javascript" >

                                set_copy_command ( "<?php echo $coupon["CouponCode"] ?>" , "coupon_code_<?php echo $coupon["CouponID"] ?>" , <?php echo $coupon["CouponID"] ?> ) ;

                            </script>

                            <br />

                            <small><?php echo $coupon["Description"] ?></small>

                        </td>

                    </tr>

                </table>

                <?php

                    }

                }	

                ?>

			</td>

			<td valign="top">

                <h2>Today's Top Deals</h2>							

                <div class="break"></div>

                <?php

                $offers = $data->select2("SELECT Website_Offers.WebsiteID FROM Website_Offers, Website WHERE Website.WebsiteID=Website_Offers.WebsiteID AND Website.IsActive='1' GROUP BY Website_Offers.WebsiteID ORDER BY max(Website_OffersID) DESC LIMIT 0,5");

                if ( ! empty ( $offers ) )

                {

                    foreach ( $offers as $offer ) 

                    {

                        $oferta = $data->select ( "Website_Offers" , "*" , array ( "WebsiteID" => intval ( $offer["WebsiteID"] ) ) , 0 , 1 ) ;

                        $oferta = $oferta[0] ;

                        $web = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $offer["WebsiteID"] ) ) ) ;

                        $web = $web[0] ;

                        if ( intval ( $web["IsActive"] ) == 0 )

                            continue ;

                        $website_link = base_url.get_sef_url ( $oferta["WebsiteID"] , "Website" ) ;

                        

                        $title = split_word(stripslashes($oferta["OfferTitle"]),50);

                        $desc = split_word($oferta["Description"],100);

                ?>

                <table class="coupons_tb4">

                    <tr>

                        <td class="copune_cd_descript"><span><a href="<?php echo base_url ?>d/<?php echo $oferta["Website_OffersID"] ?>/" target="_blank" rel="nofollow"><?php echo $title ?></a></span> 

                            <small><?php echo $desc ?></small>

                        </td>

                        <td class="work_cp" style="text-align:right;" rowspan="2">

                            <div class="subject" style="width:80px; text-align:right;">

                            <a class="thumb" href="<?php echo $website_link ?>/" title="<?php echo $web["WebsiteName"] ?> coupons">

                                <img src="<?php echo pic_url."pic65/".str_replace(".","-",strtolower($web['WebsiteTitle'])).".jpg" ?>" alt="<?php echo $web["WebsiteName"] ?>" />

                            </a><br />

                            <a href="<?php echo $website_link ?>/"> <?php echo $web["WebsiteName"] ?></a>

                            </div>

                        </td>

                    </tr>

                    <tr bgcolor="#f9fbee">

                        <td class="shared_cp"><a href="<?php echo $website_link ?>/">More <?php echo $web["WebsiteTitle"] ?> offers »</a></td>

                    </tr>

                </table>

                <?php

                    }

                }		

                ?>

			</td>

            </tr>

            </table>

            

            <div>

				<?php

                    $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Home Bottom" ) ) ;

                    if ( ! empty ( $g_ads ) )

                        foreach ( $g_ads as $g_ad )

                            echo $g_ad["MarketingScript"]."<br /><br />" ;

                ?>

            </div>



            </div>

            <div id="content_bottom"></div>

        </div>

        <?php include ( "inc.footer.php" ) ?>

    </div>

</div>

</div>

</body>

</html>