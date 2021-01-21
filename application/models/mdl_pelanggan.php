<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mdl_pelanggan extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	function get_pelanggan()
	{
		$table = "pelanggan";
		return $table;
	}

	public function select_pelanggan()
	{
		$this->db->select('pelanggan.*,
			owner.username');
		$table = $this->get_pelanggan();
		//join
		$this->db->join('owner', 'owner.id_user = pelanggan.id_user', 'left');
		$this->db->order_by('id_pelanggan', 'ASC');

		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function addPelanggan()
	{
		$field = array(
			'nama_plg' => $this->input->post('txtNamaPlg'),
			'alamat' => $this->input->post('txtAlamatPlg'),
			'no_telp' => $this->input->post('txtTelpPlg'),
			'id_user' => $this->input->post('txtOwner')
		);

		// $this->db->set('ID_PELANGGAN',"ID_PELANGGAN.NEXTVAL", FALSE);
		$this->db->insert('pelanggan', $field);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function cekPelanggan()
	{
		$id = $this->input->get('id');
		$this->db->where('id_pelanggan', $id);
		$query = $this->db->get('pelanggan');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function updatePelanggan()
	{
		$id = $this->input->post('txtId');
		$field = array(
			'nama_plg' => $this->input->post('txtNamaPlg'),
			'alamat' => $this->input->post('txtAlamatPlg'),
			'no_telp' => $this->input->post('txtTelpPlg'),
			'id_user' => $this->input->post('txtOwner')
		);

		$this->db->where('id_pelanggan', $id);
		$this->db->update('pelanggan', $field);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePelanggan()
	{
		$id = $this->input->get('id');
		$this->db->where('id_pelanggan', $id);
		$this->db->delete('pelanggan');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function getPelangganArr()
	{
		$table = $this->get_pelanggan();
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
}
