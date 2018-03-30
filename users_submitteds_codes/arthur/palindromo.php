<?php 

function  palindromo(string $palavra){
	$tam = strlen($palavra);
	$reverso = array();
	$aux= 0;
	$j = $tam - 1;
	
	for ($i=0; $i < $tam; $i++) { 
		$reverso[$j] = $palavra[$i];
		$j--;
	}

	for ($j=0; $j < $tam; $j++) { 
		if ($reverso[$j] == $palavra[$j]) {
			$aux++;
		} else {
			$aux = 0;
		}
	}

	if ($aux == $tam) {
		return true;
	} else {
		return false;
	}
	
}
