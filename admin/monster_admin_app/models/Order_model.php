<?php
class Order_model extends CI_Model {
		
		public function get_total_orders($args=array())
        {                
			$this->db->select('user_id');
			$this->db->from(ORDER_MASTER);
			$this->db->where('status!=','1');
			if(!empty($args['status']))
			$this->db->where_in('status',$args['status']);
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_orders($args=array())
        {                
			$this->db->select('*,'.ORDER_MASTER.'.status AS order_status');
			$this->db->from(ORDER_MASTER);
			$this->db->join(USER_MASTER, USER_MASTER.'.user_id = '.ORDER_MASTER.'.user_id');
			//$this->db->join(ORDER_DETAILS, ORDER_DETAILS.'.order_id = '.ORDER_MASTER.'.order_id');
			//$this->db->join(PRODUCT_MASTER, PRODUCT_MASTER.'.product_id = '.ORDER_DETAILS.'.product_id');
			//$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			//$this->db->where_in(ORDER_MASTER.'.status',$args['status']);
			$this->db->where(ORDER_MASTER.".status!=", "1");
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by(ORDER_MASTER.".date", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		public function get_order_by_id($order_id)
        {                
			$this->db->select('*,'.ORDER_MASTER.'.date AS order_date,'.ORDER_MASTER.'.status AS order_status');
			$this->db->from(ORDER_MASTER);
			$this->db->join(USER_MASTER, USER_MASTER.'.user_id = '.ORDER_MASTER.'.user_id');
			//$this->db->join(ORDER_DETAILS, ORDER_DETAILS.'.order_id = '.ORDER_MASTER.'.order_id');
			//$this->db->join(PRODUCT_MASTER, PRODUCT_MASTER.'.product_id = '.ORDER_DETAILS.'.product_id');
			//$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			$this->db->where(ORDER_MASTER.'.status!=','1');
			$this->db->where(ORDER_MASTER.'.order_id',$order_id);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function get_order_items_by_id($order_id)
        {                
			$this->db->select('*');
			$this->db->from(ORDER_DETAILS);
			$this->db->join(PRODUCT_MASTER, PRODUCT_MASTER.'.product_id = '.ORDER_DETAILS.'.product_id');
			$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			$this->db->where(ORDER_DETAILS.'.order_id',$order_id);
			$query = $this->db->get();
			return $query->result();
        }
		
		public function delete_order($order_id)
        {    
			$this->db->where(ORDER_MASTER.'.order_id', $order_id);
			$this->db->delete(ORDER_MASTER);
			$this->db->where(ORDER_DETAILS.'.order_id', $order_id);
			$this->db->delete(ORDER_DETAILS);
			
        }
		public function update_user($user_id,$data)
        {               
			
			$this->db->where('user_id', $user_id);
			$this->db->update(USER_MASTER, $data);
			
        }
		
		public function add_user($args)
        {                
			$this->db->insert(USER_MASTER, $args);			
        }
		
		


}
?>