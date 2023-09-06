<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    
	public function __construct()
	{
		parent::__construct();
		$this->user = "app_user";
	}

	public function index()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan',1);
		$result = $this->db->get();
		$row = $result->row();
		$data = [
			'title' => $row->nama_aplikasi,
			'instansi' => $row->nama_instansi,
			'logo_instansi' => 'assets/dist/img/'.$row->logo_instansi,
			'logo_daerah' => 'assets/dist/img/'.$row->logo_daerah,
		];
    	$this->load->view('page/v_auth/login',$data);
	}

	public function login(){
		$username	= 	$this->input->post('username');
		$password	=	md5($this->input->post('password'));
		$cekUser	=	$this->auth_model->cekUser($username,$password);
		$dtUser		=	$cekUser->row();
		

			if ($cekUser->num_rows() > 0) 
			{
				$sesi = array(
						'id_user' => $dtUser->id_user,
						'username' => $dtUser->username,
						'level' => $dtUser->level,
						'filter_tanggal' => date('Y-m-d'),
						'user_logged_in' => TRUE
				);
				$this->session->set_userdata($sesi);
				redirect('homepage');
			}
			if ($this->session->flashdata('error')!='') {
				if ($cekUser->num_rows() == 0) 
				{
					$this->session->set_flashdata('error','<div id="msgalert" class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fa fa-ban"></i>  User tidak terdaftar atau password salah </div>');
					redirect('auth');
				}
			}
			else
			{
				redirect('auth');
			}
	}

	public function logout(){
		session_destroy();
		redirect('auth/login');
	}

	

}


/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
