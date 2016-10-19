<?php
    class Property extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_model');//AQUI
        $this->load->model('Client_model');//AQUI
        $this->load->model('Administrator_model');//AQUI
        $this->load->model('Property_amenities_model');
        $this->load->model('Property_unity_model');
        $this->load->model('Note_model');
    }

    public function index()
    {        
        $data = $this->Property_model->listar();//AQUI
        echo json_encode($data);
    }

    public function all(){
        //$data['news'] = $this->Administrator_model->get_news();
        //echo json_encode($data);

        $data['titulo'] = 'Propiedades';
        $data['result'] = $this->Property_model->listar();
        $data['fields'] = $this->Property_model->columnas();

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

    public function free() {        
        $data = $this->Property_model->disponibles();//AQUI
        echo json_encode($data);
    }

    public function sold() {        
        $data = $this->Property_model->vendidas();//AQUI
        echo json_encode($data);
    }

    public function money() {        
        $data = $this->Property_model->dinero();//AQUI
        echo json_encode($data);
    }

    public function see($id){
        $data['result'] = $this->Property_model->ver($id);
        $data['features'] = $this->Property_model->caracteristicas($id);
        $data['photos'] = $this->Property_model->fotos($id);
        $data['free'] = $this->Property_model->departamentosdisponibles($id);

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/propiedad', $data);
        // footer
        $this->load->view('templates/footer');
    }

    public function unities($id = false){
        $data['result'] = $this->Property_model->departamentos($id);
        $data['types'] = $this->Property_model->tipos($id);
        //echo json_encode($data);
        $data['titulo'] = 'Unidades';
        $data['fields'] = $this->Property_unity_model->columnas();
        $data['tables'] = ""; // <-- Linea 79 / formulario.php

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

    public function pictures($id){
        $data = $this->Property_model->fotos($id);
        echo json_encode($data);
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        //$data['model'] = "property";
        $data['fields'] = $this->Property_model->columnas();
        $data['tables'] = ""; // <-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Property_model->ver($id);

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
        $this->Property_model->deletear($id);
         redirect('property/all', 'location', 302);
    }
    public function add(){
        $data = array(
            'name' => $this->input->post("name"),
            'description' => $this->input->post("description"),
            'email' => $this->input->post("email"),
            'city' => $this->input->post("city"),
            'province' => $this->input->post("province"),
            'country' => $this->input->post("country"),
            'address' => $this->input->post("address"),
            'phone' => $this->input->post("phone"),
            'notes' => $this->input->post("notes"),
            'floors' => $this->input->post("floors"),
            'unities' => $this->input->post("unities"),
        );
        $data = $this->Property_model->registrar($data);
        if($data){
            redirect('property/all', 'location');
        }
    }
    public function update(){
        $id = $this->input->post("property_id");
        $data = array(
            'name' => $this->input->post("name"),
            'description' => $this->input->post("description"),
            'email' => $this->input->post("email"),
            'city' => $this->input->post("city"),
            'province' => $this->input->post("province"),
            'country' => $this->input->post("country"),
            'address' => $this->input->post("address"),
            'phone' => $this->input->post("phone"),
            'notes' => $this->input->post("notes"),
            'floors' => $this->input->post("floors"),
            'unities' => $this->input->post("unities"),
        );
        $this->Property_model->updatear($id, $data);
        redirect('property/all', 'location');
    }

    public function details($id){
        $data['result'] = $this->Property_model->ver($id);
        $data['properties'] = $this->Property_model->listar();
        $data['brokers'] = $this->Administrator_model->listar();
        $data['clients'] = $this->Client_model->listar();
        $data['titulo'] = 'Unidades';
        $data['ID'] = $id;

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/torre', $data);
        // footer
        $this->load->view('templates/footer');
    }
    public function populate($id){
        $data['unities'] = $this->Property_unity_model->estado($id);
        echo json_encode($data);
    }

}