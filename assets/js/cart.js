$(document).ready(function(){
	
	$(document).on('click','.delete_cart_item',function(){
	var rowid=$(this).attr('data-rowid');
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"product/delete_cart_item",
	  data: { 'rowid':rowid},
	  success:function(response){
		  $('.cart').each(function(){
			 $(this).find('.cart-list').find('li.cart-item[data-rowid="'+rowid+'"]').remove();		
			  if(response!='')
			  $(this).html(response);
		  });
		  
		
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
	$(document).on('submit','.checkout_step_1',function(){
		
		var payment_method=$(this).find('input[name="payment_method"]:checked').val();
		if(payment_method=='paypal')
		{
			$('#paypal_email_error').html('').hide();
			$.ajax({
			 method: "POST",
			 dataType:'json',
			 url: monsterObj.base_url+"order/checkout_step_1",
			 data: { 'payment_type':'paypal','paypal_email':$('#paypal_email').val(),'confirm_paypal_email':$('#confirm_paypal_email').val()},
			 success:function(response){
				  if(response.error==true){
					  $('#paypal_email_error').html(response.msg).show();
				  }
				  else{
					 $('#checkout_step_2').find('.ajax_content').html(response.content);
					 $('#cart_section').hide('slide', {direction: 'left'}, 1000);					 
					 setTimeout(function(){$('#checkout_step_2').show('slide', {direction: 'right'}, 500);
					 setTimeout(function(){$('html, body').animate({scrollTop:$("#checkout_step_2").offset().top-900},500);},500);},500);
					 $('#checkout_step_2').find('.ajax_content').find('.add_to_cart_back').attr('data-section','cart_section');
					 
				  }
				
			   }
			 });
		}
		if(payment_method=='cheque')
		{
			$('#cheque_error').html('').hide();
			$.ajax({
			 method: "POST",
			 dataType:'json',
			 url: monsterObj.base_url+"order/checkout_step_1",
			 data: { 'payment_type':'cheque','payable_to':$('#payable_to').val(),'address_1':$('#address_1').val(),'address_2':$('#address_2').val(),'city':$('#city').val(),'province':$('#province').val(),'zip_code':$('#zip_code').val()},
			 success:function(response){
				  if(response.error==true){
					  $('#cheque_error').html(response.msg).show();
				  }
				  else{
					 $('#checkout_step_2').find('.ajax_content').html(response.content);
					 $('#cart_section').hide('slide', {direction: 'left'}, 1000);					 
					 setTimeout(function(){$('#checkout_step_2').show('slide', {direction: 'right'}, 500);
					 setTimeout(function(){$('html, body').animate({scrollTop:$("#checkout_step_2").offset().top-900},500);},500);},500);
					 $('#checkout_step_2').find('.ajax_content').find('.add_to_cart_back').attr('data-section','cart_section');
					 
				  }
				  
				
			   }
			 });
		}
		return false;
	});
	
	$(document).on('submit','.checkout_step_2',function(){
		$('#step_2_error').html('').hide();
		var first_name=$(this).find('input[name="first_name"]').val();
		var last_name=$(this).find('input[name="last_name"]').val();
		var address_1=$(this).find('input[name="address_1"]').val();
		var address_2=$(this).find('input[name="address_2"]').val();
		var city=$(this).find('input[name="city"]').val();
		var province=$(this).find('select[name="province"]').val();
		var zip_code=$(this).find('input[name="zip_code"]').val();
		var phone_number=$(this).find('input[name="phone_number"]').val();
		$.ajax({
			 method: "POST",
			 dataType:'json',
			 url: monsterObj.base_url+"order/checkout_step_2",
			 data: { 'first_name':first_name,'last_name':last_name,'address_1':address_1,'address_2':address_2,'city':city,'province':province,'zip_code':zip_code,'phone_number':phone_number},
			 success:function(response){
				  if(response.error==true){
					  $('#step_2_error').html(response.msg).show();
				  }
				  else{
					 $('#checkout_step_3').find('.ajax_content').html(response.content);
					 $('#checkout_step_2').hide('slide', {direction: 'left'}, 1000);
					 setTimeout(function(){$('#checkout_step_3').show('slide', {direction: 'right'}, 500);
					 setTimeout(function(){$('html, body').animate({scrollTop:$("#checkout_step_3").offset().top-900},500);},500);},500);
					 $('#checkout_step_3').find('.ajax_content').find('.add_to_cart_back').attr('data-section','checkout_step_2');
				  }
				
			   }
			 });
		return false;
	});
	$(document).on('submit','#payment-carrier-form',function(){
		if(monsterObj.is_logged_in==true){
			return true
		}else{
			$.ajax({
			 method: "POST",
			 //dataType:'json',
			 url: monsterObj.base_url+"product/ajax_load_login",
			 //data: {},
			 success:function(response){				  
					 $('#login_section').find('.ajax_content').html(response);
					 $('#checkout_step_3').hide('slide', {direction: 'left'}, 1000);
					 setTimeout(function(){$('#login_section').show('slide', {direction: 'right'}, 500);
					 setTimeout(function(){$('html, body').animate({scrollTop:$("#login_section").offset().top-900},500);},500);},500);
					 $('#login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','checkout_step_3');
				 				
			   }
			 });
			return false;
		}
	})
	$(document).on('click','.add_to_cart_back',function(){
		var section=$(this).attr('data-section');
		var current_section=$(this).closest('.container');
		current_section.hide('slide', {direction: 'right'}, 1000);
		setTimeout(function(){$('#'+section).show('slide', {direction: 'left'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$('#'+section).offset().top-900},500);},500);},500);
		
	});
});