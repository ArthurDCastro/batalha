<?php 

	function repetidos($palavra){
		$tamanho = strlen($palavra);
		$resultado = 0;

		for ($i =0;$i < $tamanho - 1;$i++){
			if ($palavra[$i] == $palavra[$i + 1 ]) {
					$resultado++;
				}
		}
		return $resultado;
		
	}
	



