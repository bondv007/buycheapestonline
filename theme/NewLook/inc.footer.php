<?php

if(isset($_POST['submit_news'])){
	if($_REQUEST['submit_news']){
	$email = sqlesc($_REQUEST['smtmail']);
	$data_reg = '0000-00-00 00:00:00';
		if(ValidateEmail($email)){
			
			$nl_detail = $data->select ( "Newsletter" , "*" , array ( "email" => $email ) ) ;
			$nl_detail = $nl_detail[0] ;
			if ( ! empty ( $nl_detail ) ){
				$token['message'] = 'e-mail address already registered';
			}else{
				///////////     SEND MAIL ... GENERATION CODE FOR CONFIRMATION ////////////////
				$cod = rand();
				$data_aplic = date("Y-m-d H:i:s",time());
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$postdata = array ( ) ;
				$postdata["email"] = $email ;
				$postdata["ip"] = $ip ;
				$postdata["date_aplic"] = $data_aplic ;
				$postdata["code"] = $cod ;
				
				$id = $data->insert ( "Newsletter" , $postdata ) ;

				////send mail /////////
				$token['message'] = 'a confirmation e-mail was sent to your address';
				$to = $email;
				$subject = 'Newsletter register to '.$app_init_data["SiteName"];
				$message = 'Your e-mail address applied to be register in our database for the newsletter '.$app_init_data["SiteName"].'. <br /> To confirm click ' .' <a href="'.base_url.'subscribe/'.md5($cod).'/'.$email.'" target="_blank">here</a>.';
				$message = wordwrap($message, 70);
				$headers = 'From: Newsletter '.$app_init_data["SiteName"].' <'.$app_init_data["OwnerEmail"].'>';
				$antet  = "MIME-Version: 1.0\r\n";
				$antet .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$antet .= $headers;
				mail($to, $subject, $message, $antet);
			}
		}else $token['message'] = 'e-mail address is not valid';
	}	
}
$letters = array('#','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','XYZ'); 

?>

<div id="bottom_container">
    <div id="bottom_cont_top"></div>
    <div id="bottom_cont_inn">
        <div class="about_us">
            <h3>Check Also</h3>
            <ul class="footer_menu">
				<?php
                $links = $data->select ( "Link_Footer" , "*" , null , 0 , 4 );
                if ( ! empty ( $links ) )
                {
                    foreach ( $links as $link )
                    {
            	?>
                <li>
                    <a href="<?php echo $link["Link"] ?>" title="<?php echo $link["Name"] ?>"><?php echo $link["Name"] ?></a>
                </li>
            	<?php
                    }
                }
            	?>
            </ul>
        </div>
        <div class="about_us">
            <h3>&nbsp;</h3>
            <ul class="footer_menu">
				<?php
                $links = $data->select ( "Link_Footer" , "*" , null , 4 , 4 );
                if ( ! empty ( $links ) )
                {
                    foreach ( $links as $link )
                    {
            	?>
                <li>
                    <a href="<?php echo $link["Link"] ?>" title="<?php echo $link["Name"] ?>"><?php echo $link["Name"] ?></a>
                </li>
            	<?php
                    }
                }
            	?>
            </ul>
        </div>
        <div class="about_us">
            <h3>&nbsp;</h3>
            <ul class="footer_menu">
				<?php
                $links = $data->select ( "Link_Footer" , "*" , null , 8 , 4 );
                if ( ! empty ( $links ) )
                {
                    foreach ( $links as $link )
                    {
            	?>
                <li>
                    <a href="<?php echo $link["Link"] ?>" title="<?php echo $link["Name"] ?>"><?php echo $link["Name"] ?></a>
                </li>
            	<?php
                    }
                }
            	?>
            </ul>
        </div>
        <form action="" method="post" name="newsletter">
        <div class="newsletter">
            <p>Newsletter</p>
            <?php echo $token['message'] ?>
            <div class="subscribe_container">
                <input name="smtmail" type="text" class="subscribe_field" />
                <input type="submit" class="subscribe_btn" />
            </div>
        </div>
        <input type="hidden" name="submit_news" value="1"  />
		</form>
    </div>
    <div id="bottom_cont_bott"></div>
</div>
<div id="copyright">
	<h1 class="heading">All Stores</h1>
	<br>
	<div class="heading4"><strong><span style="color: #00000;">Click below to view today's DEALS at stores starting with each letter</span></strong></div>
	<strong>
		<br>
		<div class="heading4">
			<strong>
				<span style="color: #00000;">Check back often! New stores added daily!</span>
			</strong>	
		</div>	
		<strong>
			<br>
			<div style="clear:both;padding-top:5px;letter-spacing:5px;text-align:center; margin-bottom:26px;" class="custom">
				<?php 
					foreach($letters as $key=>$val){
						$text = "all-stores-"; 
						$char = $val;
						if($key == 0) {
							$char = "Number";
							$text = "All-Stores-";
						}										
				?>
				<a href="<?php echo base_url.$text.$char; ?>"><?php echo $val; ?></a> <?php if($key !=24) echo "|"; ?> 
				<?php }  ?>
			</div>
			
		</strong>	
	</strong>	
    Copyright &copy; 2010 <a href="http://www.couponsitescript.com" target="_blank">www.couponsitescript.com</a>. All Rights Reserved. 
</div>
<?php
	echo stripslashes($app_init_data["GoogleAnalytics"]) ;
?>