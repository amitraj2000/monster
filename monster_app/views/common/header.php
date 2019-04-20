<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo !empty($header_title)?$header_title:'Monster';?></title>
	<!--[if IE 7]> <html class="ie7"> <![endif]-->
	<!--[if IE 8]> <html class="ie8"> <![endif]-->
	<!--[if IE 9]> <html class="ie9"> <![endif]-->
	<link rel="shortcut icon" href="<?php echo base_url();?>/assets/images/favicon.ico" type="image/x-icon">
	<?php echo put_headers();?>	
	<!--Google login-->
	<script src="https://apis.google.com/js/api:client.js" type="text/javascript"></script>
	<!--Google login-->
	
	<script type="text/javascript">
		var monsterObj={'base_url':'<?php echo base_url();?>','is_logged_in':<?php $is_logged_in=is_logged_in();echo !empty($is_logged_in)?'true':'false';?>,'quick_email':<?php $has_quick_email=$this->session->userdata('quick_email');echo !empty($has_quick_email)?'true':'false';?>}
	</script>
</head>
<?php 
$query = $this->db->query("SELECT * FROM ".SETTINGS_MASTER." WHERE settings_name='header_settings'");
$header_settings_str=$query->row();
$header_settings=unserialize($header_settings_str->settings);
?>
<body>
<div class="bodyOverlay"></div>
	<div class="responsive_nav"></div>
	<a class="scrollup" href="javascript:void(0);"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	<header class="siteheader">
		<div class="header_main">
			<div class="container">
				<a href="<?php echo site_url('/');?>" class="logo" title="Monster">
				<?php if(!empty($header_settings['logo'])){
					$logo_url=site_url('/').'/uploads/settings/'.$header_settings['logo'];//str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_SETTINGS).$header_settings['logo'];
					?>
					<img src="<?php echo $logo_url;?>" alt="">
					<?php
				}else{?>
				<img src="<?php echo base_url();?>/assets/images/logo.png" alt="">
				<?php } ?>
				</a>
				<span class="responsive_btn"><span></span></span>
				<?php if(!empty($header_settings['menu'])){?>
				<div class="nav_wrapper">
					<nav class="nav_menu">
						<ul class="clearfix">
							<?php
							foreach($header_settings['menu'] as $menu)
							{
								$menu_url=$menu_title='';
								if($menu->id=='home'){
									$menu_url=base_url();
									$menu_title='Home';
								}
								else if($menu->id=='blog'){
									$menu_url=base_url('/blog');
									$menu_title='Blog';
								}
								else{
									$menu_url=base_url('/'.$menu->id);
									$page=$this->pages_model->get_page_by_slug($menu->id);
									$menu_title=$page->name;
								}
								?>
								<li><a href="<?php echo $menu_url;?>"><?php echo $menu_title; ?></a></li>
								<?php
							}
							
							?>
							
						</ul>
					</nav>
				</div>
				<?php } ?>
				<div class="login_sec">
					<ul class="clearfix ">
						<?php if(!is_logged_in()){?>
						<li>
							<a href="#" data-toggle="dropdown"  aria-expanded="false" id="login-dropdown" class="btn">login</a>
							  <div class="dropdown-menu" role="menu" aria-labelledby="login-dropdown">
								<div class="row">								
									<div class="col-sm-12">
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
										  <button type="submit" name="submit" value="login" class="btn btn-default">Sign In</button>
										  <div id="google_btn_3" class="btn btn-default">Signin with google</div>
										 <div> OR</div>
											<a href="<?php echo site_url('register');?>" class="btn btn-default">New User</a>
											<div id="google_btn_4" class="btn btn-default">Signup with google<div>
										</form>
										
									</div>
									
								</div>
							  </div>
						</li>
						<?php } else{?>
						<li>
							<a href="#" class="btn" data-toggle="dropdown"  aria-expanded="true" id="account-dropdown">my account</a>
							<div class="dropdown-menu" role="menu" aria-labelledby="account-dropdown">
								<ul>
									<li><a href="<?php echo base_url('account-summary/edit/');?>">Update Account</a></li>
									<li><a href="<?php echo base_url('account-summary/summary/');?>">Your Trades</a></li>
									<li><a href="<?php echo site_url('/logout');?>">Logout</a></li>
								</ul>
							</div>
						</li>
						<?php } ?>
						<li>
							<a href="#" class="btn" data-toggle="dropdown"  aria-expanded="true" id="track-dropdown">track your trade in</a>
							<div class="dropdown-menu" role="menu" aria-labelledby="track-dropdown">
								<div class="row">								
									<div class="col-sm-12">
										<form action="<?php echo site_url('/track-order');?>" method="post">
										  <div class="form-group">
											<label for="email">Email address:</label>
											<input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address" value="<?php echo !empty($form_data['email'])?$form_data['email']:'';?>">
										  </div>										  
										  <button type="submit" name="submit" value="login" class="btn btn-default">Submit</button>
										</form>
									</div>
								</div>
							</div>
						</li>
					</ul>
					
					
					

				</div>
				
			</div>
		</div>
	</header>