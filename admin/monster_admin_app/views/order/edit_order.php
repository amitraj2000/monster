 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--<h1 class="page-header">Edit User</h1>-->
					<div class="page-header">
						<div class="row">
							<div class="col-lg-6">
								<b>Order : #<?php echo $order->order_id;?></b><br/>
								<b>Box ID : #<?php echo $order->box_id;?></b>
							</div>
							<div class="col-lg-6 text-right">
								<a href="<?php echo site_url('orders');?>" class="btn btn-primary btn-lg"><i class="fa fa-bars" aria-hidden="true"></i> All orders</a>
								
							</div>
							
						</div>
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Customer Information</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<div class="col-lg-12">
									<b>Customer Details</b><hr/>
									<div><b>Name</b> : <?php echo $order->first_name.'&nbsp;'.$order->last_name; ?></div>
									<div><b>Email</b> : <?php echo $order->email; ?></div>
									<br/><b>Shipping Method</b><hr/>
									<div><b>Shipping type</b> :
										<?php
										echo $order->shipping_type=='express'?'Express':'Shipping kit';
										?>
									</div> 
									<div><b>Shipping Address</b> : 
									<?php
									$shipping_address=unserialize($order->shipping_address);
									echo $shipping_address['first_name'].'&nbsp;'.$shipping_address['last_name'];
									echo !empty($shipping_address['address_1'])?'<br/>'.$shipping_address['address_1']:'';
									echo !empty($shipping_address['address_2'])?'<br/>'.$shipping_address['address_2']:'';
									echo '<br/>'.$shipping_address['city'].$shipping_address['province'].','.$shipping_address['zip_code'];
									echo !empty($shipping_address['phone_number'])?'<br/>'.$shipping_address['phone_number']:'';
									?>
									</div>
									<br/><b>Payment Method</b><hr/>
									<div><b>Method</b> :<?php echo ucfirst($order->payment_type);?></div>
									<?php 
									$gateway_details=unserialize($order->gateway_details);
									
									if($order->payment_type=='paypal'){ ?>
										<div><b>Paypal Email</b> :<?php echo $gateway_details['paypal_email'];?></div>
									<?php }else{ ?>
										<div><b>Cheque details</b> :
											<?php
											echo $gateway_details['payable_to'];
											echo '<br/>'.$gateway_details['address_1'];
											echo !empty($gateway_details['address_2'])?'<br/>'.$gateway_details['address_2']:'';
											echo '<br/>'.$gateway_details['city'].','.$gateway_details['zip_code'];
											?>
										</div>
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
			<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Order Information</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">								
                                <div class="col-lg-12">
									<?php
									if(!empty($order_items)){
										foreach($order_items as $item){
											?>
											<div><b>Product :</b><?php echo $item->model_name.'&nbsp;'.$item->product_name;?></div>
											<div><b>Product ID :</b><?php echo $item->product_id;?></div>
											<div><b>Condition :</b><?php echo ucfirst($item->product_condition);?></div>
											<div><b>Price :$</b><?php echo ucfirst($item->price);?></div>
											<hr/>
											<?php
										}
									}
									?>	
									<div><b>Order Status : <?php echo get_product_status_text($order->order_status);?></b></div>
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
		<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Inspection Details</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									inspection details here
                               
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