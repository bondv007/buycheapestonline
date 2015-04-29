<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "core/inc.meta.php" ) ?>
</head>

<body>
<div align="center">
<div id="container_big">
	<div id="container">
        <div id="header_innerpage">
        	<div id="logo">
                <a href="<?php echo base_url ?>"><img src="<?php echo base_url ?>media/logo.png" alt="Logo" /></a>
            </div>
            <div id="top_menu_innerpage">
            	<?php include ( "inc.menu_top.php" ) ?>
            </div>
            <div id="main_menu">
            	<?php include ( "inc.menu_main.php" ) ?>
            </div>
            <?php include ( "inc.search_header.php" ) ?>
        </div>
        <div id="content">
        	<div id="left_content">
            	<div id="left_content_top"></div>
                <div id="left_content_inn" class="left_content_inn_nopad">
                	<h1 class="no_pad_bot">Popular <?php echo $tag["TagName"] ?> Coupon Codes</h1>
                    <p class="cp_descript"><?php echo stripslashes($tag["TagDescription"]) ?></p>

                    <div style="vertical-align:top;">
                        <?php
                            $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Tag Top" ) ) ;
                            if ( ! empty ( $g_ads ) )
                                foreach ( $g_ads as $g_ad )
                                    echo $g_ad["MarketingScript"]."<br />" ;
                        ?>
                    </div>

                    <h2>Current Top <?php echo $tag["TagName"] ?> Coupons</h2>
					<?php
					$tag_web = $data->select ( "Website_Tag" , "*" , array ( "TagID" => intval ( $tag["TagID"] ) ) ) ;
					if ( ! empty ( $tag_web ) )
					{
						foreach ( $tag_web as $tagweb )
						{
							$web_detail = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $tagweb["WebsiteID"] ) ) ) ;
							$web_detail = $web_detail[0] ;
							
							$latest_coupon = $data->select ( "Coupon" , "*" , array ( "WebsiteID" => intval ( $tagweb["WebsiteID"] ) ) , 0 , 1 , "DateAdded desc" ) ;
							$coupon = $latest_coupon[0] ;
							if ( empty ( $coupon ) )
							{
								continue ;
							}
					?>
                    <table class="coupons_tb">
                    	<tr>
                        	<td class="new_icon_bk2" style="text-align:left;">
								<div class="subject">
									<a class="thumb" href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/" title="<?php echo $web_detail["WebsiteName"] ?> coupons">
										<img src="<?php echo base_url."media/pic65/".str_replace(".","-",strtolower($web_detail['WebsiteTitle'])).".jpg" ?>" alt="<?php echo $web_detail["WebsiteName"] ?>" />
									</a>
									<h3><span><?php echo $web_detail["WebsiteTitle"] ?></span></h3>
									<ul>
										<li class="viewCoupons">
											<a href="<?php echo base_url.get_sef_url ( $coupon["WebsiteID"] , "Website" ) ?>/"><?php echo $data->count_record ( "Coupon" , array ( "IsApproved" => 1 , "WebsiteID" => $coupon["WebsiteID"] ) ) ; ?> <?php echo $web_detail["WebsiteName"] ?> coupon codes</a>
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
                    
                <?php
					$offers = $data->select ( "Website_Offers" , "*" , array ( "WebsiteID" => $website["WebsiteID"] ) ) ;
					if ( ! empty ( $offers ) )
					{
				?>
						<h2>Special Offers</h2>							
                        <div class="break"></div>
						<?php
							foreach ( $offers as $offer )
							{
						?>
                    <table class="coupons_tb">
                    	<tr>
                        	<td class="new_icon_bk">
								<?php
									if ( $offer["Image"] != "" )
									{
								?>
								<a href="<?php echo base_url ?>d/<?php echo $offer["Tag_OffersID"] ?>/" target="_blank" rel="nofollow">
									<img src="<?php echo base_url."media/pic65/".$offer["Image"] ?>" alt="None" />
								</a>
								<?php
									}
								?>
                            </td>
                            <td class="copune_cd_descript"><span><a href="<?php echo base_url ?>d/<?php echo $offer["Website_OffersID"] ?>/" target="_blank" rel="nofollow"><?php echo $offer["OfferTitle"] ?></a></span> 
                            	<small><?php echo $offer["Description"] ?></small>
                            </td>
                            <td class="work_cp">
                            	<a href="<?php echo base_url ?>d/<?php echo $offer["Website_OffersID"] ?>/" target="_blank" rel="nofollow">more</a>
                            </td>
                        </tr>
                        <tr bgcolor="#f9fbee">
                        	<td colspan="2" class="shared_cp">Shared <?php echo date ( "F j, Y" , strtotime ( $offer["DateAdded"] ) ) ?></td>
                            <td class="add_comment_cp"> </td>
                        </tr>
                    </table>
						<?php
							}
					}
				?>
                
                    <div style="vertical-align:top;">
                        <?php
                            $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Tag Bottom" ) ) ;
                            if ( ! empty ( $g_ads ) )
                                foreach ( $g_ads as $g_ad )
                                    echo $g_ad["MarketingScript"]."<br />" ;
                        ?>
                    </div>

                </div>
                <div id="left_content_bottom"></div>
            </div>
            <div id="right_content">

                <div style="vertical-align:top;">
                    <?php
                        $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Tag Side Bar" ) ) ;
                        if ( ! empty ( $g_ads ) )
                            foreach ( $g_ads as $g_ad )
                                echo $g_ad["MarketingScript"]."<br />" ;
                    ?>
                </div>

            	<?php include ( "inc.related_tags.php" ) ?>
            	<?php include ( "inc.top_stores.php" ) ?>
            	<?php include ( "inc.social.php" ) ?>
            </div>
        </div>
        <?php include ( "inc.footer.php" ) ?>
    </div>
</div>
</div>
</body>
</html>