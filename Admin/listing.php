<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 0;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	if ( $_POST )
	{
		foreach ( $_POST as $fieldName => $fieldValue )
		{
			if ( strchr ( $fieldName , "_Setting_" ) )
			{
				$fName = str_replace ( "_Setting_" , "" , $fieldName ) ;
				$data->update ( "SiteManager" , array ( "SiteValue" => $fieldValue ) , array ( "SiteVariable" => $fName ) ) ;
			}
		}
	}
	$siteSettings = $data->select2 ( "SELECT * FROM SiteManager" ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	
	$siteSettings = null ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3> Listings Management </h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data">
						<table cellpadding="2" cellspacing="1" width="70%">
							<tr>
								<td width="34%" valign="top" class="form_title">Popular Stores (Main Page)</td>
								<td width="66%" valign="top"><input type="text" name="PopularStoresHome_Setting_" class="form_text" value="<?php echo $dataArray["PopularStoresHome"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum number of Popular stores main page 
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top">Featured Stores  (Main Page)</td>
								<td valign="top"><input type="text" name="FeaturedStoresHome_Setting_" class="form_text" value="<?php echo $dataArray["FeaturedStoresHome"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum featured Stores on Main page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top">Featured Coupons (Main Page)</td>
								<td valign="top"><input type="text" name="FeaturedCouponsHome_Setting_" class="form_text" value="<?php echo $dataArray["FeaturedCouponsHome"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum Sponsored coupons on Main page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top">New Coupons (Main Page)</td>
								<td valign="top"><input type="text" name="NewCouponsHome_Setting_" class="form_text" value="<?php echo $dataArray["NewCouponsHome"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='10' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Maximum Sponsored coupons on mian page.
									</div></td>
							</tr>
							<tr>
								<td class="form_title" valign="top" >Records Per Page  (Admin Page)</td>
								<td valign="top"><input type="text" name="RecordsPerPage_Setting_" class="form_text" value="<?php echo $dataArray["RecordsPerPage"] ?>" onblur="if ( isNaN ( this.value ) || parseInt ( this.value )< 1 ) this.value='20' ;" />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										No of records on listing pages from main sections of the administrator panel.
									</div></td>
							</tr>
							
							<tr>
								<td colspan="10" class="form_title" align="right" >
									<input type="submit" value="Save Listing Settings" class="submit_button" />
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<?php include ( "inc.footer.php" ) ; ?>
			<!-- end #container -->
		</div>
	</body>
</html>
