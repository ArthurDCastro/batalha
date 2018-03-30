<?php 
	function maiores_strings($strings){
		
		for ($i=0; $i<count($strings); $i++ ){
			$b = strlen($strings[$i]);
			$jeliel[$i] = $b;
			
		}

		sort($jeliel);

		return $jeliel;
	}
	$formigalinda = array("aaaaaaaaaaaaaaa" , "aaa" , "axfsdaaa" , "RAPHAEL");
	$pao = maiores_strings($formigalinda);
	print_r($pao);