<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		$args=array();
		
		$categories=$this->catalog_model->get_categories();
		$args['categories']=$categories;
		
		$this->load->view('common/header');
		$this->load->view('home/home',$args);
		$this->load->view('common/footer');
	}
	
	public function load_models_by_category()
	{
		$category_id=$this->input->post('category_id');
		$category=$this->catalog_model->get_category_by_id($category_id);
		
		$models=$this->catalog_model->get_models_by_category_id($category_id);
		
		$args['models']=$models;
		
		if(!empty($models))
		{
			echo $this->load->view('home/home_models', $args,TRUE);
		}		
		die;
	}
	
	public function load_providers_by_model()
	{
		$model_id=$this->input->post('model_id');
		$model=$this->catalog_model->get_model_by_id($model_id);
		
		$providers=$this->catalog_model->get_providers_by_model_id($model_id);
		
		$args['model_id']=$model_id;
		$args['providers']=$providers;
		
		//load products directly
		//It means,all products under this model have no provider variation
		if(empty($providers))
		{
			$this->load_products_by_model($model_id);
		}
		else
		{
			echo $this->load->view('home/home_providers',$args,TRUE);
		}
		
		die;
	}
	
	public function load_products_by_model($model_id='')
	{
		if(empty($model_id)){
			$model_id=$this->input->post('model_id');
		}
		$model=$this->catalog_model->get_model_by_id($model_id);
		
		$products=$this->catalog_model->get_products_by_model_id($model_id);
		
		$args['products']=$products;
		
		if(!empty($products))
		{
			echo $this->load->view('home/home_products',$args,TRUE);
		}
		
		die;
	}
	public function load_products_by_model_provider(){
		$model_id=$this->input->post('model_id');
		$provider_id=$this->input->post('provider_id');
						
		$products=$this->catalog_model->get_products_by_model_provider_id($model_id,$provider_id);
		
		$args['products']=$products;
		
		if(!empty($products))
		{
			echo $this->load->view('home/home_products',$args,TRUE);
		}
		
		die;
	}
}
