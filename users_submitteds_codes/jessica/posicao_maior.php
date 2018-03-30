<?php
function posicao_maior(array $juty){
	$tam = count($juty);
	$maior = $juty[0];
	$posicao = 0;
	for ($i=1; $i < $tam; $i++) { 
		if ($juty[$i]> $maior){
			$maior = $juty[$i];
			$posicao = $i;
		}
	}
	return $posicao;
}