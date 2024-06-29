<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-3 mb-3">
                    <div class="card-header">
                        <center><img src="<?php echo base_url("assets/gambar/menu/").$menu->gambar_menu; ?>" width='200' height='200'></center>
                    </div>
                    <div class="card-body">
                        <form id="editMenuForm" action="<?php echo base_url('datamenu/edit_data/').$menu->menu_id ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="nama_menu">Nama Menu</label>
                                <input class="form-control" id="nama_menu" name="nama_menu" type="text" value="<?php echo $menu->nama_menu ?>" required />
                                <div class="invalid-feedback">Nama menu tidak boleh mengandung karakter khusus.</div>
                            </div>
                            <label class="mb-2" for="deskripsi_menu">Deskripsi Menu</label>
                            <div class="form-group" style="border:1px solid grey">
                                <textarea class="form-control" name="deskripsi_menu" cols="20" rows="5" style="border:none;" required><?php echo $menu->deskripsi_menu ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" class="form-control" name="kategori">
                                    <option selected value="<?php echo $menu->kategori ?>">- <?php echo $menu->kategori ?></option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Paket">Paket</option>
                                </select>
                            </div>
                            <div class="form-group mt-3 mb-3">
                                <label for="harga_menu">Harga Menu</label>
                                <input class="form-control" id="harga_menu" name="harga_menu" type="text" value="<?php echo number_format($menu->harga_menu, 0, ',', '.') ?>" required />
                                <div class="invalid-feedback">Harga harus lebih dari 0 dan tidak boleh mengandung huruf atau karakter khusus.</div>
                            </div>
                            <div class="form-group mt-3 mb-3">
                                <label for="menu_qty">Jumlah Menu</label>
                                <input class="form-control" id="menu_qty" name="menu_qty" type="number" value="<?php echo $menu->menu_qty ?>" min="1" required />
                                <div class="invalid-feedback">Jumlah stok tidak boleh negatif atau huruf.</div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan Gambar Product (Opsional)</label>
                                <input class="form-control" type="file" id="formFile" name="gambar">
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <a class="btn btn-secondary mx-2" href="<?php echo base_url().'admin/vDaftarMenu' ?>">Kembali</a>
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
    const editMenuForm = document.getElementById('editMenuForm');

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

    editMenuForm.addEventListener('submit', function (e) {
        hargaMenuInput.value = hargaMenuInput.value.replace(/\D/g, '');
        if (!editMenuForm.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        editMenuForm.classList.add('was-validated');
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
