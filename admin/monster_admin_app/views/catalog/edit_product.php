 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Edit product <?php echo !empty($product['product_id'])?'#'.$product['product_id']:'';?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<?php if(empty($product['product_id'])){?>
								 <div class="col-lg-12">	
									<div class="alert alert-danger">
										No product found.
									</div>
								 </div>
								<?php }else{ ?>
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
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="name" value="<?php echo !empty($product['name'])?$product['name']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image">
											<?php 
												if(file_exists(UPLOADS_PRODUCT_THUMB.$product['image'])){
													$image_url=str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_PRODUCT_THUMB).$product['image'];
													?>
													<img src="<?php echo $image_url;?>" />
													<?php
												}
												
												?>
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
                                                <input type="checkbox" name="disable" value="on" <?php echo !empty($model['status']) && $model['status']=='2'?'checked="checked"':'';?>>&nbsp;
                                            </label>
                                            
                                        </div>
										<input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
                                        <button type="submit" name="submit" value="submit" class="btn btn-default">Save</button>
                                        
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->         
								<?php } ?>
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