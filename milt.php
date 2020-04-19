<?php

use cobra_salsa\MiltClass;

require_once 'classes/MiltClass.php';

$mc = new MiltClass();
$output = array();
$result = $mc->getMsglist();

if ($result) {
    foreach ($result as $row) {
        $call = $mc->getCalls($row);
        foreach ($call as $item) {
            $output[] = $mc->getMiltOutput($item);
        }
    }
    echo json_encode($output);
}
