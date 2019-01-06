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
		
		add_footer_js(array(21=>'easy-responsive-tabs.js',22=>'jquery-ui.min.js',23=>'product.js',25=>'cart.js'));
		$args['header_title']=$product->model_name.'&nbsp;'.$product->product_name;
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
		
		$this->load->view('common/header',$args);
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
	public function ajax_load_email(){
		echo $this->load->view('ajax_email','',TRUE);
		die;
	}
	public function ajax_load_cart(){
		$data=$this->input->post('data');
		parse_str($data, $params);
		//$this->load->library('cart');
		
		$product=$this->product_model->get_product_by_id($params['product_id']);
		if(!empty($product->has_variation)){
		$variations=$this->product_model->get_product_variation_by_id($params['product_id'],$params['provider_id']);
		}
		
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
		
		$cart_email=is_logged_in()?get_current_user_email():$this->session->userdata('quick_email');
		$cart=$this->order_model->get_cart($cart_email);
		
		
		if(!empty($cart)){//add item to an existing cart
			$items=!empty($cart->content)?unserialize($cart->content):array();			
			rsort($items);
			$product_ids=array_column($items, 'id');			
			if(!in_array($params['product_id'],$product_ids)){						
				$cart_item_key=time();
				$items[$cart_item_key]= array(
						'id'      => $params['product_id'],
						'qty'     => 1,
						'price'   => $price,
						'name'    => $product->product_name,
						'options' => array('condition' =>$params['condition'], 'provider_id' => $params['provider_id'])
				);
				$this->order_model->update_cart_item($cart->cart_id,array('content'=>serialize($items)));
			}
		}else{//insert to cart
			$dt = date("Y-m-d");
			$expires_on=date( "Y-m-d H:i:s", strtotime( "$dt +2 day" ) );
			$cart_item_key=time();
			$items[$cart_item_key]= array(
					'id'      => $params['product_id'],
					'qty'     => 1,
					'price'   => $price,
					'name'    => $product->product_name,
					'options' => array('condition' =>$params['condition'], 'provider_id' => $params['provider_id'])
			);
			$data=array(
				'cart_id'=>random_string('alnum',5).time(),
				'email'=>$cart_email,
				'content'=>serialize($items),
				'expires_on'=>$expires_on,
				'date'=>date( "Y-m-d H:i:s")
			);
			$this->order_model->insert_into_cart($data);
		}
		
		$cart=$this->order_model->get_cart($cart_email);
		$args['items']=!empty($cart->content)?unserialize($cart->content):array();
		rsort($args['items']);
		$args['cart_id']=!empty($cart->cart_id)?$cart->cart_id:'';
		echo $this->load->view('order/cart',$args,TRUE);
		die;
	}
	public function ajax_load_after_login(){
		$data=$this->input->post('data');
		parse_str($data, $params);	
		
		/* $this->load->model('product_model');
		$product=$this->product_model->get_product_by_id($params['product_id']);
		if(!empty($product->has_variation)){
		$variations=$this->product_model->get_product_variation_by_id($params['product_id'],$params['provider_id']);
		}
		
		
		
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
		
		
			
		//insert to order table if logged in
		if(is_logged_in()){
			$pending_order=$this->order_model->get_current_user_pending_order();	
			if(empty($pending_order->box_id)){
				$box_id='MS'.random_string('nozero',10);
				$order_id=random_string('alnum',16);			
				$args=array(
					'order_id'=>$order_id,
					'user_id'=>get_current_user_id(),
					'box_id'=>$box_id,
					'date'=>date('Y-m-d H:i:s'),				
					'status'=>'1'
				);
				$this->order_model->insert_order($args);
			}else{
				$order_id=$pending_order->order_id;
			}
			
			
			$args=array(
				'order_details_id'=>random_string('alnum',16),
				'order_id'=>$order_id,
				'product_id'=>$product->product_id,
				'product_condition'=>$params['condition'],
				'price'=>$price,
				'provider_id'=>$params['provider_id'],
				'date'=>date('Y-m-d H:i:s'),
			);
			$this->order_model->insert_order_details($args);
		}

		$items=$this->order_model->get_orders(array('status'=>'1'));//show only pending orders as cart items
		
		$args['items']=$items;
		echo $this->load->view('order/cart',$args,TRUE); */
		die;
	}
	
	public function delete_cart_item(){
		$rowid=$this->input->post('rowid');
		$cartid=$this->input->post('cartid');
		//$this->load->library('cart');
		$cart=$this->order_model->get_cart_by_id($cartid);
		$items=!empty($cart->content)?unserialize($cart->content):array();
		if(!empty($cart) && array_key_exists($rowid,$items))
		{
			unset($items[$rowid]);
			$this->order_model->update_cart_item($cart->cart_id,array('content'=>serialize($items)));
		}

       //$this->cart->update($data);
		$cart=$this->order_model->get_cart_by_id($cartid);
		$output=array('no_item'=>'','total_price'=>'');
		$items=!empty($cart->content)?unserialize($cart->content):array();;
		if(empty($items)){
			$output['no_item']= 'No items in cart';
		}else if(!empty($items)){
			$total_price=0;
			foreach($items as $item){
				$total_price+=$item['price'];
			}
			$output['total_price']='<strong>Total</strong>: $'.$total_price;
		}
		echo json_encode($output);
		die;
	}
	
	
	
}
