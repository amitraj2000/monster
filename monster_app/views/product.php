<div class="banner inner-banner">
	<div class="banner_img">
		<img src="<?php echo base_url('assets/')?>images/details-banner.jpg" alt="">
		<div class="container">
			<div class="slider_text">
				<span>Choose the device condition</span>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
			</div>
		</div>
	</div> 
</div>
<main class="sitemain inner_main">
	<div class="main_contrainer">
		<div class="details_holder">
			<div class="row">
				<div class="container">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="details_left">
								<?php if(!empty($product->product_image) && file_exists(UPLOADS_PRODUCT.$product->product_image)){
									$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT).$product->product_image;
									?>
								<img src="<?php echo $img_src;?>" alt="<?php echo $product->product_name;?>"/>
								<?php } ?>
								<span class="img-feature">(<?php echo $product->model_name.'&nbsp;'.$product->product_name;?>)</span>
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="details_right">
							<h3><?php echo $product->model_name.'&nbsp;'.$product->product_name;?> </h3>
							<div id="horizontalTab" class="tab_sec">
								<ul class="resp-tabs-list">
									<li>Flawless</li>
									<li>Good                              </li>
									<li>Broken</li>
								</ul>
								<div class="resp-tabs-container">
									<div>
										<span class="price">$59</span>
										<span class="ship">Ship us your device by <span>11/1/2018</span></span>
										<a class="next" href="#">next</a>
										<div class="detils_list">
											<h3>Choose flawless if all of these are true:</h3>
											<ul>
												<li>The Phone Appears To Be In Near Brand New Condition</li>
												<li>All Functions Are Working Perfectly</li>
												<li>No Scratches On The Device</li>
												<li>The Device is Not iCloud Locked or blacklisted and Everything Works</li>
											</ul>
										</div>
										<div class="note"><p><strong>Note:</strong> Choose Good If there is visible signs of use</p></div>
									</div>
									<div>
										<p>This tab has icon in consectetur adipiscing eliconse consectetur adipiscing elit. Vestibulum nibh urna, ctetur adipiscing elit. Vestibulum nibh urna, t.consectetur adipiscing elit. Vestibulum nibh urna,  Vestibulum nibh urna,it.</p>
									</div>
									<div>
										<p>Suspendisse blandit velit Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis Integer laoreet placerat suscipit. Sed sodales scelerisque commodo. Nam porta cursus lectus. Proin nunc erat, gravida a facilisis quis, ornare id lectus. Proin consectetur nibh quis urna gravid urna gravid eget erat suscipit in malesuada odio venenatis.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</main>