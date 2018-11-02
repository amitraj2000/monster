 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<h1>Categories</h1>
							</div>
							<div class="col-lg-6 text-right">
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
                            All categories
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<div class="row">
								<div class="col-sm-6">
									<div  role="status" aria-live="polite" style="padding-top: 8px;"><?php echo $pagination_text;?></div>
								</div>
								<div class="col-sm-6 text-right">	
										<?php echo $pagination;?>									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table width="100%" class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>Image</th>
												<th>Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($categories)){
												foreach($categories as $category){
											?>
											<tr class="odd gradeX">
												<td><?php echo $category->category_id;echo $category->status==2?'<b style="color:red"> (Disabled)</b>':'';?></td>
												<td><?php 
												if(file_exists(UPLOADS_CATEGORY_THUMB.$category->category_image)){
													$image_url=str_replace(dirname(FCPATH),dirname(base_url()),UPLOADS_CATEGORY_THUMB).$category->category_image;
													?>
													<img src="<?php echo $image_url;?>" />
													<?php
												}
												
												?></td>
												<td><?php echo $category->category_name;?></td>
												
												<td class="center;">
													<a href="<?php echo site_url('/category/edit/').$category->category_id;?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;
													<a href="<?php echo site_url('/category/delete/').$category->category_id;?>" title="Delete" class="delete-confirm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</td>
											</tr>
											<?php 
												}
											} ?>
										</tbody>
									</table><!-- /.table-responsive -->
								</div>
							</div>
                            <div class="row">
								<div class="col-sm-6">
									<div  role="status" aria-live="polite" style="padding-top: 8px;"><?php echo $pagination_text;?></div>
								</div>
								<div class="col-sm-6 text-right">	
										<?php echo $pagination;?>									
								</div>
							</div>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
        </div>
        <!-- /#page-wrapper -->