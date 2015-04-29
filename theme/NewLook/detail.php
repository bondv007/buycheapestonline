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
                	<h1 class="no_pad_bot"><?php echo $website["WebsiteName"] ?> Coupon Codes</h1>
                    <p class="cp_descript"><?php echo $website["Description"] ?> <a href="<?php echo base_url ?>s/<?php echo $website["WebsiteID"] ?>/" target="_blank" rel="nofollow"><?php echo $website["WebsiteTitle"] ?> &#187;</a></p>

                    <div style="text-align:right; margin-right:46px;"></div>

                    <div id="couponCount">
						<strong><?php echo $data->count_record ( "Coupon" , array ( "IsApproved" => 1 , "WebsiteID" => $website["WebsiteID"] ) ) ; ?></strong> coupons shared
					</div>

                    
                    <div style="vertical-align:top;">
                        <?php
                            $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Store Top" ) ) ;
                            if ( ! empty ( $g_ads ) )
                                foreach ( $g_ads as $g_ad )
                                    echo $g_ad["MarketingScript"]."<br />" ;
                        ?>
                    </div>

                    <h2>Active Coupons</h2>
				<?php
//					$data->set_smaller ( array ( "CountSuccess" => "CountFail" ) ) ;
					
//					$coupons = $data->select ( "Coupon" , "*" , array ( "WebsiteID" => intval ( $website["WebsiteID"] ) , "IsApproved" => 1 ) , 0 , 150 , "DateAdded desc" ) ;
$coupons = $data->select2 ( "SELECT * FROM Coupon WHERE WebsiteID='".$website["WebsiteID"]."' AND IsApproved='1' ORDER BY DateAdded DESC") ;
//print_r($coupons);
					if ( ! empty ( $coupons ) )
					{
				?>
                    
					<?php
						foreach ( $coupons as $coupon )
						{
							$hi = intval ( $coupon["CountSuccess"] ) ;
							$lo = intval ( $coupon["CountFail"] ) ;
							if ( ( $hi + $lo ) == 0 ){
								$css = "new" ;
								$success = "<em>NEW</em>" ;
							}else{
								$success = $hi * 100 / ( $hi + $lo ) ;
								if ( $success > 69 )
									$css = "good" ;
								elseif ( $success > 49 )
									$css = "average" ;
								elseif ( $success > 0 )
									$css = "bad" ;
								$success = "<em>".intval ( $success ) . "%</em> Success" ;
							}
					?>
                    <table class="coupons_tb">
                    	<tr>
                        	<td class="new_icon_bk">
								<div class="stats <?php echo $css ?>">
									<?php echo $success ?><br />
								</div>
                            </td>
                            <td class="copune_cd_descript" width="470"><span>Coupon Code:</span> 
                            	<strong id="coupon_code_<?php echo $coupon["CouponID"] ?>"><?php echo $coupon["CouponCode"] ?></strong>
								<div id="coupon_Tool_tip_action_<?php echo $coupon["CouponID"] ?>" class="couponTooltip">Click to copy &amp; open site</div>
								<script language="javascript" type="text/javascript" >
									set_copy_command ( "<?php echo $coupon["CouponCode"] ?>" , "coupon_code_<?php echo $coupon["CouponID"] ?>" , <?php echo $coupon["CouponID"] ?> ) ;
								</script>
                            	<br />
                            	<small><?php echo $coupon["Description"] ?></small>
                            </td>
                            <td class="work_cp">
                            	<?php
									$coupon_detail = $data->select ( "VotingLog" , "*" , array ( "CouponID" => intval ( $coupon["CouponID"] ) , "IP" => $_SERVER['REMOTE_ADDR'] ) ) ;

									if ( empty ( $coupon_detail ) )
									{
								?>
								<form class="voting" action="<?php echo base_url ?>voting_post/" method="post" id="frm_voting_<?php echo $coupon["CouponID"] ?>">
									<p>Did this coupon work for you?</p>
									<button class="yesVote" name="vote_code" type="submit" value="1" ><span>1</span></button>
									<button class="noVote" name="vote_code" type="submit" value="0" ><span>0</span></button>
									<input name="CouponID" value="<?php echo $coupon["CouponID"] ?>" type="hidden" />
								</form>
								<?php
									}
								?>
                            </td>
                        </tr>
                        <tr bgcolor="#f9fbee">
                        	<td colspan="3" class="shared_cp">
                            
								<div class="collateral">
									<div class="meta">
										Shared <?php echo date ( "F j, Y" , strtotime ( $coupon["DateAdded"] ) ) ?>
									</div>
									<ul class="commentActions">
										<?php
											$num_comments = 0 ;
											$num_comments = $data->count_record ( "Comment" , array ( "CouponID" => intval ( $coupon["CouponID"] ) , "IsApproved" => 1 ) ) ;
										?>
										<li class="toggleComments">
											
											<a href="javascript:void(0);" style="<?php echo $num_comments == 0 ? "display:none" : "" ?>" onclick="show_comments(<?php echo $coupon["CouponID"] ?>);"> <?php echo intval ( $num_comments ) ?> comments</a>
										</li>
										<li class="writeComment" id="li_write_comments_<?php echo $coupon["CouponID"] ?>" >
											<a href="javascript:void(0);" style="<?php echo $num_comments == 0 ? "display:block;" : "" ?>" onclick="show_window_comment(<?php echo $coupon["CouponID"] ?>);">Add comment</a>
										</li>
										<li class="closeComments" id="li_close_comments_<?php echo $coupon["CouponID"] ?>">
											<a href="javascript:void(0);" onclick="close_comments(<?php echo $coupon["CouponID"] ?>);">Close comments</a>
										</li>
									</ul>
								</div>
								<div class="comments" id="div_comments_<?php echo $coupon["CouponID"] ?>">
								<?php
									$comments = $data->select ( "Comment" , "*" , array ( "CouponID" => intval ( $coupon["CouponID"] ) , "IsApproved" => 1 ) , 0 , 150 , " DateAdded desc" ) ;
									if ( ! empty ( $comments ) )
									{
										foreach ( $comments as $comment )
										{
								?>
									<div>
										<span class="defaultAvatar"> &nbsp; </span>
										<p><?php echo $comment["Comments"] ?></p>
										<p class="attribution">[<?php echo $comment["UserName"] ?> posted <?php echo $comment["DateAdded"] ?>]</p>
									</div>
								<?php
										}
									}
								?>
								</div>
                                
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
								<div class="stats deal"> &nbsp; </div>
                            </td>
                            <td class="copune_cd_descript" width="470"><span><a href="<?php echo base_url ?>d/<?php echo $offer["Website_OffersID"] ?>/" target="_blank" rel="nofollow"><?php echo $offer["OfferTitle"] ?></a></span> 
                            	<small><?php echo $offer["Description"] ?></small>
                            </td>
                            <td class="work_cp">
                            	<a href="<?php echo base_url ?>d/<?php echo $offer["Website_OffersID"] ?>/" target="_blank" rel="nofollow">more</a>
                            </td>
                        </tr>
                        <tr bgcolor="#f9fbee">
                        	<td colspan="2" class="shared_cp">Shared <?php echo date ( "F j, Y" , strtotime ( $offer["StartDate"] ) ) ?></td>
                            <td class="add_comment_cp"> </td>
                        </tr>
                    </table>
						<?php
							}
					}
				?>
    
                <div style="vertical-align:top;">
                    <?php
                        $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Store Bottom" ) ) ;
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
                        $g_ads = $data->select ( "MarketingAdManager" ,"*", array ( "MarketingPlacing" => "Store Side Bar" ) ) ;
                        if ( ! empty ( $g_ads ) )
                            foreach ( $g_ads as $g_ad )
                                echo $g_ad["MarketingScript"]."<br />" ;
                    ?>
                </div>

            	<?php include ( "inc.big_thumb.php" ) ?>
            	<?php include ( "inc.share.php" ) ?>
            	<?php include ( "inc.similar_tags.php" ) ?>
            	<?php include ( "inc.social.php" ) ?>
            </div>
        </div>
        <?php include ( "inc.footer.php" ) ?>
    </div>
</div>
</div>
</body>
</html>