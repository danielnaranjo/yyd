
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Note_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id)  {
            $query = $this->db->get_where('note', array('client_id' => $id));//AQUI
            return $query->row_array();
        }
         public function columnas(){
            $query = $this->db->field_data('note');
            return $query;
        }
}