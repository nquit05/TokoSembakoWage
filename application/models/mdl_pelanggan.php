<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_pelanggan extends CI_Model{
	function __construct(){
		$this -> load -> database();
	}

	function get_pelanggan(){
		$table = "PELANGGAN";
		return $table;
	}

	public function select_pelanggan(){
		$this -> db-> select('PELANGGAN.*,
			OWNER.USERNAME');
		$table = $this->get_pelanggan();
      //join
		$this->db->join('OWNER', 'OWNER.ID_USER = PELANGGAN.ID_USER', 'left');
		$this->db->order_by('ID_PELANGGAN', 'ASC');

		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query -> result();
		}else{
			return false;
		}
	}

  	function addPelanggan(){
	    $field = array(
	          'NAMA_PLG'=>$this -> input -> post('txtNamaPlg'),
	          'ALAMAT'=>$this -> input -> post('txtAlamatPlg'),
	          'NO_TELP'=>$this -> input -> post('txtTelpPlg'),
	          'ID_USER'=>$this -> input -> post('txtOwner')
	        );

	    $this->db->set('ID_PELANGGAN',"ID_PELANGGAN.NEXTVAL", FALSE);
	    $this->db->insert('PELANGGAN', $field);
	    if($this -> db -> affected_rows() > 0 ){
	      return true;
	    }else{
	      return false;
	    }
  	}

  	public function cekPelanggan(){
  		$id = $this -> input -> get('id');
  		$this -> db -> where('ID_PELANGGAN', $id);
  		$query = $this -> db -> get('PELANGGAN');
  		if($query -> num_rows() > 0){
  			return $query -> row();
  		}else{
  			return false;
  		}
  	}

  	public function updatePelanggan(){
  		$id = $this -> input -> post('txtId');
  		$field = array(
  			'NAMA_PLG'=>$this -> input -> post('txtNamaPlg'),
  			'ALAMAT'=>$this -> input -> post('txtAlamatPlg'),
  			'NO_TELP'=>$this -> input -> post('txtTelpPlg'),
  			'ID_USER'=>$this -> input -> post('txtOwner')

  		);

  		$this -> db -> where('ID_PELANGGAN',$id);
  		$this -> db -> update('PELANGGAN', $field);
  		if($this -> db -> affected_rows() > 0){
  			return true;
  		}else{
  			return false;
  		}
  	}

  	public function deletePelanggan(){
  		$id = $this->input->get('id');
  		$this->db->where('ID_PELANGGAN' , $id);
  		$this->db->delete('PELANGGAN');
  		if($this->db->affected_rows() > 0 ){
  			return true;
  		}else{
  			return false;
  		}
  	}

    function getPelangganArr(){
      $table = $this->get_pelanggan();
      $query = $this->db->get($table);
      if($query->num_rows() > 0){
       return $query->result_array();
     }else{
       return false;
     }
   }

}

?>