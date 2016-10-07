
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Client_model extends CI_Model {//AQUI

        public function __construct(){

            $this->load->database();
        }

        public function listar($id = FALSE){
            if ($id === FALSE) {
                $query = $this->db->get('client');//AQUI
                return $query->result_array();
            }
            $query = $this->db->get_where('client', array('client_id' => $id));//AQUI
            return $query->row_array();
        }

        public function completo() {
            //$query = $this->db->get_where('client', array('slug' => $slug));//AQUI
            $query = $this->db->query("SELECT client.*, client_info.city, client_info.country, client_info.phone FROM client LEFT JOIN client_info ON client.client_id=client_info.client_info_id WHERE client.status=1");
            return $query->result_array();
        } 

        public function contar(){
            $query = $this->db->get_where('client', array('status' => 0) );//AQUI
            //$query = $this->db->query("SELECT COUNT(*) AS total, status FROM client GROUP BY status");
            return $query->num_rows();
        }

        public function visitantes() {
            $query = $this->db->query("SELECT client.*, client_info.city, client_info.country, client_info.phone FROM client LEFT JOIN client_info ON client.client_id=client_info.client_info_id WHERE client.status=0");
            return $query->result_array();
        } 

        public function visitas() {
            $query = $this->db->query("SELECT client.*, client_visits.timestamp FROM client LEFT JOIN client_visits ON client.client_id=client_visits.client_id WHERE client.client_id=0"); // falta id cliente por URL
            return $query->result_array();
        } 

        public function perfil($id){
            $query = $this->db->get_where('client', array('client_id' => $id) );//AQUI
            return $query->result_array();
        }

        // formulario
        public function columnas(){
            $query = $this->db->field_data('client');
            return $query;
        }
        public function insertar(){
            $data = array(
                'title' => $title,
                'name' => $name,
                'date' => $date
            );
            //$this->db->insert('client', $data);
            //$data = array('name' => $name, 'email' => $email, 'url' => $url);
            $str = $this->db->insert_string('client', $data);
            // devuelve el ultimo id
            return $this->db->insert_id();
        }
        public function updatear($id){
            $data = array(
                'title' => $title,
                'name' => $name,
                'date' => $date
            );
            $this->db->where('client_id', $id);
            $this->db->update('client', $data);
        }
        public function deletear($id){
            $this->db->where('client_id', $id);
            $this->db->delete('client');

        }


}