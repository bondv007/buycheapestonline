<?php
	$sS = $data->select ( "SiteManager" , "*" , array ( "SiteVariable" => "SiteVersion" ) , 0 , 50 ) ;
	foreach ( $sS as $s ){
		$dArray[$s["SiteVariable"]] = $s["SiteValue"] ;
	}
?>
	</td>
</tr>
<tr>
	<td colspan="100">
        <div id="footer">
            <div style="float:left">
                <a href="<?php echo base_url ?>" target="_blank">Home</a>
            </div>
            <div style="float:right">v.<?php echo $dArray["SiteVersion"] ?></div>
        </div>
	</td>
</tr>

</table>