<?php
    class Note extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Note_model');//AQUI
        //$this->load->library('session');
    }

    public function index($id)
    {        
        $data = $this->Note_model->listar($id);//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL){
        $data = $this->Note_model->ver($slug);
        echo json_encode($data);
    }
    /* FORMULARIOS
    public function action($action = NULL, $id = NULL){
        $data['model'] = "note";
        $data['fields'] = $this->Note_model->columnas();
        $data['tables'] = ""; // <-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Note_model->listar($id);

        } else {
            $data['action']="new";// acction
            $data['btn']="Agregar nuevo";// Texto boton
            $data['result'] = "";
        }
        
        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('forms/pagina', $data);
        // footer
        $this->load->view('templates/footer');
    } */
    public function add(){
        $data = array(
            'note_id' => $this->input->post("note_id"),
            'property_id' => $this->input->post("property_id"),
            'broker_id' => $this->input->post("broker_id"),
            'client_id' => $this->input->post("client_id"),
            'note' => $this->input->post("note"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            'created' => now(),
        );
        $data = $this->Note_model->registrar($data);
        //if($data){
        //    echo json_encode($data);
        //}
        echo json_encode($this->input->post("property_unity_id"));
    }

    public function unity($id) {        
        $data = $this->Note_model->unidad($id);//AQUI
        echo json_encode($data);
    }

    public function delete($id){
        $data = $this->Note_model->deletear($id);
        echo json_encode($data);
    }
    public function update(){
        $id = $this->input->post("note_id");
        $data = array(
            'note' => $this->input->post("note"),
            'broker_id' => $this->input->post("broker_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
        );
        $resp = $this->Note_model->updatear($id, $data);
        echo json_encode($data['property_unity_id']);
    }
}