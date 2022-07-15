<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_jalan');
		$this->load->model('model_jembatan');
		$this->load->model('model_koordinatjalan');
		$this->load->model('model_koordinatjembatan');
		$this->load->library('cart');
	}
	public function index()
	{
		$this->jalan();
	}
	//crud jalan
	public function jalan(){
		$data = array('content' => 'admin/jalanform',
			'itemjalan'=>$this->model_jalan->getAll());
		$this->load->view('templates/template', $data, FALSE);
	}
	public function createjalan(){
		if ($this->model_jalan->create()) {
			redirect('admin/jalan');
		}else{
			redirect('admin/jalan');
		}
	}
	public function editjalan(){
		$data = array('content' => 'admin/editjalanform',
			'itemjalan'=>$this->model_jalan->read($this->uri->segment(3)));
		$this->load->view('templates/template', $data, FALSE);
	}
	public function updatejalan(){
		if ($this->model_jalan->update()) {
			redirect('admin/jalan');
		}else{
			redirect('admin/jalan');
		}
	}
	public function deletejalan(){
		if ($this->model_jalan->delete()) {
			redirect('admin/jalan');
		}else{
			redirect('admin/jalan');
		}
	}
	//end crud jalan
	//crud jembatan
	public function jembatan(){
		$data = array('content' => 'admin/jembatanform',
			'itemjembatan'=>$this->model_jembatan->getAll());
		$this->load->view('templates/template', $data, FALSE);
	}
	public function createjembatan(){
		if ($this->model_jembatan->create()) {
			redirect('admin/jembatan');
		}else{
			redirect('admin/jembatan');
		}
	}
	public function editjembatan(){
		$data = array('content' => 'admin/editjembatanform',
			'itemjembatan'=>$this->model_jembatan->read($this->uri->segment(3)));
		$this->load->view('templates/template', $data, FALSE);
	}
	public function updatejembatan(){
		if ($this->model_jembatan->update()) {
			redirect('admin/jembatan');
		}else{
			redirect('admin/jembatan');
		}
	}
	public function deletejembatan(){
		if ($this->model_jembatan->delete()) {
			redirect('admin/jembatan');
		}else{
			redirect('admin/jembatan');
		}
	}
	//end crud jembatan
	//crud koordinat jalan ()
	public function koordinatjalan(){
		$data = array('content' => 'admin/koordinatjalanform',
			'itemdatajalan'=>$this->model_jalan->getAll(),
			'itemkoordinatjalan'=>$this->model_koordinatjalan->getAll());
		$this->load->view('templates/template', $data, FALSE);
	}
	function tambahkoordinatjalan()
	{
		if(!$this->input->is_ajax_request())
		{
			show_404();
		}else
		{
			if($this->cart->contents()==null){
				$data = array(
				'id'      => 1,
				'qty'     => 1,
				'price'   => 1,
				'jenis'	  => 'jalan',
				'name'    => 1,
				'latitude'=> $this->input->post('latitude'),
				'longitude'=> $this->input->post('longitude')
				);
				
				$this->cart->insert($data);
				$status = "success";
				$msg = "<div class='alert alert-success'>Data berhasil disimpan</div>";
			}else{
				$urut = 0;
				foreach ($this->cart->contents() as $jalan) {
					$urut +=1;
				}
				$data = array(
						'id'      => $urut + 1,
						'qty'     => 1,
						'price'   => 1,
						'jenis'	  => 'jalan',
						'name'    => $urut + 1,
						'latitude'=> $this->input->post('latitude'),
						'longitude'=> $this->input->post('longitude')
					);
					
				$this->cart->insert($data);
				$status = "success";
				$msg = "<div class='alert alert-success'>Data berhasil disimpan</div>";
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
		}
	}
	function hapusdaftarkoordinatjalan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			$hapus = $this->cart->destroy();
			$status = 'success';
			$msg = 'data koordinat berhasil dihapus';
			
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
		}
	}
	function simpandaftarkoordinatjalan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_jalan', 'Data Jalan', 'trim|required');
			if ($this->form_validation->run()==false) {
				$status = 'error';
				$msg = validation_errors();
			}else{
				if ($this->model_koordinatjalan->getbyidjalan($this->input->post('id_jalan'))->num_rows()!=null) {
					$status = 'error';
					$msg = 'polyline jalan yang bersangkutan sudah ada, hapus terlebih dahulu';
				}else{
					if ($this->model_koordinatjalan->create()) {
						$status = 'success';
						$msg = 'data berhasil disimpan';
						$this->cart->destroy();
					}else{
						$status = 'error';
						$msg = 'terjadi kesalahan saat menyimpan koordinat';
					}
				}
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
		}
	}
	function hapuspolylinejalan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			if ($this->model_koordinatjalan->deletebyidjalan($this->input->post('id_jalan'))) {
				$status = 'success';
				$msg = 'data berhasil dihapus';
			}else{
				$status = 'error';
				$msg = 'terjadi kesalahan saat menghapus data';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
		}
	}
	function viewpolylinejalan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			if ($this->model_koordinatjalan->getbyidjalan($this->input->post('id_jalan'))->num_rows()!=null){
				$status = 'success';
				$msg = $this->model_koordinatjalan->getbyidjalan($this->input->post('id_jalan'))->result();
				$datajalan = $this->model_jalan->read($this->input->post('id_jalan'))->result();
			}else{
				$status = 'error';
				$msg = 'data tidak ditemukan';
				$datajalan = null;
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg,'datajalan'=>$datajalan)));
		}
	}
	//end crud koordinat jalan
	//crud koordinat jembatan
	public function koordinatjembatan(){
		$data = array('content' => 'admin/koordinatjembatanform',
			'itemdatajembatan'=>$this->model_jembatan->getAll(),
			'itemkoordinatjembatan'=>$this->model_koordinatjembatan->getAll());
		$this->load->view('templates/template', $data, FALSE);
	}
	function simpandaftarkoordinatjembatan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id_jembatan', 'Data jembatan', 'trim|required');
			if ($this->form_validation->run()==false) {
				$status = 'error';
				$msg = validation_errors();
			}else{
				if ($this->model_koordinatjembatan->getbyidjembatan($this->input->post('id_jembatan'))->num_rows()!=null) {
					$status = 'error';
					$msg = 'marker jembatan yang bersangkutan sudah ada, hapus terlebih dahulu';
				}else{
					if ($this->model_koordinatjembatan->create()) {
						$status = 'success';
						$msg = 'data berhasil disimpan';
					}else{
						$status = 'error';
						$msg = 'terjadi kesalahan saat menyimpan koordinat';
					}
				}
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
		}
	}
	function hapusmarkerjembatan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			if ($this->model_koordinatjembatan->deletebyidjembatan($this->input->post('id_jembatan'))) {
				$status = 'success';
				$msg = 'data berhasil dihapus';
			}else{
				$status = 'error';
				$msg = 'terjadi kesalahan saat menghapus data';
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
		}
	}
	function viewmarkerjembatan(){
		if (!$this->input->is_ajax_request()) {
			show_404();
		}else{
			if ($this->model_koordinatjembatan->getbyidjembatan($this->input->post('id_jembatan'))->num_rows()!=null){
				$status = 'success';
				$msg = $this->model_koordinatjembatan->getbyidjembatan($this->input->post('id_jembatan'))->result();
				$datajembatan = $this->model_jembatan->read($this->input->post('id_jembatan'))->result();
			}else{
				$status = 'error';
				$msg = 'data tidak ditemukan';
				$datajembatan = null;
			}
			$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg,'datajembatan'=>$datajembatan)));
		}
	}
	//end crud koordinat jembatan

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */