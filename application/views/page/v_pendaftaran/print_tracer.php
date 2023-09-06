<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
	<style type="text/css">
		table{
			width:40%;
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
			padding-top: 1px;
			padding-left: 10px;
			padding-right: 10px;
			padding-bottom: 1px;
		}
	</style>
</head>
<body onload="window.print();">
	<?php
	$data = $pasien->row();
	?>
	<table border="1" style="">
		<tr>
			<td colspan="2" style="background: lightgray;">
				<label><strong style="text-transform: uppercase;">tracer</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="background: lightgray; ">
				<label><span style="text-transform: uppercase;">data identitas sosial pasien</span>
			</td>
		</tr>
		<tr>
			<td style="text-align: left">NO RM</td>
			<td style="text-align: left"><?= $data->no_rm ?></td>
		</tr>
		<tr>
			<td style="text-align: left">NM Pasien</td>
			<td style="text-align: left"><?= $data->nama_pasien ?></td>
		</tr>
		<tr>
			<td colspan="2" style="background: lightgray; ">
				<label><span style="text-transform: uppercase;">tanggal keluar drm + tujuan</span>
			</td>
		</tr>
		<tr>
			<td style="text-align: left">Keluar</td>
			<td style="text-align: left"><?= $data->tanggal_kunjungan ?></td>
		</tr>
		<tr>
			<td style="text-align: left">Jam</td>
			<td style="text-align: left"><?= $data->drm_keluar ?></td>
		</tr>
		<tr>
			<td style="text-align: left">Tujuan Poli</td>
			<td style="text-align: left"><?= $data->nama_poli ?></td>
		</tr>
		
	</table>

</body>
</html>