<?php

use cobra_salsa\BadNoObject;
use cobra_salsa\BuscarClass;
use cobra_salsa\GestionClass;
use cobra_salsa\PdoClass;
use cobra_salsa\ResumenClass;
use cobra_salsa\ResumenObject;
use cobra_salsa\ResumenQueuesClass;

$get = filter_input_array(INPUT_GET);
date_default_timezone_set('America/Monterrey');
setlocale(LC_MONETARY, 'en_US');

require_once 'classes/PdoClass.php';
require_once 'classes/GestionClass.php';
require_once 'classes/ResumenClass.php';
require_once 'classes/ResumenObject.php';
require_once 'classes/BadNoObject.php';
require_once 'classes/ResumenQueuesClass.php';
require_once 'classes/BuscarClass.php';
$pc = new PdoClass();
$pdo = $pc->dbConnectUser();
$gc = new GestionClass($pdo);
$rc = new ResumenClass($pdo);
$qc = new ResumenQueuesClass($pdo);
$bc = new BuscarClass($pdo);
$capt = $pc->capt;
$mytipo = $pc->tipo;
$C_CVGE = $capt;
$flag = 0;
$flagmsg = '';
//if ($capt == 'gmbs' && !empty($get)) {
//    var_dump($get);
//    die();
//}
if (!empty($mytipo)) {
    $oldGo = '';

    $go = filter_input(INPUT_GET, 'go');
    if ($go == 'ULTIMA') {
        $find = $rc->lastMyGestion($capt);
        $redirector = "Location: resumen.php?capt=$capt&find=$find&field=id_cuenta&go=FromUltima";
        header($redirector);
    }
    $getUpdate = isset($get['find']);
    $isOldId = isset($get['id_cuenta']);
    $find = '';
    if ($getUpdate) {
        $find = $rc->cleanFind(filter_input(INPUT_GET, 'find'));
    }

    $notas = $rc->notAlert($capt);
    $notalert = $notas['notalert'];
    $notalertt = $notas['notalertt'];


    if ($go == 'LOGOUT') {
        $page = "Location: logout.php?gone=&capt=" . $capt;
        header($page);
    }

    if (($go == 'CAPTURADO') && (!empty($get['C_CVST'])) && (!empty($get['C_CVGE']))) {
        $C_HRIN = filter_input(INPUT_GET, 'C_VH') . ':' . filter_input(INPUT_GET, 'C_VMN');
        $C_HRFI = date('H:i:s');
        $C_CVGE = filter_input(INPUT_GET, 'C_CVGE');
        $C_CVBA = filter_input(INPUT_GET, 'C_CVBA');
        $C_CONT = filter_input(INPUT_GET, 'C_CONT');
        $C_CONTAN = filter_input(INPUT_GET, 'C_CONTAN');
        $C_CTIPO = filter_input(INPUT_GET, 'domTipo');
        $C_COWN = filter_input(INPUT_GET, 'C_COWN');
        $C_CSTAT = filter_input(INPUT_GET, 'C_CSTAT');
        $CUENTA = filter_input(INPUT_GET, 'CUENTA');
        $C_OBSE1 = filter_input(INPUT_GET, 'C_OBSE1');
        $C_CALLE1 = filter_input(INPUT_GET, 'C_CALLE1');
        $C_CALLE2 = filter_input(INPUT_GET, 'C_CALLE2');
        $C_ATTE = filter_input(INPUT_GET, 'C_ATTE');
        $C_CARG = filter_input(INPUT_GET, 'C_CARG');
        $C_TELE = filter_input(INPUT_GET, 'C_TELE');
        $C_RCON = filter_input(INPUT_GET, 'C_RCON');
        $C_NSE = filter_input(INPUT_GET, 'C_NSE');
        $C_CNIV = filter_input(INPUT_GET, 'C_CNIV');
        $C_CFAC = filter_input(INPUT_GET, 'C_CFAC');
        $C_CPTA = filter_input(INPUT_GET, 'C_CPTA');
        $C_CREJ = filter_input(INPUT_GET, 'C_CREJ');
        $C_CPAT = filter_input(INPUT_GET, 'C_CPAT');
        $C_VISIT = filter_input(INPUT_GET, 'C_VISIT');
        $C_CVST = filter_input(INPUT_GET, 'C_CVST');
        $ACCION = filter_input(INPUT_GET, 'ACCION');
        $C_MOTIV = filter_input(INPUT_GET, 'C_MOTIV');
        $D_FECH = filter_input(INPUT_GET, 'C_VD');
        $D_PROM = filter_input(INPUT_GET, 'D_PROMv');
        $N_PROM0 = filter_input(INPUT_GET, 'N_PROMv');
        $D_PAGO = filter_input(INPUT_GET, 'D_PAGOv');
        $N_PAGO = filter_input(INPUT_GET, 'N_PAGOv');
        $C_PROM = filter_input(INPUT_GET, 'C_PROM');
        $C_NTEL = filter_input(INPUT_GET, 'C_NTEL');
        $C_NDIR = filter_input(INPUT_GET, 'C_NDIR');
        $C_EMAIL = filter_input(INPUT_GET, 'C_EMAIL');
        $C_OBSE2 = filter_input(INPUT_GET, 'C_OBSE2');
        $C_EJE = filter_input(INPUT_GET, 'C_EJE');
        if (empty($N_PROM0)) {
            $N_PROM0 = 0;
        }
        $N_PROM = str_replace('$', '', $N_PROM0);
        $C_FREQ = filter_input(INPUT_GET, 'C_FREQ');
        $gc->doVisit($get);
    }
} else {
    $flagmsg = "Acceso sin autorización";
    include 'resumenErrorView.php';
    exit();
}
if ($go == 'NUEVOS') {
    $C_CONT = filter_input(INPUT_GET, 'C_CONT', FILTER_VALIDATE_INT);
    $C_NTEL = filter_input(INPUT_GET, 'C_NTEL');
    $C_NDIR = trim(filter_input(INPUT_GET, 'C_NDIR'));
    $C_OBSE2 = filter_input(INPUT_GET, 'C_FREQ');
    if (!empty($C_NTEL)) {
        $gc->addNewTel($C_CONT, $C_NTEL);
    }
    if (!empty($C_NDIR)) {
        $gc->updateAddress($C_CONT, $C_NDIR);
    }
    if (!empty($C_OBSE2) && $C_OBSE2 == filter_var($C_OBSE2, FILTER_SANITIZE_NUMBER_FLOAT)) {
        $gc->addNewTel($C_CONT, $C_OBSE2);
    }
//$redirector = "Location: resumen.php?&capt=".$capt."&go=ULTIMA";
    $redirector = "Location: resumen.php?&capt=" . $capt;
    header($redirector);
}
if ($go == 'GUARDAR' && !empty($get['C_CVGE']) && !empty($get['C_CVST']) && !empty($get['C_TELE'])) {
    $oldGo = filter_var($get['oldGo']);
    $flag = filter_var($get['error']);
    $C_CVGE = filter_var($get['C_CVGE']);
    $C_CONT = filter_var($get['C_CONT']);
    $C_CVST = filter_var($get['C_CVST']);
    $C_CVBA = filter_var($get['C_CVBA']);
    $ACCION = filter_var($get['ACCION']);
    $C_MOTIV = filter_var($get['C_MOTIV']);
    $D_FECH = filter_var($get['D_FECH']);
    $C_HRIN = filter_var($get['C_HRIN']);
    $C_TELE = filter_var($get['C_TELE']);
    $CUANDO = filter_var($get['CUANDO']);
    $CUENTA = filter_var($get['CUENTA']);
    $C_OBSE1 = filter_var($get['C_OBSE1']);
    $C_ATTE = filter_var($get['C_ATTE']);
    $C_CNP = filter_var($get['C_CNP']);
    $C_CONTAN = filter_var($get['C_CONTAN']);
    $C_CARG = filter_var($get['C_CARG']);
    $C_CAMP = filter_var($get['camp']);
    $D_PROM1 = filter_var($get['D_PROM1']);
    $D_PROM2 = filter_var($get['D_PROM2']);
    $D_PROM3 = filter_var($get['D_PROM3']);
    $D_PROM4 = filter_var($get['D_PROM4']);
    $D_PAGO = filter_var($get['D_PAGO']);
    $N_PAGO = filter_var($get['N_PAGO']);
    $C_PROM = filter_var($get['C_PROM']);
    $N_PROM1 = 0;
    if (!empty($get['N_PROM1'])) {
        $N_PROM1 = filter_var($get['N_PROM1'], FILTER_SANITIZE_NUMBER_FLOAT) + 0;
    }
    $N_PROM2 = 0;
    if (!empty($get['N_PROM2'])) {
        $N_PROM2 = filter_var($get['N_PROM2'], FILTER_SANITIZE_NUMBER_FLOAT) + 0;
    }
    $N_PROM3 = 0;
    if (!empty($get['N_PROM3'])) {
        $N_PROM3 = filter_var($get['N_PROM3'], FILTER_SANITIZE_NUMBER_FLOAT) + 0;
    }
    $N_PROM4 = 0;
    if (!empty($get['N_PROM4'])) {
        $N_PROM4 = filter_var($get['N_PROM4'], FILTER_SANITIZE_NUMBER_FLOAT) + 0;
    }
    $C_NTEL = filter_var($get['C_NTEL']);
    $C_NDIR = filter_var($get['C_NDIR']);
    $C_EMAIL = filter_var($get['C_EMAIL']);
    $C_OBSE2 = filter_var($get['C_OBSE2']);
    $C_EJE = filter_var($get['C_EJE']);
    $C_HRFI = date('H:i:s');
    $N_PROM = $N_PROM1 + $N_PROM2 + $N_PROM3 + $N_PROM4;
    $AUTH = filter_var($get['AUTH']);
    if ($C_CVGE != $capt) {
        $AUTH = $capt;
    }
    if ($mytipo == 'admin') {
        $AUTH = $capt;
    }
    if (empty($AUTH)) {
        $AUTH = '';
    }
    $error = 0;
    $D_PROM = $D_PROM1;
    $flagmsg = "";
    $pagosArray = ['PAGANDO CONVENIO', 'PAGO DE CONVENIO', 'PAGO TOTAL', 'PAGO RECURRENTE', 'PAGO PARCIAL'];
    $promsArray = ['PROMESA DE PAGO TOTAL', 'PROMESA DE PAGO RECURRENTE', 'PROMESA DE PAGO PARCIAL'];
    if (($N_PAGO == 0) && (in_array($C_CVST, $pagosArray))) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<br>' . $C_CVST . ' necesita monto';
    }
    if ((substr($C_CVST, 0, 11) == 'MENSAJE CON') && ($C_CARG == '')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . $C_CVST . " NECESITA PARENTESCO/CARGO";
    }
    if (($N_PROM == 0) && (in_array($C_CVST, $promsArray))) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . $C_CVST . "PROMESA NECESITA MONTO";
    }
    if (($N_PROM > 0) && ($D_PROM == '0000-00-00')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA FECHA";
    }
    if (($N_PAGO > 0) && ($D_PAGO == '0000-00-00')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PAGO NECESITA FECHA";
    }
    if (($N_PROM > 0) && ($D_PROM == '')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA FECHA";
    }
    if (($N_PROM == 0) && ($D_PROM >= $D_FECH)) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PROMESA NECESITA MONTO";
    }
    if (($N_PAGO == 0) && ($D_PAGO > '0000-00-00')) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "PAGO NECESITA MONTO";
    }
    if (($N_PROM1 == 0) && ($N_PROM2 > 0)) {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "USA PROMESA INICIAL ANTES PROMESA TERMINAL";
    }
    if ($C_TELE == '') {
        $error = $error + 1;
        $flagmsg = $flagmsg . '<BR>' . "GESTION NECESITA TELEFONO";
    }

    if ($error > 0) {
        die($flagmsg);
    }
    try {
        $gc->doGestion($get);
    } catch (Exception $e) {
        $error = 1000;
        $flagmsg = $e->getMessage();
    }

    if ($find == "/") {
        $find = NULL;
    }
    if ($capt == "/") {
        $capt = NULL;
    }

    $redirector = "Location: resumen.php?capt=" . $capt;
    header($redirector);
}

