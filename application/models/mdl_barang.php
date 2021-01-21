<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mdl_barang extends CI_Model
{

  function __construct()
  {
    $this->load->database();
  }

  function get_barang()
  {
    $table = "barang";
    return $table;
  }

  public function addBarang()
  {
    $field = array(
      'NAMA_BARANG' => $this->input->post('txtNamaBarang'),
      'ID_JENIS' => $this->input->post('txtJenisBarang'),
      'HARGA' => $this->input->post('txtHarga'),
      'STOK' => $this->input->post('txtStok'),
      'EXPIRED' => $this->input->post('txtExpired')
    );

    // $getWaktu = strtotime($this->input->post('txtExpired'));
    // $format = date('Y-m-d',$getWaktu);
    // $this->db->set('EXPIRED', "to_date('$format', 'YYYY-MM-DD')", false);

    // $this->db->set('ID_BARANG',"ID_BARANG.NEXTVAL", FALSE);
    $this->db->insert('barang', $field);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function editBarang()
  {
    $id = $this->input->get('id');
    $this->db->where('ID_BARANG', $id);
    $query = $this->db->get('BARANG');
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  public function updateBarang()
  {
    $id = $this->input->post('txtId');
    $field = array(
      'NAMA_BARANG' => $this->input->post('txtNamaBarang'),
      'ID_JENIS' => $this->input->post('txtJenisBarang'),
      'HARGA' => $this->input->post('txtHarga'),
      'STOK' => $this->input->post('txtStok'),
      'EXPIRED' => $this->input->post('txtExpired')
    );
    // $getWaktu = strtotime($this->input->post('txtExpired'));
    // $format = date('Y-m-d', $getWaktu);
    // $this->db->set('EXPIRED', "to_date('$format', 'YYYY-MM-DD')", false);

    // $this->db->where('ID_BARANG', $id);
    $this->db->update('barang', $field);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteBarang()
  {
    $id = $this->input->get('id');
    $this->db->where('id_barang', $id);
    $this->db->delete('barang');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  //select barang
  public function join()
  {
    $this->db->select('barang.*,
                            jenis_barang.nama_jenis');
    $table = $this->get_barang();
    //join
    $this->db->join('jenis_barang', 'jenis_barang.id_jenis = barang.id_jenis', 'left');
    $this->db->order_by('id_barang', 'ASC');

    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  function getBarangArr()
  {
    $table = $this->get_barang();
    $query = $this->db->get($table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  function getHarga($id)
  {
    return $this->db->get_where('BARANG', ["ID_BARANG" => $id])->row();
  }
}
