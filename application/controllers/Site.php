<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //$this->load->library('session');
		//$this->load->library('form_validation');
        $this->load->model('Administrator_model');
        $this->load->library('email');
    }

	public function index() {
        if ($this->session->userdata('logged_in') == TRUE) {
            redirect('administrator/', 'location', 302);
        }
		$this->load->view('site/login');
	}

	public function logout() {
        $sess_array = array(
			'aID'  => '',
			'username'  => '',
			'firstname'  => '',
			'email'     => '',
			'level'     => '',
			'logged_in' => FALSE
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['success'] = 'Has salido correctamente!';
        $this->load->view('site/login', $data);
        redirect(site_url(), 'location');
    }

    public function login(){
        $login = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->Administrator_model->logeo($password, $login);

        if($data!=null){
        	$newdata = array(
	           'aID'  => $data['administrator_id'],
	           'username'  => $data['email'],
	           'firstname'  => $data['firstname'],
	           'lastname'  => $data['lastname'],
	           'email'     => $data['email'],
	           'level'     => $data['level'],
	           'logged_in' => TRUE
	        );
			$this->session->set_userdata($newdata);
/*
            if($this->session->userdata('level')==1){ // nivel -> broker
        	   redirect('administrator/broker', 'location', 302);
            } else if($this->session->userdata('level')==2){ // nivel -> gerente de proyecto
               redirect('administrator/manager', 'location', 302);
            } else { // nivel -> administrador aka Donald Trump
                redirect('administrator/', 'location', 302);
            }
*/
            redirect('administrator/', 'location', 302);
       	 	//echo json_encode($data);

        } else {
        	redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso', 'location');
        }
    }

    public function forgot(){
        $login = $this->input->post('username');
        $data = $this->Administrator_model->olvide($login);        
        if($data>0){
            $mydomain = "yydgroup.com";
            $nuevopass = "YYD".date('dmY');

            $this->email->from('no-responder@yydgroup.com', 'Webadmin YYD Group');
            $this->email->to($login);

            //$this->email->cc('info@yydgroup.com');
            //$this->email->bcc('soporte@yydgroup.com');

            $this->email->subject('Reseteo de password');
            $this->email->message('Tu nuevo password es: '.$nuevopass);
            $this->email->send();

            redirect(site_url().'?msg=Hemos+enviado+un+nuevo+password+por+correo&status=true','location');
            //
        } else {
            redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso&status=','location');
        }
    }


}
