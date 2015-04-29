
<title><?php echo $app_init_data["SiteTitle"] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $app_init_data["SiteDescription"] ?>" />
<meta name="keywords" content="<?php echo $app_init_data["SiteKeyword"] ?>" />
<link href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/css/superfish.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url ?>js/yadjs.js"></script>
<script type="text/javascript" src="<?php echo base_url ?>js/ZeroClipboard.js"></script>
<script type="text/javascript" src="<?php echo base_url ?>js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php echo base_url ?>js/hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo base_url ?>js/superfish.js"></script>

<script type="text/javascript">

	// initialise plugins
	jQuery(function(){
		jQuery('ul.sf-menu').superfish();
	});

	function validateForm ( form_obj )
	{
		var returnValue = true ;
		$("#"+form_obj+" input,select,textarea").each ( function ( )
							{
								if ( $(this).attr("sch_req") == "1" && returnValue )
								{
									if ( $(this).val() == "" )
									{
										alert ( $(this).attr("sch_msg")+" cannot be empty" ) ;
										$(this).focus();
										returnValue = false ;
									}
								}
							}
					
		 ) ;
		 return returnValue ;

	}
	
	function copy_coupon_and_go_to_site ( coupon_id )
	{
		window.open ( "<?php echo base_url ?>load/"+coupon_id+"/" , "_blank" ) ;
	}
	
	function animate_area ( div_id , direction, ul_id )
	{
		if ( direction == 0 )
			$("#"+div_id).animate ( { scrollLeft : "-=660" } , "slow" ) ;
		else
			$("#"+div_id).animate ( { scrollLeft : "+=660" } , "slow" ) ;
		if (($("#"+div_id).scrollLeft())+661>$("#"+ul_id).width())
			$("#"+div_id).animate ( { scrollLeft : "=0" } , "slow" ) ;
	}

	function animate_area2 ( div_id , direction, ul_id )
	{
		if ( direction == 0 )
			$("#"+div_id).animate ( { scrollTop : "-=145" } , "slow" ) ;
		else
			$("#"+div_id).animate ( { scrollTop : "+=145" } , "slow" ) ;
		if (($("#"+div_id).scrollTop())+146>$("#"+ul_id).width())
			$("#"+div_id).animate ( { scrollTop : "=0" } , "slow" ) ;
	}
	
	function show_tool_tip ( copon_id )
	{
		$("#coupon_Tool_tip_action_"+copon_id).show() ;
	}
	
	function hide_tool_tip ( copon_id )
	{
		$("#coupon_Tool_tip_action_"+copon_id).hide() ;
	}
	
	
	function set_copy_command ( text_to_copy , control_id , coupon_id )
	{
		if ( navigator.userAgent.indexOf("MSIE") > -1 ) 
		{
			$("#"+control_id).click ( function ( )
										{
											window.clipboardData.setData("Text",text_to_copy);
											copy_coupon_and_go_to_site ( coupon_id ) ;
										}
									 ) ;
		}
		else
		{
			var clip = new ZeroClipboard.Client();
		   
			ZeroClipboard.setMoviePath ( "<?php echo base_url ?>js/ZeroClipboard.swf" ) ;
		   
			clip.setText( text_to_copy ); 
			clip.setHandCursor( true );
			clip.addEventListener( 'mouseOver', function(client) {
                                show_tool_tip ( coupon_id ) ;
                        } );
			clip.addEventListener( 'mouseOut', function(client) { 
                                hide_tool_tip ( coupon_id ) ;
                        } );
			clip.addEventListener( 'complete', function(client, text) {
				$("#"+control_id).css("background-color" , "#33CC66");
				$("#coupon_Tool_tip_action_"+coupon_id).css("width","60px").text("Copied ! ") ;
				copy_coupon_and_go_to_site ( coupon_id ) ;
			} );
													
			clip.glue( control_id );
		}
	}

	
//The auto-scrolling function
function slide(){
  $('#nextbuttonhorizontal').click();
  $('#nextbuttonvertical').click();
}
//Launch the scroll every 5 seconds
var intervalId = window.setInterval(slide, 5000);
	
	
</script>

