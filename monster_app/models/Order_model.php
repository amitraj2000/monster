<?php
class Order_model extends CI_Model {
	
		public function insert_order($args)
		{
			$this->db->insert(ORDER_MASTER, $args);
		}
		public function get_total_orders($args)
		{
			//$this->db->count_all_results();
			$this->db->from(ORDER_MASTER);
			$this->db->where_in('status',$args['status']);
			//$query = $this->db->get();
			return $this->db->count_all_results();
		}
		public function get_orders($args)
		{
			$this->db->select('*');
			$this->db->from(ORDER_MASTER);
			$this->db->where_in('status',$args['status']);
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query->result();
		}
		public function get_order_by_id($order_id)
		{
			$this->db->select('*');
			$this->db->from(ORDER_MASTER);
			$this->db->where('order_id',$order_id);
			$this->db->where('status!=',5);
			$query = $this->db->get();
			return $query->row();
		}
		
}
?>