<?php
class Product_model extends CI_Model {
	
		public function get_product_by_slug($product_slug,$model_slug='',$category_slug='')
        {                
			$this->db->select('*');
			$this->db->from(PRODUCT_MASTER);
			$this->db->where(PRODUCT_MASTER.'.status','1');
			$this->db->where(PRODUCT_MASTER.'.product_slug',$product_slug);
			if(!empty($model_slug))
			{
				$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
				$this->db->where(MODEL_MASTER.'.model_slug',$model_slug);
			}
			if(!empty($category_slug))
			{
				$this->db->join(CATEGORY_MASTER, CATEGORY_MASTER.'.category_id = '.PRODUCT_MASTER.'.category_id');
				$this->db->where(CATEGORY_MASTER.'.category_slug',$category_slug);
			}
			$query = $this->db->get();
			return $query->row();
        }
		public function get_product_by_id($product_id)
        {                
			$this->db->select('*,'.PRODUCT_MASTER.'.status AS product_status,'.MODEL_MASTER.'.status AS model_status,'.CATEGORY_MASTER.'.status AS category_status');
			$this->db->from(PRODUCT_MASTER);
			$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			$this->db->join(CATEGORY_MASTER, CATEGORY_MASTER.'.category_id = '.PRODUCT_MASTER.'.category_id');
			$this->db->where(PRODUCT_MASTER.'.status','1');
			$this->db->where(PRODUCT_MASTER.'.product_id',$product_id);
			
			$query = $this->db->get();
			return $query->row();
        }
		public function get_product_variation_by_id($product_id,$provider_id)
        {                
			$this->db->select('*');
			$this->db->from(PRODUCT_PROVIDER_MAP);
			$this->db->where(PRODUCT_PROVIDER_MAP.'.product_id',$product_id);
			$this->db->where(PRODUCT_PROVIDER_MAP.'.provider_id',$provider_id);
			$query = $this->db->get();
			return $query->row();
        }
		public function get_products_associated_provider_id($product_id)
        {                
			$this->db->select(PROVIDER_MASTER.'.*');
			$this->db->from(PROVIDER_MASTER);
			$this->db->join(PRODUCT_PROVIDER_MAP, PROVIDER_MASTER.'.provider_id = '.PRODUCT_PROVIDER_MAP.'.provider_id');
			$this->db->where(PROVIDER_MASTER.'.status','1');
			$this->db->where(PRODUCT_PROVIDER_MAP.'.product_id',$product_id);
			$this->db->group_by(PROVIDER_MASTER.'.provider_id'); 
			$query = $this->db->get();
			return $query->result();
        }
		
}
?>