<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelas_model extends CI_Model {

        public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getKelas()
		{
			$query = $this->db->get('kelas');
			return $query->result();
		}

		public function insertKelas()
		{
			$object = array(
				'nama' => $this->input->post('nama')
				);
			$this->db->insert('kelas', $object);
		}


		public function getKelasById($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('kelas',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array(
				'nama' => $this->input->post('nama'), 
				);
			$this->db->where('id', $id);
			$this->db->update('kelas', $data);
		}
		
		public function delete($id){
			$this->db->where('id',$id);
			$this->db->delete('kelas');
		}    

}

/* End of file kelas_model.php */
