<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lokasi extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('kabupaten');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_all_lokasi() {
		$this->db->order_by('nama','ASC');
		$this->db->from('kabupaten');

		$query = $this->db->get();

		return $query->result();
	}
	public function load_kecamatan ($id_kabupaten){
		$this->db->where('id_kabupaten',$id_kabupaten);
		$this->db->order_by('kecamatan','ASC');
		$query = $this->db->get('kecamatan');
		$output = '<option value="">-- Pilih Kecamatan --</option>';
		foreach ($query->result() as $row) {
		$output .= '<option data-kec="'.$row->id_kecamatan.'" value="'.$row->id_kecamatan.'">'.$row->kecamatan.'</option>'; 
		}
		return $output;
	}

	public function load_desa($id_kecamatan){
		$this->db->where('id_kecamatan',$id_kecamatan);
		$this->db->order_by('desa','ASC');
		$query = $this->db->get('desa');
		$output = '<option value="">-- Pilih Desa --</option>';
		foreach ($query->result() as $row) {
		$output .= '<option data-desa="'.$row->id_desa.'" value="'.$row->id_desa.'">'.$row->desa.'</option>'; 
		}
		return $output;
	}

	public function load_komoditas($id_kabupaten){
		$this->db->where('id_kabupaten',$id_kabupaten);
		$this->db->order_by('komoditas','ASC');
		$query = $this->db->get('komoditas');
		$output = '<option value="">-- Pilih Komoditas --</option>';
		foreach ($query->result() as $row) {
		$output .= '<option data-komoditas="'.$row->id_komoditas.'" value="'.$row->id_komoditas.'">'.$row->komoditas.'</option>'; 
		}
		return $output;
	}

}
/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */