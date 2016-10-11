<?php
    //session_start();

    class Administrator extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //$this->load->library('session');
        $this->load->model('Administrator_model');
        $this->load->model('Property_model');
        $this->load->model('Client_model');
        //$this->load->helper('url_helper');
        //$this->load->helper('url');
    }

    public function index(){

        //seguridad 
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');

        switch ($this->session->userdata('level')) {
            case '0':
                $data['title']="Dashboard General";
                $data['manyfree'] = $this->Property_model->disponibles()->total;
                $data['howmanysold'] = $this->Property_model->vendidas()->total;
                $data['howmuch'] = number_format((float)$this->Property_model->dinero()->total/1000000, 2, '.', '');
                $data['visitors'] = $this->Client_model->contar();
                $data['property'] = $this->Property_model->portada();

                // main
                $this->load->view('pages/dashboard', $data);
            break;

            case '1':
                $data['manyfree'] = $this->Property_model->disponibles()->total;
                $data['howmanysold'] = $this->Property_model->vendidas()->total;
                $data['howmuch'] = number_format((float)$this->Property_model->dinero()->total/1000000, 2, '.', '');
                $data['visitors'] = $this->Client_model->contar();
                $data['property'] = $this->Property_model->portada();
                $data['title']=$data['property'][0]['name'];

                $id = $this->session->userdata('property_id');
                $data['result'] = $this->Property_model->ver($id);
                // added to session
                $this->session->set_userdata('property_id', $data['result']['property_id']);
                $this->session->set_userdata('project', $data['result']['name']);
                // vista!
                $this->load->view('pages/dashboard', $data);
            break;

            case '2':
                $id = $this->session->userdata('property_id');
                
                $data['result'] = $this->Property_model->ver($id);
                $data['features'] = $this->Property_model->caracteristicas($id);
                $data['photos'] = $this->Property_model->fotos($id);
                $data['free'] = $this->Property_model->departamentosdisponibles($id);
                // added to session
                $this->session->set_userdata('property_id', $data['result']['property_id']);
                $this->session->set_userdata('project', $data['result']['name']);
                // vista!
                $this->load->view('pages/propiedad', $data);
            break;
            
            default:
               //
            break;
        }
    
        // footer
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL){
        $data = $this->Administrator_model->listar($slug);
    }

    public function all(){
        //$data['news'] = $this->Administrator_model->get_news();
        //echo json_encode($data);

        $data['titulo'] = 'Administradores & Usuarios';
        $data['result'] = $this->Administrator_model->listar();
        $data['fields'] = $this->Administrator_model->columnas();

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
        //$data['model'] = "administrator";
        $data['fields'] = $this->Administrator_model->columnas();
        //$this->load->view('forms/general', $data);// test purpose
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Administrator_model->listar($id);

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

}