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
	$tanggal = new DateTime($data->tanggal_lahir);
	$today = new DateTime('today');
	$y = $today->diff($tanggal)->y;
	
	?>
	<table border="1" style="">
		<tr>
			<td colspan="3" style="background: lightgray;">
				<label><strong style="text-transform: uppercase;">kartu identitas berobat</strong>
			</td>
			<td rowspan="9" valign="top" style="width: 50%; text-align: left;">
				<img alt="testing" src="<?= base_url('assets/php-barcode-master/barcode.php?text='.$data->no_rm.'&print=true&size=50') ?>" />
			</td>
		</tr>
		<tr>
			<td colspan="3" style="background: lightgray;">
				<label>
					<?= $instansi.' '.$alamat.' '.$telp.' '.$nama_daerah ?>
					Rekam Medis
				</label>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				No Rekam Medis 
			</td>
			<td colspan="2" style="text-align: left;">
				<?= $data->no_rm ?>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Nama
			</td>
			<td colspan="2" style="text-align: left;">
				<?= $data->nama_pasien ?>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Jenis Kelamin
			</td>
			<td colspan="2" style="text-align: left;">
				<?= $data->jenis_kelamin ?>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Tgl Lahir/Umur
			</td>
			<td style="text-align: left;">
				<?= $data->tanggal_lahir ?>
			</td>
			<td style="text-align: left;">
				<?= $y ?>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Alamat
			</td>
			<td colspan="2" style="text-align: left;">
				<?= $data->alamat ?>
			</td>
		</tr>
		<tr>
			<td style="text-align: left;">
				Kota/ Kabupaten
			</td>
			<td colspan="2" style="text-align: left;">
				<?= $data->nama_kota ?>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="background: lightgray;">
				<label><strong style="text-transform: uppercase; font-size:8px;">bawalah kartu ini setiap kali berobat ke <?= $instansi ?></strong>
			</td>
		</tr>
	</table>

</body>
</html>