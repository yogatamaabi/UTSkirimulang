<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelas extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('kelas_model');
        
    }
    
    public function index()
    {
        $data['kelas'] = $this->kelas_model->getKelas();
        $this->load->view('view_kelas',$data);
        
    }

   public function create(){
		$this->validation();
		if($this->form_validation->run()==FALSE){
			
			$this->load->view('tambah_kelas');
			
		}else{
			
			$this->kelas_model->insertkelas();
			$this->session->set_flashdata('pesan', 'Tambah Data Kelas Berhasil  ');
			redirect('kelas/index/');
			
		}

		
	}
	public function update($id)
	{
		$this->validation();
		$data['kelas']=$this->kelas_model->getKelasById($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_kelas',$data);

		}else{
			$this->kelas_model->updateById($id);
			$this->session->set_flashdata('pesan', 'Ubah Data Kelas '.$id. ' Berhasil ');
			redirect('kelas/index/');
		}
	}
	public function delete($id){
		$this->kelas_model->delete($id);
		redirect('kelas/index/');
		
	}
    public function validation(){
		//load library	
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
	}

}

/* End of file Controllername.php */
