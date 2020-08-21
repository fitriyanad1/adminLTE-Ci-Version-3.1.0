<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perusahaan extends CI_Model {
	
	public function select_all_kab() {
		$this->db->select('*');
		$this->db->from('kabupaten');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_all_perusahaan() {
		$sql = "SELECT * FROM perusahaan";

		$data = $this->db->query($sql);
		print $data;

		return $data->result();
	}

	public function select_all() {
		$sql = "SELECT perusahaan.id as id, nm_perusahaan, jenis_izin.jenis_izin, nomor_sk, luas_wilayah, desa.id_desa AS id_desa,desa.desa AS nm_desa, kecamatan.kecamatan As nm_kecamatan, 
				kabupaten.nama as nm_kabupaten,komoditas.komoditas as nm_komoditas, tgl_mulai, tgl_berakhir, perusahaan_izin.status
						FROM kecamatan,kabupaten,perusahaan LEFT OUTER JOIN desa ON (perusahaan.id_desa = desa.id_desa),komoditas, jenis_izin, perusahaan_izin
						Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
						perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
						perusahaan.id_komoditas = komoditas.id_komoditas AND
						jenis_izin.id_izin = perusahaan_izin.id_izin AND
						perusahaan_izin.id = perusahaan.id  AND
						jenis_izin.id_izin!='1'";


		$data = $this->db->query($sql);

		return $data->result();
	}

/*	public function select_all() {
		$sql = " SELECT perusahaan.id_perusahaan AS id_perusahaan, perusahaan.nm_perusahaan AS nm_perusahaan, perusahaan.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM perusahaan WHERE perusahaan.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id";

		$data = $this->db->query($sql);

		return $data->result();
	}*/
	public function select_by_id($id) {
		/*$sql = "SELECT perusahaan_izin.id_relasi as id_relasi, perusahaan.id as id,nm_perusahaan, perusahaan_izin.id_izin as id_izin, jenis_izin.jenis_izin, nomor_sk,luas_wilayah, 
					desa.desa AS nm_desa, kecamatan.kecamatan As nm_kecamatan, kabupaten.nama as nm_kabupaten,komoditas.komoditas as nm_komoditas, 
					tgl_mulai, tgl_berakhir, perusahaan_izin.status
						FROM perusahaan,kabupaten,kecamatan,desa,komoditas, jenis_izin, perusahaan_izin
						Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
						perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
						perusahaan.id_desa = desa.id_desa AND 
						perusahaan.id_komoditas = komoditas.id_komoditas AND
						jenis_izin.id_izin = perusahaan_izin.id_izin AND
						perusahaan_izin.id = perusahaan.id AND perusahaan.id = '{$id}'";*/

		$sql = "SELECT  perusahaan_izin.id_relasi as id_relasi,perusahaan.id as id,nm_perusahaan,perusahaan_izin.id_izin as id_izin,jenis_izin.jenis_izin,nomor_sk,luas_wilayah, desa.id_desa as id_desa, desa.desa AS nm_desa, 
					kecamatan.id_kecamatan as id_kecamatan, kecamatan.kecamatan As nm_kecamatan, 
					kabupaten.id_kabupaten as id_kabupaten, kabupaten.nama as nm_kabupaten, 
					komoditas.id_komoditas as id_komoditas, komoditas.komoditas as komoditas, tgl_mulai, tgl_berakhir, perusahaan_izin.status
						FROM kecamatan,kabupaten,perusahaan LEFT OUTER JOIN desa ON (perusahaan.id_desa = desa.id_desa),komoditas, perusahaan_izin,jenis_izin
						Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
						perusahaan.id_kecamatan = kecamatan.id_kecamatan AND 
						perusahaan.id_komoditas = komoditas.id_komoditas AND
                        jenis_izin.id_izin = perusahaan_izin.id_izin AND
						perusahaan_izin.id = perusahaan.id  AND
						perusahaan.id= '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {
			$sql = "UPDATE perusahaan, perusahaan_izin
					SET perusahaan.nm_perusahaan='" .$data['nm_perusahaan'] ."', perusahaan_izin.nomor_sk='" .$data['nomor_sk'] ."', 
					perusahaan.luas_wilayah='" .$data['luas_wilayah'] ."', tgl_mulai='".$data['tgl_mulai']."', tgl_berakhir='".$data['tgl_berakhir']."', perusahaan_izin.status='".$data['status']."'
						WHERE perusahaan.id = perusahaan_izin.id AND perusahaan.id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

		public function updatePencadangan($data) {
			$sql = "UPDATE perusahaan, perusahaan_izin
					SET perusahaan.nm_perusahaan='" .$data['nm_perusahaan'] ."', perusahaan_izin.nomor_sk='" .$data['nomor_sk'] ."', 
					perusahaan.luas_wilayah='" .$data['luas_wilayah'] ."', tgl_mulai='".$data['tgl_mulai']."', tgl_berakhir='".$data['tgl_berakhir']."', perusahaan_izin.status='".$data['status']."'
						WHERE perusahaan.id = perusahaan_izin.id AND perusahaan.id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM perusahaan_izin WHERE id_relasi='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data) {
		/*$sql = "INSERT INTO perusahaan (nm_perusahaan,jenis_izin,nomor_sk,luas_wilayah,id_desa,id_kecamatan,id_kabupaten,kegiatan,id_komoditas,tgl_mulai,tgl_berakhir) VALUES ('" .$data['nm_perusahaan'] ."', 'IUP', '" .$data['nomor_sk'] ."', '" .$data['luas_wilayah'] ."', '" .$data['desa'] ."', '" .$data['kecamatan'] ."','" .$data['kabupaten'] ."','" .$data['kegiatan'] ."','" .$data['komoditas'] ."','" .$data['tgl_mulai'] ."','" .$data['tgl_berakhir'] ."')";*/
		
		$sql = "INSERT INTO perusahaan 
					(nm_perusahaan, luas_wilayah, id_kabupaten, id_kecamatan, id_desa, id_komoditas) 
				VALUES 
					('".$data['nm_perusahaan']."', '".$data['luas_wilayah']."', '".$data['kabupaten']."', '".$data['kecamatan']."', '".$data['desa'] ."', '".$data['komoditas']."')";
		$this->db->query($sql);

		$id_perusahaan = $this->db->insert_id($sql);
		$sql2 = "INSERT INTO perusahaan_izin
					(id, id_izin, tgl_mulai, tgl_berakhir, nomor_sk, status)
				VALUES
					('".$id_perusahaan."', '".$data['jenis_izin']."', '".$data['tgl_mulai']."', '".$data['tgl_berakhir']."', '".$data['nomor_sk']."', '".$data['status']."')";

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

	public function perusahaan_by_kabupaten($id_kabupaten) {
		//echo "Id Kabupaten adalah "+ $id_kabupaten;
		$sql = "SELECT COUNT(nm_perusahaan) as nm_perusahaan
		 from perusahaan, perusahaan_izin,kabupaten 
		 where perusahaan.id_kabupaten =kabupaten.id_kabupaten AND 
		 perusahaan.id =perusahaan_izin.id AND 
		 perusahaan_izin.status = 'Berproduksi' AND 
		 kabupaten.id_kabupaten = {$id_kabupaten} ";

		$data = $this->db->query($sql);
		//echo $data;
		

		return $data->row();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */