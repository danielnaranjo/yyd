<?php
    class Broker extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Broker_model');//AQUI
        //$this->load->library('session');
    }

    public function index()
    {        
        $data = $this->Broker_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Broker_model->listar($slug);//AQUI
    }

    public function all(){
        //$data['news'] = $this->Administrator_model->get_news();
        //echo json_encode($data);

        $data['titulo'] = 'Brokers';
        $data['result'] = $this->Broker_model->listar();
        $data['fields'] = $this->Broker_model->columnas();

        //seguridad
//      $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('tables/pages', $data);
        // footer
        $this->load->view('templates/footer');
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        //$data['model'] = "broker";
        $data['fields'] = $this->Broker_model->columnas();
        $data['tables'] = ""; // <-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Broker_model->listar($id);

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
}