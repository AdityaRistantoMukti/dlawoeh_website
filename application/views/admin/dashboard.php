    <!-- Page Heading -->
    <!-- Begin Page Content -->
<div class="container-fluid">        
       
        <?php
        if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasil") {
                echo "<div class='alert alert-success'>Selamat Anda berhasil Login.</div>";
            } 
        }
        ?>
        
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
      
        <!-- Content Row -->
        <div class="row">

            <!-- Jumlah Infaq -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1 ml-2">
                                    Jumlah Pemasukan (Hari ini )</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ml-2">
                                Rp <?php echo number_format($penghasilan_perhari, 0, ',', '.') ?>
                                </div>                          
                            </div>
                            <div class="col-auto">                               
                                <i class="fas fa-dollar-sign fa-2x text-gray-300 mr-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
            <!-- Jumlah Orang yang zakat -->
          <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 ml-2">Jumlah Transaksi
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                   
                                        <div class="h5 mb-0 mr-3 ml-4 font-weight-bold text-gray-800 ">
                                         <?php echo $jumlah_transaksi ?>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300 mr-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Infaq -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1 ml-2">
                                    Jumlah Pemasukan (per bulan)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ml-2">
                                Rp <?php echo number_format($penghasilan_perbulan, 0, ',', '.') ?>
                                </div>  
                            </div>
                            <div class="col-auto">                               
                                <i class="fas fa-dollar-sign fa-2x text-gray-300 mr-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
          
           <!-- Jumlah Infaq -->
           <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1 ml-2">
                                    Jumlah Pemasukan (per tahun)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ml-2">
                                Rp <?php echo number_format($penghasilan_pertahun, 0, ',', '.') ?>
                                </div>  
                            </div>
                            <div class="col-auto">                               
                                <i class="fas fa-dollar-sign fa-2x text-gray-300 mr-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          

          <!-- Jumlah Infaq -->
          <div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1 ml-2 text-center">
                                    Jumlah Pemasukan Keseluruhan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 ml-2 text-center">
                                Rp <?php echo number_format($penghasilan_keseluruhan, 0, ',', '.') ?>
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>       
          

</div>
        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->      