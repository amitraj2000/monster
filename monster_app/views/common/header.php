<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Monster</title>
	<!--[if IE 7]> <html class="ie7"> <![endif]-->
	<!--[if IE 8]> <html class="ie8"> <![endif]-->
	<!--[if IE 9]> <html class="ie9"> <![endif]-->
	<link rel="shortcut icon" href="<?php echo base_url();?>/assets/images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/plugins.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/easy-responsive-tabs.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/responsive.css" />
	<!--Google login-->
	<script src="https://apis.google.com/js/api:client.js" type="text/javascript"></script>
	<!--Google login-->
	
	<script type="text/javascript">
		var monsterObj={'base_url':'<?php echo base_url();?>','is_logged_in':<?php $is_logged_in=is_logged_in();echo !empty($is_logged_in)?'true':'false';?>}
	</script>
</head>

<body>
<div class="bodyOverlay"></div>
	<div class="responsive_nav"></div>
	<a class="scrollup" href="javascript:void(0);"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
	<header class="siteheader">
		<div class="header_main">
			<div class="container">
				<a href="<?php echo site_url('/');?>" class="logo" title="Monster"><img src="<?php echo base_url();?>/assets/images/logo.png" alt=""></a>
				<span class="responsive_btn"><span></span></span>
				<div class="nav_wrapper">
					<nav class="nav_menu">
						<ul class="clearfix">
							<li><a href="index.html">how it work</a></li>
							<li><a href="index.html">solutions</a></li>
							<li><a href="index.html">blog</a></li>
							<li><a href="index.html">contact</a></li>
						</ul>
					</nav>
				</div>
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
									<li><a href="">Update Account</a></li>
									<li><a href="">Your Trades</a></li>
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
										<form action="<?php echo site_url('/login');?>" method="post">
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