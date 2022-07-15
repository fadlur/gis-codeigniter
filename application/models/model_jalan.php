<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_jalan extends CI_Model {

	public function create(){
		$data = array('namajalan' => $this->input->post('namajalan'),
			'keterangan'=>$this->input->post('keterangan'));
		$query = $this->db->insert('jalan', $data);
		return $query;
	}
	public function getAll(){
		$query = $this->db->get('jalan');//mengambil semua data jalan
		return $query;
	}
	public function read($id){
		$this->db->where('id_jalan', $id);//mengambil data jalan berdasarkan id_jalan
		$query = $this->db->get('jalan');
		return $query;
	}
	public function update(){
		$data = array('namajalan'=>$this->input->post('namajalan'),
			'keterangan'=>$this->input->post('keterangan'));
		$this->db->where('id_jalan', $this->input->post('id_jalan'));//mengupdate berdasarkan id_jalan
		$query = $this->db->update('jalan', $data);
		return $query;
	}
	public function delete(){
		$this->db->where('id_jalan', $this->uri->segment(3));//menghapus berdasarkan id_jalan
		$query = $this->db->delete('jalan');
		return $query;
	}

}

/* End of file model_jalan.php */
/* Location: ./application/models/model_jalan.php */