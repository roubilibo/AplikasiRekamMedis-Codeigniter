<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan_umum extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
	}

	public function index()
	{
		// $this->session->unset_userdata('filter_tanggal');
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
			'halaman' => 'Layanan Umum',
		];
		$this->load->view('page/v_layanan/layanan', $data);
	}

	public function show()
	{
		$filter_tanggal = $this->session->userdata('filter_tanggal');
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";

		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}

		$valid_columns = array(
			1 => 'a.no_rm',
			2 => 'nama_pasien',
			3 => 'jenis_kelamin',
			4 => 'kepala_keluarga',
			5 => 'tanggal_lahir',
			6 => 'alamat',
			7 => 'a.keterangan_drm',
		);

		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
					// $this->db->like('a.tanggal_kunjungan',$filter_tanggal,'after');
				} else {
					$this->db->or_like($sterm, $search);
					// $this->db->like('a.tanggal_kunjungan',$filter_tanggal,'after');
				}
				$x++;
			}
		}

		$this->db->limit($length, $start);
		$this->db->select("a.*, b.nama_pasien, b.jenis_kelamin, b.kepala_keluarga, b.tanggal_lahir, b.alamat, b.keterangan_drm, c.nama_poli");
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->like('a.tanggal_kunjungan', $filter_tanggal, 'after');
		// $this->db->where('a.status !=','SELESAI');
		$this->db->order_by('a.last_change', 'desc');
		$getData = $this->db->get();
		$data = array();
		$no = 1;
		foreach ($getData->result() as $rows) {

			$data[] = array(
				$no,
				htmlentities($rows->no_rm, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->nama_pasien, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->jenis_kelamin, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->kepala_keluarga, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->nama_poli, ENT_QUOTES, 'UTF-8'),
				htmlentities(date_indo($rows->tanggal_lahir), ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->alamat, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->keterangan_drm, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->status, ENT_QUOTES, 'UTF-8'),
				'<div class="btn-group">
                <button aria-label="" data-id="' . $rows->id_kunjungan . '" data-no_rm="' . $rows->no_rm . '" data-nama_pasien="' . $rows->nama_pasien . '" data-kepala_keluarga="' . $rows->kepala_keluarga . '" data-poli="' . $rows->nama_poli . '" class="entriData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Entri Layanan">
                    <i class="fa fa-edit"></i>
                </button>
                </div>'
			);
			$no++;
		}

		$totalRow = $this->total_data();
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $totalRow,
			"recordsFiltered" => $totalRow,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function total_data()
	{
		$query = $this->db->select("COUNT(*) as num")->get('pasien');
		$result = $query->row();
		if (isset($result)) return $result->num;
		return 0;
	}

	public function save()
	{
		$diagnosa_utama = $this->input->post('diagnosa_utama');
		$status_1 = $this->input->post('status_1');
		$diagnosa_sekunder = $this->input->post('diagnosa_sekunder');
		$status_2 = $this->input->post('status_2');
		$diagnosa_sekunder_2 = $this->input->post('diagnosa_sekunder_2');
		$status_3 = $this->input->post('status_3');
		$terapi = $this->input->post('terapi');
		$dokter = $this->input->post('dokter');
		$entri_id = $this->input->post('entri_id');
		$status = 'SELESAI';
		$date_created = date('Y-m-d H:i:s');

		$array = [
			'id_diagnosa' => $value,
			'id_kunjungan' => $entri_id,
			'diagnosa_utama' => $diagnosa_utama,
			'status_1' => $status_1,
			'diagnosa_sekunder' => $diagnosa_sekunder,
			'status_2' => $status_2,
			'diagnosa_sekunder' => $diagnosa_sekunder_2,
			'status_3' => $status_3,
			'terapi' => $terapi,
			'id_dokter' => $dokter,
			'date_created' => $date_created,
		];

		$arrayKunjungan = [
			'status' => $status,
			'drm_keluar' => date('Y-m-d H:i:s'),
		];

		$where = "id_kunjungan = '$entri_id'";
		$this->app_model->updatedata('pasien_kunjungan', $arrayKunjungan, $where);

		$data = $this->app_model->insertdata('pasien_diagnosa', $array);
		echo json_encode($data);
	}

	public function edit()
	{
	}

	public function hapus()
	{
		$hapus_id = $this->input->post('hapus_id');

		$where = "no_rm = '$hapus_id'";

		$data = $this->app_model->deletedata('pasien', $where);
		echo json_encode($data);
	}

	public function filter_tanggal()
	{
		$this->session->set_userdata('filter_tanggal', $_GET['filter_tanggal']);
	}
}