$userData = $rc->getUserData($capt);
$mytipo = $userData->TIPO;
$camp = $userData->camp;
if (empty($go)) {
    $go = '';
}
if (empty($find)) {
    $find = '';
}
try {
    $row = $qc->getNextAccount($capt, $camp, $go, $find);
} catch (Exception $e) {
    die($e->getMessage());
}

$id_cuenta = $row->id_cuenta;
$nombre_deudor = $row->nombre_deudor;
$domicilio_deudor = $row->domicilio_deudor;
$colonia_deudor = $row->colonia_deudor;
$ciudad_deudor = $row->ciudad_deudor;
$estado_deudor = $row->estado_deudor;
$cp_deudor = $row->cp_deudor;
$plano_guia_roji = $row->plano_guia_roji;
$cuadrante_guia_roji = $row->cuadrante_guia_roji;
$tel_1 = $row->tel_1;
$tel_2 = $row->tel_2;
$tel_3 = $row->tel_3;
$tel_4 = $row->tel_4;
$nombre_deudor_alterno = $row->nombre_deudor_alterno;
$domicilio_deudor_alterno = $row->domicilio_deudor_alterno;
$colonia_deudor_alterno = $row->colonia_deudor_alterno;
$ciudad_deudor_alterno = $row->ciudad_deudor_alterno;
$estado_deudor_alterno = $row->estado_deudor_alterno;
$cp_deudor_alterno = $row->cp_deudor_alterno;
$tel_1_alterno = $row->tel_1_alterno;
$tel_2_alterno = $row->tel_2_alterno;
$tel_3_alterno = $row->tel_3_alterno;
$tel_4_alterno = $row->tel_4_alterno;
$plazo = $row->plano_guia_roji_alterno;
$dia_corte = $row->cuadrante_guia_roji_alterno;
$status_aarsa = $row->status_aarsa;
$avapar = $row->avapar;
$referencias_1 = $row->parentesco_ref_1;
$nombre_referencia_1 = $row->nombre_referencia_1;
$domicilio_referencia_1 = $row->domicilio_referencia_1;
$colonia_referencia_1 = $row->colonia_referencia_1;
$ciudad_referencia_1 = $row->ciudad_referencia_1;
$estado_referencia_1 = $row->estado_referencia_1;
$cp_referencia_1 = $row->cp_referencia_1;
$tel_1_ref_1 = $row->tel_1_ref_1;
$tel_2_ref_1 = $row->tel_2_ref_1;
$referencias_2 = $row->parentesco_ref_2;
$nombre_referencia_2 = $row->nombre_referencia_2;
$domicilio_referencia_2 = $row->domicilio_referencia_2;
$colonia_referencia_2 = $row->colonia_referencia_2;
$ciudad_referencia_2 = $row->ciudad_referencia_2;
$estado_referencia_2 = $row->estado_referencia_2;
$cp_referencia_2 = $row->cp_referencia_2;
$tel_1_ref_2 = $row->tel_1_ref_2;
$tel_2_ref_2 = $row->tel_2_ref_2;
$referencias_3 = $row->parentesco_ref_3;
$nombre_referencia_3 = $row->nombre_referencia_3;
$domicilio_referencia_3 = $row->domicilio_referencia_3;
$colonia_referencia_3 = $row->colonia_referencia_3;
$ciudad_referencia_3 = $row->ciudad_referencia_3;
$estado_referencia_3 = $row->estado_referencia_3;
$cp_referencia_3 = $row->cp_referencia_3;
$tel_1_ref_3 = $row->tel_1_ref_3;
$tel_2_ref_3 = $row->tel_2_ref_3;
$referencias_4 = $row->parentesco_ref_4;
$nombre_referencia_4 = $row->nombre_referencia_4;
$domicilio_deudor_2 = $row->originacion;
$frecuencia = $row->multiestrategia;
$ciudad_referencia_4 = $row->ciudad_referencia_4;
$estado_referencia_4 = $row->estado_referencia_4;
$cp_referencia_4 = $row->cp_referencia_4;
$tel_1_ref_4 = $row->tel_1_ref_4;
$tel_2_ref_4 = $row->tel_2_ref_4;
$domicilio_laboral = $row->domicilio_laboral;
$colonia_laboral = $row->colonia_laboral;
$ciudad_laboral = $row->ciudad_laboral;
$estado_laboral = $row->estado_laboral;
$cp_laboral = $row->cp_laboral;
$tel_1_laboral = $row->tel_1_laboral;
$tel_2_laboral = $row->tel_2_laboral;
$gastos_de_cobranza = $row->saldo_corriente;
$fecha_de_actualizacion = $row->fecha_de_actualizacion;
$numero_de_cuenta = $row->numero_de_cuenta;
$numero_de_credito = $row->numero_de_credito;
$contrato = $row->contrato;
$saldo_total = $row->saldo_total;
$saldo_vencido = $row->saldo_vencido;
$saldo_descuento_1 = $row->saldo_descuento_1;
$saldo_descuento_2 = $row->saldo_descuento_2;
$fecha_corte = $row->fecha_corte;
$fecha_1er_pago = $row->fecha_limite;
$fecha_de_ultimo_pago = $row->fecha_de_ultimo_pago;
$monto_ultimo_pago = $row->monto_ultimo_pago;
$producto = $row->producto;
$subproducto = $row->subproducto;
$cliente = $row->cliente;
$status_de_credito = $row->status_de_credito;
$pagos_vencidos = $row->pagos_vencidos;
$monto_adeudado = $row->monto_adeudado;
$fecha_de_asignacion = $row->fecha_de_asignacion;
$fecha_de_deasignacion = $row->fecha_de_deasignacion;
$cuenta_concentradora_1 = $row->cuenta_concentradora_1;
$saldo_cuota = $row->saldo_cuota;
$email_deudor = $row->email_deudor;
$id_cuenta = $row->id_cuenta;
$nss = $row->nss;
$rfc_deudor = $row->rfc_deudor;
$telefonos_marcados = $row->telefonos_marcados;
$tel_1_verif = $row->tel_1_verif;
$tel_2_verif = $row->tel_2_verif;
$tel_3_verif = $row->tel_3_verif;
$tel_4_verif = $row->tel_4_verif;
$telefono_de_ultimo_contacto = $row->telefono_de_ultimo_contacto;
$dias_vencidos = $row->dias_vencidos;
$ejecutivo_asignado_call_center = $row->ejecutivo_asignado_call_center;
$ejecutivo_asignado_domiciliario = $row->ejecutivo_asignado_domiciliario;
$prioridad_de_gestion = $row->prioridad_de_gestion;
$nrpp = $row->nrpp;
$parentesco_aval = $row->parentesco_aval;
$localizar = $row->localizar;
$fecha_ultima_gestion = $row->fecha_ultima_gestion;
$empresa = $row->empresa;
$fecha_convenio = $row->fecha_convenio;
$direccion_nueva = $row->direccion_nueva;
$timelock = $row->timelock;
$locker = $row->locker;
$fecha_convenio = $row->fecha_convenio;
$especial = $row->especial;
$direccion_nueva = $row->direccion_nueva;
$norobot = $row->norobot;

