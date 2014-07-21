<?php

include_once 'pdo_connect.php';
$capt = filter_input(INPUT_COOKIE, 'capt');
$iDisplayStart = intval(filter_input(INPUT_GET, 'iDisplayStart', FILTER_SANITIZE_NUMBER_INT));
$iDisplayLength = intval(filter_input(INPUT_GET, 'iDisplayLength', FILTER_SANITIZE_NUMBER_INT));
$iSortCol_0 = intval(filter_input(INPUT_GET, 'iSortCol_0', FILTER_SANITIZE_NUMBER_INT));
$iSortingCols = intval(filter_input(INPUT_GET, 'iSortingCols', FILTER_SANITIZE_NUMBER_INT));
$aColumns = array('tel', 'nombre', 'calle', 'colonia', 'ciudad', 'estado', 'cp');
$sTable = 'gray';
$sIndexColumn = '1';
/*
 * Paging
 */
$sLimit = "";
if (isset($iDisplayStart) && $iDisplayLength != '-1') {
    $sLimit = "LIMIT $iDisplayStart. $iDisplayLength";
}


/*
 * Ordering
 */
$sOrder0 = "";
if (isset($iSortCol_0)) {
    $sOrder0 = "ORDER BY  ";
    for ($i = 0; $i < $iSortingCols; $i++) {
        $sSortDir0 = filter_input('sSortDir_' . $i);
        if ($sSortDir0 == 'DESC') {
            $sSortDir = 'DESC';
        } else {
            $sSortDir = '';
        }
        $iSortCol = filter_input('iSortCol_' . $i, FILTER_SANITIZE_NUMBER_INT);
        $bSortable = filter_input('bSortable_' . $iSortCol, FILTER_SANITIZE_NUMBER_INT);
        if ($bSortable == "true") {
            $sOrder0 .= $aColumns[intval($iSortCol)] . "
				 	" . $sSortDir . ", ";
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
$aWhere = array();
$sWhere0 = "WHERE (";
for ($i = 0; $i < count($aColumns); $i++) {
    $whereCol = filter_input($aColumns[$i]);
    if (!empty($whereCol)) {
        $sWhere0 .= $aColumns[$i] . " LIKE :" . $aColumns[$i] . " AND ";
    }
    $aWhere[":" . $aColumns[$i]] = "%" . trim($whereCol) . "%";
}
$sWhere = substr_replace($sWhere0, "", -4);

/* Individual column filtering */
for ($i = 0; $i < count($aColumns); $i++) {
    $bSearchable = filter_input(INPUT_GET, 'bSearchable_' . $i);
    $sSearch = filter_input(INPUT_GET, 'sSearch_' . $i);
    if (isset($bSearchable) && $bSearchable == "true" && $sSearch != '') {
        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i] . " LIKE '%" . $sSearch . "%' ";
    }
}
$sWhere .= ")";


/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
//if ($capt='gmbs') {die ($sQuery);}
$rResult = mysql_query($sQuery, $con) or die(mysql_error());

/* Data set length after filtering */
$sQuery = "
		SELECT FOUND_ROWS()
	";
$rResultFilterTotal = $pdo->query($sQuery);
$aResultFilterTotal = $rResultFilterTotal->fetch();
;
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "
		SELECT COUNT(1)
		FROM  $sTable
		$sWhere 
	";

$rResultTotal = $pdo->query($sQuery);
$aResultTotal = $rResultTotal->fetchAll();
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval(filter_input(INPUT_GET, 'sEcho', FILTER_SANITIZE_NUMBER_INT)),
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
//}
//	else {}

