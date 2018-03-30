<?php

function fila(array $fila){
	$quant = count($fila);
	$menor = $fila[0];
	$aux   = 0;
	for ($i=0; $i < $quant; $i++) { 
		if ($fila[$i]==$menor){
			$menor = $fila[$i];
		}
	}
	return $fila;
}
