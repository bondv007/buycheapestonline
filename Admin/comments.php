<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 7;
	if ( intval ( $_SESSION["admin_rights"]["r_comment"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	include_once ( "../classes/misc.func.php" ) ;
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>


<script language="javascript">
	function deleteAd ( ad_id )
	{
		if ( parseInt ( ad_id ) > 0 )
			if ( window.confirm ( "Are you sure you want to delete this Comment ?" ) )
			{
				window.location = "p.comments.php?del=1&id="+ad_id ;
			}
	}
</script>

</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Coupons </h3>
    	
		
		<form action="p.comments.php" method="post">
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="97">
						With Selected :
						<label><input type="radio" name="radOption" value="del" /> <img src="images/icons/delete.png" /> 
						Delete</label>
						
						<label><input type="radio" name="radOption" value="actv_1" /> <img src="images/icons/bell_go.png" /> 
						Mark Active</label>
						<label><input type="radio" name="radOption" value="actv_0" /> <img src="images/icons/bell_error.png" /> 
						Mark InActive</label>
						
						<input type="submit" value="GO" class="submit_button" />					</td>
				</tr>
				<tr class="listing_heading">
					<th width="4%">&nbsp;					</th>
					<th width="5%"> ID					</th>
					<th>
						Comments</th>
					<th>
						Coupon
					</th>
					<th>
						Posted					</th>
					<th>
						Actions					</th>
				</tr>
				<?php
					$i = 0 ;
					$req_array = array ( ) ;
					
					if ( isset ( $_GET["st"] ) )
						$req_array["IsApproved"] = (string) intval ( $_GET["st"] ) ;
					
					if ( intval ( $_GET["copid"] ) > 0 )
					{
						$web_detail = $data->select ( "Coupon" , "*" , array ( "CouponID" => intval ( $_GET["copid"] ) ) ) ;
						if ( ! empty ( $web_detail ) )
						{
							$req_array["CouponID"] = intval ( $_GET["copid"] ) ;
							echo "<tr><td colspan='10'><div style='padding:5px; font-size:18px;'> Comments of ".$web_detail[0]["CouponCode"]."</div></td></tr>" ;
						}
					}
				
					$ads = $data->select ( "Comment" , "*" , $req_array , intval ( $_GET["p"] ) * $pageSize , $pageSize , " DateAdded desc" ) ;
					$totalRecords = $data->get_num_records ( ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["CommentID"] ?>" />						</td>
						<td valign="top">
							<?php echo $ad["CommentID"] ?>						</td>
						<td width="54%">
							<em>By :</em> <?php echo $ad["UserName"] ?>
							<br />
							
							<div style="font-weight:normal; font-size:12px; margin-left:10px; margin-top:3px; padding:3px; border-left:#BBBBBB solid 2px;">
						<?php echo $ad["Comments"] ?>...							</div>						</td>
						<td width="12%">
							<?php 
								if ( intval ( $ad["CouponID"] ) > 0 )
								{
									$coupon_det = $data->select ( "Coupon" , "*" , array ( "CouponID" => $ad["CouponID"] ) ) ;
									$coupon_det = $coupon_det[0] ;
									
									$web_det = $data->select ( "Website" , "*" , array ( "WebsiteID" => $coupon_det["WebsiteID"] ) ) ;
									$web_det = $web_det[0] ;
							?>
									<a href="comments.php?copid=<?php echo $coupon_det["CouponID"] ?>" style="font-size:14px; color:#003300; text-decoration:none;" title="All Comments on <?php echo $coupon_det["CouponCode"] ?>"><img src="images/icons/photos.png" width="12" height="12" border="0" /> 
									<?php echo $coupon_det["CouponCode"] ?></a>
									<br />
									<a href="couponlisting.php?webid=<?php echo $coupon_det["WebsiteID"] ?>"  style="font-size:12px; font-weight:normal; color:#003300; text-decoration:none;"  title="All Coupons of <?php echo $web_det["WebsiteName"] ?>"><img src="images/icons/bell_go.png" border="0"  width="12" height="12"  /> <?php echo $web_det["WebsiteTitle"] ?></a>
						<?php
								}
							 ?>						</td>
						<td width="14%">
						<?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>						</td>
						<td width="11%" align="center">
							<a href="#" title="Delete Ad" onclick="deleteAd ( <?php echo $ad["CommentID"] ?> )">
								<img src="images/icons/delete.png" border="0" alt="Delete" />							</a>
							&nbsp;
							<?php if ( intval ( $ad["IsApproved"] ) == 1 ) : ?>
								<a href="p.comments.php?id=<?php echo $ad["CommentID"] ?>&actv=0" title="Make Inactive">
									<img src="images/icons/bell_error.png" border="0" alt="Delete" />								</a>
							<?php else: ?>
								<a href="p.comments.php?id=<?php echo $ad["CommentID"] ?>&actv=1" title="Make Active">
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
		<br />
		<br />

		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>
