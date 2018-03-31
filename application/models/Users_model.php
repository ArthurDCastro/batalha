<?php

/**
 * Created by PhpStorm.
 * User: jefferson
 * Date: 01/06/17
 * Time: 21:40
 */
class Users_model extends CI_Model {

    protected $userid;

    public function __construct() {
        $this->userid = $this->session->userdata('user_id');
    }

    protected function openFile(): array {
        return json_decode(file_get_contents(APPDATA_PATH.'users.json'), true);
    }


    public function getAllUsers(){
        return $this->openFile();
    }

    public function getRows($username, $password){

        foreach ($this->openFile() as $user){

            if ($user['username'] == $username && $user['password'] == $password){
                return $user;
            }
        }

        return false;
    }

    public function get_user_by_id($user_id){

        foreach ($this->openFile() as $user){

            if ($user['id'] == $user_id){
                return $user;
            }
        }

        return false;
    }

    public function get_logged_user(){

        foreach ($this->openFile() as $user){

            if ($user['id'] == $this->userid){
                return $user;
            }
        }

        return false;
    }

    public function is_logged_in(){
        //Caso nao esteja logado é redirecionado para o login
        if($this->session->userdata('is_logged_in'))
            return true;

        return false;
    }

    public function add_user(array $new_user){
        $file = $this->openFile();

        $file[] = $new_user;

        $salveFile = json_encode($file, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH."users.json", $salveFile);
    }

    public function remove_user($id){
        $file = $this->openFile();

        $newFile = [];

        foreach ($file as $user){
            if ($user['id'] != $id){
                $newFile[] = $user;
            }
        }

        $salveFile = json_encode($newFile, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH."data/users.json", $salveFile);
    }

    public function edit_user(array $edit_user){
        $file = $this->openFile();

        foreach ($file as $key => $user){
            if ($user['id'] == $edit_user['id']){
                $file[$key] = $edit_user;
            }
        }

        $salveFile = json_encode($file, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH."data/users.json", $salveFile);
    }


}