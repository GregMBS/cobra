<!DOCTYPE html">
<html>
    <head>
        <title>Promesas y Pagos</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    </head>
    <body>
        <script>
            $(function () {
                $("#tabs").tabs();
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
                            <?php
                            foreach ($resultPagos[0] as $key => $value) {
                                if ($key != 'hauto') {
                                    echo "<th>" . $key . "</th>";
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultPagos as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    foreach ($row as $key => $value) {
                                        if ($key != 'hauto') {
                                            echo "<td>" . $key . "</td>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
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
                            foreach ($resultVencidos[0] as $key => $value) {
                                echo "<th>" . $key . "</th>";
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
                        $resultplus = $pdo->query($queryplus);
                        foreach ($resultplus as $answerplus) {
                            echo "<td>" . $answerplus[1] . "</td>";
                            echo "<td>" . $answerplus[0] . "</td>";
                            echo "<td></td>";
                            echo "</tr>";
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
                            foreach ($resultVigentes as $key => $value) {
                                echo "<th>" . $key . "</th>";
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
