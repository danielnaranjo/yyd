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
        $data['tables'] = ""; // <-- Linea 79 / formulario.php
        
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

    public function brokers() {
        $data['result'] = $this->Transaction_model->vendedores();//AQUI
        $data['titulo'] = 'Brokers';

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('tables/broker', $data);
        // footer
        $this->load->view('templates/footer');
        
        /*echo json_encode($data);*/
    }


    public function delete($id){
        $this->Transaction_model->deletear($id);
         redirect('property/all', 'location', 302);
    }
    public function add(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'broker_id' => $this->input->post("broker_id"),
            'transaction_type' => $this->input->post("transaction_type"),
            'amount' => $this->input->post("amount"),
            'number' => $this->input->post("number"),
            'payment_type' => $this->input->post("payment_type"),
            'date' => $this->input->post("date"),
            'notes' => $this->input->post("notes"),
            'status' => $this->input->post("status"),
        );
        $data = $this->Transaction_model->registrar($data);
        if($data){
            redirect('property/all', 'location');
        }
    }
    public function update(){
        $id = $this->input->post("transation_id");
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'broker_id' => $this->input->post("broker_id"),
            'transaction_type' => $this->input->post("transaction_type"),
            'amount' => $this->input->post("amount"),
            'number' => $this->input->post("number"),
            'payment_type' => $this->input->post("payment_type"),
            'date' => $this->input->post("date"),
            'notes' => $this->input->post("notes"),
            'status' => $this->input->post("status"),
        );
        $this->Transaction_model->updatear($id, $data);
        redirect('property/all', 'location');
    }
    public function download($report){
        $this->load->helper('download');
        $data = $this->Transaction_model->descargar($report);
        $name = 'yyigroup_'.$report.'_'.now().'.csv';
        echo force_download($name, $data);
    }
}