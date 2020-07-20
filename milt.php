<?php

use cobra_salsa\MiltClass;

require_once 'classes/MiltClass.php';

$mc = new MiltClass();
$output = array();
$result = $mc->getMsglist();

if ($result) {
    foreach ($result as $row) {
        $calls = $mc->getCalls($row);
        foreach ($calls as $call) {
            $output[] = $mc->getMiltOutput($call);
        }
    }
    echo json_encode($output);
}
