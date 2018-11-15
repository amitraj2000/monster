<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Dashboard';
		$args['active_menu']='dashboard';
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('dashboard');
		$this->load->view('common/footer',$args);
	}
	
}
