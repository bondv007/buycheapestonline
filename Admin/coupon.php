<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 6;
	
	if ( intval ( $_SESSION["admin_rights"]["r_coupon"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "Coupon" , "*" , array ( "CouponID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	else if ( intval ( $_GET["webid"] ) < 1 )
	{
		header ( "location:selectweb.php" ) ;
		exit();
	}
	if($form_data["Expiry"]==0) $form_data["Expiry"]=60;
	
	$webid = intval ( $_GET["webid"] ) > 0 ? intval ( $_GET["webid"] ) : intval ( $form_data["WebsiteID"] ) ;
	$webdetail = $data->select ( "Website" , "*" , array ( "WebsiteID" => $webid ) ) ;
	if ( ! empty ( $webdetail ) )
		$webdetail = $webdetail[0] ;
	
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		
		if ( intval ( $postArray["CouponID"] > 0 ) )
		{
			$dataValues = array ( ) ;
			foreach ( $postArray as $field => $value )
			{
				if ( strchr ( $field , "_Setting_" ) )
				{
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = stripslashes($value) ;
				}
			}
			$t = explode('/', $dataValues["StartDate"]);
			$dataValues["StartDate"] = $t[2].'-'.$t[0].'-'.$t[1];
			$t = explode('/', $dataValues["EndDate"]);
			$dataValues["EndDate"] = $t[2].'-'.$t[0].'-'.$t[1];
			
			$data->update ( "Coupon" , $dataValues , array ( "CouponID" => $postArray["CouponID"] ) ) ;
			
			
			$_SESSION["str_system_message"] = "Coupon modified successfully." ;
			header ( "location:couponlisting.php" ) ;
			exit ( ) ;
		}
		else
		{
			
			$dataValues = array ( ) ;
			
			foreach ( $postArray as $field => $value )
			{
				if ( strchr ( $field , "_Setting_" ) && $value != "" )
				{
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = stripslashes($value) ;
				}
			}
			$t = explode('/', $dataValues["StartDate"]);
			$dataValues["StartDate"] = $t[2].'-'.$t[0].'-'.$t[1];
			$t = explode('/', $dataValues["EndDate"]);
			$dataValues["EndDate"] = $t[2].'-'.$t[0].'-'.$t[1];
			
			$coupon_prev = $data->select ( "Coupon" , "*" , array ( "WebsiteID" => $dataValues["WebsiteID"] , "CouponCode" => $dataValues["CouponCode"] ) ) ;
			if ( empty ( $coupon_prev ) )
			{
			
				$id = $data->insert ( "Coupon" , $dataValues ) ;
				if ( intval ( $id ) > 0 )
				{
					$_SESSION["str_system_message"] = "Coupon added successfully." ;
				}
			}
			else
			{
				$form_data = $dataValues ;
				$_SESSION["str_system_message"] = "Coupon of this site already exists." ;
			}
			
			header ( "location:couponlisting.php" ) ;
			exit ( ) ;
		}
		
	}
	
	
	$siteSettings = null ;
	
	$t = explode('-', $form_data["StartDate"]); $sdate = $t[1].'/'.$t[2].'/'.$t[0]; 
	$t = explode('-', $form_data["EndDate"]); $edate = $t[1].'/'.$t[2].'/'.$t[0]; 
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
		<h3> Coupon </h3>
		<div align="center">
			<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
				<table cellpadding="2" cellspacing="1" width="70%" >
					
					<?php
						if ( ! empty ( $webdetail ) )
						{
					?>
						<tr>
							<td colspan="10">
								<div style="padding:10px; border-bottom:#000099 solid 1px; font-size:14px">
									<table>
										<tr>
											<td valign="top">
												<img src="../media/<?php echo $webdetail["WebsiteID"] ?>.jpg" border="0" />
											</td>
											<td valign="top">
												<?php
													echo $webdetail["WebsiteTitle"]."<br>" ;
													echo "<span style='font-weight:normal; font-size:11px;'>".$webdetail["Description"]."</span>" ;
												?>
											</td>
										</tr>
									</table>
									
								</div>
							</td>
						</tr>
					
					<?php
						}
					?>
					
					
					<tr>
						<td width="24%" valign="top" class="form_title" >Coupon Code </td>
						<td width="76%" valign="top"><input type="text" name="CouponCode_Setting_" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["CouponCode"] ?>"  sch_req="1" sch_msg="Coupon Code"  />
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> The title of the website to display on the site. </div></td>
					</tr>
					
					<tr>
						<td width="24%" valign="top" class="form_title" >Discount </td>
						<td width="76%" valign="top"><textarea type="text" name="_Setting_Description"  class="form_textarea" rows="4" cols="50" ><?php echo $form_data["Description"] ?></textarea>
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> This description will be shown to user when searching or listing is filtered to this Website. </div></td>
					</tr>
					
					<tr>
						<td width="24%" valign="top" class="form_title" >Expiry </td>
						<td width="76%" valign="top"><input type="text" name="_Setting_Expiry"  class="form_text" value="<?php echo $form_data["Expiry"] ?>" /> Days
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help">
								  Number of days the coupon to be expired automaticaly. ZERO or empty for no expiry. 
							</div></td>
					</tr>
					
					<tr>
						<td width="24%" valign="top" class="form_title" >Start Date </td>
						<td width="76%" valign="top"><input type="text" name="_Setting_StartDate"  class="form_text" value="<?php echo $sdate; ?>" /> <span style="font-size:11px; font-weight:normal; color:#666666">e.g: mm/dd/yyyy</span>
						</td>
					</tr>
					<tr>
						<td width="24%" valign="top" class="form_title" >End Date </td>
						<td width="76%" valign="top"><input type="text" name="_Setting_EndDate"  class="form_text" value="<?php echo $edate; ?>" /> <span style="font-size:11px; font-weight:normal; color:#666666">e.g: mm/dd/yyyy</span>
						</td>
					</tr>
					<tr>
						<td width="24%" valign="top" class="form_title" >Coupon Link </td>
						<td width="76%" valign="top"><input type="text" name="_Setting_CouponLink"  class="form_text" size="60" value="<?php echo $form_data["CouponLink"]; ?>" /> 
						</td>
					</tr>
					
					<tr>
						<td colspan="10" class="form_title" align="right" >
							<input type="hidden" name="Website_Setting_ID" value="<?php echo $webid ?>" />
							<input type="hidden" name="CouponID" value="<?php echo $form_data["CouponID"] ?>" />
							<input type="submit" value="Save Coupon" class="submit_button" />						</td>
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
