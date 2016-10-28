
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

            $query = $this->db->get_where('property_parking', array('property_unity_id' => $id));//AQUI
            return $query->result_array();
        }
        public function columnas(){
            $query = $this->db->field_data('property_parking');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('property_parking', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('property_parking_id', $id);
            $this->db->update('property_parking', $data);
        }
        public function deletear($id){
            $this->db->where('property_parking_id', $id);
            $this->db->delete('property_parking');
        } 
        public function lista($id){
            $query = $this->db->query('
                SELECT 
                    property.name,
                    property_parking.number AS parking, 
                    property_unity.number AS unity,
                    client.firstname, 
                    client.lastname, 
                    property_parking.property_parking_id 
                FROM property_parking 
                    LEFT JOIN client ON client.client_id=property_parking.client_id
                    LEFT JOIN property_unity ON property_unity.property_unity_id=property_parking.property_unity_id
                    LEFT JOIN property ON property.property_id=property_parking.property_id
                WHERE property_parking.property_id='.$id
        );//AQUI
            return $query->result_array();
        }
        public function listacampos($id){
            $sql = "
                SELECT 
                    property.name,
                    property_parking.number AS parking, 
                    property_unity.number AS unity,
                    client.firstname, 
                    client.lastname, 
                    property_parking.property_parking_id,
                    property_parking.property_unity_id,
                    property.property_id,
                    client.client_id
                FROM property_parking 
                    LEFT JOIN client ON client.client_id=property_parking.client_id
                    LEFT JOIN property_unity ON property_unity.property_unity_id=property_parking.property_unity_id
                    LEFT JOIN property ON property.property_id=property_parking.property_id
            ";
            $query = $this->db->query($sql);
            return $query->list_fields();
        }   
        public function parkeo($id){
            $query = $this->db->query('
                SELECT 
                    property.name,
                    property_parking.number AS parking, 
                    property_parking.amount,
                    property_unity.number AS unity,
                    client.firstname, 
                    client.lastname, 
                    property_parking.property_parking_id,
                    property_parking.property_unity_id,
                    property.property_id,
                    client.client_id
                FROM property_parking 
                    LEFT JOIN client ON client.client_id=property_parking.client_id
                    LEFT JOIN property_unity ON property_unity.property_unity_id=property_parking.property_unity_id
                    LEFT JOIN property ON property.property_id=property_parking.property_id
                WHERE property_parking.property_parking_id='.$id
        );//AQUI
            return $query->row_array();
        }   
}