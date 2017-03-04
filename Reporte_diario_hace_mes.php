<?php

use cobra_salsa\PdoClass;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo  = $pdoc->dbConnectAdmin();
$capt = $pdoc->capt;

function last_business_day($year, $month)
{

    $lbday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $wday  = date("N", strtotime("$year-$month-$lbday"));
    if ($wday == 7) {
        $lbday -= 2;
    }
    if ($wday == 6) {
        $lbday--;
    }

    $lbd = date("Y-m-d", strtotime("$year-$month-$lbday"));
    return $lbd;
}
$lm      = strtotime("-1 month");
$lm2     = strtotime("-2 month");
$lbd0    = last_business_day(date("Y", $lm2), date("n", $lm2));
//$lbd1=last_business_day(date("Y",$lm),date("n",$lm));
$lbd1    = date("Y-m-d", strtotime("-1 month -1 day"));
//die ($lbd0." ".$lbd1);
$adjust  = '';
//last day sunday	
//$adjust='-interval 2 day';
//last day saturday	
//$adjust='-interval 1 day';
$querya  = "create temporary table rrotas
select numero_de_cuenta,resumen.cliente,status_de_credito,status_aarsa,producto,subproducto,
nombre_deudor,pagos.auto as pauto,monto,fecha,historia.auto as hauto,
n_prom1,d_prom1,n_prom2,d_prom2,c_cvge,'pagos' as semaforo,resumen.id_cuenta 
from pagos
join resumen using (id_cuenta)
left join historia on c_cont=pagos.id_cuenta 
and fecha between d_fech and (d_prom+interval 2 day) and c_cvst like 'promesa de%'
where fecha > :lbd0
and fecha <= :lbd1
and confirmado=0";
$sta     = $pdo->prepare($querya);
$sta->bindParam(':lbd0', $lbd0);
$sta->bindParam(':lbd1', $lbd1);
$sta->execute();
$queryb  = "create temporary table rotad select pauto from rrotas
group by pauto having count(1)>1";
$pdo->query($queryb);
$queryc  = "select pauto from rotad";
$resultc = $pdo->query($queryc);
$queryd  = "delete from rrotas where pauto = ;pauto order by fecha limit 1";
$std     = $pdo->prepare($queryd);
foreach ($resultc as $answerc) {
    $pauto = $answerc['pauto'];
    $std->bindParam(':pauto', $pauto);
    $std->execute();
}
$queryp              = "create temporary table xrotas
select * from rrotas where hauto>0";
$pdo->query($queryp);
$queryu              = "update rrotas r,xrotas as x
set r.hauto=x.hauto,r.c_cvge=x.c_cvge,
r.n_prom1=x.n_prom1,r.d_prom1=x.d_prom1,
r.n_prom2=x.n_prom2,r.d_prom2=x.d_prom2
where r.id_cuenta=x.id_cuenta and r.hauto is null";
$pdo->query($queryu);
$queryparcial        = "select hauto,numero_de_cuenta,rrotas.cliente,
status_de_credito,producto,subproducto,q(status_aarsa),status_aarsa,
nombre_deudor,n_prom1+n_prom2,n_prom1,d_prom1,n_prom2,d_prom2,
max(folio),c_cvge,monto,rrotas.fecha from rrotas
left join folios on rrotas.cliente like 'credito%' and cuenta=numero_de_cuenta
group by hauto,rrotas.cliente,numero_de_cuenta,monto,rrotas.fecha
order by rrotas.cliente,status_de_credito,numero_de_cuenta";
$queryvencido        = "select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>'".$lbd0."'
and d_fech<='".$lbd1."' 
and d_prom<'".$lbd1."' and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>'".$lbd0."') 
;";
$queryvigente        = "select h1.auto,concat(h1.CUENTA,' ') as 'numero_de_cuenta',resumen.cliente,
status_de_credito as 'campa&ntilde;a',producto,subproducto,q(status_aarsa) as 'queue',status_aarsa,
nombre_deudor,n_prom as 'Imp. Neg.',n_prom1 as 'pp1',d_prom1 as 'fpp1',n_prom2 as 'pp2',d_prom2 as 'fpp2',
folio,c_cvge as 'gestor'
from historia h1 join resumen on c_cont=id_cuenta 
left join folios on c_cont=id and not exists (select folio from folios f2 where folios.id=f2.id and folios.folio<f2.folio)
where n_prom>0 and d_fech>'".$lbd0."' 
and d_fech<='".$lbd1."' 
and d_prom>='".$lbd1."' and c_cvst like 'PROMESA DE%'
and not exists 
(select auto from historia h2 
where h1.c_cont=h2.c_cont and h1.auto<h2.auto and h2.n_prom>0) 
and not exists 
(select auto from pagos 
where h1.c_cont=id_cuenta and fecha>'".$lbd0."');";
$querydrop           = "DROP TABLE IF EXISTS `cobracsi`.`gmbtemp`";
$pdo->query($querydrop);
$querymake           = "CREATE TABLE `cobracsi`.`gmbtemp` (
  `gestor` varchar(50)  NOT NULL,
  `cliente` varchar(50)  NOT NULL,
  `sdc` varchar(50)  NOT NULL,
  `producto` varchar(50)  NOT NULL,
  `subproducto` varchar(50)  NOT NULL,
  `vigente` decimal(10,2) DEFAULT 0,
  `vencido` decimal(10,2) DEFAULT 0,
  `pago` decimal(10,2) DEFAULT 0,
  `meta` decimal(10,2)  DEFAULT '1',
  `metap` decimal(10,2) ,
  `negociado` decimal(10,2)  DEFAULT '0.01',
  `cumplimentop` decimal(10,2) ,
  `pronostico` decimal(10,2) ,
  `pronosticop` decimal(10,2) 
)
CHARACTER SET utf8 COLLATE utf8_spanish_ci;
";
$pdo->query($querymake);
$querycalc           = "update gmbtemp g
set g.meta=1,metap=(pago)/1,
negociado=(vigente+vencido+pago),
cumplimentop=(pago)/(vigente+vencido+pago),
pronostico=((pago)+(vigente*(pago)/(vigente+vencido+pago))),
pronosticop=((pago)+(vigente*(pago)/(vigente+vencido+pago)))/1
";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Promesas y Pagos del Mes Anterior</title>

        <style type="text/css">
            body {font-family: verdana,arial, helvetica, sans-serif;
                  font-size: 10pt; background-color: white;color:black;}
            .hidebox {display:none}
            div {clear:both}
            table {border: 1pt solid black;background-color: white;
                   border-collapse: collapse;}
            th,td {border: 1pt solid black;background-color: white;}
            th,.heavy {font-weight:bold;}
            a:link {color:blue;}
            a:visited {color:green;}
            a:hover {color:red;}
            a:active {color:yellow;}
            div {border: 1pt black solid;background-color:white;}
            td {border: 1pt solid black;background-color: white;}
            .visitable td {border:0; background-color: transparent;width:auto;}
            .deudor {color: red;}
            .visit {color: green;}
            #ahora td {font-size: 85%}
            ul.tabs
            { list-style-type: none; padding: 0; margin: 0;}
            ul.tabs li
            { float: left; padding: 0; margin: 0; padding-top: 0;
              background: url(tab_right.png) no-repeat right top; margin-right: 1px; }
            ul.tabs li a
            { display: block; padding: 0px 10px;
              color: white; text-decoration: none; background:
                  url(tab_left.png) no-repeat left top; }
            ul.tabs li a:hover
            { color: yellow;}
            th,.heavy {font-weight:bold;font-size:10pt;}
            .light {text-align:right;}
            .rightnow {
                background-color:orange;
            }
            .callcenter {
                background-color:white;
            }
            .admin {
                background-color:gray;
            }
            .late {
                background-color:yellow; font-weight:bold;
                text-decoration:blink;}
            .verylate,.lazy {
                background-color:red; font-weight:bold;
                text-decoration:blink;}
            </style>
            <script type="text/javascript" src="dom-drag.js"></script>
            <SCRIPT LANGUAGE="JavaScript" TYPE="text/JavaScript">
                function paging(pageid) {
                pageida=pageid+"a";
                document.getElementById("pagos").style.display="none";
                document.getElementById("pagosa").style.fontWeight="normal";
                document.getElementById("vigentes").style.display="none";
                document.getElementById("vigentesa").style.fontWeight="normal";
                document.getElementById("vencidos").style.display="none";
                document.getElementById("vencidosa").style.fontWeight="normal";
                document.getElementById("analytica").style.display="none";
                document.getElementById("analyticaa").style.fontWeight="normal";
                document.getElementById(pageid).style.display="block";
                document.getElementById(pageida).style.fontWeight="bold";
                }
            </SCRIPT>
        </head>
        <body onLoad="paging('pagos');">
            <div class="clearbox">
            <UL class='tabs'>
                <LI><A id='pagosa' onClick="paging('pagos')">PAGOS</A></LI>
                <LI><A id='vigentesa' onClick="paging('vigentes')">VIGENTES</A></LI>
                <LI><A id='vencidosa' onClick="paging('vencidos')">VENCIDOS</A></LI>
                <LI><A id='analyticaa' onClick="paging('analytica')">ANALYTICA</A></LI>
            </UL>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
        <div id='pagos'>
            <?php
