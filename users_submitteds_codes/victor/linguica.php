<?php

function linguica($unidades){

	if($unidades<=10){
		$resul = $unidades*8;
	} else {
		$resul = $unidades*7.5;
	}
return $resul;
}

