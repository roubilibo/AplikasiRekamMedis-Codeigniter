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
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</head>
<body onload="">

	<table border="1" style="">
		<tr>
			<td colspan="1">
				<label><strong style="text-transform: uppercase;"><?= $instansi ?></strong><br>
					<?= $alamat.' '.$telp.' '.$nama_daerah ?><br>
					Laporan Grafik 10 Besar Penyakit
				</label>
			</td>
		</tr>
		<tr>
			<td>
				<div style="width: 800px;margin: 0px auto;">
					<canvas id="myChart"></canvas>
				</div>
			</td>
		</tr>
		
	</table>
	<script>

		const ctx = document.getElementById('myChart').getContext('2d');
		const myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: [<?php foreach ($pasien->result() as $data) {
					echo '"'.$data->icd.'",';
				} ?>],
		        datasets: [{
		            label: '#Jumlah Diagnosa',
		            data: [<?php foreach ($pasien->result() as $data) {
					echo $data->count.",";
				} ?>],
		            backgroundColor: [
		                'rgba(54, 162, 235, 0.2)',,
		            ],
		            borderColor: [
		                'rgba(54, 162, 235, 1)',
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            y: {
		                beginAtZero: true
		            }
		        }
		    }
		});
	</script>
</body>
</html>