<?php
    class Transaction_client extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_client_model');//AQUI
        //$this->load->library('session');
    }

    public function index()
    {        
        $data = $this->Transaction_client_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Transaction_client_model->listar($slug);//AQUI
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "transaction_client";
        $data['fields'] = $this->Transaction_client_model->columnas();
        $data['tables'] = ""; // <-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Transaction_client_model->listar($id);

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