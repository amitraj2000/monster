 <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
					<div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<h1>Edit Category</h1>
							</div>
							<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('categories');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-bars" aria-hidden="true"></i> All Categories</h1></a>
								<a href="<?php echo site_url('category/add');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-plus" aria-hidden="true"></i> Add New</h1></a>								
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
                        <div class="panel-heading">
                           Edit category <?php echo !empty($category['category_id'])?'#'.$category['category_id']:'';?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<?php if(empty($category['category_id'])){?>
								 <div class="col-lg-12">	
									<div class="alert alert-danger">
										No category found.
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
                                            <label>Category Name</label>
                                            <input class="form-control" name="name" value="<?php echo !empty($category['name'])?$category['name']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image">
											<?php 
												if(file_exists(UPLOADS_CATEGORY_THUMB.$category['image'])){
													$image_url=str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_CATEGORY_THUMB).$category['image'];
													?>
													<img src="<?php echo $image_url;?>" />
													<?php
												}
												
												?>
                                        </div>
										<div class="form-group">
                                            <label>Heading Text</label>
                                            <input class="form-control" name="heading_text" value="<?php echo !empty($category['heading_text'])?$category['heading_text']:'';?>">                                            
                                        </div>
										<div class="form-group">
											<label>Flawless Description</label>
											<textarea class="form-control editor" name="flawless_description"><?php echo !empty($category['flawless_description'])?$category['flawless_description']:'';?></textarea>
										</div>
										<div class="form-group">
											<label>Good Description</label>
											<textarea class="form-control editor" name="good_description"><?php echo !empty($category['good_description'])?$category['good_description']:'';?></textarea>
										</div>
										<div class="form-group">
											<label>Broken Description</label>
											<textarea class="form-control editor" name="broken_description"><?php echo !empty($category['broken_description'])?$category['broken_description']:'';?></textarea>
										</div>
										<div class="form-group">
                                            <label>Keep it disabled</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="disable" value="on" <?php echo !empty($category['status']) && $category['status']=='2'?'checked="checked"':'';?>>&nbsp;
                                            </label>
                                            
                                        </div>
										<input type="hidden" name="category_id" value="<?php echo $category['category_id'];?>">
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