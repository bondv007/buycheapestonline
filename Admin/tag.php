<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 3;
	if ( intval ( $_SESSION["admin_rights"]["r_tag"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	include_once ( "../classes/misc.func.php" ) ;
	if ( intval ( $_GET["id"] ) > 0 )
	{
		$dataArray = $data->select ( "Tag" , "*" , array ( "TagID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	if ( $_POST )
	{
		$postArray = $_POST ;
		if ( intval ( $_POST["TagID"] ) > 0 )
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
			
			$data->update ( "Tag" , $dataValues , array ( "TagID" => $postArray["TagID"] ) ) ;
			re_generate_sef_url ( $postArray["Tag_Setting_Name"] , $postArray["TagID"] , "Tag" ) ;
			$data->delete ( "Tag_Offers" , array ( "TagID" => $postArray["TagID"] ) , 50 ) ;
			if ( ! empty ( $_POST["EF_Title"] ) )
			{
				exec ( "chmod ../media/ 777" ) ;
				foreach ( $_POST["EF_Title"] as $key => $val )
				{
					if ( $val != "" )
					{
						$araay_to = array ( 
												"TagID" => $postArray["TagID"],
												"OfferTitle" => $val,
												"Description" => $_POST["EF_Description"][$key],
												"LandingPage" => $_POST["EF_URL"][$key],
												"Image" => $_FILES["EF_Image"]["name"][$key],
											) ;
						if ( $_FILES["EF_Image"]["name"][$key] != "" )
						{
							
							move_uploaded_file( $_FILES["EF_Image"]["tmp_name"][$key] , "../media/".$_FILES["EF_Image"]["name"][$key] ) ;
						}
						$data->insert ( "Tag_Offers" , $araay_to ) ;
					}
				}
				exec ( "chmod ../media/ 755" ) ;
			}
			$_SESSION["str_system_message"] = "Tag Modified successfully." ;
			header ( "location:taglist.php" ) ;
			exit();
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
			$tag_prev = $data->select ( "Tag" , "*" , array ( "TagName" => $dataValues["TagName"] ) ) ;
			if ( empty ( $tag_prev ) )
			{
				$id = $data->insert ( "Tag" , $dataValues ) ;
				generate_sef_url ( $_POST["Tag_Setting_Name"] , $id , "Tag" ) ;
				if ( intval ( $id ) > 0 )
				{
					if ( ! empty ( $_POST["EF_Title"] ) )
					{
						exec ( "chmod ../media/ 777" ) ;
						foreach ( $_POST["EF_Title"] as $key => $val )
						{
							if ( $val != "" )
							{
								$araay_to = array ( 
														"TagID" => $id,
														"OfferTitle" => $val,
														"Description" => $_POST["EF_Description"][$key],
														"LandingPage" => $_POST["EF_URL"][$key],
														"Image" => $_FILES["EF_Image"]["name"][$key],
													) ;
								if ( $_FILES["EF_Image"]["name"][$key] != "" )
								{
									move_uploaded_file( $_FILES["EF_Image"]["tmp_name"][$key] , "../media/".$_FILES["EF_Image"]["name"][$key] ) ;
								}
								$data->insert ( "Tag_Offers" , $araay_to ) ;
							}
						}
						exec ( "chmod ../media/ 755" ) ;
					}
					$_SESSION["str_system_message"] = "Tag added successfully." ;
					header ( "location:taglist.php" ) ;
					exit();
				}
			}
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>
<script language="javascript">
	function alert_del ( obj_id , obj_text )
	{
		if ( parseInt ( obj_id ) > 0 )
		{
			var yes_no = window.confirm ( "Are you sure you want to delete "+obj_text+" ?" ) ;
			if ( yes_no )
				window.location = "p.delete_tag.php?id="+obj_id ;
		}
	}
</script>
</head>
<body class="oneColElsCtrHdr">
<div id="container">
	<?php include ( "inc.header.php" ) ; ?>
	<div id="mainContent">
		<h3> Add Tag </h3>

			<form action="" method="post" class="application_form" enctype="multipart/form-data">
				<table width="70%">
					<tr>
						<td width="24%" class="form_title">Tag : </td>
						<td width="76%"><input type="text" name="Tag_Setting_Name" value="<?php echo $form_data["TagName"] ?>" maxlength="80" size="50" /></td>
					</tr>
					<tr>
						<td width="24%" class="form_title">SEO Title: </td>
						<td width="76%"><input type="text" name="SEOTitle_Setting_" value="<?php echo $form_data["SEOTitle"] ?>" maxlength="200" size="50" /></td>
					</tr>
					<tr>
						<td width="24%" class="form_title">SEO Keywords: </td>
						<td width="76%"><input type="text" name="SEOKeyword_Setting_" value="<?php echo $form_data["SEOKeyword"] ?>" maxlength="200" size="50" /></td>
					</tr>
					<tr>
						<td width="24%" class="form_title">Description : </td>
						<td width="76%"><textarea type="text" name="Tag_Setting_Description"  cols="50" rows="4" ><?php echo $form_data["TagDescription"] ?></textarea></td>
					</tr>
					<script language="javascript">
						function add_extra_field ( )
						{
							var tableString = "<table width='100%' style='border-bottom:#000000 solid 1px;'><tr><td width='29%'>Title </td><td><input type='text' name='EF_Title[]' size='40' maxlength='99' /> </td></tr><tr><td>Website or Affiliate URL</td><td><input type='text' name='EF_URL[]' size='50'></td></tr><tr><td>Description</td><td><textarea name='EF_Description[]' rows='2' cols='45' ></textarea></td></tr><tr><td>Image</td><td><input type='file' name='EF_Image[]' /></td></tr></table>" ;
							$("#div_extra_fields").append ( tableString ) ;
						}
						function remove_offer ( offer_id )
						{
							if ( window.confirm ( "Are you sure you want to delete this offer ?" ) )
								window.location = "p.delete_offer.php?id="+offer_id ;
						}
					</script>
					<tr>
						<td width="24%" class="form_title">Offers : </td>
						<td width="76%">
							<input type="button" value="Add Offer" onclick="add_extra_field();" />
							<div id="div_extra_fields" style="font-weight:normal; font-size:12px;">
								<?php
									if ( intval ( $form_data["TagID"] ) > 0 )
									{
										$offers = $data->select ( "Tag_Offers" , "*" , array ( "TagID" => $form_data["TagID"] ) ) ;
										if ( ! empty ( $offers ) )
										{
											foreach ( $offers as $offer )
											{
										?>
											<div id="div_offer_<?php echo $offer["Tag_OffersID"]; ?>">
												<div style="margin:3px; border-top:#CCCCCC solid 1px;" align="right"><img src="images/icons/cancel.png" width="16" height="16" border="0" onclick="remove_offer ( <?php echo $offer["Tag_OffersID"]; ?> ) ;" /></div>
											<table width='100%'  style='border-bottom:#000000 solid 1px;'><tr><td width="29%">Title </td><td width="71%"><input type='text' name='EF_Title[]' size='40' maxlength='99' value="<?php echo $offer["OfferTitle"] ?>" /> </td></tr><tr><td>Website or Affiliate URL </td><td><input type='text' name='EF_URL[]' size="50" value="<?php echo $offer["LandingPage"] ?>"></td></tr><tr><td>Description</td><td><textarea name='EF_Description[]' rows='2' cols='45' ><?php echo $offer["Description"] ?></textarea></td></tr></table>
											</div>
										<?php
											}
										}
									}
								?>
							</div>
						
						</td>
					</tr>
					
					<tr>
						<td colspan="10" class="application_form"><input type="hidden" name="TagID" value="<?php echo $form_data["TagID"] ?>"  />
							<input type="submit" value="Save Tag"  class="submit_button"  /></td>
					</tr>
					
				</table>
			</form>
			

		
		<br />
		<br />
	</div>
	<?php include ( "inc.footer.php" ) ; ?>
	<!-- end #container -->
</div>
</body>
</html>
