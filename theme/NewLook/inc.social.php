<div class="right_box">
    <div class="right_box_top"></div>
    <div class="right_box_inn">
        <h3>We Are Social</h3>
        <div class="break"></div>
        <br />
        <script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
        <table>
            <tr>
				<?php
                foreach ( $app_init_data as $key => $site ) :
                if ( strchr ( $key , "SocialNet_" ) && $site != "" )
                {
                ?>
                <td><a href="<?php echo $site ?>" target="_blank"><img src="<?php echo base_url ?>media/<?php echo $key.".png" ?>" border="0" alt="Icon <?php echo $site ?>" /></a></td>
                <?php
                }
                endforeach ;
                ?>
                <td>
                <!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4bb3c8fe025daee8"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" alt="Bookmark and Share" style="border: 0pt none;" width="125" height="16" /></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4bb3c8fe025daee8"></script>
<!-- AddThis Button END -->
                </td>
            </tr>
        </table>
    </div>
    <div class="right_box_bottom"></div>                	
</div>
