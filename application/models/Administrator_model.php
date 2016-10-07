<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Administrator_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function listar($id = FALSE){
            if ($id === FALSE){
                    $query = $this->db->get('administrator');
                    return $query->result_array();
            }
            $query = $this->db->get_where('administrator', array('administrator_id' => $id));
            return $query->row_array();
        }

        public function logeo($password, $login){
            
            $query = $this->db->get_where('administrator', array('email' => $login, 'password' => md5($password) ));
            return $query->row_array();
        }

        public function columnas(){
            //$query = $this->db->query('DESCRIBE administrator');// test purpose
            //$query = $this->db->list_fields('administrator');// test purpose
            $query = $this->db->field_data('administrator');
            return $query;
        }

        public function olvide($login){
            $query = $this->db->get_where('administrator', array('email' => $login));
            return $query->num_rows();
        }

}