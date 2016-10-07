<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Broker_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar()  {
            $query = $this->db->get_where('administrator', array('level' => 1));//AQUI
            return $query->result_array();
        }
         public function columnas(){
            $query = $this->db->field_data('administrator');
            return $query;
        }

}