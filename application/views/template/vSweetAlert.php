<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const status = "<?php echo $this->session->flashdata('status'); ?>";
            const message = "<?php echo $this->session->flashdata('message'); ?>";

            if (status === "success") {
                Swal.fire({
                    title: "Berhasil!",
                    text: message,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "<?php echo site_url('admin/vDaftarMenu'); ?>";
                });
            } else if (status === "error") {
                Swal.fire({
                    title: "Gagal!",
                    text: message,
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "<?php echo site_url('admin/vDaftarMenu'); ?>";
                });
            }
        });
    </script>
</body>
</html>
