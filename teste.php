<?php


include "system/core/Model.php";

include "application/models/Table_model.php";

$table = new Table_model();

print_r($table->getConfrontos());

