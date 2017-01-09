<?php

use cobra_salsa\MiltClass;

require_once 'classes/MiltClass.php';

$mc = new MiltClass();
$output = array();
$result = $mc->getMsglist();

if ($result) {
    foreach ($result as $row) {
        $result = $mc->getCalls($row);
        foreach ($result as $row) {
            $output[] = $mc->getMiltOutput($row);
        }
    }
    echo json_encode($output);
}
