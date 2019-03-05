 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">Edit User</h1>-->
					<div class="page-header">
						<div class="row">
							<div class="col-lg-12">
								<h1>Edit Footer Settings</h1>
							</div>
							<!--<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('users');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-bars" aria-hidden="true"></i> All users</h1></a>
								<a href="<?php echo site_url('user/add');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-plus" aria-hidden="true"></i> Add New</h1></a>								
							</div>-->
							
						</div>
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Footer Settings 
                        </div>
                        <div class="panel-body">
                            <div class="row">
								 <div class="col-lg-12">
									<?php if(!empty($error_msg)){?>
										<div class="alert alert-danger">
											<?php echo $error_msg; ?>
										</div>
									<?php }
									elseif(!empty($success_msg)){
										?>
										<div class="alert alert-success">
											<?php echo $success_msg; ?>
										</div>
									<?php	
									}?>
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Footer Logo</label>
                                            <input type="file" id="footer_logo" name="logo">
											<div id="footer_logo_snap" style="margin-top:20px;">
												<?php
												$image_url=str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_SETTINGS).$settings['logo'];
												?>
												<img src="<?php echo $image_url;?>">
											</div>
                                        </div>
										<div class="form-group">
                                            <label>Keep In Touch</label>
                                            <textarea class="form-control" name="keep_in_touch"><?php echo !empty($settings['keep_in_touch'])?$settings['keep_in_touch']:'';?></textarea>											
                                        </div>
										<div class="form-group">
                                            <label>Facebook Url</label>
                                            <input type="text" class="form-control" name="facebook_url" value="<?php echo !empty($settings['facebook_url'])?$settings['facebook_url']:'';?>">
										</div>
										<div class="form-group">
                                            <label>Twitter Url</label>
                                            <input type="text" class="form-control" name="twitter_url" value="<?php echo !empty($settings['twitter_url'])?$settings['twitter_url']:'';?>">
										</div>
										<div class="form-group">
                                            <label>Instagram Url</label>
                                            <input type="text" class="form-control" name="twitter_url" value="<?php echo !empty($settings['twitter_url'])?$settings['twitter_url']:'';?>">
										</div>
										<div class="form-group">
                                            <label>Links</label>
											<div class="row">
												<div class="col-md-6">
													<select name="menu_select" id="menu_select" class="form-control">
														<option value="home">Home</option>
														<option value="blog">Blog</option>
														<?php 
														if(!empty($static_pages))
														{
															foreach($static_pages as $page)
															{
																?>
																<option value="<?php echo $page->slug;?>"><?php echo $page->name;?></option>																
																<?php
															}
														}
														?>
													</select>
													<input class="form-control hidden" id="menu_arr" name="menu_arr" value="<?php //echo $user['first_name'];?>">
													<br/>
													<input type="button" class="btn btn-primary" id="add_to_menu" value="Add Menu">
												</div>
												<div class="col-md-6">
													<div class="dd" id="nestable">
														<ol class="dd-list"> 
															<?php if(!empty($settings['menu'])){
																$menus=$settings['menu'];
																foreach($menus as $menu)
																{
																	$menu_title='';
																	if($menu->id=='home')
																		$menu_title='Home';
																	else if($menu->id=='blog')
																		$menu_title='Blog';
																	else{
																		$page=$this->pages_model->get_page_by_slug($menu->id);
																		$menu_title=$page->name;
																	}
																	?>
																		<li class="dd-item" data-id="<?php echo $menu->id;?>">
																				<div class="dd-handle"><?php echo $menu_title;?></div>
																				<a href="javascript:void(0);" class="delete_menu">X</a></li>
																		</li>

																	<?php	
																}
															}?>
														</ol>
													</div>
												</div>
											</div>
                                           <!-- <input class="form-control" name="last_name" value="<?php echo $user['last_name'];?>">                                            -->
                                        </div>

										<div class="form-group">
                                            <label>Product Links</label>
											<div class="row">
												<div class="col-md-6">
													<select name="product_menu_select" id="product_menu_select" class="form-control">
														<?php 
														if(!empty($products))
														{
															foreach($products as $product)
															{
																$product_details=$this->catalog_model->get_product_related_details($product->product_id);
																?>
																<option value="<?php echo $product->product_id;?>"><?php echo $product_details->model_name.' '.$product->product_name;?></option>																
																<?php
															}
														}
														?>
													</select>
													<input class="form-control hidden" id="product_menu_arr" name="product_menu_arr" value="<?php //echo $user['first_name'];?>">
													<br/>
													<input type="button" class="btn btn-primary" id="product_add_to_menu" value="Add Menu">
												</div>
												<div class="col-md-6">
													<div class="dd" id="nestable2">
														<ol class="dd-list"> 
															<?php if(!empty($settings['product_menu'])){
																$menus=$settings['product_menu'];
																foreach($menus as $menu)
																{
																	$product_details=$this->catalog_model->get_product_related_details($menu->id);
																	?>
																		<li class="dd-item" data-id="<?php echo $menu->id;?>">
																				<div class="dd-handle"><?php echo $product_details->model_name.' '.$product_details->product_name;?></div>
																				<a href="javascript:void(0);" class="delete_menu">X</a></li>
																		</li>

																	<?php	
																}
															}?>
														</ol>
													</div>
												</div>
											</div>
                                           </div>
										   <div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" name="address" value="<?php echo !empty($settings['address'])?$settings['address']:'';?>">
										   </div>
										   <div class="form-group">
												<label>Contact Number</label>
												<input type="text" class="form-control" name="contact_number" value="<?php echo !empty($settings['contact_number'])?$settings['contact_number']:'';?>">
										   </div>
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                                        
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->