<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	
	public function index()
	{
		$args=array();
		
		$this->load->model('pages_model');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		$args['title']='All Pages';	
		$args['active_menu']='pages';		
		
		$pages=$this->pages_model->get_pages(array());
	
		
		$args['pages']=$pages;
		
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('pages/pages',$args);
		$this->load->view('common/footer',$args);
	}
	
	
	
	public function edit_pages($page_id)
	{
		$args=array();
		$this->load->model('pages_model');
		if(!is_logged_in()){
			redirect('/login');
		}
		$args['title']='Edit page';	
		$args['active_menu']='pages';
		
		$page=$this->pages_model->get_page_by_id($page_id);
		if(!empty($page)){
			$args['page']=array(
				'page_id'=>$page->page_id,
				'name'  => $page->name,
				'slug'  => $page->slug,
				'content'  => $page->content,
				'status'  => $page->status,
			);
		}
		
				
		//Process form submit
		 if($this->input->post('submit')){
			$id=$this->input->post('page_id');
			$name=$this->input->post('name');
			$content=$this->input->post('content');
						
			 $form_data = array(
					'page_id'  => $id,
					'name'  => $name,
					'slug'  => $page->slug,//default slug,not editable
					'content'  => $content,
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($id) || $id!=$page_id){
				$this->session->set_flashdata('error_msg', 'There is some problem');
			}	
			else if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter page name');
			}			
			else{
						
				$data['name']=$name;
				$data['content']=$content;
				$this->pages_model->update_page($page->page_id,$data);
				$this->session->set_flashdata('success_msg', 'Page updated successfully');
			}
			
			redirect('page/edit/'.$page->page_id);
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['page']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
				
		$this->load->view('common/header',$args);
		$this->load->view('common/menu',$args);
		$this->load->view('pages/edit_page',$args);
		$this->load->view('common/footer',$args);
	}
	
	
}
