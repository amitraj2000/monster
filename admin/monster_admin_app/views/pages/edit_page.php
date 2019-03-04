 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">Edit User</h1>-->
					<div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<h1>Edit Page</h1>
							</div>
							<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('pages');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-bars" aria-hidden="true"></i> All pages</h1></a>
								<a target="_blank" href="<?php echo dirname(site_url()).'/'.$page['slug'];?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-plus" aria-hidden="true"></i> View Page</h1></a>							
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
                            Edit page "<?php echo !empty($page['name'])?$page['name']:'';?>"
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<?php if(empty($page['page_id'])){?>
								 <div class="col-lg-12">	
									<div class="alert alert-danger">
										No page found.
									</div>
								 </div>
								<?php }else{ ?>
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
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="name" value="<?php echo $page['name'];?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Slug</label>
                                            <input class="form-control" name="slug" value="<?php echo $page['slug'];?>" readonly>                                            
                                        </div>
										<div class="form-group">
                                            <label>Content</label>
											<textarea class="form-control editor" name="content"><?php echo $page['content'];?></textarea>
                                            
                                        </div>
										   
										<input type="hidden" name="page_id" value="<?php echo $page['page_id'];?>">
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