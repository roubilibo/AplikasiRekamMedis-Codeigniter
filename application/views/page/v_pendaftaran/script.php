<div class="modal fade stick-up" id="modal-tambah" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Tambah <?= $halaman ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="#" id="formSimpan" enctype="multipart/form-data">
					<div class="form-group-attached">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>No Rekam Medis</label>
									<input type="text" name="no_rm" id="no_rm" class="form-control" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Nama Pasien</label>
									<input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Jenis Kelamin</label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control select2" required="">
										<option></option>
										<option>L</option>
										<option>P</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Tanggal Lahir</label>
									<input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Alamat</label>
									<input type="text" name="alamat" id="alamat" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>RT</label>
									<input type="text" name="rt" id="rt" class="form-control" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>RW</label>
									<input type="text" name="rw" id="rw" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kelurahan</label>
									<select name="kelurahan" id="kelurahan" class="form-control select2" required="">
										<?php
										$result = $this->db->get('alamat_kelurahan')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_kelurahan'>$data->nama_kelurahan</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kecamatan</label>
									<select name="kecamatan" id="kecamatan" class="form-control select2" required="">
										<?php
										$result = $this->db->get('alamat_kecamatan')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_kecamatan'>$data->nama_kecamatan</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kota</label>
									<select name="kota" id="kota" class="form-control select2" required="">
										<?php
										$result = $this->db->get('alamat_kota')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_kota'>$data->nama_kota</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Pekerjaan</label>
									<select name="pekerjaan" id="pekerjaan" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_pekerjaan')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_pekerjaan'>$data->nama_pekerjaan</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Agama</label>
									<select name="agama" id="agama" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_agama')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_agama'>$data->nama_agama</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Pendidikan</label>
									<select name="pendidikan" id="pendidikan" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_pendidikan')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_pendidikan'>$data->nama_pendidikan</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Status Nikah</label>
									<select name="status_nikah" id="status_nikah" class="form-control select2" required="">
										<option>Menikah</option>
										<option>Belum Menikah</option>
										<option>Pernah Menikah</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>NIK</label>
									<input type="text" name="nik" id="nik" class="form-control" required="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Wilayah</label>
									<select name="wilayah" id="wilayah" class="form-control select2" required="">
										<option>LW</option>
										<option>DW</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Status Pasien</label>
									<select name="status_pasien" id="status_pasien" class="form-control select2" required="">
										<option>Baru</option>
										<option>Lama</option>
										<option>Kunjungan</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kepala Keluarga</label>
									<input type="text" name="kepala_keluarga" id="kepala_keluarga" class="form-control" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Status KK</label>
									<select name="status_kk" id="status_kk" class="form-control select2" required="">
										<option>Baru</option>
										<option>Lama</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Cara Bayar</label>
									<select name="pembayaran" id="pembayaran" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_pembayaran')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_pembayaran'>$data->nama_pembayaran</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>No BPJS</label>
									<input type="text" name="no_bpjs" id="no_bpjs" class="form-control" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Jenis Pelayanan</label>
									<select name="jenis_pelayanan" id="jenis_pelayanan" class="form-control select2" required="">
										<option>UGD</option>
										<option>RAWAT JALAN</option>
										<option>RAWAT INAP</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Tujuan Poli</label>
									<select name="tujuan_poli" id="tujuan_poli" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_poli')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_poli'>$data->nama_poli</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>No Telepon</label>
									<input type="text" name="no_telp" id="no_telp" class="form-control" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Suku/Bahasa</label>
									<select name="suku" id="suku" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_suku')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_suku'>$data->nama_suku</option>";
										}
										?>
									</select>
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

