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
	include_once ( "../classes/misc.func.php" ) ;
	
$tip = array("TwitterOffer","TwitterCoupon","TwitterTag");	
$activ = array("heart_empty","heart");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>
<script language="javascript">
	function deleteAd ( ad_id )
	{
		if ( parseInt ( ad_id ) > 0 )
			if ( window.confirm ( "Are you sure you want to delete this Link ?" ) )
			{
				window.location = "p.flink.php?del=1&id="+ad_id ;
			}
	}
</script>
</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Footer Links</h3>
    	
		
		<form action="p.flink.php" method="post">
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="100">
						With Selected :
						<label><input type="radio" name="radOption" value="del" /> <img src="images/icons/delete.png" /> 
						Delete</label>
						<input type="submit" value="GO" class="submit_button" />
						
					</td>
				</tr>
				<tr class="listing_heading">
					<th width="2%">&nbsp;
					</th>
					<th width="35%">
						Name 
					</th>
					<th width="35%">
						Link 
					</th>
					<th width="20%">
						Actions
					</th>
				</tr>
				<?php
					$i = 0 ;
					$ads = $data->select ( "Link_Footer" , "*" , null , intval ( $_GET["p"] ) * $pageSize , $pageSize ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) {
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["ID"] ?>" />
						</td>
						<td>
							<?php echo $ad["Name"] ?>
						</td>
						<td>
							<?php echo $ad["Link"] ?>
						</td>
						<td>
							<a href="flink.php?id=<?php echo $ad["ID"] ?>" title="Edit this Link">
								<img src="images/icons/wrench.png" border="0" alt="Edit" />
							</a> &nbsp; &nbsp; 
							<a href="#" title="Delete Link" onclick="deleteAd ( <?php echo $ad["ID"] ?> )">
								<img src="images/icons/delete.png" border="0" alt="Delete" />							</a>
						</td>
					</tr>
				<?php
					}
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
