 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">Add New User</h1>-->
					<div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<h1>Add New User</h1>
							</div>
							<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('users');?>"><h1 class="btn btn-primary btn-lg"><i class="fa fa-bars" aria-hidden="true"></i> All Users</h1></a>							
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
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" value="<?php echo !empty($user['first_name'])?$user['first_name']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="last_name" value="<?php echo !empty($user['last_name'])?$user['last_name']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" value="<?php echo !empty($user['email'])?$user['email']:'';?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Role</label>
                                            <select class="form-control" name="role" >
												<option value="1" <?php echo !empty($user['role']) && $user['role']==1?'selected="selected"':'';?>>Administrator</option>
												<option value="2" <?php echo !empty($user['role']) && $user['role']==2?'selected="selected"':'';?>>Employee</option>
												<option value="3" <?php echo !empty($user['role']) && $user['role']==3?'selected="selected"':'';?>>User</option>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="password" type="password"> 
                                        </div>
										<div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" name="confirm_password" type="password">                                      
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