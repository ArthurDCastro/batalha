<?php 

    function alugueis($matriz){

        $tamanhoArray = count($matriz);

        $valor = 0;

        for ($i=0; $i < $tamanhoArray; $i++) {
            $tamanhoMatriz = count($matriz[$i]);
            for ($j=0; $j < $tamanhoMatriz; $j++) {
                if ($matriz[$i][$j] == 0) {
                    $valor = $valor - 100;
                } else {

                    $valor += $matriz[$i][$j];
                }
            }
        }

        return $valor;
    }
