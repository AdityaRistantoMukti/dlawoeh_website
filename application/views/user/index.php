<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dlawoeh</title>
    <link rel="icon" href="<?php echo base_url("assets/logo/Logo.png") ?>">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/landing_page/style.css' ?>">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/lightbox2.css' ?>">
    
    
    <style>

        .footer-child {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .footer-child iframe {
            flex: 1;
            min-width: 60%;
            height: 60vh;
            border: 1px solid black;
        }

        .contact-section {
            display: flex;
            flex: 1;
            min-width: 35%;
            padding: 20px 50px;
            margin-top: 5px;
            
            justify-content: space-around;
            align-items: center;            
        }

        .contact-info {
            display: flex;
            align-items: center;
            margin-top: 0; 
            margin-bottom: 0; 
            margin-right: 100px; 
            margin-left: 100px;
        }

        .contact-info img {
            margin-right: 10px;
        }
        /* Logo */
        .logo {
            position: absolute;
            top: 0;
            left: 49%;
            transform: translateX(-49%);
            margin-top:-20px;            
            z-index: 1000;            
            padding: 10px;
           
        }

        .logo img {
            width: 200px;
            height: 200px;
            
        }
        @media (max-width: 768px) {
            .footer-child {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-child iframe {
                width: 100% !important;
                height: 50vh !important;
            }

            .contact-section {
                width: 100%;
                flex-direction: column;
                text-align: center;
            }

            .contact-info {
                margin: 10px 0;
            }

            
        }
    </style>
    <!-- JS -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo base_url('external_css_js/js/scripts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/lightbox.min.js'; ?>"></script>
    
    <!-- Logo -->
    <link rel="icon" href="<?php echo base_url("assets/logo/Logo.png") ?>">
    <!-- JS -->
    <script src="<?php echo base_url().'assets/js/script.js' ?>"></script>
</head>
<body class="bg-dark">
<div class="top-content">
    <nav class="navbar navbar-expand-lg fixed-top" style="background:#ac0a08; z-index:1000">
    <div class="container-fluid" style="padding-left: 170px;">
        <a class="navbar-brand" href="#">
            <b><span class="text-warning">D'</span><span class="text-white">LAWOEH</span></b>
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-5">
            <li class="nav-item">
                <a class="nav-link active text-light mt-3" aria-current="page" href="#home" data-role="smoothscroll">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light mt-3" href="#menu" data-role="smoothscroll">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light mt-3 " href="#info" data-role="smoothscroll">Info</a>
            </li>
                   
            <?php 
                if($this->session->userdata('status') != "login_user") { ?>
                 <li class="nav-item">
                    <a class="nav-link text-dark btn btn-sm btn-warning mt-3" style="width:100px; border-radius:20px; margin-top:3px" href="<?php echo base_url().'auth/login_user/' ?>">Login</a>
                   
                </li> 
                <?php } ?>
            <?php 
                if ($this->session->userdata('status') == "login_user") { ?>  
                <li class="nav-item" style="border-left: 1px solid white">                                                                                                    
                    <div class="btn-group dropleft" style="margin-right:-40px; margin-left:40px;">
                    <svg xmlns="http://www.w3.org/2000/svg"  height="70" viewBox="0 0 24 24" width="70" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>                    
                    
                    </button>
                        <div class="dropdown-menu"style="margin-top: 80px; left:-150px;padding: 17px; width:250px; background-color:#f3f3f3 ">                                
                                <h3 class="text-center text-secondary mb-4"><?php echo "Halo, <b>".$this->session->userdata('nama'); ?></h3> 
                                <hr>
                                <p class="text-center text-secondary">Pesanan:<span> <?php echo $this->cart->total_items(); ?></span></p>
                                <a href="<?php echo site_url('pesanan') ?>" class="btn btn-outline-secondary btn-block">Cek Pesanan</a>
                                <a href="<?php echo site_url('auth/logout_user') ?>" class="btn btn-outline-secondary btn-block">Logout</a>
                        </div>
                    </div>                             
                </li>                  
                <?php }  ?>                  
           
        </ul>
    </div>
    </nav>
    <div class="logo" id="home">
        <img src="<?php echo base_url('assets/logo/Logo_polos.png')?>" alt="logo_geprek"  >
    </div>
</div>
<div class="title" style="margin-top:160px">
    <h1 class="text-warning">Selamat Datang di Gerai Ayam Geprek</h1>
    <hr>
</div>
<div class="content" >
    <img class="mySlides" src="<?php echo base_url("assets/gambar/banner2.jpeg")?>" style="display:none">
    <img class="mySlides" src="<?php echo base_url().'assets/gambar/banner1.jpeg'?>" >
    <img class="mySlides" src="<?php echo base_url().'assets/gambar/banner3.jpeg'?>" style="display:none">
    <div class="slideChilds">
          <div class="childSlides">
            <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo base_url().'assets/gambar/banner2.jpeg'?>" onclick="currentDiv(0)">
          </div>
          <div class="childSlides">
            <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo base_url().'assets/gambar/banner1.jpeg'?>" onclick="currentDiv(1)">
          </div>
          <div class="childSlides">
            <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo base_url().'assets/gambar/banner3.jpeg'?>" onclick="currentDiv(2)">
          </div>
        </div>
        <button class="nextBtn" onclick="nextDiv()">&#10095;</button>
        <button class="prevBtn" onclick="prevDiv()">&#10094;</button>
    </div>

    <div class="container-main" id="menu">
        <center><h1 class="text-warning">List Menu</h1></center><hr class="bg-white" >
        <div class="row">
            <?php foreach ($menu as $mn ) { ?>                                                
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="menu-card">
                <a href="<?php echo base_url().'assets/gambar/menu/'.$mn->gambar_menu?>" data-lightbox="menu">
                    <img src="<?php echo base_url().'assets/gambar/menu/'.$mn->gambar_menu?>">
                </a>
                    <div class="menu-info">
                            <span><?php echo $mn->nama_menu ?> </span><br>
                            <span><?php echo $mn->menu_qty ?> Stok</span><br>
                            <span><?php echo "Rp.".number_format($mn->harga_menu) ?> </span>   
                            <!-- Jika User Login -->
                            <?php  if ($this->session->userdata('status') == "login_user") { ?>   
                            <div class="mt-2">
                                <a href="<?php echo site_url('user/tambah_pesanan/'.$mn->menu_id) ?>" class="btn btn-warning  btn-pesan btn-sm" data-id="<?php echo $mn->menu_id ?>">Pesan Menu</a>
                            </div>                        
                            <?php } ?>
                            <!-- Jika User belum login -->
                            <?php  if ($this->session->userdata('status') != "login_user") { ?>   
                            <div class="mt-2">
                                <a href="<?php echo site_url('auth/login_user') ?>" class="btn btn-warning  btn-pesan btn-sm"  data-id="<?php echo $mn->menu_id ?>">Pesan Menu</a>
                            </div>                        
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
            <?php } ?>                
    </div>
    
   <footer id="info">
       <center><h3 class="text-warning">Lokasi Gerai Kami</h3></center>
       <hr class="bg-white">
        <div class="footer-child">
        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3965.2006958203406!2d106.98619807499156!3d-6.368068093622065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMjInMDUuMSJTIDEwNsKwNTknMTkuNiJF!5e0!3m2!1sen!2sid!4v1719486424065!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
                    
   </footer>
 </div>
 <div class="contact-section" style="background:#ac0a08">
            <a class="contact-info text-light" href="#">
                <img src="<?php echo base_url().'assets/logo/instagram.png'?>" alt="" width="25">
                <span>@GeprexSuperPedas</span>
            </a>
            <div class=""></div>
            <a class="contact-info text-light" href="#">
                <img src="<?php echo base_url().'assets/logo/fb.png'?>" alt="" width="25">
                <span>Ayam Geprex</span>
            </a>
            <a class="contact-info text-light" href="#">
                <img src="<?php echo base_url().'assets/logo/whatsapp.png'?>" alt="" width="25">
                <span>+62 823-2570-3869</span>
            </a>
        </div> 
    
        <!--  -->
    <script src="<?php echo base_url().'assets/js/scroll.js' ?>"></script>
    <script>
        $(document).ready(function(){
            // Inisialisasi lightbox
            $('[data-lightbox="menu"]').lightbox();
        });
    </script>
</body>
</html>
