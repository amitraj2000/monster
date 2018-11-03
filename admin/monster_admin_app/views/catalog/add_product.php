 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Product</h1>
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
                                <div class="col-lg-6">
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
														<input class="form-control" name="flawless_price" value="<?php echo !empty($product['flawless_price'])?$product['flawless_price']:'';?>">
														<span class="input-group-addon">.00</span>
													</div>
													<div class="form-group">
														<label>Description</label>
														<textarea class="form-control editor" name="flawless_description"><?php echo !empty($product['flawless_description'])?$product['flawless_description']:'';?></textarea>
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
														<input class="form-control" name="good_price" value="<?php echo !empty($product['good_price'])?$product['good_price']:'';?>">
														<span class="input-group-addon">.00</span>
													</div>
													<div class="form-group">
														<label>Description</label>
														<textarea class="form-control editor" name="good_description"><?php echo !empty($product['good_description'])?$product['good_description']:'';?></textarea>
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
														<input class="form-control" name="broken_price" value="<?php echo !empty($product['broken_price'])?$product['broken_price']:'';?>">
														<span class="input-group-addon">.00</span>
													</div>
													<div class="form-group">
														<label>Description</label>
														<textarea class="form-control editor" name="broken_description"><?php echo !empty($product['broken_description'])?$product['broken_description']:'';?></textarea>
													</div>
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