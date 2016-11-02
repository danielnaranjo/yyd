<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Administrator_model');
        $this->load->model('Property_model');
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
            'property_id'   => '',
            'property'  => '',
            'project'  => '',
			'logged_in' => FALSE
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['success'] = 'Has salido correctamente!';
        $this->output->delete_cache();
        $this->session->sess_destroy();
        //$this->load->view('site/login', $data);
        redirect(site_url().'?nocache=true&logout='.time(), 'location');
    }

    public function login(){
        $login = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->Administrator_model->logeo($password, $login);
        //echo json_encode($data);

        if($data!=null){
            if($data['property_id']>0) {
                $data['session'] = $this->Property_model->ver($data['property_id']);
            }
        	$newdata = array(
	           'aID'  => $data['administrator_id'],
	           'username'  => $data['email'],
	           'firstname'  => $data['firstname'],
	           'lastname'  => $data['lastname'],
	           'email'     => $data['email'],
	           'level'     => $data['level'],
	           'logged_in' => TRUE
	        );
            
            if($data['property_id']>0) {
                $newdata['property_id'] = $data['session']['property_id'];
                $newdata['property'] = $data['session']['name'];
                $newdata['project'] = $data['session']['name'];  
            } 

			$this->session->set_userdata($newdata);
            redirect('administrator/', 'location', 302);
       	 	//echo json_encode($this->session->userdata());
            //echo json_encode($newdata);

        } else {
        	redirect(site_url().'/site?msg=Por+favor+verifica+los+datos+de+acceso&login='.time(), 'location');
        }
    }

    public function forgot(){
        $login = $this->input->post('username');
        $data = $this->Administrator_model->olvide($login);        
        if($data>0){
            $mydomain = "yydgroup.com";
            $nuevopass = "YYD".date('dmY');

            $this->email->from('no-responder@yydgroup.com', 'YYD Group (webadmin)');
            $this->email->to($login);
            $this->email->cc('info@yydgroup.com');
            $this->email->bcc('soporte@inacayal.com.ar');
            $this->email->subject('Reseteo de password');
            $this->email->message('Tu nuevo password es: '.$nuevopass.' *** NO responder. Este es un mensaje automatico, si Usted no ha realizado esta solicitud, por favor, comuniquese con el administrador del sitio de forma inmediata. *** ');
            $this->email->send();

            $newpass = md5($nuevopass);
            $res = $this->db->query("UPDATE administrator SET password='$newpass' WHERE email='$login' ");
            redirect(site_url().'?msg=Hemos+enviado+un+nuevo+password+por+correo&status=true','location',302);
            //
        } else {
            redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso&status=','location',302);
        }
    }


}