$latest = $rc->getLastStatus($id_cuenta);

$C_OBSE2 = $latest->C_OBSE2;
$ultimo_status_de_la_gestion = $latest->C_CVST;
$CUANDO = $latest->CUANDO;

if ($id_cuenta == 0) {
    $newCamp = $rc->leaveEmptyQueue($capt);
}
$currentQueue = $qc->getStatusQueue($row->status_aarsa);
if ($id_cuenta > 0) {
    $lastProm = $rc->getPromData($id_cuenta);
    $N_PROM_OLD = $lastProm->N_PROM;
    $D_PROM_OLD = $lastProm->D_PROM;
    $N_PROM1_OLD = $lastProm->N_PROM1;
    $D_PROM1_OLD = $lastProm->D_PROM1;
    $N_PROM2_OLD = $lastProm->N_PROM2;
    $D_PROM2_OLD = $lastProm->D_PROM2;
    $N_PROM3_OLD = $lastProm->N_PROM3;
    $D_PROM3_OLD = $lastProm->D_PROM3;
    $N_PROM4_OLD = $lastProm->N_PROM4;
    $D_PROM4_OLD = $lastProm->D_PROM4;
}
try {
    $lockDate = new DateTime($timelock);
    $nowDate = new DateTime();
    $sofar = $nowDate->diff($lockDate);
} catch (Exception $e) {
    die($e->getMessage());
}

