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
	<?php
	$data = $pasien->row();
	?>
	<table border="0" style="">
		<tr>
			<td colspan="6">
				<label><strong style="text-transform: uppercase;"><?= $instansi ?></strong><br>
					<?= $alamat.' '.$telp.' '.$nama_daerah ?><br>
					Rekam Medis, Penderita <?= $data->jenis_pelayanan ?>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: right; padding-top: 0;">
				No RM : <span style="margin-left: 30px; margin-right: 10%;"><?= $data->no_rm ?></span>
			</td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: left; padding-top: 0;">
				<strong style="text-transform: uppercase;">identitas sosial pasien</strong>
			</td>
		</tr>
		<tr style="border-top: 1px solid; border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>NIK</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nik ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Alamat</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->alamat ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Nama Pasien</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_pasien ?></label></td>
			<td style="margin-left:10%;text-align: right;"><label>RT</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->rt.' RW : <span style="margin-left:20px">'.$data->rw.'</span>' ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Jenis Kelamin</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->jenis_kelamin ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Agama</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_agama ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Tanggal Lahir</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->tanggal_lahir ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Kota</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_kota ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Pendidikan</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_pendidikan ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>No Telepon</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->no_telp ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Status Nikah</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->status_nikah ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Kepala Keluarga</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->kepala_keluarga ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Pekerjaan</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_pekerjaan ?></label></td>
			<td style="text-align: left;"></td>
			<td style="text-align: left;"></td>
			<td style="text-align: left;"></td>
		</tr>
		<tr>
			<td colspan="6" style="text-align: left;">
				<strong style="text-transform: uppercase;">status tambahan</strong>
			</td>
		</tr>
		<tr style="border-top: 1px solid; border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Status Pasien</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->status_pasien ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Jenis Pelayanan</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->jenis_pelayanan ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Wilayah</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->wilayah ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Tujuan Poli</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_poli ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"><label>Suku/ Bahasa</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_suku ?></label></td>
			<td style="margin-left:10%;text-align: left;"><label>Cara Bayar</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->nama_pembayaran ?></label></td>
		</tr>
		<tr style="border-right: 1px solid;border-bottom: 1px solid;border-left: 1px solid;">
			<td style="text-align: left;"></td>
			<td style="text-align: left;"></td>
			<td style="text-align: left;"></td>
			<td style="margin-left:10%;text-align: left;"><label>No Bpjs</label></td>
			<td style="text-align: left;">:</td>
			<td style="text-align: left;"><label><?= $data->no_bpjs ?></label></td>
		</tr>
		<tr>
			<td colspan="3" valign="top" style="text-align:left;">
				<label>Letakkan barcode pada scanner</label><br>
				<img alt="testing" src="<?= base_url('assets/php-barcode-master/barcode.php?text='.$data->no_rm.'&print=true&size=50') ?>" />
			</td>
			<td colspan="3">
				<label>Petugas Rekam Medik</label><br>
				<p style="margin-top: 50px;">(............................)</p>
			</td>
		</tr>
	</table>

</body>
</html>