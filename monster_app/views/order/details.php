<div class="row">
	<div class="col-md-12">
	<h2>Your box status</h2>
	<div><b><?php echo $order->order_id;?></b></div>
	<div>Item in this box</div>
	<table>
		<th>&nbsp;</th>
		<th>Product</th>
		<th>Status</th>
		<th>Offers Expires</th>
		<th>Offer</th>
		<tr>
			<td>
			<?php
			$img_src='';
			if(file_exists(UPLOADS_PRODUCT_THUMB.$product->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$product->product_image;
			}
			?>
			<img src="<?php echo $img_src;?>">
			</td>
			<td><?php echo $product->model_name.'&nbsp;'.$product->product_name;?></td>
			<td>
			<?php 
			$status='Pending';
			switch($order->status){
				case '1':
				$status='Pending';
				break;
				case '2':
				$status='Processing';
				break;
				case '3':
				$status='On the way';
				break;
				case '4':
				$status='Completed';
				break;						
				
			}
			echo $status;
			?>
			</td>
			<td>&nbsp;</td>
			<td>$<?php echo $order->price;?></td>
		</tr>
	</table>
	
	</div>
</div>