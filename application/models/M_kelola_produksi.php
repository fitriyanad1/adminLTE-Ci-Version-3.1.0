<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelola_produksi extends CI_Model {
	public function select_all_produksi() {
		$data = $this->db->get('produksi');

		return $data->result();
	}

	public function select_all() {
		$sql = "SELECT perusahaan.id as id,tahun_produksi,bulan_produksi, volume, total_pajak,pajak_bayar, ket_bayar 
						FROM perusahaan,produksi
						Where produksi.id = perusahaan.id";


		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT perusahaan.id as id,produksi.id_produksi, nm_perusahaan,tahun_produksi,bulan_produksi, volume, total_pajak, pajak_bayar, ket_bayar,
						GROUP_CONCAT(DISTINCT nm_bukti ORDER BY tgl_upload ASC SEPARATOR '<br>') as nm_bukti, 
						GROUP_CONCAT(DISTINCT tgl_upload ORDER BY tgl_upload ASC SEPARATOR '<br>') as tgl
						FROM perusahaan, produksi LEFT JOIN bukti_bayar ON (produksi.id_produksi = bukti_bayar.id_produksi) 
						Where produksi.id = perusahaan.id AND
						perusahaan.id = '{$id}' 
						GROUP BY produksi.id_produksi
						ORDER BY produksi.tahun_produksi DESC";

		$data = $this->db->query($sql);
		
		return $data->result();
	}

	
	public function select_export_id($id,$curYear) {
		$sql = "SELECT perusahaan.id as id,nm_perusahaan,tahun_produksi,bulan_produksi, volume, total_pajak,pajak_bayar, ket_bayar 
						FROM perusahaan,produksi
						Where produksi.id = perusahaan.id AND 
						perusahaan.id = '{$id}' AND
						produksi.tahun_produksi = '{$curYear}'";

		$data = $this->db->query($sql);
		
		return $data->result();
	}

	public function select_by_id_bayar($id) {
		$sql = "SELECT perusahaan.id as id, produksi.id_produksi, tahun_produksi,bulan_produksi, volume, total_pajak,pajak_bayar, ket_bayar 
						FROM perusahaan,produksi
						Where produksi.id = perusahaan.id AND 
						produksi.id_produksi = '{$id}'";

		$data = $this->db->query($sql);
		
		return $data->row();
	}

	public function select_tarif_id($id) {
		$sql = "SELECT kabupaten.tarif as tarif, perusahaan.id as id,nm_perusahaan
		FROM perusahaan,kabupaten Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND perusahaan.id = '{$id}'";
		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_harga_id($id) {
		$sql = "SELECT perusahaan.id as id,nm_perusahaan,kabupaten.nama as nm_kabupaten,komoditas.komoditas as nm_komoditas,komoditas.harga as harga_komoditas
		FROM perusahaan,kabupaten,komoditas
		Where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND 
		perusahaan.id_komoditas = komoditas.id_komoditas AND 
		perusahaan.id = '{$id}'";
		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_identitas_id($id) {
		$sql = "SELECT perusahaan_izin.id_relasi as id_relasi, perusahaan.id as id,nm_perusahaan,nomor_sk,tgl_mulai, tgl_berakhir,kabupaten.nama as nama
						FROM perusahaan,perusahaan_izin,kabupaten
						Where 
						kabupaten.id_kabupaten=perusahaan.id_kabupaten AND
						perusahaan_izin.id = perusahaan.id AND perusahaan.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_nm_id($id) {
		$sql = "SELECT nm_perusahaan
						FROM perusahaan
						Where 
						perusahaan.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
	
	public function select_sum_id($id) {
		$sql = "SELECT SUM(volume) as volume, SUM(total_pajak) as total, SUM(pajak_bayar) as bayar,
				Sum(total_pajak)-Sum(pajak_bayar) as hutang
				FROM produksi,perusahaan
				WHERE produksi.id=perusahaan.id AND
				perusahaan.id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

		public function pajak_by_kabupaten($id_kabupaten) {
		//echo "Id Kabupaten adalah "+ $id_kabupaten;
		$sql = "SELECT SUM(pajak_bayar) as bayar,kabupaten.id_kabupaten,kabupaten.nama, nm_perusahaan
				from perusahaan, kabupaten, produksi
				where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND
				produksi.id = perusahaan.id AND
				kabupaten.id_kabupaten = {$id_kabupaten} 
				";

		$data = $this->db->query($sql);
		//echo $data;
		

		return $data->row();
	}

		public function produksi_by_kabupaten($id_kabupaten) {
		//echo "Id Kabupaten adalah "+ $id_kabupaten;
		$sql = "SELECT SUM(volume) as volume,kabupaten.id_kabupaten,kabupaten.nama, nm_perusahaan
				from perusahaan, kabupaten, produksi
				where perusahaan.id_kabupaten = kabupaten.id_kabupaten AND
				produksi.id = perusahaan.id AND
				kabupaten.id_kabupaten = {$id_kabupaten} 
				";

		$data = $this->db->query($sql);
		//echo $data;
		

		return $data->row();
	}


	public function insert($data) {
		$valid = true;
		$no=0;
		if(isset($data['tahun_produksi'])){
			foreach($data['tahun_produksi'] as $tahun){
				if($tahun == $data['tahun']){
					if($data['bulan_produksi'][$no] == $data['bulan']){
						$valid = false;
						$id_update = $data['id_produksi'][$no];
						$tahun_update = $tahun;
						$bulan_update = $data['bulan_produksi'][$no];
						$volume_awal = $data['volume_awal'][$no];
						$total_pajak_awal = $data['total_pajak_awal'][$no];
					}
				}
				$no++;
			}
		}
		
		if($valid){
			$sql = "INSERT INTO produksi (id,tahun_produksi, bulan_produksi, volume, total_pajak,pajak_bayar, ket_bayar)
				VALUES
					('".$data['id']."','".$data['tahun']."', '".$data['bulan']."', '".$data['volume']."','".$data['total_pajak']."', '0', 'Kurang Bayar Pajak')";

		}else{
			$volume_update = $volume_awal + $data['volume'];
			$total_pajak_update = $total_pajak_awal + $data['total_pajak'];
			$sql = "UPDATE produksi
					SET produksi.volume=".$volume_update.", produksi.total_pajak=".$total_pajak_update.", produksi.ket_bayar='Kurang Bayar Pajak'
					WHERE produksi.id_produksi=".$id_update." AND produksi.tahun_produksi=".$tahun_update." AND produksi.bulan_produksi='".$bulan_update."'";
		}
		
		$this->db->query($sql);

		return $this->db->affected_rows();

		// echo "<pre>";
		// echo print_r($data);
		// echo "</pre>";
	}

	public function updateBuktiBayar($data, $id){
		$sql = "INSERT INTO bukti_bayar 
					(id_produksi, tgl_upload, nm_bukti, nominal)
				VALUES 
					(".$data['id'].",NOW(),'".$data['nm_bukti']."',".$data['nominal'].")";
		
		$this->db->query($sql);

		$total_pajak_bayar = $data['pajak_bayar'] + $data['nominal'];
		if($total_pajak_bayar < $data['total_pajak']){
			$ket_bayar = "Kurang Bayar Pajak";
		}else{
			$ket_bayar = "Sudah Bayar Pajak";
		}

		$sql2 = "UPDATE produksi 
					SET produksi.pajak_bayar='".$total_pajak_bayar."', produksi.ket_bayar='".$ket_bayar."'
					WHERE produksi.id_produksi='".$data['id']."'";

		$this->db->query($sql2);					
		return $this->db->affected_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */