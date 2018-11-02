<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		$args=array();
		
		$categories=$this->catalog_model->get_categories();
		$args['categories']=$categories;
		
		$this->load->view('common/header');
		$this->load->view('home',$args);
		$this->load->view('common/footer');
	}
	
	public function load_models_by_category()
	{
		$category_id=$this->input->post('category_id');
		$category=$this->catalog_model->get_category_by_id($category_id);
		
		$output='';
		
		$models=$this->catalog_model->get_models_by_category_id($category_id);
		if(!empty($models))
		{
			ob_start();
			?>
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
			
			<?php
			$output=ob_get_contents();
			ob_clean();
		}
		echo $output;
		die;
	}
	
	public function load_providers_by_model()
	{
		$model_id=$this->input->post('model_id');
		$model=$this->catalog_model->get_model_by_id($model_id);
		
		$output='';
		
		$providers=$this->catalog_model->get_providers_by_model_id($model_id);
		//load products directly
		if(empty($providers))
		{
			$this->load_products_by_model($model_id);
		}
		else
		{
			ob_start();
			?>
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
							<a href="javascript:void(0);" class="load-product" data-model_id="<?php echo $model_id;?>" data-provider_id="<?php echo $provider->provider_id;?>">
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
			
			<?php
			$output=ob_get_contents();
			ob_clean();
		}
		echo $output;
		die;
	}
	
	public function load_products_by_model($model_id='')
	{
		if(empty($model_id)){
			$model_id=$this->input->post('model_id');
		}
		$model=$this->catalog_model->get_model_by_id($model_id);
		
		$output='';
		
		$products=$this->catalog_model->get_products_by_model_id($model_id);
		
		if(!empty($products))
		{
			ob_start();
			?>
			<h2 class="heading"><?php echo !empty($model->heading_text)?$model->heading_text:'Choose your device';?></h2>
			<div class="products">
				<ul class="clearfix">
				<?php foreach($products as $product){?>
					<?php
					$img_src='';
					if(file_exists(UPLOADS_PRODUCT.$product->product_image)){								
						$img_src=str_replace(FCPATH.'/',base_url(),UPLOADS_PRODUCT).$product->product_image;
					}
					?>
					<li>
						<div class="product">
							<a href="javascript:void(0);" class="load-product-details" data-product_id="<?php echo $product->product_id;?>" >
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
				
				<?php } ?>
				</ul>
			</div>
			
			<?php
			$output=ob_get_contents();
			ob_clean();
		}
		echo $output;
		die;
	}
}
