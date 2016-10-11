
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_model extends CI_Model {//AQUI

        public function __construct() {
            $this->load->database();
        }

        public function listar() {
            if($this->session->userdata('level')==2) {
                $query = $this->db->query("SELECT property.*, administrator.firstname FROM property LEFT JOIN property_broker ON property.property_id=property_broker.property_id LEFT JOIN administrator ON administrator.administrator_id=property_broker.broker_id WHERE administrator.administrator_id=".$this->session->userdata('aID'));
            } else {
                $query = $this->db->get('property');//AQUI
            }
            return $query->result_array();
        }

        public function disponibles(){
            $query = $this->db->query("SELECT COUNT(*) AS total FROM property_unity WHERE property_id=1 AND status=0");
            return $query->row();
        }

        public function vendidas(){
            $query = $this->db->query("SELECT COUNT(*) AS total FROM property_unity WHERE property_id=1 AND status=1");
            return $query->row();
        }

        public function dinero(){
            $query = $this->db->query("SELECT SUM(price) AS total FROM property_unity WHERE property_id=1 AND status=1");
            return $query->row();
        }

        public function ver($id = FALSE) {
            if($this->session->userdata('level')!=0) {
                $query = $this->db->query("SELECT property.* FROM property_broker LEFT JOIN administrator on property_broker.broker_id=administrator.administrator_id LEFT JOIN property ON property.property_id = property_broker.property_id WHERE property_broker.broker_id=".$this->session->userdata('aID'));
                return $query->row_array();
            } 
            $query = $this->db->get_where('property', array('property_id' => $id));//AQUI
            return $query->row_array();
        }

        public function caracteristicas($id) {
            $query = $this->db->get_where('property_amenities', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
        public function fotos($id) {
            $query = $this->db->get_where('property_photo', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
        public function departamentos($id) {
            $query = $this->db->query('SELECT property_unity.*, property.name FROM property_unity LEFT JOIN property ON property.property_id=property_unity.property_id WHERE property.property_id='.$id);//AQUI
            return $query->result_array();
        }
        public function tipos($id) {
            $query = $this->db->query('SELECT type FROM property_unity WHERE property_id='.$id.' GROUP BY type');//AQUI
            return $query->result_array();
        }
        public function departamentosdisponibles($id) {
            $query = $this->db->query('SELECT property_unity.*, property.name FROM property_unity LEFT JOIN property ON property.property_id=property_unity.property_id WHERE property_unity.status=0 AND property.property_id=1');//AQUI.$id
            return $query->num_rows();
        }
        public function personas($id) {
            $query = $this->db->query('SELECT client.*, property_unity.*, property.name FROM property_client LEFT JOIN client ON client.client_id=property_client.client_id LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id LEFT JOIN property ON property.property_id=property_client.property_id WHERE property_client.property_id='.$id);//AQUI
            return $query->result_array();
        }
        public function portada(){
            $quien = "";
            if($this->session->userdata('level')==1) {
                $quien = "WHERE property_broker.broker_id=".$this->session->userdata('aID');
            }
            $query = $this->db->query("SELECT property.*, property_photo.photo, property_broker.broker_id FROM property LEFT JOIN property_photo on property.property_id=property_photo.property_id LEFT JOIN property_broker ON property_broker.property_id=property.property_id ".$quien." GROUP BY property_photo.property_id LIMIT 3");
            return $query->result_array();
        }
        public function visitas($id) {
            $query = $this->db->query("SELECT client.*, client_visits.timestamp FROM client LEFT JOIN client_visits ON client.client_id=client_visits.client_id WHERE client_visits.property_id=$id"); // falta id cliente por URL
            return $query->result_array();
        }
        public function columnas(){
            $query = $this->db->field_data('property');
            return $query;
        }

        public function solo() {
            $query = $this->db->query("SELECT property.property_id, property.name, property.city, property.country, property_photo.photo, administrator.firstname FROM property LEFT JOIN property_photo on property.property_id=property_photo.property_id LEFT JOIN property_broker ON property.property_id=property_broker.property_id LEFT JOIN administrator ON administrator.administrator_id=property_broker.broker_id  WHERE administrator.administrator_id=".$this->session->userdata('aID') ." GROUP BY property_photo.property_id ");
            return $query->result_array();
        }

}