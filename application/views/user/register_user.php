<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <!-- Logo -->
     <link rel="icon" href="<?php echo base_url("assets/logo/Logo.png") ?>">

     <!-- CSS -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
        />
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css"
        rel="stylesheet"
        />
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />     
    
</head>
<body>
    <section class="vh-100" style="background-color: #313131;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="<?php echo base_url('assets/gambar/spanduk.jpeg') ?> "
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="<?php echo base_url("auth/register_aksi") ?>" method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Register</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Isi Form Pendaftaran dengan benar</h5>
                     <!-- Alert Gagal Register Data -->                                               
                            <?php 
                                if ($this->session->flashdata('register_gagal')): ?>
                                    <div class="alert alert-danger mt-3" role="alert">
                                            <?php echo $this->session->flashdata('register_gagal'); ?>
                                    </div>
                                <?php endif; ?>
                                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="username" id="form2Example17" class="form-control form-control-lg" name="username"/>
                        <label class="form-label" for="form2Example17">Isi Username</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form2Example27" class="form-control form-control-lg" name="password"/>
                        <label class="form-label" for="form2Example27">Isi Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" type="submit" >Register</button>
                    </div>
                    
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Sudah ada akun?<a href="<?php echo base_url().'auth/login_user' ?>"
                        style="color: #393f81;"> Menuju halaman login</a></p>
                 
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 <!-- MDB -->
 <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"
        ></script>
</body>
</html>