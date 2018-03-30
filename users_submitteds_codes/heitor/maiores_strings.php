<?php 

function maiores_strings(array $strings){
	$array = [];
	$tam1 = [];
	$tam = count($strings);
	for($i=0;$i<$tam;$i++){
		$tam1[] = strlen($strings[$i]);
		for ($j=0; $j <$tam ; $j++) { 
				if ($tam1[$i]>$tam1[$j]) {
					$maior = $tam1[$i];
					}

		}
		if (strlen($strings[$i]) == $maior) {
			$array[] = $strings[$i];
		}
	}
	print_r($array);
	print_r($tam1);
}
maiores_strings(['a','ab','abvc','abcd']);