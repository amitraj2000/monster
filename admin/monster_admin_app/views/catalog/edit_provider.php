 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Provider</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Edit provider <?php echo !empty($provider['provider_id'])?'#'.$provider['provider_id']:'';?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<?php if(empty($provider['provider_id'])){?>
								 <div class="col-lg-12">	
									<div class="alert alert-danger">
										No provider found.
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
                                            <label>Provider Name</label>
                                            <input class="form-control" name="name" value="<?php echo !empty($provider['name'])?$provider['name']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Logo</label>
                                            <input type="file" name="image">
											<?php 
												if(file_exists(UPLOADS_PROVIDER_THUMB.$provider['image'])){
													$image_url=str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_PROVIDER_THUMB).$provider['image'];
													?>
													<img src="<?php echo $image_url;?>" />
													<?php
												}
												
												?>
                                        </div>
										
										<div class="form-group">
                                            <label>Keep it disabled</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="disable" value="on" <?php echo !empty($provider['status']) && $provider['status']=='2'?'checked="checked"':'';?>>&nbsp;
                                            </label>
                                            
                                        </div>
										<input type="hidden" name="provider_id" value="<?php echo $provider['provider_id'];?>">
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