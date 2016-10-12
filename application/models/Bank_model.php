
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Bank_model extends CI_Model {//AQUI

        public function __construct() {
            $this->load->database();
        }

        public function listar($id = FALSE)  {
            if ($id === FALSE)
            {
                    $query = $this->db->get('bank');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('bank', array('bank_id' => $id));//AQUI
            return $query->row_array();
        }
        public function completo() {
            $query = $this->db->get('bank');
            return $query->result_array();
        }
        public function columnas(){
            $query = $this->db->field_data('bank');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('bank', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('bank_id', $id);
            $this->db->update('bank', $data);
        }
        public function deletear($id){
            $this->db->where('bank_id', $id);
            $this->db->delete('bank');
        }  
}