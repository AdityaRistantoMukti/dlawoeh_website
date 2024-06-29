    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="mx-3 mt-4 font-weight-bold text-warning mb-3 text-center" style="font-size:23px;">Daftar Menu</h3>
    <!-- Alert Tambah Data -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success mt-3" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <!-- Error -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex align-items-center">
                <div class="float-right">
                    <a href="<?php echo site_url('admin/vTambahMenu') ?>" class="btn btn-primary float-right">
                        <i class="fas fa-plus"> Tambah Data</i>
                    </a>
                </div>
                                                            
            </div>        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>                        
                            <th>Nama</th>                        
                            <th>Harga</th>                        
                            <th >Deskripsi</th>                        
                            <th>Jumlah</th>                                                                      
                            <th>Gambar</th>                                                                      
                            <th class="">Action</th>                        
                        </tr>
                    </thead>            
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $mn) { ?>
                        <tr>
                            <td><?php echo $i++ ?></td> 
                            <td><?php echo $mn->kategori ?></td>
                            <td><?php echo $mn->nama_menu ?></td>
                            <td><?php echo $mn->harga_menu ?></td>
                            <td ><?php echo $mn->deskripsi_menu ?></td>
                            <td><?php echo $mn->menu_qty ?></td>
                            <td>
                                <img src="<?php echo base_url("assets/gambar/menu/").$mn->gambar_menu ?>" width="100" height="100">
                            </td> 
                            <td>
                                <a href="<?php echo site_url('admin/vEditMenu/'.$mn->menu_id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>                                        
                                <a href="#" onclick="confirm(<?php echo $mn->menu_id ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash mx-1"></i></a>
                            </td>
                        </tr>
                    <?php } ?>                                                                                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <script>
        function confirm(id) {
            swal({
                title: "Apakah Kamu Yakin Ingin Menghapusnya?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Data Berhasil dihapus", {
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        location.href = "<?php echo site_url('datamenu/hapus_data/')?>" + id;                    
                    });
                }
            });
        }
    </script>
