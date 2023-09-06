<!-- JavaScript -->

<!-- jQuery -->
<script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url('assets/vendors/popper.js/dist/umd/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>

<!-- Slimscroll JavaScript -->
<script src="<?= base_url('assets/dist/js/jquery.slimscroll.js') ?>"></script>

<!-- Fancy Dropdown JS -->
<script src="<?= base_url('assets/dist/js/dropdown-bootstrap-extended.js') ?>"></script>

<script src="<?= base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-dt/js/dataTables.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/jszip/dist/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/dataTables-data.js') ?>"></script>

<!-- Toastr JS -->
<script src="<?= base_url('assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.js') ?>"></script>

<script src="<?= base_url('assets/vendors/select2/dist/js/select2.full.min.js') ?>"></script>

<script src="<?= base_url('assets/vendors/numeral/currency.min.js') ?>"></script>

<!-- FeatherIcons JavaScript -->
<script src="<?= base_url('assets/dist/js/feather.min.js') ?>"></script>

<!-- Init JavaScript -->
<script src="<?= base_url('assets/dist/js/init.js') ?>"></script>

<div class="modal fade stick-up" id="modal-laporan-pasien-berkunjung" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Laporan Pasien Berkunjung</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('laporan/laporan_pasien_berkunjung') ?>" target="_blank">
					<div class="form-group-attached">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" name="simpan" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
						<div class="col-md-8 m-t-10 sm-m-t-10">
							<button type="submit" formaction="<?= base_url('laporan/export_pasien_berkunjung') ?>" name="export" class="btn btn-success float-right m-t-5">Export to Excel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade stick-up" id="modal-laporan-kelengkapan-drm" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Laporan Kelengkapan DRM</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('laporan/laporan_kelengkapan_drm') ?>" target="_blank">
					<div class="form-group-attached">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
						<div class="col-md-8 m-t-10 sm-m-t-10">
							<button type="submit" formaction="<?= base_url('laporan/export_kelengkapan_drm') ?>" name="export" class="btn btn-success float-right m-t-5">Export to Excel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade stick-up" id="modal-laporan-pelayanan-umum" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Laporan Pelayanan Umum</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('laporan/laporan_pelayanan_umum') ?>" target="_blank">
					<div class="form-group-attached">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
						<div class="col-md-8 m-t-10 sm-m-t-10">
							<button type="submit" formaction="<?= base_url('laporan/export_pelayanan_umum') ?>" name="export" class="btn btn-success float-right m-t-5">Export to Excel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade stick-up" id="modal-laporan-grafik-kunjungan" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Laporan Grafik </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('laporan/laporan_grafik_kunjungan') ?>" target="_blank">
					<div class="form-group-attached">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade stick-up" id="modal-laporan-penyakit" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Laporan Grafik </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('laporan/laporan_penyakit') ?>" target="_blank">
					<div class="form-group-attached">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade stick-up" id="modal-laporan-dokter-terbaik" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Laporan Grafik </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('laporan/laporan_dokter_terbaik') ?>" target="_blank">
					<div class="form-group-attached">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Awal</label>
									<input type="date" name="tgl_awal" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Tanggal Akhir</label>
									<input type="date" name="tgl_akhir" class="form-control">
								</div>
							</div>
						</div>


					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script type="text/javascript">
	window.setTimeout("waktu()", 1000);

	function waktu() {
		var tanggal = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = tanggal.getHours() + ":" + tanggal.getMinutes() + ":" + tanggal.getSeconds();
	}
</script>