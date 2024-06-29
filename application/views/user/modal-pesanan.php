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
            <textarea class="form-control" id="alamat_pemesan" name="alamat_pemesan" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="bukti_transfer">Bukti Transfer</label>
            <input type="file" class="form-control-file" id="bukti_transfer" name="bukti_transfer" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
        </form>
      </div>
    </div>
  </div>
</div>