<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h3 class="mx-3 mt-4 font-weight-bold text-warning mb-3 text-center" style="font-size:23px;">Riwayat Transaksi Pemesanan</h3>
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
        <a href="#" onclick="confirm_all()"class="btn btn-danger float-right">
            <i class="fas fa-trash"></i> <span class="text-white">Bersihkan Transaksi</span>
        </a>                                                              
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>                        
                        <th style="width:200px">Alamat</th>                        
                        <th>No</th>                        
                        <th>Total Pembayaran</th>                                                                                                                 
                        <th>Tanggal</th>                                                                                                                 
                        <th>Bukti Pembayaran</th>                                                                      
                        <th class="">Action</th>                        
                    </tr>
                </thead>            
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($transaksi as $tr) { 
                setlocale(LC_TIME, 'id_ID');
                ?>
                    
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $tr->nama_pemesan ?></td>
                        <td style=" max-height: 100px; max-width:200px; overflow: auto;"><?php echo $tr->alamat_pemesan ?></td>
                        <td><?php echo $tr->nohp_pemesan ?></td>
                        <td><?php echo "RP ". number_format($tr->total_pembayaran) ?></td>
                        <td><?php echo strftime('%d %B %Y', strtotime($tr->tgl_pesanan)) ?></td>
                        <td>
                            <img src="<?php echo base_url().'assets/gambar/bukti_pembayaran/'.$tr->bukti_pembayaran ?>" width="100" height="100">
                        </td>                        
                        <td>
                            <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal"  data-target="#modalDetail<?php echo $i ?>" ><i class="fas fa-eye "></i></a>                                        
                            <?php include 'modal-detail.php' ?>
                            <a href="#" onclick="confirm_id(<?php echo $tr->transaksi_id ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash mx-1"></i></a>
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
    function confirm_id(id) {
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
                    location.href = "<?php echo site_url('transaksi/hapus_data/')?>" + id;                    
                });
            }
        });
    }


    function confirm_all() {
        swal({
            title: "Apakah Anda ingin membersihkan semua data transaksi?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("  ", {
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.href = "<?php echo site_url('transaksi/hapus_all_data')?>";                    
                });
            }
        });
    }
</script>
