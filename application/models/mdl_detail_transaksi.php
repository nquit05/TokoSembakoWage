<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mdl_detail_transaksi extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	function get_detail()
	{
		$table = "detail_transaksi";
		return $table;
	}

	function select_detail()
	{
		$this->db->select('detail_transaksi.*,
			barang.nama_barang');
		$table = $this->get_detail();
		//join
		$this->db->join('barang', 'barang.id_barang = detail_transaksi.id_barang', 'left');

		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function cekDetail()
	{
		$id = $this->input->get('id');
		$this->db->where('no_transaksi', $id);
		$query = $this->db->get('detail_transaksi');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getIdDetail()
	{
		$id = $this->input->post('txtId');
		return $id;
	}

	public function addDetail($no, $idBarang, $jumlah, $total)
	{
		$field = array(
			'no_transaksi' => $no,
			'id_barang' => $idBarang,
			'jumlah' => $jumlah,
			'total_harga' => $total
		);

		$this->db->insert('detail_transaksi', $field);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
