<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
	<style type="text/css">
		table {
			width: 100%;
			border-collapse: collapse;
		}

		label {
			font-family: Times New Roman;
			font-size: 14px;
		}

		td,
		label {
			text-align: center;
		}

		td {
			padding-top: 10px;
			padding-left: 10px;
			padding-right: 10px;
			padding-bottom: 10px;
		}
	</style>
</head>

<body onload="window.print();">

	<table border="1" style="">
		<tr>
			<td colspan="12">
				<label><strong style="text-transform: uppercase;"><?= $instansi ?></strong><br>
					<?= $alamat . ' ' . $telp . ' ' . $nama_daerah ?><br>
					Laporan Data Pasien Berkunjung
				</label>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">No</td>
			<td style="text-align: left;">Tgl Kunjungan</td>
			<td style="text-align: left;">Status Pasien</td>
			<td style="text-align: left;">No RM</td>
			<td style="text-align: left;">Nama Pasien</td>
			<td style="text-align: left;">Jenis Kelamin</td>
			<td style="text-align: left;">Usia</td>
			<td style="text-align: left;">Lansia/ Pra Lansia</td>
			<td style="text-align: left;">ICD</td>
			<td style="text-align: left;">Diagnosa</td>
			<td style="text-align: left;">Terapi</td>
			<td style="text-align: left;">Cara Bayar</td>
		</tr>
		<?php
		$no = 1;
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

			echo '<tr>';
			echo '<td>' . $no++ . '</td>';
			echo '<td>' . $data->tanggal_kunjungan . '</td>';
			echo '<td>' . $data->status_pasien . '</td>';
			echo '<td>' . $data->no_rm . '</td>';
			echo '<td style="text-align: left">' . $data->nama_pasien . '</td>';
			echo '<td>' . $data->jenis_kelamin . '</td>';
			echo '<td>' . $y . '</td>';
			echo '<td>' . $lansia . '</td>';
			echo '<td>' . $icd . '</td>';
			echo '<td>' . $diagnosa . '</td>';
			echo '<td>' . $terapi . '</td>';
			echo '<td>' . $data->nama_pembayaran . '</td>';
			echo '</tr>';
		}
		?>
	</table>

</body>

</html>