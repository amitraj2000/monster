<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	
	public function order_details($order_id)
	{
		if(!is_logged_in())
			redirect('/register');
		$args=array();
		$this->load->model('product_model');
		$args['header_title']='Order Details';
		
		
		$order=$this->order_model->get_order_details_by_id($order_id);
		
		if(empty($order))
		{
			redirect('/account-summary/summary/');
		}
		
		$args['order']=$order;
		
		//$product=$this->product_model->get_product_by_id($order->product_id);

		$args['order']=$order;
		
		$this->load->view('common/header',$args);
		$this->load->view('order/details',$args);		
		$this->load->view('common/footer');
	}
	
	public function paymant_carrier(){
		if(!is_logged_in())
			redirect('/register');
		//$this->load->library('cart');
		
		
		if($this->input->post('final_submit'))
		{
			
			$shipping_type=$this->input->post('shipping_type');
			$payment_type=$this->input->post('payment_type');
			if($payment_type=='cheque')
			{
				$payable_to=$this->input->post('payable_to');
				$address_1=$this->input->post('address_1');
				$address_2=$this->input->post('address_2');
				$city=$this->input->post('city');
				$province=$this->input->post('province');
				$zip_code=$this->input->post('zip_code');
				$gateway_details_arr=array('payable_to'=>$payable_to,'address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code);
			}else if($payment_type=='paypal'){
				$paypal_email=$this->input->post('paypal_email');
				$gateway_details_arr=array('paypal_email'=>$paypal_email);
			}			
			$shipping_first_name=$this->input->post('shipping_first_name');
			$shipping_last_name=$this->input->post('shipping_last_name');
			$shipping_address_1=$this->input->post('shipping_address_1');
			$shipping_address_2=$this->input->post('shipping_address_2');
			$shipping_city=$this->input->post('shipping_city');
			$shipping_province=$this->input->post('shipping_province');
			$shipping_zip_code=$this->input->post('shipping_zip_code');
			$shipping_phone_number=$this->input->post('shipping_phone_number');
			$shipping_arr=array('first_name'=>$shipping_first_name,'last_name'=>$shipping_last_name,'shipping_address_1'=>$shipping_address_1,'shipping_address_2'=>$shipping_address_2,'city'=>$shipping_city,'province'=>$shipping_province,'zip_code'=>$shipping_zip_code,'phone_number'=>$shipping_phone_number);
			/*Validation here if necessary*/
			
			/*Validation here if necessary*/
			//Unset cart and shipping data
			$this->session->unset_userdata('cart_data');
			$this->session->unset_userdata('shipping_data');
			
			$cart_email=is_logged_in()?get_current_user_email():$this->session->userdata('quick_email');
			$cart=$this->order_model->get_cart($cart_email);
			
			$items=!empty($cart->content)?unserialize($cart->content):array();//$this->cart->contents();
			rsort($items);
			if(!empty($items))//if cart is not empty
			{
				
				//insert orders
				$box_id='MS'.random_string('nozero',10);
				$order_id=random_string('alnum',5).time();			
				$args=array(
					'order_id'=>$order_id,
					'user_id'=>get_current_user_id(),
					'box_id'=>$box_id,
					'date'=>date('Y-m-d H:i:s'),
					'payment_type'=>$payment_type,
					'gateway_details'=>serialize($gateway_details_arr),
					'shipping_address'=>serialize($shipping_arr),
					'shipping_type'=>$shipping_type,
					'status'=>'2'
				);
				$this->order_model->insert_order($args);
				
				foreach($items as $item){
					$args=array(
						'order_details_id'=>random_string('alnum',5).time(),
						'order_id'=>$order_id,
						'product_id'=>$item['id'],
						'product_condition'=>$item['options']['condition'],
						'price'=>$item['price'],
						'provider_id'=>$item['options']['provider_id'],
						'date'=>date('Y-m-d H:i:s'),
					);
					$this->order_model->insert_order_details($args);
				}
				$this->order_model->destroy_cart($cart->cart_id);
			}
			
			//$this->cart->destroy();
			redirect('/thankyou');
			die;
		}
		
		$args=array();
		$args['header_title']='Payment Carrier';
		$this->load->model('product_model');
		add_footer_js(array(22=>'jquery-ui.min.js',25=>'cart.js'));
		
		//$args['items']=$this->cart->contents();;
		
		$this->load->view('common/header',$args);
		$this->load->view('order/payment_carrier',$args);		
		$this->load->view('common/footer');
	}
	
	public function checkout_step_1()
	{
		$payment_type=$this->input->post('payment_type');
		//$this->load->library('cart');
		$output=array('error'=>true,'msg'=>'','content'=>'');
		$args=array(
					'payment_type'=>$payment_type,
				);
		if($payment_type=='paypal')
		{
			$paypal_email=$this->input->post('paypal_email');
			$confirm_paypal_email=$this->input->post('confirm_paypal_email');
			$form_data=array();
			if(empty($paypal_email) || !valid_email($paypal_email))
			{
				$output['msg']='Please enter valid email';
			}
			elseif(empty($confirm_paypal_email))
			{
				$output['msg']='Please confirm email';
			}
			elseif($paypal_email!=$confirm_paypal_email)
			{
				$output['msg']='Email does not matches';
			}
			else{
				/* $pending_order=$this->order_model->get_current_user_pending_order();	
				$gateway_details_arr=array('paypal_email'=>$paypal_email);
				$args['gateway_details']=serialize($gateway_details_arr);
				$this->order_model->update_order($pending_order->order_id,$args); */
				$output['error']=false;
				$form_data=array(
					'payment_type'=>'paypal',
					'paypal_email'=>$paypal_email
				);
			}
		}
		else if($payment_type=='cheque')
		{
			$payable_to=$this->input->post('payable_to');
			$address_1=$this->input->post('address_1');
			$address_2=$this->input->post('address_2');
			$city=$this->input->post('city');
			$province=$this->input->post('province');
			$zip_code=$this->input->post('zip_code');
			
			$address_arr=validate_address(array('address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code));
			print_r();die;
			if(empty($payable_to))
			{
				$output['msg']='Please enter name';
			}
			elseif(empty($address_1))
			{
				$output['msg']='Please enter address';
			}
			elseif(empty($city))
			{
				$output['msg']='Please enter city';
			}
			elseif(empty($province))
			{
				$output['msg']='Please select province';
			} 
			elseif(empty($zip_code))
			{
				$output['msg']='Please enter zip code';
			}
			else if(!validate_address($address_arr))
			{
				
			}
			else{
				/* $pending_order=$this->order_model->get_current_user_pending_order();	
				$gateway_details_arr=array('payable_to'=>$payable_to,'address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'zip_code'=>$zip_code);
				$args['gateway_details']=serialize($gateway_details_arr);
				$this->order_model->update_order($pending_order->order_id,$args); */
				$output['error']=false;	
				$form_data=array(
					'payment_type'=>'cheque',
					'payable_to'=>$payable_to,
					'address_1'=>$address_1,
					'address_2'=>$address_2,
					'city'=>$city,
					'province'=>$province,
					'zip_code'=>$zip_code
				);
			}
		}
		
		$this->session->set_userdata('cart_data',$form_data);
		$cart_email=is_logged_in()?get_current_user_email():$this->session->userdata('quick_email');
		$cart=$this->order_model->get_cart($cart_email);
		$args['items']=!empty($cart->content)?unserialize($cart->content):array();//$this->cart->contents();
		rsort($args['items']);
		$args['cart_id']=!empty($cart->cart_id)?$cart->cart_id:'';
		$output['content']= $this->load->view('order/checkout_step_2',$args,TRUE);
		
		echo json_encode($output);
		die;
	}
	
	public function checkout_step_2(){
		$this->load->library('cart');
		$output=array('error'=>true,'msg'=>'','content'=>'');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$address_1=$this->input->post('address_1');
		$address_2=$this->input->post('address_2');
		$city=$this->input->post('city');
		$province=$this->input->post('province');
		$zip_code=$this->input->post('zip_code');
		$phone_number=$this->input->post('phone_number');
		$cart_email=is_logged_in()?get_current_user_email():$this->session->userdata('quick_email');
		$cart=$this->order_model->get_cart($cart_email);
		$cart_items=!empty($cart->content)?unserialize($cart->content):array();
		if(empty($first_name)){
			$output['msg']='Please enter first name';
		}
		else if(empty($last_name)){
			$output['msg']='Please enter last name';
		}
		else if(empty($address_1)){
			$output['msg']='Please enter address';
		}
		else if(empty($city)){
			$output['msg']='Please enter city';
		}
		else if(empty($province)){
			$output['msg']='Please select province';
		}
		else if(empty($zip_code)){
			$output['msg']='Please enter zip code';
		}
		/* else{//validate zip code and address with usps here
			
		}*/else if(empty($cart_items)){
			$output['msg']='Your cart is empty';
		} 
		else{
			$output['error']=false;	
			$shipping_data=array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'address_1'=>$address_1,
					'address_2'=>$address_2,
					'city'=>$city,
					'province'=>$province,
					'zip_code'=>$zip_code,
					'phone_number'=>$phone_number
				);
			$this->session->set_userdata('shipping_data',$shipping_data);
			
		}
		
		$args=array();
		$output['content']= $this->load->view('order/checkout_step_3',$args,TRUE);
		echo json_encode($output);
		die;
	}
	
	public function order_thanks()
	{
		if(!is_logged_in())
			redirect('/register');
		
		$args=array();
		$args['header_title']='Thank you for order';
		
		$this->load->view('common/header',$args);
		$this->load->view('order/thankyou',$args);		
		$this->load->view('common/footer');
		
	}
	
	
			
}
