<?php
class User_model extends CI_Model {
	
		public function validate_login($email,$password)
        {                
			$this->db->select('user_id');
			$this->db->from(USER_MASTER);
			$this->db->where('email', $email);
			$this->db->where('password', md5($password));
			$this->db->where_in('role',array('1','2'));
			$this->db->where('status','1');	
			return $this->db->get()->row();
        }
		public function is_email_exists($email)
        {                
			$this->db->select('user_id');
			$this->db->from(USER_MASTER);
			$this->db->where('email',$email);
			$this->db->where('status','1');	
			$query = $this->db->get();
			return $query->row();
        }
		
		public function get_total_users($args=array())
        {                
			$this->db->select('user_id');
			$this->db->from(USER_MASTER);
			$this->db->where('status','1');
			$query = $this->db->get();
			return $query->num_rows();
        }
		
		public function get_users($args=array())
        {                
			$this->db->select('*');
			$this->db->from(USER_MASTER);
			$this->db->where('status','1');
			if(isset($args['limit']) && isset($args['start_index']))
			$this->db->limit($args['limit'], $args['start_index']);
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query->result();
        }
		public function get_user_by_id($user_id)
        {                
			$this->db->select('*');
			$this->db->from(USER_MASTER);
			$this->db->where('status','1');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get();
			return $query->row();
        }
		
		public function delete_user($user_id)
        {                
			$data = array(
					'status' => '3',
			);
			$this->db->where('user_id', $user_id);
			$this->db->update(USER_MASTER, $data);
			
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