<!DOCTYPE html">
<html>
    <head>
        <title>Promesas y Pagos</title>
        <link rel="Stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="bower_components/jquery/dist/jquery.js"></script>
        <script type="text/javascript" charset="utf8" src="bower_components/jqueryui/jquery-ui.js"></script>
    </head>
    <body>
        <script>
            $(function() {
                $("#tabs").tabs();
                $("button").button();
                $("button").css("vertical-align", "bottom");
                $("button").width("4cm");
                $("button").height("1.6cm");
                $("body").css("font-size", "8pt");
            });
        </script>
        <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">
            Regressar a la plantilla administrativa
        </button><br>
        <div id="tabs"> 
            <ul> 
                <li><a href="#pagos">PAGOS</a></li>
                <li><a href="#vigentes">VIGENTES</a></li>
                <li><a href="#vencidos">VENCIDOS</a></li>
                <li><a href="#analytica">ANALÍTICA</a></li>
            </ul> 
            <div id='pagos'>
                <?php
// pagos
                $id = 0;
                ?>
                <table class="ui-widget">
                    <thead class="ui-widget-header">
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
                            <th>pp3</th>
                            <th>fpp3</th>
                            <th>pp4</th>
                            <th>fpp4</th>
                            <th>folio</th>
                            <th>gestor</th>
                            <th>pmt1</th>
                            <th>fpmt1</th>
                            <th>pmt2</th>
                            <th>fpmt2</th>
                            <th>pmt3</th>
                            <th>fpmt3</th>
                            <th>pmt4</th>
                            <th>fpmt4</th>
                            <th>suma vig.</th>
                            <th>suma venc.</th>
                            <th>suma pag.</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                    foreach ($resultPagos as $row) {
			$temprow = $row;
                        $temprow['monto2'] = 0;
                        $temprow['fecha2'] = '';
                        $temprow['monto3'] = 0;
                        $temprow['fecha3'] = '';
                        $temprow['monto4'] = 0;
                        $temprow['fecha4'] = '';
                        $temprow['sumavig'] = 0;
                        $temprow['sumavenc'] = 0;
			$temprow['sumapag'] = 0;
                        $qi = "insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('" . $row['c_cvge'] . "','" . $row['cliente'] . "','" . $row['status_de_credito'] .
                                "','" . $row['producto'] . "','" . $row['subproducto'] .
                                "',0,0," . $row['monto'] . ")";
                        $pdo->query($qi);
                        if ($row['hauto'] != $temprow['hauto']) {
                            if ($temprow['hauto'] > 0) {
                                echo '<tr>';
                                foreach ($temprow as $data) {
                                    echo "<td>" . $data . "</td>";
                                }
                                echo '</tr>';
                            }
                            $kk = 0;
                            $temprow['sumapag'] = $row['monto'];
                            if ($temprow['sumapag'] >= $temprow['tprom']) {
                                $temprow['sumavig'] = 0;
                                $temprow['sumavenc'] = 0;
                            } else {
                                $leftover = max($temprow['n_prom1'] - $temprow['sumapag'], 0);
                                $temprow['sumavig'] = $temprow['tprom'] - $temprow['sumapag'] - $leftover;
                                $temprow['sumavenc'] = $leftover;
                            }
                        } else {
                            $temprow['sumapag'] = $temprow['sumapag'] + $row['monto'];
                            if ($temprow['monto2']>0) {
                                $temprow['monto2'] = $row['monto'];
                                $temprow['fecha2'] = $row['fecha'];
                            } else {
                                if ($temprow['monto3']>0) {
                                    $temprow['monto3'] = $row['monto'];
                                    $temprow['fecha3'] = $row['fecha'];
                                } else {
                                if ($temprow['monto4']>0) {
                                    $temprow['monto4'] = $row['monto'];
                                    $temprow['fecha4'] = $row['fecha'];
                                }
                            }
                        }
                    }
                    if ($temprow['hauto'] > 0) {
                        echo '<tr>';
                        foreach ($temprow as $data) {
                            echo "<td>" . $data . "</td>";
                        }
                        echo '</tr>';
                    }
}
                    ?>
                </tbody>
                </table>
            </div>
            <div id='vencidos'>
                <table class="ui-widget">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            for ($i = 0; $i < $numberfieldsVencidos; $i++) {
                                $var = $resultVencidos->getColumnMeta($i);
                                echo "<th>" . $var['name'] . "</th>";
                            }
                            ?>   
                            <th>monto1</th>
                            <th>fecha1</th>
                            <th>monto2</th>
                            <th>fecha2</th>
                            <th>monto3</th>
                            <th>fecha3</th>
                            <th>monto4</th>
                            <th>fecha4</th>
                            <th>suma vig.</th>
                            <th>suma venc.</th>
                            <th>suma pag.</th>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content>">
                        <?php
        foreach ($resultVencidos as $row) {
            if ($row['auto'] <> $id) {
                $id = $row['auto'];
                foreach ($row as $data) {
                    echo "<td>" . $data . "</td>";
                }
            } else {
                echo "<td>" . $row['monto'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
            }
            ?>   
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php
            $queryplus = "select if(d_prom2<(curdate()),n_prom,n_prom1),
if(d_prom2>=(curdate()),n_prom2,0) from historia 
where auto=" . $id;
            $resultplus = $con->query($queryplus);
            while ($answerplus = $resultplus->fetch_row()) {
                echo "<td>" . $answerplus[1] . "</td>";
                echo "<td>" . $answerplus[0] . "</td>";
                echo "<td></td>";
                echo "</tr>";
                $qi = "insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('" . $row['gestor'] . "','" . $row['cliente'] . "','" . $row['campa&ntilde;a'] .
                        "','" . $row['producto'] . "','" . $row['subproducto'] .
                        "'," . $answerplus[1] . "," . $answerplus[0] . ",0)";
                $con->query($qi) or die($con->error);
            }
        }
?>
                </tbody>
                </table>
            </div>
            <div id='vigentes'>
                <table class="ui-widget">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            for ($i = 0; $i < $numberfieldsVigentes; $i++) {
                                $var = $resultVigentes->getColumnMeta($i);
                                echo "<th>" . $var['name'] . "</th>";
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
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        foreach ($resultVigentes as $row) {
                            if ($row[0] <> $id) {
                                echo "<tr>";
                                $id = $row[0];
                                for ($j = 0; $j < $numberfieldsVigentes; $j++) {
                                    echo "<td>" . $row[$j] . "</td>";
                                }
                                $k = $j;
                            } else {
                                echo "<td>" . $row[$j - 2] . "</td>";
                                echo "<td>" . $row[$j - 1] . "</td>";
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
                        $queryplus = "select n_prom from historia 
where auto=" . $id;
                        $resultplus = $pdo->query($queryplus);
                        foreach ($resultplus as $answerplus) {
                            echo "<td>" . $answerplus['n_prom'] . "</td>";
                            echo "<td>0</td>";
                            echo "<td></td>";
                            echo "</tr>";
                            $qi = "insert into gmbtemp (gestor,cliente,sdc,producto,subproducto,vigente,vencido,pago)
values ('" . $row[15] . "','" . $row[2] . "','" . $row[3] .
                                    "','" . $row[4] . "','" . $row[5] .
                                    "'," . $answerplus[0] . "," . $answerplus[1] . ",0)";
                            $pdo->query($qi);
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div id='analytica'>
                <h2>Por Cliente</h2>
                <?php
// analytica
                $pdo->query($querycalc);
                $queryAnalytica = "select cliente,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente;";
                $resultAnalytica = $pdo->query($queryAnalytica);
                $numberfieldsAnalytica = $resultAnalytica->columnCount();
                ?>
                <table class="ui-widget">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            for ($i = 0; $i < $numberfieldsAnalytica; $i++) {
                                $var = $resultAnalytica->getColumnMeta($i);
                                echo "<th>" . $var['name'] . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        foreach ($resultAnalytica as $row) {
                            echo "<tr>";
                            for ($j = 0; $j < $numberfieldsAnalytica; $j++) {
                                echo "<td>" . $row[$j] . "</td>";
                            }
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
                <h2>Por Gestor</h2>
                <?php
                $queryGestor = "select gestor,sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by gestor;";
                $resultGestor = $pdo->query($queryGestor);
                $numberfieldsGestor = $resultGestor->columnCount();
                ?>
                <table class="ui-widget">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            for ($i = 0; $i < $numberfieldsGestor; $i++) {
                                $var = $resultGestor->getColumnMeta($i);
                                echo "<th>" . $var['name'] . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                            foreach ($resultGestor as $row) {
                            echo "<tr>";
                            for ($j = 0; $j < $numberfieldsGestor; $j++) {
                                echo "<td>" . $row[$j] . "</td>";
                            }
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
                <h2>Por Segmento</h2>
                <?php
                $querySegmento = "select cliente,substring_index(sdc,'-',1),sum(pago),sum(vigente),sum(vencido)
from gmbtemp group by cliente,substring_index(sdc,'-',1);";
                $resultSegmento = $pdo->query($querySegmento);
                $numberfieldsSegmento = $resultSegmento->columnCount();
                ?>   
                <table class="ui-widget">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            for ($i = 0; $i < $numberfieldsSegmento; $i++) {
                                $var = $resultSegmento->getColumnMeta($i);
                                echo "<th>" . $var['name'] . "</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        foreach ($resultSegmento as $row) {
                            echo "<tr>";
                            for ($j = 0; $j < $numberfieldsSegmento; $j++) {
                                echo "<td>" . $row[$j] . "</td>";
                            }
                        }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
    </body>
</html>
