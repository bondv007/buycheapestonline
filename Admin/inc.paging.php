<?php
	if ( intval ( $totalRecords ) == 0 )
		$totalRecords = $data->get_num_records ( ) ;
	$totalPages = ceil ( $totalRecords / $pageSize ) ;
?>
<tr class="listing_paging">
	<td align="left" colspan="3">
		Showing page # <strong><?php echo intval ( $_GET["p"] ) + 1 ?></strong> of <strong><?php echo $totalPages ?></strong> with Total Records : <strong><?php echo $totalRecords ?></strong>
	</td>
	<td colspan="100" align="right">
		<?php
			$start_num_page = 0 ;
			$end_num_page = $totalPages ;
			
			if ( $totalPages > 10 )
			{
				if ( intval ( $_GET["p"] ) > 4 )
					$start_num_page = intval ( $_GET["p"] ) - 3 ;
				if ( intval ( $_GET["p"] ) + 10 < $totalPages )
				$end_num_page = intval ( $_GET["p"] ) + 10 ;
			}
			if ( $totalRecords > $pageSize )
			{
				for ( $i = $start_num_page ; $i < $end_num_page ; $i++ )
				{
					echo "<a href='?p=$i".get_query_string_vars("p")."' class='pagination_link'>".($i+1)."</a>" ;
				}
			}
		?>
	</td>
</tr>