<?php
set_time_limit(300);
require_once 'Spreadsheet/Excel/Writer.php';
require_once 'pdoConnect.php';
$pdoc   = new pdoConnect();
$pdo    = $pdoc->dbConnectUser();
$capt   = filter_input(INPUT_GET, 'capt');
$fecha1 = filter_input(INPUT_GET, 'fecha1');
$fecha2 = filter_input(INPUT_GET, 'fecha2');
if (!empty($fecha1)) {
    $queryclean = "truncate contactados";
    $pdo->query($queryclean);
    $queryfill  = "insert into contactados select distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not like '%o'
and c_msge is null
and queue not in ('sin gestion','sin contactos','ilocalizables')
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between :fecha1 and :fecha2
order by c_tele";
    $stf        = $pdo->prepare($queryfill);
    $stf->bindParam(':fecha1', $fecha1);
    $stf->bindParam(':fecha2', $fecha2);
    $stf->execute();
    $querymain  = 'select cliente,nombre_deudor,concat(" ",numero_de_cuenta) as "numero_de_cuenta",
concat(" ",tel_1) as "tel 1",tel_1 in (select c_tele from contactados) as tel_1_contacto,
concat(" ",tel_2) as "tel 2",tel_2 in (select c_tele from contactados) as tel_2_contacto,
concat(" ",tel_3) as "tel 3",tel_3 in (select c_tele from contactados) as tel_3_contacto,
concat(" ",tel_4) as "tel 4",tel_4 in (select c_tele from contactados) as tel_4_contacto,
concat(" ",tel_1_alterno) as "tel 1 alterno",tel_1_alterno in (select c_tele from contactados) as tel_1_alterno_contacto,
concat(" ",tel_2_alterno) as "tel 2 alterno",tel_2_alterno in (select c_tele from contactados) as tel_2_alterno_contacto,
concat(" ",tel_3_alterno) as "tel 3 alterno",tel_3_alterno in (select c_tele from contactados) as tel_3_alterno_contacto,
concat(" ",tel_4_alterno) as "tel 4 alterno",tel_4_alterno in (select c_tele from contactados) as tel_4_alterno_contacto,
concat(" ",tel_1_laboral) as "tel 1 laboral",tel_1_laboral in (select c_tele from contactados) as tel_1_laboral_contacto,
concat(" ",tel_2_laboral) as "tel 2 laboral",tel_2_laboral in (select c_tele from contactados) as tel_2_laboral_contacto,
concat(" ",tel_1_ref_1) as "tel 1 ref 1",tel_1_ref_1 in (select c_tele from contactados) as tel_1_ref_1_contacto,
concat(" ",tel_1_ref_2) as "tel 1 ref 2",tel_1_ref_2 in (select c_tele from contactados) as tel_1_ref_2_contacto,
concat(" ",tel_1_ref_3) as "tel 1 ref 3",tel_1_ref_3 in (select c_tele from contactados) as tel_1_ref_3_contacto,
concat(" ",tel_1_ref_4) as "tel 1 ref 4",tel_1_ref_4 in (select c_tele from contactados) as tel_1_ref_4_contacto
from resumen
where status_de_credito not like "%o"
order by cliente,numero_de_cuenta
;';
    $stm=$pdo->prepare($querymain);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
// Creating a workbook
    if ($result) {
        $workbook = new Spreadsheet_Excel_Writer();

        $filename = "Query_de_telefonos_".date('ymd').".xls";
// sending HTTP headers
        $workbook->send($filename);

// Creating a worksheet
        $worksheet = & $workbook->addWorksheet('telefonos');
        $worksheet->setInputEncoding('ISO-8859-1');
//echo "<html><head></head><body><table>";

        $ii           = 0;
        $fieldnames   = array_keys($result[0]);
        $numberfields = count($fieldnames);
//echo "<tr>";
        for ($i = 0; $i < $numberfields; $i++) {
            $worksheet->write(0, $i, $fieldnames[$i]);
//echo "<th>".$var."</th>";
        }
//echo "</tr>";
        $ii++;
        foreach ($result as $row) {
//echo "<tr>";
            $j=0;
            foreach ($row as $item) {
                $worksheet->write($ii, $j, $item);
                $j++;
//echo "<td>".$row[$j]."</td>";
            }
            $ii++;
//echo "</tr>";
        }
        $workbook->close();
//echo "</table></body></html>";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Tel&eacute;fonos Contactados</title>
        </head>
        <body>
            <button onclick="window.location = 'reports.php?capt=<?php echo $capt; ?>'">Regressar a la plantilla administrativa</button><br>
            <form action="tels_contactados.php" method="get" name="queryparms">
                <input type="hidden" name="capt" value="<?php echo $capt ?>">
                <p>HECHO de:
                    <?php echo $fecha1; ?>
                    <select name="fecha1">
                        <?php
                        $queryma  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech limit 360";
                        $resultma = $pdo->query($queryma);
                        foreach ($resultma as $answerma) {
                            ?>
                            <option value="<?php echo $answerma['d_fech']; ?>" style="font-size:120%;">
                                <?php echo $answerma['d_fech']; ?></option>
                        <?php } ?>
                    </select>
                    a:
                    <?php echo $fecha2; ?>
                    <select name="fecha2">
                        <?php
                        $querymd  = "SELECT distinct d_fech FROM historia
        where d_fech>last_day(curdate()-interval 2 month) 
        ORDER BY d_fech desc limit 60";
                        $resultmd = $pdo->query($querymd);
                        foreach ($resultmd as $answermd) {
                            ?>
                            <option value="<?php echo $answermd['d_fech']; ?>" style="font-size:120%;">
                                <?php echo $answermd['d_fech']; ?></option>
                            <?php } ?>
                    </select>
                </p>
                <input type='submit' name='go' value='Telefonos'>
            </form>
        </body>
    </html>
    <?php
}