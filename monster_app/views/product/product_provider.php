<h2 class="heading"><?php echo 'Choose your provider';?></h2>
		<div class="products">
			<ul class="clearfix">
			<?php foreach($providers as $provider){?>
				<?php
				$img_src='';
				if(file_exists(UPLOADS_PROVIDER.$provider->provider_image)){								
					$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PROVIDER).$provider->provider_image;
				}
				?>
				<li>
					<div class="product">
						<a href="javascript:void(0);" class="provider_next_add_to_cart" data-model_id="<?php echo $model_id;?>" data-provider_id="<?php echo $provider->provider_id;?>" data-condition="<?php echo $params['condition'];?>">
							<?php if(!empty($img_src)){ ?>
							<div class="pro_img">											
								<img src="<?php echo $img_src;?>" alt="" > 
							</div>
							<?php }?>
							<div class="pro_name">
								<span><?php echo $provider->provider_name;?></span>
							</div>
						</a>
					</div>
				</li>
			
			<?php } ?>
			</ul>
		</div>
		<a href="javascript:void(0);" class="btn btn-default add_to_cart_back" data-section="">Back</a>