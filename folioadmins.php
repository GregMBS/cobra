<?php
$resultcheck = '';
$capt = '';
include('admin_hdr_2.php');
while ($answercheck = mysql_fetch_row($resultcheck)) {
    if ($answercheck[0] != 1) {
        
    } else {
        set_time_limit(300);
        $go = '';
        if (!empty($_GET['go'])) {
            $go = mysql_real_escape_string($_GET['go']);
            $getname = 'FOLIO' . mysql_real_escape_string($_GET['client']) . mysql_real_escape_string($_GET['j']);
        }
        if ($go == "ENVIADO") {
            $querye = "UPDATE folios 
	SET enviado=1
	WHERE folio=" . mysql_real_escape_string($_GET[$getname]);
            mysql_query($querye) or die(mysql_error());
        }
        if ($go == "UPDATE") {
            $queryu = "UPDATE folios,resumen 
	SET fecha=now(),enviado=0,mora=dias_vencidos
	WHERE id=id_cuenta and folio=" . mysql_real_escape_string($_GET[$getname]);
            mysql_query($queryu) or die(mysql_error());
        }
        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
        <html>
            <head>
                <title>Listado de los Folios</title>
                <link rel="stylesheet" href="bower_components/jqueryui/themes/redmond/jquery-ui.css" type="text/css" media="all" />
                <script src="bower_components/jquery/dist/jquery.js" type="text/javascript"></script>
                <script src="bower_components/jqueryui/jquery-ui.js" type="text/javascript"></script>
                <script src="bower_components/datatables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                <style>
                    <!--
                    tr.odd { background-color: white }
                    tr.even { background-color: #dddddd }
                    .black { color: #000000 }
                    .red { color: #ff0000 }
                    -->
                </style>
            </head>
            <body>
                <script>
                    $(function() {
                        $('body').css('font-size', '8pt');
                        $('#foliotab').dataTable({
                            "sAjaxSource": "folioadmins_ajax.php",
                            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                                if (aData[2] === 0) {
                                    envh = '<form name="foliolinea' + aData[1] + '" method="get" action="#here0" id="foliolinea' + aData[1] + '">' +
                                            '<input type="hidden" name="client" value="a">' +
                                            '<input type="hidden" name="capt" value="<?php echo $capt ?>">' +
                                            '<input type="hidden" name="j" value="' + aData[1] + '">' +
                                            '<input type="hidden" name="FOLIOa' + aData[1] + '" value="' + aData[1] + '">' +
                                            '<input type="submit" name="go" value="ENVIADO">' +
                                            '</form>';
                                }
                                else {
                                    envh = '<input type="checkbox" name="ENVIADO" value="1" checked="checked" class="copypaste"/>';
                                }
                                $('td:eq(2)', nRow).html(envh);
                                creh = "<a href='foliocreate.php?capt=<?php echo $capt; ?>&folio=" + aData[1] + "'>CREAR</a>";
                                $('td:eq(4)', nRow).html(creh);
                                if (aData[3] > 0) {
                                    updh = '<input type="submit" name="go" value="UPDATE">';
                                }
                                else {
                                    updh = 'NO';
                                }
                                $('td:eq(3)', nRow).html(updh);
                                freqh = 'quincenal';
                                if (aData[19] * 1 < 14) {
                                    freqh = 'semanal';
                                }
                                if (aData[19] * 1 > 20) {
                                    freqh = 'mensual';
                                }
                                if (aData[19] === '') {
                                    freqh = 'mensual';
                                }
                                $('td:eq(19)', nRow).html(freqh);
                                return nRow;
                            },
                            "aoColumns": [
                                {"sClass": "black"},
                                {"sClass": "black"},
                                {"sClass": "black"},
                                {"sClass": "black"},
                                {"sClass": "black"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"}
                            ],
                            "bJQueryUI": true
                        });
                    });
                </script>
                <div><a name='top'></div>
                <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>';">Regressar a la Pagina Administrativa</button><br>
                <p>
                <!--<button onclick="window.location='foliocreatespend.php?capt=<?php echo $capt; ?>'">CREAR PENDIENTES</button></td>-->
                    <button onclick="window.location = 'foliocreatesall.php?capt=<?php echo $capt; ?>';">CREAR REPORTE</button></td>
            </p>
            <table summary="Folioa" id='foliotab'>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Folio</th>
                        <th>Enviado?</th>
                        <th>Update?</th>
                        <th>Crear</th>
                        <th>N&deg;</th>
                        <th>N&deg; DE CUENTA</th>
                        <th>NOMBRE DEL CLIENTE</th>
                        <th>D&Iacute;AS DE MORA</th>
                        <th>SALDO ACTUAL</th>
                        <th>INTERESES MORATORIOS</th>
                        <th>% DE QUITA DEL SALDO</th>
                        <th>% DE QUITA DE I.M.</th>
                        <th>MONTO NEGOCIADO</th>
                        <th>FECHA DE PAGO 1er MES</th>
                        <th>MONTO DE PAGO 1er MES</th>
                        <th>FECHA DE PAGO 2do MES</th>
                        <th>MONTO DE PAGO 2do MES</th>
                        <th>EJECUTIVO QUE GESTIONO</th>
                        <th>AGENCIA ASIGNADA</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </body>
        </html> 
        <?php
    }
} 
