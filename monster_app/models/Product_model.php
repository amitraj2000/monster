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
		
}
?>