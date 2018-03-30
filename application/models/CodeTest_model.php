<?php

/**
 * Created by PhpStorm.
 * User: jefferson
 * Date: 30/05/17
 * Time: 13:13
 */

class CodeTest_model extends CI_Model {

    public function __construct() {
        set_time_limit(10);
    }

    function getSyntaxErrors($code_path){

        exec(LINTER_PATH.$code_path, $out, $sintax_status);

        if ($sintax_status == 255) {

            return [true, SINTAX_ERROR_MESSAGE];

        } else {
            return false;
        }
    }

    function getTimeoutErrors($code_path){

        set_time_limit(15);

        exec(MAX_EXECUTION_PATH.$code_path, $out, $fatal_status);

        if ($fatal_status == 255){

            return [true, FATAL_ERROR_MESSAGE];

        } else {
            return false;
        }
    }

    function getFunctionResults(string $folder, string $codeFileName, array $tests){

        set_time_limit(15);

        ob_start();

        include_once (SUBMITS_PATH.$folder."/".$codeFileName.ext);

        $results = [];

        foreach ($tests as $inputs) {
            $results[] = call_user_func_array($codeFileName, $inputs);
        }

        ob_end_clean();

        return $results;
    }

    function verifyResults(array $inputs, array $expected, array $results) {

        set_time_limit(15);

        $entrada  = [];
        $esperado = [];
        $obtido   = [];
        $resultado= [];

        $total_tests = 0;
        $total_tests_success = 0;

        foreach ($expected as $pos => $expec) {

            $total_tests++;

            //ENTRADAS PARAMETRIZADAS
            foreach ($inputs[$pos] as $input) {
                if (!is_array($input)) {
                    $entrada[] = $input;
                } else {

                    $x = null;

                    foreach ($input as $inp) {

                        if (!is_array($inp)) {
                            $entrada[] = $inp;
                        } else {

                            $x = null;

                            foreach ($inp as $i) {

                                $x.= $i;

                            } $entrada[] = $x;
                        }
                    }
                }
            }

            //ESPERADO
            foreach ($expec as $exp) {
                if (!is_array($exp)) {
                    $esperado[] = $exp;
                } else {
                    $x = null;
                    foreach ($exp as $e) {

                        $x .= $e;

                    } $esperado[] = $x;
                }
            }

            //OBTIDO
            if (!is_array($results[$pos])) {
                $obtido[] = $results[$pos];
            } else {
                $x = null;
                foreach ($results[$pos] as $r) {
                    if (!is_array($r)) {
                        $x .= $r;
                    } else {
                        foreach ($r as $a) {
                            $x .= $a;
                        }
                    }
                }
                $obtido[] = $x;
            }

            if ($obtido[$pos] === $esperado[$pos]) {
                $resultado[] = true;
                $total_tests_success++;
            } else{
                $resultado[] = false;
            }
        }

        return [$entrada, $esperado, $obtido, $total_tests, $total_tests_success];
    }
}