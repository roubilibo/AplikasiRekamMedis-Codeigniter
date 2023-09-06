<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cek_kelengkapan extends CI_Controller
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
			'halaman' => 'Cek Kelengkapan',
		];
		$this->load->view('page/v_cek/cek', $data);
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
			1 => 'drm_keluar',
			2 => 'nama_poli',
			3 => 'drm_masuk',
			4 => 'drm_masuk',
			5 => 'drm_masuk',
			6 => 'a.no_rm',
			7 => 'nama_pasien',
			8 => 'alamat',
			// 9=>'icd',
			// 10=>'diagnosa',
			11 => 'a.keterangan_drm',
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
		$this->db->select("a.*,TIMESTAMPDIFF(SECOND,a.drm_masuk,a.drm_keluar) as selisih_menit, b.nama_pasien, b.jenis_kelamin, b.kepala_keluarga, b.tanggal_lahir, b.alamat, c.nama_poli");
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->like('a.tanggal_kunjungan', $filter_tanggal, 'after');
		$this->db->order_by('a.last_change', 'desc');
		$getData = $this->db->get();
		$data = array();
		$no = 1;
		foreach ($getData->result() as $rows) {
			$drm_keluar = strtotime($rows->drm_keluar);
			$drm_masuk = strtotime($rows->drm_masuk);

			$this->db->select('a.diagnosa_utama, b.icd, b.diagnosa');
			$this->db->from('pasien_diagnosa a');
			$this->db->join('pengaturan_diagnosa b', 'a.diagnosa_utama = b.id_diagnosa');
			$this->db->where('a.id_kunjungan', $rows->id_kunjungan);
			$getDiagnosa = $this->db->get()->row();

			if (empty($getDiagnosa->icd)) {
				$icd = '-';
			} else {
				$icd = $getDiagnosa->icd;
			}

			if (empty($getDiagnosa->diagnosa)) {
				$diagnosa = '-';
			} else {
				$diagnosa = $getDiagnosa->diagnosa;
			}

			if ($rows->keterangan_drm == 'LENGKAP') {
				$keterangan_drm = '<div class="font-weight-700 text-success">' . $rows->keterangan_drm . '</div>';
			} else if ($rows->keterangan_drm == 'TIDAK LENGKAP') {
				$keterangan_drm = '<div class="font-weight-700 text-danger">' . $rows->keterangan_drm . '</div>';
			}


			$data[] = array(
				$no,
				htmlentities($rows->drm_keluar, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->nama_poli, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->drm_masuk, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->selisih_menit / 60, ENT_QUOTES, 'UTF-8'),
				htmlentities($this->avg_data() / 60, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->no_rm, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->nama_pasien, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->alamat, ENT_QUOTES, 'UTF-8'),
				htmlentities($icd, ENT_QUOTES, 'UTF-8'),
				htmlentities($diagnosa, ENT_QUOTES, 'UTF-8'),
				$keterangan_drm,
				'<div class="btn-group">
				<button aria-label="" data-id="' . $rows->id_kunjungan . '" data-no_rm="' . $rows->no_rm . '" data-tanggal_kunjungan="' . $rows->tanggal_kunjungan . '" data-tujuan_poli="' . $rows->tujuan_poli . '" data-nama_pasien="' . $rows->nama_pasien . '" data-drm_masuk="' . $rows->drm_masuk . '" data-drm_keluar="' . $rows->drm_keluar . '" data-alamat="' . $rows->alamat . '" class="cekData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cek Kelengkapan Data">
					<i class="fa fa-edit"></i>
				</button>
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
		$query = $this->db->select("COUNT(*) as num")->get('pasien_kunjungan');
		$result = $query->row();
		if (isset($result)) return $result->num;
		return 0;
	}

	public function avg_data()
	{
		$query = $this->db->select("ROUND(AVG(TIMESTAMPDIFF(SECOND,drm_masuk,drm_keluar)),1) as num")->get('pasien_kunjungan');
		$result = $query->row();
		if (isset($result)) return $result->num;
		return 0;
	}

	public function save()
	{
		$drm_masuk = $this->input->post('drm_masuk');
		$drm_keluar = $this->input->post('drm_keluar');
		$tujuan_poli = $this->input->post('tujuan_poli');
		$keterangan_drm = $this->input->post('keterangan_drm');
		$cek_id = $this->input->post('cek_id');

		$array = [
			'keterangan_drm' => $keterangan_drm,
		];

		$where = "id_kunjungan = '$cek_id'";

		$data = $this->app_model->updatedata('pasien_kunjungan', $array, $where);
		echo json_encode($data);
	}

	public function edit()
	{
	}

	public function hapus()
	{
		$hapus_id = $this->input->post('hapus_id');

		$where = "id_kunjungan = '$hapus_id'";

		$data = $this->app_model->deletedata('pasien_kunjungan', $where);
		echo json_encode($data);
	}

	public function filter_tanggal()
	{
		$this->session->set_userdata('filter_tanggal', $_GET['filter_tanggal']);
	}
}
