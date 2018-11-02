<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller {

	
	public function index()
	{
		$args=array();
		$this->load->library('pagination');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		
		$limit=10;
		$total_providers=$this->catalog_model->get_total_providers();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$providers=$this->catalog_model->get_providers(array('limit'=>$limit,'start_index'=>$start_index));
		
		
		$config['base_url'] = base_url() . 'providers/page/';
		$config['total_rows'] = $total_providers;
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
		
		$args['providers']=$providers;
		
		$args['pagination']= $this->pagination->create_links();
		$args['pagination_text']="Showing ".($start_index+1)." to ".($start_index+$limit)." of ".$total_providers." entries"; 
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/providers',$args);
		$this->load->view('common/footer');
	}
	
	public function add_provider()
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'name'  => $name,
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter provider name');
			}	
			else if(empty($image['name'])){
				$this->session->set_flashdata('error_msg', 'Please upload image');
			}			
			else{	
				  $config['upload_path']   = UPLOADS_PROVIDER;
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
						$img['new_image']     = UPLOADS_PROVIDER_THUMB;

						$this->load->library('image_lib', $img);
						$this->image_lib->resize();
						
						$provider_id=random_string('alnum',16);
						$data = array(
							'provider_id' => $provider_id,
							'provider_name' => $name,
							'provider_image' => $upload_data['file_name'],
							'status' => !empty($disable)?'2':'1',
						);
						$this->catalog_model->add_provider($data);
						
						$this->session->set_flashdata('success_msg', 'Provider added successfully');
						$this->session->set_flashdata('form_data',false);
						redirect('provider/edit/'.$provider_id);
						die;
				  }
				
				
			}
			
			redirect('provider/add');
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['provider']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/add_provider',$args);
		$this->load->view('common/footer');
	}
	
	public function delete_provider($provider_id){
		$this->catalog_model->delete_provider($provider_id);
		redirect('/providers');
		die;
	}
	
	public function edit_provider($provider_id){
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		$provider=$this->catalog_model->get_provider_by_id($provider_id);
		if(!empty($provider)){
			$args['provider']=array(
				'provider_id'=>$provider->provider_id,
				'name'  => $provider->provider_name,
				'image'  => $provider->provider_image,
				'status'  => $provider->status,
			);
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$id=$this->input->post('provider_id');
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'provider_id'  => $provider_id,
					'name'  => $name,
					'image'=>!empty($provider->provider_image)?$provider->provider_image:'',
					'status'  => $disable?'2':'1',
			);		
			
			if(empty($id) || $id!=$provider_id){
				$this->session->set_flashdata('error_msg', 'There is some problem');
			}
			else if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter provider name');
			}			
			else{
				 if(!empty($image['name'])){
					  $config['upload_path']   = UPLOADS_PROVIDER;
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
							$img['new_image']     = UPLOADS_PROVIDER_THUMB;

							$this->load->library('image_lib', $img);
							$this->image_lib->resize();
							
							$form_data['image']=$upload_data['file_name'];
							$this->session->set_flashdata('form_data', $form_data);
					  }
				  }
			
				$data = array(
					'provider_name' => $name,
					'status' => !empty($disable)?'2':'1',
				);	
				
				if(!empty($upload_data['file_name'])){
					$data['provider_image']=$upload_data['file_name'];
				}
					
				
				$this->catalog_model->update_provider($provider_id,$data);
								
				$this->session->set_flashdata('success_msg', 'Provider updated successfully');
				
			}
			redirect('provider/edit/'.$provider_id);
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['provider']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/edit_provider',$args);
		$this->load->view('common/footer');
	}
	
	
	
}
