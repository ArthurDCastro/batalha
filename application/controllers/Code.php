<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code extends CI_Controller {

    private $exercise;
    private $userId;

    public function __construct() {
        parent::__construct();

        $this->load->model('CodeTest_model', 'code_model');
        $this->load->model('Exercises_model', 'exercises_model');
        $this->load->model('Users_model', 'users');

        if (!$this->users->is_logged_in())
            redirect(base_url('users/login'));
    }

    public function index() {

        $data['user'] = $this->users->get_logged_user();

        $data['ranking'] =  $this->exercises_model->get_user_ranking($data['user']['id']);

        $exercises = $this->exercises_model->getAllExercises();
        foreach ($exercises as $key => $exercise){
            $exercises[$key]['solved'] = $this->exercises_model->testCaseMessage($exercise['id_exercise']);
        }

        $data['exercises'] = $exercises;

		$this->load->view('exercises', $data);
	}

	public function loadExercise(string $name = null){

        if ($name == null)
            redirect (base_url());

        return $this->exercises_model->getExercise($name);
    }

	public function exercicio($name = null){

	    if ($name == null)
            redirect (base_url());

        $data['user'] = $this->users->get_logged_user();

        $data['exercise'] = $this->loadExercise($name);
        $data['solved'] = $this->exercises_model->testCaseMessage($data['exercise']['id_exercise']);
        $this->load->view('submit_code', $data);
    }

    public function upload($name = null){

        $exercise       = $this->loadExercise($name);
        $data['solved'] = $this->exercises_model->testCaseMessage($exercise['id_exercise']);
        $data['user'] = $this->users->get_logged_user();


        $user_folder = $this->session->userdata('username');
        $path        = SUBMITS_FOLDER.$user_folder;
        $data['exercise'] = $exercise;

        if ( ! is_dir($path)) {
            mkdir($path, 0777, $recursive = true);
        }

        $config['upload_path']   = SUBMITS_FOLDER.$user_folder;
        $config['allowed_types'] = 'php';
        $config['overwrite']     = true;
        $config['file_name']     = $exercise['func_name'];

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('file')) {
            $data['errors']   = $this->upload->display_errors();
            $data['errors']   = "ou você nao selecionou um aquivo ou o prazo de envio do exercício se esgotou.";

            $this->load->view('submit_code',$data);

        } else  {

            $fileData  = $this->upload->data();
            $hasErrors = $this->code_model->getSyntaxErrors(SUBMITS_PATH.$user_folder."/".$fileData['file_name']);

            if (!$hasErrors){

                $results = $this->code_model->getFunctionResults($user_folder, $exercise['func_name'], $exercise['inputs']);

                $results = $this->code_model->verifyResults($exercise['inputs'], $exercise['expecteds'], $results);

                $this->exercises_model->saveSolvedExercise($exercise['id_exercise'], $results);

                $data['results'] = $results;
                $data['solved'] = $this->exercises_model->testCaseMessage($exercise['id_exercise']);
                $this->load->view('submit_code',$data);


            } else {
                $data['errors']     = $hasErrors[1];
                $this->load->view('submit_code',$data);
            }
        }
    }

    // Método que fará o download do arquivo
    public function download(){

        // recuperamos o segundo segmento da url, que é o diretório
        $user_folder = $this->uri->segment(2);

        // recuperamos o terceiro segmento da url, que é o nome do arquivo
        $arquivo = $this->uri->segment(3);

        // definimos original path do arquivo
        $arquivoPath = './users_submitteds_codes/'.$user_folder."/".$arquivo;

        // forçamos o download no browser
        // passando como parâmetro o path original do arquivo
        force_download($arquivoPath,null);
    }

}
