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
		/* if($this->input->post('submit')){
			$id=$this->input->post('user_id');
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$email=$this->input->post('email');
			$role=$this->input->post(role);
			$password=$this->input->post('password');
			$confirm_password=$this->input->post('confirm_password');
			$email_exists=$this->user_model->is_email_exists($email);
			
			 $form_data = array(
					'user_id'  => $id,
					'first_name'  => $first_name,
					'last_name'  => $last_name,
					'email'  => $email,
					'role'  => $role,
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($id) || $id!=$user_id){
				$this->session->set_flashdata('error_msg', 'There is some problem');
			}	
			else if(empty($first_name)){
				$this->session->set_flashdata('error_msg', 'Please enter first name');
			}
			else if(empty($last_name)){
				$this->session->set_flashdata('error_msg', 'Please enter last name');
			}
			else if(empty($email)){
				$this->session->set_flashdata('error_msg', 'Please enter your email');
			}
			else if(!empty($email) && $email!=$user->email && $email_exists){
				$this->session->set_flashdata('error_msg', 'This email already exists');
			}
			else if(!empty($password) && !empty($confirm_password) && $confirm_password!=$password){
				$this->session->set_flashdata('error_msg', 'Please enter your password');
			}
			else{
						
				$data['first_name']=$first_name;
				$data['last_name']=$last_name;
				$data['email']=$email;
				$data['role']=$role;
				
				if(!empty($password) && !empty($confirm_password) && $confirm_password==$password){
					$data['password']=$password;
				}
				$this->user_model->update_user($user->user_id,$data);
				$this->session->set_flashdata('success_msg', 'User updated successfully');
			}
			
			redirect('user/edit/'.$user->user_id);
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['user']=$form_data;
		} */
		
		/* $error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg; */
		
		$args['order']=$order;
		$args['order_items']=$order_items;
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('order/edit_order',$args);
		$this->load->view('common/footer',$args);
	}
}
