<div class="right_box">
    <div class="right_box_top"></div>
    <div class="right_box_inn">
        <h3>Share Your Coupon</h3>
        <div class="break"></div>
        <br />
        <p> Found a coupon for <strong><?php echo $website["WebsiteName"] ?></strong>? <br>
            Enter the details below to share with other users:</p>
        <form method="post" action="" id="couponSubmit">
            <div class="row" id="storeField">
                <label for="host">Store </label>
                <input name="host" readonly="readonly" maxlength="60" value="<?php echo $website["WebsiteTitle"] ?>" type="text">
            </div>
            <div class="row">
                <label for="f_code">Coupon code </label>
                <input name="f_code" maxlength="50" type="text">
            </div>
            <div class="row">
                <label for="f_description">Discount </label>
                <textarea name="f_description" rows="2" cols="20"></textarea>
            </div>
            <?php
                if ( intval ( $app_init_data["SignupAuthentication"] ) == 1 )
                {
            ?>
            <div class="row">
                <img style="margin-left:40px;" src="<?php echo base_url ?>yadcap.php" />
                <br />
                <label for="f_code">Code image</label>
                <input type="text" name="capSecurity" value=""  />
            </div>
        
            <?php
                }
            ?>
            <div class="row">
                <button type="submit" id="couponSubmitButton">Submit coupon</button>
            </div>
            <input name="WebsiteID" value="<?php echo $website["WebsiteID"] ?>" type="hidden">
        </form>
    </div>
    <div class="right_box_bottom"></div>                	
</div>