// pagos
            $id                  = 0;
            $resultParcial       = $pdo->query($queryparcial);
            $numberfieldsParcial = count(array_keys($resultParcial));
            ?>
            <table>
                <thead>
                    <tr>
                        <th>auto</th>
                        <th>numero_de_cuenta</th>
                        <th>cliente</th>
                        <th>campa&ntilde;a</th>
                        <th>producto</th>
                        <th>subproducto</th>
                        <th>queue</th>
                        <th>status_aarsa</th>
                        <th>nombre_deudor</th>
                        <th>Imp. Neg.</th>
                        <th>pp1</th>
                        <th>fpp1</th>
                        <th>pp2</th>
                        <th>fpp2</th>
                        <th>folio</th>
                        <th>gestor</th>
                        <th>pmt1</th>
                        <th>fpmt1</th>
                        <th>pmt2</th>
                        <th>fpmt2</th>
                        <th>pmt3</th>
                        <th>fpmt3</th>
                        <th>suma vig.</th>
                        <th>suma venc.</th>
                        <th>suma pag.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sp                  = 0;
                    $npr                 = 0;
                    $npve                = 0;
                    $temprow             = array(0);
                    $temprow[22]         = 0;
                    $temprow[23]         = 0;
                    $temprow[24]         = 0;
                    foreach ($resultParcial as $row) {
                        $qi = "insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
                            "','".$row[4]."','".$row[5].
                            "',0,0,".$row[16].")";
                        $pdo->query($qi);
                        if ($row[0] != $temprow[0]) {
                            if ($temprow[0] > 0) {
                                echo '<tr>';
                                for ($i = 0; $i < 25; $i++) {
                                    if (isset($temprow[$i])) {
                                        echo "<td>".$temprow[$i]."</td>";
                                    } else {
                                        echo "<td></td>";
                                    }
                                }
                                echo '</tr>';
                            }
                            $temprow     = $row;
                            $temprow[24] = $row[16];
                            if ($temprow[24] >= $temprow[9]) {
                                $temprow[22] = 0;
                                $temprow[23] = 0;
                            } else {
                                $leftover    = max($temprow[10] - $temprow[24],
                                    0);
                                $temprow[22] = $temprow[9] - $temprow[24] - $leftover;
                                $temprow[23] = $leftover;
                            }
                        } else {
                            $temprow[24] = $temprow[24] + $row[16];
                            if (empty($temprow[18])) {
                                $temprow[18] = $row[16];
                                $temprow[19] = $row[17];
                            } else {
                                if (empty($temprow[20])) {
                                    $temprow[20] = $row[16];
                                    $temprow[21] = $row[17];
                                }
                            }
                        }
                    }
                    if ($temprow[0] > 0) {
                        echo '<tr>';
                        for ($i = 0; $i < 25; $i++) {
                            echo "<td>".$temprow[$i]."</td>";
                        }
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id='vencidos'>
            <?php
// vencidos

            $resultVencidos       = $pdo->query($queryvencido);
            $rvecount = $resultVencidos->setFetchMode(PDO::FETCH_ASSOC);
            $numberfieldsVencidos = count(array_keys($rvecount));
            echo "<table>";
            echo "<tr>";
            foreach (array_keys($rvecount) as $var) {
                echo "<th>".$var."</th>";
            }
            ?>
            <th>monto1</th>
            <th>fecha1</th>
            <th>monto2</th>
            <th>fecha2</th>
            <th>monto3</th>
            <th>fecha3</th>
            <th>suma vig.</th>
            <th>suma venc.</th>
            <th>suma pag.</th>
        </tr>
        <?php
        foreach ($resultVencidos as $row) {
            if ($row[0] <> $id) {
                $id = $row[0];
                for ($j = 0; $j < $numberfieldsVencidos; $j++) {
                    echo "<td>".$row[$j]."</td>";
                }
                $k = $j;
            } else {
                echo "<td>".$row[$j - 2]."</td>";
                echo "<td>".$row[$j - 1]."</td>";
                $k + $k + 2;
            }
            ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php
            $queryplus  = "select if(d_prom2<('".$lbd1."'),n_prom,n_prom1),
if(d_prom2>=('".$lbd1."'),n_prom2,0) from historia 
where auto=".$id;
            $resultplus = $pdo->query($queryplus);
            foreach ($resultplus as $answerplus) {
                echo "<td>".$answerplus[1]."</td>";
                echo "<td>".$answerplus[0]."</td>";
                echo "<td></td>";
                echo "</tr>";
                $qi = "insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
                    "','".$row[4]."','".$row[5].
                    "',".$answerplus[1].",".$answerplus[0].",0)";
                $pdo->query($qi);
            }
        }
        ?>
    </table>
</div>
<div id='vigentes'>
    <?php
// vigentes
    $resultVigentes       = $pdo->query($queryvigente);
    $rvicount = $resultVigentes->setFetchMode(PDO::FETCH_ASSOC);
    $numberfieldsVigentes = count(array_keys($rvicount));
    echo "<table>";
    echo "<tr>";
    foreach ($rvicount as $var) {
        echo "<th>".$var."</th>";
    }
    ?>
    <th>pmt1</th>
    <th>fpmt1</th>
    <th>pmt2</th>
    <th>fpmt2</th>
    <th>pmt3</th>
    <th>fpmt3</th>
    <th>suma vig.</th>
    <th>suma venc.</th>
    <th>suma pag.</th>
</tr>
<?php
while ($row = $resultVigentes->fetch()) {
    if ($row[0] <> $id) {
        echo "<tr>";
        $id = $row[0];
        for ($j = 0; $j < $numberfieldsVigentes; $j++) {
            echo "<td>".$row[$j]."</td>";
        }
        $k = $j;
    } else {
        echo "<td>".$row[$j - 2]."</td>";
        echo "<td>".$row[$j - 1]."</td>";
        $k + $k + 2;
    }
    ?>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <?php
    $queryplus  = "select n_prom,0 from historia
where auto=".$id;
    $resultplus = $pdo->query($queryplus);
    while ($answerplus = $resultplus->fetch()) {
        echo "<td>".$answerplus[0]."</td>";
        echo "<td>".$answerplus[1]."</td>";
        echo "<td></td>";
        echo "</tr>";
        $qi = "insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('".$row[15]."','".$row[2]."','".$row[3].
            "','".$row[4]."','".$row[5].
            "',".$answerplus[0].",".$answerplus[1].",0)";
        $pdo->query($qi);
    }
}
?>
</table>
</div>
<div id='analytica'>
    <?php
// analytica
    $pdo->query($querycalc);
    echo "<p>Por Cliente</p>";
    $querySumCliente        = "select cliente, 
        sum(pago) as pagos, 
        sum(vigente) as vigentes, 
        sum(vencido) as vencidos
from gmbtemp group by cliente;";
    $resultSumCliente       = $pdo->query($querySumCliente);
    echo "<table>";
    echo "<tr>";
    echo "<th>cliente</th>";
    echo "<th>pagos</th>";
    echo "<th>vigentes</th>";
    echo "<th>vencidos</th>";
    echo "</tr>";
    while ($row = $resultSumCliente->fetch()) {
        echo "<tr>";
        foreach ($row as $item) {
            echo "<td>".$item."</td>";
        }
    }
    echo "</tr>";
    echo "</table>";
    echo "<p>Por Gestor</p>";
    $querySumGestor        = "select gestor,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by gestor;";
    $resultSumGestor       = $pdo->query($querySumGestor);
    echo "<table>";
    echo "<tr>";
    echo "<th>cliente</th>";
    echo "<th>pagos</th>";
    echo "<th>vigentes</th>";
    echo "<th>vencidos</th>";
    echo "</tr>";
    while ($row = $resultSumGestor->fetch()) {
        echo "<tr>";
        foreach ($row as $item) {
            echo "<td>".$item."</td>";
        }
    }
    echo "</tr>";
    echo "</table>";
    echo "<p>Por Segmento</p>";
    $querySumStatus        = "select cliente,
        substring_index(sdc,'-',1) as segmentos,
        sum(pago),sum(vigente) as vigentes,
        sum(vencido) as vencidos
from gmbtemp group by cliente,segmentos";
    $resultSumStatus       = $pdo->query($querySumStatus);
    echo "<table>";
    echo "<tr>";
    echo "<th>cliente</th>";
    echo "<th>segmentos</th>";
    echo "<th>vigentes</th>";
    echo "<th>vencidos</th>";
    echo "</tr>";
    while ($row = $resultSumStatus->fetch()) {
        echo "<tr>";
        foreach ($row as $item) {
            echo "<td>".$item."</td>";
        }
    }
    echo "</tr>";
    echo "</table>";
    echo "<p>Por Producto</p>";
    $querySumProducto        = "select cliente,
        substring_index(sdc,'-',1) as segmentos,
        producto,
        subproducto,
        sum(pago) as pagos,
        sum(vigente) as vigentes,
        sum(vencido) as vencidos
from gmbtemp group by cliente,segmentos,producto,subproducto;";
    $resultSumProducto       = $pdo->query($querySumProducto);
    echo "<table>";
    echo "<tr>";
    echo "<th>cliente</th>";
    echo "<th>segmentos</th>";
    echo "<th>producto</th>";
    echo "<th>subproducto</th>";
    echo "<th>pagos</th>";
    echo "<th>vigentes</th>";
    echo "<th>vencidos</th>";
    echo "</tr>";
    while ($row = $resultSumProducto->fetch()) {
        echo "<tr>";
        foreach ($row as $item) {
            echo "<td>".$item."</td>";
        }
    }
    echo "</tr>";
    echo "</table>";
    echo"</body></html>";
