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
            $ati = (int) $user['atividade'];
            if ($ati and $user['equipe'] != 'ifc'){
                $this->ativos[] = $user;
            }
        }

        $this->rodada = count($this->exercises_model->openFile());

    }

    public function openFile(): array {
        return json_decode(file_get_contents(APPDATA_PATH.'table.json'), true);
    }

    public function getTodasTables(){
        $file = $this->openFile();
        $newTable = [];

        foreach ($file as $rodada){
            $newConfrontos = [];
            foreach ($rodada['confrontos'] as $confronto){
                $confronto['exercicio'] = $this->exercises_model->getExerciseById($confronto['exercicio'])['exercise'];
                $newConfrontos[] = $confronto;
            }
            $rodada['confrontos'] = $newConfrontos;
            $newTable[] = $rodada;
        }
        return $newTable;
    }

    private function add_confronto($user1, $user2){
        return [
            'user1' => [
                'id'             => $user1['id'],
                'equipe'         => $user1['equipe'],
                'username'       => $user1['username'],
                'aproveitamento' => 0,
                'tempo_exec'     => 0
            ],
            'user2' => [
                'id'             => $user2['id'],
                'equipe'         => $user2['equipe'],
                'username'       => $user2['username'],
                'aproveitamento' => 0,
                'tempo_exec'     => 0
            ]
        ];
    }

    private function users_activeSemConf(){
        $semConf = [];


        foreach ($this->ativos as $ativ){
            $verificaSemConf = true;
            foreach ($this->confrontos as $conf){
                if ($ativ['id'] == $conf['user1']['id'] or $ativ['id'] == $conf['user2']['id']){
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

                                    if ($this->confrontos[$sorteado]['user1']['equipe'] != $user['equipe'] and $this->confrontos[$sorteado]['user1']['equipe'] != $this->ativos[$i]['equipe']){
                                        $this->confrontos[$sorteado] = $this->add_confronto($this->confrontos[$sorteado]['user1'], $user);
                                        $this->confrontos[] = $this->add_confronto($this->confrontos[$sorteado]['user2'], $this->ativos[$i]);

                                        $newSF = [];
                                        foreach ($semConf as $sf){
                                            if ($sf != $this->ativos[$i] and $sf != $user){
                                                $newSF[] = $sf;
                                            }
                                        }

                                        $semConf = $newSF;

                                        $verifica['while'] = false;

                                    } elseif ($this->confrontos[$sorteado]['user2']['equipe'] != $user['equipe'] and $this->confrontos[$sorteado]['user1']['equipe'] != $this->ativos[$i]['equipe']){
                                        $this->confrontos[$sorteado] = $this->add_confronto($this->confrontos[$sorteado]['user2'], $user);
                                        $this->confrontos[] = $this->add_confronto($this->confrontos[$sorteado]['user1'], $this->ativos[$i]);

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
                                        $this->confrontos[] = $this->add_confronto($this->ativos[$i], $user);

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
                            $this->confrontos[] = $this->add_confronto($this->ativos[$i], $user);

                            $newSF = [];
                            foreach ($semConf as $sf){
                                if ($sf != $this->ativos[$i] and $sf != $user){
                                    $newSF[] = $sf;
                                }
                            }

                            $semConf = $newSF;
                        }

                    } else {
                        $this->confrontos[] = $this->add_confronto($this->ativos[$i], $user);

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

    /**
     * @return mixed
     */
    public function getAtivos()
    {
        return $this->ativos;
    }
}