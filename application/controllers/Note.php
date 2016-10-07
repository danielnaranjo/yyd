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

    public function view($slug = NULL)
    {
        $data = $this->Note_model->listar($slug);//AQUI
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "note";
        $data['fields'] = $this->Note_model->columnas();
        //$this->load->view('forms/general', $data);// test purpose
        
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
    }
}