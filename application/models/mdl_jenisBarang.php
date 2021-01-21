<?php
defined('BASEPATH') or exit('No direct script access allowed');


class mdl_jenisBarang extends CI_Model
{

  function __construct()
  {
    $this->load->database();
  }

  function get_jenis()
  {
    $table = "jenis_barang";
    return $table;
  }

  function select_jenis()
  {
    $table = $this->get_jenis();
    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  function view_jenis()
  {
    $table = $this->get_jenis();
    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  function addJenis()
  {
    $field = array(
      'nama_jenis' => $this->input->post('txtNamaJenis')
    );

    // $this->db->set('ID_JENIS',"ID_JENIS.NEXTVAL", FALSE);
    $this->db->insert('jenis_barang', $field);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function editJenis()
  {
    $id = $this->input->get('id');
    $this->db->where('id_jenis', $id);
    $query = $this->db->get('jenis_barang');
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }
  public function updateJenis()
  {
    $id = $this->input->post('txtId');
    $field = array(
      'nama_jenis' => $this->input->post('txtNamaJenis')
    );

    $this->db->where('id_jenis', $id);
    $this->db->update('jenis_barang', $field);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
  public function deleteJenis()
  {
    $id = $this->input->get('id');
    $this->db->where('id_jenis', $id);
    $this->db->delete('jenis_barang');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
