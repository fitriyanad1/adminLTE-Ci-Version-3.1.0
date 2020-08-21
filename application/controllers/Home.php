<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		// $this->load->model('M_pegawai');
		// $this->load->model('M_posisi');
		// $this->load->model('M_kota');
		$this->load->model('M_perusahaan');
		$this->load->model('M_admin');
		$this->load->model('M_kelola_produksi');

	}

	public function index() {
		$data['jml_perusahaan'] = $this->M_perusahaan->total_rows();
		$data['jml_admin'] = $this->M_admin->total_rows();
		//$data['jml_posisi'] 	= $this->M_posisi->total_rows();
		//$data['jml_kota'] 		= $this->M_kota->total_rows();
		$data['userdata'] 		= $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		
		$kabupaten 	= $this->M_perusahaan->select_all_kab();
		$index = 0;
		foreach ($kabupaten as $value) {
		    $color = '#' .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)] .$rand[rand(0,15)];

			$pajak_by_kab = $this->M_kelola_produksi->pajak_by_kabupaten($value->id_kabupaten);
			//echo ($value->id_kabupaten);
			if (($data_posisi[$index]['value'] = $pajak_by_kab->bayar ) != null)
			{
				$data_posisi[$index]['value'] = $pajak_by_kab->bayar;
			}
			else{
				$data_posisi[$index]['value'] = 0;
			}
			
			$data_posisi[$index]['color'] = $color;
			$data_posisi[$index]['highlight'] = $color;
			$data_posisi[$index]['label'] = $value->nama;


			//echo $index;
			//echo "<br>";
			$index++;
		}
		/*echo var_dump($pajak_by_kab);
		echo "<pre>";
			print_r($data_posisi);
			echo "</pre>";*/

			$kab	= $this->M_perusahaan->select_all_kab();
			$index = 0;
			foreach ($kab as $value) {
				$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
	
				$perusahaan_by_kab = $this->M_perusahaan->perusahaan_by_kabupaten($value->id_kabupaten);
	
				$data_kota[$index]['value'] = $perusahaan_by_kab->nm_perusahaan;
				$data_kota[$index]['color'] = $color;
				$data_kota[$index]['highlight'] = $color;
				$data_kota[$index]['label'] = $value->nama;
				
				$index++;
			}
			//echo var_dump($pegawai_by_kota);
			/*echo "<pre>";
			print_r($data_kota);
			echo "</pre>";*/
	
			$data['data_posisi'] = json_encode($data_posisi);
			$data['data_kota'] = json_encode($data_kota);
	
			$data['page'] 			= "home";
			$data['judul'] 			= "Dashboard";
			//$data['deskripsi'] 		= "Kelola data";
	
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
			$this->template->views('home', $data);
		
	}
}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */