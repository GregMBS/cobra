<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Query\Builder;

/**
 * Description of CallClass
 *
 * @author gmbs
 */
class HistoryClass extends BaseClass {

    /**
     * Unsafely fill c_cont and c_cvba where they are missing.
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
     * Unsafely obtain id from account number.
     * Behavior undefined when there is the inevitable conflict in account numbers.
     *
     * @param string $accountNumber
     * @return int
     */
    private function getId($accountNumber) {
        /** @var Builder $rc */
        $rc = new Resumen();
        $query = $rc->where('numero_de_cuenta', '=', $accountNumber);
        $debtor = $query->first();
        $id = $debtor->id_cuenta;
        return $id;
    }

    /**
     * This is actually the SAFEST part of the process, believe it or not.
     *
     * @param array $calls
     * @return bool
     */
    private function unsafeInsert(array $calls) {
        /** @var Builder $hc */
        $hc = new Historia();
        $test = $hc->insert($calls);
        return $test;
    }

    public function insertCalls(array $calls) {
        $ok = $this->unsafeInsert($calls);
        if ($ok) {
            $id = $this->getId($calls['CUENTA']);
            $this->fillGaps();
            $this->addNewTel($id, $calls['C_NTEL']);
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
     * @param int $id
     * @param string $tel
     * @return array
     */
    private function addNewTel(int $id, $tel) {
        $telClean = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
        $telArray = $this->getCurrentTels($id);
        $query = <<<SQL
UPDATE resumen 
        SET tel_4_verif = :tel3,
        tel_3_verif = :tel2,
        tel_2_verif = :tel1,
        tel_1_verif = :tel 
        WHERE id_cuenta = :C_CONT
SQL;
        $newTels = [$telClean, $telArray['tel_1_verif'], $telArray['tel_2_verif'], $telArray['tel_3_verif']];
        $stn = $this->pdo->prepare($query);
        $stn->bindValue(':tel3', $newTels[3]);
        $stn->bindValue(':tel2', $newTels[2]);
        $stn->bindValue(':tel1', $newTels[1]);
        $stn->bindValue(':tel', $newTels[0]);
        $stn->bindValue(':C_CONT', $id, \PDO::PARAM_INT);
        $stn->execute();
        $telCheck = $this->getCurrentTels($id);
        $diff = array_diff($newTels, $telCheck);
        return $diff;
    }

}
