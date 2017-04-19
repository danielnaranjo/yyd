<?php
                    class Company extends CI_Controller {

                        public function __construct() {
                            parent::__construct();
                            $this->load->model('Company_model');
                        }
                        public function index($id=FALSE){
                            $data = $this->Company_model->listar($id);//AQUI
                            echo json_encode($data);
                        } //index
                        public function add(){
                            $data = $this->Company_model->registrar($this->input->post(NULL, TRUE));
                            if($data){
                                echo json_encode($data);
                            }
                        } //add
                        public function delete($id){
                            $data = $this->Company_model->deletear($id);
                            echo json_encode($data);
                        } //delete
                        public function update(){
                            $id = $this->input->post($this->uri->segment(1).'_id');

                            $res = $this->Company_model->updatear($id, $this->input->post(NULL, TRUE));
                            echo json_encode($res);
                        } //update
                        public function all(){
                            $data['titulo'] = 'Comentarios';
                            $data['result'] = $this->Company_model->listar();
                            $data['fields'] = $this->Company_model->columnas();
                            $this->load->view('templates/secure');
                            $this->load->view('templates/header');
                            $this->load->view('templates/menu');
                            $this->load->view('pages/magic', $data);
                            $this->load->view('templates/footer');
                        }
                    } //controller
