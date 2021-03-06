<?php
class User_model extends CI_Model {
	
		public function validate_login($email,$password)
        {                
			$this->db->select('user_id');
			$this->db->from(USER_MASTER);
			$this->db->where('email', $email);
			$this->db->where('password', md5($password));
			$this->db->where_in('role',array('3'));
			$this->db->where('status','1');
			return $this->db->get()->row();
        }
		public function register_user($args)
        {                
			$this->db->insert(USER_MASTER, $args);			
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
		 public function get_user_by_id($user_id)
        {                
			$this->db->select('*');
			$this->db->from(USER_MASTER);
			$this->db->where('user_id',$user_id);
			$this->db->where('status','1');
			$query = $this->db->get();
			return $query->row();
        }
		public function get_user_by_email($email)
        {                
			$this->db->select('*');
			$this->db->from(USER_MASTER);
			$this->db->where('email',$email);
			$this->db->where('status','1');
			$query = $this->db->get();
			return $query->row();
        }
		public function update_user($user_id,$args)
        {                
			$this->db->where('user_id', $user_id);
			$this->db->update(USER_MASTER, $args);
        }


}
?>