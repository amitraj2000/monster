 <div id="page-wrapper">
           <div class="row">
                <div class="col-lg-12">
					<div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<h1>Add New Product</h1>
							</div>
							<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('products');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-bars" aria-hidden="true"></i> All Products</h1></a>
																
							</div>
							
						</div>
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!--<div class="panel-heading">
                           &nbsp;
                        </div>-->
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
									<!-- Nav tabs -->
									<ul class="nav nav-tabs">
										<li class="active"><a href="#basic" data-toggle="tab">Basic</a>
										</li>
										<li><a href="#flawless" data-toggle="tab">Flawless</a>
										<li><a href="#good" data-toggle="tab">Good</a>
										<li><a href="#broken" data-toggle="tab">Broken</a>
										<li><a href="#provider" data-toggle="tab">Provider</a>
										<li><a href="#advanced" data-toggle="tab">Advanced</a>
										</li>										
									</ul>
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <div class="tab-content">
											<div class="tab-pane fade in active" id="basic">											
												<p>
													<div class="form-group">
														<label>Product Name</label>
														<input class="form-control" name="name" value="<?php echo !empty($product['name'])?$product['name']:'';?>">                                            
													</div>
													<div class="form-group">
														<label>Image</label>
														<input type="file" name="image">
													</div>
													<div class="form-group">
														<label>Category</label>
														<select class="form-control" name="category_id" data-populate-model="true" data-field-to-update="model_id">
															<option value="">Select Category</option>
															<?php
															if(!empty($categories)){
																foreach($categories as $category){
																	?>
																	<option value="<?php echo $category->category_id;?>" <?php echo !empty($product['category_id']) && $product['category_id']==$category->category_id?'selected="selected"':'';?>><?php echo $category->category_name;?></option>
																	<?php
																}
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label>Model</label>
														<select class="form-control" name="model_id">
															<option value="">Select Model</option>
															<?php
															if(!empty($product['models'])){
																foreach($product['models'] as $m){
																	?>
																	<option value="<?php echo $m->model_id;?>" <?php echo !empty($product['model_id']) && $product['model_id']==$m->model_id?'selected="selected"':'';?>><?php echo $m->model_name;?></option>
																	<?php
																}
															} 
															?>
														</select>
													</div>
													
													<div class="form-group">
														<label>Keep it disabled</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="disable" value="on">&nbsp;
														</label>                                            
													</div>	
												</p>
											</div>
											<div class="tab-pane fade" id="flawless">
												<p>
													<div class="form-group">
														<label>Disable purchase on this condition</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="flawless_disable" value="on" <?php echo !empty($product['flawless_disable'])?'checked="checked"':'';?>>&nbsp;
														</label>														
													</div>
													<div class="form-group">
														<label>Heading</label>
														<input class="form-control" name="flawless_heading" value="<?php echo !empty($product['flawless_heading'])?$product['flawless_heading']:'';?>">                                            
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Price($)</span>
														<input class="form-control numberinput" name="flawless_price" value="<?php echo !empty($product['flawless_price'])?$product['flawless_price']:'';?>">
														<span class="input-group-addon">.00</span>
													</div>
												</p>
											</div>
											<div class="tab-pane fade" id="good">
												<p>
													<div class="form-group">
														<label>Disable purchase on this condition</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="good_disable" value="on" <?php echo !empty($product['good_disable'])?'checked="checked"':'';?>>&nbsp;
														</label>														
													</div>
													<div class="form-group">
														<label>Heading</label>
														<input class="form-control" name="good_heading" value="<?php echo !empty($product['good_heading'])?$product['good_heading']:'';?>">                                            
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Price($)</span>
														<input class="form-control numberinput" name="good_price" value="<?php echo !empty($product['good_price'])?$product['good_price']:'';?>">
														<span class="input-group-addon">.00</span>
													</div>
												</p>
											</div>
											<div class="tab-pane fade" id="broken">
												<p>
													<div class="form-group">
														<label>Disable purchase on this condition</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="broken_disable" value="on" <?php echo !empty($product['broken_disable'])?'checked="checked"':'';?>>&nbsp;
														</label>														
													</div>
													<div class="form-group">
														<label>Heading</label>
														<input class="form-control" name="broken_heading" value="<?php echo !empty($product['broken_heading'])?$product['broken_heading']:'';?>">                                            
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Price($)</span>
														<input class="form-control numberinput" name="broken_price" value="<?php echo !empty($product['broken_price'])?$product['broken_price']:'';?>">
														<span class="input-group-addon">.00</span>
													</div>
												</p>
											</div>
											<div class="tab-pane fade" id="provider">
												<p>
													<?php $provider_count=count($providers);
													if(!empty($provider_count)){?>
													<div class="form-group">
														<label>Has price variation associated with provider ?</label>
														<label class="checkbox-inline">
															<input type="checkbox" class="has-variation" data-class="provider-variation-group" name="has_variation" value="on" <?php echo !empty($product['has_variation'])?'checked="checked"':'';?>>&nbsp;
														</label>														
													</div>
													
													<div class="provider-variation-group" style="<?php echo empty($product['has_variation'])?'display:none':'';?>">
													<?php													
													foreach($providers as $provider){
														?>
														<div class="form-group">	
															<label class="col-md-3"><input type="checkbox" name="variation[<?php echo $provider->provider_id;?>][provider_id]" value="<?php echo $provider->provider_id;?>" <?php echo !empty($product['variation'][$provider->provider_id]['provider_id'])?'checked="checked"':'';?>>
															<?php echo $provider->provider_name;?>
															</label>
															 <label class="col-md-3"><input class="form-control numberinput" placeholder="Flawless Price" name="variation[<?php echo $provider->provider_id;?>][flawless]" size="10" value="<?php echo !empty($product['variation'][$provider->provider_id]['flawless'])?$product['variation'][$provider->provider_id]['flawless']:'';?>"></label>
															 <label class="col-md-3"><input class="form-control numberinput" placeholder="Good Price" name="variation[<?php echo $provider->provider_id;?>][good]" size="10" value="<?php echo !empty($product['variation'][$provider->provider_id]['good'])?$product['variation'][$provider->provider_id]['good']:'';?>"></label>
															 <label class="col-md-3"><input class="form-control numberinput" placeholder="Broken Price" name="variation[<?php echo $provider->provider_id;?>][broken]" size="10" value="<?php echo !empty($product['variation'][$provider->provider_id]['broken'])?$product['variation'][$provider->provider_id]['broken']:'';?>"></label>
														</div>
														<?php														
													}
													?>
													</div>
													<?php
													}
													?>
												</p>
											</div>
											<div class="tab-pane fade" id="advanced">
												<p>
													<div class="form-group">
														<label>Need iCloud checking</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="enable_icloud" value="on" <?php echo !empty($product['enable_icloud'])?'checked="checked"':'';?>>&nbsp;
														</label>														
													</div>
												</p>
											</div>
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