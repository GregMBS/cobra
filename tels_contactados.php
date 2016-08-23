<?php
set_time_limit(300);
require_once 'vendor/autoload.php';


use cobra_salsa\PdoClass;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'classes/PdoClass.php';
$pdoc = new PdoClass();
$pdo = $pdoc->dbConnectAdmin();
$get = filter_input_array(INPUT_GET);
$capt = $get['capt'];
if (!empty($get['fecha1'])) {
    $fecha1 = $get['fecha1'];
    $fecha2 = $get['fecha2'];
    $queryclean = "truncate contactados;";
    $pdo->query($queryclean);
    $queryfill = "insert into contactados select distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not like '%ivo'
and c_msge is null
and queue not in ('sin gestion','sin contactos','ilocalizables')
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between '" . $fecha1 . "' and '" . $fecha2 . "'
order by c_tele";
    $stf = $pdo->prepare($queryfill);
    $stf->bindParam(':fecha1', $fecha1);
    $stf->bindParam(':fecha2', $fecha2);
    $stf->execute();
    $querymain = 'select cliente,nombre_deudor,concat(" ",numero_de_cuenta) as "numero_de_cuenta",
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
where status_de_credito not like "%ivo"
;';
}
require_once 'tels_Common.php';