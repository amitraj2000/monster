<?php
class Catalog_model extends CI_Model {
	
		public function get_categories($args=array())
        {                
			$this->db->select('*');
			$this->db->from(CATEGORY_MASTER);
			$this->db->where('status','1');
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
			$this->db->where('status','1');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get();
			return $query->row();
        }
		public function get_models_by_category_id($category_id){
			$this->db->select('*');
			$this->db->from(MODEL_MASTER);
			$this->db->where('status','1');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function get_model_by_id($model_id)
        {                
			$this->db->select('*');
			$this->db->from(MODEL_MASTER);
			$this->db->where('status','1');
			$this->db->where('model_id',$model_id);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function get_providers_by_model_id($model_id)
        {                
			$this->db->select('*');
			$this->db->from(PROVIDER_MASTER);
			$this->db->join(PROVIDER_MODEL_MAP, PROVIDER_MASTER.'.provider_id = '.PROVIDER_MODEL_MAP.'.provider_id');
			$this->db->where('status','1');
			$this->db->where(PROVIDER_MODEL_MAP.'.model_id',$model_id);
			$query = $this->db->get();
			return $query->result();
        }
		public function get_products_by_model_id($model_id)
        {                
			$this->db->select('*');
			$this->db->from(PRODUCT_MASTER);
			$this->db->where('status','1');
			$this->db->where('model_id',$model_id);
			$query = $this->db->get();
			return $query->result();
        }
		public function get_product_related_details($product_id)
        { 
			$this->db->select('*');
			$this->db->from(PRODUCT_MASTER);
			$this->db->join(CATEGORY_MASTER, CATEGORY_MASTER.'.category_id = '.PRODUCT_MASTER.'.category_id');
			$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			$this->db->where(PRODUCT_MASTER.'.status!=','3');
			$this->db->where('product_id',$product_id);
			$query = $this->db->get();
			return $query->row();
			
        }
}
?>