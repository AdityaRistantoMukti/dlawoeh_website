<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->model('database');
    }
    
    function hapus_data($id){
        $transaksi = $this->db->get_where('transaksi', ['transaksi_id' => $id])->row();
        // $imageFile = $transaksi->bukti_pembayaran;
    
        if ($transaksi) {
            // if (file_exists("assets/gambar/bukti_pembayaran/" . $imageFile)) {
            //     unlink("assets/gambar/bukti_pembayaran/" . $imageFile);
            // }
            $this->db->delete('transaksi', array('transaksi_id' => $id));
            $this->session->set_flashdata('success', 'Data Berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Data Gagal dihapus');
        }
        
        redirect('admin/vLihatTransaksi');
    }

    function hapus_all_data(){
        // Ambil semua data transaksi
        $transaksi = $this->database->getAll_data('transaksi')->result();

        foreach ($transaksi as $data) {
            $imageFile = $data->bukti_pembayaran;
            // Hapus file gambar jika ada
            if (file_exists("assets/gambar/bukti_pembayaran/" . $imageFile)) {
                unlink("assets/gambar/bukti_pembayaran/" . $imageFile);
            }
        }

        // Hapus semua data transaksi
        $this->db->empty_table('transaksi');

        // Set pesan berhasil
        $this->session->set_flashdata('success', 'Semua data transaksi dan gambar berhasil dihapus');
        
        redirect('admin/vLihatTransaksi');
    }
}
?>