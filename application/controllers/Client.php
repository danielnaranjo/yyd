<?php
    class Client extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');//AQUI
        $this->load->model('Client_info_model');//AQUI
    }

    public function index()
    {        
        //$data = $this->Client_model->listar();//AQUI
        //echo json_encode($data);
        $data['titulo'] = 'Compradores';
        $data['result'] = $this->Client_model->listar();

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

    public function view($slug = NULL)
    {
        $data = $this->Client_model->listar($slug);//AQUI
    }

    public function all(){

        $data['titulo'] = 'Compradores';
        $data['result'] = $this->Client_model->completo();
        $data['fields'] = $this->Client_model->columnas();

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
    public function count()
    {        
        $data = $this->Client_model->contar();//AQUI
        echo json_encode($data);
    }

    public function visitors(){

        $data['titulo'] = 'Visitantes';
        $data['result'] = $this->Client_model->visitantes();
        $data['fields'] = $this->Client_model->columnas();

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

    public function profile($id = NULL) {
        $data['result'] = $this->Client_model->perfil($id);//AQUI
        $data['info'] = $this->Client_info_model->perfil($id);//AQUI
        $data['visits'] = $this->Client_info_model->visita($id);//AQUI
        $data['transactions'] = $this->Client_info_model->transacciones($id);//AQUI
        $data['property'] = $this->Client_info_model->propiedad($id);
        $data['total'] = $this->Client_info_model->montototal($id);
        $data['unity'] = $this->Client_info_model->compra($id);
        $data['parking'] = $this->Client_info_model->parkeo($id);
        $data['notes'] = $this->Client_info_model->notas($id);

        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/cliente', $data);
        // footer
        $this->load->view('templates/footer');
    }

    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        //$data['model'] = "client";
        $data['fields'] = $this->Client_model->columnas();
        $data['fieldsmore'] = $this->Client_info_model->columnas();
        $data['tables'] = ""; // <-- Linea 79 / formulario.php
        
        if($action=='edit'){
            //$data['action']="edit";// acction
            //$data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Client_model->listar($id);
            $data['resultmore'] = $this->Client_info_model->populateforms($id);

        } else {
            //$data['action']="new";// acction
            //$data['btn']="Agregar nuevo";// Texto boton
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
        $this->Client_model->deletear($id);
         redirect('client/all', 'location', 302);
    }

    public function add(){
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
            //'registered' => $this->input->post("registered"),
            'status' => 0
        );
        $data = $this->Client_model->registrar($data);
        //echo json_encode($data);
        if($data){
            redirect('client/all', 'location');
        }
    }

    public function update(){
        $id = $this->input->post("client_id");
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
        );
        $this->Client_model->updatear($id, $data);
        redirect('client/all', 'location');
    }

    public function visited(){
        $data = array(
            'client_id' => $this->input->post("client_id"),
            'property_id' => $this->input->post("property_id"),
        );
        $result = $this->Client_info_model->marcarvisita($data);
        echo json_encode($data);
    }

}