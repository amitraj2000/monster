$(document).ready(function(){
	
	$(document).on('click','.delete_cart_item',function(){
	var rowid=$(this).attr('data-rowid');
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"product/delete_cart_item",
	  data: { 'rowid':rowid},
	  success:function(response){
		  $('#cart-list').find('li.cart-item[data-rowid="'+rowid+'"]').remove();		
		  if(response!='')
		  $('#cart').html(response);
		
	  }
	});
	return false;
	});
	$(document).on('click','input[name="payment_method"]',function(){
		var val = $("input[name='payment_method']:checked").val();
		$('.payment_method_fields .col-md-12').hide();
		if(val=='apple')
		{
			$('#apple_field').show();
			$('html, body').animate({
				scrollTop: $('#apple_field').offset().top
			}, 'slow');
		}
		else if(val=='paypal')
		{
			$('#paypal_field').show();
			$('html, body').animate({
				scrollTop: $('#paypal_field').offset().top
			}, 'slow');
		}
		else if(val=='cheque')
		{
			$('#cheque_field').show();
			$('html, body').animate({
				scrollTop: $('#cheque_field').offset().top
			}, 'slow');
		}
		else if(val=='interac_email')
		{
			$('#interac_field').show();
			$('html, body').animate({
				scrollTop: $('#interac_field').offset().top
			}, 'slow');
		}
	});
});