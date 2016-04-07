<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "AwRats";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$sQuery="CREATE temporary TABLE  `parcial` (
  `hauto` int(11) NOT NULL,
  `cuenta` varchar(255) COLLATE utf8_spanish_ci,
  `cliente` varchar(255) COLLATE utf8_spanish_ci,
  `segmento` varchar(255) COLLATE utf8_spanish_ci,
  `producto` varchar(255) COLLATE utf8_spanish_ci,
  `subproducto` varchar(255) COLLATE utf8_spanish_ci,
  `queue` varchar(255) COLLATE utf8_spanish_ci,
  `status` varchar(255) COLLATE utf8_spanish_ci,
  `nombre` varchar(255) COLLATE utf8_spanish_ci,
  `nprom` decimal(10,2),
  `nprom1` decimal(10,2),
  `dprom1` date,
  `nprom2` decimal(10,2),
  `dprom2` date,
  `folio` int(11),
  `gestor` varchar(255) COLLATE utf8_spanish_ci,
  `monto` decimal(10,2),
  `fecha` date,
  `mvig` decimal(10,2),
  `mven` decimal(10,2),
  `mpag` decimal(10,2),
  INDEX (`hauto`)
)";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table ptemp 
select auto as pauto,id_cuenta,monto,fecha 
from pagos 
where fecha>last_day(curdate()-interval 1 month) and confirmado=0
;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table htemp
select * 
from historia 
where (not (d_prom1<last_day(curdate()-interval 1 month)))
and (not (d_prom2<last_day(curdate()-interval 1 month)))";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table parcialtemp 
SELECT *
from ptemp,htemp 
where c_cont=id_cuenta and fecha between d_fech and d_prom
;";
mysql_query( $sQuery, $con ) or die(mysql_error().$sQuery);
$sQuery="insert into parcial
select parcialtemp.auto,parcialtemp.cuenta,resumen.cliente,status_de_credito,
producto,subproducto,queue,
status_aarsa,nombre_deudor,n_prom,n_prom1,d_prom1,n_prom2,d_prom2,
folio,c_cvge,monto,parcialtemp.fecha,0,0,monto
from parcialtemp
join resumen on c_cont=resumen.id_cuenta
join dictamenes on status_aarsa=dictamen
left join folios on id=c_cont and folios.fecha between d_fech and d_prom
;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update parcial
set mven=greatest(0,((nprom1*(dprom1<curdate()))+(nprom2*(dprom2<curdate()))-mpag));";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update parcial
set mvig=nprom-mpag-mven;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$aColumns=array('hauto','cuenta','cliente','segmento','producto',
'subproducto','queue','status','nombre',
'nprom','nprom1','dprom1','nprom2','dprom2',
'folio','gestor','monto','fecha','mvig','mven','mpag');
$sTable='parcial';
$sIndexColumn='1';
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
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
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( 
			$_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
$sGroup="";	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sGroup
		$sLimit
	";
//	die ($sQuery);
	$rResult = mysql_query( $sQuery, $con ) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $con ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(1)
		FROM   parcial
	";
	$rResultTotal = mysql_query( $sQuery, $con ) or die(mysql_error());
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
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	if (!empty($output['aaData'])) {
echo json_encode( $output );}
	else {die($iTotal);}
?>
