<?php	
require 'jsonwrapper.php';
$host = "localhost";
$user = "admin";
$pswd = "AwRats";
$db = "cobra4";
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$con = mysql_connect($host,$user,$pswd) or die ("Could not connect to MySQL");
mysql_select_db($db,$con) or die ("Could not select $db database");
$capt=mysql_real_escape_string($_COOKIE['capt']);
$field=mysql_real_escape_string ($_COOKIE['field']);
$find=mysql_real_escape_string ($_COOKIE['find']);
$CLIENTE=mysql_real_escape_string ($_COOKIE['cliente']);
$csearch='';
if (strlen($CLIENTE)>1) {$csearch=" and cliente= '".$CLIENTE."'";}
$fsearch=$field." like '%".$find."%'";
if ($field=='id_cuenta')  {$fsearch = " id_cuenta = ".$find;}
if ($field=='REFS')  {
    $fsearch = " (nombre_deudor_alterno like '%".$find."%' or 
nombre_referencia_1 like '%".$find."%' or 
nombre_referencia_2 like '%".$find."%' or 
nombre_referencia_3 like '%".$find."%' or 
nombre_referencia_4 like '%".$find."%')";    
    }
if ($field=='EXACTO')  {
    $fsearch = " numero_de_cuenta= '".$find."' ";
    }
if ($field=='numero_de_cuenta')  {
    $fsearch = " numero_de_cuenta= '".$find."' ";
    }
if ($field=='TELS')  {
    $fsearch = " (tel_1 like '%".$find."' or 
tel_2 like '%".$find."' or 
tel_3 like '%".$find."' or 
tel_4 like '%".$find."' or 
tel_1_alterno like '%".$find."' or 
tel_2_alterno like '%".$find."' or 
tel_3_alterno like '%".$find."' or 
tel_4_alterno like '%".$find."' or 
tel_1_ref_1 like '%".$find."' or 
tel_2_ref_1 like '%".$find."' or 
tel_1_ref_2 like '%".$find."' or 
tel_2_ref_2 like '%".$find."' or 
tel_1_ref_3 like '%".$find."' or 
tel_2_ref_3 like '%".$find."' or 
tel_1_ref_4 like '%".$find."' or 
tel_2_ref_4 like '%".$find."' or 
tel_1_laboral like '%".$find."' or 
tel_2_laboral like '%".$find."' or 
tel_1_verif like '%".$find."' or 
tel_2_verif like '%".$find."' or 
tel_3_verif like '%".$find."' or 
tel_4_verif like '%".$find."' or 
telefonos_marcados like '%".$find."')";    
    }
$aColumns=array('numero_de_cuenta','nombre_deudor','cliente','status_de_credito','id_cuenta');
$sTable='resumen';
$sIndexColumn='id_cuenta';
if ($field=='ROBOT')  {
    $fsearch = " c_tele LIKE '%".$find."' and c_cont=id_cuenta";   
$sTable='resumen, historia';
$sIndexColumn='1';
} 
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
		$sWhere .= "  and ".$fsearch.$csearch.")";
		} else {
		$sWhere = "WHERE ".$fsearch.$csearch;
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
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
//die ($sQuery);
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
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	if ($field=="ROBOT") {
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable where c_tele LIKE '%".$find."' and id_cuenta=c_cont
	";
		
		}
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
//	if (!empty($output['aaData'])) {
echo json_encode( $output );
//}
//	else {}
?>
