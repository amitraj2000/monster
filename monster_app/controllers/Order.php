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
		
		if($this->input->post('submit_step_3'))
		{
			$pending_order=$this->order_model->get_current_user_pending_order();	
			$args['status']='2';
			$args['shipping_type']=$this->input->post('shipping_type');
			$this->order_model->update_order($pending_order->order_id,$args);
			redirect('/thankyou');
			die;
		}
		
		$args=array();
		$args['header_title']='Payment Carrier';
		$this->load->model('product_model');
		add_footer_js(array(22=>'jquery-ui.min.js',25=>'cart.js'));
		$items=$this->order_model->get_orders(array('status'=>'1'));
		$args['items']=$items;
		
		$this->load->view('common/header',$args);
		$this->load->view('order/payment_carrier',$args);		
		$this->load->view('common/footer');
	}
	
	public function checkout_step_1()
	{
		$payment_type=$this->input->post('payment_type');
		$output=array('error'=>true,'msg'=>'','content'=>'');
		$args=array(
					'payment_type'=>$payment_type,
				);
		if($payment_type=='paypal')
		{
			$paypal_email=$this->input->post('paypal_email');
			$confirm_paypal_email=$this->input->post('confirm_paypal_email');
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
				$pending_order=$this->order_model->get_current_user_pending_order();	
				$gateway_details_arr=array('paypal_email'=>$paypal_email);
				$args['gateway_details']=serialize($gateway_details_arr);
				$this->order_model->update_order($pending_order->order_id,$args);
				$output['error']=false;				
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
			/* elseif(empty($province))
			{
				$output['msg']='Please select province';
			} */
			elseif(empty($zip_code))
			{
				$output['msg']='Please enter zip code';
			}
			else{
				$pending_order=$this->order_model->get_current_user_pending_order();	
				$gateway_details_arr=array('payable_to'=>$payable_to,'address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'zip_code'=>$zip_code);
				$args['gateway_details']=serialize($gateway_details_arr);
				$this->order_model->update_order($pending_order->order_id,$args);
				$output['error']=false;				
			}
		}
		$items=$this->order_model->get_orders(array('status'=>'1'));//show only pending orders as cart items
		
		$args['items']=$items;
		$output['content']= $this->load->view('order/checkout_step_2',$args,TRUE);
		echo json_encode($output);
		die;
	}
	
	public function checkout_step_2(){
		$output=array('error'=>true,'msg'=>'','content'=>'');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$address_1=$this->input->post('address_1');
		$address_2=$this->input->post('address_2');
		$city=$this->input->post('city');
		$province=$this->input->post('province');
		$zip_code=$this->input->post('zip_code');
		$phone_number=$this->input->post('phone_number');
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
		/* else if(empty($province)){
			$output['msg']='Please select province';
		} */
		else if(empty($zip_code)){
			$output['msg']='Please enter zip code';
		}
		/* else{//validate zip code and address with usps here
			
		} */
		else{
			$pending_order=$this->order_model->get_current_user_pending_order();	
			$shipping_arr=array('first_name'=>$first_name,'last_name'=>$last_name,'address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code,'phone_number'=>$phone_number);
			$args['shipping_address']=serialize($shipping_arr);
			$this->order_model->update_order($pending_order->order_id,$args);
			$output['error']=false;	
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
