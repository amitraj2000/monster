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
		
		
		$order=$this->order_model->get_order_by_id($order_id);
		
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
		$args=array();
		$args['header_title']='Payment Carrier';
		$this->load->model('product_model');
		add_footer_js(array(25=>'cart.js'));
		$items=$this->order_model->get_orders(array('status'=>'1'));
		$args['items']=$items;
		
		$this->load->view('common/header',$args);
		$this->load->view('product/cart',$args);		
		$this->load->view('common/footer');
	}
	
	
			
}
