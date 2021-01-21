<?php
class User_model extends CI_model{
	public function __construct(){
        $this->load->database();
    }
	public function login_user($username,$pass){
		$this->db->select('*');
		$this->db->from('OWNER');
		$this->db->where('USERNAME',$username);
		$this->db->where('PASSWORD',$pass);

		if($query=$this->db->get())
		{
			return $query->row_array();
		}
		else{
			return false;
		}

	}

}
