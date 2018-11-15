<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function index($category_slug,$product_slug,$model_slug)
	{
		/*populate post value from home page*/
		$category_id=$this->input->post('category_id');
		$model_id=$this->input->post('model_id');
		$provider_id=$this->input->post('provider_id');
		/*populate post value from home page*/
		
		$this->load->model('product_model');
		$args=array();
		
		
		if(empty($category_slug) || empty($product_slug) || empty($model_slug))
			show_404();
		
		$product=$this->product_model->get_product_by_slug($product_slug,$model_slug,$category_slug);
		if(empty($product))
			show_404();
		
		add_footer_js(array('easy-responsive-tabs.js','jquery-ui.min.js','product.js'));
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
			$args['provider_id']='';
		
		
		$args['need_provider']=false;
		if(!empty($product->has_variation) && !empty($provider_id)){
			$variations=$this->product_model->get_product_variation_by_id($product->product_id,$provider_id);
			$args['variations']=$variations;
		}
		else if(!empty($product->has_variation) && empty($provider_id)){
			$providers=$this->product_model->get_products_associated_provider_id($product->product_id);
			$args['providers']=$providers;
			$args['need_provider']=true;
		}
		
		//$providers=$this->catalog_model->get_providers_by_model_id($args['model']->model_id);
		
		$this->load->view('common/header');
		$this->load->view('product/product',$args);
		$this->load->view('common/footer'); 
	}
	public function ajax_load_variation_price(){
		$this->load->model('product_model');
		$product_id=$this->input->post('product_id');
		$provider_id=$this->input->post('provider_id');
		$variations=$this->product_model->get_product_variation_by_id($product_id,$provider_id);
		$output=array();
		$output['flawless_price']=$variations->flawless_price;
		$output['good_price']=$variations->good_price;
		$output['broken_price']=$variations->broken_price;
		echo json_encode($output);
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
		if(!empty($product->has_variation)){
		$variations=$this->product_model->get_product_variation_by_id($params['product_id'],$params['provider_id']);
		}
		
		$this->load->library('cart');
		
		$price=0;
		switch($params['condition']){
			case 'flawless':
				if(!empty($product->has_variation) && !empty($variations->flawless_price))
				$price=$variations->flawless_price;
				else
				$price=$product->flawless_price;
				break;
			case 'good':
				if(!empty($product->has_variation) && !empty($variations->good_price))
				$price=$variations->good_price;
				else
				$price=$product->good_price;
				break;
			case 'broken':
				if(!empty($product->has_variation) && !empty($variations->broken_price))
				$price=$variations->broken_price;
				else
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
