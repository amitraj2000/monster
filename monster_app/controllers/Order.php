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
		
		
		$order=$this->order_model->get_cart_by_id($order_id);
		
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
	
	public function payment_carrier(){
		if(!is_logged_in())
			redirect('/register');
		
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
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
			//rsort($items);
			
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
					'usps_tracking_id'=>'',
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
				
				
				/*USPS Label creation*/
				/* $url='https://returns.usps.com/Services/ExternalCreateReturnLabel.svc/ExternalCreateReturnLabel?externalReturnLabelRequest=<ExternalReturnLabelRequest>';
				$url.='<CustomerName>'.urlencode($shipping_first_name.' '.$shipping_last_name).'</CustomerName>'.
				$url.='<CustomerAddress1>'.urlencode($shipping_address_1).'</CustomerAddress1>';
				$url.='<CustomerAddress2>'.urlencode($shipping_address_2).'</CustomerAddress2>';
				$url.='<CustomerCity>'.urlencode($shipping_city).'</CustomerCity>';
				$url.='<CustomerState>'.urlencode($shipping_province).'</CustomerState>';
				$url.='<CustomerZipCode>'.urlencode($shipping_zip_code).'</CustomerZipCode>';
				$url.='<MerchantAccountID>'.$this->config->item('usps_merchant_account_id').'</MerchantAccountID>';
				$url.='<MID>'.$this->config->item('usps_mid').'</MID>';
				$url.='<CompanyName>'.urlencode('Monsterbuyback').'</CompanyName>';
				//$url.='<BlankCustomerAddress>true</BlankCustomerAddress>';
				$url.='<LabelFormat></LabelFormat>';
				$url.='<LabelDefinition>4X6</LabelDefinition>';
				$url.='<ServiceTypeCode>020</ServiceTypeCode>';
				$url.='<MerchandiseDescription></MerchandiseDescription>';
				$url.='<InsuranceAmount></InsuranceAmount>';
				$url.='<AddressOverrideNotification>false</AddressOverrideNotification>';
				$url.='<PackageInformation></PackageInformation>';
				$url.='<PackageInformation2></PackageInformation2>';
				$url.='<CallCenterOrSelfService>Customer</CallCenterOrSelfService>';
				$url.='<CompanyName></CompanyName>';
				$url.='<Attention></Attention>';
				$url.='<SenderName></SenderName>';
				$url.='<SenderEmail></SenderEmail>';
				$url.='<RecipientName></RecipientName>';
				$url.='<RecipientEmail></RecipientEmail>';
				$url.='<RecipientBcc></RecipientBcc>';
				$url.='</ExternalReturnLabelRequest>'; */
				
				//<BlankCustomerAddress> should be false or removed
				$url='https://returns.usps.com/Services/ExternalCreateReturnLabel.svc/ExternalCreateReturnLabel?externalReturnLabelRequest=<ExternalReturnLabelRequest><CustomerName>'.urlencode($shipping_first_name.' '.$shipping_last_name).'</CustomerName><CustomerAddress1>'.urlencode($shipping_address_1).'</CustomerAddress1><CustomerAddress2>'.urlencode($shipping_address_2).'</CustomerAddress2><CustomerCity>'.urlencode($shipping_city).'</CustomerCity><CustomerState>MA</CustomerState><CustomerZipCode>'.urlencode($shipping_zip_code).'</CustomerZipCode><MerchantAccountID>'.$this->config->item('usps_merchant_account_id').'</MerchantAccountID><MID>'.$this->config->item('usps_mid').'</MID><CompanyName>'.urlencode('Monsterbuyback').'</CompanyName><BlankCustomerAddress>false</BlankCustomerAddress><LabelFormat></LabelFormat><LabelDefinition>4X6</LabelDefinition><ServiceTypeCode>020</ServiceTypeCode><MerchandiseDescription></MerchandiseDescription><InsuranceAmount></InsuranceAmount><AddressOverrideNotification>false</AddressOverrideNotification><PackageInformation>'.urlencode($order_id).'</PackageInformation><PackageInformation2></PackageInformation2><CallCenterOrSelfService>Customer</CallCenterOrSelfService><CompanyName></CompanyName><Attention></Attention><SenderName></SenderName><SenderEmail></SenderEmail><RecipientName></RecipientName><RecipientEmail></RecipientEmail><RecipientBcc></RecipientBcc></ExternalReturnLabelRequest>';
				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL, $url);
				curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 30);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 60);
				curl_setopt($ch2, CURLOPT_FRESH_CONNECT,1);
				curl_setopt($ch2, CURLOPT_PORT, 443);
				curl_setopt($ch2, CURLOPT_USERAGENT,'usps-php');
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST,2);
				
				$contents = curl_exec($ch2);
				if (curl_error($ch2)) {
					$error_msg = curl_error($ch2);					
				}				
				$curl_info=curl_getinfo($ch2);
								
				curl_close($ch2);
				if(!isset($error_msg) && !empty($contents) && $curl_info['http_code']==200){
					$contents = simplexml_load_string($contents);
					$label=base64_decode($contents->ReturnLabel);
					$tracking_number=$contents->TrackingNumber;
					$postal_routing=$contents->PostalRouting;
					
					//Update tracking id in database with order id
					$this->order_model->update_order($order_id,array('usps_tracking_id'=>$tracking_number));
					
					if(!is_dir(LABELS.$order_id))
						mkdir(LABELS.$order_id);
					
					$filename=LABELS.$order_id.'/label.pdf';					
					$fp = fopen($filename, 'wb');
					fwrite($fp, $label);
					fclose($fp);
					
					/*USPS Label creation*/
				
				}
				
				//send confirmation mail to user
				
				$this->email->from('your@example.com', 'Your Name');
				$this->email->to(get_current_user_email());
				$this->email->subject('Order Confirmation');
				$message='Thanks for your order.Your order ID is - '.$order_id;
				if(!empty($tracking_number))
				$message.='Your USPS Tracking ID is - '.$tracking_number;
				$this->email->message($message);
				if(file_exists(LABELS.$order_id.'/label.pdf'))//attach file if exists
				$this->email->attach(LABELS.$order_id.'/label.pdf');
			
				$this->email->send();
				
			}
			
			$this->order_model->destroy_cart($cart->cart_id);
			redirect('/thankyou');
			die;
		}
		
		$args=array();
		$args['header_title']='Payment Carrier';
		$this->load->model('product_model');
		add_footer_js(array(22=>'jquery-ui.min.js',25=>'cart.js'));
		
		$cart=$this->order_model->get_cart();
		$args['items']=!empty($cart->content)?unserialize($cart->content):array();
		//rsort($args['items']);
		$args['cart_id']=!empty($cart->cart_id)?$cart->cart_id:'';
		
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
		$form_data=array();
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
			
			$address_arr=array('address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code);
			$valid_address=validate_address($address_arr);
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
			else if(!$valid_address)
			{
				$output['msg']='It is not a valid address';
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
					'address_1'=>$valid_address['Address2'],//$address_1,
					'address_2'=>$address_2,
					'city'=>$valid_address['City'],//city,
					'province'=>$valid_address['State'],//$province,
					'zip_code'=>$valid_address['Zip5'],//$zip_code,
				);
			}
		}
		if(empty($output['error'])){
			$this->session->set_userdata('cart_data',$form_data);
			$cart_email=is_logged_in()?get_current_user_email():$this->session->userdata('quick_email');
			$cart=$this->order_model->get_cart($cart_email);
			$args['items']=!empty($cart->content)?unserialize($cart->content):array();//$this->cart->contents();
			//rsort($args['items']);
			$args['cart_id']=!empty($cart->cart_id)?$cart->cart_id:'';
			$output['content']= $this->load->view('order/checkout_step_2',$args,TRUE);
		}
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
		$address_arr=array('address_1'=>$address_1,'address_2'=>$address_2,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code);
		$valid_address=validate_address($address_arr);
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
		else if(!$valid_address)
		{
			$output['msg']='It is not a valid address';
		}
		else if(empty($cart_items)){
			$output['msg']='Your cart is empty';
		} 
		else{
			$output['error']=false;	
			$shipping_data=array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'address_1'=>$valid_address['Address2'],//$address_1,
					'address_2'=>$address_2,
					'city'=>$valid_address['City'],//city,
					'province'=>$valid_address['State'],//$province,
					'zip_code'=>$valid_address['Zip5'],//$zip_code,
					'phone_number'=>$phone_number
				);
			$this->session->set_userdata('shipping_data',$shipping_data);
			$args=array();
			$output['content']= $this->load->view('order/checkout_step_3',$args,TRUE);
		}
		
		
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
	
	public function track_order()
	{
		if(!is_logged_in())
			redirect('/register');
		
		$args=array();
		$args['header_title']='Thank you for order';
		
		$this->load->view('common/header',$args);
		$this->load->view('order/thankyou',$args);		
		$this->load->view('common/footer');
		
	}
	
	function usps_test()
	{
		$url='https://returns.usps.com/Services/ExternalCreateReturnLabel.svc/ExternalCreateReturnLabel?externalReturnLabelRequest=<ExternalReturnLabelRequest><CustomerName>Abhishek</CustomerName><CustomerAddress1>'.urlencode('777 Brockton Avenue').'</CustomerAddress1><CustomerAddress2></CustomerAddress2><CustomerCity>Abington</CustomerCity><CustomerState>MA</CustomerState><CustomerZipCode>2351</CustomerZipCode><MerchantAccountID>8544</MerchantAccountID><MID>902052109</MID><CompanyName></CompanyName><BlankCustomerAddress>false</BlankCustomerAddress><LabelFormat></LabelFormat><LabelDefinition>4X6</LabelDefinition><ServiceTypeCode>020</ServiceTypeCode><MerchandiseDescription></MerchandiseDescription><InsuranceAmount></InsuranceAmount><AddressOverrideNotification>false</AddressOverrideNotification><PackageInformation></PackageInformation><PackageInformation2></PackageInformation2><CallCenterOrSelfService>Customer</CallCenterOrSelfService><CompanyName></CompanyName><Attention></Attention><SenderName></SenderName><SenderEmail></SenderEmail><RecipientName></RecipientName><RecipientEmail></RecipientEmail><RecipientBcc></RecipientBcc></ExternalReturnLabelRequest>';

				$ch2 = curl_init();
				curl_setopt($ch2, CURLOPT_URL, $url);
				curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 30);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch2, CURLOPT_TIMEOUT, 60);
				curl_setopt($ch2, CURLOPT_FRESH_CONNECT,1);
				curl_setopt($ch2, CURLOPT_PORT, 443);
				curl_setopt($ch2, CURLOPT_USERAGENT,'usps-php');
				curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST,2);
				
				$contents = curl_exec($ch2);
				if (curl_error($ch2)) {
					$error_msg = curl_error($ch2);					
				}				
				$curl_info=curl_getinfo($ch2);
					print_r($curl_info);			
				curl_close($ch2);
				
				
				$contents = simplexml_load_string($contents);
					$label=base64_decode($contents->ReturnLabel);
										
					$filename=UPLOADS.'/label.pdf';					
					$fp = fopen($filename, 'wb');
					fwrite($fp, $label);
					fclose($fp);
		
	}
	
			
}
