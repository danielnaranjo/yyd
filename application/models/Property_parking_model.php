
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_parking_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('property_parking');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('property_parking', array('property_parking_id' => $id));//AQUI
            return $query->row_array();
        }
         public function columnas(){
            $query = $this->db->field_data('property_parking');
            return $query;
        }
}