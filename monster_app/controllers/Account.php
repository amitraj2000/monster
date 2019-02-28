<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function index()
	{
		if(!is_logged_in())
			redirect('/register');
		$args=array();
		add_footer_js(array(28=>'jquery.magnific-popup.min.js',29=>'easy-responsive-tabs.js',30=>'account.js'));
		$args['header_title']='Edit Profile';
		$this->load->helper('email');
		$user_id=get_current_user_id();
		$user=$this->user_model->get_user_by_id($user_id);
		
		//process profile form submit
		if($this->input->post('profile_submit'))
		{
			$email=$this->input->post('email');
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$form_data = array(
					'email'  => $email,
					'first_name'  => $first_name,
					'last_name'=>$last_name
			);	
			$this->session->set_flashdata('form_data', $form_data);
			$email_exists=$this->user_model->is_email_exists($email);
			if(empty($email)){
				$this->session->set_flashdata('error_msg', 'Please enter email');
			}
			elseif(!valid_email($email)){
				$this->session->set_flashdata('error_msg', 'Please enter valid email');
			}
			elseif(!empty($email_exists) && $user->email!=$email){
				$this->session->set_flashdata('error_msg', 'This email already exists');
			}
			elseif(empty($first_name)){
				$this->session->set_flashdata('error_msg', 'Please enter your first name');
			}
			elseif(empty($last_name)){
				$this->session->set_flashdata('error_msg', 'Please enter your last name');
			}else{
				$this->user_model->update_user($user_id,$form_data);
				$this->session->set_flashdata('success_msg', 'Profile updated successfully');
				$this->session->set_flashdata('form_data',false);
				
			}
			redirect('account-summary/edit/');
			die;
		}
		if($this->input->post('password_submit'))
		{
			$password=$this->input->post('password');
			$confirm_password=$this->input->post('confirm_password');
			if(empty($password) && empty($confirm_password)){
				redirect('account-summary/edit/');
				die;
			}
			
			$form_data = array(
					'password'  => $password,
			);
			if(empty($password) && !empty($confirm_password)){
				$this->session->set_flashdata('error_msg', 'Please enter password');
			}
			elseif(empty($confirm_password)&& !empty($password)){
				$this->session->set_flashdata('error_msg', 'Please confirm password');
			}
			elseif($password!=$confirm_password){
				$this->session->set_flashdata('error_msg', 'Passwords does not matches');
			}elseif(!empty($confirm_password)&& !empty($password) && strlen($password)<6){
				$this->session->set_flashdata('error_msg', 'Password must be minimum 6 character long');
			}else{
				$this->user_model->update_user($user_id,array('password'=>$password));
				$this->session->set_flashdata('success_msg', 'Password updated successfully');
				$this->session->set_flashdata('form_data',false);
				
			}
			redirect('account-summary/edit/');
			die;
		}
		
		
		$args['email']=!empty($user->email)?$user->email:'';
		$args['first_name']=!empty($user->first_name)?$user->first_name:'';
		$args['last_name']=!empty($user->first_name)?$user->last_name:'';
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			foreach($form_data as $key=>$val){
			$args[$key]=$val;
			}			
		}
		
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');			
		$args['success_msg']=$success_msg;
		
		
		$this->load->view('common/header',$args);
		$this->load->view('account/edit',$args);		
		$this->load->view('common/footer');
	}
	public function order_history()
	{
		if(!is_logged_in())
			redirect('/register');
		$args=array();
		$this->load->library('pagination');
		$args['header_title']="Summary";
		add_footer_js(array(28=>'jquery.magnific-popup.min.js',29=>'easy-responsive-tabs.js',30=>'account.js'));
		
		$user_id=get_current_user_id();
		$user=$this->user_model->get_user_by_id($user_id);
		
		$limit=3;
		
		//open orders(in current scenario,an user can have only one cart entry with multiple cart items)
		/* $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start_index=($start_index-1)*$limit;
		$data=array('status'=>'1','limit'=>$limit,'start_index'=>$start_index); 
		$total_open_orders=$this->order_model->get_total_orders($data); */
		
		$open_orders=$this->order_model->get_cart();
		
		
/* 		$config['base_url'] = base_url() . 'account-summary/ajax-summary/open/';
		$config['total_rows'] = $total_open_orders;
		$config['per_page'] = $limit;
		$config["uri_segment"] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['first_url'] = base_url() .'account-summary/ajax-summary/open/1/';
		
		$this->pagination->initialize($config); */
		
		$args['open_orders']=$open_orders;
		
		//$args['open_orders_pagination']= $this->pagination->create_links();
		
		
		//completed orders
		$start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start_index=($start_index-1)*$limit;
		$data=array('status'=>array(2),'limit'=>$limit,'start_index'=>$start_index); 
		$total_completed_orders=$this->order_model->get_total_orders($data);
		$completed_orders=$this->order_model->get_orders($data);
				
		$config['base_url'] = base_url() . 'account-summary/ajax-summary/completed/';
		$config['total_rows'] = $total_completed_orders;
		$config['per_page'] = $limit;
		$config["uri_segment"] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['first_url'] = base_url() .'account-summary/ajax-summary/completed/1/';
		
		$this->pagination->initialize($config);
		
		$args['completed_orders']=$completed_orders;
		
		$args['completed_orders_pagination']= $this->pagination->create_links();
		
		$args['user']=$user;
		
		$this->load->view('common/header',$args);
		$this->load->view('account/summary',$args);		
		$this->load->view('common/footer');
	}
	
	function ajax_order_history($order_status='open',$page=1)
	{
		$this->load->library('pagination');
		$order_status=$this->uri->segment(3);
		$output=array('pagination_id'=>'','container_id'=>'','pagination'=>false,'content'=>false);
		$limit=3;
		$start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		$start_index=($start_index-1)*$limit;
		$data=array('limit'=>$limit,'start_index'=>$start_index);
		if($order_status=='open'){
			$data['status']=array(1); 
			$total_orders=$this->order_model->get_total_orders($data);
			$orders=$this->order_model->get_orders($data);
			$base_url=base_url() . 'account-summary/ajax-summary/open/';
			$first_url=base_url() .'account-summary/ajax-summary/open/1/';
			$output['pagination_id']='open_pagination';
			$output['container_id']='open_order_con';
		}
		if($order_status=='completed'){
			$data['status']=array(2); 
			$total_orders=$this->order_model->get_total_orders($data);
			$orders=$this->order_model->get_orders($data);
			$base_url=base_url() . 'account-summary/ajax-summary/completed/';
			$first_url=base_url() .'account-summary/ajax-summary/completed/1/';
			$output['pagination_id']='completed_pagination';
			$output['container_id']='completed_order_con';
		}
		
		$config['base_url'] =$base_url;
		$config['total_rows'] = $total_orders;
		$config['per_page'] = $limit;
		$config["uri_segment"] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['first_url'] = $first_url;
		
		$this->pagination->initialize($config);
		$output['pagination']= $this->pagination->create_links();
		if(!empty($orders)){
			ob_start();
			?>
			<tr>
				<th>&nbsp;</th>
				<th>Created</th>
				<th>Box ID</th>
				<th>Status</th>
				<th>Complete Order</th>
				<th>View Details</th>
			</tr>
			<?php
			foreach($orders as $item)
			{
				$status=get_product_status_text($item->status);
				if(!empty($item->has_variation)){
				$variations=$this->product_model->get_product_variation_by_id($item->product_id,$item->provider_id);
				}
				$price=0;
				switch($item->product_condition){
					case 'flawless':
						if(!empty($item->has_variation) && !empty($variations->flawless_price))
						$price=$variations->flawless_price;
						else
						$price=$item->flawless_price;
						break;
					case 'good':
						if(!empty($item->has_variation) && !empty($variations->good_price))
						$price=$variations->good_price;
						else
						$price=$item->good_price;
						break;
					case 'broken':
						if(!empty($item->has_variation) && !empty($variations->broken_price))
						$price=$variations->broken_price;
						else
						$price=$item->broken_price;				
						break;			
				} 
				?>
				<tr>
					<td>Your box item worth $<?php echo $price;?></td>
					<td><?php echo date('d/m/Y',strtotime($item->date));?></td>
					<td><?php echo $item->box_id;?></td>
					<td><?php echo $status;?></td>
					<td><a href="<?php echo base_url();?>payment-carrier/">Click Here</a></td>
					<td><a href="<?php echo base_url();?>order-details/<?php echo $item->order_id;?>/">View Details</a></td>
				</tr>
				
				<?php
			}
			
			$output['content']= ob_get_contents();
			ob_end_clean();
		
		}
		
		echo json_encode($output);
		die;
	}
	
	public function address(){
		if(!is_logged_in())
			redirect('/register');
		$args=array();
		$args['header_title']="Address";
		add_header_css(array(11=>'magnific-popup.css'));
		add_footer_js(array(28=>'jquery.magnific-popup.min.js',29=>'easy-responsive-tabs.js',30=>'account.js'));
		$user_id=get_current_user_id();
		$user=$this->user_model->get_user_by_id($user_id);
		
		$args['user']=$user;
		$this->load->view('common/header',$args);
		$this->load->view('account/address',$args);		
		$this->load->view('common/footer');
	}
			
}
