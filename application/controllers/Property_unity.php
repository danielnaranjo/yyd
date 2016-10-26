<?php
    class Property_unity extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_unity_model');//AQUI
        $this->load->model('Property_model');//AQUI
    }

    public function index()
    {        
        $data = $this->Property_unity_model->listar();//AQUI
        echo json_encode($data);
    }

    public function view($id,$property_id)
    {
        $data = $this->Property_unity_model->listar($id);//AQUI
        echo json_encode($data);
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "property_unity";
        $data['fields'] = $this->Property_unity_model->columnas();
        $data['tables'] = $this->Property_model->listar();//<-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Property_unity_model->listar($id);

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
    public function delete($id){
        $this->Property_unity_model->deletear($id);
         redirect('property/all', 'location', 302);
    }
    public function add(){
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'number' => $this->input->post("number"),
            'type' => $this->input->post("type"),
            'orientation' => $this->input->post("orientation"),
            'price_mts' => $this->input->post("price_mts"),
            'price_feet' => $this->input->post("price_feet"),
            'total_mts' => $this->input->post("total_mts"),
            'total_feet' => $this->input->post("total_feet"),
            'status' => 0,
        );
        $data = $this->Property_unity_model->registrar($data);
        //echo json_encode($data);
        if($data){
            redirect('property/all', 'location');
        }
    }
    public function update(){
        $id = $this->input->post("property_unity_id");
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'number' => $this->input->post("number"),
            'type' => $this->input->post("type"),
            'orientation' => $this->input->post("orientation"),
            'price_mts' => $this->input->post("price_mts"),
            'price_feet' => $this->input->post("price_feet"),
            'total_mts' => $this->input->post("total_mts"),
            'total_feet' => $this->input->post("total_feet"),
            //'status' => $this->input->post("status"),
        );
        $this->Property_unity_model->updatear($id, $data);
        redirect('property/all', 'location');
    }
    public function by($id) {        
        $data['titulo'] = 'Unidades';
        $data['result'] = $this->Property_unity_model->lista($id);
        $data['fields'] = $this->Property_unity_model->columnas();
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

    public function change(){
        $id = $this->input->post("property_unity_id");
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'status' => $this->input->post("status"),
        );
        $this->Property_unity_model->cambiarestado($id, $data);
        echo true;
    }
    public function markassold(){
        
        /*$persona = array(
            'property_id' => $this->input->post("property_id"),
            'broker_id' => $this->input->post("broker_id"),
            'client_id' => $this->input->post("client_id"),
            'property_unity_id' => $this->input->post("property_unity_id"),
            'status' => $this->input->post("status")
        );
        $data = $this->Property_unity_model->marcar($persona);*/
        //echo $data;
        //echo json_encode($data);

        $status = $this->input->post("status");
        $property_id = $this->input->post("property_id");
        $client_id = $this->input->post("client_id");
        $property_unity_id = $this->input->post("property_unity_id");
        $broker_id = $this->input->post("broker_id");
        $unidad = $this->input->post("unidad");

        switch ($status) {
            case 0:
                // Se habilita nuevamente y se blanquea la unidad para la venta
                $sql="DELETE FROM property_client WHERE property_unity_id=".$property_unity_id;
                break;
            case 2:
                // Se habilita nuevamente y se blanquea la unidad para la venta
                $sql="DELETE FROM property_client WHERE property_unity_id=".$property_unity_id;
                break;
            case 3:
                // Solo en Reserva o Compra
                $query = $this->db->query('SELECT * FROM property_client WHERE property_unity_id='.$property_unity_id);
                $check = $query->num_rows();
                if($check>0){
                    $sql="UPDATE property_client SET client_id='".$client_id."', broker_id='".$broker_id."' WHERE property_unity_id=".$property_unity_id;
                } else {
                    $sql="INSERT INTO property_client (property_id,client_id,property_unity_id,broker_id) VALUES (".$property_id.", ".$client_id.", ".$property_unity_id.", ".$broker_id.")";
                }
                break;
            case 4:
                // Solo en Reserva o Compra
                $query = $this->db->query('SELECT * FROM property_client WHERE property_unity_id='.$property_unity_id);
                $check = $query->num_rows();
                if($check>0){
                    $sql="UPDATE property_client SET client_id='".$client_id."', broker_id='".$broker_id."' WHERE property_unity_id=".$property_unity_id;
                } else {
                    $sql="INSERT INTO property_client (property_id,client_id,property_unity_id,broker_id) VALUES (".$property_id.", ".$client_id.", ".$property_unity_id.", ".$broker_id.")";
                }
                break;
            default:
                //
                break;
        }
        $this->db->query($sql);
        $this->db->query("UPDATE property_unity SET status='".$status."' WHERE property_unity_id='".$property_unity_id."'");
        $data['unidad'] = $unidad;
        $data['property_id'] = $property_id;
        echo json_encode($data);
    }
}