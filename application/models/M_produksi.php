<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produksi extends CI_Model {
	public function select_all_produksi() {
		$data = $this->db->get('produksi');

		return $data->result();
	}

		public function select_all() {
		$sql = "SELECT perusahaan.id as id, nm_perusahaan,komoditas.komoditas as nm_komoditas,perusahaan_izin.status as status,jenis_izin.jenis_izin as jenis_izin , nomor_sk, luas_wilayah, desa.desa AS nm_desa, kecamatan.kecamatan As nm_kecamatan, 
				kabupaten.nama as nm_kabupaten,komoditas.komoditas as nm_komoditas, tgl_mulai, tgl_berakhir
					FROM perusahaan,komoditas, perusahaan_izin,jenis_izin,kabupaten,kecamatan,desa
					Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
					perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
					perusahaan.id_desa = desa.id_desa AND  
					perusahaan.id_komoditas = komoditas.id_komoditas AND 
					jenis_izin.id_izin = perusahaan_izin.id_izin AND 
					perusahaan_izin.id = perusahaan.id AND
					perusahaan_izin.id_izin = 2 AND
					perusahaan_izin.status='Berproduksi'";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_cabdin($id_cabdin) {
		$sql = "SELECT perusahaan.id as id, nm_perusahaan,
					   komoditas.komoditas as nm_komoditas,
					   perusahaan_izin.status as status,
					   jenis_izin.jenis_izin as jenis_izin, 
					   kabupaten.nama as nm_kabupaten, admin.nama
					FROM perusahaan,komoditas, perusahaan_izin,jenis_izin, kabupaten, admin
					WHERE perusahaan.id_komoditas = komoditas.id_komoditas AND 
					jenis_izin.id_izin = perusahaan_izin.id_izin AND 
					perusahaan_izin.id = perusahaan.id AND
					perusahaan.id_kabupaten = kabupaten.id_kabupaten AND
					perusahaan.id_komoditas = komoditas.id_komoditas AND 
					kabupaten.id = admin.id AND
					perusahaan_izin.id_izin = 2 AND	
					perusahaan_izin.status='Berproduksi' AND
					admin.cabdin_esdm='{$id_cabdin}'";


		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT perusahaan.id as id,tahun_produksi,bulan_produksi, volume, total_pajak,pajak_bayar, ket_bayar 
						FROM perusahaan,produksi
						Where produksi.id = perusahaan.id AND 
						perusahaan.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_export_by_cabdin($id_cabdin) {
		$sql = "SELECT perusahaan.id as id, nm_perusahaan,komoditas.komoditas as nm_komoditas,nomor_sk, luas_wilayah,tgl_mulai, tgl_berakhir, admin.nama, kabupaten.nama as nama_kab
					FROM perusahaan,komoditas, perusahaan_izin,jenis_izin,kabupaten,admin
					Where perusahaan.id_komoditas = komoditas.id_komoditas AND 
					jenis_izin.id_izin = perusahaan_izin.id_izin AND 
					perusahaan_izin.id = perusahaan.id AND
					perusahaan.id_kabupaten = kabupaten.id_kabupaten AND
					komoditas.id_kabupaten = kabupaten.id_kabupaten AND
					kabupaten.id = admin.id AND
					perusahaan_izin.id_izin = 2 AND	
					perusahaan_izin.status='Berproduksi' AND
					admin.cabdin_esdm='{$id_cabdin}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */