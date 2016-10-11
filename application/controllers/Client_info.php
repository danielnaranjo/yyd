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

    public function delete($id){
        $this->Client_info_model->deletear($id);
        redirect('client/all', 'location', 302);
    }

    public function update(){
        $id = $this->input->post("client_info_id");
        $data = array(
            'email' => $this->input->post("email"),
            'address' => $this->input->post("address"),
            'city' => $this->input->post("city"),
            'country' => $this->input->post("country"),
            'phone' => $this->input->post("phone"),
        );
        $this->Client_info_model->updatear($id, $data);
        redirect('client/all', 'location');
    }

}