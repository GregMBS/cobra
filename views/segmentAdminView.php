<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administraci&oacute;n de las segmentos</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css" type="text/css"
          media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    <style>
        tr:hover {
            background-color: yellow;
        }
    </style>
</head>
<body>
<button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa
</button>
<br>
<table class="ui-widget">
    <thead class="ui-widget-header">
    <tr>
        <th>CLIENTE</th>
        <th>SEGMENTO</th>
        <th>CUENTAS</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody class="ui-widget-content">
    <?php
    $j = 0;

    foreach ($main as $row) {
        $j = $j + 1;
        $cliente = $row['cliente'];
        $segmento = $row['sdc'];
        $count = $row['cnt'];
        ?>
        <tr>
            <td><?php echo $cliente; ?></td>
            <td><?php echo $segmento; ?></td>
            <td><?php echo $count; ?></td>
            <?php if ($count == 0) { ?>
                <td>
                    <form class="gestorchange" name="gestorchange<?php echo $j ?>" method="get" action=
                    "/segmentadmin.php" id="gestorchange<?php echo $j ?>">
                        <input type="hidden" name="capt" value="<?php echo $capt ?>">
                        <input type="hidden" name="j" value="<?php echo $j ?>">
                        <input type="hidden" name="cliente" readonly="readonly" value="<?php echo $cliente; ?>"/>
                        <input type="hidden" name="segmento" readonly="readonly" value="<?php echo $segmento; ?>"/>
                        <input type="submit" name="go" value="BORRAR"></form>
                </td>
            <?php } ?>

        </tr>
    <?php }
    ?>
    <tr>
        <td colspan=3>
            <select name="cliseg" form="gestoradd">
                <?php
                if ($result2) {
                    foreach ($result2 as $row2) {
                        $cliente2 = $row2['cliente'];
                        $segmento2 = $row2['sdc'];
                        ?>
                        <option value="<?php echo $cliente2 . ';' . $segmento2; ?>"><?php echo $cliente2 . ' - ' . $segmento2; ?></option>
                        <?php
                    }
                }
                ?>
            </select></td>
        <td>
            <form class="gestoradd" name="gestoradd" method="get" action=
            "/segmentadmin.php" id="gestoradd">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <input type="submit" name="go" value="AGREGAR">
            </form>
        </td>

    </tr>
    </tbody>
</table>
<br>
<form class="gestoradd" name="gestoradd" method="get" action=
"/segmentadmin.php" id="gestoradd">
    <input type="hidden" name="capt" value="<?php echo $capt ?>">
    <input type="submit" name="go" value="AGREGARALL">
</form>
</body>
</html> 
