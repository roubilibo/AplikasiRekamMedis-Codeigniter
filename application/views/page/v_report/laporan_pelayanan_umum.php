<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
	<style type="text/css">
		table{
			width:100%;
			border-collapse: collapse;
		}
		label{
			font-family: Times New Roman;
			font-size: 14px;
		}
		td, label{
			text-align: center;
		}
		td{
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
			<td colspan="16">
				<label><strong style="text-transform: uppercase;"><?= $instansi ?></strong><br>
					<?= $alamat.' '.$telp.' '.$nama_daerah ?><br>
					Laporan Data Pelayanan Umum
				</label>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">No</td>
			<td style="text-align: left;">Tgl Kunjungan</td>
			<td style="text-align: left;">No RM</td>
			<td style="text-align: left;">Nama Pasien</td>
			<td style="text-align: left;">Jenis Kelamin</td>
			<td style="text-align: left;">Usia</td>
			<td style="text-align: left;">Tujuan Poli</td>
			<td style="text-align: left;">Diagnosa Utama</td>
			<td style="text-align: left;">Lama/ Baru</td>
			<td style="text-align: left;">Diagnosa Sekunder 1</td>
			<td style="text-align: left;">Lama/ Baru</td>
			<td style="text-align: left;">Diagnosa Sekunder 2</td>
			<td style="text-align: left;">Lama/ Baru</td>
			<td style="text-align: left;">Terapi</td>
			<td style="text-align: left;">Cara Bayar</td>
			<td style="text-align: left;">Jenis Pasien</td>
		</tr>
		<?php
		$no=1;
		foreach ($pasien->result() as $data) {

			$tanggal = new DateTime($data->tanggal_lahir);
			$today = new DateTime('today');
			$y = $today->diff($tanggal)->y;

			if ($y >= 60) {
				$lansia = 'Lansia';
			}else{
				$lansia = 'Pra Lansia';
			}

			$this->db->select('a.diagnosa_utama, a.diagnosa_sekunder, a.diagnosa_sekunder2, a.status_1, a.status_2, a.status_3, a.terapi, b.icd, b.diagnosa');
			$this->db->from('pasien_diagnosa a');
			$this->db->join('pengaturan_diagnosa b','a.diagnosa_utama = b.id_diagnosa');
			$this->db->where('a.id_kunjungan',$data->id_kunjungan);
			$getDiagnosa = $this->db->get()->row();

			if(empty($getDiagnosa->icd)){
			    $icd = '-';
			}else{
			    $icd = $getDiagnosa->icd;
			}

			if(empty($getDiagnosa->diagnosa)){
			    $diagnosa = '-';
			}else{
			    $diagnosa = $getDiagnosa->diagnosa;
			}

			if(empty($getDiagnosa->diagnosa_sekunder)){
			    $diagnosa_sekunder = '-';
			}else{
			    $diagnosa_sekunder = $getDiagnosa->diagnosa_sekunder;
			}

			if(empty($getDiagnosa->diagnosa_sekunder2)){
			    $diagnosa_sekunder2 = '-';
			}else{
			    $diagnosa_sekunder2 = $getDiagnosa->diagnosa_sekunder2;
			}

			if(empty($getDiagnosa->terapi)){
			    $terapi = '-';
			}else{
			    $terapi = $getDiagnosa->terapi;
			}

			if(empty($getDiagnosa->status_1)){
			    $status_1 = '-';
			}else{
			    $status_1 = $getDiagnosa->status_1;
			}

			if(empty($getDiagnosa->status_2)){
			    $status_2 = '-';
			}else{
			    $status_2 = $getDiagnosa->status_2;
			}

			if(empty($getDiagnosa->status_3)){
			    $status_3 = '-';
			}else{
			    $status_3 = $getDiagnosa->status_3;
			}

			echo '<tr>';
			echo '<td>'.$no++.'</td>';
			echo '<td>'.$data->tanggal_kunjungan.'</td>';
			echo '<td>'.$data->no_rm.'</td>';
			echo '<td style="text-align: left">'.$data->nama_pasien.'</td>';
			echo '<td>'.$data->jenis_kelamin.'</td>';
			echo '<td>'.$y.'</td>';
			echo '<td>'.$data->nama_poli.'</td>';
			echo '<td>'.$diagnosa.'</td>';
			echo '<td>'.$status_1.'</td>';
			echo '<td>'.$diagnosa_sekunder.'</td>';
			echo '<td>'.$status_2.'</td>';
			echo '<td>'.$diagnosa_sekunder2.'</td>';
			echo '<td>'.$status_3.'</td>';
			echo '<td>'.$terapi.'</td>';
			echo '<td>'.$data->nama_pembayaran.'</td>';
			echo '<td>'.$data->status_pasien.'</td>';
			echo '</tr>';
		}
		?>
	</table>

</body>
</html>