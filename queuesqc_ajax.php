<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "AwRats";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$sQuery="CREATE TEMPORARY TABLE  `queuesqc` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `segmento` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `asig` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qstats` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qpc` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qday` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qdaypc` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qweek` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qweekpc` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qmonth` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `qmonthpc` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`auto`), INDEX (`cliente`,`segmento`,`queue`)
)";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="insert into queuesqc (cliente,segmento,queue) 
select distinct cliente, status_de_credito,queue
from resumen join dictamenes on status_aarsa=dictamen
where status_de_credito not like '%o'
order by cliente,status_de_credito,queue;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="CREATE TEMPORARY TABLE  `asigtemp` (
  `cliente` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `status_de_credito` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `act` INT(11),
  `amt` DECIMAL(10,2),
  PRIMARY KEY (`cliente`,`status_de_credito`)
)";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="insert into asigtemp
SELECT cliente,status_de_credito,count(1) as act,sum(saldo_total) as amt 
FROM resumen 
group by cliente,status_de_credito;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update asigtemp a,queuesqc q
set asig=concat(act,'<br>',amt)
where a.cliente=q.cliente and status_de_credito=segmento;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table counttemp 
select cliente,status_de_credito,queue,count(1) as ct,
sum(fecha_ultima_gestion>curdate()) as cd, 
sum(fecha_ultima_gestion>curdate() - interval 6 day) as cw,
sum(fecha_ultima_gestion > last_day(curdate() - interval 1 month - interval 1 day)) as cm,
sum(saldo_total) as st,
sum(saldo_total*(fecha_ultima_gestion>curdate())) as sd, 
sum(saldo_total*(fecha_ultima_gestion>curdate() - interval 6 day)) as sw,
sum(saldo_total*(fecha_ultima_gestion > last_day(curdate() - interval 1 month - interval 1 day))) as sm
from resumen 
join dictamenes on status_aarsa=dictamen
group by cliente,status_de_credito,queue;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update counttemp c,queuesqc q, asigtemp a
set qstats=concat(ct,'<br>',st),qday=concat(cd,'<br>',sd),
qweek=concat(cw,'<br>',sw),qmonth=concat(cm,'<br>',sm),
qpc=concat(round(ct/act*100),'%<br>',round(st/amt*100),'%'),
qdaypc=concat(round(cd/ct*100),'%<br>',round(sd/st*100),'%'),
qweekpc=concat(round(cw/ct*100),'%<br>',round(sw/st*100),'%'),
qmonthpc=concat(round(cm/ct*100),'%<br>',round(sm/st*100),'%')
where c.cliente=q.cliente and c.status_de_credito=segmento and c.queue=q.queue
and c.cliente=a.cliente and a.status_de_credito=segmento;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$aColumns=array('cliente','segmento','asig','queue',
'qstats','qpc','qday','qdaypc','qweek','qweekpc','qmonth','qmonthpc');
$sTable='queuesqc';
$sIndexColumn='auto';
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
		SELECT COUNT(auto)
		FROM   $sTable
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
