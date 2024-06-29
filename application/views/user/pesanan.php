<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link rel="icon" href="<?php echo base_url("assets/logo/Logo.png") ?>">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/landing_page/style.css' ?>">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>">

    <!-- JS -->
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'; ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Mengatur fungsi untuk menambah Qty
            $(".btn-plus").click(function() {
                var rowid = $(this).data('rowid');
                var qty = parseInt($("#qty_"+rowid).val());
                $("#qty_"+rowid).val(qty + 1);
                updateCart(rowid, qty + 1);
            });

            // Mengatur fungsi untuk mengurangi Qty
            $(".btn-minus").click(function() {
                var rowid = $(this).data('rowid');
                var qty = parseInt($("#qty_"+rowid).val());
                if (qty > 1) {
                    $("#qty_"+rowid).val(qty - 1);
                    updateCart(rowid, qty - 1);
                }
            });

            // Fungsi agar user tidak meng inputkan lebih dari stok yg ada
            $(".btn-plus, .btn-minus, .input-number").on('click input', function() {
                var rowid = $(this).data('rowid');
                var inputQty = $("#qty_" + rowid);
                var qty = parseInt(inputQty.val());

                if (qty < 1) {
                    inputQty.val(1);
                    return;
                }

                $.ajax({
                    url: '<?php echo site_url("pesanan/check_stock"); ?>',
                    method: 'post',
                    data: { rowid: rowid, qty: qty },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (qty > data.stock) {
                            alert('Jumlah pesanan melebihi stok yang tersedia.');
                            inputQty.val(1);
                            qty = 1;
                        }
                        updateCart(rowid, qty);
                    }
                });
            });

            function updateCart(rowid, qty) {
                $.ajax({
                    url: '<?php echo site_url("pesanan/update_cart"); ?>',
                    method: 'post',
                    data: { rowid: rowid, qty: qty },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#subtotal_" + rowid).text("Rp." + number_format(data.subtotal, 0, ',', '.'));
                        $("#total").text("Rp." + number_format(data.total, 0, ',', '.'));
                    }
                });
            }

            // Mengatur event listener pada input quantity
            $(".input-number").on('input', function() {
                var value = $(this).val();
                var rowid = $(this).data('rowid');
                if (!/^\d*$/.test(value)) {
                    $(this).val(value.replace(/[^\d]/g, ''));
                }
                if (value > 0) {
                    updateCart(rowid, value);
                }
            });
        });

        // Fungsi untuk format angka dengan titik sebagai pemisah ribuan
        function number_format(number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep,
                dec = (typeof decPoint === 'undefined') ? '.' : decPoint,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k).toFixed(prec);
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>
</head>
<body class="bg-white">
<div class="container">
    <h1 class="text-secondary text-center mt-5">Pesanan Anda</h1>
    <hr class="bg-white">
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 offset-md-0">
            <?php if($cart = $this->cart->contents()): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($cart as $item): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo "Rp.".number_format($item['price']); ?></td>
                                <td>
                                    <div class="input-group" style="width:150px">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-danger p-2 btn-minus mr-1" data-rowid="<?php echo $item['rowid']; ?>">-</button>
                                        </span>
                                        <input type="text" id="qty_<?php echo $item['rowid']; ?>" class="form-control input-number" value="<?php echo $item['qty']; ?>" min="1" data-rowid="<?php echo $item['rowid']; ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary p-2 btn-plus ml-1" data-rowid="<?php echo $item['rowid']; ?>">+</button>
                                        </span>
                                    </div>
                                </td>
                                <td id="subtotal_<?php echo $item['rowid']; ?>"><?php echo "Rp.".number_format($item['subtotal']); ?></td>
                                <input type="hidden" name="total_pembayaran" id="subtotal_<?php echo $item['rowid']; ?>" value="<?php echo "Rp.".number_format($item['subtotal']); ?>">
                                <td>
                                    <a href="<?php echo site_url('pesanan/hapus/'.$item['rowid']); ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4 class="text-dark text-right">Total: <span id="total"><?php echo "Rp.".number_format($this->cart->total()); ?></span></h4>
                <a href="<?php echo base_url(); ?>" class="btn btn-secondary btn-md mt-2">Kembali</a>
                
                <button type="button" class="btn btn-success btn-sm float-right mt-2" data-toggle="modal" data-target="#checkoutModal">Checkout</button>
                
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    Keranjang Anda kosong. <a href="<?php echo base_url(); ?>" class="btn btn-primary btn-sm">Kembali ke Menu</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- Modal -->
<?php include 'modal_checkout.php' ?> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Validasi Nama Pemesan
        var inputNamaPemesan = document.getElementById('nama_pemesan');
        inputNamaPemesan.addEventListener('input', function () {
            var regex = /^[A-Za-z\s]+$/;
            if (!regex.test(this.value)) {
                this.setCustomValidity('Nama pemesan hanya boleh berisi huruf.');
            } else {
                this.setCustomValidity('');
            }
        });

        // Validasi Nomor HP Pemesan
        var inputNoHP = document.getElementById('nohp_pemesan');
        inputNoHP.addEventListener('keypress', function (event) {
            if (event.which < 48 || event.which > 57) {
                event.preventDefault();
            }
        });
        inputNoHP.addEventListener('input', function () {
            var maxLength = 12;
            if (this.value.length > maxLength) {
                this.value = this.value.slice(0, maxLength);
            }
            if (this.value.length > maxLength || isNaN(this.value)) {
                this.setCustomValidity('Nomor HP harus terdiri dari angka saja dan maksimal 12 digit.');
            } else {
                this.setCustomValidity('');
            }
        });

        // Validasi Form Sebelum Dikirim
        var form = document.getElementById('checkoutForm');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
</script>
</body>
</html>





