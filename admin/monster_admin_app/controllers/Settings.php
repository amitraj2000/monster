<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	
	public function header_settings()
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Header Settings';	
		$args['active_menu']='header-settings';
		$this->load->model('pages_model');
		$pages=$this->pages_model->get_pages(array());
		$args['static_pages']=$pages;
		
		$query = $this->db->query("SELECT * FROM ".SETTINGS_MASTER." WHERE settings_name='header_settings'");
		$header_settings=$query->row();
		$settings=unserialize($header_settings->settings);
		$args['settings']=$settings;
		
		//Process form submit
		if($this->input->post('submit')){
			$config['upload_path']          = UPLOADS_SETTINGS;
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);
			
			$menu=json_decode($this->input->post('menu_arr'));
			if ( !empty($_FILES['logo']['name']) && ! $this->upload->do_upload('logo'))
			{
				$this->session->set_flashdata('error_msg', $this->upload->display_errors());
			}
			else
			{			
				$data =$this->upload->data();
				if(!empty($data['file_name']))
					$settings['logo']=$data['file_name'];
				$settings['menu']=$menu;
				$query = $this->db->query("UPDATE ".SETTINGS_MASTER." SET  settings='".serialize($settings)."' WHERE settings_name='header_settings'");
				$this->session->set_flashdata('success_msg', 'Settings updated successfully');
			}
			redirect('settings/header-settings');
			die;
		}
		
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
				
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('settings/header_settings',$args);
		$this->load->view('common/footer',$args);
	}
	
	public function footer_settings()
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Footer Settings';	
		$args['active_menu']='footer-settings';
		$this->load->model('pages_model');
		$pages=$this->pages_model->get_pages(array());
		$args['static_pages']=$pages;
		$args['products']=$this->catalog_model->get_products();
		
		
		
		$query = $this->db->query("SELECT * FROM ".SETTINGS_MASTER." WHERE settings_name='footer_settings'");
		$footer_settings=$query->row();
		$settings=unserialize($footer_settings->settings);
		$args['settings']=$settings;
		
		//Process form submit
		if($this->input->post('submit')){
			
			
			$menu=json_decode($this->input->post('menu_arr'));
			$product_menu=json_decode($this->input->post('product_menu_arr'));
			$keep_in_touch=$this->input->post('keep_in_touch');
			$facebook_url=$this->input->post('facebook_url');
			$twitter_url=$this->input->post('twitter_url');
			$instagram_url=$this->input->post('instagram_url');
			$address=$this->input->post('address');
			$contact_number=$this->input->post('contact_number');
			$contact_email=$this->input->post('contact_email');
			$copyright_text=$this->input->post('copyright_text');
			
			$config['upload_path']          = UPLOADS_SETTINGS;
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);
			
			$menu=json_decode($this->input->post('menu_arr'));
			if ( !empty($_FILES['logo']['name']) && ! $this->upload->do_upload('logo'))
			{
				$this->session->set_flashdata('error_msg', $this->upload->display_errors());
			}
			else
			{			
				$data =$this->upload->data();
				if(!empty($data['file_name']))
					$settings['logo']=$data['file_name'];
				$settings['menu']=$menu;
				$settings['product_menu']=$product_menu;
				$settings['keep_in_touch']=$keep_in_touch;
				$settings['facebook_url']=$facebook_url;
				$settings['twitter_url']=$twitter_url;
				$settings['instagram_url']=$instagram_url;
				$settings['address']=$address;
				$settings['contact_number']=$contact_number;
				$settings['contact_email']=$contact_email;
				$settings['copyright_text']=$copyright_text;
				$query = $this->db->query("UPDATE ".SETTINGS_MASTER." SET  settings='".serialize($settings)."' WHERE settings_name='footer_settings'");
				$this->session->set_flashdata('success_msg', 'Settings updated successfully');
			}
			redirect('settings/footer-settings');
			die;
		}
		
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
				
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('settings/footer_settings',$args);
		$this->load->view('common/footer',$args);
	}
	
	public function home_settings()
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
			$role=$this->input->post('role');
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
			else if(!empty($password) && !empty($confirm_password) && strlen($password)<6){
				$this->session->set_flashdata('error_msg', 'Password must be minimum 6 character long');
			}
			else{
						
				$data['first_name']=$first_name;
				$data['last_name']=$last_name;
				$data['email']=$email;
				$data['role']=$role;
				
				if(!empty($password) && !empty($confirm_password) && $confirm_password==$password){
					$data['password']=md5($password);
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
	
}
