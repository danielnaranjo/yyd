<?php
    class Property_parking extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_parking_model');//AQUI
        $this->load->model('Property_model');//AQUI
    }

    public function index()
    {        
        $data = $this->Property_parking_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Property_parking_model->listar($slug);//AQUI
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "property_parking";
        $data['fields'] = $this->Property_parking_model->columnas();
        $data['tables'] = $this->Property_model->listar();//<-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Property_parking_model->listar($id);

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
    }
    public function delete($id){
        $this->Property_parking_model->deletear($id);
         redirect('property/all', 'location', 302);
    }
    public function add(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            'total' => $this->input->post("total"),
            'type' => $this->input->post("type"),
            'notes' => $this->input->post("notes"),
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
            'property_id' => $this->input->post("property_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            'total' => $this->input->post("total"),
            'type' => $this->input->post("type"),
            'notes' => $this->input->post("notes"),
        );
        $this->Property_parking_model->updatear($id, $data);
        redirect('property/all', 'location');
    } 
    public function by($id) {        
        $data['titulo'] = 'Parking';
        $data['result'] = $this->Property_parking_model->lista($id);
        $data['fields'] = $this->Property_parking_model->columnas();
        $data['property'] = $this->Property_model->listar();

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('tables/pages', $data);
        // footer
        $this->load->view('templates/footer');
    }
}