<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
	}
	
	function cekUser($username,$password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$result = $this->db->get('');
		return $result;
	}

	function cekReady($username)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $username);
		$result = $this->db->get('');
		return $result;
	}

  // ------------------------------------------------------------------------

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */
