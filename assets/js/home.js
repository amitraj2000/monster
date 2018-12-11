jQuery(document).ready(function(){
	$(document).on('click','.scroll-product',function(){
		$('html, body').animate({
          scrollTop: $('#scroll-product-con').offset().top
        }, 3000);
		return false;
	});
	$(document).on('click','a.load-model',function(){
	var category_id=$(this).attr('data-category_id');
	$('#display_provider,#display_product').html('');
	//reset form
	$('#product_selection_form').find('#model_id').val('');
	$('#product_selection_form').find('#provider_id').val('');
	$('#product_selection_form').find('#product_id').val('');
	//reset form
	
	$('#product_selection_form').find('#category_id').val(category_id);
	$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"home/load_models_by_category",
		  data: { category_id: category_id},
		  success:function(response){
			  if(response!=''){
				  $('#display_model').html(response);				  
				  $('html, body').animate({
						scrollTop: $("#display_model").offset().top
					}, 2000);
			  }
		  }
		});
});

$(document).on('click','a.load-provider',function(){
	var model_id=$(this).attr('data-model_id');
	$('#display_product').html('');
	//reset form
	$('#product_selection_form').find('#provider_id').val('');
	$('#product_selection_form').find('#product_id').val('');
	//reset form
	$('#product_selection_form').find('#model_id').val(model_id);
	$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"home/load_providers_by_model",
		  data: { model_id: model_id},
		  success:function(response){
			  if(response!=''){
				  $('#display_provider').html(response);
				  $('html, body').animate({
						scrollTop: $("#display_provider").offset().top
					}, 2000);
			  }
		  }
		});
});

$(document).on('click','a.load-product',function(){
	var model_id=$(this).attr('data-model_id');
	var provider_id=$(this).attr('data-provider_id');
	//reset form
	$('#product_selection_form').find('#product_id').val('');
	//reset form	
	$('#product_selection_form').find('#provider_id').val(provider_id);
	$.ajax({
		  method: "POST",
		  url: monsterObj.base_url+"home/load_products_by_model_provider",
		  data: { model_id: model_id,provider_id:provider_id},
		  success:function(response){
			  if(response!=''){
				  $('#display_product').html(response);
				  $('html, body').animate({
						scrollTop: $("#display_product").offset().top
					}, 2000);
			  }
		  }
		});
});

$(document).on('click','a.load-product-details',function(){
	var href=$(this).attr('data-href');
	var product_id=$(this).attr('data-product_id');
	$('#product_selection_form').find('#product_id').val(product_id);
	$('#product_selection_form').attr('action',href);
	$('#product_selection_form').submit();
});
});