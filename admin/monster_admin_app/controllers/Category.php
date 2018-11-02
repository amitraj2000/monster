<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	
	public function index()
	{
		$args=array();
		$this->load->library('pagination');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		
		$limit=10;
		$total_categories=$this->catalog_model->get_total_categories();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$categories=$this->catalog_model->get_categories(array('limit'=>$limit,'start_index'=>$start_index));
		
		
		$config['base_url'] = base_url() . 'categories/page/';
		$config['total_rows'] = $total_categories;
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
		
		$args['categories']=$categories;
		
		$args['pagination']= $this->pagination->create_links();
		$args['pagination_text']="Showing ".($start_index+1)." to ".($start_index+$limit)." of ".$total_categories." entries"; 
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/categories',$args);
		$this->load->view('common/footer');
	}
	
	public function add_category()
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$heading_text=$this->input->post('heading_text');
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'name'  => $name,
					'heading_text'=>$heading_text
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter category name');
			}	
			else if(empty($image['name'])){
				$this->session->set_flashdata('error_msg', 'Please upload image');
			}			
			else{	
				  $config['upload_path']   = UPLOADS_CATEGORY;
				  $config['allowed_types'] = 'gif|jpg|png';
				  $this->load->library('upload', $config);
				  if ( ! $this->upload->do_upload('image'))
				  {
						$this->session->set_flashdata('error_msg', $this->upload->display_errors('',''));
				  }
				  else{
						
						$upload_data= $this->upload->data();						

						$img['image_library'] = 'gd2';
						$img['source_image'] = $upload_data['full_path'];
						$img['create_thumb'] = false;
						$img['maintain_ratio'] = TRUE;
						$img['width']         = 75;
						$img['height']       = 50;
						$img['new_image']     = UPLOADS_CATEGORY_THUMB;

						$this->load->library('image_lib', $img);
						$this->image_lib->resize();
						
						$category_id=random_string('alnum',16);
						
						$slug_config = array(
							'field' => 'category_slug',
							'title' => 'category_name',
							'table' => CATEGORY_MASTER,
							'id' => 'category_id',
						);
						$this->load->library('slug',$slug_config);
						$slug=$this->slug->create_uri(array('category_name' => $name));
						$data = array(
							'category_id' => $category_id,
							'category_name' => $name,
							'category_slug' => $slug,
							'category_image' => $upload_data['file_name'],
							'heading_text'=>$heading_text,
							'status' => !empty($disable)?'2':'1',
						);
						$this->catalog_model->add_category($data);
						
						$this->session->set_flashdata('success_msg', 'Category added successfully');
						$this->session->set_flashdata('form_data',false);
						redirect('category/edit/'.$category_id);
						die;
				  }
				
				
			}
			
			redirect('category/add');
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['category']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/add_category',$args);
		$this->load->view('common/footer');
	}
	
	public function delete_category($category_id){
		$this->catalog_model->delete_category($category_id);
		redirect('/categories');
		die;
	}
	
	public function edit_category($category_id){
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		$category=$this->catalog_model->get_category_by_id($category_id);
		if(!empty($category)){
			$args['category']=array(
				'category_id'=>$category->category_id,
				'name'  => $category->category_name,
				'image'  => $category->category_image,
				'heading_text'  => $category->heading_text,
				'status'  => $category->status,
			);
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$id=$this->input->post('category_id');
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$heading_text=$this->input->post('heading_text');
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'category_id'  => $category_id,
					'name'  => $name,
					'image'=>!empty($category->category_image)?$category->category_image:'',
					'heading_text'  => $heading_text,
					'status'  => $disable?'2':'1',
			);		
			
			if(empty($id) || $id!=$category_id){
				$this->session->set_flashdata('error_msg', 'There is some problem');
			}
			else if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter category name');
			}			
			else{
				 if(!empty($image['name'])){
					  $config['upload_path']   = UPLOADS_CATEGORY;
					  $config['allowed_types'] = 'gif|jpg|png';
					  $this->load->library('upload', $config);
					  if ( ! $this->upload->do_upload('image'))
					  {
							$this->session->set_flashdata('error_msg', $this->upload->display_errors('',''));
					  }
					  else{
						  $upload_data= $this->upload->data();
						  $img['image_library'] = 'gd2';
							$img['source_image'] = $upload_data['full_path'];
							$img['create_thumb'] = false;
							$img['maintain_ratio'] = TRUE;
							$img['width']         = 75;
							$img['height']       = 50;
							$img['new_image']     = UPLOADS_CATEGORY_THUMB;

							$this->load->library('image_lib', $img);
							$this->image_lib->resize();
							
							$form_data['image']=$upload_data['file_name'];
							$this->session->set_flashdata('form_data', $form_data);
					  }
				  }
				
				
				$slug_config = array(
					'field' => 'category_slug',
					'title' => 'category_name',
					'table' => CATEGORY_MASTER,
					'id' => 'category_id',
				);
				$this->load->library('slug',$slug_config);
				$slug=$this->slug->create_uri(array('category_name' => $name));
				$data = array(
					'category_name' => $name,
					'category_slug' => $slug,
					'heading_text' => $heading_text,
					'status' => !empty($disable)?'2':'1',
				);	
				
				if(!empty($upload_data['file_name'])){
					$data['category_image']=$upload_data['file_name'];
				}
					
				
				$this->catalog_model->update_category($category_id,$data);
								
				$this->session->set_flashdata('success_msg', 'Category updated successfully');
				
			}
			redirect('category/edit/'.$category_id);
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['category']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/edit_category',$args);
		$this->load->view('common/footer');
	}
	
	
	
}
