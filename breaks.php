<?php

use cobra_salsa\PdoClass;
use cobra_salsa\BreaksClass;

require_once 'classes/PdoClass.php';
require_once 'classes/BreaksClass.php';
require_once 'classes/BreaksTableObject.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectNobody();
$bc = new BreaksClass($pdo);
$capt = filter_input(INPUT_GET, 'capt');

/**
 * 
 * @param PDO $pdo
 * @param string $TIEMPO
 * @param string $GESTOR
 * @return array
 */

$bc->clearUserlog($capt);
$ot = '';
$og = '';
$result = $bc->getBreaksTable($capt);
$output = [];
if (!empty($result)) {
    foreach ($result as $row) {
        $temp = (array) $row;
        $temp['DIFF'] = $row->diff;
        $temp['NTP'] = date('H:i:s');
        $temp['formatLate'] = ' class="late"';
        $resultTimes = $bc->getTimes($row->c_hrin, $row->c_cvge);
        foreach ($resultTimes as $times) {
            if (!empty($times['diff'])) {
                $temp['DIFF'] = $times['diff'];
                $temp['NTP'] = $times['minHr'];
                $temp['formatLate'] = '';
            }
        }
        $output[] = $temp;
    }
}
require_once 'views/breaksView.php';