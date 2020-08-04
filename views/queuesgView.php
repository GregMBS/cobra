<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sus queues</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.12.0/themes/redmond/jquery-ui.css"
          type="text/css" media="all"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"
            type="text/javascript"></script>
</head>
<body>
<script src="/js/queuesg.js"></script>
<script>
    const arrayC = JSON.parse('<?php echo $arrayc; ?>');
    const arrayS = JSON.parse('<?php echo $arrays; ?>');
    const arrayQ = JSON.parse('<?php echo $arrayq; ?>');
</script>
<?php echo $msg; ?>
<div>
    <form method='get' action='#' name='queueform'>
        <div>
            <input name='gestor' type='text' readonly='readonly' value='<?php echo $capt; ?>'>
        </div>
        <div>
            <br>
            <div>CLIENTE<br>
                <div id='cliente'>
                </div>
            </div>
            <div>SEGMENTO<BR>
                <div id='sdc'>
                </div>
            </div>
            <div>QUEUE<BR>
                <div id='queue'>
                </div>
            </div>
            <div class='introb'>
                <input type="submit" name="go" id="intro" value="INTRO">
            </div>
            <input type="hidden" name="capt" value="<?php echo $capt ?>">
    </form>
</div>
<div class='introb'>
    <button onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Cuentas</button>
</div>
</body>
</html> 
