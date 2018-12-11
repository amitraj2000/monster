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
				<div class="container" id="details_section">
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
							<?php if(!empty($need_provider) && empty($provider_id)){?>
								<div>
								<select class="load-variation-price" data-product_id="<?php echo $product->product_id;?>">
									<option value="">Select Provider</option>
									<?php
									foreach($providers as $provider){
										?>
										<option value="<?php echo $provider->provider_id;?>"><?php echo $provider->provider_name;?></option>
										<?php
									}
									?>
								</select>
								</div>
							<?php } ?>
							<div id="horizontalTab" class="tab_sec">
								<ul class="resp-tabs-list">
									<li>Flawless</li>
									<li>Good</li>
									<li>Broken</li>
								</ul>
								<div class="resp-tabs-container">
									<!--start flawless-->	
									<div>
                                    <div class="row">
                                    <div class="col-md-5">
										<?php if(!empty($product->flawless_heading)){?>
										<?php echo $product->flawless_heading;?>
										<hr/><br/>
										<?php } ?>
										<?php if(empty($product->flawless_disable_purchase)){ ?>										
										<span class="price flawless_price">$<?php echo !empty($product->has_variation)&& !empty($variations)?$variations->flawless_price:$product->flawless_price;?></span>
										<?php }else{?>
											<span class="price">$0</span>
											<?php
										} ?>
										<span class="ship">Ship us your device by <span><?php echo date('j/m/Y', strtotime(' +1 day'));?></span></span>
										
										<?php if(!empty($product->enable_icloud)){?>
											<div>
												<div class="icloud">iCloud Deactivated? <a href="javascript:void(0);" class="btn btn-primary icloud-activation">Yes</a><a href="javascript:void(0);" class="btn btn-primary icloud-deactivation" data-toggle="modal" data-target="#icloudModal">No</a></div>
												<div  style="font-size:12px; margin-bottom:10px;"><a href="javascript:void(0);" data-toggle="modal" data-target="#icloudModal" >Click here for instruction on how to turn it off</a></div>
												<div style="padding:0 0 15px 0">Click Yes to enable Next Button.</div>
											</div>
										
										<?php } ?>
										
										<?php if(empty($product->flawless_disable_purchase)){ ?>
										<!--<a class="next" href="javascript:void(0);">next</a>-->
										<form class="add_to_cart">
											<input type="hidden" name="category_id"  value="<?php echo $category->category_id;?>">
											<input type="hidden" name="model_id"  value="<?php echo $model->model_id;?>">
											<input type="hidden" name="provider_id"  value="<?php echo $provider_id;?>">
											<input type="hidden" name="product_id"  value="<?php echo $product->product_id;?>">
											<input type="hidden" name="condition" value="flawless" >
											<input type="hidden" name="need_provider"  value="<?php echo $need_provider;?>">											
											<button class="next <?php echo !empty($product->enable_icloud)?'disabled':''; ?>" <?php echo !empty($product->enable_icloud)?'disabled="true"':''; ?> type="submit">Next</button>
										</form>
										<?php } else{?>
										We're Sorry! We stopped purchasing this device in the specified condition.
										<?php } ?>
										</div>
										
										<div class="col-md-7">
										<div class="detils_list">
											<?php echo $product->flawless_description;?>
										</div>
                                        </div>
                                    </div>
									</div>
									
									<!--end flawless-->
									
									<!--start good-->	
									<div>
                                    <div class="row">
                                    <div class="col-md-5">
										<?php if(!empty($product->good_heading)){?>
										<?php echo $product->good_heading;?>
										<hr/><br/>
										<?php } ?>
										<?php if(empty($product->good_disable_purchase)){ ?>
										<span class="price good_price">$<?php echo !empty($product->has_variation)&& !empty($variations)?$variations->good_price:$product->good_price;?></span>
										<?php }else{?>
											<span class="price">$0</span>
											<?php
										} ?>
										<span class="ship">Ship us your device by <span><?php echo date('j/m/Y', strtotime(' +1 day'));?></span></span>
										
										<?php if(!empty($product->enable_icloud)){?>
											<div>
												<div class="icloud">iCloud Deactivated? <a href="javascript:void(0);" class="btn btn-primary icloud-activation">Yes</a><a href="javascript:void(0);" class="btn btn-primary icloud-deactivation" data-toggle="modal" data-target="#icloudModal">No</a></div>
												<div  style="font-size:12px; margin-bottom:10px;"><a href="javascript:void(0);" data-toggle="modal" data-target="#icloudModal" >Click here for instruction on how to turn it off</a></div>
												<div style="padding:0 0 15px 0">Click Yes to enable Next Button.</div>
											</div>
										
										<?php } ?>
										
										<?php if(empty($product->good_disable_purchase)){ ?>
										<!--<a class="next" href="javascript:void(0);">next</a>-->
										<form class="add_to_cart">
											<input type="hidden" name="category_id"  value="<?php echo $category->category_id;?>">
											<input type="hidden" name="model_id"  value="<?php echo $model->model_id;?>">
											<input type="hidden" name="provider_id"  value="<?php echo $provider_id;?>">
											<input type="hidden" name="product_id"  value="<?php echo $product->product_id;?>">
											<input type="hidden" name="condition" value="good" >
											<input type="hidden" name="need_provider"  value="<?php echo $need_provider;?>">											
											<button class="next <?php echo !empty($product->enable_icloud)?'disabled':''; ?>" <?php echo !empty($product->enable_icloud)?'disabled="true"':''; ?> type="submit">Next</button>
										</form>
										<?php } else{?>
										We're Sorry! We stopped purchasing this device in the specified condition.
										<?php } ?>
                                        </div>
                                        <div class="col-md-7">
										<div class="detils_list">
											<?php echo $product->good_description;?>
										</div>
                                        </div>
                                    </div>
									</div>
									<!--end good-->
									
									<!--start broken-->
									<div>
                                    	<div class="row">
                                    	<div class="col-md-5">
										<?php if(!empty($product->broken_heading)){?>
										<?php echo $product->broken_heading;?>
										<hr/><br/>
										<?php } ?>
										<?php if(empty($product->broken_disable_purchase)){ ?>
										<span class="price broken_price">$<?php echo !empty($product->has_variation)&& !empty($variations)?$variations->broken_price:$product->broken_price;?></span>
										<?php }else{?>
											<span class="price">$0</span>
											<?php
										} ?>
										<span class="ship">Ship us your device by <span><?php echo date('j/m/Y', strtotime(' +1 day'));?></span></span>
										
										<?php if(!empty($product->enable_icloud)){?>
											<div>
												<div class="icloud">iCloud Deactivated? <a href="javascript:void(0);" class="btn btn-primary icloud-activation">Yes</a><a href="javascript:void(0);" class="btn btn-primary icloud-deactivation" data-toggle="modal" data-target="#icloudModal">No</a></div>
												<div  style="font-size:12px; margin-bottom:10px;"><a href="javascript:void(0);" data-toggle="modal" data-target="#icloudModal" >Click here for instruction on how to turn it off</a></div>
												<div style="padding:0 0 15px 0">Click Yes to enable Next Button.</div>
											</div>
										
										<?php } ?>
										<?php if(empty($product->broken_disable_purchase)){ ?>
										<!--<a class="next" href="javascript:void(0);">next</a>-->
										<form class="add_to_cart">
											<input type="hidden" name="category_id"  value="<?php echo $category->category_id;?>">
											<input type="hidden" name="model_id"  value="<?php echo $model->model_id;?>">
											<input type="hidden" name="provider_id"  value="<?php echo $provider_id;?>">
											<input type="hidden" name="product_id"  value="<?php echo $product->product_id;?>">
											<input type="hidden" name="condition" value="broken" >
											<input type="hidden" name="need_provider"  value="<?php echo $need_provider;?>">											
											<button class="next <?php echo !empty($product->enable_icloud)?'disabled':''; ?>" <?php echo !empty($product->enable_icloud)?'disabled="true"':''; ?> type="submit">Next</button>
										</form>
										<?php } else{?>
										We're Sorry! We stopped purchasing this device in the specified condition.
										<?php } ?>
                                        </div>
                                        
                                        <div class="col-md-7">
										<div class="detils_list">
											<?php echo $product->broken_description;?>
										</div>
                                        </div>
                                    </div>
									</div>
									<!--end broken-->
								</div>
							</div>
						</div>
					</div>
				</div><!--end container-->
				<?php if(!empty($need_provider) && empty($provider_id)){?>
				<div class="container why_sell" id="provider_section" style="display:none;">
					<div class="col-md-12 col-sm-12 col-xs-12 ajax_content">
					provider section
					</div>
				</div>
				<?php } ?>
				<?php 
				$is_logged_in=is_logged_in();
				if(empty($is_logged_in)){?>
				<div class="container" id="login_section" style="display:none;">
					<div class="col-md-12 col-sm-12 col-xs-12 ajax_content">
						
					</div>
				</div>
				<div class="container" id="registration_section" style="display:none;">
					<div class="col-md-12 col-sm-12 col-xs-12 ajax_content">
					registration section
					</div>
				</div>
				<?php } ?>
				<div class="container" id="after_login_section" style="display:none;">
					<div class="col-md-12 col-sm-12 col-xs-12 ajax_content">
					after login section
					</div>
				</div>				
			</div>
			
			
		</div>
	</div>
</main>

<!-- Modal -->
<div id="icloudModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">How to Deactivate iCloud</h4>
      </div>
      <div class="modal-body">
        <p>
			Find My iPhone is on most Apple products that can help you locate your device if stolen or lost, however it can also interfere with activating the device by a new owner. As a result, the device is effectively rendered a dummy phone and will have no value. To speed up the process we kindly ask that you deactivate iCloud from your device following these steps:

 

Here's how to get Find My iPhone off of your account:

Go to "Settings" on your device's home screen.
Settings

Go to "iCloud" in the Settings menu.
Icloud

If Find My iPhone is ON, tap the slider to turn it OFF.
If you are asked to enter a password, enter your iCloud password and tap "Turn Off" to confirm.
Search

If you've already shipped your device or you can't turn your phone on at all:

Sign in at http://www.icloud.com/ and click "Devices" at the top. Find the specific device we'll be expecting and click on that device, and then click the "X" to take it off your iCloud account.
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->