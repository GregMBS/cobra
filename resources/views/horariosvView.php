<?php 
/**
 * @var cobra_salsa\HorariosVClass $hc
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Visitas</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
        <style type="text/css">
            tr:hover {background-color: #ffff00;}
            .heavy {font-weight:bold;font-size:10pt;}
            .heavytot {font-weight:bold;font-size:10pt;text-align:right;}
            .light {text-align:right;}
            .zeros {color:red;}
        </style>
    </head>
    <body>
        <h2>VISITAS</h2>
        <?php
        foreach ($visitadores as $visitador) {
            $name = $visitador['completo'];
            $iniciales = $visitador['iniciales'];
            ?>
            <table class="ui-widget">
                <thead class="ui-widget-header">
                    <tr>
                        <th><?php echo $name; ?></th>
                        <?php for ($i = 1; $i <= date('j'); $i++) { ?>
                            <th><?php echo $dias[$hc->dayOfWeek($i)] . " " . $i; ?></th>
                        <?php } ?>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    echo $hc->rowDisplay('INICIA RUTA', $start, date('j'), $iniciales);
                    echo $hc->rowDisplay('TERMINA RUTA', $stop, date('j'), $iniciales);
                    echo $hc->rowDisplay('-No acepta productos', $noAcc, date('j'), $iniciales);
                    echo $hc->rowDisplay('-Promesa de Pago', $PP, date('j'), $iniciales);
                    echo $hc->rowDisplay('-Promesa de Pago FPP', $FPP, date('j'), $iniciales);
                    echo $hc->rowDisplay('TOTAL DE VISITAS', $visits, date('j'), $iniciales);
                    echo $hc->rowDisplay('CONTACTOS', $contacts, date('j'), $iniciales);
                    ?>
                </tbody>
            </table>
            <?php
        }
        ?>
        <table class="ui-widget">
            <thead class="ui-widget-header">
                <tr>
                    <th>Dictamen</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody class="ui-widget-content">
                <?php
                foreach ($total as $t) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $t[0];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $t[1];
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>                
            </tbody>
        </table>
    </body>
</html>
