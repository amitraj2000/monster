<div class="my-acount-bg">
<div class="container">
<div class="row">

	<div class="col-md-12"> 
    <div class="acount-link-bg">
    	<ul class="nav nav-pills nav-justified">
          <li role="presentation" class="active"><a href="<?php echo base_url('account-summary/summary/');?>">Dapibus ac facilisis in</a></li>
          <li role="presentation"><a href="<?php echo base_url('account-summary/edit/');?>">Password & Email</a></li>
          <li role="presentation"><a href="<?php echo base_url('account-summary/address/');?>">Stored Address</a></li>  
        </ul>
   	</div>        		
	</div>
    
	<div class="col-md-12">
    
    <div class="table-bg">
	<h1><span>Welcome Back <?php echo !empty($user)?$user->first_name.'&nbsp;'.$user->last_name:'';?></span></h1>
		 <div id="summary_tab">          
        <ul class="resp-tabs-list">
            <li> Open </li>
            <li> Completed </li>
        </ul> 

        <div class="resp-tabs-container">                                                        
            <div>
				<?php if(!empty($open_orders)){?>
					<table id="open_order_con">
					<tr>
						<th>&nbsp;</th>
						<th>Created</th>
						<th>Box ID</th>
						<th>Status</th>
						<th>Complete Order</th>
						<th>View Details</th>
					</tr>
					<?php foreach($open_orders as $item){
						
						$status='Pending';
						switch($item->status){
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
						if(!empty($item->has_variation)){
						$variations=$this->product_model->get_product_variation_by_id($item->product_id,$item->provider_id);
						}
						$price=0;
						switch($item->product_condition){
							case 'flawless':
								if(!empty($item->has_variation) && !empty($variations->flawless_price))
								$price=$variations->flawless_price;
								else
								$price=$item->flawless_price;
								break;
							case 'good':
								if(!empty($item->has_variation) && !empty($variations->good_price))
								$price=$variations->good_price;
								else
								$price=$item->good_price;
								break;
							case 'broken':
								if(!empty($item->has_variation) && !empty($variations->broken_price))
								$price=$variations->broken_price;
								else
								$price=$item->broken_price;				
								break;			
						} 
						?>
						<tr>
							<td>Your box item worth $<?php echo $price;?></td>
							<td><?php echo date('d/m/Y',strtotime($item->date));?></td>
							<td><?php echo $item->box_id;?></td>
							<td><?php echo $status;?></td>
							<td><a href="<?php echo base_url();?>payment-carrier/">Click Here</a></td>
							<td><a href="<?php echo base_url();?>order-details/<?php echo $item->order_id;?>">View Details</a></td>
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
				<?php foreach($completed_orders as $item){
				$status='Pending';
						switch($item->status){
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
						if(!empty($item->has_variation)){
						$variations=$this->product_model->get_product_variation_by_id($item->product_id,$item->provider_id);
						}
						$price=0;
						switch($item->product_condition){
							case 'flawless':
								if(!empty($item->has_variation) && !empty($variations->flawless_price))
								$price=$variations->flawless_price;
								else
								$price=$item->flawless_price;
								break;
							case 'good':
								if(!empty($item->has_variation) && !empty($variations->good_price))
								$price=$variations->good_price;
								else
								$price=$item->good_price;
								break;
							case 'broken':
								if(!empty($item->has_variation) && !empty($variations->broken_price))
								$price=$variations->broken_price;
								else
								$price=$item->broken_price;				
								break;			
						} 
				?>
					<tr>
						<td>Your box item worth $<?php echo $price;?></td>
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
</div>
</div>
</div>