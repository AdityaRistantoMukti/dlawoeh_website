<?php 
defined ('BASEPATH') or exit('No direct script access allowed');

    class Database extends CI_Model {
        // Aksi
        public function get_where_data($where,$table){
            return $this->db->get_where($table,$where);
        }
        public function getAll_data($table){
            return $this->db->get($table);
        }
        
       public function insert_data($data,$table){
            return $this->db->insert($table,$data);
        }
        public function insert_data_id($data, $table) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        public function update_data($where,$data,$table){   
            $this->db->where($where);
            $this->db->update($table, $data);
        }
        
        public function delete_data($where,$table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        // Dashboard
        public function penghasilan_perhari(){
            $this->db->select_sum('total_pembayaran');
            $this->db->where('DATE(tgl_pesanan)', 'CURDATE()', FALSE);
            $query = $this->db->get('transaksi');
            return $query->row()->total_pembayaran;
        }
    
        public function penghasilan_perbulan(){
            $this->db->select_sum('total_pembayaran');
            $this->db->where('MONTH(tgl_pesanan)', 'MONTH(CURDATE())', FALSE);
            $this->db->where('YEAR(tgl_pesanan)', 'YEAR(CURDATE())', FALSE);
            $query = $this->db->get('transaksi');
            return $query->row()->total_pembayaran;
        }
    
        public function penghasilan_pertahun(){
            $this->db->select_sum('total_pembayaran');
            $this->db->where('YEAR(tgl_pesanan)', 'YEAR(CURDATE())', FALSE);
            $query = $this->db->get('transaksi');
            return $query->row()->total_pembayaran;
        }
        public function penghasilan_keseluruhan(){
            $this->db->select_sum('total_pembayaran');
            $query = $this->db->get('transaksi');
            return $query->row()->total_pembayaran;
        }
        
        public function jumlah_transaksi(){
            $this->db->from('transaksi');
            return $this->db->count_all_results();
        }

        // Detail Transaksi
        public function get_detail_transaksi($transaksi_ids) {
            $this->db->select('*');
            $this->db->from('detail_transaksi');
            $this->db->where_in('transaksi_id', $transaksi_ids);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        public function get_transaksi_ids() {
            $this->db->select('transaksi_id');
            $this->db->from('transaksi');
            $query = $this->db->get();
            return $query->result_array();
        }
    }
?>