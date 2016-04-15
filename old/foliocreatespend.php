<?php

$resultcheck = '';
require_once 'Spreadsheet/Excel/Writer.php';
include('admin_hdr_2.php');
while ($answercheck = mysql_fetch_row($resultcheck)) {
    if ($answercheck[0] != 1) {
        
    } else {
//$folio=mysql_real_escape_string($_GET['folio']);
//$foliolist='folios';
        $today = date('Ymd');
// Creating a workbook
        $workbook = new Spreadsheet_Excel_Writer();

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
//$i=0;
// The actual data
        $degree = utf8_decode('°');
        $iacute = utf8_decode('ì');
//$oacute=utf8_decode('ó');
        $worksheet->write(0, 0, 'N' . $degree, $formata);
        $worksheet->write(0, 1, 'Numero de Cuenta', $formata);
        $worksheet->write(0, 2, 'Nombre del Cliente', $formata);
        $worksheet->write(0, 3, 'D' . $iacute . 'as de Mora', $formata);
        $worksheet->write(0, 4, 'Saldo Actual', $formata);
        $worksheet->write(0, 5, 'Interes Moratorio', $formata);
        $worksheet->write(0, 6, '% de Quita del Saldo', $formata);
        $worksheet->write(0, 7, '% de Quita de I.M.', $formata);
        $worksheet->write(0, 8, 'Monto Negociado', $formata);
        $worksheet->write(0, 9, 'Fecha de pago 1er Mes', $formata);
        $worksheet->write(0, 10, 'Monto de pago 1er Mes', $formata);
        $worksheet->write(0, 11, 'Fecha de pago 2er Mes', $formata);
        $worksheet->write(0, 12, 'Monto de pago 2er Mes', $formata);
        $worksheet->write(0, 13, 'Ejecutivo que Gestiono', $formata);
        $worksheet->write(0, 14, 'Agencia Asignada', $formata);
        $querymaina = "select h1.auto as id,numero_de_cuenta as 'cuenta',
nombre_deudor,dias_vencidos,saldo_descuento_1,saldo_total-saldo_descuento_1 as 'im',
if(h1.n_prom>saldo_descuento_1,0,100-(h1.n_prom/saldo_descuento_1*100)) as 'pc1',
if(h1.n_prom<saldo_descuento_1,100,100-((h1.n_prom-saldo_descuento_1)/(saldo_total-saldo_descuento_1)*100)) as 'pc2',
h1.n_prom,h1.d_prom,h1.n_prom,'','',
h1.c_cvge,'Cobranza Integral' as 'despacho','' as 'upd',h1.d_fech
from resumen
join historia h1 on h1.c_cont=id_cuenta and h1.n_prom>0
where cliente ='Surtidor del Hogar'
and h1.c_cvst like 'PROMESA DE%'
and not exists
(select auto from historia h2 where h2.c_cont=h1.c_cont and h2.n_prom>0 and h2.auto>h1.auto)
order by cuenta,d_fech";
        $result = mysql_query($querymaina) or die('Pass1: ' . mysql_error());
        $i = 0;
        while ($row = mysql_fetch_row($result)) {
            $i++;
            $worksheet->write($i, 0, $i, $formata);
            $worksheet->write($i, 1, $row[1], $formata);
            $worksheet->write($i, 2, $row[2], $formata);
            $worksheet->write($i, 3, $row[3], $formata);
            $worksheet->write($i, 4, $row[4], $formatb);
            $worksheet->write($i, 5, $row[5], $formatb);
            $worksheet->write($i, 6, $row[6], $formata);
            $worksheet->write($i, 7, $row[7], $formata);
            $worksheet->write($i, 8, $row[8], $formatb);
            $worksheet->write($i, 9, $row[9], $formata);
            $worksheet->write($i, 10, $row[10], $formatb);
            $worksheet->write($i, 11, $row[11], $formata);
            $worksheet->write($i, 12, $row[12], $formatb);
            $worksheet->write($i, 13, $row[13], $formata);
            $worksheet->write($i, 14, $row[14], $formata);
        }
    }
}
// Let's send the file
$filename = "foliosdh_" . $today . ".xls";
// sending HTTP headers
$workbook->send($filename);
$workbook->close();
mysql_close();
?>
