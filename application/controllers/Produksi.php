<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_produksi');
		$this->load->library('pdf');
		//$this->load->model('M_jenisizin');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataProduksi'] = $this->M_produksi->select_all();
		//$data['dataKabupaten'] = $this->M_lokasi->select_all_lokasi();
		//$data['dataJenisIzin'] = $this->M_jenisizin->select_all_except_pw();

		$data['page'] = "produksi";
		$data['judul'] = "Daftar Izin Perusahaan Berproduksi";
		$data['deskripsi'] = "Kelola Data Produksi";

		//$data['modal_tambah_produksi'] = show_my_modal('modals/modal_tambah_produksi', 'tambah-produksi', $data);
		// $current_date = date('Y-m-d');
		// echo $current_date;

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		$this->template->views('produksi/home', $data);
	}

	public function tampil() {
		$data['userdata'] = $this->userdata;

		if($data['userdata']->hak_akses == 1){
			$data['dataProduksi'] = $this->M_produksi->select_all();
		}else{
			$data['dataProduksi'] = $this->M_produksi->select_by_cabdin($data['userdata']->cabdin_esdm);
		}
		$this->load->view('produksi/list_data', $data);
	}

	public function tampilprod() {
		$data['dataKelola'] = $this->M_produksi->select_all();

		$this->load->view('produksi/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pegawai->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pegawai Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Pegawai Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataPegawai'] = $this->M_pegawai->select_by_id($id);
		$data['dataPosisi'] = $this->M_posisi->select_all();
		$data['dataKota'] = $this->M_kota->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_pegawai', 'update-pegawai', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
		$this->form_validation->set_rules('posisi', 'Posisi', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pegawai->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pegawai Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pegawai Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function ambilProduksi (){
		$id = trim($_POST['id']);

		$data['dataKelola'] = $this->M_produksi->select_by_id($id);
		$data['userdata'] = $this->userdata;
		$data['page'] = "kelola_produksi";

		$this->template->views('kelola_produksi/home', $data);
		//echo show_my_modal('modals/modal_update_pegawai', 'update-pegawai', $data);
	}


	public function export() {
		$data['userdata'] = $this->userdata;
		if($data['userdata']->hak_akses == 1){
			$data['dataProduksi'] = $this->M_produksi->select_all();
		}else{
			$data['dataProduksi'] = $this->M_produksi->select_export_by_cabdin($data['userdata']->cabdin_esdm);
		}
		/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
		$this->load->view('produksi/view_lap', $data);
	
	}



}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */