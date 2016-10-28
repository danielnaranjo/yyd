<?php
    class Client extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_model');//AQUI
        $this->load->model('Client_info_model');//AQUI
        $this->load->model('Property_model');//AQUI
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
        
        if($this->session->userdata('level')==0){
            $data['fields'] = $this->Client_model->columnaspersonalizadas();
            $data['result'] = $this->Client_model->compradores();
            $data['property'] = $this->Property_model->listar();
        } else {
            $data['fields'] = $this->Client_model->columnas();
            $data['result'] = $this->Client_model->completo();
            $nombreamostrar="";
        }
        if($this->session->userdata('project')==''){
            $nombreamostrar="Vista general";
        } else {
            $nombreamostrar=$this->session->userdata('project');
        }
        $data['titulo'] = $nombreamostrar.' > Compradores';

        //$data['fields'] = $this->Client_model->columnaspersonalizadas();
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
            'country' => $this->input->post("country"),
            'status' => 0
        );
        $resp = $this->Client_model->registrar($data);
        //echo json_encode($resp);
        if($resp){
            $data = array(
                'client_id' => $resp,
                'property_id' => $this->session->userdata('property_id'),
            );
            $passed = $this->Client_model->enlazar($data);
            //echo json_encode($passed);
            redirect('client/all', 'location');
        }
    }

    public function update(){
        $id = $this->input->post("client_id");
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
            'country' => $this->input->post("country"),
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

    public function results(){

        $q = $this->input->post("q");

        $data['titulo'] = 'Resultados: "'.strtoupper($this->input->post("q")).'" ';
        $data['result'] = $this->Client_model->resultados($q);
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


    public function create(){
        $data['paises'] = $this->Client_model->listadepaises();
        $data['titulo'] = 'Nuevo comprador';
        $data['ejecutar'] ="created";
        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('forms/clientes', $data);
        // footer
        $this->load->view('templates/footer');
        
    }

    public function created(){
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
            'country' => $this->input->post("country")        );
        $resp = $this->Client_model->nuevo($data);
        //echo json_encode($resp);

        if($resp){
            /* marca la visita */
            $data = array(
                'client_id' => $resp,
                'property_id' => $this->session->userdata('property_id'),
            );
            $passed = $this->Client_model->enlazar($data);

            /* client_info y cliente */
            $resp_info = $this->Client_info_model->populateforms($resp);
            $id = $resp_info['client_info_id'];
            $datainfo = array(
                'email' => $this->input->post("email"),
                'address' => $this->input->post("address"),
                'city' => $this->input->post("city"),
                'country' => $this->input->post("country"),
                'phone' => $this->input->post("phone"),
            );
            $resp_update = $this->Client_info_model->updatear($id, $datainfo);

            redirect('client/all', 'location');
            /*echo json_encode($resp);
            echo json_encode($resp_info);
            echo json_encode($resp_update);*/
        }
    }

    public function edit($id){
        $data['paises'] = $this->Client_model->listadepaises();
        $data['titulo'] = 'Editar comprador';
        $data['ejecutar'] ="edited";
        $data['result'] = $this->Client_model->mostrar($id);
        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('forms/clientes', $data);
        // footer
        $this->load->view('templates/footer');
        
    }

    public function edited(){
        $id = $this->input->post("client_id");
        $idinfo = $this->input->post("client_info_id");
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
            'country' => $this->input->post("country")        
        );
        $resp = $this->Client_model->updatear($id, $data);
        $datainfo = array(
            'email' => $this->input->post("email"),
            'address' => $this->input->post("address"),
            'city' => $this->input->post("city"),
            'country' => $this->input->post("country"),
            'phone' => $this->input->post("phone"),
        );
        $resp_update = $this->Client_info_model->updatear($idinfo, $datainfo);
        redirect('client/all', 'location');
    }

}