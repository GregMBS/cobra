<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "4sale";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$sQuery="CREATE TEMPORARY TABLE  `hoy` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Gestiones` int(11),
  `Promesas_Total` int(11),
  `Promesas_Sin_Gestion` int(11),
  `Promesas_Hoy` int(11),
  `Monto_Promesas_Hoy` decimal(10,2),
  `Negociaciones` int(11),
  `Horas` decimal(5,1),
  `Break_min` decimal(5,1),
  `Gestiones_por_hora` decimal(5,1),
  PRIMARY KEY (`auto`)
)";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="insert into hoy (gestor,Horas,Gestiones,Promesas_Hoy,
Negociaciones,Gestiones_por_hora,Monto_Promesas_Hoy) 
select c_cvge,time_to_sec(subtime(max(c_hrin),min(c_hrin)))/3600 as horas,
count(1),sum(C_CVST like 'PRO% DE%') as np,
sum(C_CVST like 'CLIENTE NEG%') as cn, 
count(1)/time_to_sec(subtime(max(c_hrin),min(c_hrin)))*3600,
sum(n_prom) 
from historia 
where D_FECH = curdate() 
and c_cont>0 
and c_msge is null
and c_cniv is null
group by C_CVGE order by c_cvge;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update hoy,breaktemp set Break_min=sdiff 
where hoy.gestor=breaktemp.gestor;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$aColumns=array('gestor','Gestiones','Promesas_Hoy','Monto_Promesas_Hoy',
'Negociaciones','Horas','Break_min','Gestiones_por_hora');
$sTable='hoy';
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
