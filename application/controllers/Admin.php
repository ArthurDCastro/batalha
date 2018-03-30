<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Exercises_model', 'exercises_model');
        $this->load->model('Users_model', 'users');
    }

    public function index(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();
        $this->load->helper('date');
        
        $this->load->view('admin', $data);
        $this->load->view('admin_exercice', $data);
        $this->load->view('footer', $data);
    }
}