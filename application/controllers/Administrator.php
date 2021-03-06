<?php
    //session_start();

    class Administrator extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Administrator_model');
        $this->load->model('Property_model');
        $this->load->model('Client_model');
        $this->load->model('Transaction_model');
    }

    public function index(){

        //seguridad 
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');

        $data['visitor'] = $this->Client_model->paises();
        $data['visits'] = $this->Client_model->cantidaddevistas();
        $data['properties'] = $this->Property_model->gps();
        $data['sales'] = $this->Transaction_model->ventas();
        /* CONTADORES */
        /*
        $data['unidades'] = $this->Transaction_model->unidades();
        $result = $this->Transaction_model->unidades();
        $n=0; $af=0; $re=0; $s=0; $t=0;
        foreach($result as $r) {
            $n +=$r['none'];
            $af +=$r['available']+$r['free'];
            $re +=$r['reserved'];
            $s +=$r['sold'];
            $t +=$r['total'];
        }
        $data['dash_none']=$n;
        $data['dash_available']=$af;
        $data['dash_reserved']=$re;
        $data['dash_sold']=$s;
        $data['dash_total']=$t;*/

        switch ($this->session->userdata('level')) {
            case '0':
                $data['title']="Dashboard General";
                $data['manyfree'] = $this->Property_model->disponibles()->total;
                $data['howmanysold'] = $this->Property_model->vendidas()->total;
                $data['howmuch'] = number_format((float)$this->Property_model->dinero()->total/1000000, 2, '.', '');
                $data['visitors'] = $this->Client_model->contar();
                $data['property'] = $this->Property_model->portada();

                // main
                $this->load->view('pages/home', $data);
            break;

            case '1':
                $id = $this->session->userdata('property_id');
                $data['result'] = $this->Property_model->ver($id);
                // added to session
                $this->session->set_userdata('property_id', $data['result']['property_id']);
                $this->session->set_userdata('project', $data['result']['name']);

                $data['manyfree'] = $this->Property_model->disponibles()->total;
                $data['howmanysold'] = $this->Property_model->vendidas()->total;
                $data['howmuch'] = number_format((float)$this->Property_model->dinero()->total/1000000, 2, '.', '');
                $data['visitors'] = $this->Client_model->contar();
                $data['property'] = $this->Property_model->portada();
                $data['title']=$data['property'][0]['name'];

                // vista!
                $this->load->view('pages/dashboard', $data);
            break;

            case '2':
                $id = $this->session->userdata('property_id');
                $data['result'] = $this->Property_model->ver($id);

                // added to session
                $this->session->set_userdata('property_id', $data['result']['property_id']);
                $this->session->set_userdata('project', $data['result']['name']);

                $data['features'] = $this->Property_model->caracteristicas($id);
                $data['photos'] = $this->Property_model->fotos($id);
                $data['free'] = $this->Property_model->departamentosdisponibles($id);

                // vista!
                $this->load->view('pages/propiedad', $data);
            break;
            
            default:
                redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso&dash='.time(), 'refresh');
            break;
        }
    
        // footer
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL){
        $data = $this->Administrator_model->listar($slug);
    }

    public function all($id = NULL){
        //$data['news'] = $this->Administrator_model->get_news();
        //echo json_encode($data);

        $data['property_id'] = $this->session->userdata('property_id');
        $data['result'] = $this->Administrator_model->filtrar($id);
        $data['fields'] = $this->Administrator_model->columnas();
        $data['property'] = $this->Property_model->listar();


        if($id==2){
            $data['titulo'] = 'Brokers';
        } else if($id==1){
            $data['titulo'] = 'Projects Managers';
        } else {
            $data['titulo'] = 'Administradores';
        }

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
        $property_id = $this->session->userdata('property_id');
        $data['fields'] = $this->Administrator_model->columnas();
        $data['tables'] = $this->Property_model->listar(); // <-- Linea 79 / formulario.php
        $data['property_id'] = $this->session->userdata('property_id');
        //$data['fieldsmore'] = $this->Administrator_model->property_broker();
        //$data['fieldsothers'] = $this->Administrator_model->listar();
        
        if($action){
            $data['action']="edit";// acction
            $data['btn']="Editar registro";// Texto boton
            $data['result'] = $this->Administrator_model->listar($id);

        } else {
            $data['action']="new";// acction
            $data['btn']="Agregar nuevo";// Texto boton
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

    public function project($id) {

        //seguridad 
        $this->load->view('templates/secure');
        // header
        $this->load->view('templates/header');
        // sidebar
        $this->load->view('templates/menu');

        $data['manyfree'] = $this->Property_model->disponibles()->total;
        $data['howmanysold'] = $this->Property_model->vendidas()->total;
        $data['howmuch'] = number_format((float)$this->Property_model->dinero()->total/1000000, 2, '.', '');
        $data['visitors'] = $this->Client_model->contar();
        $data['property'] = $this->Property_model->portada($id);

        $data['visitor'] = $this->Client_model->paises();
        $data['visits'] = $this->Client_model->cantidaddevistas();
        $data['properties'] = $this->Property_model->gps();
        $data['sales'] = $this->Transaction_model->ventas();

        $data['title']=@$data['property'][0]['name'];
        // main
        $this->load->view('pages/dashboard', $data);

        // footer
        $this->load->view('templates/footer');
    }

    public function delete($id){
        $this->Administrator_model->deletear($id);
         redirect('administrator/', 'location', 302);
    }
    public function add(){
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
            'email' => $this->input->post("email"),
            'password' => md5($this->input->post("password")),
            'city' =>$this->input->post("city"),
            'country' => $this->input->post("country"),
            'level' => $this->input->post("level"),
            'property_id' => $this->input->post("property_id"),
            'status' => 1
        );
        $data = $this->Administrator_model->registrar($data);
        //echo json_encode($data);
        if($data){
            $query = $this->db->query("INSERT INTO property_broker (property_id,broker_id) VALUES (".$this->input->post("property_id").",".$data.")");

            redirect('administrator/', 'location');
        }
    }
    public function update(){
        $id = $this->input->post("administrator_id");
        $data = array(
            'firstname' => $this->input->post("firstname"),
            'lastname' => $this->input->post("lastname"),
            'email' => $this->input->post("email"),
            'city' => $this->input->post("city"),
            'country' => $this->input->post("country"),
            'level' => $this->input->post("level"),
            'property_id' => $this->input->post("property_id"),
        );
        if($this->input->post("password")!=''){
            $data['password'] = md5($this->input->post("password"));
        }
        $this->Administrator_model->updatear($id, $data);
        if($this->input->post("property_id")==2){
            redirect('site/logout', 'location');
        } else {
            redirect('administrator/', 'location');
        }
    }

    public function getCountries(){
        $data['visitor'] = $this->Client_model->paises();
        $data['properties'] = $this->Property_model->gps();
        echo json_encode($data);
    }

}