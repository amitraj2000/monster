<?php
class Catalog_model extends CI_Model {		
		
		public function get_total_categories($args=array())
        {                
			$this->db->select('category_id');
			$this->db->from(CATEGORY_MASTER);
			$this->db->where('status!=','3');
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_categories($args=array())
        {                
			$this->db->select('*');
			$this->db->from(CATEGORY_MASTER);
			$this->db->where('status!=','3');
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		public function get_category_by_id($category_id)
        {                
			$this->db->select('*');
			$this->db->from(CATEGORY_MASTER);
			$this->db->where('status!=','3');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function delete_category($category_id)
        {                
			$data = array(
					'status' => '3',
			);
			$this->db->where('category_id', $category_id);
			$this->db->update(CATEGORY_MASTER, $data);
			
        }
		public function update_category($category_id,$data)
        {               
			
			$this->db->where('category_id', $category_id);
			$this->db->update(CATEGORY_MASTER, $data);
			
        }
		
		public function add_category($args)
        {                
			$this->db->insert(CATEGORY_MASTER, $args);			
        }
		
		
		public function get_total_providers($args=array())
        {                
			$this->db->select('provider_id');
			$this->db->from(PROVIDER_MASTER);
			$this->db->where('status!=','3');
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_providers($args=array())
        {                
			$this->db->select('*');
			$this->db->from(PROVIDER_MASTER);
			$this->db->where('status!=','3');
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		
		public function add_provider($args)
        {                
			$this->db->insert(PROVIDER_MASTER, $args);			
        }
		public function get_provider_by_id($provider_id)
        {                
			$this->db->select('*');
			$this->db->from(PROVIDER_MASTER);
			$this->db->where('status!=','3');
			$this->db->where('provider_id',$provider_id);
			$query = $this->db->get();
			return $query->row();
        }
		public function delete_provider($provider_id)
        {                
			$data = array(
					'status' => '3',
			);
			$this->db->where('provider_id', $provider_id);
			$this->db->update(PROVIDER_MASTER, $data);
			
        }
		public function update_provider($provider_id,$data)
        {               
			
			$this->db->where('provider_id', $provider_id);
			$this->db->update(PROVIDER_MASTER, $data);
			
        }
		
		public function get_total_models($args=array())
        {                
			$this->db->select('model_id');
			$this->db->from(MODEL_MASTER);
			$this->db->where('status!=','3');
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_models($args=array())
        {                
			$this->db->select('*');
			$this->db->from(MODEL_MASTER);
			$this->db->where('status!=','3');
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		public function add_model($args)
        {                
			$this->db->insert(MODEL_MASTER, $args);			
        }
		
		public function delete_model($model_id)
        {                
			$data = array(
					'status' => '3',
			);
			$this->db->where('model_id', $model_id);
			$this->db->update(MODEL_MASTER, $data);
			
        }
		public function get_model_by_id($model_id)
        {                
			$this->db->select('*');
			$this->db->from(MODEL_MASTER);
			$this->db->where('status!=','3');
			$this->db->where('model_id',$model_id);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function update_model($model_id,$data)
        {               
			
			$this->db->where('model_id', $model_id);
			$this->db->update(MODEL_MASTER, $data);
			
        }
		
		public function get_models_by_category_id($category_id){
			$this->db->select('*');
			$this->db->from(MODEL_MASTER);
			$this->db->where('status!=','3');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function get_total_products($args=array())
        {                
			$this->db->select('product_id');
			$this->db->from(PRODUCT_MASTER);
			$this->db->where('status!=','3');
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_products($args=array())
        {                
			$this->db->select('*');
			$this->db->from(PRODUCT_MASTER);
			$this->db->where('status!=','3');
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		public function add_product($args)
        {                
			$this->db->insert(PRODUCT_MASTER, $args);			
        }
		
		public function delete_product($product_id)
        {                
			$data = array(
					'status' => '3',
			);
			$this->db->where('product_id', $product_id);
			$this->db->update(PRODUCT_MASTER, $data);
			
        }
		public function get_product_by_id($product_id)
        {                
			$this->db->select('*');
			$this->db->from(PRODUCT_MASTER);
			$this->db->where('status!=','3');
			$this->db->where('product_id',$product_id);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function update_product($product_id,$data)
        {               
			
			$this->db->where('product_id', $product_id);
			$this->db->update(PRODUCT_MASTER, $data);
			
        }
		
		
		
		


}
?>