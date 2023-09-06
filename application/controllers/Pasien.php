<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pasien extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
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
			'halaman' => 'Pasien',
		];
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_pasien/pasien', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}

	public function show()
	{
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
			1 => 'no_rm',
			2 => 'nama_pasien',
			3 => 'jenis_kelamin',
			4 => 'kepala_keluarga',
			5 => 'tanggal_lahir',
			6 => 'alamat',
			7 => 'keterangan_drm',
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
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
		}
		$this->db->limit($length, $start);
		$this->db->select("a.*,c.nama_agama, d.nama_kota, e.nama_pendidikan, f.nama_pekerjaan, h.nama_suku,j.nama_kelurahan, k.nama_kecamatan");
		$this->db->from('pasien a');
		$this->db->join('pengaturan_agama c', 'a.agama = c.id_agama');
		$this->db->join('alamat_kota d', 'a.kota = d.id_kota');
		$this->db->join('pengaturan_pendidikan e', 'a.pendidikan = e.id_pendidikan');
		$this->db->join('pengaturan_pekerjaan f', 'a.pekerjaan = f.id_pekerjaan');
		$this->db->join('pengaturan_suku h', 'a.suku = h.id_suku');
		$this->db->join('alamat_kelurahan j', 'a.kelurahan = j.id_kelurahan');
		$this->db->join('alamat_kecamatan k', 'a.kecamatan = k.id_kecamatan');
		$this->db->order_by('date_created', 'desc');
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
				htmlentities(date_indo($rows->tanggal_lahir), ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->alamat, ENT_QUOTES, 'UTF-8'),
				htmlentities($rows->keterangan_drm, ENT_QUOTES, 'UTF-8'),
				'<div class="btn-group">
                <button aria-label="" data-id="' . $rows->no_rm . '" data-no_rm="' . $rows->no_rm . '" data-nama_pasien="' . $rows->nama_pasien . '" data-jenis_kelamin="' . $rows->jenis_kelamin . '" data-tanggal_lahir="' . $rows->tanggal_lahir . '" data-alamat="' . $rows->alamat . '" data-rt="' . $rows->rt . '" data-rw="' . $rows->rw . '" data-kelurahan="' . $rows->kelurahan . '" data-kecamatan="' . $rows->kecamatan . '" data-kota="' . $rows->kota . '" data-pekerjaan="' . $rows->pekerjaan . '" data-agama="' . $rows->agama . '" data-pendidikan="' . $rows->pendidikan . '" data-status_nikah="' . $rows->status_nikah . '" data-nik="' . $rows->nik . '" data-wilayah="' . $rows->wilayah . '" data-kepala_keluarga="' . $rows->kepala_keluarga . '" data-status_kk="' . $rows->status_kk . '" data-no_bpjs="' . $rows->no_bpjs . '" data-pembayaran="' . $rows->pembayaran . '" data-no_telp="' . $rows->no_telp . '" data-suku="' . $rows->suku . '" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="' . $rows->no_rm . '" data-no_rm="' . $rows->no_rm . '" data-nama_pasien="' . $rows->nama_pasien . '" data-jenis_kelamin="' . $rows->jenis_kelamin . '" data-tanggal_lahir="' . $rows->tanggal_lahir . '" data-alamat="' . $rows->alamat . '" data-rt="' . $rows->rt . '" data-rw="' . $rows->rw . '" data-kelurahan="' . $rows->nama_kelurahan . '" data-kecamatan="' . $rows->nama_kecamatan . '" data-kota="' . $rows->nama_kota . '" data-pekerjaan="' . $rows->nama_pekerjaan . '" data-agama="' . $rows->nama_agama . '" data-pendidikan="' . $rows->nama_pendidikan . '" data-status_nikah="' . $rows->status_nikah . '" data-nik="' . $rows->nik . '" data-wilayah="' . $rows->wilayah . '" data-kepala_keluarga="' . $rows->kepala_keluarga . '" data-status_kk="' . $rows->status_kk . '" data-no_bpjs="' . $rows->no_bpjs . '"class="detailData btn btn-xs btn-secondary btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Data">
                    <i class="fa fa-search"></i>
                </button>
                <a href="' . base_url("pendaftaran/print_kib/$rows->no_rm") . '" target="_blank" aria-label="" data-id="' . $rows->no_rm . '" class="btn btn-xs btn-pink btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print KIB">
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
			'tanggal_kunjungan' => $date_created,
			'tujuan_poli' => $tujuan_poli,
			'jenis_pelayanan' => $jenis_pelayanan,
			'pembayaran' => $pembayaran,
			'date_created' => $date_created,
		];
		$this->app_model->insertdata('pasien_kunjungan', $arrayKunjungan);

		$data = $this->app_model->insertdata('pasien', $array);
		echo json_encode($data);
	}

	public function edit()
	{
		$no_rm = $this->input->post('e_no_rm');
		$nama_pasien = $this->input->post('e_nama_pasien');
		$jenis_kelamin = $this->input->post('e_jenis_kelamin');
		$tanggal_lahir = $this->input->post('e_tgl_lahir');
		$alamat = $this->input->post('e_alamat');
		$rt = $this->input->post('e_rt');
		$rw = $this->input->post('e_rw');
		$kelurahan = $this->input->post('e_kelurahan');
		$kecamatan = $this->input->post('e_kecamatan');
		$kota = $this->input->post('e_kota');
		$pekerjaan = $this->input->post('e_pekerjaan');
		$agama = $this->input->post('e_agama');
		$pendidikan = $this->input->post('e_pendidikan');
		$status_nikah = $this->input->post('e_status_nikah');
		$nik = $this->input->post('e_nik');
		$wilayah = $this->input->post('e_wilayah');
		$status_pasien = $this->input->post('e_status_pasien');
		$kepala_keluarga = $this->input->post('e_kepala_keluarga');
		$status_kk = $this->input->post('e_status_kk');
		$no_bpjs = $this->input->post('e_no_bpjs');
		$jenis_pelayanan = $this->input->post('e_jenis_pelayanan');
		$no_telp = $this->input->post('e_no_telp');
		$suku = $this->input->post('e_suku');

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
			'no_bpjs' => $no_bpjs,
			'no_telp' => $no_telp,
			'suku' => $suku,
		];

		$where = "no_rm = '$no_rm'";

		$data = $this->app_model->updatedata('pasien', $array, $where);
		echo json_encode($data);
	}

	public function hapus()
	{
		$hapus_id = $this->input->post('hapus_id');

		$where = "no_rm = '$hapus_id'";

		$data = $this->app_model->deletedata('pasien', $where);
		echo json_encode($data);
	}

	public function export()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$style_col = [
			'font' => ['bold' => true],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
			]
		];

		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
			]
		];

		$sheet->setCellValue('A1', "DATA PASIEN");
		$sheet->mergeCells('A1:V1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		$sheet->setCellValue('A3', "NO");
		$sheet->setCellValue('B3', "NO RM");
		$sheet->setCellValue('C3', "NAMA PASIEN");
		$sheet->setCellValue('D3', "NIK");
		$sheet->setCellValue('E3', "NO BPJS");
		$sheet->setCellValue('F3', "JENIS KELAMIN");
		$sheet->setCellValue('G3', "TANGGAL LAHIR");
		$sheet->setCellValue('H3', "ALAMAT");
		$sheet->setCellValue('I3', "RT");
		$sheet->setCellValue('J3', "RW");
		$sheet->setCellValue('K3', "KELURAHAN");
		$sheet->setCellValue('L3', "KECAMATAN");
		$sheet->setCellValue('M3', "KOTA/KAB");
		$sheet->setCellValue('N3', "WILAYAH");
		$sheet->setCellValue('O3', "PEKERJAAN");
		$sheet->setCellValue('P3', "AGAMA");
		$sheet->setCellValue('Q3', "PENDIDIKAN");
		$sheet->setCellValue('R3', "STATUS NIKAH");
		$sheet->setCellValue('S3', "NO TELPON");
		$sheet->setCellValue('T3', "KEPALA KELUARGA");
		$sheet->setCellValue('U3', "STATUS KK");
		$sheet->setCellValue('V3', "SUKU");

		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('J3')->applyFromArray($style_col);
		$sheet->getStyle('K3')->applyFromArray($style_col);
		$sheet->getStyle('L3')->applyFromArray($style_col);
		$sheet->getStyle('M3')->applyFromArray($style_col);
		$sheet->getStyle('N3')->applyFromArray($style_col);
		$sheet->getStyle('O3')->applyFromArray($style_col);
		$sheet->getStyle('P3')->applyFromArray($style_col);
		$sheet->getStyle('Q3')->applyFromArray($style_col);
		$sheet->getStyle('R3')->applyFromArray($style_col);
		$sheet->getStyle('S3')->applyFromArray($style_col);
		$sheet->getStyle('T3')->applyFromArray($style_col);
		$sheet->getStyle('U3')->applyFromArray($style_col);
		$sheet->getStyle('V3')->applyFromArray($style_col);

		$this->db->select("a.*,c.nama_agama, d.nama_kota, e.nama_pendidikan, f.nama_pekerjaan, h.nama_suku,j.nama_kelurahan, k.nama_kecamatan");
		$this->db->from('pasien a');
		$this->db->join('pengaturan_agama c', 'a.agama = c.id_agama');
		$this->db->join('alamat_kota d', 'a.kota = d.id_kota');
		$this->db->join('pengaturan_pendidikan e', 'a.pendidikan = e.id_pendidikan');
		$this->db->join('pengaturan_pekerjaan f', 'a.pekerjaan = f.id_pekerjaan');
		$this->db->join('pengaturan_suku h', 'a.suku = h.id_suku');
		$this->db->join('alamat_kelurahan j', 'a.kelurahan = j.id_kelurahan');
		$this->db->join('alamat_kecamatan k', 'a.kecamatan = k.id_kecamatan');
		$this->db->order_by('date_created', 'desc');
		$pasien = $this->db->get();

		$no = 1;
		$numrow = 4;
		foreach ($pasien->result() as $data) {

			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->no_rm);
			$sheet->setCellValue('C' . $numrow, $data->nama_pasien);
			$sheet->setCellValue('D' . $numrow, "'" . $data->nik);
			$sheet->setCellValue('E' . $numrow, "'" . $data->no_bpjs);
			$sheet->setCellValue('F' . $numrow, $data->jenis_kelamin);
			$sheet->setCellValue('G' . $numrow, $data->tanggal_lahir);
			$sheet->setCellValue('H' . $numrow, $data->alamat);
			$sheet->setCellValue('I' . $numrow, $data->rt);
			$sheet->setCellValue('J' . $numrow, $data->rw);
			$sheet->setCellValue('K' . $numrow, $data->nama_kelurahan);
			$sheet->setCellValue('L' . $numrow, $data->nama_kecamatan);
			$sheet->setCellValue('M' . $numrow, $data->nama_kota);
			$sheet->setCellValue('N' . $numrow, $data->wilayah);
			$sheet->setCellValue('O' . $numrow, $data->nama_pekerjaan);
			$sheet->setCellValue('P' . $numrow, $data->nama_agama);
			$sheet->setCellValue('Q' . $numrow, $data->nama_pendidikan);
			$sheet->setCellValue('R' . $numrow, $data->status_nikah);
			$sheet->setCellValue('S' . $numrow, $data->no_telp);
			$sheet->setCellValue('T' . $numrow, $data->kepala_keluarga);
			$sheet->setCellValue('U' . $numrow, $data->status_kk);
			$sheet->setCellValue('V' . $numrow, $data->nama_suku);

			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('U' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('V' . $numrow)->applyFromArray($style_row);

			$no++;
			$numrow++;
		}

		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->getColumnDimension('B')->setWidth(15);
		$sheet->getColumnDimension('C')->setWidth(25);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(20);
		$sheet->getColumnDimension('F')->setWidth(20);
		$sheet->getColumnDimension('G')->setWidth(20);
		$sheet->getColumnDimension('H')->setWidth(20);
		$sheet->getColumnDimension('I')->setWidth(20);
		$sheet->getColumnDimension('J')->setWidth(20);
		$sheet->getColumnDimension('K')->setWidth(20);
		$sheet->getColumnDimension('L')->setWidth(20);
		$sheet->getColumnDimension('M')->setWidth(20);
		$sheet->getColumnDimension('N')->setWidth(20);
		$sheet->getColumnDimension('O')->setWidth(20);
		$sheet->getColumnDimension('P')->setWidth(20);
		$sheet->getColumnDimension('Q')->setWidth(20);
		$sheet->getColumnDimension('R')->setWidth(20);
		$sheet->getColumnDimension('S')->setWidth(20);
		$sheet->getColumnDimension('T')->setWidth(20);
		$sheet->getColumnDimension('U')->setWidth(20);
		$sheet->getColumnDimension('V')->setWidth(20);

		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		$sheet->setTitle("Laporan Data Pasien");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pasien.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
