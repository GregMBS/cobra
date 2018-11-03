<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;


/**
 * Description of TelsClass
 *
 * @author gmbs
 */
class TelsClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $queryCalled = 'select cliente,nombre_deudor,concat(" ",numero_de_cuenta) as "numero_de_cuenta",
concat(" ",tel_1) as "tel 1",tel_1 in (select c_tele from marcados) as tel_1_marcado,
concat(" ",tel_2) as "tel 2",tel_2 in (select c_tele from marcados) as tel_2_marcado,
concat(" ",tel_3) as "tel 3",tel_3 in (select c_tele from marcados) as tel_3_marcado,
concat(" ",tel_4) as "tel 4",tel_4 in (select c_tele from marcados) as tel_4_marcado,
concat(" ",tel_1_alterno) as "tel 1 alterno",tel_1_alterno in (select c_tele from marcados) as tel_1_alterno_marcado,
concat(" ",tel_2_alterno) as "tel 2 alterno",tel_2_alterno in (select c_tele from marcados) as tel_2_alterno_marcado,
concat(" ",tel_3_alterno) as "tel 3 alterno",tel_3_alterno in (select c_tele from marcados) as tel_3_alterno_marcado,
concat(" ",tel_4_alterno) as "tel 4 alterno",tel_4_alterno in (select c_tele from marcados) as tel_4_alterno_marcado,
concat(" ",tel_1_laboral) as "tel 1 laboral",tel_1_laboral in (select c_tele from marcados) as tel_1_laboral_marcado,
concat(" ",tel_2_laboral) as "tel 2 laboral",tel_2_laboral in (select c_tele from marcados) as tel_2_laboral_marcado
from resumen
where status_de_credito not like "%ivo"
order by cliente,numero_de_cuenta';

    /**
     *
     * @var string
     */
    private $queryContacted = 'select cliente,nombre_deudor,concat(" ",numero_de_cuenta) as "numero_de_cuenta",
concat(" ",tel_1) as "tel 1",tel_1 in (select c_tele from contactados) as tel_1_contacto,
concat(" ",tel_2) as "tel 2",tel_2 in (select c_tele from contactados) as tel_2_contacto,
concat(" ",tel_3) as "tel 3",tel_3 in (select c_tele from contactados) as tel_3_contacto,
concat(" ",tel_4) as "tel 4",tel_4 in (select c_tele from contactados) as tel_4_contacto,
concat(" ",tel_1_alterno) as "tel 1 alterno",tel_1_alterno in (select c_tele from contactados) as tel_1_alterno_contacto,
concat(" ",tel_2_alterno) as "tel 2 alterno",tel_2_alterno in (select c_tele from contactados) as tel_2_alterno_contacto,
concat(" ",tel_3_alterno) as "tel 3 alterno",tel_3_alterno in (select c_tele from contactados) as tel_3_alterno_contacto,
concat(" ",tel_4_alterno) as "tel 4 alterno",tel_4_alterno in (select c_tele from contactados) as tel_4_alterno_contacto,
concat(" ",tel_1_laboral) as "tel 1 laboral",tel_1_laboral in (select c_tele from contactados) as tel_1_laboral_contacto,
concat(" ",tel_2_laboral) as "tel 2 laboral",tel_2_laboral in (select c_tele from contactados) as tel_2_laboral_contacto
from resumen
where status_de_credito not regexp "-"';

    /**
     * 
     * @param string $date1
     * @param string $date2
     */
    public function createCalled($date1, $date2) {
        $queryCreate = "CREATE TEMPORARY TABLE called
SELECT c_tele FROM historia LIMIT 0";
        $this->pdo->query($queryCreate);
        $queryFill = "insert into called select distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not regexp '-'
and c_msge is null
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between :fecha1 and :fecha2
order by c_tele";
        $stf = $this->pdo->prepare($queryFill);
        $stf->bindValue(':fecha1', $date1);
        $stf->bindValue(':fecha2', $date2);
        $stf->execute();
    }

    /**
     * 
     * @param string $date1
     * @param string $date2
     */
    public function createContacted($date1, $date2) {
        $queryCreate = "CREATE TEMPORARY TABLE contacted
SELECT c_tele FROM historia LIMIT 0";
        $this->pdo->query($queryCreate);
        $queryFill = "insert into contacted select distinct c_tele
from historia,resumen,dictamenes
where c_cont=id_cuenta and dictamen=c_cvst
and status_de_credito not like '%ivo'
and c_msge is null
and queue not in ('sin gestion','sin contactos','ilocalizables')
and c_tele REGEXP '^-?[0-9]+$' and c_tele+1>1
and d_fech between :fecha1 and :fecha2
order by c_tele";
        $stf = $this->pdo->prepare($queryFill);
        $stf->bindValue(':fecha1', $date1);
        $stf->bindValue(':fecha2', $date2);
        $stf->execute();
    }

    /**
     * 
     * @return array
     */
    public function getCalledReport() {
        $statement = $this->pdo->query($this->queryCalled);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getContactedReport() {
        $statement = $this->pdo->query($this->queryContacted);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

}
