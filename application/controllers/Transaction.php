<?php
    class Transaction extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model');//AQUI
        $this->load->model('Client_info_model');//AQUI
        $this->load->model('Property_unity_model');
        $this->load->model('Note_model');
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
        $data['titulo'] = 'Nacionalidades';//.$this->session->userdata('project');

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
        $data['titulo'] = "Reporte por Unidades ".$this->session->userdata('project');//

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
        $data['titulo'] = 'Reporte por Brokers '.$this->session->userdata('project');//;
        //$data['fields'] = $this->Transaction_model->columnaspersonalizadas();

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
    public function info($id,$property) {
        $data['info'] = $this->Transaction_model->informacion($id,$property);
        $data['owner'] = $this->Property_unity_model->propietario($id);
        //$data['notes'] = $this->Note_model->unidad($data['info']['property_unity_id']);
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
}