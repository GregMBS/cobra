<?php

use cobra_salsa\MiltClass;

require_once 'classes/MiltClass.php';

$mc = new MiltClass();
$output = array();
$result = $mc->getMsglist();

if ($result) {
    foreach ($result as $row) {
        try {
            $calls = $mc->getCalls($row);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        foreach ($calls as $call) {
            $output[] = $mc->getMiltOutput($call);
        }
    }
    echo json_encode($output);
}
