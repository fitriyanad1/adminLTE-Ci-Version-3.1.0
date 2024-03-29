<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_perusahaan');
		$this->load->model('M_lokasi');
		$this->load->model('M_jenisizin');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataPerusahaan'] = $this->M_perusahaan->select_all();
		$data['dataKabupaten'] = $this->M_lokasi->select_all_lokasi();
		$data['dataJenisIzin'] = $this->M_jenisizin->select_all_except_pw();

		$data['page'] = "perusahaan";
		$data['judul'] = "Daftar Izin Perusahaan Pertambangan MBLB";
		$data['deskripsi'] = "Kelola Data Perusahaan";

		$data['modal_tambah_perusahaan'] = show_my_modal('modals/modal_tambah_perusahaan', 'tambah-perusahaan', $data);
		//$current_date = date('Y-m-d');
		//echo $current_date;

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		$this->template->views('perusahaan/home', $data);
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
		$data['dataPerusahaan'] = $this->M_perusahaan->select_all();


		$this->load->view('perusahaan/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nm_perusahaan', 'Nama Perusahaan','trim|required');
		$this->form_validation->set_rules('nomor_sk','Nomor SK','trim|required');
		$this->form_validation->set_rules('luas_wilayah','Luas Wilayah','trim|required');
		$this->form_validation->set_rules('kabupaten','Kabupaten', 'trim|required');
		$this->form_validation->set_rules('kecamatan','Kecamatan', 'trim|required');
		// $this->form_validation->set_rules('desa','Desa', 'trim|required');
		$this->form_validation->set_rules('jenis_izin','Jenis Izin', 'trim|required');
		$this->form_validation->set_rules('komoditas','Komoditas', 'trim|required');
		$this->form_validation->set_rules('tgl_mulai','Tanggal Mulai Berlaku','trim|required');
		$this->form_validation->set_rules('tgl_berakhir','Tanggal Masa Berlaku Berakhir','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_perusahaan->insert($data);

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
		$data['dataPerusahaan'] = $this->M_perusahaan->select_by_id($id);

		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_perusahaan', 'update-perusahaan', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nm_perusahaan', 'Nm_Perusahaan', 'trim|required');
		$this->form_validation->set_rules('nomor_sk', 'Nomorsk', 'trim|required');
		$this->form_validation->set_rules('luas_wilayah', 'Luaswilayah', 'trim|required');
		 $this->form_validation->set_rules('kecamatan', 'Kecamatan');
		$this->form_validation->set_rules('kabupaten','Kabupaten');
		 $this->form_validation->set_rules('komoditas', 'Komoditas');
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai Berlaku', 'trim|required');
		$this->form_validation->set_rules('tgl_berakhir', 'Tanggal Berakhir', 'trim|required');


		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_perusahaan->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Perusahaan Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Perusahaan Gagal diupdate', '20px');
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

/*	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_pegawai->select_all_pegawai();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nomor Telepon");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "ID Kota");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "ID Kelamin");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "ID Posisi");
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "Status");
		$rowCount++;

		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$rowCount, $value->telp, PHPExcel_Cell_DataType::TYPE_STRING);
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->id_kota); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->id_kelamin); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->id_posisi); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->status); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Pegawai.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Pegawai.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$id = md5(DATE('ymdhms').rand());
						$check = $this->M_pegawai->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['id'] = $id;
							$resultData[$index]['nama'] = ucwords($value['B']);
							$resultData[$index]['telp'] = $value['C'];
							$resultData[$index]['id_kota'] = $value['D'];
							$resultData[$index]['id_kelamin'] = $value['E'];
							$resultData[$index]['id_posisi'] = $value['F'];
							$resultData[$index]['status'] = $value['G'];
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_pegawai->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Pegawai Berhasil diimport ke database'));
						redirect('Pegawai');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('Pegawai');
				}

			}
		}
	}*/
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */