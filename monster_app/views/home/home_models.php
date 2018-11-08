<h2 class="heading"><?php echo !empty($category->heading_text)?$category->heading_text:'Choose your model';?></h2>
<div class="products">
	<ul class="clearfix">
	<?php foreach($models as $model){?>
		<?php
		$img_src='';
		if(file_exists(UPLOADS_MODEL.$model->model_image)){								
			$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_MODEL).$model->model_image;
		}
		?>
		<li>
			<div class="product">
				<a href="javascript:void(0);" class="load-provider" data-model_id="<?php echo $model->model_id;?>">
					<?php if(!empty($img_src)){ ?>
					<div class="pro_img">											
						<img src="<?php echo $img_src;?>" alt="" width="117" height="250"> 
					</div>
					<?php }?>
					<div class="pro_name">
						<span><?php echo $model->model_name;?></span>
					</div>
				</a>
			</div>
		</li>
	
	<?php } ?>
	</ul>
</div>