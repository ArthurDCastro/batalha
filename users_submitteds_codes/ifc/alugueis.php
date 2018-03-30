<?php 

	function alugueis($array) {
		
		$total = 0;

		foreach ($array as $key => $value) {
			foreach ($value as $k => $v) {
				if ($v == 0) {
					$total-=100;
				}else {
					$total += $v;
				}
			}
		}

		return $total;

	}

	//echo alugueis([[800, 200, 500],[500, 600, 400],[500, 0, 500]]);