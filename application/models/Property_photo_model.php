
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_photo_model extends CI_Model {//AQUI

        public function __construct(){
            $this->load->database();
        }

        public function listar($id = FALSE){
            if ($id === FALSE) {
                    $query = $this->db->get('property_photo');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('property_photo', array('property_photo_id' => $id));//AQUI
            return $query->row_array();
        }
        public function columnas(){
            $query = $this->db->field_data('property_photo');
            return $query;
        }
        public function lista($id){
            $query = $this->db->get_where('property_photo', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
        public function subir_y_agregar($data){
            $query = $this->db->insert('property_photo', $data);
            return $data;
        }
        public function updatear($id, $data){
            $this->db->where('property_photo_id', $id);
            $this->db->update('property_photo', $data);
        }
        public function deletear($id){
            $this->db->where('property_photo_id', $id);
            $this->db->delete('property_photo');
        }
}