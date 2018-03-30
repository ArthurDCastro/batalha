<?php
/**
 * Created by PhpStorm.
 * User: Arthur Castro
 * Date: 27/03/2018
 * Time: 22:33
 */

foreach ($table as $tb){
    echo "<h2>{$tb[0]['username']}</h2> {$tb[0]['equipe']}<h1>vs</h1>{$tb[1]['equipe']}<h2>{$tb[1]['username']}</h1> ";
    echo "<br><br>";
}

print_r($table);

print_r(count($table));