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
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	
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
				<h3> Social Networking </h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data">
						<table cellpadding="2" cellspacing="1" width="70%">
						
						<?php
							if ( ! empty ( $siteSettings ) )
							foreach ( $siteSettings as $site ) :
								if ( strchr ( $site["SiteVariable"] , "SocialNet_" ) )
								{
						?>
					
							<tr>
								<td width="34%" valign="top" class="form_title" ><?php echo str_replace ( "SocialNet_" , "" ,  $site["SiteVariable"] ) ?></td>
								<td width="66%" valign="top"><textarea type="text" name="<?php echo $site["SiteVariable"] ?>_Setting_" cols="60" rows="3" class="form_textarea"  ><?php echo $site["SiteValue"] ?></textarea>
									
									</td>
							</tr>
						<?php
								}
							endforeach ;
						?>
							
							
							
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
