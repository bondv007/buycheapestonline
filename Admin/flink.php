<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 2;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "Link_Footer" , "*" , array ( "ID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	if ( $_POST )
	{
		$postArray = $_POST ;
		if ( intval ( $postArray["ID"] > 0 ) )
		{
			$dataValues = array ( ) ;
			foreach ( $postArray as $field => $value )
			{
				if ( strchr ( $field , "_Setting_" ) )
				{
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = $value ;
				}
			}
			$data->update ( "Link_Footer" , $dataValues , array ( "ID" => $postArray["ID"] ) ) ;
			
			$_SESSION["str_system_message"] = "Link modified successfully." ;
			header ( "location:flinklist.php" ) ;
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
					$dataValues[$fName] = $value ;
				}
			}
			$name_check = $data->select ( "Link_Footer" , "*" , array ( "Name" => $_POST["Name_Setting_"] ) ) ;
			if ( empty ( $name_check ) )
			{
				$id = $data->insert ( "Link_Footer" , $dataValues ) ;
				if ( intval ( $id ) > 0 )
				{
					$_SESSION["str_system_message"] = "Link added successfully." ;
				}
				header ( "location:flinklist.php" ) ;
				exit ( ) ;
			}
			else
			{
				$_SESSION["str_system_message"] = "Link with this name already exits." ;
			}
			
		}
		
	}
	
	
	$siteSettings = null ;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php include ( "inc.meta.php" ) ; ?>
	<style>
		#ul_categories
		{
			list-style-type:none;
			cursor:pointer;
			margin-left:18px;
			padding:5px;
			font-size:12px;
			
		}
		#ul_categories span
		{
			background-image:url(images/icons/bullet_go.png);
			background-position:left;
			background-repeat:no-repeat;
			padding-left:15px;
		}
		
	</style>
	
	<!-- Copyright 2000, 2001, 2002, 2003 Macromedia, Inc. All rights reserved. -->
	</head>
	<body class="oneColElsCtrHdr">
		<div id="container">
			<?php include ( "inc.header.php" ) ; ?>
			<div id="mainContent">
				<h3>Twitter Account</h3>
				<div align="center">
					<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
						<table cellpadding="2" cellspacing="1" width="70%">
							<tr>
								<td width="24%" valign="top" class="form_title" >Name</td>
								<td width="76%" valign="top"><input type="text" name="Name_Setting_" size="50" maxlength="250" class="form_text" value="<?php echo $form_data["Name"] ?>"  sch_req="1" sch_msg="Name"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Name for footer link
								</div></td>
							</tr>
							<tr>
								<td width="24%" valign="top" class="form_title" >Link</td>
								<td width="76%" valign="top"><input type="text" name="Link_Setting_" size="50" maxlength="250" class="form_text" value="<?php echo $form_data["Link"] ?>"  sch_req="1" sch_msg="Link"  />
									<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
									<div class="div_help">
										Link for footer link
									</div></td>
							</tr>
							<tr>
								<td colspan="10" class="form_title" align="right" >
								<input type="hidden" name="ID" value="<?php echo $form_data["ID"] ?>" />
								<input type="submit" value="Save Account" class="submit_button" />
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
