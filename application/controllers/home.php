<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_jalan');
		$this->load->model('model_jembatan');
		$this->load->model('model_koordinatjalan');
		$this->load->model('model_koordinatjembatan');
	}
	public function index()
	{
		// $this->load->view('homepage');
		$data = array('content' => 'homepage');
		$this->load->view('templates/template', $data, FALSE);
	}

	public function loadkoordinat() {
		if(!$this->input->is_ajax_request()) {
			show_404();
		} else {
			$status = "success";
			$msg = "Data berhasil disimpan";
			$content = [
				'itemdatajalan' => $this->model_jalan->getAll()->result(),
				'itemdatajembatan' => $this->model_jembatan->getAll()->result(),
				'itemkoordinatjembatan' => $this->model_koordinatjembatan->getAll()->result(),
			];
			$data = array('status'=>$status,
						'msg'=>$msg,
						'content'=>$content);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function loadkoordinatjalan() {
		if(!$this->input->is_ajax_request()) {
			show_404();
		} else {
			$status = "success";
			$msg = "Data berhasil disimpan";
			$content = [
				'itemkoordinatjalan' => $this->model_koordinatjalan->getbyidjalan($this->input->post('id'))->result(),
			];
			$data = array('status'=>$status,
						'msg'=>$msg,
						'content'=>$content);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */