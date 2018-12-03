<div class="row">
	<div class="col-md-4">
		<ul>
			<li><a href="<?php echo base_url('account-summary/summary/');?>">Your Trades</a></li>
			<li class="active"><a href="<?php echo base_url('account-summary/edit/');?>">Password & Email</a></li>
			<li><a href="<?php echo base_url('account-summary/address/');?>">Stored Address</a></li>
		</ul>
	</div>
	<div class="col-md-8">
		<?php 
		if(!empty($success_msg)){
			echo '<div class="success">'.$success_msg.'</div>';
		}
		if(!empty($error_msg)){
			echo '<div class="error">'.$error_msg.'</div>';
		}
		?>
		<div id="edit_profile_msg" style="display:none;"></div>
		<form id="edit_profile" method="post">
			<div><input type="email" name="email" placeholder="Email" value="<?php echo $email;?>"></div>
			<div><input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name;?>"></div>
			<div><input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name;?>"></div>
			<div><input type="submit" value="Update" name="profile_submit"></div>
		</form>
		<div id="change_password_msg" style="display:none;"></div>
		<form id="change_password" method="post">
			<div><input type="password" name="password" placeholder="New Password" value=""></div>
			<div><input type="password" name="confirm_password" placeholder="Retype New Password" value=""></div>
			<div><input type="submit" value="Update" name="password_submit"></div>
		</form>
		
	</div>
</div>