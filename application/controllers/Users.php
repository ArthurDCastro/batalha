<?php

/**
 * Created by PhpStorm.
 * User: jefferson
 * Date: 01/06/17
 * Time: 21:29
 */

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Users_model','user');
    }

    public function login(){

        $this->load->library('form_validation');

        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }

        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        if($this->input->post('login_submit')){

            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');

            if ($this->form_validation->run() == true) {

                $checkLogin = $this->user->getRows( $this->input->post('name'),  $this->input->post('password'));

                if($checkLogin){
                    $this->session->set_userdata('is_logged_in',TRUE);
                    $this->session->set_userdata('username',$checkLogin['username']);
                    $this->session->set_userdata('equipe',$checkLogin['equipe']);
                    $this->session->set_userdata('user_id',$checkLogin['id']);
                    redirect(base_url('code'));
                } else{
                    $data['error_msg'] = 'Equipe ou senha inválidas, tente novamente!';
                }
            }
        }

        //load the view
        $this->load->view('login', $data);
    }

    public function logout(){
        $this->session->unset_userdata('is_logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        redirect(base_url('users/login'));
    }
}