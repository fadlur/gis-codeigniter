<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jembatan extends CI_Model {

	public function create(){
		$data = array('namajembatan' => $this->input->post('namajembatan'),
			'keterangan'=>$this->input->post('keterangan'));
		$query = $this->db->insert('jembatan', $data);
		return $query;
	}
	public function getAll(){
		$query = $this->db->get('jembatan');//mengambil semua data jembatan
		return $query;
	}
	public function read($id){
		$this->db->where('id_jembatan', $id);//mengambil data jembatan berdasarkan id_jembatan
		$query = $this->db->get('jembatan');
		return $query;
	}
	public function update(){
		$data = array('namajembatan'=>$this->input->post('namajembatan'),
			'keterangan'=>$this->input->post('keterangan'));
		$this->db->where('id_jembatan', $this->input->post('id_jembatan'));//mengupdate berdasarkan id_jembatan
		$query = $this->db->update('jembatan', $data);
		return $query;
	}
	public function delete(){
		$this->db->where('id_jembatan', $this->uri->segment(3));//menghapus berdasarkan id_jembatan
		$query = $this->db->delete('jembatan');
		return $query;
	}

}

/* End of file model_jembatan.php */
/* Location: ./application/models/model_jembatan.php */