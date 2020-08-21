<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
		$this->load->model('M_admin');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			$session = $this->session->userdata('data');
			if($this->session->userdata['userdata']->hak_akses == 1){
				redirect('Home');
			}else{
				redirect('Produksi');
			}
		}
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);

			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Logged in"
				];
				$this->session->set_userdata($session);
				if($data->hak_akses == 1){
					redirect('Home');
				}else{
					redirect('Produksi');
				}			
				
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}




	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}



	public function regis()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('foto', 'Foto', 'required');
		
		//$this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');
		
		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$nama = trim($_POST['nama']);
			$foto = trim($_POST['foto']);

			$data = $this->M_admin->insert($username,  md5($password),$nama,$foto);
		}
		else{
			echo "gagal";
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */