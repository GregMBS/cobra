<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pd = new PdoClass();
$pdo = $pd->dbConnectAdmin();
$capt = $pd->capt;
$cargas = [
    ['page' => 'carga2',
        'label' => 'Cargar Cartera'],
    ['page' => 'pagobulk',
        'label' => 'Cargar Pagos Confirmados'],
    ['page' => 'cargaPic',
        'label' => 'Cargar Foto']
];
$visitas = [
    ['page' => 'checkout',
        'label' => 'Asignar Visitas'],
    ['page' => 'checkin',
        'label' => 'Recibir Visitas'],
    ['page' => 'checkoutlist',
        'label' => 'Check List']
];
$admin = [
    ['page' => 'gestoradmin',
        'label' => 'Administrar Acesso'],
    ['page' => 'breakadmin',
        'label' => 'Administrar Breaks'],
    ['page' => 'queues',
        'label' => 'Administrar Queues'],
    ['page' => 'notadmin',
        'label' => 'Administrar Notas'],
    ['page' => 'segmentadmin',
        'label' => 'Administrar Segmentos'],
    ['page' => 'changest',
        'label' => 'Cambiar Status de Credito'],
    ['page' => 'inactivar',
        'label' => 'Inactivar Cuentas'],
    ['page' => 'activar',
        'label' => 'Activar Cuentas']
];
$queues = [
    ['page' => 'queuesqc',
        'label' => 'Queues por Cliente'],
    ['page' => 'latest_best',
        'label' => 'Ultimo y Mejor Status']
];
$promPago = [
    ['page' => 'rotas',
        'label' => 'Promesas del Mes Actual'],
    ['page' => 'pagosum',
        'label' => 'Pagos por Cliente'],
    ['page' => 'pagodet',
        'label' => 'Pagos este mes (XLSX)'],
    ['page' => 'pagodetant',
        'label' => 'Pagos mes anterior (XLSX)']
];
$horarios = [
    ['page' => 'horarios_clean',
        'label' => 'Productividad este Mes'],
    ['page' => 'perfmes',
        'label' => 'Productividad Mes Anterior'],
    ['page' => 'horariosv',
        'label' => 'Productividad Visit este Mes'],
    ['page' => 'perfmesv',
        'label' => 'Productividad Visit Mes Ant'],
    ['page' => 'horarios_clean2',
        'label' => 'Nomina Confidential']
    ];
$XLS = [
    ['page' => 'bigquery2',
        'label' => 'Query de las Gestiones XLS'],
    ['page' => 'bigproms',
        'label' => 'Query de las Promesas XLS'],
    ['page' => 'pagosquery',
        'label' => 'Query de Pagos XLS'],
    ['page' => 'inventario',
        'label' => 'Query del Inventario XLS'],
    ['page' => 'inventario-rapid',
        'label' => 'Query del Inventario Rapido XLS'],
    ['page' => 'tels_contactados',
        'label' => 'Reporte de Tel&eacute;fonos Contactados XLS'],
    ['page' => 'tels_marcados',
        'label' => 'Reporte de Tel&eacute;fonos Marcados XLS']
    ];

require_once 'views/reportsView.php';