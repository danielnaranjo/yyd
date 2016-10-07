<?php
    class Client_info extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_info_model');//AQUI
        //$this->load->library('session');
    }

    public function index()
    {        
        $data = $this->Client_info_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Client_info_model->listar($slug);//AQUI
    }
}