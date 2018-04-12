<?php
/**
 * Created by PhpStorm.
 * User: Arthur Castro
 * Date: 27/03/2018
 * Time: 21:30
 */

class Table_model extends CI_Model {

    private $ativos;
    private $confrontos;
    private $rodada;

    public function __construct(){
        $this->load->model('CodeTest_model', 'code_model');
        $this->load->model('Exercises_model', 'exercises_model');
        $this->load->model('Users_model', 'users');

        $users = $this->users->openFile();

        foreach ($users as $user){
            if ($user['atividade'] and $user['equipe'] != 'ifc'){
                $this->ativos[] = $user;
            }
        }

        $this->rodada = count($this->exercises_model->openFile());

        $this->getGames();
    }

    public function openFile(): array {
        return json_decode(file_get_contents(APPDATA_PATH.'table.json'), true);
    }

    private function users_activeSemConf(){
        $semConf = [];


        foreach ($this->ativos as $ativ){
            $verificaSemConf = true;
            foreach ($this->confrontos as $conf){
                if ($ativ['id'] == $conf[0]['id'] or $ativ['id'] == $conf[1]['id']){
                    $verificaSemConf = false;
                    break;
                }
            }
            if ($verificaSemConf){
                $semConf[] = $ativ;
            }
        }

        return $semConf;
    }

    private function getGames(){

        $this->confrontos = [];

        $countAtivos = count($this->ativos);
        $verifica = [
            'confrontos' => true,
            'while'      => true,
            'semConf1'    => false,
            'semConf2'    => false,
            'equipe'         => true
        ];


        $semConf = $this->users_activeSemConf();
        while (count($semConf) > 1){

            $i = $countAtivos -1;

            foreach ($this->ativos as $user){


                $verifica['semConf1'] = false;
                $verifica['semConf2'] = false;

                foreach ($semConf as $sconf){
                    if ($sconf['id'] == $user['id']){
                        $verifica['semConf1'] = true;
                    }

                    if ($this->ativos[$i]['id'] == $sconf['id']){
                        $verifica['semConf2'] = true;
                    }
                }

                if ($user['id'] != $this->ativos[$i]['id'] and $verifica['semConf1'] and $verifica['semConf2']){

                    if ($user['equipe'] == $this->ativos[$i]['equipe']){
                        if ($countAtivos > 2){

                            foreach ($semConf as $sc){
                                if ($sc['equipe'] != $user['equipe']){
                                    $this->confrontos[] = [$sc, $user];
                                    $verifica['equipe'] = false;
                                }
                            }

                            if ($verifica['equipe']){
                                $j = 0;
                                while ($verifica['while']){
                                    $sorteado = rand(0, count($this->confrontos) - 1);

                                    if ($this->confrontos[$sorteado][0]['equipe'] != $user['equipe'] and $this->confrontos[$sorteado][1]['equipe'] != $this->ativos[$i]['equipe']){
                                        $this->confrontos[$sorteado] = [$this->confrontos[$sorteado][0], $user];
                                        $this->confrontos[] = [$this->confrontos[$sorteado][1], $this->ativos[$i]];

                                        $newSF = [];
                                        foreach ($semConf as $sf){
                                            if ($sf != $this->ativos[$i] and $sf != $user){
                                                $newSF[] = $sf;
                                            }
                                        }

                                        $semConf = $newSF;

                                        $verifica['while'] = false;

                                    } elseif ($this->confrontos[$sorteado][1]['equipe'] != $user['equipe'] and $this->confrontos[$sorteado][0]['equipe'] != $this->ativos[$i]['equipe']){
                                        $this->confrontos[$sorteado] = [$this->confrontos[$sorteado][1], $user];
                                        $this->confrontos[] = [$this->confrontos[$sorteado][0], $this->ativos[$i]];

                                        $newSF = [];
                                        foreach ($semConf as $sf){
                                            if ($sf != $this->ativos[$i] and $sf != $user){
                                                $newSF[] = $sf;
                                            }
                                        }

                                        $semConf = $newSF;

                                        $verifica['while'] = false;
                                    }

                                    if ($j > 10){
                                        $this->confrontos[] = [$this->ativos[$i], $user];

                                        $newSF = [];
                                        foreach ($semConf as $sf){
                                            if ($sf != $this->ativos[$i] and $sf != $user){
                                                $newSF[] = $sf;
                                            }
                                        }

                                        $semConf = $newSF;

                                        $verifica['while'] = false;
                                    }

                                    $j++;
                                }


                            }

                        } else {
                            $this->confrontos[] = [$this->ativos[$i], $user];

                            $newSF = [];
                            foreach ($semConf as $sf){
                                if ($sf != $this->ativos[$i] and $sf != $user){
                                    $newSF[] = $sf;
                                }
                            }

                            $semConf = $newSF;
                        }

                    } else {
                        $this->confrontos[] = [$this->ativos[$i], $user];

                        $newSF = [];
                        foreach ($semConf as $sf){
                            if ($sf != $this->ativos[$i] and $sf != $user){
                                $newSF[] = $sf;
                            }
                        }

                        $semConf = $newSF;
                    }
                }

                $i--;
            }
            $semConf = $this->users_activeSemConf();
        }



    }

    public function getTable()
    {
        $rodadas = $this->openFile();

        $chave = count($rodadas) + 1;

        $rodadas["rodada" . $chave] = $this->confrontos;

        $salveFile = json_encode($rodadas, JSON_PRETTY_PRINT);                                      //Transforma um array em um tipo json
        file_put_contents(APPDATA_PATH . "table.json", $salveFile);
    }

    /**
     * @return mixed
     */
    public function getConfrontos()
    {
        //$this->getTable();
        return $this->confrontos;


    }
}