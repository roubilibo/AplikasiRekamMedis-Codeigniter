<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('partial/head') ?>

<body>
    <!-- Preloader  -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
  
  <!-- HK Wrapper -->
  <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <?php $this->load->view('partial/nav') ?>

        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <?php $this->load->view('partial/sidebar') ?>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
      <!-- Container -->
          <div class="container mt-xl-50 mt-sm-30 mt-15">
              <!-- Title -->
              <div class="hk-pg-header align-items-top">
                <div>
                  <h2 class="hk-pg-title font-weight-600 mb-10"><?= $halaman ?></h2>
                </div>
              </div>
              <!-- /Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Tabel <?= $halaman ?></h5>
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group form-group-default">
                                  <label>Tanggal Kunjungan</label>
                                  <input type="date" name="filter_tanggal" id="filter_tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required="">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-sm" style="overflow-x: auto;">
                                    <div class="table-wrap" >
                                        <table id="datatable" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No RM</th>
                                                    <th>Nama Pasien</th>
                                                    <th>JK</th>
                                                    <th>Kepal Keluarga</th>
                                                    <th>Tujuan Poli</th>
                                                    <th>Tgl Lahir</th>
                                                    <th>Alamat</th>
                                                    <th>Keterangan DRM</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
      
            <!-- Footer -->
            <?php $this->load->view('partial/footer') ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

<?php $this->load->view('partial/js') ?>
<?php $this->load->view('page/v_layanan/script') ?>
</body>

</html>