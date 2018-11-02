 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit user <?php echo !empty($user['user_id'])?'#'.$user['user_id']:'';?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<?php if(empty($user['user_id'])){?>
								 <div class="col-lg-12">	
									<div class="alert alert-danger">
										No user found.
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
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" value="<?php echo $user['first_name'];?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="last_name" value="<?php echo $user['last_name'];?>">                                            
                                        </div>
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" type="email" value="<?php echo $user['email'];?>">                                            
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
                                            <input class="form-control" name="password" type="password" value="">                                            
											<p class="help-block">If you don't want to change the password,leave this field blank.</p>
                                        </div>
										<div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" name="confirm_password" type="password" value="">
											<p class="help-block">If you don't want to change the password,leave this field blank.</p>                                            
                                        </div>    
										<input type="hidden" name="user_id" value="<?php echo $user['user_id'];?>">
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