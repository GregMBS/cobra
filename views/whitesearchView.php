<!DOCTYPE html>
<html>
    <head>
        <title>Directorio - Buscar</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.jqueryui.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.jqueryui.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" type="text/javascript"></script>
    </head>
    <body>
        <h1>BUSCAR</h1>
        <table id="dirtable">
            <thead>
                <tr>
                    <th>TELÉFONO</th>
                    <th>NOMBRE</th>
                    <th>CALLE</th>
                    <th>COLONIA</th>
                    <th>CIUDAD</th>
                    <th>ESTADO</th>
                    <th>CP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $row) {
                    $tel     = $row['tel'];
                    $nombre  = $row['nombre_deudor'];
                    $cp      = $row['cp_deudor'];
                    $calle   = $row['domicilio_deudor'];
                    $colonia = $row['colonia_deudor'];
                    $ciudad  = $row['ciudad_deudor'];
                    $estado  = $row['estado_deudor'];
                    ?>
                    <tr>
                        <td><?php echo $tel; ?></td>
                        <td><?php echo utf8_decode($nombre); ?></td>
                        <td><?php echo utf8_decode($calle); ?></td>
                        <td><?php echo utf8_decode($colonia); ?></td>
                        <td><?php echo utf8_decode($ciudad); ?></td>
                        <td><?php echo utf8_decode($estado); ?></td>
                        <td><?php echo $cp; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="button" value="white" onclick=
                "window.location = 'white.php?capt=<?php echo $capt ?>';"></button>
        <script>
            $(function() {
                $('#dirtable').dataTable({"bJQueryUI": true});
            });
        </script>
    </body>
</html> 
