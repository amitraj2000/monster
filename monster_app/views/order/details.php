<div class="row">
	<div class="col-md-12">
	<h2>Your box status</h2>
	<div><b><?php echo $order->box_id;?></b></div>
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
			if(file_exists(UPLOADS_PRODUCT_THUMB.$order->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$order->product_image;
			}
			?>
			<img src="<?php echo $img_src;?>">
			</td>
			<td><?php echo $order->model_name.'&nbsp;'.$order->product_name;?></td>
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
			<td>$<?php 
				if(!empty($order->has_variation)){
				$variations=$this->product_model->get_product_variation_by_id($order->product_id,$order->provider_id);
				}
				$price=0;
				switch($order->product_condition){
					case 'flawless':
						if(!empty($order->has_variation) && !empty($variations->flawless_price))
						$price=$variations->flawless_price;
						else
						$price=$order->flawless_price;
						break;
					case 'good':
						if(!empty($order->has_variation) && !empty($variations->good_price))
						$price=$variations->good_price;
						else
						$price=$order->good_price;
						break;
					case 'broken':
						if(!empty($order->has_variation) && !empty($variations->broken_price))
						$price=$variations->broken_price;
						else
						$price=$order->broken_price;				
						break;			
				} 
				echo $price;?></td>
		</tr>
	</table>
	
	</div>
</div>