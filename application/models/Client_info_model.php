
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Client_info_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function perfil($id){
            $query = $this->db->query("SELECT client.*, client_info.* FROM client_data LEFT JOIN client ON client.client_id=client_data.client_id LEFT JOIN client_info ON client_info.client_info_id=client_data.client_id WHERE client_data.client_id=$id");
            return $query->result_array();
        }

        public function visita($id){
            $query = $this->db->query("SELECT client_visits.*, client.lastname, property.* FROM client_visits LEFT JOIN client ON client_visits.client_id=client.client_id left JOIN property ON property.property_id=client_visits.client_id WHERE client_visits.client_id=$id");
            return $query->result_array();
        }

        public function transacciones($id){
            $query = $this->db->query("SELECT transaction.*, property.name, administrator.firstname, administrator.lastname FROM transaction LEFT JOIN transaction_client ON transaction.transaction_id=transaction_client.transaction_id LEFT JOIN property ON property.property_id=transaction.property_id LEFT JOIN administrator ON administrator.administrator_id=transaction.broker_id WHERE transaction_client.client_id=$id");
            return $query->result_array();
        }

        public function montototal($id){
            $query = $this->db->query("SELECT SUM(transaction.amount) AS total FROM transaction LEFT JOIN transaction_client ON transaction.transaction_id=transaction_client.transaction_id LEFT JOIN property ON property.property_id=transaction.property_id LEFT JOIN administrator ON administrator.administrator_id=transaction.broker_id WHERE transaction_client.client_id=$id");
            return $query->result_array();
        }

        public function propiedad($id){
            $query = $this->db->query("SELECT property.name FROM property_client LEFT JOIN property ON property_client.property_id=property.property_id LEFT JOIN client ON client.client_id=property_client.client_id WHERE property_client.client_id=$id");
            return $query->result_array();
        }

        public function compra($id){
            $query=$this->db->query("SELECT property_unity.* FROM property_client LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id WHERE property_client.client_id=$id");
            return $query->result_array();
        }

        public function parkeo($id){
            $query=$this->db->query("SELECT property_parking.* FROM property_parking LEFT JOIN property ON property_parking.property_id=property.property_id WHERE property.property_id=$id");
            return $query->num_rows();
        }
        
        public function columnas(){
            $query = $this->db->field_data('client_info');
            return $query;
        }

        public function notas($id){
            $query = $this->db->get_where('note', array('client_id' => $id));
            //$query = $this->db->order_by('created', 'DESC');//AQUI
            return $query->result_array();
        }
}
