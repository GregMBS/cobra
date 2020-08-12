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
require __DIR__ . '/timesheetTableCounts.php';