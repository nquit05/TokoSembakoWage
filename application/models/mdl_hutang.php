<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class mdl_hutang extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function get_hutang(){
		$table = "HUTANG";
		return $table;
	}

	function select_hutang(){
		$table = $this->get_hutang();
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function updateHutang(){
  		$id = $this -> input -> post('txtId');
  		$field = array(
  			'STATUS'=>$this -> input -> post('txtStatus')
  		);

  		$this -> db -> where('ID_HUTANG',$id);
  		$this -> db -> update('HUTANG', $field);
  		if($this -> db -> affected_rows() > 0){
  			return true;
  		}else{
  			return false;
  		}
  	}
  	public function cekHutang(){
  		$id = $this -> input -> get('id');
  		$this -> db -> where('ID_HUTANG', $id);
  		$query = $this -> db -> get('HUTANG');
  		if($query -> num_rows() > 0){
  			return $query -> row();
  		}else{
  			return false;
  		}
  	}
}