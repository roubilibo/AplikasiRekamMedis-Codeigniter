<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'homepage') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('homepage') ?>" >
                        <span class="feather-icon"><i data-feather="activity"></i></span>
                        <span class="nav-link-text">Beranda</span>
                    </a>
                </li>
                <?php
                if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='user') {
                ?>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'pendaftaran') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('pendaftaran') ?>" >
                        <span class="feather-icon"><i data-feather="edit"></i></span>
                        <span class="nav-link-text">TPP</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'cek_kelengkapan') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('cek_kelengkapan') ?>">
                        <span class="feather-icon"><i data-feather="clipboard"></i></span>
                        <span class="nav-link-text">Cek Kelengkapan</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'layanan_umum') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('layanan_umum') ?>">
                        <span class="feather-icon"><i data-feather="edit-3"></i></span>
                        <span class="nav-link-text">Layanan Umum</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'pengguna') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('pengguna') ?>">
                        <span class="feather-icon"><i data-feather="user"></i></span>
                        <span class="nav-link-text">Pengguna</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'pasien') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('pasien') ?>">
                        <span class="feather-icon"><i data-feather="users"></i></span>
                        <span class="nav-link-text">Pasien</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'petugas') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('petugas') ?>">
                        <span class="feather-icon"><i data-feather="users"></i></span>
                        <span class="nav-link-text">Petugas Kesehatan</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) == 'pengaturan') { echo "active"; } ?>">
                    <a class="nav-link collapsed <?php if ($this->uri->segment(1) == 'pengaturan') { echo "active"; } ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#content_drp" aria-expanded="false">
                        <span class="feather-icon"><i data-feather="settings"></i></span>
                        <span class="nav-link-text">Pengaturan</span>
                    </a>
                    <ul id="content_drp" class="nav flex-column collapse-level-1 collapse" style="">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan') ?>">Pengaturan Sistem</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_agama') ?>">Pengaturan Agama</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_pekerjaan') ?>">Pengaturan Pekerjaan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_pembayaran') ?>">Pengaturan Pembayaran</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_pendidikan') ?>">Pengaturan Pendidikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_poli') ?>">Pengaturan Poli</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_diagnosa') ?>">Pengaturan Diagnosa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_suku') ?>">Pengaturan Suku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_kecamatan') ?>">Pengaturan Kecamatan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_kelurahan') ?>">Pengaturan Kelurahan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('pengaturan_kota') ?>">Pengaturan Kota</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#laporan" aria-expanded="false">
                        <span class="feather-icon"><i data-feather="box"></i></span>
                        <span class="nav-link-text">Laporan</span>
                    </a>
                    <ul id="laporan" class="nav flex-column collapse-level-1 collapse" style="">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-laporan-pasien-berkunjung">Lp. Pasien Berkunjung</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-laporan-kelengkapan-drm">Lp. Kelengkapan DRM</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-laporan-pelayanan-umum">Lp. Layanan Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-laporan-grafik-kunjungan">Lp. Grafik Kunjungan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-laporan-penyakit">Lp. 10 Besar Penyakit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-laporan-dokter-terbaik">Lp. Dokter Terbaik</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="">BKU Harian</a>
                                </li> -->
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php 
                }
                else if ($this->session->userdata('level')=='dokter') {
                ?>
                <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'layanan_umum') { echo "active"; } ?>">
                    <a class="nav-link" href="<?= base_url('layanan_umum') ?>">
                        <span class="feather-icon"><i data-feather="edit-3"></i></span>
                        <span class="nav-link-text">Layanan Umum</span>
                    </a>
                </li>
                <?php 
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>