<div class="modal fade stick-up" id="modal-tambah-lama" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Tambah <?= $halaman ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>
			<div class="modal-body">
				<form method="POST" action="#" id="formSimpanLama" enctype="multipart/form-data">
					<div class="form-group-attached">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>No Rekam Medis</label>
									<select name="no_rm_lama" id="no_rm_lama" class="form-control select2" required="">
										<option></option>
										<?php
										$result = $this->db->get('pasien')->result();
										foreach ($result as $data) {
											echo "<option value='$data->no_rm'>$data->no_rm</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Nama Pasien</label>
									<input type="text" name="nama_pasien_lama" id="nama_pasien_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Jenis Kelamin</label>
									<input type="text" name="jenis_kelamin_lama" id="jenis_kelamin_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Tanggal Lahir</label>
									<input type="text" name="tgl_lahir_lama" id="tgl_lahir_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-group-default">
									<label>Alamat</label>
									<input type="text" name="alamat_lama" id="alamat_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>RT</label>
									<input type="text" name="rt_lama" id="rt_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>RW</label>
									<input type="text" name="rw_lama" id="rw_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kelurahan</label>
									<input type="text" name="kelurahan_lama" id="kelurahan_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kecamatan</label>
									<input type="text" name="kecamatan_lama" id="kecamatan_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kota</label>
									<input type="text" name="kota_lama" id="kota_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Pekerjaan</label>
									<input type="text" name="pekerjaan_lama" id="pekerjaan_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Agama</label>
									<input type="text" name="agama_lama" id="agama_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Pendidikan</label>
									<input type="text" name="pendidikan_lama" id="pendidikan_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Status Nikah</label>
									<input type="text" name="status_nikah_lama" id="status_nikah_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>NIK</label>
									<input type="text" name="nik_lama" id="nik_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Wilayah</label>
									<input type="text" name="wilayah_lama" id="wilayah_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Kepala Keluarga</label>
									<input type="text" name="kepala_keluarga_lama" id="kepala_keluarga_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Status KK</label>
									<input type="text" name="status_kk_lama" id="status_kk_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>No BPJS</label>
									<input type="text" name="no_bpjs_lama" id="no_bpjs_lama" class="form-control bg-grey" readonly="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Cara Bayar</label>
									<select type="text" name="pembayaran_lama" id="pembayaran_lama" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_pembayaran')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_pembayaran'>$data->nama_pembayaran</option>";
										}
										?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Jenis Pelayanan</label>
									<select name="jenis_pelayanan_lama" id="jenis_pelayanan_lama" class="form-control select2" required="">
										<option>UGD</option>
										<option>RAWAT JALAN</option>
										<option>RAWAT INAP</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label>Tujuan Poli</label>
									<select name="tujuan_poli_lama" id="tujuan_poli_lama" class="form-control select2" required="">
										<?php
										$result = $this->db->get('pengaturan_poli')->result();
										foreach ($result as $data) {
											echo "<option value='$data->id_poli'>$data->nama_poli</option>";
										}
										?>
									</select>
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

