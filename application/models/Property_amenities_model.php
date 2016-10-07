
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_amenities_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('Property_amenities');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('Property_amenities', array('Property_amenities_id' => $id));//AQUI
            return $query->row_array();
        }
         public function columnas(){
            $query = $this->db->field_data('Property_amenities');
            return $query;
        }
}