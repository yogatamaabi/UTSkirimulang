<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siswa extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('siswa_model');
        
    }

    public function showdata()
    {
		$data["siswa_list"] = $this->siswa_model->getdatasiswa();
		$this->load->view('siswa',$data);	
    }

    public function index($id)
    {
        $data['siswa'] = $this->siswa_model->getsiswa($id);
        $this->load->view('view_siswa',$data);
        
    }

   public function create(){
		$this->validation();
		if($this->form_validation->run()==FALSE){
			$this->load->model('kelas_model');
			$data['data_kelas']= $this->kelas_model->getKelas();
			
			$this->load->view('tambah_siswa',$data);
			
		}else{
			$config['upload_path']          = './assets/upload/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 1000000000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('foto')){
					$error = array('error' => $this->upload->display_errors());
					var_dump($error);
					//$this->load->view('tambah_pegawai_view',$error);
			} else {
					$this->siswa_model->insertsiswa();
					$this->session->set_flashdata('pesan', 'Tambah Data siswa Berhasil  ');
					redirect('kelas/index/');
			}
			
			
		}

		
	}
	public function update($id_siswa,$id)
	{
		$this->validation();
		
		$this->load->model('kelas_model');

		$data['data_kelas']= $this->kelas_model->getKelas();
		$data['kelas']=$this->siswa_model->getsiswaById($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_siswa',$data);

		}else{
			$config['upload_path']          = './assets/upload/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000000000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('foto')){
					$error = array('error' => $this->upload->display_errors());
					var_dump($error);
					//$this->load->view('tambah_pegawai_view',$error);
			} else {
					$this->siswa_model->updateById($id);
					$this->session->set_flashdata('pesan', 'Ubah Data Kelas '.$id. ' Berhasil ');
					redirect('siswa/index/'.$id_siswa);
			}
			
		}
	}
	public function delete($id_siswa,$id){
		$this->siswa_model->delete($id);
		redirect('siswa/index/'.$id_siswa);
		
	}
	public function detail($id_siswa,$id){
		$data['kelas'] = $this->siswa_model->getsiswaById($id);
        $this->load->view('detail',$data);
	}
    public function validation(){
		//load library	
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('id', 'Id', 'numeric|trim|required|is_unique[siswa.id]');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('fk_kelas', 'kelas', 'trim|required');
	}

}

/* End of file Controllername.php */
