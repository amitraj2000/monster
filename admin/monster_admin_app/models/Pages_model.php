<?php
class Pages_model extends CI_Model {
	
				
		public function get_total_pages($args=array())
        {                
			$this->db->select('page_id');
			$this->db->from(PAGE_MASTER);
			$this->db->where('status','1');
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_pages($args=array())
        {                
			$this->db->select('*');
			$this->db->from(PAGE_MASTER);
			$this->db->where('status','1');
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("page_id", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		public function get_page_by_id($page_id)
        {                
			$this->db->select('*');
			$this->db->from(PAGE_MASTER);
			$this->db->where('status','1');
			$this->db->where('page_id',$page_id);
			$query = $this->db->get();
			return $query->row();
        }
		public function get_page_by_slug($slug)
        {                
			$this->db->select('*');
			$this->db->from(PAGE_MASTER);
			$this->db->where('status','1');
			$this->db->where('slug',$slug);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function update_page($page_id,$data)
        {               
			
			$this->db->where('page_id', $page_id);
			$this->db->update(PAGE_MASTER, $data);
			
        }	


}
?>