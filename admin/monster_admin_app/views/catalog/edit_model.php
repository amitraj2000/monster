 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Model</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Edit model <?php echo !empty($model['model_id'])?'#'.$model['model_id']:'';?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<?php if(empty($model['model_id'])){?>
								 <div class="col-lg-12">	
									<div class="alert alert-danger">
										No model found.
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
                                            <label>Model Name</label>
                                            <input class="form-control" name="name" value="<?php echo !empty($model['name'])?$model['name']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image">
											<?php 
												if(file_exists(UPLOADS_MODEL_THUMB.$model['image'])){
													$image_url=str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_MODEL_THUMB).$model['image'];
													?>
													<img src="<?php echo $image_url;?>" />
													<?php
												}
												
												?>
                                        </div>
										<div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category_id">
                                                <option value="">Select Category</option>
                                                <?php
												if(!empty($categories)){
													foreach($categories as $category){
														?>
														<option value="<?php echo $category->category_id;?>" <?php echo !empty($model['category_id']) && $model['category_id']==$category->category_id?'selected="selected"':'';?>><?php echo $category->category_name;?></option>
														<?php
													}
												}
												?>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Heading Text</label>
                                            <input class="form-control" name="heading_text" value="<?php echo !empty($model['heading_text'])?$model['heading_text']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Providers</label>
                                            <select multiple class="form-control" name="providers[]">
                                                <?php 
												if(!empty($providers))
												{
													foreach($providers as $provider){
														?>
														<option value="<?php echo $provider->provider_id;?>" <?php echo !empty($model['providers']) && in_array($provider->provider_id,$model['providers'])?'selected="selected"':'';?>><?php echo $provider->provider_name;?></option>
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
										<input type="hidden" name="model_id" value="<?php echo $model['model_id'];?>">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                                        
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