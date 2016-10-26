
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Property_unity_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id = FALSE)
        {
            if ($id === FALSE)
            {
                    $query = $this->db->get('property_unity');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('property_unity', array('property_unity_id' => $id));//AQUI
            return $query->row_array();
        }
        public function columnas(){
            $query = $this->db->field_data('property_unity');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('property_unity', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('property_unity_id', $id);
            $this->db->update('property_unity', $data);
        }
        public function deletear($id){
            $this->db->where('property_unity_id', $id);
            $this->db->delete('property_unity');
        }
        public function lista($id){
            $query = $this->db->get_where('property_unity', array('property_id' => $id));//AQUI
            return $query->result_array();
        }
        public function estado($id){
            $query = $this->db->get_where('property_unity', array('property_id' => $id));//AQUI
            /*$sql="SELECT 
                    property_unity.*,
                    client.*
                FROM property_client 
                    LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id 
                    LEFT JOIN client ON property_client.client_id =client.client_id
                WHERE property.property_id=".$id;
            $query = $this->db->query($sql);
            */
            return $query->result_array();
        }
        public function cambiarestado($id, $data){
            $this->db->where('property_unity_id', $id);
            $this->db->update('property_unity', $data);
        }
        public function asignar($data){
            
            $this->db->where('property_unity_id', $data['property_unity_id']);
            $this->db->update('property_unity', array('status'=>$data['status']) );
            $query = $this->db->insert('property_client', $data);
            
            //$broker = $data['broker'];
            //$query = $this->db->insert('property_broker', $broker);
            return $query;
        }
        public function propietario($number){
            $sql="SELECT 
                administrator.administrator_id AS brokerID,
                administrator.firstname AS brokerName,
                administrator.lastname AS brokerSurname,
                administrator.email AS brokerEmail,
                client.firstname AS name,
                client.lastname AS surname,
                client.client_id AS Id
            FROM property_unity 
                LEFT JOIN property_client ON property_client.property_unity_id = property_unity.property_unity_id
                LEFT JOIN client ON client.client_id=property_client.client_id
                LEFT JOIN administrator ON administrator.administrator_id=property_client.broker_id 
            WHERE property_unity.number='".$number."'";
            $query = $this->db->query($sql);
            return $query->row_array();
        }

        public function marcar($data){
            /*$this->db->where('property_unity_id', $data['property_unity_id']);
            $this->db->update('property_unity', $data['status']);

            $venta = array(
                'property_id' => $data['property_id'],
                'client_id' => $data['client_id'],
                'property_unity_id' => $data['property_unity_id'],
                'broker_id' => $data['broker_id'],
            );
            $query = $this->db->insert('property_client', $venta);
            return $query;*/
        }
}