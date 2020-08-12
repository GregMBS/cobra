<?php
use cobra_salsa\TimesheetDayObject;

require_once __DIR__ . '/../classes/TimesheetDayObject.php';

/**
 * @var TimesheetDayObject $monthSum
 * @var array $month
 */
echo $tv->countRow('GESTIONES', $month, $monthSum, 'tlla', $nombre, $capt, 'ddh');
echo $tv->countRow('CUENTAS', $month, $monthSum, 'lla', $nombre, $capt, 'ddh');
echo $tv->countRow('CONTACTOS', $month, $monthSum, 'ct', $nombre, $capt, '');
echo $tv->countRow('NO CONTACTOS', $month, $monthSum, 'nct', $nombre, $capt, '');
echo $tv->countRow('PROMESAS', $month, $monthSum, 'prom', $nombre, $capt, 'pdh');
echo $tv->countRow('PAGOS', $month, $monthSum, 'pag', $nombre, $capt, '');
