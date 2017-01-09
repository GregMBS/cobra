<?php

use cobra_salsa\MiltClass;

require_once 'classes/MiltClass.php';

$mc = new MiltClass();

$id = filter_input(INPUT_GET, 'id');

$mc->updateCount($id);