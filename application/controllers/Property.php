<?php
    class Property extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_model');//AQUI
    }

    public function index()
    {        
        $data = $this->Property_model->listar();//AQUI
        echo json_encode($data);
    }

    public function all(){
        //$data['news'] = $this->Administrator_model->get_news();
        //echo json_encode($data);

        $data['title'] = 'Propiedades';
        $data['result'] = $this->Property_model->listar();
        $data['fields'] = $this->Property_model->columnas();

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

    public function free() {        
        $data = $this->Property_model->disponibles();//AQUI
        echo json_encode($data);
    }

    public function sold() {        
        $data = $this->Property_model->vendidas();//AQUI
        echo json_encode($data);
    }

    public function money() {        
        $data = $this->Property_model->dinero();//AQUI
        echo json_encode($data);
    }

    public function see($id){
        $data['result'] = $this->Property_model->ver($id);
        $data['features'] = $this->Property_model->caracteristicas($id);
        $data['photos'] = $this->Property_model->fotos($id);
        $data['free'] = $this->Property_model->departamentosdisponibles($id);

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/propiedad', $data);
        // footer
        $this->load->view('templates/footer');
    }

    public function unities($id){
        $data['result'] = $this->Property_model->departamentos($id);
        $data['types'] = $this->Property_model->tipos($id);
        //echo json_encode($data);

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/disponibles', $data);
        // footer
        $this->load->view('templates/footer');
    }  

    public function people($id){
        $data['result'] = $this->Property_model->personas($id);
        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/compradores', $data);
        // footer
        $this->load->view('templates/footer');
    } 

    public function visitors($id){
        $data['visits'] = $this->Property_model->visitas($id);
        $data['result'] = $this->Property_model->ver($id);

        //seguridad
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');
        // main
        $this->load->view('pages/compradores', $data);
        // footer
        $this->load->view('templates/footer');
    }  
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        //$data['model'] = "property";
        $data['fields'] = $this->Property_model->columnas();
        //$this->load->view('forms/general', $data);// test purpose
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Property_model->ver($id);

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