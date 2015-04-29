<?php
	function split_word( $str, $no_chars ){
		$newtext = wordwrap($str, $no_chars, "\n");
		$tmp=explode("\n",$newtext);
		return $tmp[0];
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( "core/inc.meta.php" ) ?>
</head>

<body>
<div align="center">
<div id="container_big">
	<div id="container">
        <div id="header_innerpage">
        	<div id="logo">
                <a href="<?php echo base_url ?>"><img src="<?php echo base_url ?>media/logo.png" alt="Logo" /></a>
            </div>
            <div id="top_menu_innerpage">
            	<?php include ( "inc.menu_top.php" ) ?>
            </div>
            <div id="main_menu">
            	<?php include ( "inc.menu_main.php" ) ?>
            </div>
            <?php include ( "inc.search_header.php" ) ?>
        </div>
        <div id="content">
        	<div id="left_content">
            	<div id="left_content_top"></div>
                <div id="left_content_inn">
                	<h1><?php echo $qstring[1] ?> Search Results</h1>
					<div class="break"></div>
				<div id="storeCollection" style="width:660px;">
					<?php 							
							$count_rec = count ( $websites ) ;
							$prev = 0; 
							if ( ! empty ( $websites ) ){
							foreach ( $websites as $web ){
								if($prev!=$web["WebsiteID"]){
									$prev = $web["WebsiteID"];
						?>
                                	<div class="content_prod" style="border: dotted 1px #b2b2b2; padding-top: 10px;">
									<a class="thumb" href="<?php echo base_url.get_sef_url ( $web["WebsiteID"] , "Website" ) ?>/" title="<?php echo $web["WebsiteTitle"] ?>">
										<img src="<?php echo base_url."media/pic110/".str_replace(".","-",strtolower($web['WebsiteTitle'])).".jpg" ?>" alt="<?php echo $web["WebsiteTitle"] ?>" />
									</a>
									<p><?php echo(split_word($web["Description"],100));?><br /><a href="<?php echo base_url.get_sef_url ( $web["WebsiteID"] , "Website" ) ?>/"><?php echo $web["WebsiteName"] ?></a></p>
                                    </div>
						<?php
                        		}
							}
						?>
                        <?php	
							}else{
						?>
							<p>
								No result found for <em><?php echo $qstring[1] ?></em>
							</p>
						<?php
							}
						?>
				</div>
				
                    
                </div>
                <div id="left_content_bottom"></div>
            </div>
            <div id="right_content">
            	<?php include ( "inc.social.php" ) ?>
            </div>
        </div>
        <?php include ( "inc.footer.php" ) ?>
    </div>
</div>
</div>
</body>
</html>