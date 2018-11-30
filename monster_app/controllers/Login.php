<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		$args=array();
		
		if(is_logged_in())
			redirect('/');
		
		//Process form submit
		if($this->input->post('submit')){
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			
			$form_data = array(
					'email'  => $email,
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			
			if(empty($email)){
				$this->session->set_flashdata('error_msg', 'Please enter your email');
			}
			else if(empty($password)){
				$this->session->set_flashdata('error_msg', 'Please enter your password');
			}
			else{
						
				$user=$this->user_model->validate_login($email,$password);
				
				if(empty($user)){
					$this->session->set_flashdata('error_msg', 'You are not allowed to login');				
				}
				else{
					$this->set_auth_redirect($user->user_id);					
				}
			}
			redirect('/login');
		}
		
		$form_data=$this->session->flashdata('form_data');
		$error_msg=$this->session->flashdata('error_msg');
			
		$args=array('form_data'=>$form_data,'error_msg'=>$error_msg);
		
		$this->load->view('common/header');
		$this->load->view('login',$args);
		$this->load->view('common/footer');
	}
	
	public function ajax_login(){
		parse_str($this->input->post('data'),$param);
		
		$output=array('error'=>true,'msg'=>'');
		if(empty($param['email'])){
			$output['msg']='Please enter email';
		}
		elseif(!empty($param['email']) && !filter_var($param['email'], FILTER_VALIDATE_EMAIL)){
			$output['msg']='Please enter valid email';
		}
		elseif(empty($param['password'])){
			$output['msg']='Please enter valid email';
		}
		else{
						
			$user=$this->user_model->validate_login($param['email'],$param['password']);
			
			if(empty($user)){
				$output['msg']='You are not allowed to login';
			}
			else{
				$this->set_auth($user->user_id);					
				$output['msg']='';
				$output['error']=false;
			}
		}
		echo json_encode($output);
		die;
	}
	
	public function register()
	{
		$args=array();
		
		if(is_logged_in())
			redirect('/');
		
		//Process form submit
		if($this->input->post('submit')){
			
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$confirm_password=$this->input->post('confirm_password');
			
			$form_data = array(
					'first_name'  => $first_name,
					'last_name'     => $last_name,
					'email' => $email
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($first_name)){
				$this->session->set_flashdata('error_msg', 'Please enter your first name');
			}
			else if(empty($last_name)){
				$this->session->set_flashdata('error_msg', 'Please enter your last name');
			}
			else if(empty($email)){
				$this->session->set_flashdata('error_msg', 'Please enter your email');
			}
			else if(!valid_email($email)){
				$this->session->set_flashdata('error_msg', 'Please enter valid email');
			}
			else if(is_email_exists($email)){
				$this->session->set_flashdata('error_msg', 'Email already exists');
			}
			else if(empty($password)){
				$this->session->set_flashdata('error_msg', 'Please enter your password');
			}			
			else if(empty($confirm_password)){
				$this->session->set_flashdata('error_msg', 'Please confirm your password');
			}
			else if($password!==$confirm_password){
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
						'role' => '3',//User role
						'status'=>'1'
				);
				$this->insert_user($data);
				$this->set_auth_redirect($user_id);
				
			}
			
			redirect('/register');
		}
		
		$form_data=$this->session->flashdata('form_data');
		$error_msg=$this->session->flashdata('error_msg');
		
		$args=array('form_data'=>$form_data,'error_msg'=>$error_msg);
		
		
		$this->load->view('common/header');
		$this->load->view('register',$args);
		$this->load->view('common/footer');
	}
	
	public function ajax_register()
	{
		parse_str($this->input->post('data'),$param);
		
		$output=array('error'=>true,'msg'=>'');
		
		if(empty($param['first_name'])){
			$output['msg']= 'Please enter your first name';
		}
		else if(empty($param['last_name'])){
			$output['msg']= 'Please enter your last name';
		}
		else if(empty($param['email'])){
			$output['msg']='Please enter your email';
		}
		else if(!valid_email($param['email'])){
			$output['msg']='Please enter valid email';
		}
		else if(is_email_exists($param['email'])){
			$output['msg']='Email already exists';
		}
		else if(empty($param['password'])){
			$output['msg']='Please enter your password';
		}			
		else if(empty($param['confirm_password'])){
			$output['msg']='Please confirm your password';
		}
		else if($param['password']!==$param['confirm_password']){
			$output['msg']='Password does not match';
		}
		else{
			
			$user_id=random_string('alnum',16);
			$data = array(
					'user_id' => $user_id,
					'first_name' => $param['first_name'],
					'last_name' => $param['last_name'],
					'email' => $param['email'],
					'password' => md5($param['password']),
					'role' => '3',//User role
					'status'=>'1'
			);
			
			$this->insert_user($data);
			$this->set_auth($user_id);
			
			$output['msg']='';
			$output['error']=false;
			
		}
		echo json_encode($output);
		die;
	}
	
	public function google_user_authentication(){
		
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$email=$this->input->post('email');
		$user_id=random_string('alnum',16);
		$password=random_string('alnum',8);
		$email_exists=is_email_exists($email);//returns user_id
		if(!empty($email_exists)){
			$this->set_auth($email_exists);
		}
		else{
			$data = array(
				'user_id' => $user_id,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'password' => md5($password),
				'role' => '3',//User role
				'status'=>'1'
			);
			$this->insert_user($data);
			$this->set_auth($user_id);
		}
		echo site_url();
		die;
	}
	
	public function insert_user($data){
		$this->user_model->register_user($data);
	}
	
	public function set_auth_redirect($user_id){
		$this->session->set_userdata(array('logged_in'=>true,'user_id'=>$user_id));
		redirect('/');
	}
	public function set_auth($user_id){
		$this->session->set_userdata(array('logged_in'=>true,'user_id'=>$user_id));
	}
	
	public function process_logout(){
		$logged_in=$this->session->userdata('logged_in');
		$user_id=$this->session->userdata('user_id');
		if(!empty($logged_in) && !empty($user_id)){
			$this->session->unset_userdata(array('logged_in','user_id'));
		}
		redirect('/');
	}
	
}
