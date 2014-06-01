<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "root";
$pwd = "AwRats";
$db = "cobra";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pwd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_COOKIE['capt']);
function last_business_day($year,$month) 
{ 
  $lbd = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
  $wday = date("N",strtotime("$year-$month-$lbd")); 
  if ($wday == 7) $lbd -= 2; 
  if ($wday == 6) $lbd--; 
  $lbd = date("Y-m-d",strtotime("$year-$month-$lbd")); 
  return $lbd; 
}
$lm=strtotime("-1 month");
$lbd0=last_business_day(date("Y",$lm),date("n",$lm));
$lbd1=last_business_day(date("Y"),date("n"));
$aColumns=array('numero_de_cuenta','nombre_deudor','cliente',
'status_de_credito','status_aarsa',
'c_cvge','d_prom1','n_prom1','d_prom2','n_prom2','monto','fecha',
'semaforo','id_cuenta');
$querya="create temporary table rotas
select numero_de_cuenta,resumen.cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,pagos.auto as pauto,monto,fecha,historia.auto as hauto,
n_prom1,d_prom1,n_prom2,d_prom2,c_cvge,'pagos' as semaforo,resumen.id_cuenta 
from pagos
join resumen using (id_cuenta)
left join historia on c_cont=pagos.id_cuenta 
and fecha between d_fech and (d_prom+interval 2 day) and c_cvst like 'promesa de%'
where fecha>'".$lbd0."'
and confirmado=0 and status_de_credito not like '%ivo'
;";
mysql_query($querya) or die("ERROR PRMa - ".mysql_error());
$queryb="create temporary table rotad select pauto from rotas
group by pauto having count(1)>1;";
mysql_query($queryb) or die("ERROR PRMb - ".mysql_error());
$queryc="select pauto from rotad;";
$resultc=mysql_query($queryc) or die("ERROR PRMc - ".mysql_error());
while ($answerc=mysql_fetch_row($resultc)) {
	$pauto=$answerc[0];
	$queryd="delete from rotas where pauto = $pauto order by fecha limit 1;";
	mysql_query($queryd) or die("ERROR PRMd - ".mysql_error());
}
$queryp="create temporary table xrotas 
select * from rotas where hauto>0;";
mysql_query($queryp) or die("ERROR PRMp - ".mysql_error());
$queryu="update rotas r,xrotas as x
set r.hauto=x.hauto,r.c_cvge=x.c_cvge,
r.n_prom1=x.n_prom1,r.d_prom1=x.d_prom1,
r.n_prom2=x.n_prom2,r.d_prom2=x.d_prom2
where r.id_cuenta=x.id_cuenta and r.hauto is null;";
mysql_query($queryu) or die("ERROR PRMu - ".mysql_error());
$querye="insert into rotas (numero_de_cuenta,cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,hauto,c_cvge,n_prom1,d_prom1,n_prom2,d_prom2,semaforo,id_cuenta) 
select numero_de_cuenta,cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,auto,c_cvge,n_prom1,d_prom1,n_prom2,d_prom2,
if(d_prom1>=curdate(),'vigente','vencido'),id_cuenta
from resumen,historia where c_cont=id_cuenta 
and not exists (select auto from pagos where c_cont=pagos.id_cuenta 
and fecha between d_fech and (d_prom+interval 2 day)) 
and c_cvst like 'PROMESA DE%'  and status_de_credito not like '%ivo'
and d_prom1>'".$lbd0."'
";
mysql_query($querye) or die("ERROR PRMe - ".mysql_error());
$queryp2="create temporary table xrotav 
select * from rotas;";
mysql_query($queryp2) or die("ERROR PRMp2 - ".mysql_error());
$queryu2="delete from rotas where semaforo='venci' 
and exists (select * from xrotav x where rotas.id_cuenta=x.id_cuenta 
and rotas.hauto<x.hauto);";
mysql_query($queryu2) or die("ERROR PRMu2- ".mysql_error());
$gestorstr=" c_cvge='".$capt."' ";
if ($capt=='gmbs') {$gestorstr="";}
if ($capt=='katia') {$gestorstr="";}
if ($capt=='joaquinrodriguez') {$gestorstr="";}
if ($capt=='emelendez') {$gestorstr="";}
$sTable='rotas';
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
		$sWhere = substr_replace( $sWhere, "", -4 );
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
if ($gestorstr!="") {
	if ($sWhere=="") {$gestorstr = ' where '.$gestorstr;}	
	else {$gestorstr = ' and '.$gestorstr;}	
	$sWhere .= $gestorstr;
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
	$rResult = mysql_query( $sQuery, $con ) or die(mysql_error().$sQuery);
	
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

echo json_encode( $output );

?>
