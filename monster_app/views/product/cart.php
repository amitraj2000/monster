<?php
$total_price=0;
if(!empty($items)){
	?>
<div class="row">
<!--LEFT SECTION Start------>
<div class="col-md-9">
<div class="row">
	<div class="col-md-4">
    	<div class="p-m-section">
			<div><img src="<?php echo base_url();?>assets/images/recom_img.jpg"></div>
			<div>Apple (preferred)<input type="radio" name="payment_method" value="apple"></div>
			<div><b>Apple Gift Card: </b>Get paid quickly via electronic gift card.</div>
		</div>
    </div>
    <div class="col-md-4">
    	<div class="p-m-section">
			<div><img src="<?php echo base_url();?>assets/images/paypal.jpg"></div>
			<div>PayPal<input type="radio" name="payment_method" value="paypal"></div>
			<div><b>PayPal: </b>No need to wait for the mail. Get your payment quickly through your Paypal account.</div>
		</div>
    </div>
    <div class="col-md-4">
    	<div class="p-m-section">
			<div><img src="<?php echo base_url();?>assets/images/check_select.jpg"></div>
			<div>Cheque<input type="radio" name="payment_method" value="cheque"></div>
			<div><b>Cheque: </b>Get paid via standard bank cheque, delivered by mail within 7 days.</div>
		</div>
    </div>
	</div>
	<div class="row" style="margin-top:150px;">
	<div class="col-md-4">
    	<div class="p-m-section">
			<div><img src="<?php echo base_url();?>assets/images/interac_select.png"></div>
			<div>Interac Email<input type="radio" name="payment_method" value="interac_email"></div>
			<div><b>Interac: </b>With Interac transfer, your payment is deposited directly into your account using email.</div>
		</div>
    </div>
</div>
</div>   
<!--LEFT SECTION END-->

<div class="col-md-3">
	<div id="cart">
	<ul id="cart-list">
	<?php
	foreach($items as $item){
		$cart_product=$this->product_model->get_product_by_id($item['id']);
		
		$img_src='';
		//$details=$this->catalog_model->get_product_related_details($product->product_id);
		//$href=base_url($details->category_slug.'/'.$details->product_slug.'/'.$details->model_slug);
		if(file_exists(UPLOADS_PRODUCT_THUMB.$cart_product->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$cart_product->product_image;
		}
		?>
		<li class="cart-item" data-rowid="<?php echo $item['rowid']; ?>">
		<div class="cart-inn">
        <div class="cart-pic"><img src="<?php echo $img_src;?>"></div>
		<h4><?php echo $cart_product->model_name.'&nbsp;'.$cart_product->product_name;?></h4>
		<p><strong>Condition</strong>: <?php echo ucwords($item['options']['condition']);?></p>
		<p><strong>Price</strong>: $<?php echo $item['price'];?></p>
		<a href="javascript:void(0);" class="delete_cart_item" data-rowid="<?php echo $item['rowid']; ?>">Delete</a>
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

</div>
<div class="row payment_method_fields">
	<div class="col-md-9" id="apple_field" style="display:none;">
		Your Apple Gift Card code will be emailed to
	</div>
	<div class="col-md-9" id="paypal_field" style="display:none;">
		<p>Confirm your PayPal email address so we can ensure prompt payment.</p>
		<p>Enter the email address associated with your PayPal </p>
		account
		<div><input type="text"></div>
		Confirm your PayPal email address
		<div><input type="text"></div>
	</div>
	<div class="col-md-9" id="cheque_field" style="display:none;">
		<p>Please provide the address you'd like your check sent to.</p>
		Payable to
		<div><input type="text"></div>
		Address Line 1
		<div><input type="text"></div>
		Address Line 2 (optional)
		<div><input type="text"></div>
		City
		<div><input type="text"></div>
		Province
		<div><select><option>Select</option></select></div>
		Zip Code
		<div><input type="text"></div>
		Zip Code
		<div><input type="text"></div>
	</div>
	<div class="col-md-9" id="interac_field" style="display:none;">
		<p>Confirm your Interac Email address so we can ensure prompt payment.</p>
		<p>Enter the email address associated with your Interac  </p>
		account
		<div><input type="text"></div>
		Confirm your Interac email address
		<div><input type="text"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-9">
	<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>
	</div>
</div>