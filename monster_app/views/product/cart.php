<?php
$total_price=0;
if(!empty($items)){
	?>
	<div id="cart">
	<ul id="cart-list">
	<?php
	foreach($items as $item){
		$cart_product=$this->product_model->get_product_by_id($item['id']);
		
		$img_src='';
		//$details=$this->catalog_model->get_product_related_details($product->product_id);
		//$href=base_url($details->category_slug.'/'.$details->product_slug.'/'.$details->model_slug);
		if(file_exists(UPLOADS_PRODUCT_THUMB.$cart_product->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT_THUMB).$cart_product->product_image;
		}
		?>
		<li class="cart-item" data-rowid="<?php echo $item['rowid']; ?>">
		<img src="<?php echo $img_src;?>">
		<?php echo $cart_product->product_name;?><br/>
		Condition:<?php echo ucwords($item['options']['condition']);?></br>
		Price:$<?php echo $item['price'];?><br/>
		<a href="javascript:void(0);" class="delete_cart_item" data-rowid="<?php echo $item['rowid']; ?>">Delete</a>
		
		</li>
		<?php
		$total_price+=$item['price'];
		}
		?>
	</ul>
	<div>Total:$<?php echo $total_price;?></div>
	<?php
	
}else{
	echo 'No items found';
}
?>
</div>
<div>
	<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>
</div>