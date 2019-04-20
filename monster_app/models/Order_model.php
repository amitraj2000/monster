<?php
class Order_model extends CI_Model {
		public function insert_into_cart($args){
			$this->db->insert(CART_MASTER, $args);
		}
		public function update_cart_item($cart_id='',$args){
			
			$this->db->where('cart_id', $cart_id);
			if(!empty($args)){
				foreach($args as $key=>$value)
				{
					$this->db->set($key, $value);
				}
			}
			$this->db->update(CART_MASTER);
		}
		public function destroy_cart($cart_id){
			$this->db->where('cart_id', $cart_id);
			$this->db->delete(CART_MASTER);
		}
		public function get_cart($email=''){
			if(empty($email))
				$email=get_current_user_email();
			//$this->db->insert(CART_MASTER, $args);
			$this->db->select('*');
			$this->db->from(CART_MASTER);
			$this->db->where('email',$email);
			$query = $this->db->get();
			return $query->row();
		}
		public function get_cart_by_id($cart_id){
			
			$this->db->select('*');
			$this->db->from(CART_MASTER);
			$this->db->where('cart_id',$cart_id);
			$query = $this->db->get();
			return $query->row();
		}
		
		
		public function insert_order($args)
		{
			$this->db->insert(ORDER_MASTER, $args);
		}
		public function insert_order_details($args)
		{
			$this->db->insert(ORDER_DETAILS, $args);
		}
		public function get_total_orders($args)
		{
			$current_user_id=get_current_user_id();
			
			$this->db->from(ORDER_MASTER);
			//$this->db->join(ORDER_DETAILS, ORDER_DETAILS.'.order_id = '.ORDER_MASTER.'.order_id');
			if(!empty($args['status']))
			$this->db->where_in(ORDER_MASTER.'.status',$args['status']);
			if(!empty($args['status_not_in']))
				$this->db->where_not_in(ORDER_MASTER.'.status',$args['status_not_in']);
			$this->db->where('user_id',$current_user_id);
			$this->db->group_by(ORDER_MASTER.'.order_id');
			//$query = $this->db->get();
			return $this->db->count_all_results();
		}
		public function get_orders($args)
		{
			$current_user_id=get_current_user_id();
			$this->db->select('*,'.ORDER_MASTER.'.date AS order_date,'.ORDER_MASTER.'.status AS order_status');
			$this->db->from(ORDER_MASTER);
			$this->db->join(ORDER_DETAILS, ORDER_DETAILS.'.order_id = '.ORDER_MASTER.'.order_id');
			$this->db->join(PRODUCT_MASTER, PRODUCT_MASTER.'.product_id = '.ORDER_DETAILS.'.product_id');
			$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			if(!empty($args['status']))
			$this->db->where_in(ORDER_MASTER.'.status',$args['status']);
			if(!empty($args['status_not_in']))
				$this->db->where_not_in(ORDER_MASTER.'.status',$args['status_not_in']);
			$this->db->where('user_id',$current_user_id);
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
		    $this->db->group_by(ORDER_DETAILS.".order_id");
			$this->db->order_by(ORDER_DETAILS.".date", "desc");
			$query = $this->db->get();
			return $query->result();
		}
		public function get_order_details_by_order_id($order_id)
		{
			
			$this->db->select('*');
			$this->db->from(ORDER_DETAILS);
			$this->db->where(ORDER_DETAILS.'.order_id',$order_id);			
			//$this->db->where('status!=',5);
			$query = $this->db->get();
			return $query->result();
		}
		public function get_order_details_by_id($order_details_id)
		{
			$current_user_id=get_current_user_id();
			$this->db->select('*');
			$this->db->from(ORDER_MASTER);
			$this->db->join(ORDER_DETAILS, ORDER_DETAILS.'.order_id = '.ORDER_MASTER.'.order_id');
			$this->db->join(PRODUCT_MASTER, PRODUCT_MASTER.'.product_id = '.ORDER_DETAILS.'.product_id');
			$this->db->join(MODEL_MASTER, MODEL_MASTER.'.model_id = '.PRODUCT_MASTER.'.model_id');
			$this->db->where(ORDER_DETAILS.'.order_details_id',$order_details_id);
			$this->db->where(ORDER_MASTER.'.user_id',$current_user_id);			
			//$this->db->where('status!=',5);
			$query = $this->db->get();
			return $query->row();
		}

		public function get_current_user_pending_order()
		{
			$current_user_id=get_current_user_id();
			$this->db->select('*');
			$this->db->from(ORDER_MASTER);
			$this->db->where('status',1);//1=>pending
			$this->db->where('user_id',$current_user_id);
			$query = $this->db->get();
			$result=$query->row();
			return $result;
		}
		public function delete_order_item($order_details_id)
		{
			$this->db->where('order_details_id', $order_details_id);
			$this->db->delete(ORDER_DETAILS);
		}
		public function update_order($order_id,$args)
		{
			$this->db->where('order_id', $order_id);
			if(!empty($args)){
				foreach($args as $key=>$value)
				{
					$this->db->set($key, $value);
				}
			}
			$this->db->update(ORDER_MASTER);
		}
		
}
?>