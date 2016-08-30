<?php

/**
 * Resumen
 *
 * Page for viewing account data and capturing gestiones.
 *
 * PHP version 5
 *
 * @category  Financial
 * @package   Cobra
 * @author    Gregory Miles Blumenthal Scharf <greg@gmbs-consulting.com>
 * @copyright 2016 Gregory Miles Blumenthal Scharf
 * @license   http://opensource.org/licenses/gpl-license.php GNU General Public License, Version 3
 * @link      http://www.gmbs-consulting.com
 */
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenClass;
use cobra_salsa\GestionClass;
use cobra_salsa\ResumenQueuesClass;

$get = filter_input_array(INPUT_GET);
date_default_timezone_set('America/Monterrey');
setlocale(LC_MONETARY, 'en_US');

require_once 'classes/PdoClass.php';
require_once 'classes/ResumenClass.php';
require_once 'classes/GestionClass.php';
require_once 'classes/ResumenQueuesClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectUser();
$rc = new ResumenClass($pdo);
$gc = new GestionClass($pdo);
$qc = new ResumenQueuesClass($pdo);
$mytipo = $pdoc->tipo;

/*
  if ($detect->isMobile()) {
  header("Location: resumen-mobile.php?capt=" . $capt);
  }
 */
$C_CVGE = $capt;
if (empty($mytipo)) {
    $redirector = "Location: index.php";
    header($redirector);
} else {
    $oldgo = '';
    $go = filter_input(INPUT_GET, 'go');
    if (filter_has_var(INPUT_GET, 'elastix')) {
        $redirector = "Location: resumen.php?shutup=yes&capt=" . $capt;
    }
    if ($go == 'LOGOUT') {
        $page = "Location: logout.php?gone=&capt=" . $capt;
        header($page);
    }
    if ($go == 'ULTIMA') {
        $find = $rc->lastGestion($capt);
        $redirector = "Location: resumen.php?capt=" . $capt .
                "&find=" . $find .
                "&field=id_cuenta&go=FROMULTIMA";
        header($redirector);
    }
    if (filter_has_var(INPUT_GET, 'find')) {
        $dirty = filter_input(INPUT_GET, 'find');
        $find = $rc->cleanFind($dirty);
        $fieldInput = filter_input(INPUT_GET, 'field');
        $field = 'id_cuenta';
        if (isset($fieldInput)) {
            if ($rc->fieldCheck($fieldInput)) {
                $field = $fieldInput;
            }
        }
    }

    $C_CONT = filter_input(INPUT_GET, 'C_CONT', FILTER_SANITIZE_NUMBER_INT);
    $C_CVST = filter_input(INPUT_GET, 'C_CVST');
    $C_CVGE = filter_input(INPUT_GET, 'C_CVGE');
    $N_PROM = $rc->demonitize(filter_input(INPUT_GET, 'N_PROM'));
    $D_PROM = filter_input(INPUT_GET, 'D_PROM');
    $N_PAGO = $rc->demonitize(filter_input(INPUT_GET, 'N_PAGO'));
    $D_PAGO = filter_input(INPUT_GET, 'D_PAGO');
    $D_FECH = filter_input(INPUT_GET, 'D_FECH');
    $C_NTEL = filter_input(INPUT_GET, 'C_NTEL', FILTER_SANITIZE_NUMBER_INT);
    $C_OBSE2 = filter_input(INPUT_GET, 'C_OBSE2', FILTER_SANITIZE_NUMBER_INT);
    $C_EMAIL = filter_input(INPUT_GET, 'C_EMAIL', FILTER_SANITIZE_EMAIL);
    $C_NDIR = filter_input(INPUT_GET, 'C_NDIR');
    $gestion = $get;
    if (!empty($C_CVST)) {
        $gestion['C_OBSE1'] = utf8_decode($get['C_OBSE1']);
        $gestion['C_HRFI'] = date('H:i:s');
        $gestion['C_NDIR'] = trim($get['C_NDIR']);
        $gestion['C_EMAIL'] = trim($get['C_EMAIL']);
        $gestion['N_PROM'] = $N_PROM;
    }
    if (($go == 'CAPTURADO') && (!empty($C_CVST))) {
        $checkerrorsv = $gc->countVisitErrors($gestion);
        $errorv = $checkerrorsv['errorsv'];
        $flagmsgv = $checkerrorsv['flagmsgv'];
        if ($errorv < 10) {
            $auto = $gc->insertVisit($gestion);
            $gc->addHistdate($auto);
            $gc->addHistgest($auto, $C_CVGE);
            if (!empty($C_NTEL)) {
                $gc->addNewTel($C_CONT, $C_NTEL);
            }
            if (!empty($C_OBSE2)) {
                $gc->addNewTel($C_CONT, $C_OBSE2);
            }
            if (!empty($C_NDIR)) {
                $gc->updateAddress($C_CONT, $C_NDIR);
            }
            if (!empty($C_EMAIL)) {
                $gc->updateEmail($C_CONT, $C_EMAIL);
            }
            if ($N_PAGO > 0) {
                $who = $gc->attributePayment($field, $C_CONT);
                $gc->addPago($C_CONT, $D_PAGO, $N_PAGO, $who);
            }
            $gc->updateAllUltimoPagos();

            $best = $gc->getBest($C_CVST, $C_CONT);
            $gc->resumenStatusUpdate($C_CONT, $best);
            $redirector = "Location: resumen.php?capt=" . $capt . "&go=FROMBUSCAR&i=0&field=id_cuenta&find=" . $C_CONT;
            header($redirector);
        }
    }

    if ($go == 'NUEVOS') {
        if (!empty($C_NTEL)) {
            $gc->addNewTel($C_CONT, $C_NTEL);
        }
        if (!empty($C_OBSE2)) {
            $gc->addNewTel($C_CONT, $C_OBSE2);
        }
        if (!empty($C_NDIR)) {
            $gc->updateAddress($C_CONT, $C_NDIR);
        }
        $redirector = "Location: resumen.php?&capt=" . $capt;
        header($redirector);
    }

    if ($go == 'GUARDAR' && !empty($C_CVST)) {
        $oldgo = filter_input(INPUT_GET, 'oldgo');
        $flag = filter_input(INPUT_GET, 'error');
        $AUTH = mysqli_real_escape_string($con, $get['AUTH']);
        if ($C_CVGE != $capt) {
            $AUTH = $capt;
        }
        if ($mytipo == 'admin') {
            $AUTH = $capt;
        }
        if (empty($AUTH)) {
            $AUTH = '';
        }
        $C_HRFI = date('H:i:s');
        $N_PROM = $N_PROM1 + $N_PROM2 + $N_PROM3 + $N_PROM4;
        $D_PROM = $D_PROM1;
        $checkerrors = $gc->countGestionErrors($gestion);
        $error = $checkerrors['errors'];
        $flagmsg = $checkerrors['flagmsg'];

        if ($error == 0) {
            $gc->beginTransaction();
            $gc->insertGestion($gestion);
            $gc->addHistgest($auto, $c_cvge);
            if (!empty($C_NTEL)) {
                $gc->addNewTel($C_CONT, $C_NTEL);
            }
            if (!empty($C_OBSE2)) {
                $gc->addNewTel($C_CONT, $C_OBSE2);
            }
            if (!empty($C_NDIR)) {
                $gc->updateAddress($C_CONT, $C_NDIR);
            }
            if (!empty($C_EMAIL)) {
                $gc->updateEmail($C_CONT, $C_EMAIL);
            }
            if ($N_PAGO > 0) {
                $who = $gc->attributePayment($field, $C_CONT);
                $gc->addPago($C_CONT, $D_PAGO, $N_PAGO, $who);
            }
            $gc->updateAllUltimoPagos();

            $best = $gc->getBest($C_CVST, $C_CONT);
            $gc->resumenStatusUpdate($C_CONT, $best);
            $gc->commitTransaction();

            if ($find == "/") {
                $find = null;
            }
            if ($capt == "/") {
                $capt = null;
            }
            //}
            $redirector = "Location: resumen.php?capt=" . $capt;
            header($redirector);
        } else {
            include_once 'views/resumenErrorView.php';
        }
    }

    if (empty($capt)) {
        $redirector = "Location: index.php";
        header($redirector);
    }
    $resultg = $rc->getUserData($capt);
    if (isset($resultg['tipo'])) {
        $mynombre = $resultg['usuaria'];
        $mytipo = $resultg['tipo'];
        $camp = $resultg['camp'];
    } else {
        $redirector = "Location: index.php";
        header($redirector);
    }

    $resultquery = $qc->getMyQueue($capt, $camp);
    extract($resultquery);
    if (isset($cr)) {
        $codres = ' AND queue="' . $cr . '" ';
    } else {
        $codres = '';
        $cr = '';
    }
    if ($cr == '') {
        $camp = 0;
    }



    if (in_array($go, array('FROMBUSCAR', 'FROMMIGO', 'FROMULTIMA', 'FROMPROM'))) {
        $stm = $qc->prepareQuicksearch($find);
    } else {
        if ($camp > 0) {
            $stp = $qc->prepareResumenMain($cliente, $sdc, $cr);
            $stm = $qc->bindResumenMain($stp, $capt, $cliente, $sdc, $cr);
        }
    }

    $row = $qc->runResumenMain($stm);
    if ($row) {
        extract($row);
        if (empty($status_de_credito)) {
            $status_de_credito = '';
        }
        if (empty($saldo_cuota)) {
            $saldo_cuota = 0;
        }
    } else {
        unset($id_cuenta);
    }

    if (empty($id_cuenta)) {
        $id_cuenta = 0;
    } else {
        $qsliced = "delete from rslice where user='" . $capt . "';";
        mysqli_query($con, $qsliced) or die("ERROR RM55 - " . mysqli_error($con));
        $qslice = "replace into rslice select *, '" . $capt . "', now() from resumen where id_cuenta=" . $id_cuenta;
        mysqli_query($con, $qslice) or die("ERROR RM55 - " . mysqli_error($con));

        $C_OBSE2 = '';
        $CUANDO = '';
        $querycom = "select c_obse2,c_cvst,cuando from historia where c_cont='" . $id_cuenta . "' order by d_fech desc, c_hrin desc limit 1";
        $resultcom = mysqli_query($con, $querycom) or die("ERROR RM41 - " . mysqli_error($con));
        while ($answercom = mysqli_fetch_row($resultcom)) {
            $C_OBSE2 = $answercom[0];
            $ultimo_status_de_la_gestion = $answercom[1];
            $CUANDO = $answercom[2];
        }
    }
    if ($id_cuenta == 0) {
        $newcamp = 3;
        $querycamp = "SELECT queuelist.camp FROM nombres,queuelist 
WHERE gestor=iniciales and status_aarsa<>'' and queuelist.camp>nombres.camp
AND gestor='" . $capt . "' AND bloqueado=0
ORDER BY queuelist.camp LIMIT 1";
        $resultcamp = mysqli_query($con, $querycamp) or die("ERROR RM42 - " . mysqli_error($con));
        while ($answercamp = mysqli_fetch_row($resultcamp)) {
            $newcamp = $answercamp[0];
        }
        $queryccamp = "UPDATE nombres SET camp=" . $newcamp . " WHERE iniciales='" . $capt . "';";
        mysqli_query($con, $queryccamp) or die("ERROR RM43 - " . mysqli_error($con));

        $queryprom = "select n_prom,d_prom,
    n_prom1,d_prom1,n_prom2,d_prom2,
    n_prom3,d_prom3,n_prom4,d_prom4,
    c_freq 
from historia 
where c_cont=" . $id_cuenta . " and n_prom>0 
and c_cvst like 'PROM%DE%'
order by d_fech desc, c_hrin desc limit 1";
        $resultprom = mysqli_query($con, $queryprom) or die("ERROR RM45 - " . mysqli_error($con));
        while ($answerprom = mysqli_fetch_row($resultprom)) {
            $N_PROM_OLD = $answerprom[0];
            $D_PROM_OLD = $answerprom[1];
            $N_PROM1_OLD = $answerprom[2];
            $D_PROM1_OLD = $answerprom[3];
            $N_PROM2_OLD = $answerprom[4];
            $D_PROM2_OLD = $answerprom[5];
            $N_PROM3_OLD = $answerprom[6];
            $D_PROM3_OLD = $answerprom[7];
            $N_PROM4_OLD = $answerprom[8];
            $D_PROM4_OLD = $answerprom[9];
        }
        $nmerc = 0;
        $querycheck = "SELECT timelock, locker,time_to_sec(timediff(now(),timelock))/60 from resumen  WHERE id_cuenta='" . $id_cuenta . "';";
        $resultcheck = mysqli_query($con, $querycheck) or die("ERROR RM50 - " . mysqli_error($con));
        while ($answercheck = mysqli_fetch_row($resultcheck)) {
            $timelock = $answercheck[0];
            $locker = $answercheck[1];
            $sofar = $answercheck[2];
        }
    }
    $tl = date('r');
    if ($mytipo != 'admin') {
        if (!(empty($locker)) && ($locker != $capt)) {
            $lockflag = 1;
        } else {
            $queryunlock = "UPDATE resumen SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
            $querylock = "UPDATE resumen SET timelock=now(),locker='" . $capt . "' WHERE id_cuenta='" . $id_cuenta . "';";
            if ($cliente == 'Surtidor del Hogar') {
                $querylock = "UPDATE resumen SET timelock=now(),locker='" . $capt . "' WHERE rfc_deudor='" . $rfc_deudor . "';";
            }
            if ($mytipo == 'admin') {
                $querylock = "SELECT 1;";
            }
            $queryunlock2 = "UPDATE rslice SET timelock=NULL, locker=NULL 
WHERE locker='" . $capt . "';";
            $querylock2 = "UPDATE rslice SET timelock=now(),locker='" . $capt . "' WHERE id_cuenta='" . $id_cuenta . "';";
            if ($cliente == 'Surtidor del Hogar') {
                $querylock2 = "UPDATE rslice SET timelock=now(),locker='" . $capt . "' WHERE rfc_deudor='" . $rfc_deudor . "';";
            }
            mysqli_autocommit($con, false);
            mysqli_query($con, $queryunlock) or die("ERROR RM51 - " . mysqli_error($con));
            mysqli_query($con, $querylock) or die("ERROR RM52 - " . mysqli_error($con));
            mysqli_query($con, $queryunlock2) or die("ERROR RM51 - " . mysqli_error($con));
            mysqli_query($con, $querylock2) or die("ERROR RM52 - " . mysqli_error($con));
            mysqli_commit($con);
            $tl = $rc->getTimelock($id_cuenta);
        }
    }

    $dday = date('Y-m-d', strtotime('last day of next month'));
    $dday2 = $dday;
    $CD = date("Y-m-d");
    $CT = date("H:i:s");

    $resultfilt = $rc->getQueueList($capt);
    $resultng = $rc->getNumGests($capt);
    $resultcl = $rc->getClientList();
    $resultAccion = $rc->getAccion();
    $resultMotiv = $rc->getMotiv();
    $resultDictamen = $rc->getDict($mytipo);
    $resultAccionV = $rc->getAccionV();
    $resultDictamenV = $rc->getDictV();
    $resultMotivV = $rc->getMotivV();
    $resultGestorV = $rc->getVisitadorList();
    $resultGestor = $rc->getGestorList();
    if ($id_cuenta > 0) {
        $rowsub = $rc->getHistory($id_cuenta);
    }
    $bad = $rc->getBadNo($id_cuenta);
    $resultCnp = $rc->getCnp();
    $nota = $rc->notAlert($capt);
    require_once 'views/resumenView.php';
}