<?php
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;

	require_once ( "../config.php" ) ;
	require_once ( "../classes/manipulate.php" ) ;
	$data = new DataManipulator ;
	require_once ( "../classes/misc.func.php" ) ;
	$h_db = mysql_connect(DBSERVER,DBUSERNAME,DBPASSWORD);
	mysql_select_db(DBNAME,$h_db);

	$_SESSION["menu_option"] = 1;
	if ( intval ( $_SESSION["admin_rights"]["r_website"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	
	function split_ucase($string){
		$tmp = explode('.',$string);
		$string = $tmp[0];
		return preg_replace('/([a-z0-9])([A-Z])/','$1 $2',$string);
	}

	$tweet=$_POST['tweet'];
	if (!$tweet) $tweet = "{Hi|Hello|Hey|Greetings|Attention|To} @#user#! {On|About|At|Checkout|See} #link# #name#: #offers#";
	
	$maxr=$_POST['maxr'];
	if (!$maxr) $maxr=10000;
	
	$twitters = $_POST['twitters'];

	$min_delay=$_POST['min_delay'];
	if ($min_delay<300) $min_delay=720;

	$arr_order=$_POST['arr_order'];
	if ($arr_order=='') $arr_order='DESC';
	if ($arr_order=="ASC"){ $arr_sel1 = ' selected="selected"'; $arr_sel2 = '';}
	else { $arr_sel1 = ''; $arr_sel2 = ' selected="selected"';}
	
	$file = '../media/export/asnoop.csv';
	unlink($file);
	$handle = fopen ($file, 'w'); // Let's open for read and write

	$mes = array("Twitter Accounts","Seach Queries","Message Age","Repeat Search","Working Hours","Working Days","Messages","Messages Max Limit","Messages Hourly Limit","Messages Daily Limit","Messages Min Delay");
	
	fputcsv($handle, $mes);

			$mes = array();
			$mes[0] = $twitters;
			$mes[1] = "";
			$mes[2] = "360";
			$mes[3] = "240";
			$mes[4] = "0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23";
			$mes[5] = "Sun,Mon,Tue,Wed,Thu,Fri,Sat";
			$mes[6] = "";
			$mes[7] = "0";
			$mes[8] = "5";
			$mes[9] = "60";
			$mes[10]= $min_delay;

	$crt="";
	$offers = "";
	$no = 0;
	
	$q = "SELECT * FROM Website ORDER BY WebsiteID $arr_order LIMIT 0, $maxr ";
	$res = mysql_query($q);
	if(mysql_num_rows($res)){
		while($store = mysql_fetch_assoc($res))
		{
			//create new request
			$offers=""; 

			$message = $tweet;
			$message = str_replace("#link#", base_url.$store['WebsiteName'], $message);
			
			$tmp = explode('.',$store['WebsiteName']);
			$site1 = $tmp[0];
			$message = str_replace("#name#", $site1, $message);
				
			$site2 = split_ucase($store['WebsiteName']);
			$site2 = str_replace("-"," ",$site2);
			if ($site1==$site2) $src = $site1;
			else  $src = $site1;//.", ".$site2;
			$mes[1] = $src;
			
			//add offers
			$crto = "";
			$qo="SELECT * FROM Website_Offers WHERE WebsiteID = ". $store[WebsiteID]. " ORDER BY Website_OffersID DESC LIMIT 0,10";
			$reso = mysql_query($qo);
			if(mysql_num_rows($reso)) while($offer = mysql_fetch_assoc($reso))
			{
				$title = str_replace('"','',$offer['Description']);
				$title = str_replace('|',',',$offer['Description']);
				$title = htmlspecialchars($title);
				$title = substr($title,0, 125);
				
				if ($crto!=$title) $offers.= ($offers?"|":"").$title; //preventing repeating offers
				$crto = $title;
			}
		
			//add coupons
			$crto = "";
			$qo="SELECT * FROM Coupon WHERE WebsiteID = ". $store[WebsiteID] . " ORDER BY DateAdded DESC LIMIT 0,10";
			$reso = mysql_query($qo);
			if(mysql_num_rows($reso)) while($offer = mysql_fetch_assoc($reso))
			{
				$title = str_replace('"','',$offer['Description']);
				$title = str_replace('|',',',$offer['Description']);
				$title = htmlspecialchars($title);
				$title = substr($title,0, 125);
							
				if ($crto!=$title) $offers.= ($offers?"|":"").$title; //preventing repeating offers
				$crto = $title;
			}

			//send 
			if ($offers)
			{
				$message = str_replace("#offers#", "{".$offers."}", $message);
				$mes[6] = $message;
				fputcsv($handle, $mes);
				$no++;
			}

		} // end while
	} //end if

	else echo "No results.";
	
	//send last
	if ($offers)
	{
		$message = str_replace("#offers#", "{".$offers."}", $message);
		$mes[6] = $message;
		fputcsv($handle, $mes);
	}

	fclose($handle);

	$token['link'] = "Generated export using:<br/>Tweet: $tweet<br/>Twitters: $twitters<br/>Maximum: $maxr<br/>Retrieved $no stores with offers/coupons.<br/><a href='../media/export/asnoop.csv'>Download aSnoop.csv</a><br />";

	$title = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "SiteName" ) ) ;
	$title = $title[0] ;
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

		<h3> Export aSnoop.com requests CSV</h3>

		<div align="center">

		<form method="post" action="export_asnoop.php" class="application_form">

          <table width="70%">

            <tr>

                <td valign="top" colspan="2"> 

                This will export sites as requests CSV file, to be imported and used with <a href="http://www.asnoop.com/">aSnoop.com</a>.<br />

                aSnoop is a website that allows sending automated tweets referencing users that tweet on certain topics.<br />

                In example, if an user tweets about &quot;Does anyone have a good discount coupon for Kmart?&quot; you can have an automated tweet request that will automatically tweet &quot;Hey @user, use this discount link to get a discount on Kmart: ...&quot; .<br />

                </td>

            </tr>

		    <tr>

		      <td valign="top" class="form_title" width="130">Tweet</td>

		      <td valign="top"><textarea name="textfield" cols="70" rows="2"><?=$tweet?></textarea>

              <br />

		      Use:<br />

              #link# = website link<br />

              #name# = website name<br />

              #offers# = offer variants

		      </td>

	        </tr>

		    <tr>

		      <td valign="top" class="form_title">Twitters</td>

		      <td valign="top"><input name="twitters" type="text" value="<?=$twitters?>" size="70" />

	          <br />

	          Your twitter usernames to use. Must be added previously to aSnoop. Comma separated values: <br />

	          account1, account2, account3<br />

              The Twitter account must be all ready added in <a href="http://www.asnoop.com/">aSnoop.com</a></td>

	        </tr>

		    <tr>

		      <td valign="top" class="form_title">Maximum</td>

		      <td valign="top"><input name="maxr" type="text" value="<?=$maxr?>" size="8" maxlength="8" /> 

	          <br />

	          Maximum number of websites (requests) to list.</td>

	        </tr>

		    <tr>

		      <td valign="top" class="form_title">Messages Min Delay</td>

		      <td valign="top"><input name="min_delay" type="text" value="<?=$min_delay?>" size="8" maxlength="8" /> 

	          <br />

	          Minimum delay 300 seconds.</td>

	        </tr>

		    <tr>

		      <td valign="top" class="form_title">Arrange order</td>

		      <td valign="top"><select name="arr_order"><option value="ASC"<?php echo $arr_sel1 ?>>ascending (first to last)</option><option value="DESC"<?php echo $arr_sel2 ?>> descending (last to first)</option></select> 

	          <br />

	          Arrange order of the stores.</td>

	        </tr>

		    <tr>

		      <td colspan="2" class="form_title"><input type="submit" name="button" value="Submit" class="submit_button" /></td>

	        </tr>

		    <tr>

		      <td colspan="2" align="center"><?php echo $token['link'] ?></td>

	        </tr>

	      </table>

	  </form>

       	<br /><br />

        </div>

    </div>

	<?php include ( "inc.footer.php" ) ; ?>

	<!-- end #container -->

</div>

</body>

</html>