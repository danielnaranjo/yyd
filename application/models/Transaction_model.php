
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Transaction_model extends CI_Model {//AQUI

        public function __construct() {
            $this->load->database();
        }

        public function listar($id = FALSE) {
            if ($id === FALSE)
            {
                    $query = $this->db->get('transaction');//AQUI
                    return $query->result_array();
            }

            $query = $this->db->get_where('transaction', array('transaction_id' => $id));//AQUI
            return $query->row_array();
        }

        public function paises($id = FALSE) {
            if ($id === FALSE){
                //$query = $this->db->like('country', $id);               
                //$query = $this->db->get('client_info');
                $query = $this->db->query("SELECT COUNT(*) AS total, country FROM client_info GROUP BY country ORDER BY total DESC");
                return $query->result_array();
            }

            //$query = $this->db->group_by(array("country"));
            //$query = $this->db->select('country')->get("client_info");
            $query = $this->db->query("SELECT COUNT(*) AS total, country FROM client_info WHERE country LIKE '%$id%'  GROUP BY country ORDER BY total DESC");   
            return $query->result_array();
        }
        public function unidades($id = FALSE) {
            /*
            pendiente anidar unidades->cliente->client_info
            WHERE property_id='.$id.'
            */
            if ($id === FALSE){
                $query = $this->db->query("
                    SELECT 
                        type,
                        COUNT(*) AS total,
                        SUM(CASE 
                              WHEN status=1 THEN 1
                              ELSE 0
                            END) AS none,
                        SUM(CASE 
                              WHEN status=1 THEN 1
                              ELSE 0
                            END) AS available,
                        SUM(CASE 
                              WHEN status=2 THEN 1
                              ELSE 0
                            END) AS free,
                       SUM(CASE 
                              WHEN status=3 THEN 1
                              ELSE 0
                            END) AS reserved,
                       SUM(CASE 
                              WHEN status=4 THEN 1
                              ELSE 0
                            END) AS sold
                    FROM property_unity 
                    WHERE property_id='$id' 
                    GROUP BY type
                ");
                return $query->result_array();
            }

            $query = $this->db->query("
                    SELECT 
                        type,
                        COUNT(*) AS total,
                        SUM(CASE 
                              WHEN status=1 THEN 1
                              ELSE 0
                            END) AS none,
                        SUM(CASE 
                              WHEN status=2 THEN 1
                              ELSE 0
                            END) AS free,
                       SUM(CASE 
                              WHEN status=3 THEN 1
                              ELSE 0
                            END) AS reserved,
                       SUM(CASE 
                              WHEN status=4 THEN 1
                              ELSE 0
                            END) AS sold
                    FROM property_unity 
                    GROUP BY type
                ");   
            return $query->result_array();
        }


        /*public function columnaspersonalizadas(){
            $sql = "SELECT property.property_id, property.name, property_unity.number, property_unity.price, property_unity.comission, broker_comission.date, broker_comission.amount, broker_comission.comission, administrator.firstname, administrator.lastname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1";
            $query = $this->db->query($sql);
            return $query->list_fields();
        }*/
        public function vendedores() {
            $query = $this->db->query("SELECT property.property_id, property.name AS property, property_unity.number, property_unity.price, property_unity.comission, broker_comission.date, broker_comission.amount, broker_comission.comission AS split, administrator.firstname AS name, administrator.lastname AS surname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1");   
            return $query->result_array();
        }


        public function columnas(){
            $query = $this->db->field_data('transaction');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('transaction', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('transaction_id', $id);
            $this->db->update('transaction', $data);
        }
        public function deletear($id){
            $this->db->where('transaction_id', $id);
            $this->db->delete('transaction');
        }

        // descarga todas la info en csv
        public function descargar($report){
            $this->load->dbutil();
            $delimiter = ";";
            $newline = "\r\n";
            $enclosure = '"';

            if($report=='countries'){
                $sql="SELECT COUNT(*) AS total, country FROM client_info GROUP BY country ORDER BY total DESC";
            } else if($report=='unities'){
                $sql="SELECT COUNT(*) AS total, type FROM property_unity GROUP BY type";
            } else if($report=='brokers'){
                $sql="
                SELECT 
                    #property.property_id,
                    property.name AS property,
                    property_unity.number,
                    property_unity.price, 
                    property_unity.comission,
                    broker_comission.date,
                    broker_comission.amount,
                    broker_comission.comission AS split,
                    administrator.firstname AS name,
                    administrator.lastname AS surname
                FROM broker_comission 
                    LEFT JOIN property ON property.property_id=broker_comission.property_id 
                    LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id
                    LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id
                WHERE 1
                ";
            } else {
                $sql="
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
                WHERE client.status=1
                ";
            }

            $sql = $this->db->query($sql);
            return $this->dbutil->csv_from_result($sql, $delimiter, $newline, $enclosure);
        }
        public function informacion($id,$property){
            $query = $this->db->get_where('property_unity', array('number' => $id,'property_id' => $property));//AQUI
            return $query->row_array();
        }
        public function broker(){//$id
            $query = $this->db->query('SELECT administrator.administrator_id, administrator.firstname, administrator.lastname, property.name, property.property_id FROM property_broker LEFT JOIN administrator ON administrator.administrator_id=property_broker.broker_id LEFT JOIN property ON property.property_id=property_broker.property_id ');//WHERE property_broker.broker_id=$id
            return $query->result_array();
        }
        public function columnaspersonalizadas(){
            $sql = "SELECT property.property_id, property.name, property_unity.number, property_unity.price, property_unity.comission, broker_comission.date, broker_comission.amount, broker_comission.comission, administrator.firstname, administrator.lastname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1";
            $query = $this->db->query($sql);
            //return $query->list_fields();
            return $query->field_data();
        }
}