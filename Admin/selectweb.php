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
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "inc.meta.php" ) ; ?>


<script language="javascript">
	function search_result ( text_str )
	{
		$(".ul_selection li:not(contains('"+text_str.toUpperCase()+"'))").hide();
		$(".ul_selection li:contains('"+text_str.toUpperCase()+"')").show();
	}
</script>

<style>
	ul.ul_selection
	{
		padding:5px;
		margin:5px;
		list-style-type:none;
		height:600px;
		overflow:auto;
	}
	
	ul.ul_selection li
	{
		padding:5px;
		margin:2px;
		border-bottom:#003399 dashed 1px;
	}
	
	ul.ul_selection li:hover
	{
		background-color:#EBEDF1;
	}
	
	ul.ul_selection a
	{
		color:#3F4078;
		text-decoration:none;
		font-weight:bold;
		font-size:14px;
	}
	
	ul.ul_selection a:hover
	{
		text-decoration:underline;
	}
	
	ul.ul_selection a.inactive
	{
		color:#9D424B;
		font-weight:normal;
		text-decoration:none;
		font-size:14px;
	}
	
	div.description_details
	{
		color:#666666;
		font-size:11px;
		font-family:Geneva, Arial, Helvetica, sans-serif;
		font-weight:normal;
		margin-left:35px;
	}
	
	div.description_details img
	{
		width:12px;
		height:12px;
	}
	
</style>

</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Select Website </h3>
    	
			<table class="listings" width="100%">
				<tr>
					<td width="18%">&nbsp;</td>
					
					<td width="82%">
						Search Title 
							<input type="text" name="kwd" id="kwd" value="" onkeyup="search_result ( this.value ) ;" size="50" />
					</td>
					
				</tr>
				<tr>
					<td colspan="10">
					
						<ul class="ul_selection">
						<?php
							$i = 0 ;
							$ads = $data->select ( "Website" , "*" , NULL , 0 , 100 , " WebsiteTitle" ) ;
							if ( ! empty ( $ads ) )
							foreach ( $ads as $ad) :
								if ( intval ( $ad["IsActive"] ) == 0 )
								{
									$css = "inactive" ;
									$img = "images/icons/award_star_bronze_1.png" ;
								}
								else
								{
									$css = "" ;
									$img = "images/icons/shield_go.png" ;
								}
						?>
								<li>
									<img src="<?php echo $img ?>" /> 
									<a href='coupon.php?webid=<?php echo $ad["WebsiteID"] ?>' class='<?php echo $css ?>'><?php echo strtoupper ( $ad["WebsiteTitle"] ) ?></a>
									<br />
									<div class="description_details">
										<img src="images/icons/zoom.png" /> 
										Views : <strong><?php echo $ad["Views"] ?></strong> - 
										<img src="images/icons/date_previous.png" width="16" height="16" /> 
										Added : <strong><?php echo date ( "F j, Y" , strtotime ( $ad["DateAdded"] ) ) ?></strong> - 
										<strong> <img src="images/icons/heart.png" /> 
										Active Coupons : <?php echo $data->count_record ( "Coupon" , array ( "WebsiteID" => $ad["WebsiteID"] , "IsApproved" => 1 ) ) ; ?></strong>
									</div>
								</li>
							
						<?php
							endforeach ;
						?>
					
					
						</ul>
					
					</td>
				</tr>
			</table>
	
		<br />
		<br />

		
	</div>
  <?php include ( "inc.footer.php" ) ; ?>
<!-- end #container --></div>
</body>
</html>
