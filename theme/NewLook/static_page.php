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
                <div id="left_content_inn" class="left_content_inn_nopad">
                	<h1 class="no_pad_bot"><?php echo $static_page["PageName"] ?></h1>
                    <div class="how_to"><?php echo $static_page["PageContents"] ?></div>
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