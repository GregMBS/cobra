<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "DeathSta1";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$sQuery="CREATE TEMPORARY TABLE  `ahora` (
  `auto` int(11) NOT NULL AUTO_INCREMENT,
  `gestor` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cuenta` varchar(255) COLLATE utf8_spanish_ci,
  `nombre` varchar(255) COLLATE utf8_spanish_ci,
  `cliente` varchar(255) COLLATE utf8_spanish_ci,
  `camp` varchar(255) COLLATE utf8_spanish_ci,
  `status` varchar(255) COLLATE utf8_spanish_ci,
  `tiempo` int(11),
  `queue` varchar(255) COLLATE utf8_spanish_ci,
  `sistema` varchar(255) COLLATE utf8_spanish_ci,
  `login` varchar(255) COLLATE utf8_spanish_ci,
  `logout` varchar(255) COLLATE utf8_spanish_ci,
  `id_cuenta` int(11),
  PRIMARY KEY (`auto`)
)";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="insert into ahora (gestor,cuenta,nombre,cliente,camp,status,
tiempo,queue,sistema,logout,id_cuenta) 
SELECT userlog.gestor,numero_de_cuenta,nombre_deudor,
rslice.cliente, status_de_credito,rslice.status_aarsa, time_to_sec(timediff(now(),timeuser))/60,
ifnull(queuelist.status_aarsa,if(rslice.status_aarsa<>'','ELASTIX','BREAK')),usuario,userlog.gestor,
id_cuenta
FROM userlog 
left join rslice on user=userlog.gestor
left JOIN nombres use index (grupo) ON userlog.gestor=iniciales
LEFT JOIN queuelist ON nombres.camp=queuelist.camp and user=userlog.gestor
WHERE userlog.gestor IS NOT NULL 
and fechahora>curdate()
group BY right(usuario,4) order by nombres.tipo desc,right(usuario,2) desc;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table logins 
select c_cvge,min(c_hrin) as tlog from historia
where d_fech=curdate() and c_cvst='login'
group by c_cvge;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update ahora,logins set login=tlog where c_cvge=gestor;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table logouts 
select c_cvge,max(c_hrin) as tlogo from historia 
where d_fech=curdate() and c_cvst='salir' 
group by c_cvge;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update ahora,logouts set logout=tlogo where c_cvge=gestor;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="create temporary table breakstat 
select c_cvge,max(auto) as mau from historia
where d_fech=curdate() and c_cont=0
group by c_cvge;";
mysql_query( $sQuery, $con ) or die(mysql_error());
$sQuery="update ahora,breakstat,historia set status=c_cvst 
where breakstat.c_cvge=gestor and historia.auto=mau and queue='BREAK';";
mysql_query( $sQuery, $con ) or die(mysql_error());
$aColumns=array('gestor','cuenta','nombre','cliente','Camp','Status',
'tiempo','queue','sistema','Login','Logout','id_cuenta');
$sTable='ahora';
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
		FROM   ahora
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
	else {die('not ok');}
?>
