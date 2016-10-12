
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_amenities_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id){

            $query = $this->db->get_where('property_amenities', array('property_amenities_id' => $id));//AQUI
            return $query->row_array();
        }

        public function columnas(){
            $query = $this->db->field_data('property_amenities');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('property_amenities', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('property_amenities_id', $id);
            $this->db->update('property_amenities', $data);
        }
        public function deletear($id){
            $this->db->where('property_amenities_id', $id);
            $this->db->delete('property_amenities');
        }

        public function lista($id){

            $query = $this->db->get_where('property_amenities', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
}