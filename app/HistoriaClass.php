<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of GestionClass
 *
 * @author gmbs
 */
class HistoriaClass extends BaseClass {

    /**
     * Unsafely fill c_cont and c_cvba in historias where they are missing.
     * Behavior undefined when there is the inevitable conflict in numero_de_cuenta.
     */
    private function fillGaps() {
        $query = "update resumen,historia
set c_cont=id_cuenta,c_cvba=cliente
where cuenta=numero_de_cuenta
and c_cvba is null";
        $this->pdo->query($query);
    }

    /**
     * Unsafely obtain id_cuenta from numero_de_cuenta.
     * Behavior undefined when there is the inevitable conflict in numero_de_cuenta.
     *
     * @param string $cuenta
     * @return int
     */
    private function getIdCuenta($cuenta) {
        /** @var Builder $rc */
        $rc = new Resumen();
        $query = $rc->where('numero_de_cuenta', '=', $cuenta);
        $resumen = $query->first();
        $id_cuenta = $resumen->id_cuenta;
        return $id_cuenta;
    }

    /**
     * This is actually the SAFEST part of the process, believe it or not.
     *
     * @param array $gestiones
     * @return bool
     */
    private function unsafeInsert(array $gestiones) {
        /** @var Builder $hc */
        $hc = new Historia();
        $test = $hc->insert($gestiones);
        return $test;
    }

    public function insertGestiones($gestiones) {
        $ok = $this->unsafeInsert($gestiones);
        if ($ok) {
            $id_cuenta = $this->getIdCuenta($gestiones['CUENTA']);
            $this->fillGaps();
            $this->addNewTel($id_cuenta, $gestiones['C_NTEL']);
        }
    }

    /**
     * @param int $C_CONT
     * @return mixed | array
     */
    private function getCurrentTels($C_CONT)
    {
        $query = "SELECT tel_1_verif, tel_2_verif, tel_3_verif, tel_4_verif 
        FROM resumen 
        WHERE id_cuenta = :C_CONT";
        $sts = $this->pdo->prepare($query);
        $sts->bindValue(':C_CONT',$C_CONT, \PDO::PARAM_INT);
        $sts->execute();
        $result = $sts->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param int $C_CONT
     * @param string $tele
     * @return array
     */
    private function addNewTel($C_CONT, $tele) {
        $tel = filter_var($tele, FILTER_SANITIZE_NUMBER_INT);
        $telArray = $this->getCurrentTels($C_CONT);
        $query = <<<SQL
UPDATE resumen 
        SET tel_4_verif = :tel3,
        tel_3_verif = :tel2,
        tel_2_verif = :tel1,
        tel_1_verif = :tel 
        WHERE id_cuenta = :C_CONT
SQL;
        $newTels = [$tel, $telArray['tel_1_verif'], $telArray['tel_2_verif'], $telArray['tel_3_verif']];
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':tel3', $newTels[3]);
        $stn->bindValue(':tel2', $newTels[2]);
        $stn->bindValue(':tel1', $newTels[1]);
        $stn->bindValue(':tel', $newTels[0]);
        $stn->bindValue(':C_CONT', $C_CONT, \PDO::PARAM_INT);
        $stn->execute();
        $telCheck = $this->getCurrentTels($C_CONT);
        $diff = array_diff($newTels, $telCheck);
        return $diff;
    }

}
