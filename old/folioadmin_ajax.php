<?php
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$con = mysql_connect($host, $user, $pwd) or die("Could not connect to MySQL");
mysql_select_db($db, $con) or die("Could not select $db database");
$queryclean = "drop table if exists foliolist";
mysql_query($queryclean) or die(mysql_error());
$querymaina = "create table foliolist 
select distinct folios.cliente as 'cliente',folio,enviado,h2.auto as 'upda','' as 'crear',
ifnull(numero_de_credito,numero_de_cuenta) as 'cuenta',
nombre_deudor,capital,saldo_can,
mora,h1.n_prom as 'n_prom',h1.d_prom1 as 'd_prom1',h1.n_prom1 as 'n_prom1',
h1.d_prom2 as 'd_prom2',h1.n_prom2 as 'n_prom2',
h1.d_prom3 as 'd_prom3',h1.n_prom3 as 'n_prom3',
h1.d_prom4 as 'd_prom4',h1.n_prom4 as 'n_prom4',
cuenta_concentradora_1,h1.d_fech as 'd_fech',resumen.id_cuenta as 'id_cuenta',
h1.c_cvst as 'cnp',folios.auto as 'auto',
ciudad_deudor,estado_deudor,
folios.gestor as 'gestor',substring_index(status_de_credito,'-',1) as 'sdc','' as upd,
h1.c_prom as 'c_prom',h1.c_freq as 'c_freq',to_days(h1.d_prom2)-to_days(h1.d_prom1) as 'diff'
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and folios.fecha<concat(h2.d_fech,' ',h2.c_hrin) and h2.c_cvst like 'PRO%DE%'
left join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and exists (
select * from historia where pagos.fecha between d_fech and d_prom
and id=c_cont
)
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and monto is null
and folios.cliente regexp 'Credito Si'
and h1.c_cvst like 'PROMESA DE%' order by folio";
mysql_query($querymaina) or die(mysql_error());
$querymainb = "insert into foliolist 
select distinct folios.cliente,folio,enviado,'','',
ifnull(numero_de_credito,numero_de_cuenta),
nombre_deudor,capital,saldo_can,
mora,sum(pagos.monto),max(pagos.fecha),sum(pagos.monto),h1.d_prom1,h1.n_prom1,
h1.d_prom2,h1.n_prom2,h1.d_prom3,h1.n_prom3,
cuenta_concentradora_1,h1.d_fech,resumen.id_cuenta,
h1.c_cvst,folios.auto,ciudad_deudor,estado_deudor,
folios.gestor,substring_index(status_de_credito,'-',1),'' as upd,h1.c_prom,h1.c_freq,
to_days(h1.d_prom1)-to_days(max(pagos.fecha))
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and exists (
select * from historia where pagos.fecha between d_fech and d_prom
and id=c_cont
)
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and folios.cliente regexp 'Credito Si' group by folio
";
mysql_query($querymainb) or die(mysql_error());
$aColumns = array('cliente', 'folio', 'enviado', 'upd', 'crear', 'cuenta',
    'nombre_deudor', 'capital', 'saldo_can', 'mora', 'n_prom1+n_prom2+n_prom3+n_prom4', 'd_prom1', 'n_prom1',
    'd_prom2', 'n_prom2', 'd_prom3', 'n_prom3', 'd_prom4', 'n_prom4', 'folio', 'cnp', 'c_prom', 'cuenta_concentradora_1', 'diff', 'd_fech',
    'gestor', 'sdc'
);
$sTable = 'foliolist';
/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " .
            mysql_real_escape_string($_GET['iDisplayLength']);
}


/*
 * Ordering
 */
$sOrder = "ORDER BY enviado,upd desc,
folio desc,d_fech desc,d_prom1 desc ";
if (isset($_GET['iSortCol_0'])) {
    $sOrder0 = "ORDER BY ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder0 .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
                    " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
        }
    }

    $sOrder = substr_replace($sOrder0, "", -2);
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
    $sWhere0 = "WHERE (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere0 .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string(
                        $_GET['sSearch']) . "%' OR ";
    }
    $sWhere = substr_replace($sWhere0, "", -3);
}

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
    if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
    }
}
$sGroup = "";

/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
        SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
        FROM   $sTable
        $sWhere
        $sOrder
        $sGroup
        $sLimit
    ";
//  die ($sQuery);
$rResult = mysql_query($sQuery, $con) or die(mysql_error());

/* Data set length after filtering */
$sQueryft = "
        SELECT FOUND_ROWS()
    ";
$rResultFilterTotal = mysql_query($sQueryft, $con) or die(mysql_error());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuerydl = "
        SELECT COUNT(auto)
        FROM   $sTable
    ";
$rResultTotal = mysql_query($sQuerydl, $con) or die(mysql_error());
$aResultTotal = mysql_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

while ($aRow = mysql_fetch_array($rResult)) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        if ($aColumns[$i] == "version") {
            /* Special output formatting for 'version' column */
            $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
        } else if ($aColumns[$i] != ' ') {
            /* General output */
            $row[] = $aRow[$aColumns[$i]];
        }
    }
    $output['aaData'][] = $row;
}
if (!empty($output['aaData'])) {
    echo json_encode($output);
} else {
    echo json_encode($output);
}
?>
