<!DOCTYPE html>
<html lang="es">
<head>
    <title>CobraMas Visitador Checklist</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"
          type="text/css" media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
</head>
<body>
<div id="vtable">
    <p>Visitador: <?php echo $visitador; ?><br>
        Autorizó por: <?php echo $capt; ?><br>
        Fecha: <?php echo date('d/m/Y'); ?></p>
    <?php
    require_once __DIR__ . '/checkTable.php';
    ?>
</div>
<button onclick="window.location = 'reports.php?capt=<?php
echo $capt;
?>'">Regresar a la pagina administrativa
</button>
<br>
</body>
</html> 
