<div class="row">
	<form class="checkout_step_2">
	<div class="col-md-9">
		<div class="row">			
			<div class="col-md-6">
				<div>First Name</div>
				<div><input type="text" name="first_name" id="first_name"></div>
			</div>
			<div class="col-md-6">
				<div>Last Name</div>
				<div><input type="text" name="last_name" id="last_name"></div>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-6">
				<div>Address Line 1</div>
				<div><input type="text" name="address_1" id="address_1"></div>
			</div>
			<div class="col-md-6">
				<div>Address Line 2</div>
				<div><input type="text" name="address_2" id="address_2"></div>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-3">
				<div>City</div>
				<div><input type="text" name="city" id="city"></div>
			</div>
			<div class="col-md-3">
				<div>Province</div>
				<div><select><option>Select</option></select></div>
			</div>
			<div class="col-md-3">
				<div>Zip Code</div>
				<div><input type="text" name="zip_code" id="zip_code"></div>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-6">
				<div>Phone Number</div>
				<div><input type="text" name="phone_number" id="phone_number"></div>
			</div>
			
		</div>
		<div class="row">	
			<div id="step_2_error" style="display:none"></div>
			<div class="col-md-6">
				<input type="submit" value="Continue">
			</div>
			
		</div>
		<div class="ajax-login-back-bg"><a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a></div>
	</div> 
	</form>
	<!--Right SECTION-->
<div class="col-md-3">
	<div id="cart">
	<?php
$total_price=0;
if(!empty($items)){
	?>
	<ul id="cart-list">
	<?php
	foreach($items as $item){
		$img_src='';
		//$details=$this->catalog_model->get_product_related_details($product->product_id);
		//$href=base_url($details->category_slug.'/'.$details->product_slug.'/'.$details->model_slug);
		if(file_exists(UPLOADS_PRODUCT_THUMB.$item->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$item->product_image;
		}
		
		if(!empty($item->has_variation)){
		$variations=$this->product_model->get_product_variation_by_id($item->product_id,$item->provider_id);
		}
		$price=0;
		switch($item->product_condition){
			case 'flawless':
				if(!empty($item->has_variation) && !empty($variations->flawless_price))
				$price=$variations->flawless_price;
				else
				$price=$item->flawless_price;
				break;
			case 'good':
				if(!empty($item->has_variation) && !empty($variations->good_price))
				$price=$variations->good_price;
				else
				$price=$item->good_price;
				break;
			case 'broken':
				if(!empty($item->has_variation) && !empty($variations->broken_price))
				$price=$variations->broken_price;
				else
				$price=$item->broken_price;				
				break;			
		} 
		?>
		<li class="cart-item" data-rowid="<?php echo $item->order_id; ?>">
		<div class="cart-inn">
        <div class="cart-pic"><img src="<?php echo $img_src;?>"></div>
		<h4><?php echo $item->model_name.'&nbsp;'.$item->product_name;?></h4>
		<p><strong>Condition</strong>: <?php echo ucwords($item->product_condition);?></p>
		<p><strong>Price</strong>: $<?php echo $price;?></p>
		<a href="javascript:void(0);" class="delete_cart_item" data-rowid="<?php echo $item->order_id; ?>">Delete</a>
		</div>
		</li>
		<?php
		$total_price+=$price;
		}
		?>
	</ul>
	<div class="total"><strong>Total</strong>: $<?php echo $total_price;?></div>
	<?php
	
}else{
	echo 'No items found';
}
?>
</div>
</div>
<!--RIGHT SECTION END-->
</div>