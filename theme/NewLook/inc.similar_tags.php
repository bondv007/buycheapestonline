<div class="right_box">
    <div class="right_box_top"></div>
    <div class="right_box_inn">
        <h3>Similar Tags</h3>
        <div class="break"></div>
        <br />
            <?php
                $tags_rand = array ( ) ;
                $tags = $data->select ( "Website_Tag" , "*" , array ( "WebsiteID" => intval ( $website["WebsiteID"] ) ) ) ;
                if ( ! empty ( $tags ) ){
                    foreach ( $tags as $tag_web ){
                        $tag_detail = $data->select ( "Tag" , "*" , array ( "TagID" => intval ( $tag_web["TagID"] ) ) ) ;
                        $tags_rand[] = $tag_web["TagID"] ;
            ?>
            <div class="tags">
                <a href="<?php echo base_url."coupons/".get_sef_url ( $tag_web["TagID"] , "Tag" ) ?>/" title="<?php echo $tag_detail[0]["TagName"] ?> coupon codes"><?php echo $tag_detail[0]["TagName"] ?></a>
            </div>
            <?php
                    }
                }
            ?>
    </div>
    <div class="right_box_bottom"></div>                	
</div>
