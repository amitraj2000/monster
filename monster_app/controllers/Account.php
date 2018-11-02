<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function index()
	{
		if(!is_logged_in())
			redirect('/register');
		$this->load->view('common/header');
		//$this->load->view('login');
		$this->load->view('common/footer');
	}
	
	
}
