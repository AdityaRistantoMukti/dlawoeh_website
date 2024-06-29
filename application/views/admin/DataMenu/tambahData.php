<div class="container">
    <!-- Alert Tambah Data -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success mt-3" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                    <div class="card-header bg-warning">
                        <h3 class="text-center font-weight-light my-4 text-dark">Tambah Data Menu</h3>
                    </div>
                    <div class="card-body">
                        <form id="menuForm" action="<?php echo site_url('DataMenu/tambah_data') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="nama_menu">Nama Menu</label>
                                <input class="form-control" id="nama_menu" name="nama_menu" type="text" placeholder="Masukkan Nama Menu" required />
                                <div class="invalid-feedback">Nama menu tidak boleh mengandung karakter khusus.</div>
                            </div>
                            <label class="mb-2" for="deskripsi_menu">Deskripsi Menu</label>
                            <div class="form-group" style="border:1px solid grey">
                                <textarea class="form-control" name="deskripsi_menu" cols="20" rows="5" style="border:none;" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" class="form-control" name="kategori">
                                    <option selected>Choose...</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Paket">Paket</option>
                                </select>
                            </div>
                            <div class="form-group mt-3 mb-3">
                                <label for="harga_menu">Harga Menu</label>
                                <input class="form-control" id="harga_menu" name="harga_menu" type="text" required />
                                <div class="invalid-feedback">Harga harus lebih dari 0.</div>
                            </div>
                            <div class="form-group mt-3 mb-3">
                                <label for="menu_qty">Jumlah Menu</label>
                                <input class="form-control" id="menu_qty" name="menu_qty" type="number" min="1" required />
                                <div class="invalid-feedback">Jumlah stok tidak boleh negatif atau huruf.</div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan Gambar Product</label>
                                <input class="form-control" type="file" id="formFile" name="gambar" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a class="btn btn-secondary mx-2" href="<?php echo base_url() . 'admin/vDaftarMenu' ?>">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const namaMenuInput = document.getElementById('nama_menu');
    const hargaMenuInput = document.getElementById('harga_menu');
    const menuQtyInput = document.getElementById('menu_qty');
    const menuForm = document.getElementById('menuForm');

    namaMenuInput.addEventListener('input', function (e) {
        const regex = /[^a-zA-Z0-9\s]/g;
        if (regex.test(e.target.value)) {
            e.target.setCustomValidity('Nama menu tidak boleh mengandung karakter khusus.');
            e.target.classList.add('is-invalid');
        } else {
            e.target.setCustomValidity('');
            e.target.classList.remove('is-invalid');
        }
    });

    hargaMenuInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^\d]/g, '');
        if (value !== '') {
            value = formatRupiah(value);
            e.target.value = value;
        }
        if (parseInt(value, 10) <= 0 || /^[0]/.test(value)) {
            e.target.setCustomValidity('Harga harus lebih dari 0 dan tidak boleh dimulai dengan 0.');
            e.target.classList.add('is-invalid');
        } else {
            e.target.setCustomValidity('');
            e.target.classList.remove('is-invalid');
        }
    });

    menuQtyInput.addEventListener('input', function (e) {
        const sanitizedValue = e.target.value.replace(/[^0-9]/g, '');
        e.target.value = sanitizedValue;

        if (sanitizedValue <= 0) {
            e.target.setCustomValidity('Jumlah stok tidak boleh negatif atau nol.');
            e.target.classList.add('is-invalid');
        } else {
            e.target.setCustomValidity('');
            e.target.classList.remove('is-invalid');
        }
    });

    menuForm.addEventListener('submit', function (e) {
        hargaMenuInput.value = hargaMenuInput.value.replace(/\D/g, '');
        if (!menuForm.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        menuForm.classList.add('was-validated');
    });

    function formatRupiah(angka, prefix) {
        const numberString = angka.replace(/[^,\d]/g, '').toString();
        const split = numberString.split(',');
        const sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
});
</script>