$tl = date('r');
$rc->setLocks($capt, $id_cuenta);
if ($timelock) {
    $tl = date('D M d Y H:i:s O', strtotime($timelock));
}


$CD = date("Y-m-d");
$CT = date("H:i:s");
$others = 0;

$resultFilter = $rc->getQueueList($capt);

$resultNumGests = $rc->getNumGests($capt);

$resultNumProm = $rc->getNumProm($capt);

$clientes = $bc->listClients();

$resultAccion = $rc->getAccion();

$resultMotiv = $rc->getMotiv();

$resultDictamen = $rc->getDict($mytipo);

$resultAccionV = $rc->getAccionV();

$resultDictamenV = $rc->getDictV();

$resultMotivV = $rc->getMotivV();

$resultGestorV = $rc->getVisitadorList();

$resultGestor = $rc->getGestorList();

if ($id_cuenta > 0) {
    $rowSub = $rc->getHistory($id_cuenta);
}
$resultBN = new BadNoObject();
if (is_int($id_cuenta)) {
    $resultBN = $rc->getBadNo($id_cuenta);
}

$resultCnp = $rc->getCnp();

$hasPic = FALSE;
$picFile = '';
$path = dirname(__FILE__) . ' / pics / ' . $numero_de_cuenta . ' . jpg';
if (realpath($path)) {
    $hasPic = TRUE;
    $picFile = 'pics / ' . $numero_de_cuenta . ' . jpg';
}
$gestiones = $rc->countGestiones($id_cuenta);
$promesas = $rc->countPromesas($id_cuenta);
$pagos = $rc->countPagos($id_cuenta);
if (empty($row->nombre_deudor)) {
    $row = new ResumenObject();
}
include __DIR__ . '/views/resumenView.php';
