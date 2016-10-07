<?php
    class Bank extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bank_model');//AQUI
        $this->load->model('Property_model');
        //$this->load->library('session');
    }

    public function index()
    {        
        $data = $this->Bank_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Bank_model->listar($slug);//AQUI
    }
    public function all(){
        
        $data['titulo'] = 'Formas de pago';
        $data['result'] = $this->Bank_model->listar();
        $data['fields'] = $this->Bank_model->columnas();
        //$data['model'] = "bank";

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
        //$data['model'] = "bank";
        $data['fields'] = $this->Bank_model->columnas();
        $data['tables'] = $this->Property_model->listar();// tablas relacionadas
        //$this->load->view('forms/general', $data);// test purpose
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Bank_model->listar($id);
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