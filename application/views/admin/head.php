<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dlawoeh Website  </title>
    
    <!-- Logo -->
    <link rel="icon" href="<?php echo base_url("assets/logo/Logo.png") ?>">
    <!-- Custom fonts for this template-->
    <link href=<?php echo base_url("assets/vendor/fontawesome-free/css/all.min.css") ?> rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href=<?php echo base_url("/assets/css/sb-admin-2.min.css") ?> rel="stylesheet">
    <link href="<?php echo base_url('external_css_js/css/styles.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/style.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url('external_css_js/js/scripts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    


    <!-- CSS Custom -->
    <style>
        /* CSS to hide text on larger screens and show on smaller screens */
        @media (min-width: 768px) {
            .admin-logout-text-mobile {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .admin-logout-text-mobile {
                display: inline;
            }
            .admin-logout-text-laptop {
                display: none;
            }
        }

         /* CSS untuk memposisikan form pencarian di kanan atas */
         .dataTables_filter {
            float: right;            
            margin-top:40px;
        }
        .dataTables_filter label {
             display: flex;
             align-items: center;
        }

        .dataTables_filter label input {
          margin-left: 0.5em;
        }
    </style>
      
</head>
<div class="admin-logout-text-laptop">
<nav class="navbar text-light bg-gradient-danger">
            <div class="container">
                
                <form class="form-inline ml-auto">
                    
                <?php echo "Halo, <b>".$this->session->userdata('nama'); ?></b> <span class="caret"></span>          
                <a href="<?php echo base_url() . 'auth/logout_admin'; ?>" class="btn btn-warning btn-sm my-2 my-sm-0 ml-3" >Logout</a>
                </form>
            </div>
        </nav>   

</div>


