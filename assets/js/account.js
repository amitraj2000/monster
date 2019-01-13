$(document).ready(function(){
	$('#summary_tab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion           
    width: 'auto', //auto or any width like 600px
    fit: true,   // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    
	});
	$(document).on('submit','#edit_profile',function(){
		var email=$.trim($(this).find('input[name="email"]').val());
		var first_name=$.trim($(this).find('input[name="first_name"]').val());
		var last_name=$.trim($(this).find('input[name="last_name"]').val());
		//$('#edit_profile_msg').html('').hide();
		if(email=='')
		{
			//$('#edit_profile_msg').html('Please enter your email').show();
			Swal ( "Oops" ,  'Please enter your email' ,  "error" );
			return false;
		}
		if(first_name=='')
		{
			//$('#edit_profile_msg').html('Please enter your first name').show();
			Swal ( "Oops" ,  'Please enter your first name' ,  "error" );
			return false;
		}
		if(last_name=='')
		{
			//$('#edit_profile_msg').html('Please enter your last name').show();
			swal ( "Oops" ,  'Please enter your last name' ,  "error" );
			return false;
		}else{
			return true;
		}
	});
	$(document).on('submit','#change_password',function(){
		var password=$.trim($(this).find('input[name="password"]').val());
		var confirm_password=$.trim($(this).find('input[name="confirm_password"]').val());
		
		//$('#change_password_msg').html('').hide();
		if(password=='')
		{
			//$('#change_password_msg').html('Please enter your new password').show();
			Swal ( "Oops" ,  'Please enter your new password' ,  "error" );
			return false;
		}
		if(confirm_password=='')
		{
			//$('#change_password_msg').html('Please confirm new password').show();
			Swal ( "Oops" ,  'Please confirm new password' ,  "error" );
			return false;
		}
		if(confirm_password!=password)
		{
			//$('#change_password_msg').html('Password does not matches').show();
			Swal ( "Oops" ,  'Password does not matches' ,  "error" );
			return false;
		}
		else{
			return true;
		}
	});
	
	//Ajax pagination for open and completed order
	$(document).on('click','#open_pagination a,#completed_pagination a',function(){
		$.ajax({
	   type: "POST",
	   url: $(this).attr("href"),
	   dataType:'json',
	   success: function(res){
		  $('#'+res.container_id).html(res.content);
		  $('#'+res.pagination_id).html(res.pagination);
	   }
	   });
	   
	   return false;
	});
	
	$('#add_address').magnificPopup({
	  items: {
		  src: '#address_popup',
		  type: 'inline'
	  }
	});
	
});