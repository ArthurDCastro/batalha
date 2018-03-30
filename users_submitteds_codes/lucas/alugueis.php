<?php
	function alugueis(array $alugueis){
		$total = 0;
		for ($i=0; $i < count($alugueis); $i++) {

			for ($j=0; $j < count($alugueis); $j++) { 
				if ($alugueis[$i][$j] == 0){
					$alugueis[$i][$j] = -100;
				}

				$total += $alugueis[$i][$j];

			}
		}
		return $total;
	}
