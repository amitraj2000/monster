<div class="main_contrainer thanks">
<div class="container">

<div class="row">
	<div class="col-md-12">    
	<table>
	<th>Order Id</th>
	<th>Event</th>
	<th>Event Date</th>
	<tbody>
		<?php if(empty($status_row)){?>
		<tr>
			<td colspan="3">No active tracking records found</td>
		</tr>
		<?php }else{
			foreach($status_row as $row)
			{
				?>
				<tr>
					<td><?php echo $row['order_id'];?></td>
					<td><?php echo $row['event'];?></td>
					<td><?php echo $row['event_date'];?></td>
				</tr>
				
				<?php
			}
		} ?>
	</tbody>
	</table>
	
	</div>
</div>

</div>
</div>