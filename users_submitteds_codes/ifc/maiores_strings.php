<?php 

	function maiores_strings($inputArray){
		    $longestLen = 0;
    $longestArray = [];
    
    foreach($inputArray as $str) {
        $len = strlen($str);
        
        if($len > $longestLen) {
            $longestArray = [$str];
            $longestLen = $len;
        }
        else if ($len == $longestLen) {
            $longestArray[] = $str;
        }
    }
    
    return $longestArray;
	}