<div class="right_box">
    <div class="right_box_top"></div>
    <div class="right_box_inn">
        <h3>Related Tags</h3>
        <div class="break"></div>
        <br />
	<?php
        $websites = $data->select ( "Website_Tag" , "*" , array ( "TagID" => $det["EntityID"] ) ) ;
        $s = "(0 ";
        if ( ! empty ( $websites ) )
            foreach ( $websites as $web ){
                $s.="OR Website_Tag.WebsiteID=".$web['WebsiteID']." ";
            }
        $s.=")";
        
        $tags = $data->select2 ( "select * from Tag, Website_Tag where ".$s." AND Tag.TagID=Website_Tag.TagID LIMIT 0,15" ) ;
        if ( ! empty ( $tags ) )
            foreach ( $tags as $mtag ){
    ?>
        <div class="tags">
            <a href="<?php echo base_url."coupons/".get_sef_url ( $mtag["TagID"] , "Tag" ) ?>/" title="<?php echo $mtag["TagName"] ?> coupon codes"><?php echo $mtag["TagName"] ?></a>
        </div>
    <?php
        }
    ?>
    </div>
    <div class="right_box_bottom"></div>                	
</div>
