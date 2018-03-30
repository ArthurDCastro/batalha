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

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/exercice', $data);
        $this->load->view('footer', $data);
    }

    public function edit_exercise_view(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();

        $exercise  = $this->exercises_model->getExerciseById($_GET['id']);
        $exercise['inputs'] = $this->exercises_model->convert_array_str($exercise['inputs']);
        $exercise['expecteds'] = $this->exercises_model->convert_array_str($exercise['expecteds']);

        $data['exercise'] = $exercise;

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/exercice', $data);
        $this->load->view('footer', $data);


        $this->load->view('admin/edit_exercice', $data);

    }
}