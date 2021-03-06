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
            $query = $this->db->query("
            SELECT
                client_visits.*,
                client.lastname,
                property.*,
                client_log.*
            FROM client_visits
                LEFT JOIN client ON client_visits.client_id=client.client_id
                LEFT JOIN property ON property.property_id=client_visits.client_id
                LEFT JOIN client_log ON client_log.client_id=client.client_id
            WHERE client_visits.client_id=$id
            ORDER BY client_log.client_log_id DESC
            ");
            return $query->result_array();
        }

        public function transacciones($id, $unidad){
            $query = $this->db->query("SELECT transaction.*, property.name, administrator.firstname, administrator.lastname, bank.name AS bank FROM transaction LEFT JOIN transaction_client ON transaction.transaction_id=transaction_client.transaction_id LEFT JOIN property ON property.property_id=transaction.property_id LEFT JOIN administrator ON administrator.administrator_id=transaction.broker_id LEFT JOIN bank ON transaction.payment_type=bank.bank_id WHERE transaction_client.client_id=$id AND transaction.property_unity_id=$unidad ORDER BY transaction.date DESC");
            return $query->result_array();
        }

        public function montototal($id, $unidad){
            $query = $this->db->query("SELECT SUM(transaction.amount) AS total FROM transaction LEFT JOIN transaction_client ON transaction.transaction_id=transaction_client.transaction_id LEFT JOIN property ON property.property_id=transaction.property_id LEFT JOIN administrator ON administrator.administrator_id=transaction.broker_id WHERE transaction_client.client_id=$id AND transaction.property_unity_id=$unidad");
            return $query->result_array();
        }

        public function propiedad($id){
            $query = $this->db->query("SELECT property.name, property.property_id FROM property_client LEFT JOIN property ON property_client.property_id=property.property_id LEFT JOIN client ON client.client_id=property_client.client_id WHERE property_client.client_id=$id");
            return $query->result_array();
        }

        public function compra($unity){ // se busca por unidad
            $query=$this->db->query("SELECT property_unity.* FROM property_client LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id WHERE property_unity.number=$unity");
            return $query->result_array();
        }

        public function parkeo($id){
            $query=$this->db->query("SELECT property_parking.* FROM property_parking LEFT JOIN property ON property_parking.property_id=property.property_id WHERE property_parking.property_unity_id=$id");
            return $query->row_array(); //$query->num_rows();
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

        public function populateforms($id){
            $query = $this->db->query("SELECT client_info.*, client.client_id, client_data.client_info_id FROM client_data LEFT JOIN client ON client.client_id=client_data.client_id LEFT JOIN client_info ON client_info.client_info_id=client_data.client_id WHERE client_data.client_id=$id");
            return $query->row_array();
        }

        public function updatear($id, $data){
            $this->db->where('client_info_id', $id);
            $this->db->update('client_info', $data);
        }
        public function marcarvisita($data){
            $query = $this->db->insert('client_visits', $data);
            return $query;
        }
}
