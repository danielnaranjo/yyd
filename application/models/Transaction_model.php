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
                        property.name,
                        property_unity.type,
                        COUNT(*) AS total,
                        SUM(CASE
                            WHEN property_unity.status=0 THEN 1
                            ELSE 0
                            END) AS none,
                        SUM(CASE
                            WHEN property_unity.status=1 THEN 1
                            ELSE 0
                            END) AS available,
                        SUM(CASE
                            WHEN property_unity.status=2 THEN 1
                            ELSE 0
                            END) AS free,
                        SUM(CASE
                            WHEN property_unity.status=3 THEN 1
                            ELSE 0
                           END) AS reserved,
                        SUM(CASE
                            WHEN property_unity.status=4 THEN 1
                            ELSE 0
                            END) AS sold
                        FROM property_unity
                            LEFT JOIN property ON property.property_id=property_unity.property_id
                        WHERE property_unity.property_id='$id'
                        GROUP BY property_unity.type
                ");
                return $query->result_array();
            }

            $query = $this->db->query("
                    SELECT
                        property.name,
                        property_unity.type,
                        COUNT(*) AS total,
                        SUM(CASE
                            WHEN property_unity.status=0 THEN 1
                            ELSE 0
                            END) AS none,
                        SUM(CASE
                            WHEN property_unity.status=1 THEN 1
                            ELSE 0
                            END) AS available,
                        SUM(CASE
                            WHEN property_unity.status=2 THEN 1
                            ELSE 0
                            END) AS free,
                        SUM(CASE
                            WHEN property_unity.status=3 THEN 1
                            ELSE 0
                           END) AS reserved,
                        SUM(CASE
                            WHEN property_unity.status=4 THEN 1
                            ELSE 0
                            END) AS sold
                        FROM property_unity
                            LEFT JOIN property ON property.property_id=property_unity.property_id
                        GROUP BY property_unity.type
                ");
            return $query->result_array();
        }


        /*public function columnaspersonalizadas(){
            $sql = "SELECT property.property_id, property.name, property_unity.number, property_unity.price, property_unity.comission, broker_comission.date, broker_comission.amount, broker_comission.comission, administrator.firstname, administrator.lastname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1";
            $query = $this->db->query($sql);
            return $query->list_fields();
        }*/
        public function vendedores() {
            $query = $this->db->query("SELECT property.property_id, property.name AS property, property_unity.number, property_unity.price, DATE_FORMAT(broker_comission.date,'%d/%m/%Y') AS date, broker_comission.amount, broker_comission.comission AS split, administrator.firstname AS name, administrator.lastname AS surname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1");
            return $query->result_array();
        }


        public function columnas(){
            $query = $this->db->field_data('transaction');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('transaction', $data);
            return $this->db->insert_id();
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
        public function descargar($report,$id){
            $this->load->dbutil();
            $delimiter = ";";
            $newline = "\r\n";
            $enclosure = '"';

            if($report=='countries'){
                $sql="
                    SELECT
                        COUNT(*) AS total,
                        country
                    FROM client_info
                    GROUP BY country
                    ORDER BY total DESC
                ";
            } else if($report=='unities' && $id!=''){
                $sql="
                    SELECT
                        property.name,
                        property_unity.type,
                        COUNT(*) AS total,
                        SUM(CASE
                            WHEN property_unity.status=0 THEN 1
                            ELSE 0
                            END) AS none,
                        SUM(CASE
                            WHEN property_unity.status=1 THEN 1
                            ELSE 0
                            END) AS available,
                        SUM(CASE
                            WHEN property_unity.status=2 THEN 1
                            ELSE 0
                            END) AS free,
                        SUM(CASE
                            WHEN property_unity.status=3 THEN 1
                            ELSE 0
                           END) AS reserved,
                        SUM(CASE
                            WHEN property_unity.status=4 THEN 1
                            ELSE 0
                            END) AS sold
                        FROM property_unity
                            LEFT JOIN property ON property.property_id=property_unity.property_id
                        WHERE property_unity.property_id='$id'
                        GROUP BY property_unity.type
                ";
            } else if($report=='unities' && $id==''){
                $sql="
                    SELECT
                        property.name,
                        property_unity.type,
                        COUNT(*) AS total,
                        SUM(CASE
                            WHEN property_unity.status=0 THEN 1
                            ELSE 0
                            END) AS none,
                        SUM(CASE
                            WHEN property_unity.status=1 THEN 1
                            ELSE 0
                            END) AS available,
                        SUM(CASE
                            WHEN property_unity.status=2 THEN 1
                            ELSE 0
                            END) AS free,
                        SUM(CASE
                            WHEN property_unity.status=3 THEN 1
                            ELSE 0
                           END) AS reserved,
                        SUM(CASE
                            WHEN property_unity.status=4 THEN 1
                            ELSE 0
                            END) AS sold
                        FROM property_unity
                            LEFT JOIN property ON property.property_id=property_unity.property_id
                        GROUP BY property_unity.type
                ";
            } else if($report=='brokers'){
                $sql="
                SELECT
                    property.name AS property,
                    property_unity.number,
                    property_unity.price,
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
        public function broker($id=FALSE){
            if ($id === FALSE){
                $query = $this->db->query('SELECT administrator.administrator_id, administrator.firstname, administrator.lastname, property.name, property.property_id FROM property_broker LEFT JOIN administrator ON administrator.administrator_id=property_broker.broker_id LEFT JOIN property ON property.property_id=property_broker.property_id ');
                return $query->result_array();
            }
            $query = $this->db->query('SELECT administrator.administrator_id, administrator.firstname, administrator.lastname, property.name, property.property_id FROM property_broker LEFT JOIN administrator ON administrator.administrator_id=property_broker.broker_id LEFT JOIN property ON property.property_id=property_broker.property_id WHERE property_broker.broker_id=$id');
            return $query->result_array();
        }
        public function columnaspersonalizadas(){
            $sql = "SELECT property.property_id, property.name, property_unity.number, property_unity.price, property_unity.comission, broker_comission.date, broker_comission.amount, broker_comission.comission, administrator.firstname, administrator.lastname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1";
            $query = $this->db->query($sql);
            //return $query->list_fields();
            return $query->field_data();
        }
        public function ventas(){//$id
            $query = $this->db->query("SELECT amount, DATE_FORMAT(date,'%Y-%m-%d') as date FROM transaction ");
            return $query->result_array();
        }
        public function info($id){
            $query = $this->db->get_where('property_unity', array('property_unity_id' => $id));
            return $query->row_array();
        }
        /* 13/12/2016 Cashflow */
        public function ingresos(){
            $sql = "
                SELECT
                    property_unity.number AS unidad,
                    CONCAT (client.firstname, ' ', client.lastname) as propietario,
                    DATE_FORMAT(transaction.date,'%d/%m/%Y') AS fecha,
                    SUM(transaction.amount) AS total,
                    property_unity.price AS precio,
                    client.client_id
                FROM transaction_client
                    LEFT JOIN transaction ON transaction_client.transaction_id=transaction.transaction_id
                    LEFT JOIN client ON transaction_client.client_id=client.client_id
                    LEFT JOIN property_client ON transaction_client.client_id=property_client.client_id
                    LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id
                GROUP BY property_unity.number
                ORDER BY unidad ASC
            ";/*SELECT COUNT(*) AS cantidad, SUM(amount) AS total, MONTH(date) AS mes
                FROM transaction
                GROUP BY MONTH(date)
                ORDER BY MONTH(date) ASC*/
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        public function camposdeingresos(){
            $sql = "
               SELECT
                    property_unity.number AS unidad,
                    CONCAT (client.firstname, ' ', client.lastname) as propietario,
                    DATE_FORMAT(transaction.date,'%d/%m/%Y') AS fecha,
                    SUM(transaction.amount) AS total,
                    property_unity.price AS precio,
                    client.client_id
                FROM transaction_client
                    LEFT JOIN transaction ON transaction_client.transaction_id=transaction.transaction_id
                    LEFT JOIN client ON transaction_client.client_id=client.client_id
                    LEFT JOIN property_client ON transaction_client.client_id=property_client.client_id
                    LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id
                GROUP BY property_unity.number
                ORDER BY unidad ASC
            ";
            $query = $this->db->query($sql);
            return $query->list_fields();
        }
        public function ventaspormes(){
            $sql = "
                SELECT
                    property_unity.number AS u,
                    COUNT(*) AS c,
                    CONCAT('$', FORMAT(SUM(amount), 2)) AS t,#SUM(amount) AS t,
                    MONTH(date)  AS m,
                    MONTHNAME(date) AS n,
                    DATE_FORMAT(date,'%y') AS a
                FROM transaction_client
                    LEFT JOIN transaction ON transaction_client.transaction_id=transaction.transaction_id
                    #LEFT JOIN client ON transaction_client.client_id=client.client_id
                    LEFT JOIN property_client ON transaction_client.client_id=property_client.client_id
                    LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id
                GROUP BY MONTH(date),property_unity.number
                ORDER BY YEAR(date),MONTH(date) ASC
            ";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
}

/*SELECT
                  property_unity.number AS unidad,
                  amount AS total,
                  CONCAT(MONTH(date),'-',YEAR(date)) as periodo
                FROM transaction_client
                  LEFT JOIN transaction ON transaction_client.transaction_id=transaction.transaction_id
                  LEFT JOIN client ON transaction_client.client_id=client.client_id
                  LEFT JOIN property_client ON transaction_client.client_id=property_client.client_id
                  LEFT JOIN property_unity ON property_client.property_unity_id=property_unity.property_unity_id
                ORDER BY MONTH(date) ASC
                */
