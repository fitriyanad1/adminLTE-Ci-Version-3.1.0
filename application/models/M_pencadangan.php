<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pencadangan extends CI_Model {
	public function select_all_perusahaan() {
		$sql = "SELECT * FROM pencadangan";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {

		$sql = "SELECT perusahaan.id as id, nm_perusahaan, jenis_izin.jenis_izin, perusahaan_izin.nmr_sk_pw, luas_wilayah, desa.desa AS nm_desa, kecamatan.kecamatan As nm_kecamatan, 
				kabupaten.nama as nm_kabupaten,komoditas.komoditas as nm_komoditas, perusahaan_izin.tgl_sk_pw
						FROM kecamatan,kabupaten,perusahaan LEFT OUTER JOIN desa ON (perusahaan.id_desa = desa.id_desa),komoditas, jenis_izin, perusahaan_izin
						Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
						perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
						perusahaan.id_komoditas = komoditas.id_komoditas AND
						jenis_izin.id_izin = perusahaan_izin.id_izin AND
						perusahaan_izin.id = perusahaan.id  AND
						jenis_izin.id_izin='1'";


		$data = $this->db->query($sql);

		return $data->result();
	}


	public function select_by_id($id) {
		$sql = "SELECT perusahaan.id as id, nm_perusahaan, perusahaan_izin.nmr_sk_pw, luas_wilayah, desa.id_desa as id_desa, desa.desa AS nm_desa, 
					kecamatan.id_kecamatan as id_kecamatan, kecamatan.kecamatan As nm_kecamatan, 
					kabupaten.id_kabupaten as id_kabupaten, kabupaten.nama as nm_kabupaten, 
					komoditas.id_komoditas as id_komoditas, komoditas.komoditas as nm_komoditas, perusahaan_izin.tgl_sk_pw
						FROM kecamatan,kabupaten,perusahaan LEFT OUTER JOIN desa ON (perusahaan.id_desa = desa.id_desa),komoditas, perusahaan_izin
						Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
						perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
						perusahaan.id_komoditas = komoditas.id_komoditas AND
						perusahaan_izin.id = perusahaan.id  AND
						perusahaan_izin.id_izin='1' AND
						perusahaan.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

		public function update($data) {
			$sql = "UPDATE perusahaan, perusahaan_izin
					SET perusahaan.nm_perusahaan='" .$data['nm_perusahaan'] ."', perusahaan.id_kabupaten='" .$data['kabupaten'] ."', 
						perusahaan.id_kecamatan='" .$data['kecamatan'] ."', perusahaan.id_desa='" .$data['desa'] ."', 
						perusahaan.id_komoditas='" .$data['komoditas'] ."', perusahaan_izin.nmr_sk_pw='" .$data['nmr_sk_pw'] ."', 
						perusahaan.luas_wilayah='" .$data['luas_wilayah'] ."', perusahaan_izin.tgl_sk_pw='".$data['tgl_sk_pw']."'
						WHERE perusahaan.id = perusahaan_izin.id AND perusahaan.id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM perusahaan WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		/*$sql = "INSERT INTO perusahaan VALUES ('yoyoyo','IUP','" .$data['nomor_sk'] ."','" .$data['luas_wilayah'] ."','" .$data['desa'] ."','" .$data['kecamatan'] ."','" .$data['kabupaten'] ."','" .$data['kegiatan'] ."','" .$data['komoditas'] ."','" .$data['tgl_mulai'] ."','" .$data['tgl_berakhir'] ."',1)";*/

		$sql = "INSERT INTO perusahaan 
					(nm_perusahaan, luas_wilayah, id_kabupaten, id_kecamatan, id_desa, id_komoditas) 
				VALUES 
					('".$data['nm_perusahaan']."', '".$data['luas_wilayah']."', '".$data['kabupaten']."', '".$data['kecamatan']."', '".$data['desa'] ."', '".$data['komoditas']."')";
		$this->db->query($sql);

		$id_perusahaan = $this->db->insert_id($sql);
		$sql2 = "INSERT INTO perusahaan_izin
					(id, id_izin, tgl_sk_pw, nmr_sk_pw,status)
				VALUES
					('".$id_perusahaan."', 1, '".$data['tgl_sk_pw']."', '".$data['nmr_sk_pw']."', '-')";

		$this->db->query($sql2);

		return $this->db->affected_rows();
	}

	public function approve($data) {

		$sql = "INSERT INTO perusahaan (nm_perusahaan, luas_wilayah, id_desa, id_kecamatan,id_kabupaten, id_komoditas)
				SELECT nm_perusahaan, luas_wilayah, desa.id_desa AS id_desa, kecamatan.id_kecamatan as id_kecamatan, kabupaten.id_kabupaten as id_kabupaten,komoditas.id_komoditas as id_komoditas
				FROM kecamatan,kabupaten,perusahaan LEFT OUTER JOIN desa ON (perusahaan.id_desa = desa.id_desa),komoditas
				Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
				perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
				perusahaan.id_komoditas = komoditas.id_komoditas 
				AND perusahaan.id = '" .$data['id'] ."'";

		$this->db->query($sql);

		$id_perusahaan = $this->db->insert_id($sql);
		$sql2 = "INSERT INTO perusahaan_izin
					(id, id_izin, tgl_mulai, tgl_berakhir,nomor_sk,status)
				VALUES
					('".$id_perusahaan."','".$data['jenis_izin']."', '".$data['tgl_mulai']."', '".$data['tgl_berakhir']."','".$data['nomor_sk']."', '".$data['status']."')";

		$this->db->query($sql2);

		return $this->db->affected_rows();
	}


/*	public function insert_batch($data) {
		$this->db->insert_batch('pegawai', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}*/
	public function total_rows() {
		$data = $this->db->get('perusahaan');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */