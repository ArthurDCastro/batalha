<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Exercises_model', 'exercises_model');
        $this->load->model('Users_model', 'users');
        $this->load->model('Table_model', 'table');


        if (!$this->users->is_logged_in())
            redirect(base_url('users/login'));

    }

    //page index
    public function index(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();
        $data['users'] = $this->users->getAllUsers();
        $data['table'] = $this->table->getTodasTables();
        $data['ativos'] = count($this->table->getAtivos());

        foreach (json_decode(file_get_contents(APPDATA_PATH.'data.json'), true) as $key => $dt){
            $data[$key] = $dt;
        }


        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/inicio', $data);
        $this->load->view('footer', $data);
    }

    //page exercise
    public function exercise(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();
        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/exercise', $data);
        $this->load->view('footer', $data);
    }

    //page users
    public function users(){
        $data['user'] = $this->users->get_logged_user();
        $data['users'] = $this->users->getAllUsers();

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('footer', $data);
    }

    //page editar exercise
    public function edit_exercise_view(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();

        $exercise  = $this->exercises_model->getExerciseById($_GET['id']);

        $data['exercise'] = $exercise;

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/exercise', $data);
        $this->load->view('footer', $data);


        $this->load->view('admin/edit_exercise', $data);

    }

    public function edit_exercise(){
        $exercise  = $this->exercises_model->getExerciseById($_GET['id']);

        $edit_exercise['id_exercise'] = $exercise['id_exercise'];
        $edit_exercise['func_name']   = $_POST['func_name'];
        $edit_exercise['exercise']    = $_POST['exercise'];
        $edit_exercise['nivel']    = $_POST['nivel'];
        $edit_exercise['inputs']      = $exercise['inputs'];
        $edit_exercise['expecteds']   = $exercise['expecteds'];
        $edit_exercise['deadline']    = $_POST['deadline'] * 60;
        $edit_exercise['status']      = $_POST['status'];
        $edit_exercise['fight']       = $exercise['fight'];
        $edit_exercise['description'] = $_POST['description'];

        $this->exercises_model->edit_exercise($edit_exercise);


        redirect (base_url('/admin/exercise'));
    }

    //page add exercise
    public function add_exercise_view(){
        $data['user'] = $this->users->get_logged_user();
        $data['exercises'] = $this->exercises_model->getAllExercises();

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/exercise', $data);
        $this->load->view('footer', $data);


        $this->load->view('admin/add_exercise', $data);
    }

    public function add_exercise(){

        $exercises  = $this->exercises_model->getAllExercises();


        $maior = 0;
        foreach ($exercises as $exer){
            if ($exer['id_exercise'] > $maior){
                $maior = $exer['id_exercise'];
            }
        }

        $edit_exercise['id_exercise'] = $maior + 1;
        $edit_exercise['func_name']   = $_POST['func_name'];
        $edit_exercise['exercise']    = $_POST['exercise'];
        $edit_exercise['nivel']    = $_POST['nivel'];
        $edit_exercise['inputs']      = $this->exercises_model->convert_str_array($_POST['inputs']);
        $edit_exercise['expecteds']   = $this->exercises_model->convert_str_array($_POST['expecteds']);
        $edit_exercise['deadline']    = $_POST['deadline'] * 60;
        $edit_exercise['status']      = $_POST['status'];
        $edit_exercise['fight']       = [];
        $edit_exercise['description'] = $_POST['description'];

        $this->exercises_model->add_exercise($edit_exercise);


        redirect (base_url('/admin/exercise'));
    }

    public function remove_exercise(){

        $this->exercises_model->remove_exercise($_GET['id']);

        redirect (base_url('/admin'));
    }

    //page add user
    public function add_user_view(){
        $data['user'] = $this->users->get_logged_user();
        $data['users'] = $this->users->getAllUsers();

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('footer', $data);


        $this->load->view('admin/add_user', $data);
    }

    public function add_user(){

        $this->users->add_user($_POST);

        redirect (base_url('/admin/users'));
    }

    //page editar user
    public function edit_user_view(){
        $data['user'] = $this->users->get_user_by_id($_GET['id']);
        $data['users'] = $this->users->getAllUsers();

        $this->load->helper('date');

        $this->load->view('admin/admin', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('footer', $data);


        $this->load->view('admin/edit_user', $data);
    }

    public function edit_user(){
        $array = $_POST;

        $array['id'] = $_GET['id'];

        $this->users->edit_user($array);

        redirect (base_url('/admin/users'));
    }

    public function remove_user(){

        $this->users->remove_user($_GET['id']);

        redirect (base_url('/admin/users'));
    }

    public function finalizar_rodada(){

    }

}