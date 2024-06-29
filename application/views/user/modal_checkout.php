<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="checkoutForm" action="<?php echo site_url('pesanan/checkout'); ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
            <div class="invalid-feedback">Nama pemesan hanya boleh berisi huruf.</div>
          </div>
          <div class="form-group">
            <label for="alamat_pemesan">Alamat Pemesan</label>
            <textarea class="form-control" id="alamat_pemesan" name="alamat_pemesan" required></textarea>
          </div>
          <div class="form-group">
            <label for="nohp_pemesan">Nomor Pemesan</label>
            <input type="number" class="form-control" id="nohp_pemesan" name="nohp_pemesan" required>
            <div class="invalid-feedback">Nomor HP harus terdiri dari angka saja dan maksimal 12 digit.</div>
          </div>
          <div class="form-group">
            <label for="bukti_pembayaran">Bukti Pembayaran</label>
            <input type="file" class="form-control" id="bukti_pembayaran" name="gambar" required>
          </div>
          <input type="hidden" id="total_pembayaran" name="total_pembayaran" value="<?php echo $this->cart->total(); ?>">          
          <input type="hidden" id="tgl_pesanan" name="tgl_pesanan" value="<?php echo date('Y-m-d'); ?>">
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
