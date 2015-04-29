<?php
	
	session_start ( ) ;
	require ( "inc.login_check.php" ) ;
	require_once ( "inc.admin_data.php" ) ;
	$_SESSION["menu_option"] = 5;
	if ( intval ( $_SESSION["admin_rights"]["r_website"] ) == 0 )
	{
		header ( "location:home.php" ) ;
		exit();
	}
	
	if($_POST['upl']){
		if ($_FILES['fleXLS']['name']){
			$error='';
			if ($_FILES['fleXLS']['error']) $error="Error on upload";
			if (!is_uploaded_file($_FILES['fleXLS']['tmp_name'])) $error="Error on upload";

			$tmp = explode('.', $_FILES['fleXLS']['name']);
			$ext = strtolower($tmp[count($tmp)-1]);
			if(($ext!='txt')&&($ext!='csv')&&($ext!='xls')) $error="Error: Incorrect file type (we need csv or txt file)";
		}
		if ($error == '') {
			$name = date("Ymd_His").'.csv';
		 	$upfile = '../media/import/' . $name; 
			$ok = move_uploaded_file($_FILES['fleXLS']['tmp_name'], $upfile);

			$row = 1; $ok=0;
			$handle = fopen($upfile, "r");
			while (($data_csv = fgetcsv($handle, 4096, ",")) !== FALSE) {
				if($row>1){
					// search website name
					$a = $data_csv[$cA];
					$website_prev = $data->select ( "Website" , "*" , array ( "WebsiteTitle" => $a ) ) ;
					if ( empty ( $website_prev ) ){
						$ok++;
						$adate = date("Y-m-d H:i:s");
						$araay_to = array ( 
										"WebsiteTitle " => $data_csv[$cA],
										"WebsiteName" => $data_csv[$cB],
										"WebsiteURL " => $data_csv[$cC], 
										"Description" => $data_csv[$cD],
										"AffilateURL" => $data_csv[$cE],
										"SEOTitle" => $data_csv[$cF],
										"SEOKeyword" => $data_csv[$cG],
										"ShareasaleID" => $data_csv[$cH],
										"CjID" => $data_csv[$cI],
										"IsActive" => "1",
										"DateAdded" => $adate
											) ;
						$id = $data->insert ( "Website" , $araay_to ) ;
						
						generate_sef_url ( $data_csv[$cA] , $id , "Website" ) ;
						
					}else{		}				
				}else{
					// row 0 have the header column names in csv file (they are different for office version)
					// search the key columns name 
					$cA = array_search("WebsiteTitle", $data_csv);
					$cB = array_search("WebsiteName", $data_csv);
					$cC = array_search("WebsiteURL", $data_csv);
					$cD = array_search("Description", $data_csv);
					$cE = array_search("AffilateURL", $data_csv);
					$cF = array_search("SEOTitle", $data_csv);
					$cG = array_search("SEOKeyword", $data_csv);
					$cH = array_search("ShareasaleID", $data_csv);
					$cI = array_search("CjID", $data_csv);
				}
				$row++;
			}	
			fclose($handle);
				
		}
		$_SESSION["str_system_message"] = "Upload completed successfully. {$ok} new website inserted from {$row} total" ;
			
	}
	else $_SESSION["str_system_message"] = $error ;


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
		<h3> Imports Websites </h3>
		<div align="center">
			<form class="application_form" action="" method="post" enctype="multipart/form-data">
				<table cellpadding="2" cellspacing="1" width="70%" >
					<tr>
						<td width="24%" valign="top" class="form_title" >Import file</td>
						<td width="76%" valign="top"><input type="file" name="fleXLS" />
                        <span style="font-size:11px; font-weight:normal; color:#666666">e.g: *.csv</span>
							<img src="images/icons/help.png" onclick="showHelp(this)" style="cursor:pointer" />
							<div class="div_help"> The csv file to be imported. </div>
					</tr>					
					<tr>
						<td colspan="10" class="form_title" align="right" >
                        	<input type="hidden" name="upl" value="1" />
							<input type="submit" value="Send file" class="submit_button" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php include ( "inc.footer.php" ) ; ?>
	<!-- end #container -->
</div>
</body>
</html>