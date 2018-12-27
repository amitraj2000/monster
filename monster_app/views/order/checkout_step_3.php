<div class="container">
<div class="row">
<div class="col-md-12">

<form action="<?php echo base_url('/payment-carrier');?>" method="post" id="payment-carrier-form">
<div class="row">
<div class="col-md-6" >
<div class="p-m-section">
<div style="padding:30px 0;"><img src="<?php echo base_url();?>assets/images/C-post.png"></div>
<input type="radio" name="shipping_type" value="express" checked="true"> Prepaid Canada Post Shipping Label <br /> e`ll send a prepaid label to your email address. Affix it to your own box.
</div>
</div>

<div class="col-md-6" >
<div class="p-m-section">
<div style="padding:30px 0;"><img src="<?php echo base_url();?>assets/images/C-post.png"></div>
<input type="radio" name="shipping_type" value="shipping_kit"> A shipping kit <br />We`ll send a prepaid Canada post label and a box right to your door.
</div>
</div>

</div>

<div class="row">

<div class="col-md-6">
<div class="click-pay-form-back-bg">
<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>
</div>
</div>

<div class="col-md-6" style="text-align:right;">
<input type="submit" value="Submit" name="submit_step_3">
</div>


</div>
<?php 
$cart_data=$this->session->userdata('cart_data');
$shipping_data=$this->session->userdata('shipping_data');
if(!empty($cart_data))
{
	foreach($cart_data as $key=>$cart)
	{
		?>
		<input type="hidden" name="<?php echo $key;?>" value="<?php echo $cart;?>">
		<?php 
	}
}
if(!empty($shipping_data))
{
	foreach($shipping_data as $key=>$shipping)
	{
		?>
		<input type="hidden" name="shipping_<?php echo $key;?>" value="<?php echo $shipping;?>">
		<?php 
	}
}
?>
<input type="hidden" name="final_submit" value="true">
</form>
<!--LEFT SECTION END-->

</div>
</div>
</div>