<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 0;


	$sS = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "SiteVersion" ) , 0 , 50 ) ;
	foreach ( $sS as $s ){
		$dArray[$s["SiteVariable"]] = $s["SiteValue"] ;
	}

	$file = 'http://www.couponsitescript.com/version.php?host=' . urlencode($_SERVER['SERVER_NAME']); 
	$handle = @fopen($file, "r");
	if ($handle)
	{
	$ver = fread($handle, 4096);
	fclose($handle);
	
	if($dArray["SiteVersion"]!=$ver) $_SESSION["str_system_message"] = "<a target='_blank' href='http://www.couponsitescript.com/updates'>New version of script is available. ($ver)</a> " ;
	else $_SESSION["str_system_message"] = "Your script is up to date. ($ver)" ;

	if ($ver=='-1') 
	{
		header("Location: http://www.couponsitescript.com/no-license");
		echo "No license.";
		exit;
	}
	
	if (!$ver)  $_SESSION["str_system_message"] = "Your domain is not currently licensed. Please <a target='_blank' href='http://www.couponsitescript.com/register'>register your domain name</a> to use this legally and get latest version information." ;
	}
	else
	{
		$_SESSION["str_system_message"] = "Please enable allow_url_fopen to make sure you're using this legally and enable version checking.";
	}
	


	
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
		<h3> Application Summary </h3>
		<table cellspacing="8" cellpadding="0" border="0" width="100%" style="border:#cccccc 1px solid; background-color:#FFFFFF;">
			<tr>
				<td style="width:50%; margin-left:6px; background-color:#FFFFFF;"><table cellspacing="8" cellpadding="0" border="0" width="100%" style="border:#CCCCCC 1px solid; padding:6px; background-color:#FFFFFF;">
						<tr>
							<td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td class="menu_top_link" style="width:65%;font-weight:bold;"><a href="weblisting.php?st=1" class="mainpage1">Active Stores </a></td>
							<td class="textValue" ><?php
									echo $data->count_record ( "Website" , array ( "IsActive" => 1 ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="mainpage1"><a href="weblisting.php?st=2"  class="mainpage1">Pre-Active Stores</a></td>
							<td class="textValue"><?php
									echo $data->count_record ( "Website" , array ( "IsActive" => '2' ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="mainpage1"><a href="weblisting.php?st=3"  class="mainpage1">New Self-Made Stores</a></td>
							<td class="textValue"><?php
									echo $data->count_record ( "Website" , array ( "IsActive" => '3' ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="mainpage1"><a href="weblisting.php?st=0"  class="mainpage1">InActive Stores</a></td>
							<td class="textValue"><?php
									echo $data->count_record ( "Website" , array ( "IsActive" => '0' ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td class="mainpage1"><a href="comments.php?st=1" class="mainpage1">Active Comments</a></td>
							<td class="textValue"><?php
                            		echo $data->count_record ( "Comment" , array ( "IsApproved" => '1' ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="mainpage1"><a href="comments.php?st=0" class="mainpage1">InActive Comments</a></td>
							<td class="textValue"><?php
                            		echo $data->count_record ( "Comment" , array ( "IsApproved" => '0' ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td class="menuOption"  align="left">&nbsp;</td>
							<td class="textValue">&nbsp;</td>
						</tr>
					</table></td>
				<td style="width:50%; margin-left:6px; background-color:#FFFFFF;"><table cellspacing="8" cellpadding="0" border="0" width="100%" style="border:#cccccc 1px solid; padding:6px; background-color:#FFFFFF;">
						
						
						<tr>
							<td class="textTitle" style="color:#990000;font-size:16px;font-weight:bold;" colspan="2">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td class="menu_top_link" style="width:65%;font-weight:bold;"><a href="couponlisting.php?st=1" class="mainpage1">Active Coupons </a></td>
							<td class="textValue" ><?php
									echo $data->count_record ( "Coupon" , array ( "IsApproved" => 1 ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="mainpage1"><a href="couponlisting.php?st=0"  class="mainpage1">InActive Coupons</a></td>
							<td class="textValue"><?php
									echo $data->count_record ( "Coupon" , array ( "IsApproved" => '0' ) ) ;
								?></td>
						</tr>
						<tr>
							<td class="textTitle" colspan="2">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td class="textTitle">Offers</td>
							<td class="textValue"><?php
									echo $data->count_record ( "Website_Offers" , NULL ) ;
								?></td>
						</tr>
						<tr>
							<td class="textTitle"><a href="expired_offers.php"  class="mainpage1">Offers Expired</a></td>
							<td class="textValue"><?php
									echo $data->count_record ( "Website_OffersExpired" , NULL ) ;
								?></td>
						</tr>
						<tr>
							<td class="textTitle" colspan="2">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td class="textTitle"><a href="taglist.php" class="mainpage1">Total Tags </a></td>
							<td class="textValue"><?php
									echo $data->count_record ( "Tag" , NULL ) ;
								?></td>
						</tr>
						<tr>
							<td class="textTitle" colspan="2">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td class="textTitle"></td>
							<td class="textValue">&nbsp;</td>
						</tr>
					</table></td>
			</tr>
		</table>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
	<?php include ( "inc.footer.php" ) ; ?>
	<!-- end #container -->
</div>
</body>
</html>
