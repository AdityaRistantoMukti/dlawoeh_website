
<!-- Modal -->
<div class="modal fade" id="modalDetail<?php echo $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-secondary" id="exampleModalLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <center><h3 class="text-secondary">Detail</h3></center>
            <table style="width:100%">
                
                <tr>
                    <th>Nama Pemesan</th>
                    <td><?php echo $tr->nama_pemesan ?></td>
                </tr>  
                <tr>
                    <th>Alamat</th>
                    <td><?php echo $tr->alamat_pemesan ?></td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td><?php echo $tr->nohp_pemesan ?></td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td><?php echo 'Rp '.number_format($tr->total_pembayaran, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td><?php echo strftime('%d %B %Y', strtotime($tr->tgl_pesanan)) ?></td>
                </tr>     
                <tr>
                    <th>Pesanan</th>
                     <td>
                        <?php foreach ($cart_items[$tr->transaksi_id] as $item) : ?>
                            <?php echo $item['nama_menu'] ?> - <?= $item['jumlah'] ?> Pcs<br>
                         <?php endforeach; ?>
                       </td>                 
                </tr>                                                 
            </table>
                   <center><h3 class="text-secondary mt-2">Bukti Pembayaran</h3></center>
                   <hr>
                    <center><img src="<?php echo base_url().'assets/gambar/bukti_pembayaran/'.$tr->bukti_pembayaran ?>" width="250" height="250"></center>
        </div>
    </div>
  </div>
</div>


