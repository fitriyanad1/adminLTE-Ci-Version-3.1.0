<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaProduksi extends AUTH_Controller {
	//public static $id = 8989;
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kelola_produksi');
		$this->load->library('pdf');
	}

	public function index() {
		//$id = trim($_POST['id']);
		$id = $this->input->post('id');
		// echo 'IDnya adalah : ' .$id;
		$data['userdata'] = $this->userdata;

		
		$data['dataTarif'] = $this->M_kelola_produksi->select_tarif_id($id);//tarif id kabupaten yang di select 
		$data['dataKelola'] = $this->M_kelola_produksi->select_by_id($id);//perusahaan id yang di select 
		$data['dataHarga'] = $this->M_kelola_produksi->select_harga_id($id);//harga id kabupaten yang di select 
	

		$data['page'] = "kelola_produksi";
		$data['judul'] = "Kelola Pajak";
		$data['deskripsi'] = "Kelola Data Produksi";

		// echo "<pre>";
		// print_r($data['dataKelola']);
		// echo "</pre>";
		
		echo $data['modal_tambah_pajak'] = show_my_modal('modals/modal_tambah_pajak','tambah-pajak', $data);
		

		// $this->tampil($id);

		// echo "id static: ".static::$id;

		$this->template->views('kelola_produksi/home', $data);
		
	}

	public function tampil() {
		//$id = $this->input->post('id');
		$id = trim($_POST['id']);
		// $id_prod = $id_perusahaan;
		// echo "id_prod :".$id_prod;
		$data['userdata'] = $this->userdata;
		$data['dataKelola'] = $this->M_kelola_produksi->select_by_id($id);

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// echo "id_perusahaan muncul di tampil :".$id_perusahaan;

		// $this->load->view('kelola_produksi/list_data', $data);
	}

	public function hitung_pajak() {
		$a = $this->input->post('volume');
		if($this->input->post('volume')){
			$output = $a * 1;
			return $output;
			//echo $this->M_kelola_produksi->hitung_pajak($this->input->post('id_kabupaten'));
		}
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
		$this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
		$this->form_validation->set_rules('volume', 'Volume', 'trim|required');
		$this->form_validation->set_rules('total_pajak', 'Total Pajak Bayar', 'trim|required');
// $id = trim($_POST['id']);
		

		$data = $this->input->post();
		//  echo "<pre>";
		//  print_r($data);
		//  echo "</pre>";
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_kelola_produksi->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Produksi Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Produksi Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}


	public function bayar() {
		$id = trim($_POST['id']);
		// echo 'IDnya di bayar adalah : ' .$id;

		$data['dataKelola'] = $this->M_kelola_produksi->select_by_id_bayar($id);
		
		// echo "<pre>";
		// echo print_r($data['dataKelola']);
		// echo "</pre>";
		//$data['dataPerusahaan'] = $this->M_perusahaan->select_by_id($id);
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_pajak_bayar', 'update-bayar', $data);
	}

	public function prosesBayar() {
		$this->form_validation->set_rules('nominal', 'Nominal Pajak', 'trim|required');
		$id = trim($_POST['id']);
		$data['total_pajak'] = trim($_POST['total_pajak']);
		$data['pajak_bayar'] = trim($_POST['pajak_bayar']);

		if(empty($_FILES['bukti_bayar']['name'])){
			$this->form_validation->set_rules('bukti_bayar', 'File Bukti Bayar', 'required');
		}
		$data = $this->input->post();
		$config['upload_path'] = './assets/buktibayar/';
		$config['allowed_types'] = 'jpg|png|pdf';
		
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('bukti_bayar')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data_foto = $this->upload->data();
			$data['nm_bukti'] = $data_foto['file_name'];
			// echo "<pre>";
			// echo print_r($data_foto);
			// echo "</pre>";
		}
		// echo "<pre>";
		// echo print_r($data);
		// echo "</pre>";
		if ($this->form_validation->run() == TRUE && $this->upload->do_upload('bukti_bayar')) {
			// echo "<pre>";
			// echo print_r($data['dataBukti']);
			// echo "</pre>";
			$result = $this->M_kelola_produksi->updateBuktiBayar($data, $id);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Pembayaran Pajak Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Pembayaran Pajak Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			if($this->form_validation->run() != TRUE){
				$out['msg'] = show_err_msg(validation_errors());
			}else{
				$out['msg'] = show_err_msg($error['error']);
			}
			
		}

		echo json_encode($out);
	}
	public function export() {
		$id = $this->input->post('id');
		//$id = $this->uri->segment(3);
		//echo "id di export adalah : " + $id;

		 $curYear = date('Y'); 
		 echo $curYear;

		$data['dataKelola']= $this->M_kelola_produksi->select_export_id($id,$curYear);
		$data['dataNM'] = $this->M_kelola_produksi->select_nm_id($id);
		$data['dataIdentitas'] = $this->M_kelola_produksi->select_identitas_id($id);
		$data['dataJumlah'] = $this->M_kelola_produksi->select_sum_id($id);




		$this->load->view('kelola_produksi/view_lap', $data);
	}


}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */