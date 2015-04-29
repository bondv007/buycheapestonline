<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 2;
	if ( intval ( $_SESSION["admin_rights"]["r_page"] ) == 0 )
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
				window.location = "p.delete_page.php?id="+obj_id ;
		}
	}
</script>
</head>

<body class="oneColElsCtrHdr">

<div id="container">
  <?php include ( "inc.header.php" ) ; ?>
  <div id="mainContent">
    <h3> Static Pages</h3>
    	
		<table width="100%" class="listings" cellpadding="3" cellspacing="0">
			<tr class="listing_heading">
				<th>
					Name				</th>
				<th>
					Contents				</th>
				<th>
					Link				</th>
				<th>
					Actions				</th>
			</tr>
			<?php
				$i = 0 ;
				$ads = $data->select ( "PageManager" , "*", null , intval ( $_GET["p"] ) * $pageSize , $pageSize ) ;
				if ( ! empty ( $ads ) )
				foreach ( $ads as $ad) :
					$css_class = $i++ % 2 == 0 ? "listing_even" : "listing_odd" ;
					$entity = $data->select ( "SEF_URL","*",array ( "EntityType"=>"StaticPage","EntityID"=>$ad["PageManagerID"] ) ) ;
					$url = $entity[0]["URL"];
			?>
				<tr class="<?php echo $css_class ?>">
					<td width="10%">
						<?php echo $ad["PageName"] ?>					</td>
					<td width="45%">
						<?php echo substr ( $ad["PageContents"] , 0 , 250 ) ?>					</td>
					<td width="35%">
						<a href="<?php echo (base_url.$url); ?>" target="_blank"><?php echo (base_url.$url); ?></a>
                        <img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
                        <div class="div_help">
                            Use this path in the footer links section.
                        </div>
                    </td>
					<td width="10%">
						<a href="s_page.php?id=<?php echo $ad["PageManagerID"] ?>" title="Edit this static Page">
							<img src="images/icons/wrench.png" border="0" alt="Edit" />
						</a>
						&nbsp;&nbsp;
                        <?
						if(($ad["PageManagerID"]!='2')&&($ad["PageManagerID"]!='3')){
						?>                        
						<img src="images/icons/delete.png" border="0" alt="Delete" style="cursor:pointer;" onclick="alert_del(<?php echo $ad["PageManagerID"] ?> , '<?php echo $ad["PageName"] ?>');" title="Delete" />
                        <?
						}
						?>
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
<!-- end #container --></div>
</body>
</html>
