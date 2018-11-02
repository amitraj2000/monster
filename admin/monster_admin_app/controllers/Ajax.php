<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function category_based_model_drop_down(){
		 $category_id=$this->input->post('category_id');
		 $models=$this->catalog_model->get_models_by_category_id($category_id);
		 
		 $output='<option value="">Select Model</option>';
		
		 if(!empty($models)){
			 foreach($models as $model){
				 $output.='<option value="'.$model->model_id.'">'.$model->model_name.'</option>';
			 }
		 }
		 echo $output;
		 die;
	}
	
}
