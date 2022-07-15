<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function create(){
		$data = array('username' => $this->input->post('username'),
			'password'=>md5($this->input->post('password')));//password kita menggunakan enkripsi md5
		$query = $this->db->insert('user', $data);
		return $query;
	}
	public function getAll(){
		$query = $this->db->get('user');//mengambil semua data user
		return $query;
	}
	public function read($id){
		$this->db->where('id_user', $id);//mengambil data user berdasarkan id_user
		$query = $this->db->get('user');
		return $query;
	}
	public function update(){
		$data = array('username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password')));
		$this->db->where('id_user', $this->input->post('id_user'));//mengupdate berdasarkan id_user
		$query = $this->db->update('user', $data);
		return $query;
	}
	public function delete(){
		$this->db->where('id_user', $this->input->post('id_user'));//menghapus berdasarkan id_user
		$query = $this->db->delete('user');
		return $query;
	}

}

/* End of file model_user.php */
/* Location: ./application/models/model_user.php */