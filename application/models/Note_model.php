
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Note_model extends CI_Model {//AQUI

        public function __construct()
        {
            $this->load->database();
        }

        public function listar($id)  {
            $query = $this->db->get_where('note', array('client_id' => $id));//AQUI
            return $query->row_array();
        }
        public function columnas(){
            $query = $this->db->field_data('note');
            return $query;
        }
        public function registrar($data){
            $query = $this->db->insert('note', $data);
            return $query;
        }
        public function updatear($id, $data){
            $this->db->where('note_id', $id);
            $this->db->update('note', $data);
        }
        public function deletear($id){
            $this->db->where('note_id', $id);
            $this->db->delete('note');
        }
        public function unidad($id)  {
            $query = $this->db->query("
                SELECT 
                    note.note,
                    DATE_FORMAT(note.updated,'%d/%m/%Y %H:%i') AS updated,
                    administrator.firstname,
                    administrator.lastname
                FROM note
                    LEFT JOIN administrator ON administrator.administrator_id=note.broker_id
                WHERE property_unity_id='".$id."'
                ORDER BY note.updated DESC
            ");//AQUI
            return $query->result_array();
        }
}