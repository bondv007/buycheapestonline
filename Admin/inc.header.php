<table width="99%">
	<tr>
		<td colspan="100" >
			<div id="header">
	<table width="100%">
		<tr>
			<td width="27%"><h1><a href="<?php echo base_url ?>"> <img src="../media/logo.png" alt="Your Logo here" border="0" /> </a> </h1></td>
			<td width="73%" align="right"><?php
						if ( intval ( $_SESSION["login_admin_id"] ) > 0 )
						{
					?>
				<div > Login as : <?php echo $_SESSION["login_admin_email"] ; ?> <br />
					<br />
					<a href="ch_pass.php" style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:14px;"> <img src="images/icons/key.png" border="0" /> Change Password </a> <br />
					<a href="logout.php" style="color:#ffffff; text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:14px;"> <img src="images/icons/cross_octagon.png" border="0" /> Logout </a> </div>
				<?php
						}
					?>
			</td>
		</tr>
	</table>
	
	</div>
		<?php
				if ( $_SESSION["str_system_message"] != null )
				{
				?>
				<div class="system_message"> <?php echo $_SESSION["str_system_message"] ; $_SESSION["str_system_message"] = null ; ?> </div>
				<?php
				}
				?>
		</td>
	</tr>
	<tr>
		<?php
			if ( intval ( $_SESSION["login_admin_id"] ) > 0 )
			{
		?>
		<td valign="top" style="width:250px;">
			
			<div id="menu">
				<div align="left" style="background-image:none; margin-left:10px;"> <a href="home.php" class="menu_top_link"> <img src="images/icons/house.png" /> Home </a> &nbsp; &nbsp; <a href="<?php echo base_url ?>" class="menu_top_link" target="_blank"> <img src="images/icons/world.png" /> Visit Site </a> </div>
				<?php
						if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/hammer_screwdriver.png" /> <a href="#">General Settings</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/table.png" /> <a href="sitesettings.php"> General Settings </a> </div>
						<div class="submenu"> <img src="images/icons/database_table.png" /> <a href="googleads.php"> Banners </a> </div>
						<div class="submenu"> <img src="images/icons/table_sort.png" /> <a href="listing.php"> Listing Settings </a> </div>
						<div class="submenu"> <img src="images/icons/application_cascade.png" /> <a href="socialnetwork.php"> Social Network </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="expired_offers.php"> Expired Offers Settings </a> </div>
                    </div> 
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/page_white_wrench.png" /> <a href="#">Marketing Settings</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/add.png" /> <a href="taccount.php"> Add Account for Twitter </a> </div>
						<div class="submenu"> <img src="images/icons/page_copy.png" /> <a href="taccountlist.php"> List Accounts for Twitter </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="tsettings.php"> Twitter Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="rss_settings.php"> RSS Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="blogger_settings.php"> Blogger Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="wordpress_settings.php"> Wordpress Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="emailtoblog_settings.php"> Email to Blog Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="posterous_settings.php"> Posterous Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="tumblr_settings.php"> Tumblr Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="export_asnoop.php"> Export aSnoop.com </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="flickr_settings.php"> Flickr Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="youtube_settings.php"> Youtube Offers Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="youtube_store_settings.php"> Youtube Store Settings </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="aw_settings.php"> Affilate Window Settings </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_page"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/layout.png" /> <a href="#">Static Page</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/add.png" /><a href="s_page.php"> Add New </a> </div>
						<div class="submenu"> <img src="images/icons/page_copy.png" /><a href="s_pages.php"> Pages List </a> </div>
						<div class="submenu"> <img src="images/icons/add.png" /><a href="flink.php"> Add New Footer Link </a> </div>
						<div class="submenu"> <img src="images/icons/page_copy.png" /><a href="flinklist.php"> Footer links list </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_tag"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/pencil.png"  /> <a href="#">Tags</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/add.png" /><a href="tag.php"> Add Tags </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_edit.png" /> <a href="taglist.php"> Manage Tags </a> </div>
						<div class="submenu"> <img src="images/icons/alarm.png" /> <a href="tagsettings.php"> Tag Optimizer Settings </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_website"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/computer.png" /> <a href="#">Stores</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/add.png" /> <a href="website.php"> Add Store </a> </div>
						<div class="submenu"> <img src="images/icons/page_copy.png" /> <a href="weblisting.php"> All Stores </a> </div>
						<div class="submenu"> <img src="images/icons/heart.png" /> <a href="weblisting.php?st=1"> Active Stores </a> </div>
						<div class="submenu"> <img src="images/icons/asterisk_orange.png" /> <a href="weblisting.php?st=2"> Pre-Active Stores </a> </div>
						<div class="submenu"> <img src="images/icons/asterisk_orange.png" /> <a href="weblisting.php?st=3"> New Self Made Stores </a> </div>
						<div class="submenu"> <img src="images/icons/heart_empty.png" /> <a href="weblisting.php?st=0"> InActive Stores </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/application_get.png" /> <a href="#">Imports</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls1.php"> Google Affiliate Newtork </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls7.php"> GAN Links </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls2.php"> LinkShare </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="linkshare_settings.php"> Linkshare Settings </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls3.php"> Avangate </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls4.php"> ShareASale </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls5.php"> CJ </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls5_2.php"> CJ v2</a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_xls6.php"> Regnow </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="import_website.php"> Websites </a> </div>
					</div>
		        <?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_coupon"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/photo.png" /> <a href="#">Coupons</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/add.png" /> <a href="selectweb.php"> Add Coupon </a> </div>
						<div class="submenu"> <img src="images/icons/page_copy.png" /> <a href="couponlisting.php"> All Coupons </a> </div>
						<div class="submenu"> <img src="images/icons/heart.png" /> <a href="couponlisting.php?st=1"> Active Coupons </a> </div>
						<div class="submenu"> <img src="images/icons/heart_empty.png" /> <a href="couponlisting.php?st=0"> InActive Coupons</a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_comment"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/script_edit.png" /> <a href="#">Comments</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/page_copy.png" /> <a href="comments.php"> All Comments </a> </div>
						<div class="submenu"> <img src="images/icons/heart.png" /> <a href="comments.php?st=1"> Active Comments </a> </div>
						<div class="submenu"> <img src="images/icons/heart_empty.png" /> <a href="comments.php?st=0"> InActive Comments </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_account"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/user_business.png" /> <a href="#">Accounts</a></div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/add.png" /> <a href="admin.php"> Add Administrator </a> </div>
						<div class="submenu"> <img src="images/icons/page_copy.png" /> <a href="adminlist.php"> All Administrator </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/envelope.png" /> <a href="#">Newsletter</a></div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/page_copy.png" /> <a href="nllist.php"> Listing Emails </a> </div>
					</div>
				<?php
						}
						if ( intval ( $_SESSION["admin_rights"]["r_home"] ) > 0 )
						{
				?>
				<div class="acc_trigger"> <img src="images/icons/application_get.png" /> <a href="#">Exports</a> </div>
					<div class="acc_container">
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="export_offer.php"> Export offers </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="export_website.php"> Export websites </a> </div>
						<div class="submenu"> <img src="images/icons/page_white_get.png" /> <a href="export_coupon.php"> Export coupons </a> </div>
					</div>
		        <?php
						}
				?>
			</div>
			
			<br />
		</td>
		<?php 
			}
		?>
		<td valign="top" align="left">
