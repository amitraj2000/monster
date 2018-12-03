<div class="row">
	<div class="col-md-3">
		<ul>
			<li class="active"><a href="<?php echo base_url('account-summary/summary/');?>">Your Trades</a></li>
			<li><a href="<?php echo base_url('account-summary/edit/');?>">Password & Email</a></li>
			<li><a href="<?php echo base_url('account-summary/address/');?>">Stored Address</a></li>
		</ul>
	</div>
	<div class="col-md-9">
	Welcome Back <?php echo !empty($user)?$user->first_name.'&nbsp;'.$user->last_name:'';?>
		 <div id="summary_tab">          
        <ul class="resp-tabs-list">
            <li> Open </li>
            <li> Completed </li>
        </ul> 

        <div class="resp-tabs-container">                                                        
            <div>
				<?php if(!empty($open_orders)){?>
					<table id="open_order_con">
					<th>&nbsp;</th>
					<th>Created</th>
					<th>Box ID</th>
					<th>Status</th>
					<th>Complete Order</th>
					<th>View Details</th>
					<?php foreach($open_orders as $open_order){
						
						$status='Pending';
						switch($open_order->status){
							case '1':
							$status='Pending';
							break;
							case '2':
							$status='Processing';
							break;
							case '3':
							$status='On the way';
							break;
							case '4':
							$status='Completed';
							break;						
							
						}
						?>
						<tr>
							<td>Your box item worth $<?php echo $open_order->price;?></td>
							<td><?php echo date('d/m/Y',strtotime($open_order->date));?></td>
							<td><?php echo $open_order->order_id;?></td>
							<td><?php echo $status;?></td>
							<td><a href="<?php echo base_url();?>payment-carrier/">Click Here</a></td>
							<td><a href="<?php echo base_url();?>order-details/<?php echo $open_order->order_id;?>">View Details</a></td>
						</tr>
					<?php } ?>
					
					</table>
					<?php if(!empty($open_orders_pagination)){?>
					<div id="open_pagination">
						<?php echo $open_orders_pagination;?>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
            <div> 
				<?php if(!empty($completed_orders)){?>
				<table id="completed_order_con">
				<?php foreach($completed_orders as $completed_order){?>
					<tr>
						<td>Your box item worth $<?php echo $completed_order->price;?></td>
					</tr>
				<?php } ?>				
				</table>
				<?php if(!empty($completed_orders_pagination)){?>
				<div id="completed_pagination">
					<?php echo $completed_orders_pagination;?>
				</div>
				<?php } ?>
			<?php } ?>
			</div>
        </div>
    </div>   
	</div>
</div>