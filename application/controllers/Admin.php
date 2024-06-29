<?php 
    defined('BASEPATH') or exite('No Direct Script Access Allowed');

    class Admin extends CI_Controller {
        
        function __construct() {
            parent::__construct();

            // Cek Login
            if ($this->session->userdata('status') != "login_admin") {
                redirect(base_url().'auth?pesan=belumlogin');
            }

            $this->load->library('cart');
            $this->load->model('database');
        }

        public function index(){  
            
            $data['penghasilan_perhari'] = $this->database->penghasilan_perhari();
            $data['penghasilan_perbulan'] = $this->database->penghasilan_perbulan();
            $data['penghasilan_pertahun'] = $this->database->penghasilan_pertahun();
            $data['penghasilan_keseluruhan'] = $this->database->penghasilan_keseluruhan();
            $data['jumlah_transaksi'] = $this->database->jumlah_transaksi();

            $this->load->view('admin/head');
            $this->load->view('admin/navbar');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/footer');
        }


        // Menu
        public function vDaftarMenu(){

            $data['menu'] = $this->database->getAll_data('menu')->result();

            $this->load->view('admin/head');
            $this->load->view('admin/navbar');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/DataMenu/daftarMenu', $data);
            $this->load->view('admin/footer');
        }
           
        public function vTambahMenu(){
            $this->load->view('admin/head');
            $this->load->view('admin/navbar');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/DataMenu/tambahData');
            $this->load->view('admin/footer');
        }

        public function vEditMenu($id){
            $where = array(
                'menu_id' => $id
            );
            $data['menu'] = $this->database->get_where_data($where,'menu')->row();
            
            $this->load->view('admin/head');
            $this->load->view('admin/navbar');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/DataMenu/editData', $data);
            $this->load->view('admin/footer');
        }

        // Transaksi 
        public function vLihatTransaksi(){
            $data['transaksi'] = $this->database->getAll_data('transaksi')->result();
           // Ambil semua transaksi_ids
                $transaksi_ids = array_column($data['transaksi'], 'transaksi_id');

                // Ambil detail transaksi untuk setiap transaksi_id
                $data['cart_items'] = [];
                if (!empty($transaksi_ids)) {
                    $detail_transaksi = $this->database->get_detail_transaksi($transaksi_ids);
                    foreach ($detail_transaksi as $dt) {
                        $data['cart_items'][$dt['transaksi_id']][] = [
                            'nama_menu' => $dt['nama_menu'],
                            'jumlah' => $dt['jumlah']
                        ];
                    }
                }
            $this->load->view('admin/head');
            $this->load->view('admin/navbar');
            $this->load->view('admin/sidebar');
            $this->load->view('admin/DataTransaksi/lihat_transaksi', $data);
            $this->load->view('admin/footer');
        }
                       
       

    }
?>