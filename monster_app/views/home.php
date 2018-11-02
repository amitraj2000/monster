
	<div class="banner">
		<div class="banner_img">
					<img src="<?php echo base_url();?>/assets/images/banner.jpg" alt="">
					<div class="container">
						<div class="slider_text">
							<span>Get Paid for Your Device</span>
							<p>See how much your device is worth</p>
							<a href="#" class="btn btn_b">get a free quote</a>
						</div>
					</div>
				</div>
		<!-- <div class="banner_slider owl-carousel owl-theme">
			<div class="item">
				<div class="banner_img">
					<img src="images/banner.jpg" alt="">
					<div class="container">
						<div class="slider_text">
							<span>Get Paid for Your Device</span>
							<p>See how much your device is worth</p>
							<a href="#" class="btn btn_b">get a free quote</a>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="banner_img">
					<img src="images/banner1.jpg" alt="">
					<div class="container">
						<div class="slider_text">
							<span>Get Paid for Your Device</span>
							<p>See how much your device is worth</p>
							<a href="#" class="btn btn_b">get a free quote</a>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="banner_img">
					<img src="images/banner.jpg" alt="">
					<div class="container">
						<div class="slider_text">
							<span>Get Paid for Your Device</span>
							<p>See how much your device is worth</p>
							<a href="#" class="btn btn_b">get a free quote</a>
						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="banner_img">
					<img src="images/banner1.jpg" alt="">
					<div class="container">
						<div class="slider_text">
							<span>Get Paid for Your Device</span>
							<p>See how much your device is worth</p>
							<a href="#" class="btn btn_b">get a free quote</a>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
	<main class="sitemain">
		<div class="main_contrainer">
			<div class="why_we">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="ww_sec">
								<div class="ww_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/ww1.png" alt="">
										</div>
									</div>
								</div>
								<div class="ww_cntnt">
									<h2 class="subheading">Maximum Trade-in Values</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="ww_sec">
								<div class="ww_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/ww2.png" alt="">
										</div>
									</div>
								</div>
								<div class="ww_cntnt">
									<h2 class="subheading">No Annoying InStore Credit </h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="ww_sec">
								<div class="ww_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/ww3.png" alt="">
										</div>
									</div>
								</div>
								<div class="ww_cntnt">
									<h2 class="subheading">Maximum Trade-in Values</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="way_to_recycle">
				<div class="container">
					<h1 class="heading">A Better Way To Sell/Recycle Your Used Mobile Device.</h1>
					<a href="#" class="btn btn_b">Let's Get Started</a>
				</div>
			</div>
			<div class="why_sell">
				<div class="container">
					<h2 class="heading">What are you selling?</h2>
					<div class="products">
						<?php if(!empty($categories)){?>
						<ul class="clearfix">
							<?php foreach($categories as $category){?>
							<?php 
							$img_src='';
							if(file_exists(UPLOADS_CATEGORY.$category->category_image)){								
								$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_CATEGORY).$category->category_image;
							}?>
							<li>
								<div class="product">
									<a href="javascript:void(0);" class="load-model" data-category_id="<?php echo $category->category_id;?>">
										<?php if(!empty($img_src)){ ?>
										<div class="pro_img">											
											<img src="<?php echo $img_src;?>" alt="">
										</div>
										<?php }?>
										<div class="pro_name">
											<span><?php echo $category->category_name;?></span>
										</div>
									</a>
								</div>
							</li>
							<?php } ?>
						</ul>
						<?php } ?>
					</div>
					
					<div id="display_model">
						
				    </div>
					<div id="display_provider">
						
				    </div>
					<div id="display_product">
						
				    </div>
				</div>
			</div>
			<div class="way_to_sale">
				<div class="container">
					<h2 class="heading">Selling your phone is finally simple.</h2>
					<p class="heading_tag">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue, eu varius ante scelerisque in.</p>
					<ul>
						<li>
							<div class="ws_sec clearfix">
								<div class="ws_img">
									<img src="<?php echo base_url();?>/assets/images/ws1.png" alt="">
								</div>
								<div class="ws_cntnt">
									<h2 class="subheading">Get a free quote</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue, eu varius ante scelerisque in. Etiam malesuada convallis magna a dapibus. Nam consequat dolor a elit sagittis, vel blandit ante sollicitudin.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="ws_sec clearfix">
								<div class="ws_img">
									<img src="<?php echo base_url();?>/assets/images/ws2.png" alt="">
								</div>
								<div class="ws_cntnt">
									<h2 class="subheading">We pay for shipping</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue, eu varius ante scelerisque in. Etiam malesuada convallis magna a dapibus. Nam consequat dolor a elit sagittis, vel blandit ante sollicitudin.</p>
								</div>
							</div>
						</li>
						<li>
							<div class="ws_sec clearfix">
								<div class="ws_img">
									<img src="<?php echo base_url();?>/assets/images/ws3.png" alt="">
								</div>
								<div class="ws_cntnt">
									<h2 class="subheading">Get instant payment</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue, eu varius ante scelerisque in. Etiam malesuada convallis magna a dapibus. Nam consequat dolor a elit sagittis, vel blandit ante sollicitudin.</p>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="why_we_best">
				<div class="container">
					<h2 class="heading">Why we are the best...</h2>
					<p class="heading_tag">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue, eu varius ante scelerisque in.</p>
					<div class="row">
						<div class="col-sm-4">
							<div class="wwb_sec">
								<div class="wwb_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/wwb1.png" alt="">
										</div>
									</div>
								</div>
								<div class="wwb_cntnt">
									<h2 class="subheading">Selling Your Phone is a Breeze</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wwb_sec">
								<div class="wwb_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/wwb2.png" alt="">
										</div>
									</div>
								</div>
								<div class="wwb_cntnt">
									<h2 class="subheading">Ditch Annoying In-Store Credits</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wwb_sec">
								<div class="wwb_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/wwb3.png" alt="">
										</div>
									</div>
								</div>
								<div class="wwb_cntnt">
									<h2 class="subheading">Fast Payment</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wwb_sec">
								<div class="wwb_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/wwb4.png" alt="">
										</div>
									</div>
								</div>
								<div class="wwb_cntnt">
									<h2 class="subheading">No Waiting Until It Sells</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wwb_sec">
								<div class="wwb_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/wwb5.png" alt="">
										</div>
									</div>
								</div>
								<div class="wwb_cntnt">
									<h2 class="subheading">Broken device are welcome too!</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="wwb_sec">
								<div class="wwb_img">
									<div class="table_box">
										<div class="table_box_cell">
											<img src="<?php echo base_url();?>/assets/images/wwb6.png" alt="">
										</div>
									</div>
								</div>
								<div class="wwb_cntnt">
									<h2 class="subheading">Satisfaction Guaranted</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue...</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="customer_review">
				<div class="container">
					<h2 class="heading">Customer reviews</h2>
					<p class="heading_tag">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis erat augue, eu varius ante scelerisque in.</p>
					<div class="row">
						<div class="col-sm-4">
							<div class="c_reviews">
								<div class="c_review_main">
									<p>“ Nullam quis lobortis nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus.”</p>
									<div class="review_star">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="rev_img">
										<img src="<?php echo base_url();?>/assets/images/rev1.png" alt="">
									</div>
								</div>
								<div class="client_detail">
									<span>Julia Wood</span>
									<div class="social">
										<a href="#" class="fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										<a href="#" class="twtr" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										<a href="#" class="insta" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="c_reviews">
								<div class="c_review_main">
									<p>“ Nullam quis lobortis nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus.”</p>
									<div class="review_star">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="rev_img">
										<img src="<?php echo base_url();?>/assets/images/rev2.png" alt="">
									</div>
								</div>
								<div class="client_detail">
									<span>Victoria Veldeg</span>
									<div class="social">
										<a href="#" class="fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										<a href="#" class="twtr" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										<a href="#" class="insta" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="c_reviews">
								<div class="c_review_main">
									<p>“ Nullam quis lobortis nisl. Interdum et malesuada fames ac ante ipsum primis in faucibus.”</p>
									<div class="review_star">
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
										<i class="fa fa-star" aria-hidden="true"></i>
									</div>
									<div class="rev_img">
										<img src="<?php echo base_url();?>/assets/images/rev3.png" alt="">
									</div>
								</div>
								<div class="client_detail">
									<span>Thomas Hobs</span>
									<div class="social">
										<a href="#" class="fb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										<a href="#" class="twtr" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										<a href="#" class="insta" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn_center">
						<a href="#" class="btn">view more reviews</a>
					</div>
				</div>
			</div>
		</div>
	</main>
	