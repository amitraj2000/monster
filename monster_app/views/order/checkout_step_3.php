<div class="row">
	<div class="col-md-12">
		<form action="<?php echo base_url('/payment-carrier');?>" method="post">
		<div class="row">		
			<div class="col-md-6" >
				
			<input type="radio" name="shipping_type" value="express" checked="true">Prepaid Canada Post Shipping Label
We`ll send a prepaid label to your email address. Affix it to your own box.
			</div>
			<div class="col-md-6" >
			<input type="radio" name="shipping_type" value="shipping_kit">A shipping kit
We`ll send a prepaid Canada post label and a box right to your door.
			</div>
			
		</div>
		<input type="submit" value="Submit" name="submit_step_3">
		</form>
		<div class="ajax-login-back-bg"><a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a></div>
	</div> 
</div>
<!--LEFT SECTION END-->