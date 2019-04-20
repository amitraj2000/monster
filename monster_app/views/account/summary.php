<div class="my-acount-bg">
<div class="container">
<div class="row">

	<div class="col-md-12"> 
    <div class="acount-link-bg">
    	<ul class="nav nav-pills nav-justified">
          <li role="presentation" class="active"><a href="<?php echo base_url('account-summary/summary/');?>">Your Trades</a></li>
          <li role="presentation"><a href="<?php echo base_url('account-summary/edit/');?>">Password & Email</a></li>
          <!--<li role="presentation"><a href="<?php echo base_url('account-summary/address/');?>">Stored Address</a></li>  -->
        </ul>
   	</div>        		
	</div>
    
	<div class="col-md-12">
    
    <div class="table-bg">
	<h1><span>Welcome Back <?php echo !empty($user)?$user->first_name.'&nbsp;'.$user->last_name:'';?></span></h1>
		 <div id="summary_tab">          
        <ul class="resp-tabs-list">
			<li> Pending </li>
            <li> Open </li>
            <li> Completed </li>
        </ul> 

        <div class="resp-tabs-container">                                                        
            <div>
				
					<table id="pending_order_con">
					<tr>
						<th>&nbsp;</th>
						<th>Total Items</th>
						<th>Created</th>
						<th>Complete Order</th>
						<th>View Details</th>
					</tr>
					<?php if(!empty($pending_orders)){?>
					<?php
					$items=unserialize($pending_orders->content);
					$price=0;
					if(!empty($items)){
						foreach($items as $item)
						$price+=$item['price'];
					}
					?>
					<tr>
						<td>Your box item worth $<?php echo $price;?></td>
						<td><?php echo count($items);?></td>
						<td><?php echo date('d/m/Y',strtotime($pending_orders->date));?></td>						
						<td><a href="<?php echo base_url();?>payment-carrier/">Click Here</a></td>
						<td><a href="<?php echo base_url();?>order-details/<?php echo $pending_orders->cart_id;?>">View Details</a></td>
					</tr>
					<?php }else{
						?>
					<tr>
						<td colspan="5">
							<div class="alert alert-danger">
							  There is no pending orders
							</div>
						</td>
					</tr>
					<?php } ?>
					</table>					
				
			</div>
            <div> 				
				<table id="open_order_con">
				<tr>
					<th>Order ID</th>
					<th>Total Amount</th>
					<th>Created</th>
					<th>USPS Tracking ID</th>
					<th>Status</th>
				</tr>
				<?php if(!empty($open_orders)){?>
				<?php foreach($open_orders as $item){
					
					$status=get_product_status_text($item->order_status);
					$price=0;
					$order_details=$this->order_model->get_order_details_by_order_id($item->order_id);
					if(!empty($order_details))
					{
						foreach($order_details as $od){
							$price+=$od->price;
						}
					}
					
				?>
					<tr>
						<td><?php echo $item->order_id;?></td>
						<td>$<?php echo $price;?></td>
						<td><?php echo date('d/m/Y',strtotime($item->order_date));?></td>
						<td><?php echo $item->usps_tracking_id;?></td>
						<td><?php echo $status;?></td>
					</tr>
				<?php } ?>	
				<?php }else{ ?>
					<tr>
						<td colspan="5">
							<div class="alert alert-danger">
							  There is no open orders
							</div>
						</td>
					</tr>
				<?php } ?>
				</table>
				<?php if(!empty($open_orders_pagination)){?>
				<div id="open_pagination">
					<?php echo $open_orders_pagination;?>
				</div>
				<?php } ?>
				
			</div>
			<div> 
				
				<table id="completed_order_con">
				<tr>
					<th>Order ID</th>
					<th>Total Amount</th>
					<th>Created</th>
					<th>USPS Tracking ID</th>
					<th>Status</th>
				</tr>
				<?php if(!empty($completed_orders)){?>
				<?php foreach($completed_orders as $item){
					
					$status=get_product_status_text($item->order_status);
					$price=0;
					$order_details=$this->order_model->get_order_details_by_order_id($item->order_id);
					if(!empty($order_details))
					{
						foreach($order_details as $od){
							$price+=$od->price;
						}
					}
					
				?>
					<tr>
						<td><?php echo $item->order_id;?></td>
						<td>$<?php echo $price;?></td>
						<td><?php echo date('d/m/Y',strtotime($item->order_date));?></td>
						<td><?php echo $item->usps_tracking_id;?></td>
						<td><?php echo $status;?></td>
					</tr>
				<?php } ?>	
					<?php }else{ ?>
					<tr>
						<td colspan="5">
							<div class="alert alert-danger">
							  There is no completed orders
							</div>
						</td>
					</tr>
					
					<?php } ?>
				</table>
				
				<?php if(!empty($completed_orders_pagination)){?>
				<div id="completed_pagination">
					<?php echo $completed_orders_pagination;?>
				</div>
				<?php } ?>
				
			</div>
        </div>
    </div>   
	</div>
    </div>
</div>
</div>
</div>