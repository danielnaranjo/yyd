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
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        //$data['model'] = "bank";
        $data['fields'] = $this->Bank_model->columnas();
        $data['tables'] = $this->Property_model->listar();// tablas relacionadas

        if($action=='edit'){
            $data['result'] = $this->Bank_model->listar($id);
        } else {
            $data['result'] = "";
            $data['resultmore'] = "";
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
        $this->Bank_model->deletear($id);
         redirect('bank/all', 'location', 302);
    }
    public function add(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'name' => $this->input->post("name"),
            'account' => $this->input->post("account"),
            'country' => $this->input->post("country"),
            'swift' => $this->input->post("swift"),
            'currency' => $this->input->post("currency"),
            'instructions' => $this->input->post("instructions"),
        );
        $data = $this->Bank_model->registrar($data);
        //echo json_encode($data);
        if($data){
            redirect('bank/all', 'location');
        }
    }
    public function update(){
        $id = $this->input->post("bank_id");
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'name' => $this->input->post("name"),
            'account' => $this->input->post("account"),
            'country' => $this->input->post("country"),
            'swift' => $this->input->post("swift"),
            'currency' => $this->input->post("currency"),
            'instructions' => $this->input->post("instructions"),
        );
        $this->Bank_model->updatear($id, $data);
        redirect('bank/all', 'location');
    }

}