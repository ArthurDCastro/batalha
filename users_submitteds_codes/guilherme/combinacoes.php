<?php

function combinacoes($string){

$qntd = strlen($string);
$mistura = str_shuffle($string);
explode("", $string);
$combinacoes = $qntd;

for ($i=0; $i < $qntd ; $i++) { 
	$j = $qntd;
	if ($mistura[$i] == $mistura[$j]){}
} else {

	$final = $mistura[$i];
}
$j--;
};