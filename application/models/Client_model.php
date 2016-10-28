
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Client_model extends CI_Model {//AQUI

        public function __construct(){

            $this->load->database();
        }

        public function listar($id = FALSE){
            if ($id === FALSE) {
                $query = $this->db->query('SELECT property.name, client.* FROM property_client LEFT JOIN property ON property.property_id=property_client.property_id LEFT JOIN client ON property_client.client_id=client.client_id WHERE property_client.property_id');//AQUI
                return $query->result_array();
            }
            $query = $this->db->query('SELECT property.name, client.* FROM property_client LEFT JOIN property ON property.property_id=property_client.property_id LEFT JOIN client ON property_client.client_id=client.client_id WHERE property_client.property_id='.$id);//AQUI
            return $query->row_array();
        }

        public function completo() {

            $sql="
            SELECT 
                property.*, 
                client.*, 
                client_info.* 
            FROM property_client 
                LEFT JOIN property ON property.property_id=property_client.property_id 
                LEFT JOIN client ON property_client.client_id=client.client_id 
                LEFT JOIN client_data ON client_data.client_id=client.client_id
                LEFT JOIN client_info ON client_info.client_info_id =client_data.client_info_id
            ";
           
            if ($this->session->userdata('level')!=0) {
                $sql.=" AND property_client.property_id=".$this->session->userdata('property_id');
            } 

            $query = $this->db->query($sql);
            return $query->result_array();
        } 

        public function visitantes() {
            $sql="SELECT client.*, client_info.city, client_info.country, client_info.phone FROM client LEFT JOIN client_info ON client.client_id=client_info.client_info_id LEFT JOIN client_visits ON client_visits.client_id=client.client_id";

            if ($this->session->userdata('level')!=0) {
                $sql.=" AND client_visits.property_id=".$this->session->userdata('property_id');
            } 
            
            $query = $this->db->query($sql);
            return $query->result_array();
        } 

        public function contar(){
            $query = $this->db->get_where('client', array('status' => 0) );//AQUI
            return $query->num_rows();
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
        public function registrar($data){
            $query = $this->db->insert('client', $data);
            return $this->db->insert_id();
        }
        public function updatear($id, $data){
            $this->db->where('client_id', $id);
            $this->db->update('client', $data);
        }
        public function deletear($id){
            $this->db->where('client_id', $id);
            $this->db->delete('client');
        }
        public function enlazar($data){
            $query = $this->db->insert('client_visits', $data);
            return $query;
        }

        // descarga todas la info en csv
        public function descargar(){
            $this->load->dbutil();
            $delimiter = ";";
            $newline = "\r\n";
            $enclosure = '"';
            $sql = $this->db->query("
                SELECT 
                    property.name AS property, 
                    property_unity.number, 
                    property_unity.type, 
                    property_unity.square,
                    client.firstname AS name, 
                    client.lastname AS surname, 
                    client_info.email, 
                    client_info.address, 
                    client_info.city, 
                    client_info.country, 
                    client_info.phone
                FROM client 
                    LEFT JOIN property_client ON property_client.client_id=client.client_id 
                    LEFT JOIN property ON property.property_id=property_client.property_id 
                    LEFT JOIN client_info ON client.client_id=client_info.client_info_id 
                    LEFT JOIN property_unity ON property_unity.property_unity_id=property_client.property_unity_id
                ");
            return $this->dbutil->csv_from_result($sql, $delimiter, $newline, $enclosure);
        }

        public function columnaspersonalizadas(){
            $sql = "SELECT property.property_id, client.* FROM property_client LEFT JOIN property ON property.property_id=property_client.property_id LEFT JOIN client ON property_client.client_id=client.client_id LEFT JOIN client_info ON client.client_id=client_info.client_info_id WHERE client.status=1";
            $query = $this->db->query($sql);
            return $query->field_data();
        }
        public function compradores() {
            $sql="SELECT property.property_id, client.* FROM property_client LEFT JOIN property ON property.property_id=property_client.property_id LEFT JOIN client ON property_client.client_id=client.client_id LEFT JOIN client_info ON client.client_id=client_info.client_info_id WHERE client.status=1"; 
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        public function paises(){
            $sql="
            SELECT 
                count(*) AS total, 
                client.country,
                countries.lat,
                countries.lng,
                countries.code
            FROM client 
                LEFT JOIN property_client ON client.client_id=property_client.client_id
                LEFT JOIN property ON property.property_id=property_client.property_id
                LEFT JOIN countries ON countries.name=client.country 
            WHERE property_client.property_id=1
            GROUP BY client.country 
            ORDER BY total DESC
            ";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        public function cantidaddevistas(){
            $sql="SELECT DATE_FORMAT(timestamp,'%Y-%m-%d') AS date, count(*) AS value FROM client_visits GROUP BY date ORDER BY date ASC";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        public function resultados($q) {
            $sql="
                SELECT 
                    client.*, 
                    client_info.* 
                FROM client_info 
                    LEFT JOIN clienT ON client.client_id=client_info.client_info_id 
                WHERE client.firstname LIKE '%$q%' 
                    OR client.lastname LIKE '%$q%' 
                    OR client_info.email LIKE '%$q%'
            ";
            $query = $this->db->query($sql);
            return $query->result_array();
        } 
        public function columnasCreate(){
            $sql = "SELECT 
                    client.firstname,
                    client.lastname,
                    client_info.email,
                    client_info.address,
                    client_info.city,
                    client_info.country,
                    client_info.phone
                FROM client_data
                    LEFT JOIN client_info ON client_info.client_info_id=client_data.client_info_id
                    LEFT JOIN client ON client.client_id=client_data.client_id";
            $query = $this->db->query($sql);
            return $query->field_data();
        }

        public function listadepaises(){
            $query = $this->db->query("SELECT name FROM countries ORDER BY name ASC");
            return $query->result_array();
        }

        public function nuevo($data){
            $query = $this->db->insert('client', $data);
            return $this->db->insert_id();
        }
        public function editar($id,$data){

        }
        public function mostrar($id) {
            $sql="
            SELECT 
                    client.firstname,
                    client.lastname,
                    client_info.email,
                    client_info.address,
                    client_info.city,
                    client_info.country,
                    client_info.phone,
                    client.client_id,
                    client_info.client_info_id
                FROM
                    client_data
                    LEFT JOIN client ON client_data.client_id=client.client_id
                    LEFT JOIN client_info ON client_data.client_info_id=client_info.client_info_id
                WHERE client_data.client_id=$id
            ";
            $query = $this->db->query($sql);
            return $query->row_array();
        }
    }