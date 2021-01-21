<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mdl_transaksi extends CI_Model
{

	function __construct()
	{
		$this->load->database();
	}

	function get_transaksi()
	{
		$table = "transaksi";
		return $table;
	}

	public function select_transaksi()
	{
		$this->db->select('transaksi.*,
			pelanggan.nama_plg,
			hutang.status');
		$table = $this->get_transaksi();
		//join
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'left');
		$this->db->join('hutang', 'hutang.id_hutang = transaksi.id_hutang', 'left');

		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function insertTransaksi($pelanggan, $hitung)
	{

		$field = array(
			'id_pelanggan' => $pelanggan,
			'total_harga' => $hitung

		);

		// $format = date("Y-m-d");
		// $this->db->set('TGL_TRANSAKSI', "to_date('$format', 'YYYY-MM-DD')", false);
		// $this->db->set('NO_TRANSAKSI', "NO_TRANSAKSI.NEXTVAL", FALSE);


		$this->db->insert('transaksi', $field);
		if ($this->db->affected_rows() > 0) {
			$query = $this->db->query('SELECT MAX(no_transaksi) as ID FROM transaksi');
			$row = $query->row();
			$id = $row->ID;
			return $id;
		} else {
			return false;
		}
	}
}
