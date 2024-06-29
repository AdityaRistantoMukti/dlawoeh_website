<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Logo -->
    <link rel="icon" href="<?php echo base_url("assets/logo/Logo.png") ?>">
    <!-- CSS External -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- CSS Internal -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            height: 100%;
            background: linear-gradient(to top, #ed1d0e 50%, #ed980e 70%) no-repeat;
        }
        .container {
            margin-top: 250px;
            margin-bottom: 99px;
            margin-right: auto;
            margin-left: auto;
            padding-right: 150px;
            position: relative;
            
        }
        .panel-heading {
            text-align: center;
            margin-bottom: 10px;
        }
        #forgot {
            min-width: 100px;
            margin-left: auto;
            text-decoration: none;
        }
        a:hover {
            text-decoration: none;
        }
        .form-inline label {
            padding-left: 10px;
            margin: 0;
            cursor: pointer;
        }
        .btn.btn-block {
            margin-top: 20px;
            border-radius: 15px;
            background: #ed980e;
        }
        .btn.btn-block:hover {
            background: #c48402;
        }
        .panel {
            min-height: 380px;
            width: 500px;
            padding: 20px;
            box-shadow: 10px 10px 60px #302f2d;
            border-radius: 12px;
            position: relative;
            z-index: 1;
        }
        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #ddd;
            color: #4343ff;
        }
        input[type='text'], input[type='password'] {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%;
        }
        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none;
        }
        img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            position: relative;
        }
        a[target='_blank'] {
            position: relative;
            transition: all 0.1s ease-in-out;
        }
        .bordert {
            border-top: 1px solid #aaa;
            position: relative;
        }
        .bordert:after {
            content: "or connect with";
            position: absolute;
            top: -13px;
            left: 33%;
            background-color: #fff;
            padding: 0px 8px;
        }
        @media (max-width: 500px) {
            #forgot {
                margin-left: 0;
                padding-top: 10px;
            }
            body {
                height: 100%;
                background: white;
            }
            .container {
                margin-top: 300px;
                margin-bottom: 199px;
                margin-right: auto;
                margin-left: auto;
            }
            .bordert:after {
                left: 25%;
            }
        }
        /* Centering the logo and placing it above the login panel */
        .logo {
            position: absolute;
            top: -1px; /* Adjust this value to control the vertical positioning */
            left: 52%;
            transform: translateX(-50%);
            
            
        }
        .logo img {
            width: 230px; /* Adjust size as needed */
            height: 230px; /* Adjust size as needed */
        }
    </style>
    <!-- JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="logo">
        <img src="<?php echo base_url().'assets/logo/Logo.png' ?>" alt="logo_geprek">
    </div>
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
                <div class="panel border" style="background: #302f2d;">
                    <div class="panel-heading">
                        <h3 class="pt-3 font-weight-bold" style="color:#ed1d0e">Login</h3>
                         <!-- Alert Gagal Login -->                                               
                         <?php
                            if (isset($_GET['pesan'])) {
                                if ($_GET['pesan'] == "gagal_login") {
                                    echo "<div class='alert alert-danger'>Login gagal! Username dan password salah.</div>";
                                } else if ($_GET['pesan'] == "logout") {
                                    echo "<div class='alert alert-info'>Anda telah logout.</div>";
                                }
                            }
                            ?>
                    </div>
                    <div class="panel-body p-3">
                        <form action="<?php echo site_url('auth/login_aksi') ?>" method="post">
                            <div class="form-group py-2">
                                <div class="input-field" style="color:#ed1d0e">
                                    <span class="far fa-user p-2"></span>
                                    <input class="form-control" style="background:none; color:white;" type="text" name="username" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group py-1 pb-2">
                                <div class="input-field" style="color:#ed1d0e">
                                    <span class="fas fa-lock px-2"></span>
                                    <input class="form-control mr-2" style="background:none; color:white;" type="password" name="password" placeholder="Password" required>
                                    <button class="btn text-muted">
                                        <span class="far fa-eye-slash"></span>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-block mt-3" >Login</button>
                            </div>
                            <div class="text-center pt-4 text-muted">Belum punya akun? <a href="<?php echo base_url().'auth/register_user' ?>" style="color:#ed1d0e">Register</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
