<?php

$total_pending_orders=$this->db->query("SELECT COUNT(cart_id) AS cnt FROM ".CART_MASTER)->row()->cnt;
$total_open_orders=$this->order_model->get_total_orders(array('status_not_in'=>array(19,20,21)));
$total_completed_orders=$this->order_model->get_total_orders(array('status'=>array(19,20,21)));
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($total_pending_orders);?></div>
                                    <div>Pending Orders!</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($total_open_orders);?></div>
                                    <div>Open Orders!</div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo number_format($total_completed_orders);?></div>
                                    <div>Completed orders!</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
           
        </div>
        <!-- /#page-wrapper -->

    
