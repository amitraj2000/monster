<div class="container">
<div class="col-md-12">

<div class="row">

<!--LEFT SECTION Start------>
<div class="col-md-9">
<form class="checkout_step_2">
<div class="click-pay-form">
<div class="row">
<div class="col-md-12">
<div class="click-form-section">
		<h4>Please Provide Your Details</h4>
        
        <label><span>First Name</span><input type="text" name="first_name" id="first_name"></label>
        <label><span>Last Name</span><input type="text" name="last_name" id="last_name"></label>
        <label><span>Address Line 1</span><input type="text" name="address_1" id="address_1"></label>
        <label><span>Address Line 2</span><input type="text" name="address_2" id="address_2"></label>
        <label><span>City</span><input type="text" name="city" id="city"></label>
        <label><span>Province</span><select><option>Select</option></select></label>
        <label><span>Zip Code</span><input type="text" name="zip_code" id="zip_code"></label>
        <label><span>Phone Number</span><input type="text" name="phone_number" id="phone_number"></label>
        
        
    <div class="row">	
        <div id="step_2_error" style="display:none"></div>
        <div class="col-md-6">
            <input type="submit" value="Continue">
        </div>
        
</div>

</div>
</div>    
</div>
</div>

<div class="row">
<div class="col-md-12"><div class="click-pay-form-back-bg"><a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a></div></div>
</div>
</form>
</div> 
<!--LEFT SECTION End------>

<!--Right SECTION-->
<div class="col-md-3">
	<div class="cart">
	<?php
$total_price=0;
if(!empty($items)){
	?>
	<ul class="cart-list">
	<?php
	foreach($items as $key=>$item){
		
		$img_src='';
		$product=$this->product_model->get_product_by_id($item['id']);
		//$details=$this->catalog_model->get_product_related_details($product->product_id);
		//$href=base_url($details->category_slug.'/'.$details->product_slug.'/'.$details->model_slug);
		if(file_exists(UPLOADS_PRODUCT_THUMB.$product->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$product->product_image;
		}
		
		/* if(!empty($item->has_variation)){
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
		} */ 
		?>
		<li class="cart-item" data-rowid="<?php echo $key; ?>">
		<div class="cart-inn">
        <div class="cart-pic"><img src="<?php echo $img_src;?>"></div>
		<h4><?php echo $product->model_name.'&nbsp;'.$product->product_name;?></h4>
		<p><strong>Condition</strong>: <?php echo ucwords($item['options']['condition']);?></p>
		<p><strong>Price</strong>: $<?php echo $item['price'];?></p>
		<a href="javascript:void(0);" class="delete_cart_item" data-rowid="<?php echo $key; ?>" data-cartid="<?php echo $cart_id;?>">Delete</a>
		</div>
		</li>
		<?php
		$total_price+=$item['price'];
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


</div>
</div>
