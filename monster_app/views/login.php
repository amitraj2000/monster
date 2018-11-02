<main class="sitemain">
	<div class="main_contrainer">
		<div class="container">
			<div class="row">
			<?php if(!empty($error_msg)){?>
			<div><?php echo $error_msg;?></div>
			<?php } ?>
				<div class="col-sm-6">
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
					  <div id="google_btn_2" class="btn btn-default">Signin with google<div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>