<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
		if(!is_logged_in()){
			redirect('/login');
		}
		
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('dashboard');
		$this->load->view('common/footer');
	}
	
}
