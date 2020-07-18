<?php

use cobra_salsa\PdoClass;
use cobra_salsa\ReporteDiarioClass;

require_once 'classes/PdoClass.php';
require_once 'classes/ReporteDiarioClass.php';
$pd = new PdoClass();
$pdo  = $pd->dbConnectAdmin();
$rc = new ReporteDiarioClass($pdo);
$capt = $pd->capt;

function last_business_day($year, $month)
{

    $lastBusinessDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $weekday  = date("N", strtotime("$year-$month-$lastBusinessDay"));
    if ($weekday == 7) {
        $lastBusinessDay -= 2;
    }
    if ($weekday == 6) {
        $lastBusinessDay--;
    }

    return date("Y-m-d", strtotime("$year-$month-$lastBusinessDay"));
}
$rc->buildReport();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Promesas y Pagos del Mes Anterior</title>

        <style type="text/css">
            body {font-family: verdana,arial, helvetica, sans-serif;
                  font-size: 10pt; background-color: white;color:black;}
            div {clear:both}
            table {border: 1pt solid black;background-color: white;
                   border-collapse: collapse;}
            th,td {border: 1pt solid black;background-color: white;}
            th {font-weight:bold;}
            a:link {color:blue;}
            a:visited {color:green;}
            a:hover {color:red;}
            a:active {color:yellow;}
            div {border: 1pt black solid;background-color:white;}
            td {border: 1pt solid black;background-color: white;}
            .visitable td {border:0; background-color: transparent;width:auto;}
            #ahora td {font-size: 85%}
            ul.tabs
            { list-style-type: none; padding: 0; margin: 0;}
            ul.tabs li
            { float: left; padding: 0;
                background: url(tab_right.png) no-repeat right top;
                margin: 0 1px 0 0;
            }
            ul.tabs li a
            { display: block; padding: 0 10px;
              color: white; text-decoration: none; background:
                  url(tab_left.png) no-repeat left top; }
            ul.tabs li a:hover
            { color: yellow;}
            th {font-weight:bold;font-size:10pt;}
            </style>
            <script type="text/javascript" src="js/external/dom-drag.js"></script>
            <SCRIPT TYPE="text/JavaScript">
                function paging(pageid) {
                const pageida=pageid+"a";
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
            <div class="clearBox">
            <UL class='tabs'>
                <LI><A id='pagosa' onClick="paging('pagos')">PAGOS</A></LI>
                <LI><A id='vigentesa' onClick="paging('vigentes')">VIGENTES</A></LI>
                <LI><A id='vencidosa' onClick="paging('vencidos')">VENCIDOS</A></LI>
                <LI><A id='analyticaa' onClick="paging('analytica')">ANALYTICA</A></LI>
            </UL>
        </div>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar a la pagina administrativa</button><br>
        <div id='pagos'>
            <?php
// pagos
            $id                  = 0;
            $resultParcial       = $pdo->query($queryparcial);
            $numberfieldsParcial = $resultParcial->columnCount();
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
            $resultVencidos->setFetchMode(PDO::FETCH_ASSOC);
            $arrayNames = array_keys($resultVencidos[0]);
            $numberfieldsVencidos = $resultVencidos->columnCount();
            ?>
            <table>
            <tr>
                    <?php
            foreach ($arrayNames as $var) {
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
                $k = $k + 2;
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
    $resultVigentes->setFetchMode(PDO::FETCH_ASSOC);
    $numberfieldsVigentes = $resultVigentes->columnCount();
    ?>
    <table>
        <tr>
            <?php
    foreach ($resultVigentes as $var) {
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
        $k = $k + 2;
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
