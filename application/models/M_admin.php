<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function select_all_admin() {
		$sql = "SELECT * FROM admin";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all_admin_daerah() {
		$sql = "SELECT * FROM admin WHERE hak_akses='2'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM admin WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function updateadmin_daerah($data,$id) {//batal
		$sql = "UPDATE admin SET nama='tes',username='tes' WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function updateadmin_daerah_pass($data,$id) {//batal
		$sql = "UPDATE admin SET password=md5('" .$data['passBaru'] ."') WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data, $id) {//dipake pada rofile
		$this->db->where("id", $id);
		$this->db->update("admin", $data);

		return $this->db->affected_rows();
	}

	public function update_admdaerah($data) {//dipake pada formsekarang
		$sql = "UPDATE admin
					SET nama='" .$data['nama'] ."', username='" .$data['username'] ."', password= md5('" .$data['password'] ."')
					WHERE admin.id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function select($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
		}

		$data = $this->db->get('admin');

		return $data->row();
	}

	public function insert($data) {

		//$sql = "INSERT INTO admin VALUES('" .$data['data'] ."')";
		$sql = "INSERT INTO admin (nama, username, password,foto,hak_akses, cabdin_esdm) VALUES ('" .$data['nama'] ."', '" .$data['username'] ."', md5('" .$data['password'] ."'),'user.png','2','" .$data['cabdin_esdm'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM admin WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function total_rows() {
		$this->db->where('hak_akses', 2);
		$data = $this->db->get('admin');

		return $data->num_rows();
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */