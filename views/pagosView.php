<!DOCTYPE html>
<html>
    <head>
        <title>CobraMas Pagos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
        <link href="bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
        <script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
        <script>
	    $(document).ready(function () {
		    $('#pagos').dataTable({
			    "bPaginate": false,
			    "oLanguage": {
				    "sUrl": "espanol.txt"
			    }
		    });
	    });
        </script>
    </head>
    <body>
        <div id="pagobox">
            <p>
                CUENTA:&nbsp;&nbsp;<?php echo $CUENTA ?><br>
                CLIENTE:&nbsp;<?php echo $CLIENTE ?>
            </p>
            <table class="ui-widget" id="pagos">
                <thead class='ui-widget-header'>
                    <tr>
                        <th>FECHA</th>
                        <th>MONTO</th>
                        <th>CONFIRMADO</th>
                    </tr>
                </thead>
                <tbody class="ui-widget-content">
                    <?php
                    foreach ($rowsub as $answer) {
                        $CF = "NO";
                        if ($answer['confirmado'] == 1) {
                            $CF = "S&Iacute;";
                        }
                        ?>
                        <tr>
                            <td><?php echo $answer['fecha']; ?></td>
                            <td><?php echo (float) $answer['monto']; ?></td>
                            <td><?php echo $CF; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <button onClick='window.close()'>CIERRA</button>
    </body>
</html> 
