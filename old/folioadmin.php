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
        $queryups = "update folios,historia,resumen 
set enviado=0,fecha=d_fech+interval (time_to_sec(c_hrfi)) second 
where c_cont=id and n_prom>0 and d_fech>fecha and c_cvst like 'promesa de%'
and c_cont=id_cuenta and n_prom>=saldo_descuento_2
and d_fech=curdate() and fecha>last_day(curdate()-interval 1 month);";
        mysql_query($queryups) or die("ERROR FM4a - " . mysql_error());
        $querymaina = "create temporary table foliolist 
select folios.cliente,folio,enviado,
ifnull(numero_de_credito,numero_de_cuenta),
nombre_deudor,capital,saldo_can,
mora,h1.n_prom,h1.d_prom1,h1.n_prom1,h1.d_prom2,h1.n_prom2,
h1.d_prom3,h1.n_prom3,h1.d_prom4,h1.n_prom4,
cuenta_concentradora_1,h1.d_fech,resumen.id_cuenta,
if(creditosi,h1.c_cvst,h1.c_cnp),folios.auto,ciudad_deudor,estado_deudor,
folios.gestor,who(status_de_credito),h2.auto as upd,h1.c_prom,h1.c_freq,
to_days(h1.d_prom2)-to_days(h1.d_prom1)
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and folios.fecha<concat(h2.d_fech,' ',h2.c_hrin) and h2.c_cvst ='PROMESA DE PAGO TOTAL'
left join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and saldo_can=saldo_total and monto is null
and folios.cliente regexp 'Credito Si'
";
        mysql_query($querymaina) or die(mysql_error());
        $querymainb = "insert into foliolist 
select folios.cliente,folio,enviado,
ifnull(numero_de_credito,numero_de_cuenta),
nombre_deudor,capital,saldo_can,
mora,sum(pagos.monto),max(pagos.fecha),sum(pagos.monto),h1.d_prom1,h1.n_prom1,
h1.d_prom2,h1.n_prom2,h1.d_prom3,h1.n_prom3,
cuenta_concentradora_1,h1.d_fech,resumen.id_cuenta,
if(creditosi,h1.c_cvst,h1.c_cnp),folios.auto,ciudad_deudor,estado_deudor,
folios.gestor,who(status_de_credito),h2.auto as upd,h1.c_prom,h1.c_freq,
to_days(h1.d_prom1)-to_days(max(pagos.fecha))
from resumen 
join folios on id=id_cuenta
join historia h1 on h1.c_cont=id and folios.fecha>=h1.d_fech and h1.n_prom>0
join dictamenes on h1.c_cvst=dictamenes.dictamen
left join historia h2 on h2.c_cont=id and h2.n_prom>0 
and h2.d_fech > h1.d_fech and folios.fecha>h2.d_fech 
and h2.c_cvst like 'PRO%DE%'
join pagos on resumen.id_cuenta=pagos.id_cuenta 
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<h1.d_fech
and confirmado=0
where folios.fecha>last_day(curdate()-interval 1 month)+interval 1 day
and h1.d_prom>last_day(curdate()-interval 1 month)
and saldo_can=saldo_total and h2.auto is null
and folios.cliente regexp 'Credito Si' group by folio
";
        mysql_query($querymainb) or die(mysql_error());
        /*
          $querymainc = "select * from foliolist
          order by enviado,upd desc,
          folio desc,d_fech desc,d_prom1 desc;";
          $resultc = mysql_query($querymainc) or die(mysql_error());
          $k = 0;
         */
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
                            "sAjaxSource": "folioadmin_ajax.php",
                            "bPaginate": false,
                            "oLanguage": {
                                "sUrl": "espanol.txt"
                            },
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
                                    envh = '<form name="foliolinea' + aData[1] + '" method="get" action="#here0" id="foliolinea' + aData[1] + '">' +
                                            '<input type="hidden" name="client" value="a">' +
                                            '<input type="hidden" name="capt" value="<?php echo $capt ?>">' +
                                            '<input type="hidden" name="j" value="' + aData[1] + '">' +
                                            '<input type="hidden" name="FOLIOa' + aData[1] + '" value="' + aData[1] + '">' +
                                            '<input type="checkbox" name="ENVIADO" value="1" checked="checked" class="copypaste"/>' +
                                            '</form>';
                                }
                                $('td:eq(2)', nRow).html(envh);
                                creh = "<a href='foliocreate.php?capt=<?php echo $capt; ?>&folio=" + aData[1] + "'>CREAR</a>";
                                $('td:eq(4)', nRow).html(creh);
                                if (aData[3] > 0) {
                                    updh = '<form name="foliolinea' + aData[1] + '" method="get" action="#here0" id="foliolinea' + aData[1] + '">' +
                                            '<input type="hidden" name="client" value="a">' +
                                            '<input type="hidden" name="capt" value="<?php echo $capt ?>">' +
                                            '<input type="hidden" name="j" value="' + aData[1] + '">' +
                                            '<input type="hidden" name="FOLIOa' + aData[1] + '" value="' + aData[1] + '">' + '<input type="submit" name="go" value="UPDATE">' +
                                            '</form>';
                                }
                                else {
                                    updh = 'NO' +
                                            '</form>';
                                }
                                $('td:eq(3)', nRow).html(updh);
                                freqh = 'quincenal';
                                if (aData[23] * 1 < 14) {
                                    freqh = 'semanal';
                                }
                                if (aData[23] * 1 > 20) {
                                    freqh = 'mensual';
                                }
                                if (aData[23] === '') {
                                    freqh = 'mensual';
                                }
                                $('td:eq(23)', nRow).html(freqh);
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
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "red"},
                                {"sClass": "black"},
                                {"sClass": "black"},
                                {"sClass": "black"},
                                {"sClass": "black"}
                            ],
                            "bJQueryUI": true
                        });
                    });
                </script>
                <div><a name='top'></div>
                <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>';">Regressar a la Pagina Administrativa</button><br>
                <p>
                    <button onclick="window.location = 'foliocreatepend.php?capt=<?php echo $capt; ?>';">CREAR PENDIENTES</button></td>
                <button onclick="window.location = 'foliocreateall.php?capt=<?php echo $capt; ?>';">CREAR REPORTE</button></td>
        </p>
        <table summary="Folioa" id='foliotab'>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Folio</th>
                    <th>Enviado?</th>
                    <th>Update?</th>
                    <th>Crear</th>
                    <th>N&deg; Credito</th>
                    <th>Nombre del Cliente</th>
                    <th>Capital</th>
                    <th>Saldo Cancellaci&oacute;n</th>
                    <th>D&iacute;as de Mora</th>
                    <th>Importe Negociado</th>
                    <th>Fecha de pago 1</th>
                    <th>Monto de pago 1</th>
                    <th>Fecha de pago 2</th>
                    <th>Monto de pago 2</th>
                    <th>Fecha de pago 3</th>
                    <th>Monto de pago 3</th>
                    <th>Fecha de pago 4</th>
                    <th>Monto de pago 4</th>
                    <th>Folio Conv</th>
                    <th>Motivo de atraso</th>
                    <th>Medio de pago</th>
                    <th>Asignaci&oacute;n</th>
                    <th>Frecuencia de pago</th>
                    <th>Fecha de Firma</th>
                    <th>Gestor</th>
                    <th>Campa&ntilde;a</th>
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
