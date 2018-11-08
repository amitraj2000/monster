<div>
		<form action="<?php echo site_url('/login');?>" method="post">
		  <div class="form-group">
			<label for="email">Email address:</label>
			<input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address" value="<?php echo !empty($form_data['email'])?$form_data['email']:'';?>">
		  </div>
		  <div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Your Password">
		  </div>
		  <div class="checkbox">
			<label><input type="checkbox"> Remember me</label>
		  </div>
		  <button type="submit" name="submit" value="login" class="btn btn-default">Submit</button>
		  <div id="google_btn_5" class="btn btn-default">Signin with google</div>
		</form>
		</div>
		<div>
		<a href="javascript:void(0);" class="btn btn-default add_to_cart_signup" >Signup With Monster</a>
		<div id="google_btn_6" class="btn btn-default">Signup with google</div>
		</div>
		<p>
		<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>
		</p>
		<script type="text/javascript">
			//Google login ajax
			var googleUser2 = {};
			  var startGoogleLoginAjax = function() {
				gapi.load('auth2', function(){
				  // Retrieve the singleton for the GoogleAuth library and set up the client.
				  auth2 = gapi.auth2.init({
					client_id: '238911531242-4rmmaae3i9lg4vbu2rdbqkr087v14gic.apps.googleusercontent.com',
					cookiepolicy: 'single_host_origin',
					// Request scopes in addition to 'profile' and 'email'
					//scope: 'additional_scope'
				  });
					 attachSignin(document.getElementById('google_btn_5')); 
					 attachSignin(document.getElementById('google_btn_6')); 
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
					}, function(error) {
					  //alert(JSON.stringify(error, undefined, 2));
					});
			  }
			function onSignIn(googleUser2) {
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
			startGoogleLoginAjax();
		</script>