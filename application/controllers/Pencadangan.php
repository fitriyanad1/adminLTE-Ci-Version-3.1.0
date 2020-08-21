<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencadangan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pencadangan');
		$this->load->model('M_lokasi');
		$this->load->model('M_jenisizin');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataPencadangan'] = $this->M_pencadangan->select_all();
		$data['dataKabupaten'] = $this->M_lokasi->select_all_lokasi();
		$data['dataJenisIzin'] = $this->M_jenisizin->select_all_except_pw();

		$data['page'] = "pencadangan";
		$data['judul'] = "Daftar Izin IUP Pencadangan Wilayah";
		$data['deskripsi'] = "Kelola Data pencadangan wilayah";

		$data['modal_tambah_pencadangan'] = show_my_modal('modals/modal_tambah_pencadangan', 'tambah-pencadangan', $data);
		//$data['modal_approve_pencadangan'] = show_my_modal('modals/modal_approve_pencadangan', 'approve-pencadangan', $data);
		/*$current_date = date('Y-m-d');
		echo $current_date;*/

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		$this->template->views('pencadangan/home', $data);
	}

	public function load_kecamatan() {
		if($this->input->post('id_kabupaten')){
			echo $this->M_lokasi->load_kecamatan($this->input->post('id_kabupaten'));
		}
	}

	public function load_desa() {
		if($this->input->post('id_kecamatan')){
			echo $this->M_lokasi->load_desa($this->input->post('id_kecamatan'));
		}
	}

	public function load_komoditas() {
		if($this->input->post('id_kabupaten')){
			echo $this->M_lokasi->load_komoditas($this->input->post('id_kabupaten'));
		}
	}


	public function tampil() {
		$data['dataPencadangan'] = $this->M_pencadangan->select_all();


		$this->load->view('pencadangan/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nm_perusahaan', 'Nm_Perusahaan','trim|required');
		$this->form_validation->set_rules('nmr_sk_pw','Nomorsk','trim|required');
		$this->form_validation->set_rules('luas_wilayah','Luaswilayah','trim|required');
		$this->form_validation->set_rules('desa','Desa');
		$this->form_validation->set_rules('kecamatan','Kecamatan','trim|required');
		$this->form_validation->set_rules('kabupaten','Kabupaten','trim|required');
		//$this->form_validation->set_rules('kegiatan','Kegiatan','trim|required');
		$this->form_validation->set_rules('komoditas','Komoditas','trim|required');
		$this->form_validation->set_rules('tgl_sk_pw','Tanggal Pengajuan','trim|required');
		//$this->form_validation->set_rules('tgl_berakhir','Tglberakhir','trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pencadangan->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Perusahaan Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Perusahaan Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);
		
		$data['dataKabupaten'] = $this->M_lokasi->select_all_lokasi();
		$data['dataPencadangan'] = $this->M_pencadangan->select_by_id($id);

		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_pencadangan', 'update-pencadangan', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nm_perusahaan', 'Nm_Perusahaan', 'trim|required');
		$this->form_validation->set_rules('nmr_sk_pw', 'Nomor sk', 'trim|required');
		$this->form_validation->set_rules('luas_wilayah', 'Luas wilayah', 'trim|required');
		$this->form_validation->set_rules('desa', 'Desa');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan','trim|required');
		$this->form_validation->set_rules('kabupaten','Kabupaten','trim|required');
		// $this->form_validation->set_rules('kegiatan', 'Kegiatan','trim|required');
		$this->form_validation->set_rules('komoditas','Komoditas','trim|required');
		$this->form_validation->set_rules('tgl_sk_pw','Tanggal Pengajuan','trim|required');
		//this->form_validation->set_rules('tgl_berakhir', 'Tglberakhir', 'trim|required');


		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pencadangan->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pencadangan Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pencadangan Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function approve() {
		$id = trim($_POST['id']);
		
		$data['dataJenisIzin'] = $this->M_jenisizin->select_all_except_pw();
		$data['dataPencadangan'] = $this->M_pencadangan->select_by_id($id);

		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_approve_pencadangan', 'approve-pencadangan', $data);
	}

		public function prosesApprove() {
		$this->form_validation->set_rules('nomor_sk', 'Nomor SK', 'trim|required');
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('tgl_berakhir', 'Tanggal Berakhir', 'trim|required');
		$this->form_validation->set_rules('jenis_izin', 'Jenis Izin','trim|required');
		$this->form_validation->set_rules('status', 'Status','trim|required');
		//$id = trim($_POST['id']);
		$data = $this->input->post();

		
		if ($this->form_validation->run() == TRUE) {
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
			$result = $this->M_pencadangan->approve($data);


			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pencadangan Berhasil diApprove', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pencadangan Gagal diApprove', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_perusahaan->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Perusahaan Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data perusahaan Gagal dihapus', '20px');
		}
	}

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */