
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Transaction_model extends CI_Model {//AQUI

        public function __construct() {
            $this->load->database();
        }

        public function listar($id = FALSE) {
            if ($id === FALSE)
            {
                    $query = $this->db->get('transaction');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('transaction', array('transaction_id' => $id));//AQUI
            return $query->row_array();
        }

        public function paises($id = FALSE) {
            if ($id === FALSE){
                //$query = $this->db->like('country', $id);               
                //$query = $this->db->get('client_info');
                $query = $this->db->query("SELECT COUNT(*) AS total, country FROM client_info GROUP BY country ORDER BY total DESC");
                return $query->result_array();
            }

            //$query = $this->db->group_by(array("country"));
            //$query = $this->db->select('country')->get("client_info");
            $query = $this->db->query("SELECT COUNT(*) AS total, country FROM client_info WHERE country LIKE '%$id%'  GROUP BY country ORDER BY total DESC");   
            return $query->result_array();
        }
        public function unidades($id = FALSE) {
            /*
            pendiente anidar unidades->cliente->client_info
            WHERE property_id='.$id.'
            */
            if ($id === FALSE){
                $query = $this->db->query("SELECT COUNT(*) AS total, type FROM property_unity GROUP BY type");
                return $query->result_array();
            }

            $query = $this->db->query("SELECT COUNT(*) AS total, type FROM property_unity  GROUP BY type");   
            return $query->result_array();
        }


        public function columnas(){
            $query = $this->db->field_data('transaction');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('transaction', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('transaction_id', $id);
            $this->db->update('transaction', $data);
        }
        public function deletear($id){
            $this->db->where('transaction_id', $id);
            $this->db->delete('transaction');
        }
}