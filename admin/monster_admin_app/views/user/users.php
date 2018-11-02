 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<h1>Users</h1>
							</div>
							<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('user/add');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-plus" aria-hidden="true"></i> Add New</h1></a>
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
                            All users
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
												<th>First Name</th>
												<th>Last Name</th>
												<th>Email</th>
												<th>Role</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($users)){
												foreach($users as $user){
											?>
											<tr class="odd gradeX">
												<td><?php echo $user->user_id;?></td>
												<td><?php echo $user->first_name;?></td>
												<td><?php echo $user->last_name;?></td>
												<td><?php echo $user->email;?></td>
												<td class="center">
													<?php 
													switch($user->role){
														case 1:
															echo 'Administrator';
														break;
														case 2:
															echo 'Employee';
														break;
														case 3:
															echo 'User';
														break;
													}
													
													?>
												</td>
												<td class="center;">
													<a href="<?php echo site_url('/user/edit/').$user->user_id;?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;
													<a href="<?php echo site_url('/user/delete/').$user->user_id;?>" title="Delete" class="delete-confirm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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