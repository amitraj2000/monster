<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{
		$args=array();
		
		if(is_logged_in())
			redirect('/dashboard');
		
		//Process login
		if($this->input->post('submit')){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			$this->session->set_flashdata('form_data',array('email'=>$email));
			
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
					$this->session->set_userdata(array('logged_in'=>true,'user_id'=>$user->user_id));
					redirect('/dashboard');
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
	
	public function process_logout()
	{
		$logged_in=$this->session->userdata('logged_in');
		$user_id=$this->session->userdata('user_id');
		if(!empty($logged_in) && !empty($user_id)){
			$this->session->unset_userdata(array('logged_in','user_id'));
		}
		redirect('/login');
	}
}
