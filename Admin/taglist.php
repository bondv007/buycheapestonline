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
			<h3> Tag </h3>
			<form action="" method="get">
				<table class="listings" width="100%">
					<tr>
						<td width="7%"> Search </td>
						<td width="26%"><input type="text" name="kwd" value="<?php echo $_GET["kwd"] ?>" size="50" />
						</td>
						<td width="51%"><input type="submit" value="SEARCH" style="font-weight:bold;" />
						</td>
					</tr>
				</table>
			</form>
			<table width="100%" class="listings" cellpadding="3" cellspacing="0">
				<tr class="listing_heading">
					<th> Tag </th>
					<th width="9%"> Websites </th>
					<th width="9%"> Offers </th>
					<th> Actions </th>
				</tr>
				<?php
				$i = 0 ;
				$data_array = array ( ) ;
				if ( $_GET["kwd"] != "" )
				{
					$data->set_like ( array ( "TagName" => $_GET["kwd"] ) ) ;
				}
				$ads = $data->select ( "Tag" , "*", $data_array , intval ( $_GET["p"] ) * $pageSize , $pageSize, "TagID desc" ) ;
				$totalRecords = $data->get_num_records ( ) ;
				if ( ! empty ( $ads ) )
				foreach ( $ads as $ad) :
					$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
			?>
				<tr class="<?php echo $css_class ?>">
					<td width="59%"><?php 
							echo $ad["TagName"] ;
						?>
						<br />
						<div style="font-weight:normal; font-size:12px; margin-left:10px; margin-top:3px; padding:3px; border-left:#BBBBBB solid 2px;">
							<?php echo substr($ad["TagDescription"] , 0 , 140 ) ?>...
						</div></td>
					<td><?php
						echo $data->count_record ( "Website_Tag" , array ( "TagID" => $ad["TagID"] ) ) ;
					?>
					</td>
					<td><?php
						echo $data->count_record ( "Tag_Offers" , array ( "TagID" => $ad["TagID"] ) ) ;
					?>
					</td>
					<td width="32%" align="center"><a href="tag.php?id=<?php echo $ad["TagID"] ?>" title="Edit this Category">
							<img src="images/icons/wrench.png" border="0" alt="Edit" />
						</a>
						&nbsp;&nbsp;
						<img src="images/icons/delete.png" border="0" alt="Delete" style="cursor:pointer;" onclick="alert_del(<?php echo $ad["TagID"] ?> , '<?php echo $ad["TagName"] ?>');" title="Delete" />
					</td>
				</tr>
				<?php
				endforeach ;
			?>
				<?php
				include ( "inc.paging.php" ) ;
			?>
			</table>
			<br />
			<br />
		</div>
		<?php include ( "inc.footer.php" ) ; ?>
		<!-- end #container -->
	</div>
</body>
</html>
