<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 9;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
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
</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Footer Links</h3>
		
			<table width="100%" class="listings"  cellpadding="3" cellspacing="0">
				<tr class="listing_action">
					<td colspan="100">
												
					</td>
				</tr>
				<tr class="listing_heading">
					<th width="5%">&nbsp;</th>
					<th width="95%">
						Email 
					</th>
				</tr>
				<?php
					$i = 0 ;
					$ads = $data->select2 ( "SELECT * FROM Newsletter WHERE date_register<>'0000-00-00 00:00:00' LIMIT ". intval ( $_GET["p"] ) * $pageSize .' ,'. $pageSize ) ;
					if ( ! empty ( $ads ) )
					foreach ( $ads as $ad) {
						$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
				?>
					<tr class="<?php echo $css_class ?>">
						<td>
							<input type="checkbox" name="chkAdID[]" value="<?php echo $ad["ID"] ?>" />
						</td>
						<td>
							<?php echo $ad["email"] ?>
						</td>
					</tr>
				<?php
					}
				?>
				<?php
					include ( "inc.paging.php" ) ;
				?>
			</table>

		<br />
		<br />
		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>
