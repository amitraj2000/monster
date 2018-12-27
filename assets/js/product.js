jQuery(document).ready(function(){
	
	$('#horizontalTab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion           
    width: 'auto', //auto or any width like 600px
    fit: true,   // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    activate: function(event) { // Callback function if tab is switched
    var $tab = $(this);
    var $info = $('#tabInfo');
    var $name = $('span', $info);
    $name.text($tab.text());
    $info.show();
    }
	});
	$(document).on('click','.icloud-activation',function(){
	$(this).addClass('active');
	$(this).closest('.resp-tab-content').find('form').find('button').attr('disabled',false).removeClass('disabled');
});
$(document).on('click','.icloud-deactivation',function(){
	$(this).siblings('.icloud-activation').removeClass('active');
	$(this).closest('.resp-tab-content').find('form').find('button').attr('disabled',true).addClass('disabled');
});

$(document).on('submit','.add_to_cart',function(){
	var missing_provider_id=false;
	$('form.add_to_cart').each(function(){
		$(this).removeClass('active');
		if($(this).find('input[name="provider_id"]').val()=='' && $('.load-variation-price').length)
			missing_provider_id=true;
	});
	$(this).addClass('active');
	if(missing_provider_id==true)
		return false;
	
	if(monsterObj.is_logged_in==false){
		if($('#email_section').is(':visible'))
			$('#email_section').slideUp();
		else
			$('#email_section').slideDown();
	}else{
		var ajax_url=monsterObj.base_url+"product/ajax_load_cart";
		var next_section='cart_section';		
		
		$.ajax({
		  method: "POST",
		  url: ajax_url,
		  data: {'data':$( this ).serialize()},
		  success:function(response){
			 $('#'+next_section).find('.ajax_content').html(response);
			 $('#details_section').hide('slide', {direction: 'left'}, 1000);
			 setTimeout(function(){$('#'+next_section).show('slide', {direction: 'right'}, 500);
			 setTimeout(function(){$('html, body').animate({scrollTop:$("#"+next_section).offset().top-900},500);},500);},500);
			 $('#'+next_section).find('.ajax_content').find('.add_to_cart_back').attr('data-section','details_section');
		  }
		});
		
	}
	return false;	
});
$(document).on('change','.load-variation-price',function(){
	var product_id=$(this).attr('data-product_id');
	var provider_id=$(this).val();
	$('.resp-tab-content').find('form').find('input[name="provider_id"]').val(provider_id);
	if(provider_id==''){
		return false;
	}
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"product/ajax_load_variation_price",
	  data: {'product_id':product_id,provider_id:provider_id},
	  dataType:'json',
	  success:function(response){
		 $('span.price.flawless_price').html('$'+response.flawless_price);
		 $('span.price.good_price').html('$'+response.good_price);
		 $('span.price.broken_price').html('$'+response.broken_price);
		 $('.resp-tab-content').find('form').find('button').attr('disabled',false).removeClass('disabled');
	  }
	});
	return false;
});
$(document).on('click','.provider_next_add_to_cart',function(){
	var model_id=$(this).attr('data-model_id');
	var provider_id=$(this).attr('data-provider_id');
	var condition=$(this).attr('data-condition');
	
	var ajax_url=monsterObj.base_url+"product/ajax_load_after_login";
	var next_section='after_login_section';
	if($('#login_section').length && monsterObj.is_logged_in==false){
		var ajax_url=monsterObj.base_url+"product/ajax_load_login";
		var next_section='login_section';
	}
	
	$('form.add_to_cart.active').find('input[name="provider_id"]').val(provider_id);//update provider
	$.ajax({
	  method: "POST",
	  url: ajax_url,
	  data: {'data':$('form.add_to_cart.active').serialize()},
	  success:function(response){
		 $('#'+next_section).find('.ajax_content').html(response);
		 $('#provider_section').hide('slide', {direction: 'left'}, 1000);
		 setTimeout(function(){$('#'+next_section).show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#"+next_section).offset().top-900},500);},500);},500);
		 $('#'+next_section).find('.ajax_content').find('.add_to_cart_back').attr('data-section','provider_section');
	  }
	});
	
	
	return false;
});

$(document).on('click','.add_to_cart_signup',function(){
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"product/ajax_load_registration",
	  data: {/* 'data':$('form.add_to_cart.active').serialize() */},
	  success:function(response){
		 $('#registration_section').find('.ajax_content').html(response);
		 $('#login_section').hide('slide', {direction: 'left'}, 1000);
		 setTimeout(function(){$('#registration_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#registration_section").offset().top-900},500);},500);},500);
		 $('#registration_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','login_section');
		 
	  }
	});
	return false;
});

$(document).on('click','.add_to_cart_back',function(){
	var section=$(this).attr('data-section');
	var current_section=$(this).closest('.container');
	current_section.hide('slide', {direction: 'right'}, 1000);
	setTimeout(function(){$('#'+section).show('slide', {direction: 'left'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$('#'+section).offset().top-900},500);},500);},500);
	
});


$(document).on('submit','.ajax-login',function(){
	$('.ajax-login-msg').html('').hide();
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"login/ajax_login",
	  data: { 'data':$(this).serialize()},
	  dataType:'json',
	  success:function(response){
		 if(response.error==true)
		 {
			 $('.ajax-login-msg').html(response.msg).show();
		 }else{
			 monsterObj.is_logged_in=true;
			 $('form#payment-carrier-form').submit();
		 }
	  }
	});
	return false;
});
$(document).on('submit','.get-email',function(){
	$('.ajax-email-msg').html('').hide();
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"login/ajax_email",
	  data: { 'data':$(this).serialize()},
	  dataType:'json',
	  success:function(response){
		 if(response.error==true)
		 {
			 $('.ajax-email-msg').html(response.msg).show();
		 }else{			 
			 $.ajax({
			  method: "POST",
			  url: monsterObj.base_url+"product/ajax_load_cart",
			  data: {'data':$('form.add_to_cart.active').serialize()},
			  success:function(response){
				  $('#email_section').hide();
				 $('#cart_section').find('.ajax_content').html(response);
				 $('#details_section').hide('slide', {direction: 'left'}, 1000);
				 setTimeout(function(){$('#cart_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#cart_section").offset().top-900},500);},500);},500);
				 $('#cart_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','details_section');  
				 
			  }
			});
		 }
	  }
	});
	return false;
});
$(document).on('submit','.ajax-register',function(){
	$('.ajax-register-msg').html('').hide();
	$.ajax({
	  method: "POST",
	  url: monsterObj.base_url+"login/ajax_register",
	  data: { 'data':$(this).serialize()},
	  dataType:'json',
	  success:function(response){
		 if(response.error==true)
		 {
			 $('.ajax-register-msg').html(response.msg).show();
		 }else{
			 $.ajax({
			  method: "POST",
			  url: monsterObj.base_url+"product/ajax_load_after_login",
			  data: {'data':$('form.add_to_cart.active').serialize()},
			  success:function(response){
				 $('#after_login_section').find('.ajax_content').html(response);
				 $('#registration_section').hide('slide', {direction: 'left'}, 1000);
				 setTimeout(function(){$('#after_login_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#after_login_section").offset().top-900},500);},500);},500);
				 if($('#provider_section').length)
				 $('#after_login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','provider_section');
				 else
				 $('#after_login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','details_section');
				 monsterObj.is_logged_in=true;
			  }
			});
		 }
	  }
	});
	return false;
});

});