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
			<td colspan="12">
				<label><strong style="text-transform: uppercase;"><?= $instansi ?></strong><br>
					<?= $alamat.' '.$telp.' '.$nama_daerah ?><br>
					Laporan Kelengkapan Data Dokumen Rekam Medis
				</label>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">No</td>
			<td style="text-align: left;">Tanggal - Waktu</td>
			<td style="text-align: left;">DRM Keluar</td>
			<td style="text-align: left;">Nama Poli</td>
			<td style="text-align: left;">DRM Masuk</td>
			<td style="text-align: left;">Selisih Menit</td>
			<td style="text-align: left;">Rata Menit</td>
			<td style="text-align: left;">No RM</td>
			<td style="text-align: left;">Keterangan DRM</td>
		</tr>
		<?php
		$no=1;
		foreach ($pasien->result() as $data) {
			$selisih_menit = $data->selisih_menit/60;
			$rata_menit = $rata/60;
			echo '<tr>';
			echo '<td>'.$no++.'</td>';
			echo '<td>'.$data->date_created.'</td>';
			echo '<td>'.$data->drm_keluar.'</td>';
			echo '<td>'.$data->nama_poli.'</td>';
			echo '<td>'.$data->drm_masuk.'</td>';
			echo '<td>'.$selisih_menit.'</td>';
			echo '<td>'.$rata_menit.'</td>';
			echo '<td>'.$data->no_rm.'</td>';
			echo '<td>'.$data->keterangan_drm.'</td>';
			echo '</tr>';
		}
		?>
	</table>

</body>
</html>