<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
	}

	public function laporan_pasien_berkunjung()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('a.*,b.nama_pasien, b.status_pasien, b.jenis_kelamin, b.tanggal_lahir, c.nama_pembayaran');
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_pembayaran c', 'a.pembayaran = c.id_pembayaran');
		$this->db->where('DATE(a.tanggal_kunjungan) >=', $tgl_awal);
		$this->db->where('DATE(a.tanggal_kunjungan) <=', $tgl_akhir);
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
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_report/laporan_pasien_berkunjung', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}
	public function export_pasien_berkunjung()
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

		$sheet->setCellValue('A1', "LAPORAN PASIEN BERKUNJUNG");
		$sheet->mergeCells('A1:V1');
		$sheet->getStyle('A1')->getFont()->setBold(true);
		$sheet->setCellValue('A3', "NO");
		$sheet->setCellValue('B3', "Tgl Kunjungan");
		$sheet->setCellValue('C3', "Status Pasien");
		$sheet->setCellValue('D3', "No RM");
		$sheet->setCellValue('E3', "Nama Pasien");
		$sheet->setCellValue('F3', "Jenis Kelamin");
		$sheet->setCellValue('G3', "Usia");
		$sheet->setCellValue('H3', "Lansia/Pra Lansia");
		$sheet->setCellValue('I3', "ICD");
		$sheet->setCellValue('J3', "Diagnosa");
		$sheet->setCellValue('K3', "Terapi");
		$sheet->setCellValue('L3', "Cara Bayar");

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

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('a.*,b.nama_pasien, b.status_pasien, b.jenis_kelamin, b.tanggal_lahir, c.nama_pembayaran');
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_pembayaran c', 'a.pembayaran = c.id_pembayaran');
		$this->db->where('DATE(a.tanggal_kunjungan) >=', $tgl_awal);
		$this->db->where('DATE(a.tanggal_kunjungan) <=', $tgl_akhir);
		$pasien = $this->db->get();

		$no = 1;
		$numrow = 4;
		foreach ($pasien->result() as $data) {
			$tanggal = new DateTime($data->tanggal_lahir);
			$today = new DateTime('today');
			$y = $today->diff($tanggal)->y;

			if ($y >= 60) {
				$lansia = 'Lansia';
			} else {
				$lansia = 'Pra Lansia';
			}

			$this->db->select('a.diagnosa_utama, a.terapi, b.icd, b.diagnosa');
			$this->db->from('pasien_diagnosa a');
			$this->db->join('pengaturan_diagnosa b', 'a.diagnosa_utama = b.id_diagnosa');
			$this->db->where('a.id_kunjungan', $data->id_kunjungan);
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

			if (empty($getDiagnosa->terapi)) {
				$terapi = '-';
			} else {
				$terapi = $getDiagnosa->terapi;
			}
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->tanggal_kunjungan);
			$sheet->setCellValue('C' . $numrow, $data->status_pasien);
			$sheet->setCellValue('D' . $numrow, $data->no_rm);
			$sheet->setCellValue('E' . $numrow, $data->nama_pasien);
			$sheet->setCellValue('F' . $numrow, $data->jenis_kelamin);
			$sheet->setCellValue('G' . $numrow, $y);
			$sheet->setCellValue('H' . $numrow, $lansia);
			$sheet->setCellValue('I' . $numrow, $icd);
			$sheet->setCellValue('J' . $numrow, $diagnosa);
			$sheet->setCellValue('K' . $numrow, $terapi);
			$sheet->setCellValue('L' . $numrow, $data->nama_pembayaran);

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

		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		$sheet->setTitle("Laporan Data Pasien berkunjung");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Pasien Berkunjung.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function laporan_kelengkapan_drm()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select("a.*,TIMESTAMPDIFF(SECOND,a.drm_masuk,a.drm_keluar) as selisih_menit, b.nama_pasien, b.jenis_kelamin, b.kepala_keluarga, b.tanggal_lahir, b.alamat, c.nama_poli");
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->where('DATE(a.date_created) >=', $tgl_awal);
		$this->db->where('DATE(a.date_created) <=', $tgl_akhir);
		$getPasien = $this->db->get();

		$data = [
			'title' => $row->nama_aplikasi,
			'instansi' => $row->nama_instansi,
			'alamat' => $row->alamat_instansi,
			'telp' => $row->telp_instansi,
			'nama_daerah' => $row->nama_daerah,
			'pasien' => $getPasien,
			'rata' => $this->avg_data(),
			'logo_instansi' => 'assets/dist/img/' . $row->logo_instansi,
			'logo_daerah' => 'assets/dist/img/' . $row->logo_daerah,
		];
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_report/laporan_kelengkapan_drm', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}

	public function export_kelengkapan_drm()
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

		$sheet->setCellValue('A1', "LAPORAN KELENGKAPAN DRM");
		$sheet->mergeCells('A1:V1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		$sheet->setCellValue('A3', "NO");
		$sheet->setCellValue('B3', "Tanggal-Waktu");
		$sheet->setCellValue('C3', "DRM Keluar");
		$sheet->setCellValue('D3', "Nama Poli");
		$sheet->setCellValue('E3', "DRM Masuk");
		$sheet->setCellValue('F3', "Selisih Menit");
		$sheet->setCellValue('G3', "Rata Menit");
		$sheet->setCellValue('H3', "No RM");
		$sheet->setCellValue('I3', "KETERANGAN DRM");

		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);

		// query 
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select("a.*,TIMESTAMPDIFF(SECOND,a.drm_masuk,a.drm_keluar) as selisih_menit, b.nama_pasien, b.jenis_kelamin, b.kepala_keluarga, b.tanggal_lahir, b.alamat, c.nama_poli");
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->where('DATE(a.date_created) >=', $tgl_awal);
		$this->db->where('DATE(a.date_created) <=', $tgl_akhir);
		$pasien = $this->db->get();
		$rata = $this->avg_data();
		$no = 1;
		$numrow = 4;
		foreach ($pasien->result() as $data) {
			$selisih_menit = $data->selisih_menit / 60;
			$rata_menit = $rata / 60;
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->date_created);
			$sheet->setCellValue('C' . $numrow, $data->drm_keluar);
			$sheet->setCellValue('D' . $numrow, $data->nama_poli);
			$sheet->setCellValue('E' . $numrow, $data->drm_masuk);
			$sheet->setCellValue('F' . $numrow, $selisih_menit);
			$sheet->setCellValue('G' . $numrow, $rata_menit);
			$sheet->setCellValue('H' . $numrow, $data->no_rm);
			$sheet->setCellValue('I' . $numrow, $data->keterangan_drm);

			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);

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

		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		$sheet->setTitle("Laporan Kelengkapan DRM");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Kelengkapan DRM.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function laporan_pelayanan_umum()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('a.*,b.nama_pasien, b.status_pasien, b.jenis_kelamin, b.tanggal_lahir, c.nama_poli, d.nama_pembayaran');
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->join('pengaturan_pembayaran d', 'a.pembayaran = d.id_pembayaran');
		$this->db->where('DATE(a.tanggal_kunjungan) >=', $tgl_awal);
		$this->db->where('DATE(a.tanggal_kunjungan) <=', $tgl_akhir);
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
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_report/laporan_pelayanan_umum', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}

	public function export_pelayanan_umum()
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

		$sheet->setCellValue('A1', "LAPORAN DATA PELAYANAN UMUM");
		$sheet->mergeCells('A1:V1');
		$sheet->getStyle('A1')->getFont()->setBold(true);

		$sheet->setCellValue('A3', "NO");
		$sheet->setCellValue('B3', "Tgl Kunjungan");
		$sheet->setCellValue('C3', "No RM");
		$sheet->setCellValue('D3', "Nama Pasien");
		$sheet->setCellValue('E3', "Jenis Kelamin");
		$sheet->setCellValue('F3', "Usia");
		$sheet->setCellValue('G3', "Tujuan Poli");
		$sheet->setCellValue('H3', "Diagnosa Utama");
		$sheet->setCellValue('I3', "Lama/Baru");
		$sheet->setCellValue('J3', "Diagnosa Sekunder 1");
		$sheet->setCellValue('K3', "Lama/Baru");
		$sheet->setCellValue('L3', "Diagnosa Sekunder 2");
		$sheet->setCellValue('M3', "Lama/Baru");
		$sheet->setCellValue('N3', "Terapi");
		$sheet->setCellValue('O3', "Cara Bayar");
		$sheet->setCellValue('P3', "Jenis Pasien");

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

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('a.*,b.nama_pasien, b.status_pasien, b.jenis_kelamin, b.tanggal_lahir, c.nama_poli, d.nama_pembayaran');
		$this->db->from('pasien_kunjungan a');
		$this->db->join('pasien b', 'a.no_rm = b.no_rm');
		$this->db->join('pengaturan_poli c', 'a.tujuan_poli = c.id_poli');
		$this->db->join('pengaturan_pembayaran d', 'a.pembayaran = d.id_pembayaran');
		$this->db->where('DATE(a.tanggal_kunjungan) >=', $tgl_awal);
		$this->db->where('DATE(a.tanggal_kunjungan) <=', $tgl_akhir);
		$pasien = $this->db->get();

		$no = 1;
		$numrow = 4;
		foreach ($pasien->result() as $data) {

			$tanggal = new DateTime($data->tanggal_lahir);
			$today = new DateTime('today');
			$y = $today->diff($tanggal)->y;

			if ($y >= 60) {
				$lansia = 'Lansia';
			} else {
				$lansia = 'Pra Lansia';
			}

			$this->db->select('a.diagnosa_utama, a.diagnosa_sekunder, a.diagnosa_sekunder2, a.status_1, a.status_2, a.status_3, a.terapi, b.icd, b.diagnosa');
			$this->db->from('pasien_diagnosa a');
			$this->db->join('pengaturan_diagnosa b', 'a.diagnosa_utama = b.id_diagnosa');
			$this->db->where('a.id_kunjungan', $data->id_kunjungan);
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

			if (empty($getDiagnosa->diagnosa_sekunder)) {
				$diagnosa_sekunder = '-';
			} else {
				$diagnosa_sekunder = $getDiagnosa->diagnosa_sekunder;
			}

			if (empty($getDiagnosa->diagnosa_sekunder2)) {
				$diagnosa_sekunder2 = '-';
			} else {
				$diagnosa_sekunder2 = $getDiagnosa->diagnosa_sekunder2;
			}

			if (empty($getDiagnosa->terapi)) {
				$terapi = '-';
			} else {
				$terapi = $getDiagnosa->terapi;
			}

			if (empty($getDiagnosa->status_1)) {
				$status_1 = '-';
			} else {
				$status_1 = $getDiagnosa->status_1;
			}

			if (empty($getDiagnosa->status_2)) {
				$status_2 = '-';
			} else {
				$status_2 = $getDiagnosa->status_2;
			}

			if (empty($getDiagnosa->status_3)) {
				$status_3 = '-';
			} else {
				$status_3 = $getDiagnosa->status_3;
			}

			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->tanggal_kunjungan);
			$sheet->setCellValue('C' . $numrow, $data->no_rm);
			$sheet->setCellValue('D' . $numrow, $data->nama_pasien);
			$sheet->setCellValue('E' . $numrow, $data->jenis_kelamin);
			$sheet->setCellValue('F' . $numrow, $y);
			$sheet->setCellValue('G' . $numrow, $data->nama_poli);
			$sheet->setCellValue('H' . $numrow, $diagnosa);
			$sheet->setCellValue('I' . $numrow, $status_1);
			$sheet->setCellValue('J' . $numrow, $diagnosa_sekunder);
			$sheet->setCellValue('K' . $numrow, $status_2);
			$sheet->setCellValue('L' . $numrow, $diagnosa_sekunder2);
			$sheet->setCellValue('M' . $numrow, $status_3);
			$sheet->setCellValue('N' . $numrow, $terapi);
			$sheet->setCellValue('O' . $numrow, $data->nama_pembayaran);
			$sheet->setCellValue('P' . $numrow, $data->status_pasien);

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

		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		$sheet->setTitle("Laporan Data Pelayanan Umum");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Data Pelayanan Umum.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function laporan_grafik_kunjungan()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('*, DATE(tanggal_kunjungan) as tgl, COUNT(tanggal_kunjungan) as count');
		$this->db->from('pasien_kunjungan');
		$this->db->where('DATE(tanggal_kunjungan) >=', $tgl_awal);
		$this->db->where('DATE(tanggal_kunjungan) <=', $tgl_akhir);
		$this->db->group_by('DATE(tanggal_kunjungan)');
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
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_report/laporan_grafik_kunjungan', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}

	public function laporan_penyakit()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('a.*, COUNT(a.diagnosa_utama) as count, b.icd');
		$this->db->from('pasien_diagnosa a');
		$this->db->join('pengaturan_diagnosa b', 'a.diagnosa_utama = b.id_diagnosa');
		$this->db->where('DATE(a.date_created) >=', $tgl_awal);
		$this->db->where('DATE(a.date_created) <=', $tgl_akhir);
		$this->db->group_by('a.diagnosa_utama');
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
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_report/laporan_penyakit', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}

	public function laporan_dokter_terbaik()
	{
		$this->db->select('*');
		$this->db->from('pengaturan');
		$this->db->where('id_pengaturan', 1);
		$result = $this->db->get();
		$row = $result->row();

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$this->db->select('a.*, COUNT(a.id_diagnosa) as count, b.nama_dokter');
		$this->db->from('pasien_diagnosa a');
		$this->db->join('dokter b', 'a.id_dokter = b.id_dokter');
		$this->db->where('DATE(a.date_created) >=', $tgl_awal);
		$this->db->where('DATE(a.date_created) <=', $tgl_akhir);
		$this->db->group_by('a.id_diagnosa');
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
		if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
			$this->load->view('page/v_report/laporan_dokter_terbaik', $data);
		} else if ($this->session->userdata('level') == 'dokter') {
			$this->load->view('page/v_error/error', $data);
		}
	}

	public function avg_data()
	{
		$query = $this->db->select("ROUND(AVG(TIMESTAMPDIFF(SECOND,drm_masuk,drm_keluar)),1) as num")->get('pasien_kunjungan');
		$result = $query->row();
		if (isset($result)) return $result->num;
		return 0;
	}
}
