<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$sQuery="CREATE TEMPORARY TABLE  `breaktab` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci,
  `tiempo` time,
  `ntp` time,
  `diff` int(11),
  PRIMARY KEY (`auto`)
)";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="insert into breaktab (gestor,tipo,tiempo) 
select c_cvge,c_cvst,c_hrin 
from historia where c_cont=0 and 
d_fech=curdate() and c_cvst<>'login' and c_cvst<>'salir' 
order by c_cvge,c_cvst,c_hrin;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table ntpdiff 
select gestor,tiempo,min(c_hrin) as mntp from historia,breaktab
where d_fech=curdate() and gestor=c_cvge and c_hrin>tiempo
group by gestor,tiempo;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update breaktab,ntpdiff set ntp=mntp,
diff=(time_to_sec(mntp)-time_to_sec(ntpdiff.tiempo))/60
where ntpdiff.gestor=breaktab.gestor and ntpdiff.tiempo=breaktab.tiempo;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="drop table if exists breaktemp;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create table breaktemp
select gestor,sum(diff) as sdiff from breaktab
where tipo<>'junta' group by gestor;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$aColumns=array('gestor','tipo','tiempo','ntp','diff');
$sTable='breaktab';
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
        $sEcho='';
        if (isset($_GET['sEcho'])) {
                $sEcho = filter_input(INPUT_GET, 'sEcho', FILTER_SANITIZE_SPECIAL_CHARS);
        } 
        if (isset($_POST['sEcho'])) {
                $sEcho = filter_input(INPUT_POST, 'sEcho', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $output = array(
                "sEcho" => intval($sEcho),
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
