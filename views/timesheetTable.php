<?php
use cobra_salsa\TimesheetDayObject;

require_once __DIR__ . '/../classes/TimesheetDayObject.php';

/**
 * @var TimesheetDayObject $monthSum
 * @var array $month
 */
echo $tv->timeRow('LOGIN', $month, $monthSum, 'start');
echo $tv->timeRow('LOGOUT', $month, $monthSum, 'stop');
echo $tv->diffRow('HORAS', $month, $monthSum, 'diff');
echo $tv->diffRow('BREAK', $month, $monthSum, 'break');
echo $tv->diffRow('BAÑO', $month, $monthSum, 'bano');
echo $tv->countRow('GESTIONES', $month, $monthSum, 'tlla', $gestor, $capt, 'ddh');
echo $tv->countRow('CUENTAS', $month, $monthSum, 'lla', $gestor, $capt, 'ddh');
echo $tv->countRow('CONTACTOS', $month, $monthSum, 'ct', $gestor, $capt, '');
echo $tv->countRow('NO CONTACTOS', $month, $monthSum, 'nct', $gestor, $capt, '');
echo $tv->countRow('PROMESAS', $month, $monthSum, 'promesas', $gestor, $capt, 'pdh');
echo $tv->countRow('PAGOS', $month, $monthSum, 'pag', $gestor, $capt, '');

