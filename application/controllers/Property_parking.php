<?php
    class Property_parking extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_parking_model');//AQUI
        $this->load->model('Property_model');//AQUI
        $this->load->model('Client_model');
        $this->load->model('Administrator_model');
        $this->load->model('Note_model');
        $this->load->model('Transaction_model');
    }

    public function index()
    {        
        $data = $this->Property_parking_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($id = NULL) {
        $data = $this->Property_parking_model->listar($id);//AQUI
        echo json_encode($data);
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "property_parking";
        $data['fields'] = $this->Property_parking_model->columnas();
        $data['tables'] = $this->Property_model->listar();//<-- Linea 79 / formulario.php
        
        $data['action']="edit";// acction
        $data['btn']="Editar registro";// Texto boton
        $data['result'] = $this->Property_parking_model->listar($id);
        
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
    }
    public function delete($id){
        $this->Property_parking_model->deletear($id);
        redirect('property/all', 'location', 302);
    }
    public function add(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            //'property_unity_id' => $this->input->post("property_unity_id"),
            'amount' => $this->input->post("amount"),
            //'type' => $this->input->post("type"),
            //'notes' => $this->input->post("notes"),
        );
        $data = $this->Property_parking_model->registrar($data);
        //echo json_encode($data);
        if($data){
            redirect('property/all', 'location');
        }
    }
    public function update(){
        $id = $this->input->post("property_parking_id");
        $data = array(
            //'property_id' => $this->input->post("property_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            //'client_id' => $this->input->post("client_id"),
            'amount' => $this->input->post("amount"),
            'number' => $this->input->post("number"),
        );
        $this->Property_parking_model->updatear($id, $data);
        redirect('property/all', 'location');
    } 
    public function by($id) {        
        $data['titulo'] = 'Parking';
        $data['result'] = $this->Property_parking_model->lista($id);
        //$data['fields'] = $this->Property_parking_model->listacampos();
        //$data['property'] = $this->Property_model->listar();
        //$data['properties'] = $this->Property_model->listar();
        $data['clients'] = $this->Client_model->listar();
        $data['info'] = $this->Transaction_model->info($id);

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/parkings', $data);
        // footer
        $this->load->view('templates/footer');
    }
    public function assign(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            'client_id' => $this->input->post("client_id"),
            'amount' => $this->input->post("amount"),
            'number' => $this->input->post("number"),
        );
        $data = $this->Property_parking_model->registrar($data);
        $datanote = array(
            'property_id' => $this->input->post("property_id"),
            'broker_id' => $this->input->post("broker_id"),
            'client_id' => $this->input->post("client_id"),
            'note' => 'Parking agregado la unidad #'.$this->input->post("unidad")." (Nota automatica).",
            'property_unity_id' => $this->input->post("property_unity_id"),
        );
        $datanote = $this->Note_model->registrar($datanote);
        echo json_encode($data);
    }
    public function getData($id) {
        $data = $this->Property_parking_model->parkeo($id);
        echo json_encode($data);
    }
}