<h2 class="heading"><?php echo !empty($model->heading_text)?$model->heading_text:'Choose your device';?></h2>
<div class="products">
	<ul class="clearfix">
	<?php foreach($products as $product){?>
		<?php
		$img_src='';
		$details=$this->catalog_model->get_product_related_details($product->product_id);
		$href=base_url($details->category_slug.'/'.$details->product_slug.'/'.$details->model_slug);
		if(file_exists(UPLOADS_PRODUCT.$product->product_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT).$product->product_image;
		}
		?>
		<li>
			<div class="product">
				<a href="javascript:void(0);" class="load-product-details" data-product_id="<?php echo $product->product_id;?>" data-href="<?php echo $href;?>" >
					<?php if(!empty($img_src)){ ?>
					<div class="pro_img">											
						<img src="<?php echo $img_src;?>" alt="" width="117" height="250"> 
					</div>
					<?php }?>
					<div class="pro_name">
						<span><?php echo $product->product_name;?></span>
					</div>
				</a>
			</div>
		</li>
	
	<?php  } ?>
	</ul>
</div>