<?php

function reverso($val)
{
	$val1 = (string) $val;

	$resul = strrev($val1);

	$resul = (int) $resul;	

	return $resul;
}
