<?php

$resultcheck = '';
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck = mysql_fetch_row($resultcheck)) {
    if ($answercheck[0] != 1) {
        
    } else {
        $folio = mysql_real_escape_string($_GET['folio']);
        $pc = 0;
        $querypc = "select count(1) from folios,pagos,historia where id=id_cuenta
and c_cont=id
and pagos.fecha>last_day(curdate()-interval 1 month) 
and pagos.fecha<d_fech and n_prom>0
and folio=" . $folio . ";";
        $resultpc = mysql_query($querypc) or die(mysql_error());
        while ($rowpc = mysql_fetch_row($resultpc)) {
            $pc = $rowpc[0];
        }
        if ($pc == 0) {
            $querymain = "select resumen.cliente,folio,enviado,ifnull(numero_de_credito,numero_de_cuenta),nombre_deudor,capital,saldo_can,
mora,historia.n_prom1+historia.n_prom2,datediff(d_prom1,'1970-01-01'),n_prom1,
datediff(d_prom2,'1970-01-01'),n_prom2,
cuenta_concentradora_1,historia.d_fech,id_cuenta,
c_cnp,folios.auto,c_prom as cp,c_freq,
to_days(d_prom2)-to_days(d_prom1)
from resumen join historia on historia.c_cont=id_cuenta
left join (select auto,c_cont,d_fech,c_hrin from historia where n_prom>0) as tmp1 
on tmp1.c_cont=historia.c_cont and ((tmp1.d_fech>historia.d_fech) or 
(tmp1.d_fech=historia.d_fech AND tmp1.c_hrin>historia.c_hrin))
join folios on resumen.id_cuenta=folios.id
join dictamenes on c_cvst=dictamenes.dictamen
where n_prom>0 and fecha_de_actualizacion>last_day(curdate()-interval 38 day) 
and tmp1.auto is null
and folios.fecha>=historia.d_fech
and folios.folio = " . $folio . " group by folios.folio";
        } else {
            $querymain = "select folios.cliente,folio,enviado,
ifnull(numero_de_credito,numero_de_cuenta),
nombre_deudor,capital,saldo_can,
mora,h1.n_prom1+sum(pagos.monto),datediff(max(pagos.fecha),'1970-01-01'),sum(pagos.monto),
datediff(h1.d_prom1,'1970-01-01'),h1.n_prom1,
cuenta_concentradora_1,h1.d_fech,pagos.id_cuenta,
h1.c_cnp,folios.auto,ciudad_deudor,estado_deudor,
folios.gestor,substring_index(status_de_credito,'-',1),h2.auto as 
upd,h1.c_prom as 
cp,h1.c_freq,
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
and h2.auto is null
and folios.cliente regexp 'Credito Si' 
and folios.folio = " . $folio . " group by folios.folio";
        }
        $result = mysql_query($querymain) or die(mysql_error());
        while ($row = mysql_fetch_row($result)) {
            $CLIENTE = $row[0];
            $FOLIO = $row[1];
            if ($CLIENTE == 'Prestamo Relampago') {
                $FOLIO = sprintf("%05s", $row[1]);
            }
//            $ENVIADO = $row[2];
            $CUENTA = $row[3];
            $NOMBRE = $row[4];
            $SD = $row[5];
            $ST = $row[6];
            $DV = $row[7];
            $NP = $row[8];
            $DP1 = $row[9] + 25569;
            $NP1 = $row[10];
            $DP2 = $row[11] + 25569;
            $NP2 = $row[12];
            if ($NP2 == 0) {
                $DP2 = '';
            }
            $COBRADOR = $row[13];
            if ($CLIENTE == 'Prestamo Relampago') {
                $COBRADOR = 'ADARSA';
            }
//            $DFECH = $row[14];
//            $ID_CUENTA = $row[15];
            $CNP = trim($row[16]);
//            $auto = $row[17];
            $MDP = $row['cp'];
            if (empty($MDP)) {
                $MDP = 'F';
            }
            $FREQ = 'quincenal';
            $DIFF = $row[20];
            if ($DIFF < 14) {
                $FREQ = 'semanal';
            }
            if ($DIFF > 20) {
                $FREQ = 'mensual';
            }
            if (empty($DIFF)) {
                $FREQ = 'mensual';
            }
            $CNPA = 'MD';
            setlocale(LC_MONETARY, 'en_US');
            if ($CLIENTE == 'Credito Si') {
                $querycnp = "select csi_cr from csidict where dictamen sounds like '" . $CNP . "';";
                $resultcnp = mysql_query($querycnp) or die(mysql_error());
                while ($rowcnp = mysql_fetch_row($resultcnp)) {
                    $CNPA = $rowcnp[0];
                }
            }
        }
// Creating a workbook
        $workbook = new Spreadsheet_Excel_Writer();
        $filename = "folio" . $folio . ".xls";
// sending HTTP headers
        $workbook->send($filename);

// Creating a worksheet
        $worksheet = & $workbook->addWorksheet('propuestas');
        $worksheet->setInputEncoding('ISO-8859-1');
        $formata = & $workbook->addFormat(array('Size' => 8,
                    'Align' => 'lrft',
                    'Bold' => 1,
                    'Color' => 'black',
                    'FgColor' => 'white'));
        $formata->setFontFamily('Calibri');
        $formatb = & $workbook->addFormat(array('Size' => 8,
                    'Bold' => 0,
                    'Color' => 'black',
                    'FgColor' => 'white'));
        $formatb->setFontFamily('Calibri');
        $dateFormat = & $workbook->addFormat(array('Size' => 8,
                    'Bold' => 0,
                    'Color' => 'black',
                    'FgColor' => 'white'));
        $dateFormat->setFontFamily('Calibri');
        $dateFormat->setNumFormat('DD/MM/YY');

// The actual data
        $degree = utf8_decode('°');
        $iacute = utf8_decode('ì');
        $oacute = utf8_decode('ó');
        $worksheet->write(0, 0, 'N' . $degree . ' Credito', $formata);
        $worksheet->write(0, 1, 'Nombre del Cliente', $formata);
        $worksheet->write(0, 2, 'Capital', $formata);
        $worksheet->write(0, 3, 'Saldo Cancelaci' . $oacute . 'n', $formata);
        $worksheet->write(0, 4, 'D' . $iacute . 'as de Mora', $formata);
        $worksheet->write(0, 5, 'Importe Negociado', $formata);
        $worksheet->write(0, 6, 'Fecha de pago 1', $formata);
        $worksheet->write(0, 7, 'Monto de pago 1 ', $formata);
        $worksheet->write(0, 8, 'Fecha de pago 2', $formata);
        $worksheet->write(0, 9, 'Monto de pago 2', $formata);
        $worksheet->write(0, 10, 'Folio Conv', $formata);
        $worksheet->write(0, 11, 'Motivo de atraso', $formata);
        $worksheet->write(0, 12, 'Medio de pago', $formata);
        $worksheet->write(0, 13, 'Asignaci' . $oacute . 'n', $formata);
        $i = 1;
        $worksheet->write($i, 0, $CUENTA, $formatb);
        $worksheet->write($i, 1, $NOMBRE, $formatb);
        $worksheet->write($i, 2, money_format('%.2n', $SD), $formatb);
        $worksheet->write($i, 3, money_format('%.2n', $ST), $formatb);
        $worksheet->write($i, 4, $DV + 0, $formatb);
        $worksheet->write($i, 5, money_format('%n', $NP), $formatb);
        $worksheet->write($i, 6, $DP1, $dateFormat);
        $worksheet->write($i, 7, money_format('%n', $NP1), $formatb);
        if ($NP2 > 10) {
            $worksheet->write($i, 8, $DP2, $dateFormat);
            $worksheet->write($i, 9, money_format('%n', $NP2), $formatb);
        } else {
            $worksheet->write($i, 8, '');
            $worksheet->write($i, 9, 0);
        }
        $worksheet->write($i, 10, $FOLIO, $formatb);
        $worksheet->write($i, 11, $CNPA, $formatb);
        $worksheet->write($i, 12, $MDP, $formatb);
        $worksheet->write($i, 13, $COBRADOR, $formatb);
// Let's send the file
        $workbook->close();
    }
}
mysql_close();
?>
