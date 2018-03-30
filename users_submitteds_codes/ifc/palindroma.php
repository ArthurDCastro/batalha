<?php 

	function palindroma($palavra){
		if ($palavra == strrev($palavra)) {
			return true;
		} else {
			return false;
		}
	}