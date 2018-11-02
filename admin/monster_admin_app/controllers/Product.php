<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	
	public function index()
	{
		$args=array();
		$this->load->library('pagination');
		
		if(!is_logged_in()){
			redirect('/login');
		}		
		
		$limit=10;
		$total_products=$this->catalog_model->get_total_products();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$products=$this->catalog_model->get_products(array('limit'=>$limit,'start_index'=>$start_index));
		
		
		$config['base_url'] = base_url() . 'products/page/';
		$config['total_rows'] = $total_products;
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
		
		$args['products']=$products;
		
		$args['pagination']= $this->pagination->create_links();
		$args['pagination_text']="Showing ".($start_index+1)." to ".($start_index+$limit)." of ".$total_products." entries"; 
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/products',$args);
		$this->load->view('common/footer');
	}
	
	public function add_product()
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
			$model_id=$this->input->post('model_id');
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'name'  => $name,
					'category_id'  => $category_id,
					'model_id'  => $model_id,
			);		
			if(!empty($category_id))
			{
				$form_data['models']=$this->catalog_model->get_models_by_category_id($category_id);
			}
			
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter product name');
			}		
			else if(empty($image['name'])){
				$this->session->set_flashdata('error_msg', 'Please upload image');
			}			
			else if(empty($category_id)){
				$this->session->set_flashdata('error_msg', 'Please select category');
			}
			else if(empty($model_id)){
				$this->session->set_flashdata('error_msg', 'Please select model');
			}			
			else{	
				  $config['upload_path']   = UPLOADS_PRODUCT;
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
						$img['new_image']     = UPLOADS_PRODUCT_THUMB;

						$this->load->library('image_lib', $img);
						$this->image_lib->resize();
						
						$product_id=random_string('alnum',16);
						$data = array(
							'product_id' => $product_id,
							'product_name' => $name,
							'product_image' => $upload_data['file_name'],
							'category_id' => $category_id,
							'model_id' => $model_id,
							'status' => !empty($disable)?'2':'1',
						);
						$this->catalog_model->add_product($data);
						
						$this->session->set_flashdata('success_msg', 'Product added successfully');
						$this->session->set_flashdata('form_data',false);
						redirect('product/edit/'.$product_id);
						die;
				  }
				
				
			}
			
			redirect('product/add');
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['product']=$form_data;
		}
		
		$categories=$this->catalog_model->get_categories();
		$args['categories']=$categories;
		
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/add_product',$args);
		$this->load->view('common/footer');
	}
	
	public function delete_product($product_id){
		$this->catalog_model->delete_product($product_id);
		redirect('/products');
		die;
	}
	
	public function edit_product($product_id){
		$args=array();
		
		if(!is_logged_in()){
			redirect('/login');
		}
		
		$product=$this->catalog_model->get_product_by_id($product_id);
		if(!empty($product)){
			$args['product']=array(
				'product_id'=>$product->product_id,
				'name'  => $product->product_name,
				'image'  => $product->product_image,
				'category_id'  => $product->category_id,
				'model_id'  => $product->model_id,
				'models'=>$this->catalog_model->get_models_by_category_id($product->category_id),
				'status'  => $product->status,
			);
		}
		
		//Process form submit
		if($this->input->post('submit')){
			$id=$this->input->post('product_id');
			$name=$this->input->post('name');
			$image=$_FILES['image'];
			$category_id=$this->input->post('category_id');
			$model_id=$this->input->post('model_id');
			$disable=$this->input->post('disable');
			
			 $form_data = array(
					'product_id'  => $product_id,
					'name'  => $name,
					'image'=>!empty($product->product_image)?$product->product_image:'',
					'category_id'=>$category_id,
					'model_id'=>$model_id,
					'status'  => $disable?'2':'1',
			);		
			if(!empty($category_id))
			{
				$form_data['models']=$this->catalog_model->get_models_by_category_id($category_id);
			}
			$this->session->set_flashdata('form_data', $form_data);
			
			if(empty($id) || $id!=$product_id){
				$this->session->set_flashdata('error_msg', 'There is some problem');
			}
			else if(empty($name)){
				$this->session->set_flashdata('error_msg', 'Please enter product name');
			}
			else if(empty($category_id)){
				$this->session->set_flashdata('error_msg', 'Please select category');
			}
			else if(empty($model_id)){
				$this->session->set_flashdata('error_msg', 'Please select model');
			}			
			else{
				 if(!empty($image['name'])){
					  $config['upload_path']   = UPLOADS_PRODUCT;
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
							$img['new_image']     = UPLOADS_PRODUCT_THUMB;

							$this->load->library('image_lib', $img);
							$this->image_lib->resize();
							
							$form_data['image']=$upload_data['file_name'];
							$this->session->set_flashdata('form_data', $form_data);
					  }
				  }
			
				$data = array(
					'product_name' => $name,
					'category_id' => $category_id,
					'model_id' => $model_id,
					'status' => !empty($disable)?'2':'1',
				);	
				
				if(!empty($upload_data['file_name'])){
					$data['product_image']=$upload_data['file_name'];
				}
					
				
				$this->catalog_model->update_product($product_id,$data);
								
				$this->session->set_flashdata('success_msg', 'Product updated successfully');
				
			}
			redirect('product/edit/'.$product_id);
			die;
		}
		
		$form_data=$this->session->flashdata('form_data');
		if(!empty($form_data)){
			$args['product']=$form_data;
		}
		
		$error_msg=$this->session->flashdata('error_msg');			
		$args['error_msg']=$error_msg;
		$success_msg=$this->session->flashdata('success_msg');
		$args['success_msg']=$success_msg;
		
		$categories=$this->catalog_model->get_categories();
		$args['categories']=$categories;
		
				
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('catalog/edit_product',$args);
		$this->load->view('common/footer');
	}
	
	
	
}
