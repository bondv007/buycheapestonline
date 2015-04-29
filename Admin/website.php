<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	require_once ( "../classes/thumb_maker.php" ) ;

	$_SESSION["menu_option"] = 4;
	if ( intval ( $_SESSION["admin_rights"]["r_website"] ) == 0 ){
		header ( "location:home.php" ) ;
		exit();
	}
	
	$form_data = array ( ) ;
	
	if ( intval ( $_GET["id"] ) > 0 ){
		$dataArray = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $_GET["id"] ) ) ) ;
		$form_data = $dataArray[0] ;
	}
	
	$siteSettings = $data->select ( "SiteManager" , "*" , null , 0 , 50 ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	
	$siteSettings = null ;
	
	if ( $_POST ){
		$postArray = $_POST ;
		
		if ( intval ( $postArray["WebsiteID"] > 0 ) ){
			$id = $postArray["WebsiteID"];
			$dataValues = array ( ) ;
			foreach ( $postArray as $field => $value ){
				if ( strchr ( $field , "_Setting_" ) ){
					$fName = str_replace ( "_Setting_" , "" , $field ) ;
					$dataValues[$fName] = str_replace ("'","",stripslashes($value)) ;
				}
			}
//			$dataValues["IsActive"] = 1 ;
			$data->update ( "Website" , $dataValues , array ( "WebsiteID" => $postArray["WebsiteID"] ) ) ;
			re_generate_sef_url ( $postArray["WebsiteTitle_Setting_"] , $postArray["WebsiteID"] , "Website" ) ;
			if ( $_FILES["fleIcon"]["name"] != "" ){

				move_uploaded_file ( $_FILES["fleIcon"]["tmp_name"] , "../media/".$postArray["WebsiteID"].".jpg" ) ;

				$web_name = str_replace(".","-",strtolower($postArray['WebsiteTitle_Setting_']));

				$tm = new dThumbMaker;
				$load = $tm->loadFile("../media/".$postArray["WebsiteID"].".jpg");
				if($load === true){
					$tm->createBackup();
					$tm->resizeMaxSize(240, 1000);
					$tm->build("../media/pic240/".$web_name.".jpg");
					@unlink("../media/".$postArray["WebsiteID"].".jpg");
				}
				
				$load = $tm->loadFile("../media/pic240/".$web_name.".jpg");
				if($load === true){
					$tm->createBackup();
					$tm->crop(0,0, 240, 174);
					$tm->build("../media/pic240crop/".$web_name.".jpg");
					$tm->loadFile("../media/pic240crop/".$web_name.".jpg");
					$tm->createBackup();
					$tm->resizeMaxSize(110, 80);
					$tm->build("../media/pic110/".$web_name.".jpg");
					$tm->restoreBackup();
					$tm->resizeMaxSize(65, 47);
					$tm->build("../media/pic65/".$web_name.".jpg");
					@unlink("../media/pic240crop/".$web_name.".jpg");
				}
			}
			
			$data->delete ( "Website_Tag" , array ( "WebsiteID" => $postArray["WebsiteID"] ) , 300 ) ;
			if ( ! empty ( $_POST["chkTag"] ) )
					foreach ( $_POST["chkTag"] as $tag )
						$data->insert ( "Website_Tag" , array ( "WebsiteID" => $_POST["WebsiteID"], "TagID" => $tag ) ) ;

			if ( ! empty ( $_POST["SEOKeyword_Setting_"] ) ){
				$key_temp = explode(",", $_POST["SEOKeyword_Setting_"]);
				$keywords = array( $key_temp[0], $key_temp[1], $key_temp[2]);
				foreach ( $keywords as $keyword ){
					$k = trim(stripslashes($keyword));
					if( $k != ''){
						$tag_prev = $data->select ( "Tag" , "*" , array ( "TagName" => $k ) ) ;
						if ( !empty ( $tag_prev ) ){
							$webtag_prev = $data->select ( "Website_Tag" , "*" , array ( "WebsiteID" => $id, "TagID" => $tag_prev[0]["TagID"] ) ) ;
							if ( empty ( $webtag_prev ) )
								$data->insert ( "Website_Tag" , array ( "WebsiteID" => $id, "TagID" => $tag_prev[0]["TagID"] ) ) ;
						}else{
							$adate = date("Y-m-d H:i:s");
							$tag = $k;
							$tdesc = str_replace('[tag]', $tag, $dataArray["TagDescription"]);
							$tseot = str_replace('[tag]', $tag, $dataArray["TagSEOTitle"]);
							$tseok = str_replace('[tag]', $tag, $dataArray["TagSEOKeyword"]);
							$araay_to = array ( 
											"TagName" => $k,
											"TagDescription " => $tdesc, 
											"SEOTitle" => $tseot,
											"SEOKeyword" => $tseok,
											"DateAdded" => $adate
												) ;
							$id_tag = $data->insert ( "Tag" , $araay_to ) ;
							generate_sef_url ( $k , $id_tag , "Tag" ) ;
							$data->insert ( "Website_Tag" , array ( "WebsiteID" => $id, "TagID" => $id_tag ) ) ;
						}
					}
				}
			}

			$data->delete ( "Website_Offers" , array ( "WebsiteID" => $postArray["WebsiteID"] ) , 100 ) ;
			if ( ! empty ( $_POST["EF_Title"] ) ){
				foreach ( $_POST["EF_Title"] as $key => $val ){
					if ( $val != "" ){
						$t = explode('/', $_POST["EF_SD"][$key]);
						$sdate = $t[2].'-'.$t[0].'-'.$t[1];
						$t = explode('/', $_POST["EF_ED"][$key]);
						$edate = $t[2].'-'.$t[0].'-'.$t[1];
						$araay_to = array ( 
												"WebsiteID" => $postArray["WebsiteID"],
												"OfferTitle" => $val,
												"Description" => $_POST["EF_Description"][$key],
												"LandingPage" => $_POST["EF_URL"][$key],
												"StartDate" => $sdate,
												"EndDate" => $edate,
												"Image" => $_FILES["EF_Image"]["name"][$key],
											) ;
						if ( $_FILES["EF_Image"]["name"][$key] != "" ){
							
							move_uploaded_file( $_FILES["EF_Image"]["tmp_name"][$key] , "../media/".$_FILES["EF_Image"]["name"][$key] ) ;
						}
						$data->insert ( "Website_Offers" , $araay_to ) ;
					}
				}
			}
			$_SESSION["str_system_message"] = "Website modified successfully." ;
			header ( "location:weblisting.php" ) ;
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
					$dataValues[$fName] = str_replace ("'","",stripslashes($value)) ;
				}
			}
//			$dataValues["IsActive"] = 1 ;
			$website_prev = $data->select ( "Website" , "*" , array ( "WebsiteTitle" => $dataValues["WebsiteTitle"] ) ) ;
			if ( empty ( $website_prev ) )
			{
				$id = $data->insert ( "Website" , $dataValues ) ;
				if ( intval ( $id ) > 0 )
				{
					generate_sef_url ( $_POST["WebsiteTitle_Setting_"] , $id , "Website" ) ;
					
					if ( ! empty ( $_POST["chkTag"] ) )
						foreach ( $_POST["chkTag"] as $tag )
							$data->insert ( "Website_Tag" , array ( "WebsiteID" => $id, "TagID" => $tag ) ) ;

					if ( ! empty ( $_POST["SEOKeyword_Setting_"] ) ){
						$key_temp = explode(",", $_POST["SEOKeyword_Setting_"]);
						$keywords = array( $key_temp[0], $key_temp[1], $key_temp[2]);
						foreach ( $keywords as $keyword ){
							$k = trim(stripslashes($keyword));
							if( $k != ''){
								$tag_prev = $data->select ( "Tag" , "*" , array ( "TagName" => $k ) ) ;
								if ( !empty ( $tag_prev ) ){
									$webtag_prev = $data->select ( "Website_Tag" , "*" , array ( "WebsiteID" => $id, "TagID" => $tag_prev[0]["TagID"] ) ) ;
									if ( empty ( $webtag_prev ) )
										$data->insert ( "Website_Tag" , array ( "WebsiteID" => $id, "TagID" => $tag_prev[0]["TagID"] ) ) ;
								}else{
									$adate = date("Y-m-d H:i:s");
									$tag = $k;
									$tdesc = str_replace('[tag]', $tag, $dataArray["TagDescription"]);
									$tseot = str_replace('[tag]', $tag, $dataArray["TagSEOTitle"]);
									$tseok = str_replace('[tag]', $tag, $dataArray["TagSEOKeyword"]);
									$araay_to = array ( 
													"TagName" => $k,
													"TagDescription " => $tdesc, 
													"SEOTitle" => $tseot,
													"SEOKeyword" => $tseok,
													"DateAdded" => $adate
														) ;
									$id_tag = $data->insert ( "Tag" , $araay_to ) ;
									generate_sef_url ( $k , $id_tag , "Tag" ) ;
									$data->insert ( "Website_Tag" , array ( "WebsiteID" => $id, "TagID" => $id_tag ) ) ;
								}
							}	
						}
					}
					
					if ( $_FILES["fleIcon"]["name"] != "" ){

						move_uploaded_file ( $_FILES["fleIcon"]["tmp_name"] , "../media/".$id.".jpg" ) ;

						$web_name = str_replace(".","-",strtolower($postArray['WebsiteTitle_Setting_']));

						$tm = new dThumbMaker;
						$load = $tm->loadFile("../media/".$id.".jpg");
						if($load === true){
							$tm->createBackup();
							$tm->resizeMaxSize(240, 1000);
							$tm->build("../media/pic240/".$web_name.".jpg");
							@unlink("../media/".$id.".jpg");
						}
						
						$load = $tm->loadFile("../media/pic240/".$web_name.".jpg");
						if($load === true){
							$tm->createBackup();
							$tm->crop(0,0, 240, 174);
							$tm->build("../media/pic240crop/".$web_name.".jpg");
							$tm->loadFile("../media/pic240crop/".$web_name.".jpg");
							$tm->createBackup();
							$tm->resizeMaxSize(110, 80);
							$tm->build("../media/pic110/".$web_name.".jpg");
							$tm->restoreBackup();
							$tm->resizeMaxSize(65, 47);
							$tm->build("../media/pic65/".$web_name.".jpg");
							@unlink("../media/pic240crop/".$web_name.".jpg");
						}
					}
					if ( ! empty ( $_POST["EF_Title"] ) ){
						foreach ( $_POST["EF_Title"] as $key => $val ){
							if ( $val != "" ){
								$t = explode('/', $_POST["EF_SD"][$key]);
								$sdate = $t[2].'-'.$t[0].'-'.$t[1];
								$t = explode('/', $_POST["EF_ED"][$key]);
								$edate = $t[2].'-'.$t[0].'-'.$t[1];
								$araay_to = array ( 
														"WebsiteID" => $id,
														"OfferTitle" => $val,
														"Description" => $_POST["EF_Description"][$key],
														"LandingPage" => $_POST["EF_URL"][$key],
														"StartDate" => $sdate,
														"EndDate" => $edate,
														"Image" => $_FILES["EF_Image"]["name"][$key],
													) ;
								if ( $_FILES["EF_Image"]["name"][$key] != "" ){
									move_uploaded_file( $_FILES["EF_Image"]["tmp_name"][$key] , "../media/".$_FILES["EF_Image"]["name"][$key] ) ;
								}
								$data->insert ( "Website_Offers" , $araay_to ) ;
							}
						}
					}
					$_SESSION["str_system_message"] = "Website added successfully." ;
				}
				else
				{
					$form_data = $dataValues ;
					$_SESSION["str_system_message"] = "Website title already exists." ;
				}
			}
			
			header ( "location:weblisting.php" ) ;
			exit ( ) ;
		}
		
	}
	
	
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
		<h3> Store </h3>
		<div align="center">
			<form class="application_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm ( ) ;">
				<table cellpadding="2" cellspacing="1" width="98%" >
					<tr>
						<td width="150" valign="top" class="form_title" >Store Title</td>
						<td width="*%" valign="top"><input type="text" name="WebsiteTitle_Setting_" size="50" maxlength="100" class="form_text" value="<?php echo (str_replace("\\","",$form_data["WebsiteTitle"])) ?>"  sch_req="1" sch_msg="Store Title"  /> 
						<span style="font-size:11px; font-weight:normal; color:#666666">e.g: kmart.com</span>
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> The title of the store to display on the site. </div></td>
					</tr>
					
					<tr>
						<td valign="top" class="form_title" >Store Name</td>
						<td valign="top"><input type="text" name="WebsiteName_Setting_" size="50" maxlength="100" class="form_text" value="<?php echo $form_data["WebsiteName"] ?>" sch_req="1" sch_msg="Store Name" /> 
						<span style="font-size:11px; font-weight:normal; color:#666666">e.g: Kmart</span>
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> The name of the store to display on the site. </div></td>
					</tr>
					
					<tr>
						<td valign="top" class="form_title" >Affilate URL</td>
						<td valign="top"><input type="text" name="AffilateURL_Setting_" size="100" maxlength="250" class="form_text" value="<?php echo $form_data["AffilateURL"] ?>" sch_req="1" sch_msg="Affiliate URL" />
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help">
								 The Affiliate URL of the store on which coupon is working. 
							</div></td>
					</tr>

					<tr>
						<td class="form_title">SEO Title </td>
						<td><input type="text" name="SEOTitle_Setting_" value="<?php echo $form_data["SEOTitle"] ?>" maxlength="200" size="100" /></td>
					</tr>

					<tr>
						<td class="form_title">SEO Keywords </td>
						<td><input type="text" name="SEOKeyword_Setting_" value="<?php echo $form_data["SEOKeyword"] ?>" maxlength="200" size="100" /></td>
					</tr>

					<tr>
						<td valign="top" class="form_title" >Description</td>
						<td valign="top"><textarea type="text" name="_Setting_Description"  class="form_textarea" rows="4" cols="70" ><?php echo $form_data["Description"] ?></textarea>
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> This description will be shown to user when searching or listing is filtered to this Store. </div></td>
					</tr>
					<tr>
						<td class="form_title">Icon</td>
						<td><input type="file" name="fleIcon" />
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> The Image of the store to be displayed to visitor. </div>
							
							<?php
								$file_name = "../media/pic240/".str_replace(".","-",strtolower($form_data["WebsiteID"])).".jpg" ;
								if ( file_exists ( $file_name ) )
									echo "<br><img src='$file_name' />" ;
							?>
						</td>
					</tr>

					<tr>
						<td class="form_title">ShareASale ID </td>
						<td><input type="text" name="ShareasaleID_Setting_" value="<?php echo $form_data["ShareasaleID"] ?>" maxlength="20" size="10" /></td>
					</tr>

					<tr>
						<td class="form_title">CJ ID </td>
						<td><input type="text" name="CjID_Setting_" value="<?php echo $form_data["CjID"] ?>" maxlength="20" size="10" /></td>
					</tr>

					<tr>
						<td class="form_title">Linkshare ID </td>
						<td><input type="text" name="LinkshareID_Setting_" value="<?php echo $form_data["LinkshareID"] ?>" maxlength="20" size="10" /></td>
					</tr>


					<tr>
						<td class="form_title">GAN ID </td>
						<td><input type="text" name="GanID_Setting_" value="<?php echo $form_data["GanID"] ?>" maxlength="20" size="10" /></td>
					</tr>

					<tr>
						<td class="form_title">Regnow ID </td>
						<td><input type="text" name="RegnowID_Setting_" value="<?php echo $form_data["RegnowID"] ?>" maxlength="20" size="10" /></td>
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
								window.location = "p.delete_weboffer.php?id="+offer_id ;
						}
						function remove_all_offers ( website_id )
						{
							if ( window.confirm ( "Are you sure you want to delete all the offers ?" ) )
								window.location = "p.delete_all_weboffer.php?id="+website_id ;
						}
					</script>
					<tr>
						<td class="form_title">Offers</td>
						<td>
							<input type="button" value="Add Offer" onclick="add_extra_field();" /> &nbsp;
                            <input type="button" value="Delete All Offers" onclick="remove_all_offers(<? echo($_GET['id']); ?>);" /> 
							<div id="div_extra_fields" style="font-weight:normal; font-size:12px;">
								<?php
									if ( intval ( $form_data["WebsiteID"] ) > 0 )
									{
										$offers = $data->select ( "Website_Offers" , "*" , array ( "WebsiteID" => $form_data["WebsiteID"] ) ) ;
										if ( ! empty ( $offers ) )
										{
											foreach ( $offers as $offer )
											{
												$t = explode('-', $offer["StartDate"]);
												$sdate = $t[1].'/'.$t[2].'/'.$t[0];
												$t = explode('-', $offer["EndDate"]);
												$edate = $t[1].'/'.$t[2].'/'.$t[0];

										?>
											<div id="div_offer_<?php echo $offer["Website_OffersID"]; ?>">
												<div style="margin:3px; border-top:#CCCCCC solid 1px;" align="right"><img src="images/icons/cancel.png" width="16" height="16" border="0" onclick="remove_offer ( <?php echo $offer["Website_OffersID"]; ?> ) ;" /></div>
											<table width='100%'  style='border-bottom:#000000 solid 1px;'><tr><td width="29%">Title </td><td width="71%"><input type='text' name='EF_Title[]' size='40' maxlength='99' value="<?php echo (str_replace("\\","",$offer["OfferTitle"])); ?>" /> </td></tr><tr><td>Website or Affiliate URL </td><td><input type='text' name='EF_URL[]' size="50" value="<?php echo $offer["LandingPage"] ?>"></td></tr><tr><td>Description</td><td><textarea name='EF_Description[]' rows='2' cols='45' ><?php echo (str_replace("\\","",$offer["Description"])); ?></textarea></td></tr><tr><td>Start Date</td><td><input type='text' name='EF_SD[]' size="30" value="<?php echo $sdate ?>"> <span style="font-size:11px; font-weight:normal; color:#666666">e.g: mm/dd/yyyy</span></td></tr><tr><td>End Date </td><td><input type='text' name='EF_ED[]' size="30" value="<?php echo $edate ?>"> <span style="font-size:11px; font-weight:normal; color:#666666">e.g: mm/dd/yyyy</span></td></tr></table>
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
						<td class="form_title" >Tags</td>
						<td>
							<div style="padding:9px; border:#3366CC solid 1px;">
								<?php
									$tags = $data->select ( "Tag" , "*" , NULL , 0 , 500 ) ;
									if ( ! empty ( $tags ) )
										foreach ( $tags as $tag )
										{
											$web_tag = $data->select ( "Website_Tag" , "*" , array ( "WebsiteID" => $form_data["WebsiteID"] , "TagID" => $tag["TagID"] ) ) ;
											if ( ! empty ( $web_tag ) )
												echo "<label class='tags_input'><input type='checkbox' name='chkTag[]' value='".$tag["TagID"]."' checked='checked' />".$tag["TagName"]."</label>" ;
											else
												echo "<label class='tags_input'><input type='checkbox' name='chkTag[]' value='".$tag["TagID"]."' />".$tag["TagName"]."</label>" ;
										}
								?>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="10" class="form_title" align="right" ><input type="hidden" name="WebsiteID" value="<?php echo $form_data["WebsiteID"] ?>" />
							<input type="submit" value="Save Store" class="submit_button" />
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
