<div class="row">
	<div class="col-md-12">
	<h2>Your box status</h2>
	<div><b><?php echo $order->cart_id;?></b></div>
	<div>Item in this box</div>
	<table>
		<th>&nbsp;</th>
		<th>Product</th>
		<th>Product Condition</th>
		<th>Amount</th>
		<!--<th>Offers Expires</th>
		<th>Offer</th>-->
		<?php 
		if(!empty($order->content)){
			$items=unserialize($order->content);		
			foreach($items as $item){
				$product=$this->product_model->get_product_by_id($item['id']);				
		?>
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
			
			<td><?php echo ucwords($item['options']['condition']);?></td>
			<td>$<?php echo $item['price'];?></td>
		</tr>
		<?php } 
		} ?>
	</table>
	
	</div>
</div>