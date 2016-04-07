<?php
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$con = mysql_connect($host, $user, $pwd) or die("Could not connect to MySQL");
mysql_select_db($db, $con) or die("Could not select $db database");
$querymaina = "create temporary table foliolist 
select distinct folios.cliente as 'cliente',folio,enviado,'' as 'upda','' as 'crear',folio as 'folio2',
numero_de_cuenta as 'cuenta',
nombre_deudor,mora,capital,saldo_can-capital as 'im',
if(h1.n_prom>capital,0,100-(h1.n_prom/capital*100)) as 'pc1',
if(h1.n_prom<capital,100,100-((h1.n_prom-capital)/(saldo_can-capital)*100)) as 'pc2',
h1.d_prom,h1.n_prom,'' as 'blank1','' as 'blank2',
folios.gestor,'Cobranza Integral' as 'despacho',h2.auto as 'upd',h1.d_fech
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and folios.fecha<concat(h2.d_fech,' ',h2.c_hrin) and h2.c_cvst = 'PROMESA DE PAGO TOTAL'
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
and folios.cliente regexp 'Surtidor del Hogar'
and not exists (select auto from historia h2 
where h2.c_cont=id and h2.n_prom>0 and h2.c_cvst like 'PROMESA DE%' 
and h2.auto>h1.auto and concat(h2.d_fech,' ',h2.c_hrin)<=folios.fecha)
and h1.c_cvst like 'PROMESA DE%' order by folio";
mysql_query($querymaina) or die('Pass1: ' . mysql_error());
$querymainb = "insert into foliolist 
select distinct folios.cliente,folio,enviado,'','',folio,
numero_de_cuenta,nombre_deudor,mora,capital,saldo_can-capital as im,
if(h1.n_prom>capital,0,100-(h1.n_prom/capital*100)) as pc1,
if(h1.n_prom<capital,100,100-((h1.n_prom-capital)/(saldo_can-capital)*100)) as pc2,
h1.d_prom,h1.n_prom,'','',
folios.gestor,'Cobranza Integral' as despacho,h2.auto as upd,h1.d_fech
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and h2.d_fech > h1.d_fech and folios.fecha>h2.d_fech 
and h2.c_cvst like 'PRO%DE%'
join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and h2.auto is null
and exists (
select * from historia where pagos.fecha between d_fech and d_prom
and id=c_cont
)
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and folios.cliente regexp 'Surtidor del Hogar' group by folio
";
mysql_query($querymainb) or die('Pass2: ' . mysql_error());
$aColumns = array('cliente', 'folio', 'enviado', 'upd', 'crear', 'folio', 'cuenta',
    'nombre_deudor', 'mora', 'capital', 'im', 'pc1', 'pc2', 'n_prom', 'd_prom', 'n_prom',
    'blank1', 'blank2', 'gestor', 'despacho'
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
folio desc,d_fech desc,d_prom desc ";
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
//	die ($sQuery);
$rResult = mysql_query($sQuery, $con) or die(mysql_error());

/* Data set length after filtering */
$sQueryl = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = mysql_query($sQueryl, $con) or die(mysql_error());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(1)
		FROM   $sTable
	";
$rResultTotal = mysql_query($sQuery, $con) or die(mysql_error());
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
//	if (!empty($output['aaData'])) {
echo json_encode($output);
//}	else {die($iTotal);}
?>
