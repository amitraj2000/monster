<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	
	public function index()
	{
		$args=array();
		$this->load->library('pagination');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		$args['title']='All orders';	
		$args['active_menu']='orders';
		
		$limit=10;
		$total_orders=$this->order_model->get_total_orders();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$orders=$this->order_model->get_orders(array('limit'=>$limit,'start_index'=>$start_index));
		
		
		$config['base_url'] = base_url() . 'orders/page/';
		$config['total_rows'] = $total_orders;
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<ul class="pagination" style="margin-top:0px;">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="paginate_button">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button previous">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_tag_open'] = '<li class="paginate_button last">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="paginate_button last">';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$args['orders']=$orders;
		
		$args['pagination']= $this->pagination->create_links();
		$args['pagination_text']="Showing ".($start_index+1)." to ".($start_index+$limit)." of ".$total_orders." entries";
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('order/orders',$args);
		$this->load->view('common/footer',$args);
	}
	
	public function delete_order($order_id)
	{
		$this->order_model->delete_order($order_id);
		redirect('/orders');
		die;
	}
	
	public function edit_order($order_id)
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Edit order';	
		$args['active_menu']='orders';
		$this->load->helper('download');
		
		$order=$this->order_model->get_order_by_id($order_id);
		
		
		if(empty($order))
		{
			redirect('/orders');
		}
		
		$order_items=$this->order_model->get_order_items_by_id($order_id);
		
		/* if(!empty($order)){
			$args['order']=array(
				'user_id'=>$user->user_id,
				'first_name'  => $user->first_name,
				'last_name'  => $user->last_name,
				'email'  => $user->email,
				'role'  => $user->role,
			);
		} */
		
				
		//Process form submit
		//if($this->input->post('submit')){
		if(isset($_POST['submit'])){
			$order_status=$this->input->post('order_status');
			 $form_data = array(
					'order_status'  => $order_status
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			$this->order_model->update_order($order_id,array('status'=>$order_status));
			$this->session->set_flashdata('success_msg', 'Order updated successfully');
			redirect('order/edit/'.$order_id);
			die;
		}
		if($this->input->post('create_label'))
		{
				$shipping_address=unserialize($order->shipping_address);			
				$url='https://returns.usps.com/Services/ExternalCreateReturnLabel.svc/ExternalCreateReturnLabel?externalReturnLabelRequest=<ExternalReturnLabelRequest><CustomerName>'.urlencode($shipping_address['first_name'].' '.$shipping_address['last_name']).'</CustomerName><CustomerAddress1>'.urlencode($shipping_address['shipping_address_1']).'</CustomerAddress1><CustomerAddress2>'.urlencode($shipping_address['shipping_address_2']).'</CustomerAddress2><CustomerCity>'.urlencode($shipping_address['city']).'</CustomerCity><CustomerState>'.urlencode($shipping_address['province']).'</CustomerState><CustomerZipCode>'.urlencode($shipping_address['zip_code']).'</CustomerZipCode><MerchantAccountID>'.$this->config->item('usps_merchant_account_id').'</MerchantAccountID><MID>'.$this->config->item('usps_mid').'</MID><CompanyName>'.urlencode('Monsterbuyback').'</CompanyName><BlankCustomerAddress>false</BlankCustomerAddress><LabelFormat></LabelFormat><LabelDefinition>4X6</LabelDefinition><ServiceTypeCode>020</ServiceTypeCode><MerchandiseDescription></MerchandiseDescription><InsuranceAmount></InsuranceAmount><AddressOverrideNotification>false</AddressOverrideNotification><PackageInformation>'.urlencode($order_id).'</PackageInformation><PackageInformation2></PackageInformation2><CallCenterOrSelfService>Customer</CallCenterOrSelfService><CompanyName></CompanyName><Attention></Attention><SenderName></SenderName><SenderEmail></SenderEmail><RecipientName></RecipientName><RecipientEmail></RecipientEmail><RecipientBcc></RecipientBcc></ExternalReturnLabelRequest>';
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
					
					$this->order_model->update_order($order_id,array('usps_tracking_id'=>$tracking_number));
					
					if(!is_dir(LABELS.$order_id))
						mkdir(LABELS.$order_id);
					
					$filename=LABELS.$order_id.'/label.pdf';					
					$fp = fopen($filename, 'wb');
					fwrite($fp, $label);
					fclose($fp);
					force_download($filename, NULL);
					
				}
		}
		
		/* $form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['user']=$form_data;
		} */ 
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
		$args['order']=$order;
		$args['order_items']=$order_items;
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('order/edit_order',$args);
		$this->load->view('common/footer',$args);
	}
}
