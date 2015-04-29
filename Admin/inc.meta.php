<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title["SiteValue"] ?> :: Coupon Script Admin</title>
<link href="images/admin_style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="http://code.jquery.com/jquery-1.4.2.min.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
$(document).ready(function() {

	$('.acc_container').hide(); 
	$('.acc_trigger:nth(<?php echo $_SESSION["menu_option"] ?>)').addClass('active').next().show(); 
	
	$('.acc_trigger').click(function(){
		if( $(this).next().is(':hidden') ) { 
			$('.acc_trigger').removeClass('active').next().slideUp(); // comment linie daca vrei sa nu se inchida categoria cand deschizi alta
			$(this).toggleClass('active').next().slideDown(); 
		}
//		else {
//		$(this).next().slideUp()			// uncomment pentru a ascunde meniurile deschide la click pe categorie, 
//		}
		return false;
	});

});
	
	function showHelp ( caller_obj ){
		if ( caller_obj ){
			$(caller_obj).next('div.div_help').toggle ( 'normal' ) ;
		}
	}

	function validateForm ( ){
		var returnValue = true ;
		$('input,select,textarea').each ( function ( ){
			if ( $(this).attr('sch_req') == "1" && returnValue ){
				if ( $(this).val() == "" ){
					alert ( $(this).attr('sch_msg')+" cannot be empty" ) ;
					returnValue = false ;
				}
			}
		}
		) ;
		return returnValue ;

	}
</script>
