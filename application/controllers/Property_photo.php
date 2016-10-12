<?php
    class Property_photo extends CI_Controller {//AQUI

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Property_photo_model');//AQUI
        $this->load->model('Property_model');
        $this->load->helper('html');
    }

    public function index() {        
        redirect('property/all', 'location', 302);
    }

    public function all() {        
        redirect('property/all', 'location', 302);
    }
    /* FORMULARIOS */
    public function action($action = NULL, $id = NULL){
        $data['model'] = "property_photo";
        $data['fields'] = $this->Property_photo_model->columnas();
        $data['tables'] = $this->Property_model->listar();//<-- Linea 79 / formulario.php
        $data['result'] = $this->Property_photo_model->listar($id);

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
    public function by($id) {        
        $data['titulo'] = 'Fotografias';
        $data['result'] = $this->Property_photo_model->lista($id);
        $data['fields'] = $this->Property_photo_model->columnas();

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
    public function upload() {
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;
        $this->load->library('upload', $config);

        $id = $this->input->post("property_id");

        if ( ! $this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            redirect('property_photo/action/upload/?msg='.$error, 'resfresh', 302);
            //echo json_encode($error);
        } else  {
            $added = array(
                'file' => $this->upload->data('file_name'),
                'property_id' => $this->input->post("property_id"),
                'notes' => $this->input->post("notes"),
            );
            $data = $this->Property_photo_model->subir_y_agregar($added);
            //echo json_encode($data);
            redirect('property/see/'.$id, 'location', 302);
        }
    }

    public function delete($id){
        $this->Property_photo_model->deletear($id);
         redirect('property_photo/all', 'location', 302);
    }
    public function add(){
        redirect('property_photo/upload', 'location', 302);
    }
    public function update(){
        $id = $this->input->post("property_photo_id");
        $data = array(
            'property_photo_id' => $this->input->post("property_photo_id"),
            'property_id' => $this->input->post("property_id"),
            'notes' => $this->input->post("notes"),
        );
        $this->Property_photo_model->updatear($id, $data);
        redirect('property_photo/all', 'location');
        //echo json_encode($data);
        //echo json_encode($id);
    }

}