<?php 

function palindromo ($val) {

	$string = "";
	$i      = 0;
	
	if ($i != 0) {
		while ($i >= 0) {

			$i--;
			$string .= $val[$i];
		
		}
	}

	if ($string == "") {

		return true;

	} else {

		return false;
	
	}

}