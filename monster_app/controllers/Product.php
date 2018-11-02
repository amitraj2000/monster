<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function index($category_slug,$product_slug,$model_slug)
	{
		
		$this->load->model('product_model');
		$args=array();
		
		
		if(empty($category_slug) || empty($product_slug) || empty($model_slug))
			show_404();
		
		$product=$this->product_model->get_product_by_slug($product_slug,$model_slug,$category_slug);
		if(empty($product))
			show_404();
		
		$args['product']=$product;
		
		
		$this->load->view('common/header');
		$this->load->view('product',$args);
		$this->load->view('common/footer'); 
	}
	
	
}
