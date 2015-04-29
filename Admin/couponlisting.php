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
	include_once ( "../classes/misc.func.php" ) ;
	
	$siteSettings = $data->select2 ( "SELECT * FROM SiteManager" ) ;
	$dataArray = array ( ) ;
	foreach ( $siteSettings as $site )
		$dataArray[$site["SiteVariable"]] = $site["SiteValue"] ;
	$pageSize = $dataArray['RecordsPerPage'];
	$siteSettings = null ;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>


<script language="javascript">
	function deleteAd ( ad_id )
	{
		if ( parseInt ( ad_id ) > 0 )
			if ( window.confirm ( "Are you sure you want to delete this Coupon ?" ) )
			{
				window.location = "p.coupons.php?del=1&id="+ad_id ;
			}
	}
</script>

</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Coupons </h3>
    	
		<form action="" method="get">
			<table class="listings" width="100%">
				<tr>
					<td width="5%">
						Search
					</td>
					
					<td width="47%">
						Coupon 
							<input type="text" name="kwd" value="<?php echo $_GET["kwd"] ?>" size="50" />
					</td>
					<td width="17%">
						<input type="submit" value="SEARCH" style="font-weight:bold;" />
					</td>
				</tr>
			</table>
		</form>
		<form action="p.coupons.php" method="post">
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="99">
                    	<label><input type="button" name="CheckAll" value="Check All" onClick="checkAll()"></label>
                    	<label><input type="button" name="UnCheckAll" value="UnCheck All" onClick="uncheckAll()"></label>
						&nbsp;&nbsp;
						With Selected :
						<label><input type="radio" name="radOption" value="del" /> <img src="images/icons/delete.png" /> 
						Delete</label>
						<label><input type="radio" name="radOption" value="spon_1" /> <img src="images/icons/flag_green.png" /> 
						Mark Sponsored</label>
						<label><input type="radio" name="radOption" value="spon_0" /> <img src="images/icons/flag_red.png" /> 
						UnMark Sponsored</label>
						<label><input type="radio" name="radOption" value="actv_1" /> <img src="images/icons/bell_go.png" /> 
						Mark Active</label>
						<label><input type="radio" name="radOption" value="actv_0" /> <img src="images/icons/bell_error.png" /> 
						Mark InActive</label>
						
						<input type="submit" value="GO" class="submit_button" />					</td>
				</tr>
				<tr class="listing_heading">
					<th width="2%">&nbsp; </th>
					<th width="3%"> ID </th>
					<th>Detail</th>
					<th>Website</th>
					<th>Posted</th>
					<th>Comments</th>
					<th>Actions</th>
				</tr>
				<?php
					$i = 0 ;
					$req_array = array ( ) ;
					$like_array = array ( ) ;
					if ( isset ( $_GET["st"] ) )
						$req_array["IsApproved"] = (string) intval ( $_GET["st"] ) ;
					if ( $_GET["kwd"] != "" )
					{
						$like_array["CouponCode"] = $_GET["kwd"] ;
						$data->set_like ( $like_array ) ;
					}
					if ( intval ( $_GET["webid"] ) > 0 )
					{
						$web_detail = $data->select ( "Website" , "*" , array ( "WebsiteID" => intval ( $_GET["webid"] ) ) ) ;
						if ( ! empty ( $web_detail ) )
						{
							$req_array["WebsiteID"] = intval ( $_GET["webid"] ) ;
							echo "<tr><td colspan='10'><div style='padding:5px; font-size:16px;'> Coupons of ".$web_detail[0]["WebsiteTitle"]."</div></td></tr>" ;
						}
					}
				
					$ads = $data->select ( "Coupon" , "*" , $req_array , intval ( $_GET["p"] ) * $pageSize , $pageSize , "DateAdded desc" ) ;
					$totalRecords = $data->get_num_records ( ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["CouponID"] ?>" />						</td>
						<td valign="top">
							<?php echo $ad["WebsiteID"] ?>						</td>
						<td width="51%">
							<em>Code :</em> <?php echo $ad["CouponCode"] ?>
							<br />
							
							<div style="font-weight:normal; font-size:12px; margin-left:10px; margin-top:3px; padding:3px; border-left:#BBBBBB solid 2px;">
						<?php echo substr($ad["Description"] , 0 , 140 ) ?>...							</div>						</td>
						<td>
						<?php 
							if ( intval ( $ad["WebsiteID"] ) > 0 )
							{
								$web_det = $data->select ( "Website" , "*" , array ( "WebsiteID" => $ad["WebsiteID"] ) ) ;
								$web_det = $web_det[0] ;
						?>
								<a href="couponlisting.php?webid=<?php echo $web_det["WebsiteID"] ?>"  style="font-size:12px; font-weight:normal; color:#003300; text-decoration:none;"  title="All Coupons of <?php echo $web_det["WebsiteName"] ?>"><img src="images/icons/bell_go.png" border="0"  width="12" height="12"  /> <?php echo $web_det["WebsiteTitle"] ?></a>
						<?php
							}
						 ?>	
												</td>
						<td>
						<?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>						</td>
						<td align="center">
							<a href="comments.php?copid=<?php echo $ad["CouponID"] ?>" style="color:#000066; text-decoration:none;" title="Comments of this Coupon">
								<?php echo $data->count_record ( "Comment" , array ( "CouponID" => $ad[CouponID] ) ) ?>  
								<img src="images/icons/book_open.png" border="0" alt="comments" /></a>
						</td>
						<td width="13%" align="center">
							<a href="coupon.php?id=<?php echo $ad["CouponID"] ?>" title="Modify">
								<img src="images/icons/report_picture.png" border="0" alt="Edit" />							</a>
							&nbsp;
							<a href="#" title="Delete Coupon" onclick="deleteAd ( <?php echo $ad["CouponID"] ?> )">
								<img src="images/icons/delete.png" border="0" alt="Delete" />							</a>
							&nbsp;
							<?php if ( intval ( $ad["IsFeatured"] ) == 0 ) : ?>
								<a href="p.coupons.php?id=<?php echo $ad["CouponID"] ?>&spon=1" title="Make Sponsored">
									<img src="images/icons/flag_green.png" border="0" alt="Delete" />								</a>
							<?php else: ?>
								<a href="p.coupons.php?id=<?php echo $ad["CouponID"] ?>&spon=0" title="UNMARK Sponsored">
									<img src="images/icons/flag_red.png" border="0" alt="Delete" />								</a>	
							<?php endif; ?>
							&nbsp;
							<?php if ( intval ( $ad["IsApproved"] ) == 1 ) : ?>
								<a href="p.coupons.php?id=<?php echo $ad["CouponID"] ?>&actv=0" title="Make Inactive">
									<img src="images/icons/bell_error.png" border="0" alt="Delete" />								</a>
							<?php else: ?>
								<a href="p.coupons.php?id=<?php echo $ad["CouponID"] ?>&actv=1" title="Make Active">
									<img src="images/icons/bell_go.png" border="0" alt="Delete" />								</a>	
						<?php endif; ?>						</td>
					</tr>
				<?php
					endforeach ;
				?>
				<?php
					include ( "inc.paging.php" ) ;
				?>
			</table>
		</form>
        <script language="javascript" type="text/javascript">
			<!-- Begin
			function checkAll(){
				var field = document.getElementsByName('chkAdID[]');
				for (i = 0; i < field.length; i++)
					field[i].checked = true ;
			}
			
			function uncheckAll(){
				var field = document.getElementsByName('chkAdID[]');
				for (i = 0; i < field.length; i++)
					field[i].checked = false ;
			}
			//  End -->
		</script>
		<br />
		<br />

		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>
