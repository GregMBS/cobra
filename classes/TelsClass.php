<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

require_once 'vendor/autoload.php';

/**
 * Description of TelsClass
 *
 * @author gmbs
 */
class TelsClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    /**
     *
     * @var string
     */
    private $mercadosReportQuery = "select cliente,nombre_deudor,concat(' ',numero_de_cuenta) as 'numero_de_cuenta',
concat(' ',tel_1) as 'tel 1',tel_1 in (select c_tele from marcados) as tel_1_marcado,
concat(' ',tel_2) as 'tel 2',tel_2 in (select c_tele from marcados) as tel_2_marcado,
concat(' ',tel_3) as 'tel 3',tel_3 in (select c_tele from marcados) as tel_3_marcado,
concat(' ',tel_4) as 'tel 4',tel_4 in (select c_tele from marcados) as tel_4_marcado,
concat(' ',tel_1_alterno) as 'tel 1 alterno',tel_1_alterno in (select c_tele from marcados) as tel_1_alterno_marcado,
concat(' ',tel_2_alterno) as 'tel 2 alterno',tel_2_alterno in (select c_tele from marcados) as tel_2_alterno_marcado,
concat(' ',tel_3_alterno) as 'tel 3 alterno',tel_3_alterno in (select c_tele from marcados) as tel_3_alterno_marcado,
concat(' ',tel_4_alterno) as 'tel 4 alterno',tel_4_alterno in (select c_tele from marcados) as tel_4_alterno_marcado,
concat(' ',tel_1_laboral) as 'tel 1 laboral',tel_1_laboral in (select c_tele from marcados) as tel_1_laboral_marcado,
concat(' ',tel_2_laboral) as 'tel 2 laboral',tel_2_laboral in (select c_tele from marcados) as tel_2_laboral_marcado,
concat(' ',tel_1_ref_1) as 'tel 1 ref 1',tel_1_ref_1 in (select c_tele from marcados) as tel_1_ref_1_marcado,
concat(' ',tel_1_ref_2) as 'tel 1 ref 2',tel_1_ref_2 in (select c_tele from marcados) as tel_1_ref_2_marcado,
concat(' ',tel_1_ref_3) as 'tel 1 ref 3',tel_1_ref_3 in (select c_tele from marcados) as tel_1_ref_3_marcado,
concat(' ',tel_1_ref_4) as 'tel 1 ref 4',tel_1_ref_4 in (select c_tele from marcados) as tel_1_ref_4_marcado
from resumen
where status_de_credito not regexp '-'
order by cliente,numero_de_cuenta";

    /**
     *
     * @var string
     */
    private $contactosReportQuery = "select cliente,nombre_deudor,concat(' ',numero_de_cuenta) as 'numero_de_cuenta',
concat(' ',tel_1) as 'tel 1',tel_1 in (select c_tele from contactados) as tel_1_contacto,
concat(' ',tel_2) as 'tel 2',tel_2 in (select c_tele from contactados) as tel_2_contacto,
concat(' ',tel_3) as 'tel 3',tel_3 in (select c_tele from contactados) as tel_3_contacto,
concat(' ',tel_4) as 'tel 4',tel_4 in (select c_tele from contactados) as tel_4_contacto,
concat(' ',tel_1_alterno) as 'tel 1 alterno',tel_1_alterno in (select c_tele from contactados) as tel_1_alterno_contacto,
concat(' ',tel_2_alterno) as 'tel 2 alterno',tel_2_alterno in (select c_tele from contactados) as tel_2_alterno_contacto,
concat(' ',tel_3_alterno) as 'tel 3 alterno',tel_3_alterno in (select c_tele from contactados) as tel_3_alterno_contacto,
concat(' ',tel_4_alterno) as 'tel 4 alterno',tel_4_alterno in (select c_tele from contactados) as tel_4_alterno_contacto,
concat(' ',tel_1_laboral) as 'tel 1 laboral',tel_1_laboral in (select c_tele from contactados) as tel_1_laboral_contacto,
concat(' ',tel_2_laboral) as 'tel 2 laboral',tel_2_laboral in (select c_tele from contactados) as tel_2_laboral_contacto,
concat(' ',tel_1_ref_1) as 'tel 1 ref 1',tel_1_ref_1 in (select c_tele from contactados) as tel_1_ref_1_contacto,
concat(' ',tel_1_ref_2) as 'tel 1 ref 2',tel_1_ref_2 in (select c_tele from contactados) as tel_1_ref_2_contacto,
concat(' ',tel_1_ref_3) as 'tel 1 ref 3',tel_1_ref_3 in (select c_tele from contactados) as tel_1_ref_3_contacto,
concat(' ',tel_1_ref_4) as 'tel 1 ref 4',tel_1_ref_4 in (select c_tele from contactados) as tel_1_ref_4_contacto
from resumen
where status_de_credito not regexp '-'";

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * 
     * @param array $result
     */
    public function outputDocument($result) {
        if (!empty($result)) {
            $filename = "Query_de_telefonos_" . date('ymd') . ".xlsx";
            $output = array();
            $output[] = array_keys($result[0]);
            foreach ($result as $row) {
                $output[] = $row;
            }
            $writer = WriterFactory::create(Type::XLSX);
            $writer->openToBrowser($filename); // stream data directly to the browser
            $writer->addRows($output); // add multiple rows at a time
            $writer->close();
        }
    }

    /**
     * 
     * @param string $fecha1
     * @param string $fecha2
     */
    public function createMarcados($fecha1, $fecha2) {
        $querycreate = "CREATE TEMPORARY TABLE marcados
SELECT distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not regexp '-'
and c_msge is null
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between :fecha1 and :fecha2
order by c_tele";
        $stf = $this->pdo->prepare($querycreate);
        $stf->bindParam(':fecha1', $fecha1);
        $stf->bindParam(':fecha2', $fecha2);
        $stf->execute();
    }

    /**
     * 
     * @param string $fecha1
     * @param string $fecha2
     */
    public function createContactos($fecha1, $fecha2) {
        $querycreate = "CREATE TEMPORARY TABLE contactos
SELECT c_tele FROM historia LIMIT 0";
        $this->pdo->query($querycreate);
        $queryfill = "insert into contactados select distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not like '%ivo'
and c_msge is null
and queue not in ('sin gestion','sin contactos','ilocalizables')
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between :fecha1 and :fecha2
order by c_tele";
        $stf = $this->pdo->prepare($queryfill);
        $stf->bindParam(':fecha1', $fecha1);
        $stf->bindParam(':fecha2', $fecha2);
        $stf->execute();
    }

    /**
     * 
     * @return array
     */
    public function getMercadosReport() {
        try {
            $statement = $this->pdo->prepare($this->mercadosReportQuery);
            $statement->execute();
        } catch (\PDOException $exc) {
            die($exc->getTraceAsString());
        }
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getContactosReport() {
        $statement = $this->pdo->query($this->contactosReportQuery);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
