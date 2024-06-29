<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Pastikan autoloader Composer dimuat
require_once FCPATH . 'vendor/autoload.php';

use Twilio\Rest\Client;

class Pesanan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('database');
        $this->load->helper('image'); 
    }

    public function index(){
        $data['cart'] = $this->cart->contents();
        $this->load->view('user/pesanan', $data);        
    }
    
    public function hapus($rowid) {
        if ($rowid === "all") {
            // Update transaksi table to set all rows to inactive
            $this->db->update('transaksi', array('is_active' => 0));
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
    
        $this->session->set_flashdata('success', 'Item berhasil dihapus dari keranjang.');
        redirect('pesanan');
    }

    public function checkout() {
        // Mengambil item-item dari keranjang
        $cart_items = $this->cart->contents();
    
        $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'required|alpha');
        $this->form_validation->set_rules('alamat_pemesan', 'Alamat Pemesan', 'required');
        $this->form_validation->set_rules('nohp_pemesan', 'Nomor HP Pemesan', 'required|numeric|max_length[12]');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('pesanan'); // atau halaman sebelumnya
        } else {
            // Memeriksa apakah file bukti pembayaran telah diunggah
            if ($_FILES["gambar"]["error"] != UPLOAD_ERR_OK) {
                $this->session->set_flashdata('error', 'Gagal mengunggah bukti pembayaran');
                redirect('pesanan');
                return false;
            }
    
            // Mengambil data dari form
            $nama_pemesan = $this->input->post('nama_pemesan');
            $alamat_pemesan = $this->input->post('alamat_pemesan');
            $nohp_pemesan = $this->input->post('nohp_pemesan');
            $total_pembayaran = $this->cart->total();
            $tgl_pesanan = $this->input->post('tgl_pesanan');
    
            // Menyiapkan jalur penyimpanan gambar
            $this->bukti_pembayaran = $_FILES["gambar"]["name"];
            $tmp_picture_product = $_FILES["gambar"]["tmp_name"];
            $Path = "assets/gambar/bukti_pembayaran/";
            $ImagePath = $Path . $this->bukti_pembayaran;
    
            // Pindahkan file gambar ke lokasi yang ditentukan
            if (move_uploaded_file($tmp_picture_product, $ImagePath)) {
                // Upload gambar ke Imgur
                $clientId = '35168f34b56e7f1'; // Client ID Imgur
                $clientSecret = '579c2a0b6f6e10125627742900b98337a3b47548'; // Client Secret Imgur
                $imgur_url = upload_image_to_imgur($ImagePath, $clientId);
    
                if (!$imgur_url) {
                    // Jika upload ke Imgur gagal
                    $this->session->set_flashdata('error', 'Gagal mengunggah bukti pembayaran');
                    redirect('pesanan');
                    return false;
                }
    
                // Jika berhasil memindahkan gambar, lakukan penyisipan data ke database
                $cart_contents = $this->cart->contents();
                foreach ($cart_contents as $item) {
                    // Jika qty dalam keranjang adalah 0, atur menjadi 1
                    if ($item['qty'] == 0) {
                        $item['qty'] = 1;
                    }
                }
    
                $transaksi_data = [
                    'nama_pemesan' => $nama_pemesan,
                    'alamat_pemesan' => $alamat_pemesan,
                    'nohp_pemesan' => $nohp_pemesan,
                    'total_pembayaran' => $total_pembayaran,
                    'bukti_pembayaran' => $imgur_url, // Menggunakan URL gambar dari Imgur
                    'tgl_pesanan' => $tgl_pesanan, // Mengambil tanggal saat ini
                ];
    
                $this->db->insert('transaksi', $transaksi_data);
                $transaksi_id = $this->db->insert_id(); // Ambil ID transaksi yang baru saja disimpan
    
                $detail_transaksi_data = [];
                foreach ($cart_items as $item) {
                    $detail_transaksi_data[] = [
                        'transaksi_id' => $transaksi_id,
                        'nama_menu' => $item['name'],
                        'jumlah' => $item['qty'],
                        'harga' => $item['price']
                    ];
                }
                // Simpan data detail transaksi ke tabel 'detail_transaksi'
                $this->db->insert_batch('detail_transaksi', $detail_transaksi_data);
    
                // Mengurangi stok berdasarkan item di keranjang
                foreach ($cart_items as $item) {
                    // Kurangi stok
                    $this->db->set('menu_qty', 'menu_qty - '. $item['qty'], FALSE);
                    $this->db->where('menu_id', $item['id']);
                    $this->db->update('menu');
                }
    
                // Siapkan pesan WhatsApp dengan daftar pesanan
                $pesan_whatsapp = "Pesanan Baru:\n";
                foreach ($cart_items as $item) {
                    $pesan_whatsapp.= "- ". $item['name']. " (Qty: ". $item['qty']. ")\n";
                }
                $pesan_whatsapp.= "\n";
                $pesan_whatsapp.= "Detail Pemesan:\n";
                $pesan_whatsapp.= "Nama: $nama_pemesan\n";
                $pesan_whatsapp.= "Alamat: $alamat_pemesan\n";
                $pesan_whatsapp.= "No HP: $nohp_pemesan\n";
                $pesan_whatsapp.= "Total Pembayaran: Rp.". number_format($total_pembayaran). "\n";
                
    
                // Mengirim data ke WhatsApp
                $sid = "AC21e01b56ae822725b05ae35e6f772c52";
                $token = "33bc720b1cb404b62885bb12d7384372";
                $whatsapp_penjual = '6281350878039';
                $media_url = "https://ioflood.com/blog/wp-content/uploads/2023/10/java_logo_dice_random.jpg";
                // Twilio Config    
                $twilio = new Client($sid, $token);                
    
                try {
                    $message = $twilio->messages
                        ->create("whatsapp:+". $whatsapp_penjual, // to
                            array(
                                "from" => "whatsapp:+14155238886",
                                "body" => $pesan_whatsapp,
                                "mediaUrl" => [$media_url]
                            )
                        );
                
                    log_message('info', 'WhatsApp message sent: ' . json_encode($message->sid));
                
                } catch (\Twilio\Exceptions\RestException $e) {
                    log_message('error', 'Twilio error: ' . $e->getMessage());
                    $this->session->set_flashdata('error', 'Gagal mengirim pesan ke WhatsApp.');
                    redirect('pesanan');
                }
    
                $this->cart->destroy();
                $this->session->set_flashdata('success', 'Pesanan berhasil dibuat!');
                redirect('pesanan');
            } else {
                // Jika gagal memindahkan gambar, kembalikan false
                $this->session->set_flashdata('error', 'Gagal mengunggah bukti pembayaran');
                redirect('pesanan');
            }
        } //Penutup form-validation
    }
    

   
    public function check_stock() {
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $cart_item = $this->cart->get_item($rowid);
        
        if ($cart_item) {
            $menu_id = $cart_item['id'];
            $this->load->model('database');
            $menu = $this->database->get_where_data(['menu_id' => $menu_id], 'menu')->row();
            $stock = $menu->menu_qty;
    
            echo json_encode(['stock' => $stock]);
        }
    }
    
    public function update_cart() {
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
    
        $cart_item = $this->cart->get_item($rowid);
        if ($cart_item) {
            $menu_id = $cart_item['id'];
            $menu = $this->database->get_where_data(['menu_id' => $menu_id], 'menu')->row();
            $stock = $menu->menu_qty;
    
            if ($qty > $stock) {
                $qty = 1;
            }
    
            if ($qty < 1) {
                $qty = 1;
            }
    
            $data = array(
                'rowid' => $rowid,
                'qty' => $qty
            );
            $this->cart->update($data);
    
            $cart = $this->cart->contents();
            $response = array(
                'subtotal' => $cart[$rowid]['subtotal'],
                'total' => $this->cart->total()
            );
            echo json_encode($response);
        }
    }
    
        
}
