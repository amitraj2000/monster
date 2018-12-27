		<div class="ajax-login-bg">
            <h2>SIGN IN WITH MONSTER</h2>
            <div class="ajax-login-msg"></div>
            <form action="<?php echo site_url('/login');?>" method="post" class="ajax-login">
			<?php $quick_email=$this->session->userdata('quick_email');?>
			 <div class="form-group" style="<?php echo !empty($quick_email)?'display:none;':'';?>">
                <label for="email">Email address:</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address" value="<?php echo !empty($quick_email)?$quick_email:'';?>">
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Your Password">
              </div>
              <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
              </div>
              <button type="submit" name="submit" value="login" class="btn btn-default">Submit</button>
              <div class="orr"><span>SIGN IN</span></div>
              <div id="google_btn_5" class="btn btn-default ajx-google">Signin with google</div>
            </form>
            
            <div class="orr"><span>SIGN UP</span></div>
            
            <div class="ajax-login-button-bg">
            <a href="javascript:void(0);" class="btn btn-default add_to_cart_signup" >Signup With Monster</a>
            <div id="google_btn_6" class="btn btn-default ajx-google">Signup with google</div>
            </div>
            
		</div>
        
		
		<div class="ajax-login-back-bg"><a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a></div>
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
									 setTimeout(function(){$('#after_login_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#after_login_section").offset().top-900},500);},500);},500);
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
									 setTimeout(function(){$('#after_login_section').show('slide', {direction: 'right'}, 500);setTimeout(function(){$('html, body').animate({scrollTop:$("#after_login_section").offset().top-900},500);},500);},500);
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