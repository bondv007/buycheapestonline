<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	if ( intval ( $_SESSION["admin_rights"]["r_account"] ) == 0 )
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
			if ( window.confirm ( "Are you sure you want to delete this ad" ) )
			{
				window.location = "p.delete_classified.php?id="+ad_id ;
			}
	}
</script>

</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Registered Users</h3>
    	
		
		<form action="p.accounts.php" method="post">
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="100">
						With Selected :
						<label><input type="radio" name="radOption" value="del" /> <img src="images/icons/delete.png" /> 
						Delete</label>
						
						
						<label><input type="radio" name="radOption" value="actv_1" /> <img src="images/icons/bell_go.png" /> 
						Mark Active</label>
						<label><input type="radio" name="radOption" value="actv_0" /> <img src="images/icons/bell_error.png" /> 
						Mark InActive</label>
						
						<input type="submit" value="GO" class="submit_button" />
						
					</td>
				</tr>
				<tr class="listing_heading">
					<th width="2%">&nbsp;
						
					</th>
					<th>
						Accounts 
					</th>
					<th>
						Created
					</th>
					<th>
						Actions
					</th>
				</tr>
				<?php
					$i = 0 ;
					$req_array = array ( ) ;
					if ( isset ( $_GET["st"] ) )
						$req_array["IsEnable"] = (string) intval ( $_GET["st"] ) ;
					$ads = $data->select ( "Account" , "*" , $req_array , intval ( $_GET["p"] ) * $pageSize , $pageSize , " DateAdded desc" ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) :
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["AdID"] ?>" />
						</td>
						<td width="46%">
							<?php echo $ad["FullName"] ?>
							<br />
							<?php echo substr($ad["EmailAddress"] , 0 , 140 ) ?>...
						</td>
						
						
						<td width="14%">
							<?php echo date( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?>
						</td>
						<td width="23%" align="center">
							<!--
								<a href="detail.php?id=<?php echo $ad["AdID"] ?>" title="Detail of this ad">
								<img src="images/icons/report_picture.png" border="0" alt="Edit" />
							</a>
							&nbsp;
							<a href="#" title="Delete Ad" onclick="deleteAd ( <?php echo $ad["AdID"] ?> )">
								<img src="images/icons/delete.png" border="0" alt="Delete" />
							</a>
							&nbsp;
							<?php if ( intval ( $ad["IsFeatured"] ) == 0 ) : ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&spon=1" title="Make Sponsored">
									<img src="images/icons/flag_green.png" border="0" alt="Delete" />
								</a>
							<?php else: ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&spon=0" title="UNMARK Sponsored">
									<img src="images/icons/flag_red.png" border="0" alt="Delete" />
								</a>	
							<?php endif; ?>
							&nbsp;
							<?php if ( intval ( $ad["IsActive"] ) == 1 ) : ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&actv=0" title="Make Inactive">
									<img src="images/icons/bell_error.png" border="0" alt="Delete" />
								</a>
							<?php else: ?>
								<a href="p.ads.php?id=<?php echo $ad["AdID"] ?>&actv=1" title="Make Active">
									<img src="images/icons/bell_go.png" border="0" alt="Delete" />
								</a>	
							<?php endif; ?>
							-->
						</td>
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
