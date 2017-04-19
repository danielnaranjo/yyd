<?php
    class Transaction extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model');//AQUI
        $this->load->model('Client_info_model');//AQUI
        $this->load->model('Property_unity_model');
        $this->load->model('Note_model');
        $this->load->model('Property_parking_model');
    }

    public function index()
    {
        $data = $this->Transaction_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($slug = NULL)
    {
        $data = $this->Transaction_model->listar($slug);//AQUI
        echo json_encode($data);
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
        //$data['titulo'] = $this->session->userdata('project').' > Nacionalidades';;
        if($this->session->userdata('project')==''){
            $nombreamostrar='Visión general';
        } else {
            $nombreamostrar=$this->session->userdata('project');
        }
        $data['titulo'] = $nombreamostrar.' > Nacionalidades';

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
        //$data['titulo'] = $this->session->userdata('project')." > Reporte por Unidades ";//

        if($this->session->userdata('project')==''){
            $nombreamostrar='Visión general';
        } else {
            $nombreamostrar=$this->session->userdata('project');
        }
        $data['titulo'] = $nombreamostrar.' >  Reporte por Unidades';

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
        //$data['titulo'] = $this->session->userdata('project').' > Reporte por Brokers';//;
        //$data['fields'] = $this->Transaction_model->columnaspersonalizadas();
        if($this->session->userdata('project')==''){
            $nombreamostrar='Visión general';
        } else {
            $nombreamostrar=$this->session->userdata('project');
        }
        $data['titulo'] = $nombreamostrar.' >  Reporte por Brokers';


        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('tables/broker', $data);//
        // footer
        $this->load->view('templates/footer');

        /*echo json_encode($data);*/
    }


    public function delete($id){
        $data = $this->Transaction_model->deletear($id);
        //redirect('property/all', 'location', 302);
        echo json_encode($data);
    }
    public function add(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            'broker_id' => $this->input->post("broker_id"),
            'transaction_type' => $this->input->post("transaction_type"),
            'amount' => $this->input->post("amount"),
            'number' => $this->input->post("number"),
            'payment_type' => $this->input->post("payment_type"),
            'date' => $this->input->post("date"),
            'notes' => $this->input->post("notes"),
            'status' => 1,
        );
        $data = $this->Transaction_model->registrar($data);
        if($data){
            $query = $this->db->query("INSERT INTO transaction_client (transaction_id,client_id) VALUES (".$data.",".$this->input->post("client_id").")");
            //redirect('administrator/', 'location');
            echo true;
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
    public function download($report,$id){
        $this->load->helper('download');
        $data = $this->Transaction_model->descargar($report,$id);
        $name = 'yyigroup_'.$report.'_'.now().'.csv';
        echo force_download($name, $data);
    }
    public function info($id,$property) {
        $data['info'] = $this->Transaction_model->informacion($id,$property);
        $data['owner'] = $this->Property_unity_model->propietario($id);
        //$data['notes'] = $this->Note_model->unidad($data['info']['property_unity_id']);
        $data['parking'] = $this->Property_parking_model->listar($data['info']['property_unity_id']);
        echo json_encode($data);
    }
    public function columnaspersonalizadas(){
        $sql = "SELECT property.property_id, property.name, property_unity.number, property_unity.price, property_unity.comission, broker_comission.date, broker_comission.amount, broker_comission.comission, administrator.firstname, administrator.lastname FROM broker_comission LEFT JOIN property ON property.property_id=broker_comission.property_id LEFT JOIN administrator ON administrator.administrator_id=broker_comission.broker_id LEFT JOIN property_unity ON property_unity.property_unity_id=broker_comission.property_unity_id WHERE 1";
        $query = $this->db->query($sql);
        return $query->list_fields();
    }
    public function contadores(){
        $result = $this->Transaction_model->vendedores();
        $n=0;
        $af=0;
        $re=0;
        $s=0;
        foreach($result as $r) {
            $n +=$r['none'];
            $af +=$r['available']+$r['free'];
            $re +=$r['reserved'];
            $s +=$r['sold'];
        }
        $data['dash_none']=$n;
        $data['dash_available']=$af;
        $data['dash_reserved']=$re;
        $data['dash_sold']=$s;
    }
    public function modify(){
        $id = $this->input->post("transaction_id");
        $data = array(
            'transaction_type' => $this->input->post("transaction_type"),
            'amount' => $this->input->post("amount"),
            'number' => $this->input->post("number"),
            'payment_type' => $this->input->post("payment_type"),
            'date' => $this->input->post("date"),
            'notes' => $this->input->post("notes"),
        );
        $this->Transaction_model->updatear($id, $data);
        echo true;
    }
    /* 13/12/2016 Cashflow */
    public function cashflow(){
        $data['result'] = $this->Transaction_model->ingresos();
        $data['fields'] = $this->Transaction_model->camposdeingresos();
        //$data['cash'] = $this->Transaction_model->ventaspormes();
        $data['titulo'] = 'Cashflow';

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('tables/ventas', $data);
        // footer
        $this->load->view('templates/footer');

        /*echo json_encode($data);*/
    }
    public function bymonth(){
        $data = $this->Transaction_model->ventaspormes();
        echo json_encode($data);
    }
}
