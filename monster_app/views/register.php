<main class="sitemain">
	<div class="main_contrainer">
		<div class="container">
			<div class="row">	
					<?php if(!empty($error_msg))echo $error_msg;?>
					<form action="<?php echo site_url('register');?>" method="post">
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
						<div id="google_btn_1" class="btn btn-default">Signup with google<div>
					  </div>
					</form>
				
			</div>
		</div>
	</div>
</main>
