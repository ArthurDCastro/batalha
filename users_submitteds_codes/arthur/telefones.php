<?php 
function telefones($tel){
	$tam = strlen($tel);
	$soma = 0;
	$repetidos = 0;

	for ($i=0; $i < $tam; $i++) { 
		$proximo = $i + 1;
		$soma += $tel[$i]; 
		
		if ($proximo > $tam) {
			if ($tel[$i] == $tel[$i+1]) {
				$repetidos++;
			}
		}
	}

	$resto = $soma%2;

	if ($tel[0] == $tel[$tam - 1] OR $resto > 0 OR $repetidos > 0) {
		return false;
	} else {
		return true;
	}

}