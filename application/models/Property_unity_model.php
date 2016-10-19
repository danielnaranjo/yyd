
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_unity_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('property_unity');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('property_unity', array('property_unity_id' => $id));//AQUI
            return $query->row_array();
        }
        public function columnas(){
            $query = $this->db->field_data('property_unity');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('property_unity', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('property_unity_id', $id);
            $this->db->update('property_unity', $data);
        }
        public function deletear($id){
            $this->db->where('property_unity_id', $id);
            $this->db->delete('property_unity');
        }
        public function lista($id){
            $query = $this->db->get_where('property_unity', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
        public function estado($id){
            $query = $this->db->get_where('property_unity', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
        public function cambiarestado($id, $data){
            $this->db->where('property_unity_id', $id);
            $this->db->update('property_unity', $data);
        }
}