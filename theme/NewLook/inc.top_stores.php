<div class="right_box">
    <div class="right_box_top"></div>
    <div class="right_box_inn">
        <h3>Top <?php echo $tag["TagName"] ?> Stores</h3>
        <div class="break"></div>
        <br />
        			<ul class="topList">
							<?php
						$websites = $data->select ( "Website_Tag" , "*", array ( "TagID" => intval ( $tag["TagID"] ) ) ) ;
						if ( ! empty ( $websites ) )
							foreach ( $websites as $website ) :
								$web_detail = $data->select ( "Website" , "*" , array ( "WebsiteID" => $website["WebsiteID"] ) ) ;
								$web_detail = $web_detail[0] ;
								if($web_detail["WebsiteName"]!=''){
					?>
							<li style="text-align:left;color: #65666a;">
								<a href="<?php echo base_url.get_sef_url ( $website["WebsiteID"] , "Website" ) ?>/" title="<?php echo $web_detail["WebsiteTitle"] ?> Coupon Codes" style="color: #65666a;"><?php echo $web_detail["WebsiteName"] ?></a>
							</li>
							<?php
								}
							endforeach ;
					?>
						</ul>
    </div>
    <div class="right_box_bottom"></div>                	
</div>
