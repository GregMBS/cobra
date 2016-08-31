<?php

$queryg = "SELECT distinct c_cvge FROM historia
        where c_cvge <> ''
        order by c_cvge
        limit 1000
	";
$resultg = $pdo->query($queryg);
$queryc = "SELECT distinct c_cvba FROM historia
        order by c_cvba
        limit 100
	";
$resultc = $pdo->query($queryc);
$queryf1 = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 12 month)
        ORDER BY d_fech limit 360";
$resultf1 = $pdo->query($queryf1);
$queryf2 = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 12 month)
        ORDER BY d_fech desc limit 60";
$resultf2 = $pdo->query($queryf2);

if (isset($get['fecha1'])) {
    $go = $get['go'];
    $gestor = $get['gestor'];
    $fecha1 = $get['fecha1'];
    $fecha2 = $get['fecha2'];
    if (isset($get['tipo'])) {
        $tipo = $get['tipo'];
    } else {
        $tipo = '';
    }
    if ($fecha2 < $fecha1) {
        list($fecha1, $fecha2) = array($fecha2, $fecha1);
    }
//$gestorstr=" and ejecutivo_asignado_call_center not regexp '-' ";
    $gestorstr = '';
    $clientestr = '';
    if (isset($get['cliente'])) {
        $cliente_array = $get['cliente'];
        $clientes = filter_var_array($cliente_array, FILTER_SANITIZE_ENCODED);
        $clientestr = " AND resumen.cliente IN ('" . urldecode(implode("','", $clientes)) . "') ";
    }
    if ($gestor != 'todos') {
        $gestorstr = " and c_cvge=:gestor ";
    }
    if ($tipo == 'visits') {
        $gestorstr .= " and c_visit <> '' and c_msge is null ";
    }
    if ($tipo == 'telef') {
        $gestorstr .= " and c_visit IS NULL and c_msge is null ";
    }
    if ($tipo == 'admin') {
        $gestorstr .= " and c_msge <> '' ";
    }
    if ($tipo == 'noadmin') {
        $gestorstr .= " and c_msge IS NULL ";
    }
    if ($tipo == 'todos') {
        $gestorstr .= " ";
    }

    $querymain = "SELECT numero_de_cuenta as 'cuenta',nombre_deudor as 'nombre',
    resumen.cliente as 'cliente',status_de_credito as 'segmento', subproducto,
    saldo_total,saldo_descuento_1,saldo_descuento_2,d1.queue,h1.*,d2.v_cc as ponderacion,
    domicilio_deudor as calle,colonia_deudor as 'colonia',
    direccion_nueva as 'direccion nueva',email_deudor,pagos.fecha as 'fecha pago',
    pagos.monto as 'monto pago', fecha_de_asignacion as 'fecha de asignacion'
    from resumen join historia h1 on c_cont=resumen.id_cuenta
left join dictamenes d1 on status_aarsa=d1.dictamen
left join dictamenes d2 on c_cvst=d2.dictamen
left join pagos on c_cont=pagos.id_cuenta and d2.queue='PAGOS' and fecha between last_day(d_fech-interval 1 month) and d_fech
where d_fech between :fecha1 and :fecha2
" . $gestorstr . $clientestr . "
ORDER BY d_fech,c_hrin
    ;";
    $stm = $pdo->prepare($querymain);
    $stm->bindParam(':fecha1', $fecha1);
    $stm->bindParam(':fecha2', $fecha2);
    if ($gestor != 'todos') {
        $stm->bindParam(':gestor', $gestor);
    }
    $stm->execute();
    $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
}