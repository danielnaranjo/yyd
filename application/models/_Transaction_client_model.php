
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Transaction_client_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('transaction_client');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('transaction_client', array('transaction_client_id' => $id));//AQUI
            return $query->row_array();
        }
        public function columnas(){
            $query = $this->db->field_data('transaction_client');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('transaction_client', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('transaction_client_id', $id);
            $this->db->update('transaction_client', $data);
        }
        public function deletear($id){
            $this->db->where('transaction_client_id', $id);
            $this->db->delete('transaction_client');
        }
}