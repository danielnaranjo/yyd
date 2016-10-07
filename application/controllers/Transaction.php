<?php
    class Transaction extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model');//AQUI
        $this->load->model('Client_info_model');//AQUI
        //$this->load->library('session');
    }

    public function index()
    {        
        $data = $this->Transaction_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Transaction_model->listar($slug);//AQUI
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "transaction_model";
        $data['fields'] = $this->Transaction_model->columnas();
        //$this->load->view('forms/general', $data);// test purpose
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Transaction_model->listar($id);

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

    public function countries($id = NULL) {
        $data['result'] = $this->Transaction_model->paises($id);//AQUI
        $data['titulo'] = 'Nacionalidades';

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/reportes', $data);
        // footer
        $this->load->view('templates/footer');
    }

    public function unities($id = NULL) {
        $data['result'] = $this->Transaction_model->unidades($id);//AQUI
        $data['titulo'] = 'Unidades';

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/unidades', $data);
        // footer
        $this->load->view('templates/footer');
    }
}