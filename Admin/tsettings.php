<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 1;
	if ( intval ( $_SESSION["admin_rights"]["r_home"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
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
        <h3> Twitter Settings </h3>
		<div align="left">
            Purchase this plugin in order to be available and make you work easy<br />
			<a href="https://www.plimus.com/jsp/buynow.jsp?contractId=2889626" target="_blank"> Twitter Plugin </a>
		</div>
    </div>
    <?php include ( "inc.footer.php" ) ; ?>
    <!-- end #container -->
</div>
</body>
</html>