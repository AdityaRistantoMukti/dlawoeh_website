<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library('cart');
		$this->load->model('Database');
	}
	public function index()
	{	
	 	
		$data = [
			'menu' => $this->Database->getAll_data('menu')->result(),
		]; 
					
		$this->load->view('user/index', $data);					
	}

	public function tambah_pesanan($id) {
		 // Mendapatkan data menu berdasarkan id
		 $where = array('menu_id' => $id);
		 $menu = $this->Database->get_where_data($where, 'menu')->row();
 
		 // Mencari apakah item sudah ada di keranjang
		 $cart_items = $this->cart->contents();
		 $item_found = false;
 
		 foreach ($cart_items as $item) {
			 if ($item['id'] == $id) {
				 // Jika item sudah ada di keranjang, tambahkan jumlahnya
				 $data = array(
					 'rowid' => $item['rowid'],
					 'qty'   => $item['qty'] + 1
				 );
				 $this->cart->update($data);
				 $item_found = true;
				 break;
				 
			 }
		 }
 
		 // Jika item belum ada di keranjang, tambahkan sebagai item baru
		 if (!$item_found) {
			 $data = array(
				 'id'    => $menu->menu_id,
				 'qty'   => 1,
				 'price' => $menu->harga_menu,
				 'name'  => $menu->nama_menu
			 );
			 $this->cart->insert($data);			 
		 }			
			// Redirect ke halaman dashboard
			redirect(base_url());	
		}
}
