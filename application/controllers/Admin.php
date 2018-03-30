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

    public function edit_exercise(){
        $exercise  = $this->exercises_model->getExerciseById($_GET['id']);

        $edit_exercise['id_exercise'] = $exercise['id_exercise'];
        $edit_exercise['func_name']   = $_POST['func_name'];
        $edit_exercise['exercise']    = $_POST['exercise'];
        $edit_exercise['inputs']      = $_POST['inputs'];
        $edit_exercise['expecteds']   = $_POST['expecteds'];
        $edit_exercise['deadline']    = $_POST['deadline'] * 60;
        $edit_exercise['status']      = $_POST['status'];
        $edit_exercise['fight']       = $exercise['fight'];
        $edit_exercise['description'] = $_POST['description'];

        print_r($edit_exercise);

        $this->exercises_model->edit_exercise($edit_exercise);


        redirect (base_url('/admin'));
    }

    public function add_exercise_view(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/exercice', $data);
        $this->load->view('footer', $data);


        $this->load->view('admin/add_exercice', $data);
    }
}