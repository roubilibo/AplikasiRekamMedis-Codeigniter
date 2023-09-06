<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('partial/head') ?>
  <body>
    
    
    <!-- HK Wrapper -->
    <div class="hk-wrapper">
      
      <!-- Main Content -->
      <div class="hk-pg-wrapper hk-auth-wrapper" style="background-image: url('assets/dist/img/bg-1.jpg');background-size: cover;">

        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 pa-0">
              <div class="auth-form-wrap pt-xl-0 pt-70">
                <div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                  <center>
                    <img class="p-3" src="<?= $logo_daerah ?>" alt="user" style="width: 100px; height: 100px">
                    <img class="p-3" src="<?= $logo_instansi ?>" alt="user" style="width: 100px; height: 100px;">
                  </center>
                  <a class="auth-brand text-center d-block mb-20" href="#">
                    <?= $instansi ?>
                  </a>
                  <?= $this->session->flashdata('error') ?>
                  
                  <form method="POST" action="<?= base_url('auth/login') ?>">
                    <h1 class="display-4 text-center mb-10">Selamat Datang :)</h1>
                    <p class="text-center mb-30">Silahkan login dengan akun anda.</p> 
                    <div class="form-group">
                      <input class="form-control" name="username" placeholder="Username" type="text">
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input class="form-control" name="password" placeholder="Password" type="password">
                        <div class="input-group-append">
                          <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                        </div>
                      </div>
                    </div>

                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                  
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Main Content -->
    
    </div>
    <!-- /HK Wrapper -->
    
<?php $this->load->view('partial/js') ?>   
  </body>
</html>