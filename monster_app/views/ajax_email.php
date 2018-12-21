<main class="sitemain">
	<div class="main_contrainer">
		<div class="container">
			<div class="row">
            <div class="col-md-12">
            
            	<div class="ajax-login-bg">
                <h2>Enter Your Email Address</h2>
                <div>We will use this email to send you shipping details and progress updates</div>
				
                <div class="ajax-email-msg"></div>
                				
                <form action="" method="post" class="get-email">
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address" value="<?php echo !empty($form_data['email'])?$form_data['email']:'';?>">
                  </div>                 
                  <button type="submit" name="submit" value="login" class="btn btn-default">Continue</button>
                </form>
				</div>
                
            </div>   
			</div>
		</div>
	</div>
</main>