<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mdl_transaksi extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}

	function get_transaksi(){
		$table ="TRANSAKSI";
		return $table;
	}

	public function select_transaksi(){
		$this -> db-> select('TRANSAKSI.*,
			PELANGGAN.NAMA_PLG,
			HUTANG.STATUS');
		$table = $this->get_transaksi();
      //join
		$this->db->join('PELANGGAN', 'PELANGGAN.ID_PELANGGAN = TRANSAKSI.ID_PELANGGAN', 'left');
		$this->db->join('HUTANG', 'HUTANG.ID_HUTANG = TRANSAKSI.ID_HUTANG', 'left');

		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query -> result();
		}else{
			return false;
		}
	}

	public function insertTransaksi($pelanggan , $hitung){

		$field = array(
	        'ID_PELANGGAN'=>$pelanggan,
	        'TOTAL_HARGA'=>$hitung
	   
      	);

		$format = date("Y-m-d");
		$this->db->set('TGL_TRANSAKSI', "to_date('$format', 'YYYY-MM-DD')", false);
		$this->db->set('NO_TRANSAKSI',"NO_TRANSAKSI.NEXTVAL", FALSE);
		

		$this->db->insert('TRANSAKSI',$field);
		if($this -> db -> affected_rows() > 0 ){
			$query = $this->db->query('SELECT MAX(NO_TRANSAKSI) as ID FROM TRANSAKSI');
			$row = $query->row();
			$id = $row->ID;
			return $id;
		}else{
			return false;
		}
	}



}

/* End of file mdl_transaksi.php */
/* Location: ./application/models/mdl_transaksi.php */