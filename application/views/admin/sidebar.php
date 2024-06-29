 <!-- Page Wrapper -->
 <div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mr-5" href="<?php echo base_url('') ?>">        
            <img src=<?php echo base_url("assets/logo/Logo_polos.png") ?> width="100" >        
        <div class="sidebar-brand-text mt-2">DLAWOEH</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url().'admin' ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fa-solid fa-drumstick-bite"></i>
            <span>Data Menu</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Menu</h6>
               
                <a class="collapse-item " href="<?php echo site_url('Admin/vDaftarMenu') ?>"
                > Daftar Menu
                </a>                  
                                
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Data Transaksi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Transaksi</h6>
                <a class="collapse-item" href="<?php echo base_url().'admin/vLihatTransaksi' ?>">
                Lihat Transaksi
                </a>                               
            </div>
        </div>
    </li>
     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan</h6>
                <a class="collapse-item" href="<?php echo base_url().'laporan/laporan_transaksi' ?>">
                Laporan Transaksi
                </a> 
                <a class="collapse-item" href="<?php echo base_url().'laporan/laporan_menu' ?>">
                Laporan Menu
                </a>                                  
            </div>
            
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
     <!-- Admin Logout-->
     <li class="nav-item">
        <a class="nav-link collapsed">
            <div class="admin-logout-text-mobile"> 
                <span><?php echo "Halo, <b>".$this->session->userdata('nama'); ?></b> </span>
                <a href="<?php echo base_url() . 'auth/logout'; ?>" class="btn btn-warning btn-sm my-2 my-sm-0 ml-3" >Logout</a>
            </div>
        </a>
        
    </li>
</ul>
<!-- End of Sidebar -->
