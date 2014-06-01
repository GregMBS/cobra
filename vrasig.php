<?php
include('admin_hdr_2.php');
while ($answercheck=mysql_fetch_row($resultcheck)) {
if ($answercheck[0]!=1) {}
else {
    
    if (!empty($_REQUEST['go'])) 
    {
        $go = mysql_real_escape_string($_REQUEST['go']);
    };
    
    if (!empty($_REQUEST['go'])) 
    {
        
        if ($_REQUEST['go'] == "reasignar") 
        {
            $query = '';
            $orderby = '';
            $where = '';
            $cliente = mysql_real_escape_string($_REQUEST['cliente']);
            $orderby = ' order by rand() ';
            
            if (!empty($_REQUEST['saldo_total'])) 
            {
                $where = $where . " and saldo_total between " . mysql_real_escape_string($_REQUEST['minsaldo_total']) . " and " . mysql_real_escape_string($_REQUEST['maxsaldo_total']);
            }
            
            if (!empty($_REQUEST['saldo_vencido'])) 
            {
                $where = $where . " and saldo_vencido between " . mysql_real_escape_string($_REQUEST['minsaldo_vencido']) . " and " . mysql_real_escape_string($_REQUEST['maxsaldo_vencido']);
            }
            
            if (!empty($_REQUEST['pagos_vencidos'])) 
            {
                $where = $where . " and pagos_vencidos between " . mysql_real_escape_string($_REQUEST['minpagos_vencidos']) . " and " . mysql_real_escape_string($_REQUEST['maxpagos_vencidos']);
            }
            
            if (!empty($_REQUEST['fecha_de_deasignacion'])) 
            {
                $where = $where . " and fecha_de_deasignacion between '" . mysql_real_escape_string($_REQUEST['minfecha_de_deasignacion']) . "' and '" . mysql_real_escape_string($_REQUEST['maxfecha_de_deasignacion']) . "'";
            }
            
            if (!empty($_REQUEST['estado_deudor'])) 
            {
                $where = $where . " and estado_deudor = '" . mysql_real_escape_string($_REQUEST['valestado_deudor']) . "'";
            }
            
            if (!empty($_REQUEST['ciudad_deudor'])) 
            {
                $where = $where . " and ciudad_deudor = '" . mysql_real_escape_string($_REQUEST['valciudad_deudor']) . "'";
            }
            
            if (!empty($_REQUEST['cp_deudor'])) 
            {
                $where = $where . " and cp_deudor = '" . mysql_real_escape_string($_REQUEST['valcp_deudor']) . "'";
            }
            
            if (!empty($_REQUEST['status_aarsa'])) 
            {
                $where = $where . " and status_aarsa = '" . mysql_real_escape_string($_REQUEST['valstatus_aarsa']) . "'";
            }
            
            if (!empty($_REQUEST['status_de_credito'])) 
            {
                $where = $where . " and status_de_credito = '" . mysql_real_escape_string($_REQUEST['valstatus_de_credito']) . "'";
            }
            $howmany = mysql_real_escape_string($_REQUEST['howmany']);
            
                    $gestor_new = mysql_real_escape_string($_REQUEST['gestor_new' . $ii]);
                    $gestor_old = mysql_real_escape_string($_REQUEST['gestor_old' . $ii]);
                    $cuantos = mysql_real_escape_string($_REQUEST['cuantos' . $ii]);
                    $ahorita = date("Y-m-d H:i:s");
                    $query1 = 'insert into gchangelog (id_cuenta,fechahora,gestor_old,gestor_new) select id_cuenta,"' . $ahorita . '","' . $gestor_old . '","' . $gestor_new . '" from resumen where cliente="' . $cliente . '" and ejecutivo_asignado_domiciliario = "' . $gestor_old . '" ' . $where . $orderby . ' limit ' . $howmany . ';';
                    $query2 = 'update resumen,gchangelog set ejecutivo_asignado_domiciliario=gestor_new where resumen.id_cuenta=gchangelog.id_cuenta and ejecutivo_asignado_domiciliario = gestor_old and fechahora="' . $ahorita . '";';
                    if ($gestor_old=='') {
                    $query1 = 'insert into gchangelog (id_cuenta,fechahora,gestor_old,gestor_new) select id_cuenta,"' . $ahorita . '","","' . $gestor_new . '" from resumen where cliente="' . $cliente . '" and ejecutivo_asignado_domiciliario is null ' . $where . $orderby . ' limit ' . $howmany . ';';
                    $query2 = 'update resumen,gchangelog set ejecutivo_asignado_domiciliario=gestor_new where resumen.id_cuenta=gchangelog.id_cuenta and ejecutivo_asignado_domiciliario is null and fechahora="' . $ahorita . '";';
                    }
            mysql_query($query1) or die(mysql_error());
            mysql_query($query2) or die(mysql_error());
        }
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Reasignar Visitadores a Cuentas</title>

<style type="text/css">
</style>
</head>
<body>
<button onclick="window.location='reports.php?capt=<?php echo $capt;?>'">Regressar a la plantilla administrativa</button><br>
<div>
<table summary='Asignaciones actual'>
<tr>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th colspan=3 style='text-align:center'>Todas Cuentas</th>
<th colspan=3 style='text-align:center'>Cuentas sin Visitas</th>
<th colspan=3 style='text-align:center'>Cuentas sin Promesas Activas</th>
</tr>
<tr>
<th>Cliente</th>
<th>Gestor</th>
<th># cuentas</th>
<th>$ promedio</th>
<th>PV promedio</th>
<th># cuentas</th>
<th>$ promedio</th>
<th>PV promedio</th>
<th># cuentas</th>
<th>$ promedio</th>
<th>PV promedio</th>
</tr>
<?php
    $clienteold = '';
    $queryact1 = "drop table if exists novis;";
    $queryact2 = "drop table if exists curr;";
    $queryact3 = "CREATE TABLE  novis 
    (c_cont int(11) NOT NULL default '0', PRIMARY KEY (c_cont)) 
    select distinct c_cont from historia where c_cfac is not null 
    
    ;";
    $queryact4 = "CREATE TABLE  curr 
    (c_cont int(11) NOT NULL default '0', PRIMARY KEY (c_cont)) 
    select distinct c_cont from historia where to_days(d_prom)>=to_days(curdate())-3;";
    $queryact5 = "SELECT cliente, ejecutivo_asignado_domiciliario, 
count(1), sum(saldo_total)/count(1), sum(pagos_vencidos)/count(1),
sum((status_aarsa='') or (status_aarsa='SE MANDO CARTA')), 
sum(saldo_total*(id_cuenta not in (select c_cont from novis)))/sum(id_cuenta not in (select c_cont from curr)), 
sum(pagos_vencidos*(id_cuenta not in (select c_cont from novis)))/sum(id_cuenta not in (select c_cont from curr)),
sum(id_cuenta not in (select c_cont from curr)), 
sum(saldo_total)*(id_cuenta not in (select c_cont from curr))/sum(id_cuenta not in (select c_cont from curr)), 
sum(pagos_vencidos)*(id_cuenta not in (select c_cont from curr))/sum(id_cuenta not in (select c_cont from curr)) 
from resumen force index (cc) group by cliente, ejecutivo_asignado_domiciliario;";
    $queryact6 = "drop table novis;";
    $queryact7 = "drop table curr;";
mysql_query($queryact1) or die(mysql_error());
mysql_query($queryact2) or die(mysql_error());
mysql_query($queryact3) or die(mysql_error());
mysql_query($queryact4) or die(mysql_error());    
    $resultact5 = mysql_query($queryact5) or die(mysql_error());
    while ($answeract = mysql_fetch_row($resultact5)) 
    {
        $clienteact = $answeract[0];
        $gestoract = $answeract[1];
        $ctact = $answeract[2];
        $stact = number_format($answeract[3], 0);
        $ptact = number_format($answeract[4], 0);
        $cgact = $answeract[5];
        $sgact = number_format($answeract[6], 0);
        $pgact = number_format($answeract[7], 0);
        $cpact = $answeract[8];
        $spact = number_format($answeract[9], 0);
        $ppact = number_format($answeract[10], 0);
?>
<tr><td>
<?php
        
        if ($clienteact <> $clienteold) 
        {
            $clienteold = $clienteact;
            echo $clienteact;
        }
?>
</td><td>
<?php echo $gestoract ?>
</td><td>
<?php echo $ctact ?>
</td><td>
<?php echo $stact ?>
</td><td>
<?php echo $ptact ?>
</td><td>
<?php echo $cgact ?>
</td><td>
<?php echo $sgact ?>
</td><td>
<?php echo $pgact ?>
</td><td>
<?php echo $cpact ?>
</td><td>
<?php echo $spact ?>
</td><td>
<?php echo $ppact ?>
</td></tr>
<?php
    }
?>
</table>
</div>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" onSubmit='alert("Traslado de cuentas de un gestor a otro es difícil de deshacer. Se necesita tener cuidado de sus selecciones.")'>
<p>Cliente <select name="cliente">
<?php
    $querycl = "SELECT cliente FROM clientes;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    {?>
  <option value="<?php echo $answercl[0];?>" style="font-size:120%;">
  <?php echo $answercl[0];?></option>
<?php
    } ?>
</select>
</p>
<?php
    $querymm = "SELECT min(saldo_total),max(saldo_total),min(saldo_vencido),max(saldo_vencido),min(pagos_vencidos),max(pagos_vencidos),min(fecha_de_deasignacion),max(fecha_de_deasignacion) FROM resumen;";
    $resultmm = mysql_query($querymm);
    
    while ($answermm = mysql_fetch_array($resultmm)) 
    {
        $minst = $answermm[0];
        $maxst = $answermm[1];
        $minsv = $answermm[2];
        $maxsv = $answermm[3];
        $minpv = $answermm[4];
        $maxpv = $answermm[5];
        $minfd = $answermm[6];
        $maxfd = $answermm[7];
    }
?>  
<p>Reasignar un maximo de 
<input name='howmany' />
 cuentas<br>
de <?php
    $query = "SELECT USUARIA FROM nombres where tipo<>'visitador';";
    $result = mysql_query($query);
    $j = 0;
    
    while ($answer = mysql_fetch_array($result)) 
    {
        $gestor[$j] = $answer[0];
        $j++;
    }
?>  
<select name="gestor_old">
<option value=""></option>
<?php
    
    for ($k = 0;$k < $j;$k++) 
    { ?>
  <option value="<?php echo $gestor[$k]; ?>" style="font-size:120%;"><?php echo $gestor[$k]; ?></option>
<?php
    } ?>
</select>
<br>
a <?php
    $query = "SELECT USUARIA FROM nombres;";
    $result = mysql_query($query);
    $j = 0;
    
    while ($answer = mysql_fetch_array($result)) 
    {
        $gestor[$j] = $answer[0];
        $j++;
    }
?>  
<select name="gestor_new">
<option value=""></option>
<?php
    
    for ($k = 0;$k < $j;$k++) 
    { ?>
  <option value="<?php echo $gestor[$k]; ?>" style="font-size:120%;"><?php echo $gestor[$k]; ?></option>
<?php
    } ?>
</select>
<br>
</p>

<p>usando campos<br>
<input type="checkbox" name="saldo_total"  value="saldo_total">por saldo total entre <input type="text" name='minsaldo_total' value="<?php echo $minst ?>"/> y <input type="text" name='maxsaldo_total' value="<?php echo $maxst ?>" /><br>
<input type="checkbox" name="saldo_vencido"  value="saldo_vencido">por saldo vencido entre <input type="text" name='minsaldo_vencido' value="<?php echo $minsv ?>" /> y <input type="text" name='maxsaldo_vencido' value="<?php echo $maxsv ?>" /><br>
<input type="checkbox" name="pagos_vencidos"  value="pagos_vencidos">por mora entre <input type="text" name='minpagos_vencidos' value="<?php echo $minpv ?>" /> y <input type="text" name='maxpagos_vencidos' value="<?php echo $maxpv ?>" /><br>
<input type="checkbox" name="fecha_de_deasignacion"  value="fecha_de_deasignacion">por fecha de deasignacion entre <input type="text" name='minfecha_de_deasignacion' value="<?php echo $minfd ?>" /> y <input type="text" name='maxfecha_de_deasignacion' value="<?php echo $maxfd ?>" /><br>
<input type="checkbox" name="cp_deudor"  value="cp_deudor">por CP 
<select name="valCP_deudor">
<?php
    $querycl = "SELECT distinct CP_deudor FROM resumen ORDER BY CP_deudor limit 99999;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    { ?>
<option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
</option>
<?php
    } ?>
</select>
<br>
<input type="checkbox" name="ciudad_deudor"  value="ciudad_deudor">por ciudad 
<select name="valciudad_deudor">
<?php
    $querycl = "SELECT distinct ciudad_deudor FROM resumen ORDER BY ciudad_deudor LIMIT 99999;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    { ?>
<option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
</option>
<?php
    } ?>
