<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function index($category_slug,$product_slug,$model_slug)
	{
		/*populate post value from home page*/
		$category_id=$this->input->post('category_id');
		$model_id=$this->input->post('model_id');
		$provider_id=$this->input->post('model_id');
		/*populate post value from home page*/
		
		$this->load->model('product_model');
		$args=array();
		
		
		if(empty($category_slug) || empty($product_slug) || empty($model_slug))
			show_404();
		
		$product=$this->product_model->get_product_by_slug($product_slug,$model_slug,$category_slug);
		if(empty($product))
			show_404();
		
		$args['product']=$product;
		
		if(!empty($category_id))
			$args['category']=$this->catalog_model->get_category_by_id($category_id);
		else
			$args['category']=$this->catalog_model->get_category_by_slug($category_slug);
		
		if(!empty($model_id))
			$args['model']=$this->catalog_model->get_model_by_id($model_id);
		else
			$args['model']=$this->catalog_model->get_model_by_slug($model_slug);
		
		if(!empty($provider_id))
			$args['provider_id']=$provider_id;
		else
			$args['provider_id']=0;
		
		$providers=$this->catalog_model->get_providers_by_model_id($args['model']->model_id);
		$args['need_provider']=count($providers);
		
		
		$this->load->view('common/header');
		$this->load->view('product/product',$args);
		$this->load->view('common/footer'); 
	}
	
	public function ajax_load_providers(){
		$data=$this->input->post('data');
		parse_str($data, $params);
		$model_id=$params['model_id'];
		$model=$this->catalog_model->get_model_by_id($model_id);
		
		$providers=$this->catalog_model->get_providers_by_model_id($model_id);
		
		$args['params']=$params;
		$args['providers']=$providers;
		$args['model_id']=$model_id;
		
		echo $this->load->view('product/product_provider',$args,TRUE);
		die;
	}
	public function ajax_load_login(){
		echo $this->load->view('ajax_login','',TRUE);
		die;
	}
	public function ajax_load_registration(){
		echo $this->load->view('ajax_register','',TRUE);
		
		die;
	}
	public function ajax_load_after_login(){
		$data=$this->input->post('data');
		parse_str($data, $params);	
		
		$this->load->model('product_model');
		$product=$this->product_model->get_product_by_id($params['product_id']);
		
		
		$this->load->library('cart');
		
		$price=0;
		switch($params['condition']){
			case 'flawless':
				$price=$product->flawless_price;
				break;
			case 'good':
				$price=$product->good_price;
				break;
			case 'broken':
				$price=$product->broken_price;				
				break;			
		}		
		
		$insert_new = TRUE;
		$bag = $this->cart->contents();
		foreach ($bag as $item) {			
			// check product id in session, if exist update the quantity
			if ( $item['id'] == $product->product_id ) { // Set value to your variable
				$cart_data =  array(
					'rowid'=>$item['rowid'],
					'qty'     => 1,
					'price'   => $price,
					'name'    => $product->product_name,
					'options' =>array('condition'=>$params['condition'],'provider_id'=>$params['provider_id'])
				);
				$this->cart->update($cart_data);
				$insert_new = FALSE;
				break;
			}

		}
		// if $insert_new value is true, insert the item as new item in the cart
		if ($insert_new) {
			$cart_data =  array(
					'id'=>$product->product_id,
					'qty'     => 1,
					'price'   => $price,
					'name'    => $product->product_name,
					'options' =>array('condition'=>$params['condition'],'provider_id'=>$params['provider_id'])//add category,model if necessary
				);
			$this->cart->insert($cart_data);

		}
		$items=$this->cart->contents();
		$args['items']=$items;
		echo $this->load->view('product/cart',$args,TRUE);
		die;
	}
	
	public function delete_cart_item(){
		$rowid=$this->input->post('rowid');
		$this->cart->remove($rowid);
		$items=$this->cart->total_items();
		if(empty($items))
			echo 'No items in cart';
		die;
	}
	
	
}
