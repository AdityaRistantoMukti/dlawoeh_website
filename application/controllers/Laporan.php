<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->model('database');
    }

    public function laporan_menu(){
        
        
        $data['menu'] = $this->database->getAll_data('menu')->result();
        $this->load->view('admin/laporan/laporan_menu', $data);
        $html = ob_get_contents();
            ob_end_clean();
            
        require './assets/html2pdf/autoload.php';
        
        $pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
        $pdf->WriteHTML($html);
        $pdf->Output('Laporan Menu.pdf', 'D');
    }

    public function laporan_transaksi(){
        $this->load->view('admin/laporan/laporan_transaksi');
    }
}
?>