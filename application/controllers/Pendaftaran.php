<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
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
			'halaman' => 'Pendaftaran',
		];
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_pendaftaran/pendaftaran', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
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
			2 => 'tanggal_kunjungan',
			3 => 'nama_pasien',
			4 => 'jenis_kelamin',
			5 => 'kepala_keluarga',
			6 => 'tanggal_lahir',
			7 => 'alamat',
			8 => 'a.keterangan_drm',
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
		$this->db->select("a.*, b.nik, b.nama_pasien, b.alamat, b.jenis_kelamin, b.agama, b.tanggal_lahir,b.kelurahan,b.kecamatan,b.status_kk, b.kota, b.pendidikan, b.no_telp, b.status_nikah, b.kepala_keluarga, b.pekerjaan, b.status_pasien, b.wilayah, b.suku, b.no_bpjs, b.rt, b.rw, c.nama_agama, d.nama_kota, e.nama_pendidikan, f.nama_pekerjaan, g.nama_poli, h.nama_suku, i.nama_pembayaran, j.nama_kelurahan, k.nama_kecamatan");
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_agama c', 'b.agama = c.id_agama');
		$this->db->join('alamat_kota d', 'b.kota = d.id_kota');
		$this->db->join('pengaturan_pendidikan e', 'b.pendidikan = e.id_pendidikan');
		$this->db->join('pengaturan_pekerjaan f', 'b.pekerjaan = f.id_pekerjaan');
		$this->db->join('pengaturan_poli g', 'a.tujuan_poli = g.id_poli');
		$this->db->join('pengaturan_suku h', 'b.suku = h.id_suku');
		$this->db->join('pengaturan_pembayaran i', 'a.pembayaran = i.id_pembayaran');
		$this->db->join('alamat_kelurahan j', 'b.kelurahan = j.id_kelurahan');
		$this->db->join('alamat_kecamatan k', 'b.kecamatan = k.id_kecamatan');
		$this->db->like('a.tanggal_kunjungan', $filter_tanggal, 'after');
		$this->db->order_by('a.date_created', 'desc');
		$getData = $this->db->get();
		$data = array();
		$no = 1;
		foreach ($getData->result() as $rows) {

			$data[] = array(
				$no,
				htmlentities($rows->no_rm, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->tanggal_kunjungan, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->nama_pasien, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->jenis_kelamin, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->kepala_keluarga, ENT_QUOTES, 'UTF-8'),
				htmlentities(date_indo($rows->tanggal_lahir), ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->alamat, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->keterangan_drm, ENT_QUOTES, 'UTF-8'),
				'<div class="btn-group">
                <button aria-label="" data-id="' . $rows->id_kunjungan . '" data-no_rm="' . $rows->no_rm . '" data-nama_pasien="' . $rows->nama_pasien . '" data-jenis_kelamin="' . $rows->jenis_kelamin . '" data-tanggal_lahir="' . $rows->tanggal_lahir . '" data-alamat="' . $rows->alamat . '" data-rt="' . $rows->rt . '" data-rw="' . $rows->rw . '" data-kelurahan="' . $rows->nama_kelurahan . '" data-kecamatan="' . $rows->nama_kecamatan . '" data-kota="' . $rows->nama_kota . '" data-pekerjaan="' . $rows->nama_pekerjaan . '" data-agama="' . $rows->nama_agama . '" data-pendidikan="' . $rows->nama_pendidikan . '" data-status_nikah="' . $rows->status_nikah . '" data-nik="' . $rows->nik . '" data-wilayah="' . $rows->wilayah . '" data-kepala_keluarga="' . $rows->kepala_keluarga . '" data-status_kk="' . $rows->status_kk . '" data-no_bpjs="' . $rows->no_bpjs . '" data-pembayaran="' . $rows->nama_pembayaran . '" data-jenis_pelayanan="' . $rows->jenis_pelayanan . '" data-tujuan_poli="' . $rows->nama_poli . '" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="' . $rows->id_kunjungan . '" data-no_rm="' . $rows->no_rm . '" data-nama_pasien="' . $rows->nama_pasien . '" data-jenis_kelamin="' . $rows->jenis_kelamin . '" data-tanggal_lahir="' . $rows->tanggal_lahir . '" data-alamat="' . $rows->alamat . '" data-rt="' . $rows->rt . '" data-rw="' . $rows->rw . '" data-kelurahan="' . $rows->nama_kelurahan . '" data-kecamatan="' . $rows->nama_kecamatan . '" data-kota="' . $rows->nama_kota . '" data-pekerjaan="' . $rows->nama_pekerjaan . '" data-agama="' . $rows->nama_agama . '" data-pendidikan="' . $rows->nama_pendidikan . '" data-status_nikah="' . $rows->status_nikah . '" data-nik="' . $rows->nik . '" data-wilayah="' . $rows->wilayah . '" data-kepala_keluarga="' . $rows->kepala_keluarga . '" data-status_kk="' . $rows->status_kk . '" data-no_bpjs="' . $rows->no_bpjs . '" data-pembayaran="' . $rows->nama_pembayaran . '" data-jenis_pelayanan="' . $rows->jenis_pelayanan . '" data-tujuan_poli="' . $rows->nama_poli . '" class="detailData btn btn-xs btn-secondary btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Data">
                    <i class="fa fa-search"></i>
                </button>
                <a href="' . base_url("pendaftaran/print_status/$rows->id_kunjungan") . '" target="_blank"  aria-label="" data-id="' . $rows->no_rm . '" class="btn btn-xs btn-warning btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Status">
                    <i class="fa fa-print"></i>
                </a>
                <a href="' . base_url("pendaftaran/print_tracer/$rows->id_kunjungan") . '" target="_blank" aria-label="" data-id="' . $rows->no_rm . '" class="btn btn-xs btn-success btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Tracer">
                    <i class="fa fa-print"></i>
                </a>
                <button aria-label="" data-id="' . $rows->no_rm . '" class="hapusData btn btn-xs btn-danger btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
                    <i class="fa fa-trash"></i>
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
		$no_rm = $this->input->post('no_rm');
		$nama_pasien = $this->input->post('nama_pasien');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$tanggal_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$kelurahan = $this->input->post('kelurahan');
		$kecamatan = $this->input->post('kecamatan');
		$kota = $this->input->post('kota');
		$pekerjaan = $this->input->post('pekerjaan');
		$agama = $this->input->post('agama');
		$pendidikan = $this->input->post('pendidikan');
		$status_nikah = $this->input->post('status_nikah');
		$nik = $this->input->post('nik');
		$wilayah = $this->input->post('wilayah');
		$status_pasien = $this->input->post('status_pasien');
		$kepala_keluarga = $this->input->post('kepala_keluarga');
		$status_kk = $this->input->post('status_kk');
		$pembayaran = $this->input->post('pembayaran');
		$no_bpjs = $this->input->post('no_bpjs');
		$jenis_pelayanan = $this->input->post('jenis_pelayanan');
		$tujuan_poli = $this->input->post('tujuan_poli');
		$no_telp = $this->input->post('no_telp');
		$suku = $this->input->post('suku');
		$keterangan_drm = 'AKTIF';
		$date_created = date('Y-m-d H:i:s');

		$array = [
			'no_rm' => $no_rm,
			'nama_pasien' => $nama_pasien,
			'jenis_kelamin' => $jenis_kelamin,
			'tanggal_lahir' => $tanggal_lahir,
			'alamat' => $alamat,
			'rt' => $rt,
			'rw' => $rw,
			'kelurahan' => $kelurahan,
			'kecamatan' => $kecamatan,
			'kota' => $kota,
			'pekerjaan' => $pekerjaan,
			'agama' => $agama,
			'pendidikan' => $pendidikan,
			'status_nikah' => $status_nikah,
			'nik' => $nik,
			'wilayah' => $wilayah,
			'status_pasien' => $status_pasien,
			'kepala_keluarga' => $kepala_keluarga,
			'status_kk' => $status_kk,
			'pembayaran' => $pembayaran,
			'no_bpjs' => $no_bpjs,
			'jenis_pelayanan' => $jenis_pelayanan,
			'tujuan_poli' => $tujuan_poli,
			'no_telp' => $no_telp,
			'suku' => $suku,
			'keterangan_drm' => $keterangan_drm,
			'date_created' => $date_created,
		];

		$this->db->order_by('date_created', 'desc');
		$result = $this->db->get('pasien_kunjungan');
		$row = $result->row();

		if ($result->num_rows() > 0) {
			$id_kunjungan = substr($row->id_kunjungan, 4);
			$value = 'KJG-' . sprintf('%03d', $id_kunjungan + 1);
		} else {
			$value = 'KJG-' . sprintf('%03d', 1);
		}

		$arrayKunjungan = [
			'id_kunjungan' => $value,
			'no_rm' => $no_rm,
			'drm_masuk' => date('Y-m-d H:i:s'),
			'tanggal_kunjungan' => $date_created,
			'tujuan_poli' => $tujuan_poli,
			'jenis_pelayanan' => $jenis_pelayanan,
			'pembayaran' => $pembayaran,
			'keterangan_drm' => 'TIDAK LENGKAP',
			'date_created' => $date_created,
		];
		$this->app_model->insertdata('pasien_kunjungan', $arrayKunjungan);

		$data = $this->app_model->insertdata('pasien', $array);
		echo json_encode($data);
	}

	public function save_lama()
	{
		$no_rm = $this->input->post('no_rm_lama');
		$pembayaran = $this->input->post('pembayaran_lama');
		$jenis_pelayanan = $this->input->post('jenis_pelayanan_lama');
		$tujuan_poli = $this->input->post('tujuan_poli_lama');
		$date_created = date('Y-m-d H:i:s');

		$this->db->order_by('date_created', 'desc');
		$result = $this->db->get('pasien_kunjungan');
		$row = $result->row();

		if ($result->num_rows() > 0) {
			$id_kunjungan = substr($row->id_kunjungan, 4);
			$value = 'KJG-' . sprintf('%03d', $id_kunjungan + 1);
		} else {
			$value = 'KJG-' . sprintf('%03d', 1);
		}

		$array = [
			'id_kunjungan' => $value,
			'no_rm' => $no_rm,
			'drm_masuk' => date('Y-m-d H:i:s'),
			'tanggal_kunjungan' => $date_created,
			'tujuan_poli' => $tujuan_poli,
			'jenis_pelayanan' => $jenis_pelayanan,
			'pembayaran' => $pembayaran,
			'keterangan_drm' => 'TIDAK LENGKAP',
			'date_created' => $date_created,
		];

		$data = $this->app_model->insertdata('pasien_kunjungan', $array);
		echo json_encode($data);
	}

	public function edit()
	{
		$edit_id = $this->input->post('edit_id');
		$pembayaran = $this->input->post('e_pembayaran');
		$jenis_pelayanan = $this->input->post('e_jenis_pelayanan');
		$tujuan_poli = $this->input->post('e_tujuan_poli');

		$array = [
			'tujuan_poli' => $tujuan_poli,
			'jenis_pelayanan' => $jenis_pelayanan,
			'pembayaran' => $pembayaran,
		];

		$where = "id_kunjungan = '$edit_id'";

		$data = $this->app_model->updatedata('pasien_kunjungan', $array, $where);
		echo json_encode($data);
	}

	public function hapus()
	{
		$hapus_id = $this->input->post('hapus_id');

		$where = "no_rm = '$hapus_id'";

		$data = $this->app_model->deletedata('pasien', $where);
		echo json_encode($data);
	}

	public function getRM()
	{
		$this->db->order_by('date_created', 'desc');
		$result = $this->db->get('pasien');
		$row = $result->row();

		if ($result->num_rows() > 0) {
			$value = sprintf('%06d', $row->no_rm + 1);
		} else {
			$value = sprintf('%06d', 1);
		}

		$data = array(
			'no_rm' => $value,
		);
		echo json_encode($data);
	}

	public function getPasien()
	{
		// $this->db->select('*');
		// $this->db->from('pasien');
		$this->db->select("a.*,c.nama_agama, d.nama_kota, e.nama_pendidikan, f.nama_pekerjaan, h.nama_suku,j.nama_kelurahan, k.nama_kecamatan");
		$this->db->from('pasien a');
		$this->db->join('pengaturan_agama c', 'a.agama = c.id_agama');
		$this->db->join('alamat_kota d', 'a.kota = d.id_kota');
		$this->db->join('pengaturan_pendidikan e', 'a.pendidikan = e.id_pendidikan');
		$this->db->join('pengaturan_pekerjaan f', 'a.pekerjaan = f.id_pekerjaan');
		$this->db->join('pengaturan_suku h', 'a.suku = h.id_suku');
		$this->db->join('alamat_kelurahan j', 'a.kelurahan = j.id_kelurahan');
		$this->db->join('alamat_kecamatan k', 'a.kecamatan = k.id_kecamatan');
		$this->db->where('no_rm', $_GET['no_rm']);
		$result = $this->db->get();
		$row = $result->row();

		$data = array(
			'nama_pasien' => $row->nama_pasien,
			'jenis_kelamin' => $row->jenis_kelamin,
			'tanggal_lahir' => date_indo($row->tanggal_lahir),
			'alamat' => $row->alamat,
			'rt' => $row->rt,
			'rw' => $row->rw,
			'kelurahan' => $row->nama_kelurahan,
			'kecamatan' => $row->nama_kecamatan,
			'kota' => $row->nama_kota,
			'pekerjaan' => $row->nama_pekerjaan,
			'agama' => $row->nama_agama,
			'pendidikan' => $row->nama_pendidikan,
			'status_nikah' => $row->status_nikah,
			'nik' => $row->nik,
			'wilayah' => $row->wilayah,
			'status_pasien' => $row->status_pasien,
			'kepala_keluarga' => $row->kepala_keluarga,
			'status_kk' => $row->status_kk,
			'no_bpjs' => $row->no_bpjs,
		);
		echo json_encode($data);
	}

	public function filter_tanggal()
	{
		$this->session->set_userdata('filter_tanggal', $_GET['filter_tanggal']);
	}

	public function print_status()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$id_kunjungan = $this->uri->segment(3);
		$this->db->select('a.*, b.nik, b.nama_pasien, b.alamat, b.jenis_kelamin, b.agama, b.tanggal_lahir, b.kota, b.pendidikan, b.no_telp, b.status_nikah, b.kepala_keluarga, b.pekerjaan, b.status_pasien, b.wilayah, b.suku, b.no_bpjs, b.rt, b.rw, c.nama_agama, d.nama_kota, e.nama_pendidikan, f.nama_pekerjaan, g.nama_poli, h.nama_suku, i.nama_pembayaran');
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_agama c', 'b.agama = c.id_agama');
		$this->db->join('alamat_kota d', 'b.kota = d.id_kota');
		$this->db->join('pengaturan_pendidikan e', 'b.pendidikan = e.id_pendidikan');
		$this->db->join('pengaturan_pekerjaan f', 'b.pekerjaan = f.id_pekerjaan');
		$this->db->join('pengaturan_poli g', 'a.tujuan_poli = g.id_poli');
		$this->db->join('pengaturan_suku h', 'b.suku = h.id_suku');
		$this->db->join('pengaturan_pembayaran i', 'a.pembayaran = i.id_pembayaran');
		$this->db->where('a.id_kunjungan', $id_kunjungan);
		$getPasien = $this->db->get();

		$data = [
			'title' => $row->nama_aplikasi,
			'instansi' => $row->nama_instansi,
			'alamat' => $row->alamat_instansi,
			'telp' => $row->telp_instansi,
			'nama_daerah' => $row->nama_daerah,
			'pasien' => $getPasien,
			'logo_instansi' => 'assets/dist/img/' . $row->logo_instansi,
			'logo_daerah' => 'assets/dist/img/' . $row->logo_daerah,
		];
		$this->load->view('page/v_pendaftaran/print_status', $data);
	}

	public function print_kib()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$no_rm = $this->uri->segment(3);
		$this->db->select('a.*,d.nama_kota');
		$this->db->from('pasien a');
		$this->db->join('alamat_kota d', 'a.kota = d.id_kota');
		$this->db->where('a.no_rm', $no_rm);
		$getPasien = $this->db->get();

		$data = [
			'title' => $row->nama_aplikasi,
			'instansi' => $row->nama_instansi,
			'alamat' => $row->alamat_instansi,
			'telp' => $row->telp_instansi,
			'nama_daerah' => $row->nama_daerah,
			'pasien' => $getPasien,
			'logo_instansi' => 'assets/dist/img/' . $row->logo_instansi,
			'logo_daerah' => 'assets/dist/img/' . $row->logo_daerah,
		];
		$this->load->view('page/v_pendaftaran/print_kib', $data);
	}

	public function print_tracer()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$id_kunjungan = $this->uri->segment(3);
		$this->db->select('a.*, b.nama_pasien, c.nama_poli');
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->where('a.id_kunjungan', $id_kunjungan);
		$getPasien = $this->db->get();

		$data = [
			'title' => $row->nama_aplikasi,
			'instansi' => $row->nama_instansi,
			'alamat' => $row->alamat_instansi,
			'telp' => $row->telp_instansi,
			'nama_daerah' => $row->nama_daerah,
			'pasien' => $getPasien,
			'logo_instansi' => 'assets/dist/img/' . $row->logo_instansi,
			'logo_daerah' => 'assets/dist/img/' . $row->logo_daerah,
		];
		$this->load->view('page/v_pendaftaran/print_tracer', $data);
	}
}