</select>
<br>
<input type="checkbox" name="estado_deudor"  value="estado_deudor">por estado 
<select name="valestado_deudor">
<?php
    $querycl = "SELECT distinct estado_deudor FROM resumen ORDER BY estado_deudor LIMIT 52;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    { ?>
<option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
</option>
<?php
    } ?>
</select>
<br>
<input type="checkbox" name="status_aarsa"  value="status_aarsa">por codigo de resultados 
<select name="valstatus_aarsa">
<option value="">&nbsp;<?php
    $querycl = "SELECT dictamen FROM dictamenes ORDER BY dictamen;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    { ?>
<option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
</option>
<?php
    } ?>
</select>
<br>
<input type="checkbox" name="status_de_credito"  value="status_de_credito">por status de credito 
<select name="valstatus_de_credito">
<?php
    $querycl = "SELECT distinct status_de_credito FROM resumen ORDER BY status_de_credito LIMIT 1000;";
    $resultcl = mysql_query($querycl);
    
    while ($answercl = mysql_fetch_array($resultcl)) 
    { ?>
<option value="<?php echo $answercl[0]; ?>"><?php echo $answercl[0]; ?>
</option>
<?php
    } ?>
</select>
<br>
</p>
<input type="hidden" name="capt" value="<?php echo $capt ?>" />
<input type="submit" name="go" value="reasignar" />
</form>
</body>
</html> 
<?php
}
}
mysql_query($queryact6) or die(mysql_error());
mysql_query($queryact7) or die(mysql_error());    
mysql_close();
?>
