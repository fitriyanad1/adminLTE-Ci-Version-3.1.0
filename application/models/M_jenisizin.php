<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jenisizin extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('jenis_izin');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_all_except_pw() {
		$this->db->where('id_izin !=','1');
		$this->db->from('jenis_izin');

		$query = $this->db->get();

		return $query->result();
	}
}
/* End of file M_jenisizin.php */
/* Location: ./application/models/M_jenisizin.php */