<div class="my-acount-bg">
<div class="container">
<div class="row">

	<div class="col-md-12"> 
    <div class="acount-link-bg">
    	<ul class="nav nav-pills nav-justified">
          <li role="presentation"><a href="<?php echo base_url('account-summary/summary/');?>">Your Trades</a></li>
          <li role="presentation" class="active"><a href="<?php echo base_url('account-summary/edit/');?>">Password & Email</a></li>
          <!--<li role="presentation"><a href="<?php echo base_url('account-summary/address/');?>">Stored Address</a></li>  -->
        </ul>
   	</div>        		
	</div>
    
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">
    <div class="ajax-login-bg">
            <h2>EDIT ACCOUTNT DETAILS</h2>
		<?php 
		if(!empty($success_msg)){
			echo '<div class="success">'.$success_msg.'</div>';
		}
		if(!empty($error_msg)){
			echo '<div class="error">'.$error_msg.'</div>';
		}
		?>
         <div class="orr"><span>Email & Name</span></div>
		<div id="edit_profile_msg" style="display:none;"></div>
		<form id="edit_profile" method="post">
			<div class="form-group"><input type="email" name="email" placeholder="Email" value="<?php echo $email;?>"></div>
			<div class="form-group"><input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name;?>"></div>
			<div class="form-group"><input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name;?>"></div>
			<div class="form-group"><input type="submit" value="Update" name="profile_submit"></div>
		</form>
        
         <div class="orr"><span>Password</span></div>
        
		<div id="change_password_msg" style="display:none;"></div>
		<form id="change_password" method="post">
			<div class="form-group"><input type="password" name="password" placeholder="New Password" value=""></div>
			<div class="form-group"><input type="password" name="confirm_password" placeholder="Retype New Password" value=""></div>
			<div class="form-group"><input type="submit" value="Update" name="password_submit"></div>
		</form>
	</div>	
	</div>
</div>
</div>
</div>