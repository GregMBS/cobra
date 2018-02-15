<?php
use App\PdoClass;
use App\HorariosVClass;

require_once 'classes/PdoClass.php';
require_once 'classes/HorariosVClass.php';

set_time_limit(300);

$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
/* @var $hc HorariosVClass */
$hc = new HorariosVClass($pdo);
$capt = $pdoc->capt;

$dhoy = date('t');

$visitadores = $hc->listVisitadores();

foreach ($visitadores as $visitador) {
    $c_cvst = $visitador['iniciales'];
    for ($day=1;$day<=$dhoy;$day++) {
        /* @var $start array */
        $start[$c_cvst][$day] = $hc->getStart($c_cvst, $day);
        /* @var $stop array */
        $stop[$c_cvst][$day] = $hc->getStop($c_cvst, $day);
        /* @var $noAcc array */
        $noAcc[$c_cvst][$day] = $hc->countByStatusAndGestor('No acepta productos',$c_cvst, $day);
        /* @var $PP array */
        $PP[$c_cvst][$day] = $hc->countByStatusAndGestor('Promesa de Pago',$c_cvst, $day);
        /* @var $FPP array */
        $FPP[$c_cvst][$day] = $hc->countByStatusAndGestor('Promesa de Pago FPP',$c_cvst, $day);
        /* @var $contacts array */
        $contacts[$c_cvst][$day] = $hc->countAllContacts($c_cvst, $day);
        /* @var $visits array */
        $visits[$c_cvst][$day] = $hc->countAllVisits($c_cvst, $day);
    }
}
$dias = [
    'DOM', 'LUN', 'MAR', 'MIE', 'JUE', 'VIE', 'SAB'    
];
$total = $hc->countsByStatus();
require_once 'views/horariosvView.php';