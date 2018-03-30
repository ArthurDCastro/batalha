<?php
$numeros = [1,2,3,4,5,6,7,8,9,10];
function troca(array $numeros){

$j = 5;
for ($i = 0; $i < 5; $i++){

	$x = $numeros[$i];
	$numeros[$i] = $numeros[$j];
	$numeros[$j] = $x;
$j++;

};
return $numeros;
}