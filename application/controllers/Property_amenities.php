<?php
    class Property_amenities extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_amenities_model');//AQUI
        $this->load->model('Property_model');//AQUI
    }

    public function index() {        
        $data = $this->Property_amenities_model->listar($id);//AQUI
        //echo json_encode($data);
        redirect('property/all', 'location', 302);
    }

    public function all() {        
        $data = $this->Property_amenities_model->listar($id);//AQUI
        //echo json_encode($data);
        redirect('property/all', 'location', 302);
    }

    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "property_amenities";
        $data['fields'] = $this->Property_amenities_model->columnas();
        $data['tables'] = $this->Property_model->listar();//<-- Linea 79 / formulario.php
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Property_amenities_model->listar($id);

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
        //echo json_encode($data['tables']);
    }
    
    public function delete($id){
        $this->Property_amenities_model->deletear($id);
         redirect('property_amenities/by/', 'location', 302);
    }
    public function add(){
        $pID = $this->input->post("property_id");
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'name' => $this->input->post("name"),
            'description' => $this->input->post("description"),
            'status' => 1
        );
        $data = $this->Property_amenities_model->registrar($data);
        //echo json_encode($data);
        if($data){
            redirect('property_amenities/by/'.$pID, 'location');
        }
    }
    public function update(){
        $pID = $this->input->post("property_id");
        $id = $this->input->post("property_amenities_id");
        $data = array(
            'property_id' => $this->input->post("property_id"),
            'name' => $this->input->post("name"),
            'description' => $this->input->post("description"),
        );
        $this->Property_amenities_model->updatear($id, $data);
        redirect('property_amenities/by/'.$pID, 'location');
    }   

    public function by($id) {        
        //$data = $this->Property_amenities_model->listar($id);//AQUI
        //echo json_encode($data);
        $data['titulo'] = 'Amenities';
        $data['result'] = $this->Property_amenities_model->lista($id);
        $data['fields'] = $this->Property_amenities_model->columnas();
        //echo json_encode($data);
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

}