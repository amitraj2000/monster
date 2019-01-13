<div class="ajax-login-bg">
		<h2>SIGN UP WITH MONSTER</h2>
		<div class="ajax-register-msg"></div>
		<form action="<?php echo site_url('register');?>" method="post" class="ajax-register">
		   <div>
			  <div class="form-group">
				<label for="first_name">First Name:</label>
				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter Your First Name" value="<?php echo !empty($form_data['first_name'])?$form_data['first_name']:'';?>">
			  </div>
			</div>			
			<div>
				<div class="form-group">
					<label for="last_name">Last Name:</label>
					<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Your Last Name" value="<?php echo !empty($form_data['last_name'])?$form_data['last_name']:'';?>">
				</div>						  
			  
		   </div>
		   <?php $quick_email=$this->session->userdata('quick_email');?>
		  <div style="<?php echo !empty($quick_email)?'display:none;':'';?>">
			  <div class="form-group">
				<label for="email">Email Address:</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address" value="<?php echo !empty($quick_email)?$quick_email:'';?>">
			  </div>
		  </div>
		  <div>
			  <div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
			  </div>
		  </div>
		  <div>
			  <div class="form-group">
				<label for="confirm_password">Confirm Password:</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-Enter Your Password">
			  </div>						  
		  </div>
		  <div>
			<button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
			<div id="google_btn_7" class="btn btn-default ajx-google">Signup with google</div>
		  </div>
		</form>
		</div>
		
		<div class="ajax-login-back-bg"><a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a></div>
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
							dataType:'json',
							data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
							success: function(result){
								if(result.error==true){
									//alert(result.msg);
									//$('#abandondoned_email_login').modal('show');
									Swal({
									  title: 'Oops',
									  text: "The email you have given earlier does not match.Please try again.",
									  type: 'warning',
									  showCancelButton: true,
									  //confirmButtonColor: '#3085d6',
									  cancelButtonColor: '#d33',
									  confirmButtonText: 'Proceed',
									  cancelButtonText: 'No',
									  reverseButtons: true
									}).then((result) => {
									  if (result.value) {
										abandondoned_email_login_yes();
									  }
									});
								}else{
									monsterObj.is_logged_in=true;
									$('form#payment-carrier-form').submit();
								}
								 
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
					dataType:'json',
					data:{'first_name':profile.getGivenName(),'last_name':profile.getFamilyName(),'email':profile.getEmail()},
					success: function(result){
						if(result.error==true){
							//alert(result.msg);
							//$('#abandondoned_email_login').modal('show');
							Swal({
						  title: 'Oops',
						  text: "The email you have given earlier does not match.Please try again.",
						  type: 'warning',
						  showCancelButton: true,
						  //confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Proceed',
						  cancelButtonText: 'No',
						  reverseButtons: true
						}).then((result) => {
						  if (result.value) {
							abandondoned_email_login_yes();
						  }
						});
						}else{
							monsterObj.is_logged_in=true;
							$('form#payment-carrier-form').submit();
						}
					}
				});

			}
			startGoogleRegistrationAjax();
		</script>