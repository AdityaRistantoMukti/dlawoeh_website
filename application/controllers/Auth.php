<?php 
 defined ('BASEPATH') or exit('No direct script access allowed');

    class Auth extends CI_Controller {
        function __construct(){
            parent::__construct();

            $this->load->model('Database');
        }

        public function index(){          

            $this->load->view('template/header');
            $this->load->view('admin/login');
            $this->load->view('template/footer');
        }
        public function login_user(){
            $this->load->view('user/login_user');
        }

        public function register_user(){
            $this->load->view('user/register_user');
        }


        // Aksi

        // Login Admin
        function login_admin() {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
            if($this->form_validation->run() != false) {
                $where = array(
                    'username' => $username,
                    'password' => md5($password),
                );
    
                $data = $this->Database->get_where_data($where, 'admin');
                $d = $this->Database->get_where_data($where, 'admin')->row();
    
                $cek = $data->num_rows();
                if($cek > 0) {
                    $session = array(
                        'id' => $d->admin_id,
                        'nama' => $d->username,
                        'status' => 'login_admin'
                    );
    
                    $data_admin = $this->session->set_userdata($session);
                    redirect(base_url() . 'admin?pesan=berhasil');
                } else {
                    redirect(base_url() . 'auth?pesan=gagal_login');
                }
            } else {
                $this->load->view('login');
            }
        }
        // Login User
        function login_aksi() {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
            if($this->form_validation->run() != false) {
                $where = array(
                    'username' => $username,
                    'password' => md5($password),
                );
    
                $data = $this->Database->get_where_data($where, 'user');
                $d = $this->Database->get_where_data($where, 'user')->row();
    
                $cek = $data->num_rows();
                if($cek > 0) {
                    $session = array(
                        'id' => $d->id_user,
                        'nama' => $d->username,
                        'status' => 'login_user'
                    );
    
                    $this->session->set_userdata($session);
                    redirect(base_url() );
                } else {
                    redirect(base_url().'auth/login_user?pesan=gagal_login');
                }
            } else {
                $this->load->view('login_user');
            }
        }
        // Register User
         function register_aksi() {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
        
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
            if($this->form_validation->run() != false) {
                $data = array(
                    'username' => $username,
                    'password' => md5($password),
                );
        
                $insert = $this->Database->insert_data($data, 'user');
                

                if($insert) {
                    $data = $this->Database->get_where_data($where, 'user');
                    $d = $this->Database->get_where_data($where, 'user')->row();
                    $cek = $data->num_rows();
                    if($cek > 0) {
                        $session = array(
                            'id' => $d->id_user,
                            'nama' => $d->username,
                            'status' => 'login_user'
                        );
                        $this->session->set_userdata($session);
                        redirect(base_url());
                    }
                } else {
                    redirect(base_url().'auth/register_user');
                    $this->session->set_flashdata('register_gagal','Gagal Melakukan register');
                }
            } else {
                $this->load->view('register_user');
            }
        }
        
        // Logout
        function logout_admin(){
            $this->session->sess_destroy();        
            redirect(base_url().'auth?pesan=logout');
        }

        function logout_user(){
            $this->session->sess_destroy();        
            redirect(base_url().'auth/login_user?pesan=logout');
        }

    }
?>