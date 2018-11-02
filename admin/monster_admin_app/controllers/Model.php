<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

	
	public function index()
	{
		$args=array();
		$this->load->library('pagination');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		
		$limit=10;
		$total_models=$this->catalog_model->get_total_models();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$models=$this->catalog_model->get_models(array('limit'=>$limit,'start_index'=>$start_index));
		
		
		$config['base_url'] = base_url() . 'models/page/';
		$config['total_rows'] = $total_models;
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
		
		$args['models']=$models;
		
		$args['pagination']= $this->pagination->create_links();
		$args['pagination_text']="Showing ".($start_index+1)." to ".($start_index+$limit)." of ".$total_models." entries"; 
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/models',$args);
		$this->load->view('common/footer');
	}
	
	public function add_model()
	{
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$category_id=$this->input->post('category_id');
			$heading_text=$this->input->post('heading_text');
			$providers=$this->input->post('providers');
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'name'  => $name,
					'category_id'  => $category_id,
					'heading_text'=>$heading_text,
					'providers'=>$providers
			);		
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter model name');
			}		
			else if(empty($image['name'])){
				$this->session->set_flashdata('error_msg', 'Please upload image');
			}			
			else if(empty($category_id)){
				$this->session->set_flashdata('error_msg', 'Please select category');
			}	
			else{	
				  $config['upload_path']   = UPLOADS_MODEL;
				  $config['allowed_types'] = 'gif|jpg|jpeg|png';
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
						$img['new_image']     = UPLOADS_MODEL_THUMB;

						$this->load->library('image_lib', $img);
						$this->image_lib->resize();
						
						$model_id=random_string('alnum',16);
						
						$slug_config = array(
							'field' => 'model_slug',
							'title' => 'model_name',
							'table' => MODEL_MASTER,
							'id' => 'model_id',
						);
						$this->load->library('slug',$slug_config);
						$slug=$this->slug->create_uri(array('model_name' => $name));
						
						$data = array(
							'model_id' => $model_id,
							'model_name' => $name,
							'model_slug' => $slug,
							'model_image' => $upload_data['file_name'],
							'category_id' => $category_id,
							'heading_text' => $heading_text,
							'status' => !empty($disable)?'2':'1',
						);
						$this->catalog_model->add_model($data);
						
						//insert into provider map table
						if(!empty($providers)){
							foreach($providers as $provider){
								$map_id=random_string('alnum',16);
								$this->db->insert(PROVIDER_MODEL_MAP,array('map_id'=>$map_id,'model_id'=>$model_id,'provider_id'=>$provider));
							}
							
						}
						
						$this->session->set_flashdata('success_msg', 'Model added successfully');
						$this->session->set_flashdata('form_data',false);
						redirect('model/edit/'.$model_id);
						die;
				  }
				
				
			}
			
			redirect('model/add');
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['model']=$form_data;
		}
		
		$categories=$this->catalog_model->get_categories();
		$args['categories']=$categories;
		$providers=$this->catalog_model->get_providers();
		$args['providers']=$providers;
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/add_model',$args);
		$this->load->view('common/footer');
	}
	
	public function delete_model($model_id){
		$this->catalog_model->delete_model($model_id);
		redirect('/models');
		die;
	}
	
	public function edit_model($model_id){
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		$model=$this->catalog_model->get_model_by_id($model_id);
		$model_providers=$this->db->select('provider_id')->where('model_id',$model->model_id)->get(PROVIDER_MODEL_MAP)->result();
		$model_providers_arr=array();
		if(!empty($model_providers)){
			foreach($model_providers as $m_provider)
			$model_providers_arr[]=$m_provider->provider_id;
		}
		if(!empty($model)){
			$args['model']=array(
				'model_id'=>$model->model_id,
				'name'  => $model->model_name,
				'image'  => $model->model_image,
				'category_id'  => $model->category_id,
				'heading_text'  => $model->heading_text,
				'providers'  =>$model_providers_arr ,
				'status'  => $model->status,
			);
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$id=$this->input->post('model_id');
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$category_id=$this->input->post('category_id');
			$heading_text=$this->input->post('heading_text');
			$providers=$this->input->post('providers');
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'model_id'  => $model_id,
					'name'  => $name,
					'image'=>!empty($model->model_image)?$model->model_image:'',
					'category_id'=>$category_id,
					'heading_text'=>$heading_text,
					'providers'=>$providers,
					'status'  => $disable?'2':'1',
			);		
			$this->session->set_flashdata('form_data', $form_data);
			if(empty($id) || $id!=$model_id){
				$this->session->set_flashdata('error_msg', 'There is some problem');
			}
			else if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter model name');
			}
			else if(empty($category_id)){
				$this->session->set_flashdata('error_msg', 'Please select category name');
			}			
			else{
				 if(!empty($image['name'])){
					  $config['upload_path']   = UPLOADS_MODEL;
					  $config['allowed_types'] = 'gif|jpg|jpeg|png';
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
							$img['new_image']     = UPLOADS_MODEL_THUMB;

							$this->load->library('image_lib', $img);
							$this->image_lib->resize();
							
							$form_data['image']=$upload_data['file_name'];
							$this->session->set_flashdata('form_data', $form_data);
					  }
				  }
			
				$slug_config = array(
					'field' => 'model_slug',
					'title' => 'model_name',
					'table' => MODEL_MASTER,
					'id' => 'model_id',
				);
				$this->load->library('slug',$slug_config);
				$slug=$this->slug->create_uri(array('model_name' => $name));
				$data = array(
					'model_name' => $name,
					'model_slug' => $slug,
					'category_id' => $category_id,
					'heading_text' => $heading_text,
					'status' => !empty($disable)?'2':'1',
				);	
				
				if(!empty($upload_data['file_name'])){
					$data['model_image']=$upload_data['file_name'];
				}
					
				
				$this->catalog_model->update_model($model_id,$data);
				//update into provider map table
				$this->db->where('model_id', $model_id)->delete(PROVIDER_MODEL_MAP);
				if(!empty($providers)){				
					foreach($providers as $provider){
						$map_id=random_string('alnum',16);
						$this->db->insert(PROVIDER_MODEL_MAP,array('map_id'=>$map_id,'model_id'=>$model_id,'provider_id'=>$provider));
					}					
				}
				
				$this->session->set_flashdata('success_msg', 'Model updated successfully');
				
			}
			redirect('model/edit/'.$model_id);
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['model']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
		$categories=$this->catalog_model->get_categories();
		$args['categories']=$categories;
		$providers=$this->catalog_model->get_providers();
		$args['providers']=$providers;
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/edit_model',$args);
		$this->load->view('common/footer');
	}
	
	
	
}
