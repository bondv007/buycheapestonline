<?php
	include ( "core/inc.meta.php" ) ;
?>
<link href="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/all.css" rel="stylesheet" type="text/css">




<div id="div_Login" class="popup" style=" z-index:105; width: auto;">
	<table border="0" align="center" cellpadding="0" cellspacing="0" id="facebox">
		<tbody>
			<tr>
				<td class="tl"></td>
				<td class="b"></td>
				<td class="tr"></td>
			</tr>
			<tr>
				<td class="b"></td>
				<td class="body">
					<div style="display: block;" class="content">
						<div id="popup">
							<div id="heading">
								Post a comment
							</div>
							<div id="content">
								<form action="<?php echo base_url ?>comments_post/<?php echo $qstring[1] ?>/" method="post">
									<input type="hidden" name="CouponID" style="display:none;" value="<?php echo $qstring[1] ?>" />
									<div style="margin: 0pt; padding: 0pt; display: inline;">
									</div>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="19%" height="52"><label for="f_name">Name:</label></td>
											<td colspan="2"><input type="text" id="f_name" name="User_POST_Name" /></td>
										</tr>
										<tr>
											<td><label for="f_email">Email:</label></td>
											<td colspan="2"><input type="text" id="f_email" name="Email_POST_Address" /></td>
										</tr>
										<tr>
											<td valign="top"><label for="f_description">Comments:</label></td>
											<td colspan="2"><textarea name="Comments_POST_" id="f_description" style="width:250px; height:90px;" ></textarea></td>
										</tr>
										<?php
											if ( intval ( $app_init_data["SignupAuthentication"] ) == 1 )
											{
										?>
										<tr>
											<td><label for="">&nbsp;</label></td>
											<td colspan="2">
													 &nbsp; <img src="<?php echo base_url ?>yadcap.php?posting=1" />
													<br />
													<input type="text" name="capSecurity" value="" />
												</td>
										</tr>
										<?php
											}
										?>
										
										<tr>
											<td height="49">&nbsp;</td>
											<td width="39%"></td>
											<td width="42%"><input id="user_submit" name="commit" value="Post My Comment!" type="submit" class="inputbtn" /></td>
										</tr>
										
									</table>
								</form>
							</div>
							<div style="clear: both;">
							</div>
						</div>
					</div>
					<div style="display: block;" class="footer">
						<a href="#" class="close" onclick="close_window('div_Login')">
							<img src="<?php echo base_url ?>theme/<?php echo $app_init_data["CurrentSkin"] ?>/images/closelabel.gif" title="close" class="close_image">
						</a>
					</div></td>
				<td class="b"></td>
			</tr>
			<tr>
				<td class="bl"></td>
				<td class="b"></td>
				<td class="br"></td>
			</tr>
		</tbody>
	</table>
</div>
