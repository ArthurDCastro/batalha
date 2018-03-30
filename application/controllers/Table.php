<?php
/**
 * Created by PhpStorm.
 * User: Arthur Castro
 * Date: 27/03/2018
 * Time: 21:11
 */

class Table extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Exercises_model', 'exercises_model');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('Table_model', 'table_model');

    }

    public function index()
    {

        $data['table'] = $this->table_model->getConfrontos();

        $this->load->view('teste', $data);


    }

}