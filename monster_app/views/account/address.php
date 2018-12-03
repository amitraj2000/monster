<div class="row">
	<div class="col-md-3">
		<ul>
			<li><a href="<?php echo base_url('account-summary/summary/');?>">Your Trades</a></li>
			<li><a href="<?php echo base_url('account-summary/edit/');?>">Password & Email</a></li>
			<li class="active"><a href="<?php echo base_url('account-summary/address/');?>">Stored Address</a></li>
		</ul>
	</div>
	<div class="col-md-9">
		Welcome Back <?php echo !empty($user)?$user->first_name.'&nbsp;'.$user->last_name:'';?>
		<div><input type="button" id="add_address" value="Add a new address"></div>
	</div>
</div>


<div id="address_popup" class="white-popup mfp-hide">
  <form id="address_form_new" method="post" action="">

	<div class="row" style="padding-top:0px; width:100%; max-width:767px;">

	<div class="col-xs-12">
	<div class="col-xs-12">
	<h2 style="color:#555; margin-top:0px;">Add Address</h2>

	<p>Add a new address below</p>
		</div>
		<div class="stp_row">

			<div class=" col-sm-8">

				<label for="add_title_new" >Name This Address (e.g. Home, Work, Beach House)</label>

				<input name="add_title_new" id="add_title_new" class="name_input" type="text" >

			</div>

		</div>

		<div class="stp_row">

			<div class=" col-sm-12">

				<input name="primary_add_new" id="primary_add_new" class="name_input margin_zero" value="1" type="checkbox" style="width:15px; float:left; height:15px;">

				<label for="primary_add_new" style="width:auto; margin-left:10px;" >Primary Address?</label>

	

			</div>

		</div>

		<div class="stp_row">

			<div class="col-sm-6">

				<label for="address_line_1_new">Address Line 1: </label>

				<input type="text" id="address_line_1_new" name="address_line_1_new" class="city_input" required style="height:40px" />

				

			</div>

			

			<div class="col-sm-6">

				<label for="address_line_2_new">Address Line 2: </label>

				<input type="text" id="address_line_2_new" name="address_line_2_new" class="city_input" style="height:40px" />

			</div>

		</div>

		<div class="stp_row">

			<div class="col-sm-4">

			<label for="city_new" >City</label>

			<input name="city_new" id="city_new" class="city_input" required type="text" >

		   

			</div>

			

			<div class="col-sm-4">

			<label for="state_new">Province</label>

			<select name="state_new" id="state_new" class="city_input">

				<option value="">-Select Province-</option>

				<option value="AB">Alberta</option>

				<option value="BC">British Columbia</option>

				<option value="MB">Manitoba</option>

				<option value="NB">New Brunswick</option>

				<option value="NF">New Foundland</option>

				<option value="NT">Northwest Territories</option>

				<option value="NS">Nova Scotia</option>

				<option value="ON">Ontario</option>

				<option value="PE">Prince Edward Island</option>

				<option value="PQ">Quebec</option>

				<option value="SK">Saskatchewan</option>

				<option value="YT">Yukon Territories</option>

			</select>

		   

			</div>

			

			<div class="col-sm-4">

			<label for="zip_code_new">Zip Code</label>

			 <input name="zip_code_new" id="zip_code_new" required class="city_input" type="text" >

			 <p id="zip_error" style="color: #a00; display:none;">Minimum 5 digits!</p>

			</div>

		</div>

		<div class="stp_row">

			<div class="col-xs-12">

				<label for="phone_new">Phone{optional}</label>

				<p style="font-size:14px; font-style:italic;">We'll only call you if there is an issue with your sale.</p>

				<input name="phone_new" id="phone_new" class="name_input margin_zero" type="text" style="width:200px;" >

			</div>

			

			<div class="col-xs-12">

				<label>Country</label>

				Canada

				<p style="font-size:14px; font-style:italic;">We currently only support trades within Canada.</p>

			</div>

		</div>     

		<div class="stp_row">

			<div class="col-xs-12">

				<input type="submit" class="btn btn-primary" name="address_submit_new" id="address_submit_new" value="Continue" />

			</div>

		</div>    

	</div>

	</div>

  </form>
</div>