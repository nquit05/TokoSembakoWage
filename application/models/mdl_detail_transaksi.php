<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_detail_transaksi extends CI_Model{
	function __construct()
	{
		$this->load->database();
	}

	function get_detail(){
		$table = "DETAIL_TRANSAKSI";
		return $table;
	}

	function select_detail(){
		$this -> db-> select('DETAIL_TRANSAKSI.*,
			BARANG.NAMA_BARANG');
		$table = $this->get_detail();
      //join
		$this->db->join('BARANG', 'BARANG.ID_BARANG = DETAIL_TRANSAKSI.ID_BARANG', 'left');

		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query -> result_array();
		}else{
			return false;
		}
	}

	public function cekDetail(){
  		$id = $this -> input -> get('id');
  		$this -> db -> where('NO_TRANSAKSI', $id);
  		$query = $this -> db -> get('DETAIL_TRANSAKSI');
  		if($query -> num_rows() > 0){
  			return $query -> row();
  		}else{
  			return false;
  		}
  	}	

  	public function getIdDetail(){
  		$id = $this -> input -> post('txtId');
  		return $id;
  	}

  	public function addDetail($no,$idBarang,$jumlah,$total){
		$field = array(
	        'NO_TRANSAKSI'=>$no,
	        'ID_BARANG'=>$idBarang,
	        'JUMLAH'=>$jumlah,
	        'TOTAL_HARGA'=>$total
      	);
   
    $this->db->insert('DETAIL_TRANSAKSI', $field);
    if($this -> db -> affected_rows() > 0 ){
      return true;
    }else{
      return false;
    }
	}

	

	
}
