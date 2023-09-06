<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

	public function getdata($tabel)
	{
		$result=$this->db->get($tabel);
		return $result;
	}

	public function getdatawhere($tabel,$where)
	{
		$this->db->where($where);
		$result=$this->db->get($tabel);
		return $result;
	}

	public function insertdata($tabel,$array)
	{
		$result=$this->db->insert($tabel,$array);
		return $result;

	}

	public function updatedata($tabel,$array,$where)
	{
		$result=$this->db->update($tabel,$array,$where);
		return $result;
	}

	public function deletedata($tabel,$where)
	{	
		$this->db->where($where);
		$result=$this->db->delete($tabel);
		return $result;
	}

  // ------------------------------------------------------------------------

}

/* End of file Kecelakaan_model.php */
/* Location: ./application/models/Kecelakaan_model.php */
