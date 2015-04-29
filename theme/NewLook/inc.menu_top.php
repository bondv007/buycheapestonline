<a href="<?php echo base_url ?>">Home</a> |
<a href="<?php echo base_url ?>How-To-Do-It/">How to do it</a> |
<a href="<?php echo base_url ?>Contact/">Contact</a>

<div id="div_loading"><img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/ajax-loader.gif" border="0" /></div>

<script type="text/javascript">
	
	$(document).ready ( 
		function ( )
		{
			$("#div_Background").click ( close_window ) ;
			
		}
	);
	
	var wd = $(window).width ( ) ;
	var ht = $(window).height ( ) ;
	
	function close_window ( )
	{
		
		$("#div_Window").animate ( { top : "25%" , opacity : 0.10 } , "normal" , function ( )
			{
				$(this).hide().css({top:"15%"});
				$("#div_Background").hide ( ) ;
			}
		) ;
		
	}
	
	function show_Screen_bg ( divArea )
	{
	
		$("#div_Background").css ( {"left" : "0px" , "top" : "0px" , "opacity" : 0.60} ).width( wd ).height ( ht ).show();

	}
	
	function show_window_comment( coupon_id )
	{
		show_Screen_bg ( ) ;
		
		$("#div_loading").show();
		$("#div_Window").load("<?php echo base_url."comments_post/"; ?>"+coupon_id+"/", function()
			{
				var n_wd = $("#div_Window").width ( ) ;
				var n_ht = $("#div_Window").height ( ) ;
				$(this).css ( { "left" : ((wd/2) - (n_wd/2))+"px", "opacity":0.10 } ).show().animate ( {top:"20%", opacity:1.0}, "normal" ) ;
				$("#div_loading").hide();
			}
		 ) ;
	}
	
	
	function show_comments ( coupon_id ) 
	{
		$("#li_close_comments_"+coupon_id).children().show();
		$("#li_write_comments_"+coupon_id).children().show();
		$("#div_comments_"+coupon_id).slideDown('normal');
	}
	
	function close_comments ( coupon_id )
	{
		$("#div_comments_"+coupon_id).slideUp('normal');
		$("#li_close_comments_"+coupon_id).children().hide();
		$("#li_write_comments_"+coupon_id).children().hide();
	}
	

</script>

<div id="div_Background" style="display:none; background-color:#000000; position:fixed; z-index:101" >
</div>

<div id="div_Window" style="display:none; top:15%; z-index:105; position:fixed; padding: 8px; width: auto;">
</div>