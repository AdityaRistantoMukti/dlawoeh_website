<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMenu extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('Database');
	}
	function tambah_data() {
        $inputan = $this->input->post();
        
        // Memeriksa apakah inputan memiliki data yang diperlukan
        if (empty($inputan["nama_menu"]) || empty($inputan["harga_menu"]) || empty($inputan["deskripsi_menu"]) 
            || empty($inputan["menu_qty"]) || empty($inputan["kategori"]) || empty($_FILES["gambar"]["name"])) {
            $this->session->set_flashdata('error', 'Semua data harus diisi');
            redirect('admin/vTambahMenu');
            return false;
        }
        
                
        // Konversi harga_menu ke bentuk angka
        $inputan["harga_menu"] = str_replace('.', '', $inputan["harga_menu"]);
    
        // Memeriksa apakah file gambar telah diunggah
        if ($_FILES["gambar"]["error"] != UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'Gagal mengunggah gambar');
            redirect('admin/vTambahMenu');
            return false;
        }
        
        // Mengisi properti objek dengan data yang diterima
        $this->nama_menu = $inputan["nama_menu"];
        $this->harga_menu = $inputan["harga_menu"];
        $this->deskripsi_menu = $inputan["deskripsi_menu"];
        $this->menu_qty = $inputan["menu_qty"];
        $this->kategori = $inputan["kategori"];
        $this->gambar_menu = $_FILES["gambar"]["name"];
        $tmp_picture_product = $_FILES["gambar"]["tmp_name"];
        
        // Menyiapkan jalur penyimpanan gambar
        $Path = "assets/gambar/menu/";
        $ImagePath = $Path . $this->gambar_menu;
        
        // Pindahkan file gambar ke lokasi yang ditentukan
        if (move_uploaded_file($tmp_picture_product, $ImagePath)) {
            // Jika berhasil memindahkan gambar, lakukan penyisipan data ke database
            $data = [
                'nama_menu' => $this->nama_menu,
                'harga_menu' => $this->harga_menu,
                'deskripsi_menu' => $this->deskripsi_menu,
                'menu_qty' => $this->menu_qty,
                'kategori' => $this->kategori,
                'gambar_menu' => $this->gambar_menu
            ];
        
            $this->db->insert('menu', $data);
            $this->session->set_flashdata('success', 'Data Berhasil ditambah');
            redirect('admin/vDaftarMenu');
        } else {
            // Jika gagal memindahkan gambar, kembalikan false
            $this->session->set_flashdata('error', 'Gagal menambah data');
            redirect('admin/vTambahMenu');
        }
    
       
        
    }
    
     function edit_data($id){
        // Mengambil inputan user
            $inputan = $this->input->post();
            // Mendapatkan informasi produk yang akan diperbarui
            $menu = $this->db->get_where('menu', ['menu_id' => $id])->row();
            // Memeriksa apakah inputan memiliki data yang diperlukan
            if (empty($inputan["nama_menu"]) || empty($inputan["harga_menu"]) || empty($inputan["deskripsi_menu"]) 
                || empty($inputan["menu_qty"]) || empty($inputan["kategori"])) {
                return false; // Jika data yang diperlukan kosong, kembalikan false
            }

          
            // Konversi harga_menu ke bentuk angka
            $inputan["harga_menu"] = str_replace('.', '', $inputan["harga_menu"]);

            // Memeriksa apakah ada gambar baru yang diunggah
            if (!empty($_FILES["gambar"]["name"])) {
                // Memeriksa apakah file gambar telah diunggah dengan sukses
                if ($_FILES["gambar"]["error"] != UPLOAD_ERR_OK) {
                    return false; // Jika terdapat kesalahan dalam proses unggah file, kembalikan false
                    redirect('Admin/vEditMenu');
                }

                // Menghapus gambar lama jika ada
                $oldImagePath = "assets/gambar/menu/".$menu->gambar_menu;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                // Pindahkan file gambar ke lokasi yang ditentukan
                $tmp_picture_product = $_FILES["gambar"]["tmp_name"];
                // Menyiapkan jalur penyimpanan gambar
                $Path = "assets/gambar/menu/";
                $this->gambar_menu = $_FILES["gambar"]["name"];
                $ImagePath = $Path.$this->gambar_menu;
                move_uploaded_file($tmp_picture_product, $ImagePath);

                // Mengisi properti objek dengan data yang diterima
                $updateMenu = [
                    "nama_menu" => $inputan["nama_menu"],
                    "harga_menu" => $inputan["harga_menu"],
                    "deskripsi_menu" => $inputan["deskripsi_menu"],
                    "menu_qty" => $inputan["menu_qty"],
                    "kategori" => $inputan["kategori"],
                    "gambar_menu" => $this->gambar_menu
                ];
            } else {
                // Mengisi properti objek dengan data yang diterima
                $updateMenu = [
                    "nama_menu" => $inputan["nama_menu"],
                    "harga_menu" => $inputan["harga_menu"],
                    "deskripsi_menu" => $inputan["deskripsi_menu"],
                    "menu_qty" => $inputan["menu_qty"],
                    "kategori" => $inputan["kategori"]
                ];
            }

            // Update data ke database            
            $this->db->update('menu', $updateMenu, array('menu_id' => $id));
            $this->session->set_flashdata('success', 'Data Berhasil diubah');
            redirect('admin/vDaftarMenu');

    }

    function hapus_data($id){
        $menu = $this->db->get_where('menu', ['menu_id' => $id])->row();
        $imageFile = $menu->gambar_menu;
    
        if ($menu) {
            if (file_exists("assets/uploads/" . $imageFile)) {
                unlink("assets/uploads/" . $imageFile);
            }
            $this->db->delete('menu', array('menu_id' => $id));
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Data Gagal dihapus');
        }
        
        redirect('admin/vDaftarMenu');
    }
    
}
