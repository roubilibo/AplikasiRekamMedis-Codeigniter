<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->kode = "kode_klasifikasi";
		$this->masuk = "surat_masuk";
		$this->keluar = "surat_keluar";
	}

	public function index()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();
		$data = [
			'title' => $row->nama_aplikasi,
			'instansi' => $row->nama_instansi,
			'logo_instansi' => 'assets/dist/img/' . $row->logo_instansi,
			'logo_daerah' => 'assets/dist/img/' . $row->logo_daerah,
			'username' => $this->session->userdata('username'),
			'halaman' => 'Beranda',
		];
		$this->load->view('page/v_app/halaman_utama', $data);
	}
}
