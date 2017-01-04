<!DOCTYPE html">
<html>
    <head>
        <title>Promesas y Pagos</title>
        <link rel="Stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" />
        <link href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
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
                <table id="pagotab" class="ui-widget">
                    <thead class="ui-widget-header">
                        <tr>
                            <?php
                            foreach ($resultPagos[0] as $key => $value) {
                                echo "<th>" . $key . "</th>";
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
                                            echo "<td>" . $value . "</td>";
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
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content>">
                        <?php
                        foreach ($resultVencidos as $row) {
                            foreach ($row as $key => $value) {
                                echo "<td>" . $value . "</td>";
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
                        </tr>
                    </thead>
                    <tbody class="ui-widget-content">
                        <?php
                        foreach ($resultVigentes as $row) {
                            foreach ($row as $key => $value) {
                                echo "<td>" . $value . "</td>";
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
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
            <script>
            $(function () {
                $("#tabs").tabs();
                $('#pagotab').DataTable({
                    "bPaginate": false,
                    "bJQueryUI": true
                });
            });
            </script>

    </body>
</html>
