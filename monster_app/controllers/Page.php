<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	public function render_page($slug)
	{
		
		$args=array();
		
		$page=$this->pages_model->get_page_by_slug($slug);		
		
		if(empty($page))
		{
			show_404();
			return;
		}
		
		$args['header_title']=$page->name;
		
				
		$args['page']=$page;
				
		$this->load->view('common/header',$args);
		$this->load->view('page/details',$args);		
		$this->load->view('common/footer');
	}
	
				
}