<div id="modal-edit" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Edit <?= $halaman ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>

			<div class="modal-body">
				<form method="POST" action="#" id="formEdit" enctype="multipart/form-data">
					<br>
					<input type="hidden" name="edit_id" id="edit_id">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>No Rekam Medis</label>
								<input type="text" name="e_no_rm" id="e_no_rm" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Nama Pasien</label>
								<input type="text" name="e_nama_pasien" id="e_nama_pasien" class="form-control bg-grey" readonly="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Jenis Kelamin</label>
								<input type="text" name="e_jenis_kelamin" id="e_jenis_kelamin" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Tanggal Lahir</label>
								<input type="text" name="e_tgl_lahir" id="e_tgl_lahir" class="form-control bg-grey" readonly="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default">
								<label>Alamat</label>
								<input type="text" name="e_alamat" id="e_alamat" class="form-control bg-grey" readonly="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>RT</label>
								<input type="text" name="e_rt" id="e_rt" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>RW</label>
								<input type="text" name="e_rw" id="e_rw" class="form-control bg-grey" readonly="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Kelurahan</label>
								<input type="text" name="e_kelurahan" id="e_kelurahan" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Kecamatan</label>
								<input type="text" name="e_kecamatan" id="e_kecamatan" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Kota</label>
								<input type="text" name="e_kota" id="e_kota" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Pekerjaan</label>
								<input type="text" name="e_pekerjaan" id="e_pekerjaan" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Agama</label>
								<input type="text" name="e_agama" id="e_agama" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Pendidikan</label>
								<input type="text" name="e_pendidikan" id="e_pendidikan" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Status Nikah</label>
								<input type="text" name="e_status_nikah" id="e_status_nikah" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>NIK</label>
								<input type="text" name="e_nik" id="e_nik" class="form-control bg-grey" readonly="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Wilayah</label>
								<input type="text" name="e_wilayah" id="e_wilayah" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Kepala Keluarga</label>
								<input type="text" name="e_kepala_keluarga" id="e_kepala_keluarga" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Status KK</label>
								<input type="text" name="e_status_kk" id="e_status_kk" class="form-control bg-grey" readonly="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>No BPJS</label>
								<input type="text" name="e_no_bpjs" id="e_no_bpjs" class="form-control bg-grey" readonly="">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Cara Bayar</label>
								<select type="text" name="e_pembayaran" id="e_pembayaran" class="form-control select2" required="">
									<?php
									$result = $this->db->get('pengaturan_pembayaran')->result();
									foreach ($result as $data) {
										echo "<option value='$data->id_pembayaran'>$data->nama_pembayaran</option>";
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Jenis Pelayanan</label>
								<select name="e_jenis_pelayanan" id="e_jenis_pelayanan" class="form-control select2" required="">
									<option>UGD</option>
									<option>RAWAT JALAN</option>
									<option>RAWAT INAP</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label>Tujuan Poli</label>
								<select name="e_tujuan_poli" id="e_tujuan_poli" class="form-control select2" required="">
									<?php
									$result = $this->db->get('pengaturan_poli')->result();
									foreach ($result as $data) {
										echo "<option value='$data->id_poli'>$data->nama_poli</option>";
									}
									?>
								</select>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-4 m-t-10 sm-m-t-10">
							<button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
						</div>
					</div>
			</div>


			<?= form_close() ?>
		</div>
	</div>
</div>

<div id="modal-detail" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
				<h5 class="modal-title">Detail <?= $halaman ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>

			</div>

			<div class="modal-body">
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>No Rekam Medis</label>
							<input type="text" name="d_no_rm" id="d_no_rm" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Nama Pasien</label>
							<input type="text" name="d_nama_pasien" id="d_nama_pasien" class="form-control" readonly="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Jenis Kelamin</label>
							<input type="text" name="d_jenis_kelamin" id="d_jenis_kelamin" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Tanggal Lahir</label>
							<input type="text" name="d_tgl_lahir" id="d_tgl_lahir" class="form-control" readonly="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group form-group-default">
							<label>Alamat</label>
							<input type="text" name="d_alamat" id="d_alamat" class="form-control" readonly="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>RT</label>
							<input type="text" name="d_rt" id="d_rt" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>RW</label>
							<input type="text" name="d_rw" id="d_rw" class="form-control" readonly="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Kelurahan</label>
							<input type="text" name="d_kelurahan" id="d_kelurahan" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Kecamatan</label>
							<input type="text" name="d_kecamatan" id="d_kecamatan" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Kota</label>
							<input type="text" name="d_kota" id="d_kota" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Pekerjaan</label>
							<input type="text" name="d_pekerjaan" id="d_pekerjaan" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Agama</label>
							<input type="text" name="d_agama" id="d_agama" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Pendidikan</label>
							<input type="text" name="d_pendidikan" id="d_pendidikan" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Status Nikah</label>
							<input type="text" name="d_status_nikah" id="d_status_nikah" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>NIK</label>
							<input type="text" name="d_nik" id="d_nik" class="form-control" readonly="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Wilayah</label>
							<input type="text" name="d_wilayah" id="d_wilayah" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Kepala Keluarga</label>
							<input type="text" name="d_kepala_keluarga" id="d_kepala_keluarga" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Status KK</label>
							<input type="text" name="d_status_kk" id="d_status_kk" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>No BPJS</label>
							<input type="text" name="d_no_bpjs" id="d_no_bpjs" class="form-control" readonly="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Cara Bayar</label>
							<input type="text" name="d_pembayaran" id="d_pembayaran" class="form-control" readonly="">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Jenis Pelayanan</label>
							<input type="text" name="d_jenis_pelayanan" id="d_jenis_pelayanan" class="form-control" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label>Tujuan Poli</label>
							<input type="text" name="d_tujuan_poli" id="d_tujuan_poli" class="form-control" readonly="">
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
</div>


<div id="modal-hapus" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h6 class="modal-title text-white">Hapus Data</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="#" id="formHapus">
					<div class="row">
						<input type="hidden" id="hapus_id" name="hapus_id">
						<label>Apakah anda ingin menghapus data ini?</label>

					</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-danger">Hapus</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(e) {

		var base_url = "<?php echo base_url(); ?>";
		var nm_tabel = "pendaftaran";

		var table = $('#datatable').DataTable({
			"pageLength": 10,
			"serverSide": true,
			"lengthChange": false,
			"order": [
				[0, "asc"]
			],
			"ajax": {
				url: base_url + nm_tabel + '/show',
				type: 'POST'
			},

		}); // End of DataTable
		table.on("order.dt search.dt processing.dt", function() {
			table.column(0, {
				search: "applied",
				order: "applied"
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1;
			});
		}).draw();
		// setInterval( function () {
		// 	table.ajax.reload();
		// }, 1000 );
		$('body').tooltip({
			selector: '[data-toggle="tooltip"]'
		});

		$('.select2').select2();

		// function getRM(){
		// 	var no_rm = $('#no_rm').val();
		// 	$.ajax({
		// 		type : "POST",
		//            url: base_url+nm_tabel+'/getRM',
		//            processData:false,
		// 		contentType:false,
		//            // data : "no_rm ="+no_rm,
		//        success : function (data) {
		//            var json = data,
		//            obj = JSON.parse(json);
		//            $('#no_rm').val(obj.no_rm);
		//        },
		//        error: function(data){
		// 		  // alert('aaaaaaaaaaaa');
		// 		}
		//        });
		// }

		// $('#btn-tambah').on('click',function(){
		// 	getRM();
		// });

		$('#no_rm_lama').on('change', function() {
			var no_rm = $('#no_rm_lama').val();
			$.ajax({
				type: "GET",
				url: base_url + nm_tabel + '/getPasien',
				processData: false,
				contentType: false,
				data: "no_rm=" + no_rm,
				success: function(data) {
					var json = data,
						obj = JSON.parse(json);
					$('#nama_pasien_lama').val(obj.nama_pasien);
					$('#jenis_kelamin_lama').val(obj.jenis_kelamin);
					$('#tgl_lahir_lama').val(obj.tanggal_lahir);
					$('#alamat_lama').val(obj.alamat);
					$('#rt_lama').val(obj.rt);
					$('#rw_lama').val(obj.rw);
					$('#kelurahan_lama').val(obj.kelurahan);
					$('#kecamatan_lama').val(obj.kecamatan);
					$('#kota_lama').val(obj.kota);
					$('#pekerjaan_lama').val(obj.pekerjaan);
					$('#agama_lama').val(obj.agama);
					$('#pendidikan_lama').val(obj.pendidikan);
					$('#status_nikah_lama').val(obj.status_nikah);
					$('#nik_lama').val(obj.nik);
					$('#wilayah_lama').val(obj.wilayah);
					$('#kepala_keluarga_lama').val(obj.kepala_keluarga);
					$('#status_kk_lama').val(obj.status_kk);
					$('#no_bpjs_lama').val(obj.no_bpjs);
				},
				error: function(data) {
					// alert('aaaaaaaaaaaa');
				}
			});
		});

		$('#formSimpan').submit('click', function() {
			$.ajax({
				type: "POST",
				url: base_url + nm_tabel + '/save',
				data: new FormData(this), //this is formData
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					$('#modal-tambah').modal('hide');
					$('.form-control').val('');
					table.ajax.reload();
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil disimpan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-has-icon jq-toast-success',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
					// getRM();
				},
				error: function(data) {
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<p>Data gagal disimpan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-toast-danger',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				}
			});
			return false;
		});

		$('#formSimpanLama').submit('click', function() {
			$.ajax({
				type: "POST",
				url: base_url + nm_tabel + '/save_lama',
				data: new FormData(this), //this is formData
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					$('#modal-tambah-lama').modal('hide');
					$('.form-control').val('');
					table.ajax.reload();
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil disimpan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-has-icon jq-toast-success',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
					// getRM();
				},
				error: function(data) {
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<p>Data gagal disimpan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-toast-danger',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				}
			});
			return false;
		});

		$('#filter_tanggal').on('change', function() {
			var filter_tanggal = $('#filter_tanggal').val();
			$.ajax({
				type: "GET",
				url: base_url + nm_tabel + '/filter_tanggal',
				processData: false,
				contentType: false,
				data: "filter_tanggal=" + filter_tanggal,
				success: function(data) {
					table.ajax.reload();
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<i class="jq-toast-icon ti-face-smile"></i><p>Menampilkan data.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-has-icon jq-toast-success',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				},
				error: function(data) {
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<p>Data gagal ditampilkan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-toast-danger',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				}
			});
			return false;
		});

		$('#formEdit').submit('click', function() {
			$.ajax({
				type: "POST",
				url: base_url + nm_tabel + '/edit',
				data: new FormData(this), //this is formData
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					$('#modal-edit').modal('hide');
					$('.form-control').val('');
					table.ajax.reload();
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil disimpan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-has-icon jq-toast-success',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				},
				error: function(data) {
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<p>Data gagal disimpan.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-toast-danger',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				}
			});
			return false;
		});

		$('#formHapus').submit('click', function() {
			$.ajax({
				type: "POST",
				url: base_url + nm_tabel + '/hapus',
				data: new FormData(this), //this is formData
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					$('#modal-hapus').modal('hide');
					table.ajax.reload();
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil dihapus.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-has-icon jq-toast-success',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				},
				error: function(data) {
					$.toast().reset('all');
					$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
					$.toast({
						text: '<p>Data gagal dihapus.</p>',
						position: 'top-center',
						loaderBg: '#7a5449',
						class: 'jq-toast-danger',
						hideAfter: 3500,
						stack: 6,
						showHideTransition: 'fade'
					});
				}
			});
			return false;
		});

		$('#datatable').on('click', '.editData', function() {
			$('#edit_id').val($(this).data('id'));
			$('#e_no_rm').val($(this).data('no_rm'));
			$('#e_nama_pasien').val($(this).data('nama_pasien'));
			$('#e_jenis_kelamin').val($(this).data('jenis_kelamin'));
			$('#e_tgl_lahir').val($(this).data('tanggal_lahir'));
			$('#e_alamat').val($(this).data('alamat'));
			$('#e_rt').val($(this).data('rt'));
			$('#e_rw').val($(this).data('rw'));
			$('#e_kelurahan').val($(this).data('kelurahan'));
			$('#e_kecamatan').val($(this).data('kecamatan'));
			$('#e_kota').val($(this).data('kota'));
			$('#e_pekerjaan').val($(this).data('pekerjaan'));
			$('#e_agama').val($(this).data('agama'));
			$('#e_pendidikan').val($(this).data('pendidikan'));
			$('#e_status_nikah').val($(this).data('status_nikah'));
			$('#e_nik').val($(this).data('nik'));
			$('#e_wilayah').val($(this).data('wilayah'));
			$('#e_kepala_keluarga').val($(this).data('kepala_keluarga'));
			$('#e_status_kk').val($(this).data('status_kk'));
			$('#e_no_bpjs').val($(this).data('no_bpjs'));
			$('#e_pembayaran').val($(this).data('pembayaran')).trigger('change');
			$('#e_jenis_pelayanan').val($(this).data('jenis_pelayanan')).trigger('change');
			$('#e_tujuan_poli').val($(this).data('tujuan_poli')).trigger('change');
			$('#modal-edit').modal('show');
		});

		$('#datatable').on('click', '.detailData', function() {
			$('#edit_id').val($(this).data('id'));
			$('#d_no_rm').val($(this).data('no_rm'));
			$('#d_nama_pasien').val($(this).data('nama_pasien'));
			$('#d_jenis_kelamin').val($(this).data('jenis_kelamin'));
			$('#d_tgl_lahir').val($(this).data('tanggal_lahir'));
			$('#d_alamat').val($(this).data('alamat'));
			$('#d_rt').val($(this).data('rt'));
			$('#d_rw').val($(this).data('rw'));
			$('#d_kelurahan').val($(this).data('kelurahan'));
			$('#d_kecamatan').val($(this).data('kecamatan'));
			$('#d_kota').val($(this).data('kota'));
			$('#d_pekerjaan').val($(this).data('pekerjaan'));
			$('#d_agama').val($(this).data('agama'));
			$('#d_pendidikan').val($(this).data('pendidikan'));
			$('#d_status_nikah').val($(this).data('status_nikah'));
			$('#d_nik').val($(this).data('nik'));
			$('#d_wilayah').val($(this).data('wilayah'));
			$('#d_kepala_keluarga').val($(this).data('kepala_keluarga'));
			$('#d_status_kk').val($(this).data('status_kk'));
			$('#d_no_bpjs').val($(this).data('no_bpjs'));
			$('#d_pembayaran').val($(this).data('pembayaran'));
			$('#d_jenis_pelayanan').val($(this).data('jenis_pelayanan'));
			$('#d_tujuan_poli').val($(this).data('tujuan_poli'));
			$('#modal-detail').modal('show');
		});

		$('#datatable').on('click', '.hapusData', function() {
			$('#hapus_id').val($(this).data('id'));
			$('#modal-hapus').modal('show');
		});

	}); // End Document Ready Function
</script>