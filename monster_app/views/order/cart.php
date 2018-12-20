<?php
$total_price=0;
if(!empty($items)){
	?>
<div class="row">
<!--LEFT SECTION Start------>
<div id="checkout_step_1">
<form class="checkout_step_1">
<div class="col-md-9">
<div class="row">
	<!--<div class="col-md-6">
    	<div class="p-m-section">
			<div><img src="<?php //echo base_url();?>assets/images/recom_img.jpg"></div>
			<div>Apple (preferred)<input type="radio" name="payment_method" value="apple"></div>
			<div><b>Apple Gift Card: </b>Get paid quickly via electronic gift card.</div>
		</div>
    </div>-->
    <div class="col-md-6">
    	<div class="p-m-section">
			<div><img src="<?php echo base_url();?>assets/images/paypal.jpg"></div>
			<div>PayPal<input type="radio" name="payment_method" value="paypal"></div>
			<div><b>PayPal: </b>No need to wait for the mail. Get your payment quickly through your Paypal account.</div>
		</div>
    </div>
    <div class="col-md-6">
    	<div class="p-m-section">
			<div><img src="<?php echo base_url();?>assets/images/check_select.jpg"></div>
			<div>Cheque<input type="radio" name="payment_method" value="cheque"></div>
			<div><b>Cheque: </b>Get paid via standard bank cheque, delivered by mail within 7 days.</div>
		</div>
    </div>
	</div>
	<!--<div class="row" style="margin-top:150px;">
	<div class="col-md-4">
    	<div class="p-m-section">
			<div><img src="<?php //echo base_url();?>assets/images/interac_select.png"></div>
			<div>Interac Email<input type="radio" name="payment_method" value="interac_email"></div>
			<div><b>Interac: </b>With Interac transfer, your payment is deposited directly into your account using email.</div>
		</div>
    </div>
</div>-->

<!--CLICK TO OPEN FORMS-->
<div class="click-pay-form">
<div class="row">
<div class="payment_method_fields">
	<div class="col-md-12" id="apple_field" style="display:none;">
		<h2>Your Apple Gift Card code will be emailed to</h2>
	</div>
	<div class="col-md-12" id="paypal_field" style="display:none;">
    <div class="click-form-section">
		<h4>Confirm your PayPal email address so we can ensure prompt payment.</h4>
		<h5>Enter the email address associated with your PayPal </h5>		
		<label><span>Account</span><input type="text" name="paypal_email" id="paypal_email"></label>		
		<label><span>Confirm your PayPal email address</span><input type="text" name="confirm_paypal_email" id="confirm_paypal_email"></label>
		<div id="paypal_email_error" style="display:none;"></div>
		<input type="submit" value="Continue">
    </div>
	</div>
	<div class="col-md-12" id="cheque_field" style="display:none;">
    <div class="click-form-section">
		<h4>Please provide the address you'd like your check sent to.</h4>
		
		<label><span>Payable to</span><input type="text" name="payable_to" id="payable_to"></label>		
		<label><span>Address Line 1</span><input type="text" name="address_1" id="address_1"></label>		
		<label><span>Address Line 2 (optional)</span><input type="text" name="address_2" id="address_2"></label>		
		<label><span>City</span><input type="text" name="city" id="city"></label>		
		<label><span>Province</span><select name="province" id="province"><option>Select</option></select></label>		
		<label><span>Zip Code</span><input type="text" name="zip_code" id="zip_code"></label>
		<div id="cheque_error" style="display:none;"></div>
		<input type="submit" value="Continue">
	</div>
	</div>
	<div class="col-md-12" id="interac_field" style="display:none;">
		<p>Confirm your Interac Email address so we can ensure prompt payment.</p>
		<p>Enter the email address associated with your Interac  </p>
		account
		<div><input type="text"></div>
		Confirm your Interac email address
		<div><input type="text"></div>
	</div>
</div>

<div class="col-md-12">
<div class="click-pay-form-back-bg">
<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>
</div>
</div>

</div>
</div>
<!--CLICK TO OPEN FORMS-->

</div>  
</form> 
<!--LEFT SECTION END-->

<!--Right SECTION-->
<div class="col-md-3">
	<div class="cart">
	<ul class="cart-list">
	<?php
	foreach($items as $item){
		$img_src='';
		//$details=$this->catalog_model->get_product_related_details($product->product_id);
		//$href=base_url($details->category_slug.'/'.$details->product_slug.'/'.$details->model_slug);
		if(file_exists(UPLOADS_PRODUCT_THUMB.$item->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$item->product_image;
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
		<li class="cart-item" data-rowid="<?php echo $item->order_details_id; ?>">
		<div class="cart-inn">
        <div class="cart-pic"><img src="<?php echo $img_src;?>"></div>
		<h4><?php echo $item->model_name.'&nbsp;'.$item->product_name;?></h4>
		<p><strong>Condition</strong>: <?php echo ucwords($item->product_condition);?></p>
		<p><strong>Price</strong>: $<?php echo $item->price;?></p>
		<a href="javascript:void(0);" class="delete_cart_item" data-rowid="<?php echo $item->order_details_id; ?>">Delete</a>
		</div>
		</li>
		<?php
		$total_price+=$item->price;
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
