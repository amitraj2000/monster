<div>
		<div class="ajax-register-msg"></div>
		<form action="<?php echo site_url('register');?>" method="post" class="ajax-register">
		   <div class="col-sm-6">
			  <div class="form-group">
				<label for="first_name">First Name:</label>
				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter Your First Name" value="<?php echo !empty($form_data['first_name'])?$form_data['first_name']:'';?>">
			  </div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="last_name">Last Name:</label>
					<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Your Last Name" value="<?php echo !empty($form_data['last_name'])?$form_data['last_name']:'';?>">
				</div>						  
			  
		   </div>
		  <div class="col-sm-6">
			  <div class="form-group">
				<label for="email">Email Address:</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address" value="<?php echo !empty($form_data['email'])?$form_data['email']:'';?>">
			  </div>
		  </div>
		  <div class="col-sm-6">
			  <div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
			  </div>
		  </div>
		  <div class="col-sm-6">
			  <div class="form-group">
				<label for="confirm_password">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-Enter Your Password">
			  </div>						  
		  </div>
		  <div class="col-sm-12">
			<button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
			<div id="google_btn_7" class="btn btn-default">Signup with google</div>
		  </div>
		</form>
		</div>
		
		<p>
		<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>
		</p>
		<script type="text/javascript">
			//Google login ajax
			var googleUser3 = {};
			  var startGoogleRegistrationAjax = function() {
				gapi.load('auth2', function(){
				  // Retrieve the singleton for the GoogleAuth library and set up the client.
				  auth2 = gapi.auth2.init({
					client_id: '238911531242-4rmmaae3i9lg4vbu2rdbqkr087v14gic.apps.googleusercontent.com',
					cookiepolicy: 'single_host_origin',
					// Request scopes in addition to 'profile' and 'email'
					//scope: 'additional_scope'
				  });
					 attachSignin(document.getElementById('google_btn_7')); 
					 //attachSignin(document.getElementById('google_btn_8')); 
				});
			  };

			  function attachSignin(element) {
			   console.log(element.id);
				auth2.attachClickHandler(element, {},
					function(googleUser) {
					 // document.getElementById('name').innerText = "Signed in: " +
						  var profile = googleUser.getBasicProfile();

						$.ajax({
							url: monsterObj.base_url+"login/google_user_authentication", 
							method:'POST',
							data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
							success: function(result){
								//send active form data also after login
								$.ajax({
								  method: "POST",
								  url: monsterObj.base_url+"product/ajax_load_after_login",
								  data: {'data':$('form.add_to_cart.active').serialize()},
								  success:function(response){
									 $('#after_login_section').find('.ajax_content').html(response);
									 $('#registration_section').hide('slide', {direction: 'left'}, 1000);
									 setTimeout(function(){$('#after_login_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#after_login_section").offset().top-90},500);},500);},500);
									 if($('#provider_section').length)
									 $('#after_login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','provider_section');
									 else
									 $('#after_login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','details_section');
									 monsterObj.is_logged_in=true;
								  }
								});
								 
							}
						});
					}, function(error) {
					  //alert(JSON.stringify(error, undefined, 2));
					});
			  }
			function onSignIn(googleUser3) {
			  $.ajax({
					url: monsterObj.base_url+"login/google_user_authentication", 
					method:'POST',
					data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
					success: function(result){
						//send active form data also after login
						$.ajax({
								  method: "POST",
								  url: monsterObj.base_url+"product/ajax_load_after_login",
								  data: {'data':$('form.add_to_cart.active').serialize()},
								  success:function(response){
									 $('#after_login_section').find('.ajax_content').html(response);
									 $('#login_section').hide('slide', {direction: 'left'}, 1000);
									 setTimeout(function(){$('#after_login_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#after_login_section").offset().top-90},500);},500);},500);
									 if($('#provider_section').length)
									 $('#after_login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','provider_section');
									 else
									 $('#after_login_section').find('.ajax_content').find('.add_to_cart_back').attr('data-section','details_section');
									 monsterObj.is_logged_in=true;
								  }
								});
					}
				});

			}
			startGoogleRegistrationAjax();
		</script>