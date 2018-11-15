<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function index()
	{
		$args=array();
		$this->load->library('pagination');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		$args['title']='All users';	
		$args['active_menu']='users';
		
		$limit=10;
		$total_users=$this->user_model->get_total_users();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$users=$this->user_model->get_users(array('limit'=>$limit,'start_index'=>$start_index));
		
		
		$config['base_url'] = base_url() . 'users/page/';
		$config['total_rows'] = $total_users;
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
		
		$args['users']=$users;
		
		$args['pagination']= $this->pagination->create_links();
		$args['pagination_text']="Showing ".($start_index+1)." to ".($start_index+$limit)." of ".$total_users." entries";
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('user/users',$args);
		$this->load->view('common/footer',$args);
	}
	
	public function delete_user($user_id)
	{
		$this->user_model->delete_user($user_id);
		redirect('/users');
		die;
	}
	
	public function edit_user($user_id)
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Edit user';	
		$args['active_menu']='users';
		
		$user=$this->user_model->get_user_by_id($user_id);
		if(!empty($user)){
			$args['user']=array(
				'user_id'=>$user->user_id,
				'first_name'  => $user->first_name,
				'last_name'  => $user->last_name,
				'email'  => $user->email,
				'role'  => $user->role,
			);
		}
		
				
		//Process form submit
		if($this->input->post('submit')){
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
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
				
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('user/edit_user',$args);
		$this->load->view('common/footer',$args);
	}
	
	public function add_user()
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Add user';	
		$args['active_menu']='users';
		
		//Process form submit
		if($this->input->post('submit')){
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$email=$this->input->post('email');
			$role=$this->input->post('role');
			$password=$this->input->post('password');
			$confirm_password=$this->input->post('confirm_password');
			$email_exists=$this->user_model->is_email_exists($email);
			
			 $form_data = array(
					'first_name'  => $first_name,
					'last_name'  => $last_name,
					'email'  => $email,
					'role'  => $role,
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($first_name)){
				$this->session->set_flashdata('error_msg', 'Please enter first name');
			}
			else if(empty($last_name)){
				$this->session->set_flashdata('error_msg', 'Please enter last name');
			}
			else if(empty($email)){
				$this->session->set_flashdata('error_msg', 'Please enter your email');
			}
			else if($email_exists){
				$this->session->set_flashdata('error_msg', 'This email already exists');
			}
			else if(empty($password) || empty($confirm_password)){
				$this->session->set_flashdata('error_msg', 'Please enter your password');
			}
			else if( $confirm_password!=$password){
				$this->session->set_flashdata('error_msg', 'Password does not match');
			}
			else{
					
				$user_id=random_string('alnum',16);
				$data = array(
					'user_id' => $user_id,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'email' => $email,
					'password' => md5($password),
					'role' => $role,//User role
					'status'=>'1'
				);			
				
				$this->user_model->add_user($data);
				$this->session->set_flashdata('success_msg', 'User added successfully');
				$this->session->set_flashdata('form_data',false);
				redirect('user/edit/'.$user_id); 
				die;
			}
			
			redirect('user/add');
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['user']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('user/add_user',$args);
		$this->load->view('common/footer',$args);
	}
	
}
