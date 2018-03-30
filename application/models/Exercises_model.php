<?php

/**
 * Created by PhpStorm.
 * User: jefferson
 * Date: 30/05/17
 * Time: 13:13
 */

class Exercises_model extends CI_Model {

    private function openFile(): array {
        return json_decode(file_get_contents(APPDATA_PATH.'exercises.json'), true);
    }

    public function getExercise(string $exerciseParam){

        foreach ($this->openFile() as $exercise){
            if ($exercise['func_name'] == $exerciseParam){
                return $exercise;
            }
        }

        return false;
    }

    public function getExerciseById(string $exercise_id){

        foreach ($this->openFile() as $exercise){
            if ($exercise['id_exercise'] == $exercise_id){
                return $exercise;
            }
        }

        return false;
    }

    public function getAllExercises(){
        return $this->openFile();
    }

    public function saveSolvedExercise(int $id_exercise, array $results){

        $user_id = $this->session->userdata('user_id');

        $solvedsData = json_decode(file_get_contents(APPDATA_PATH.'solveds.json'), true);

        foreach ($solvedsData as $key => $solved){
            if($solved['id_user'] == $user_id && $solved['id_exercise'] == $id_exercise){
                unset($solvedsData[$key]);
            }
        }

        $solvedsData = array_values($solvedsData);

        $preparedData = [
            "id_solveds"   => uniqid(),
            "id_user"      => $user_id,
            "id_exercise"  => $id_exercise,
            "test_cases"   => $results[3],
            "test_solveds" => $results[4],
            "submitted_on" => time()
        ];

        if (array_push($solvedsData, $preparedData)){
            file_put_contents(APPDATA_PATH.'solveds.json', json_encode($solvedsData, JSON_PRETTY_PRINT));
            return $this->getSolvedExercise($id_exercise);
        }

        return false;
    }

    public function get_all_solveds_exercises(){
        return json_decode(file_get_contents(APPDATA_PATH.'solveds.json'), true);
    }

    public function getSolvedExercise(string $exercise_id){

        foreach ($this->get_all_solveds_exercises() as $solved){
            if ($solved['id_exercise'] == $exercise_id && $solved['id_user'] == $this->session->userdata('user_id')){
                return $solved;
            }
        }

        return false;
    }

    public function testCaseMessage(string $exercise_id){

        $solveds = $this->getSolvedExercise($exercise_id);

        if ($solveds !== false){
            return ['message' => $solveds['test_solveds']."/".$solveds['test_cases'], 'date'=> date('d/m/Y H:m', $solveds['submitted_on'])];
        } else {
            return ['message' => "0/".count($this->getExerciseById($exercise_id)['inputs']), 'date'=> false];
        }
    }

    public function ranking(){

        $ranking = array();

        foreach($this->get_all_solveds_exercises() as $solveds) {
            $id = $solveds['id_user'];

            if (!isset($ranking[$id])) {
                $ranking[$id]['pts']          = round(($solveds['test_solveds'] / $solveds['test_cases']) * 10);
                $ranking[$id]['test_cases']   = $solveds['test_cases'];
                $ranking[$id]['test_solveds'] = $solveds['test_solveds'];
                $ranking[$id]['solveds']      = 1;
            } else {
                $ranking[$id]['pts'] += round(($solveds['test_solveds'] / $solveds['test_cases']) * 10);
                $ranking[$id]['test_cases']   += $solveds['test_cases'];
                $ranking[$id]['test_solveds'] += $solveds['test_solveds'];
                $ranking[$id]['solveds'] ++;
            }

            $ranking[$id]['id'] = $id;

        }

        rsort($ranking);
        return $ranking;

    }

    public function get_user_ranking($user_id){

        $ranking = $this->ranking();

        foreach ($ranking as $key => $rank){

            if ($rank['id'] == $user_id){
                return array_merge($rank, ['pos'=> $key + 1]);
            }
        }

        return false;

    }


    public function convert_str_array($str){
        $str = 'array(' . $str . ')';

        $return = '';

        eval('$return ='. $str . ';');

        return $return;
    }

    public function add_exercise(array $new_exercise){
        $file = $this->openFile();

        $file[] = $new_exercise;

        $salveFile = json_encode($file, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH."exercises.json", $salveFile);
    }

    public function remove_exercise($id){

        $file = $this->openFile();

        $newFile = [];

        foreach ($file as $exercise){
            if ($exercise['id_exercise'] != $id){
                $newFile[] = $exercise;
            }
        }

        $salveFile = json_encode($newFile, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH."exercises.json", $salveFile);
    }

    public function edit_exercise(array $edit_exercise){
        $file = $this->openFile();

        foreach ($file as $key => $exercise){
            if ($exercise['id_exercise'] == $edit_exercise['id_exercise']){
                $file[$key] = $edit_exercise;
            }
        }

        $salveFile = json_encode($file, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH."exercises.json", $salveFile);
    }

}