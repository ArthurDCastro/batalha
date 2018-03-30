<?php
/**
 * Created by PhpStorm.
 * User: Arthur Castro
 * Date: 27/03/2018
 * Time: 21:30
 */

class Table_model extends Users_model {

    private $ativos;
    private $confrontos;
    private $rodada;

    public function __construct(){
        foreach ($this->openFile() as $user){
            if ($user['atividae'] and $user['equipe'] != 'ifc'){
                $this->ativos[] = $user;
            }
        }

        $this->getGames();
    }

    private function users_activeSemConf(){
        $semConf = [];


        foreach ($this->ativos as $ativ){
            $verificaSemConf = true;
            foreach ($this->confrontos as $conf){
                if ($ativ['id'] == $conf[0]['id'] or $ativ['id'] == $conf[1]['id']){
                    $verificaSemConf = false;
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



        while (count($this->users_activeSemConf()) > 1){

            $i = $countAtivos -1;
            foreach ($this->ativos as $user){
                $semConf = $this->users_activeSemConf();

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
                                        $this->confrontos[] = $this->confrontos[$sorteado][1] != $this->ativos[$i];

                                        $verifica['while'] = false;
                                    } elseif ($this->confrontos[$sorteado][1]['equipe'] != $user['equipe'] and $this->confrontos[$sorteado][0]['equipe'] != $this->ativos[$i]['equipe']){
                                        $this->confrontos[$sorteado] = [$this->confrontos[$sorteado][1], $user];
                                        $this->confrontos[] = $this->confrontos[$sorteado][0] != $this->ativos[$i];

                                        $verifica['while'] = false;
                                    }
                                }

                                $j++;

                                if ($j > 10){
                                    $this->confrontos[] = [$this->ativos[$i], $user];

                                    $verifica['while'] = false;
                                }
                            }

                        } else {
                            $this->confrontos[] = [$this->ativos[$i], $user];
                        }

                    } else {
                        $this->confrontos[] = [$this->ativos[$i], $user];
                    }
                }

                $i--;
            }
        }

    }




    /**
     * @return mixed
     */
    public function getConfrontos()
    {
        return $this->confrontos;
    }
}