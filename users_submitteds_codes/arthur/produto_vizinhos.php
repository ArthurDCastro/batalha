<?php 

function produto_vizinhos($array){
	$tam = count($array);
	$maior = 0;
	for ($i=0; $i < $tam; $i++) {  
		if ($i < $tam - 1 and $array[$i]*$array[$i+1] > $maior) {
			$maior = $array[$i]*$array[$i + 1];
		}

	}
	return $maior;
}

print_r(produto_vizinhos([3,6,-2,-5,7,3]));