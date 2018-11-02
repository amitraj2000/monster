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
                                    <form role="form" method="post" enctype="multipart/form-data">
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
										
                                        <button type="submit" name="submit" value="submit" class="btn btn-default">Save</button>
                                        
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