<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_barang', 'bm');
		$this->load->model('mdl_jenisBarang', 'mjs');
		$this->load->model('mdl_pelanggan', 'mplg');
		$this->load->model('mdl_transaksi', 'mdltrans');
		$this->load->model('mdl_detail_transaksi', 'mdldetail');
		$this->load->model('mdl_hutang', 'mdlhutang');
		$this->load->model('User_model');
	}

	public function security()
	{
		if (!$this->session->userdata('ID_USER')) {
			redirect(base_url() . 'admin/login_view');
		}
	}

	public function home()
	{
		$this->security();
		$this->load->view('index');
	}

	public function login_view()
	{
		$this->load->view('page/login_view');
	}





	//login------------------------------------------------------------------------------------------------

	public function login_user()
	{

		$user_login = array(

			'uname' => $this->input->post('usr'),
			'pass' => $this->input->post('pass')

		);

		$data = $this->User_model->login_user($user_login['uname'], $user_login['pass']);

		if ($data) {
			$this->session->set_userdata('ID_USER', $data['id_user']);
			$this->session->set_userdata('USERNAME', $data['username']);
			$this->load->view('index');
		} else {

			echo "<script>

			alert('Email Atau Password Salah ! ');
			window.location.href='" . base_url() . "admin/login_view';

			</script>";
		}
	}

	// Logout ------------------------------------------------------------------------------------------------

	public function user_logout()
	{

		$this->session->sess_destroy();
		redirect(base_url() . 'admin/login_view');
	}

	// Barang ----------------------------------------------------------------
	function tes()
	{ }
	public function barang()
	{

		$data['qbarang'] = $this->bm->join();
		$data['qjenis'] = $this->mjs->select_jenis();


		$this->security();
		$this->load->view('layout/header');
		$this->load->view('page/barang', $data);
		$this->load->view('layout/footer');
	}


	public function addBarang()
	{
		$result = $this->bm->addBarang();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function editBarang()
	{
		$result = $this->bm->editBarang();
		echo json_encode($result);
	}

	public function updateBarang()
	{
		$result = $this->bm->updateBarang();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function deleteBarang()
	{
		$result = $this->bm->deleteBarang();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	// Jenis Barang ===========================

	public function jenis()
	{
		$data['dataJenis'] = $this->mjs->view_jenis();
		$this->security();
		$this->load->view('layout/header');
		$this->load->view('page/jenis_barang', $data);
		$this->load->view('layout/footer');
	}

	public function addJenis()
	{
		$result = $this->mjs->addJenis();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function editJenis()
	{
		$result = $this->mjs->editJenis();
		echo json_encode($result);
	}

	public function updateJenis()
	{
		$result = $this->mjs->updateJenis();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function deleteJenis()
	{
		$result = $this->mjs->deleteJenis();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}


	// Pelanggan =================
	public function pelanggan()
	{
		$this->security();

		$data['dataPelanggan'] = $this->mplg->select_pelanggan();
		$this->load->view('layout/header');
		$this->load->view('page/pelanggan', $data);
		$this->load->view('layout/footer');
	}

	public function addPelanggan()
	{
		$result = $this->mplg->addPelanggan();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function getDataPelanggan()
	{
		$result = $this->mplg->cekPelanggan();
		echo json_encode($result);
	}

	public function updatePelanggan()
	{
		$result = $this->mplg->updatePelanggan();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function deletePelanggan()
	{
		$result = $this->mplg->deletePelanggan();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	// Transaksi =============================================================
	public function transaksi()
	{
		$this->security();

		$data['qbarangArr'] = $this->bm->getBarangArr();
		$data['qtrans'] = $this->mdltrans->select_transaksi();
		$data['qpelangganArr'] = $this->mplg->getPelangganArr();


		if (!$this->session->userdata('DETAIL')) {
			$dataSession = array();
			$this->session->set_userdata('DETAIL', $dataSession);
		} else {
			$dataSession = $this->session->userdata('DETAIL');
		}
		$data['qsessionDetail'] = $dataSession;

		$this->load->view('layout/header');
		$this->load->view('page/transaksi', $data);
		$this->load->view('layout/footer');
	}

	public function addTransaksi()
	{

		$harga = $this->bm->getHarga($this->input->post('txtBarang'))->harga;
		$nama = $this->bm->getHarga($this->input->post('txtBarang'))->nama_barang;

		$harga_total = $harga * $this->input->post('txtJumlah');

		if (!$this->session->userdata('DETAIL')) {
			$data = array(
				array(
					'id_barang' => $this->input->post('txtBarang'),
					'jumlah' => $this->input->post('txtJumlah'),
					'total_harga' => $harga_total,
					'nama_barang' => $nama
				)
			);
			$this->session->set_userdata('DETAIL', $data);
		} else {
			$temp = $this->session->userdata('DETAIL');
			$data = array(
				'id_barang' => $this->input->post('txtBarang'),
				'jumlah' => $this->input->post('txtJumlah'),
				'total_harga' => $harga_total,
				'nama_barang' => $nama
			);
			array_push($temp, $data);
			$this->session->set_userdata('DETAIL', $temp);
		}

		echo json_encode($this->session->userdata('DETAIL'));
	}

	public function insertTransaksi()
	{
		$pelanggan = $this->input->post('txtPelanggan');
		$detailTrans = $this->input->post('dataTransaksi');
		$hitung = 0;

		foreach (json_decode($detailTrans) as $row) {
			$hitung = $hitung + $row->total_harga;
		}

		$transaksi = $this->mdltrans->insertTransaksi($pelanggan, $hitung);

		foreach (json_decode($detailTrans) as $row) {
			$this->mdldetail->addDetail($transaksi, $row->id_barang, $row->jumlah, $row->total_harga);
		}

		$dataSession = array();
		$this->session->set_userdata('DETAIL', $dataSession);
		redirect(base_url() . 'admin/transaksi');
	}



	// Detail Transaksi =========================================================
	public function getDataDetail()
	{
		$result = $this->mdldetail->select_detail();
		echo json_encode($result);
	}

	public function cekIdDetail()
	{
		$result = $this->mdldetail->cekDetail();
		echo json_encode($result);
	}

	public function getIdDetail()
	{
		$result = $this->mdldetail->getIdDetail();
		return $result;
	}


	// HUTANG =======================================================
	public function transaksi_hutang()
	{
		$this->security();
		$data['qhutang'] = $this->mdlhutang->select_hutang();
		$this->load->view('layout/header');
		$this->load->view('page/transaksi_hutang', $data);
		$this->load->view('layout/footer');
	}

	public function updateHutang()
	{
		$result = $this->mdlhutang->updateHutang();
		$msg['success'] = false;
		if ($result) {
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function getDataHutang()
	{
		$result = $this->mdlhutang->cekHutang();
		echo json_encode($result);
	}
}
