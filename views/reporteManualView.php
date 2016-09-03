<!DOCTYPE html>
<html>
    <head>
        <title>Reporte del Queue Manual</title>
        <link href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>Queue MANUAL</h1>
        <button onClick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regresar al administraci&oacute;n</button>
        <table id='buscartab' class='ui-widget'>
            <thead class='ui-widget-header'>
                <tr>
                    <th>CLIENTE</th>
                    <th>SEGMENTO</th>
                    <th>ASIGNADO</th>
                    <th># CUENTAS</th>
                    <th># SIN GESTI&Oacute;N ESTA HORA</th>
                    <th># SIN GESTI&Oacute;N HOY</th>
                    <th>REPORTE</th>
                </tr>
            </thead>
            <tbody class='ui-widget-content'>
                <?php
                foreach ($result as $answer) {
                    $cliente = $answer['cliente'];
                    $segmento = $answer['segmento'];
                    $asignado = $answer['asignado'];
                    $total = $answer['total'];
                    $normal = $answer['normal'];
                    $largo = $answer['largo'];
                    ?>
                    <tr>
                        <td><?php echo $cliente; ?></td>
                        <td><?php echo $segmento; ?></td>
                        <td><?php echo $asignado; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $normal; ?></td>
                        <td><?php echo $largo; ?></td>
                        <td>
                            <form action="speclistman.php" method="get">
                                <input type="hidden" name="capt" value="<?php echo $capt; ?>" />
                                <input type="hidden" name="cliente" value="<?php echo $cliente; ?>" />
                                <input type="hidden" name="sdc" value="<?php echo $segmento; ?>" />
                                <button>REPORTE</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script LANGUAGE="JavaScript" TYPE="text/JavaScript">
            $(function() {
            $( "input:submit, a, button" ).button();
            $( "body" ).css("font-size", "10pt")
            });
        </script>
    </body>
</html> 
