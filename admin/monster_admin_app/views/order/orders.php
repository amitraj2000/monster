 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
						<div class="row">
							<div class="col-lg-12">
								<h1>Orders</h1>
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
                            All Orders
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
												<th>User</th>
												<th>Box ID</th>
												<th>Payment Type</th>
												<th>Shipping Type</th>
												<th>Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($orders)){
												foreach($orders as $order){
											?>
											<tr class="odd gradeX">
												<td><?php echo $order->order_id;?></td>
												<td><?php echo $order->first_name.'&nbsp;'.$order->last_name;?></td>
												<td><?php echo $order->box_id;?></td>
												<td><?php echo ucfirst($order->payment_type);?></td>
												<td>
													<?php 
													$shipping_type='Express';
													switch($order->payment_type){
														case 'express':
														$shipping_type='Express checkout';
														break;
														case 'shipping_kit':
														$shipping_type='Kit';
														break;
													}
													echo $shipping_type;
													?>
												</td>
												<td class="center">
													<?php echo $order->date;?>
												</td>
												<td class="center">
													<?php echo get_product_status_text($order->order_status);?>
												</td>
												<td class="center;">
													<a href="<?php echo site_url('/order/edit/').$order->order_id;?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;
													<a href="<?php echo site_url('/order/delete/').$order->order_id;?>" title="Delete" class="delete-confirm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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