<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of ChangestClass
 *
 * @author gmbs
 */
class ChangestClass extends BaseClass {

    /**
     *
     * @param bool $inactivo
     * @param int $C_CONT
     * @return bool
     */
    public function updateResumen($inactivo, $C_CONT) {
        $tags = $this->getTags($C_CONT, $inactivo);
        $query = "UPDATE resumen
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':tags', $tags);
        $stu->bindValue(':C_CONT', $C_CONT);
        $stu->execute();
        $queryCheck = "SELECT COUNT(1) as ct FROM resumen 
WHERE status_de_credito=:tags
AND id_cuenta=:C_CONT";
        $stc = $this->pdo->prepare($queryCheck);
        $stc->bindValue(':tags', $tags);
        $stc->bindValue(':C_CONT', $C_CONT);
        $stc->execute();
        $count = $stc->fetch(\PDO::FETCH_ASSOC);
        return ($count['ct'] === 1);
    }
    
    /**
     * 
     * @param int $C_CONT
     * @param bool $inactivo
     * @return string
     */
    private function getTags($C_CONT, $inactivo) {
        $query = "SELECT status_de_credito FROM resumen where id_cuenta = :id_cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':id_cuenta', $C_CONT, \PDO::PARAM_INT);
        $stq->execute();
        $cuenta = $stq->fetch(\PDO::FETCH_ASSOC);
        $sdc = $cuenta['status_de_credito'];
        $tagArray      = explode('-', $sdc);
        $trimmed       = trim($tagArray[0]);
        $TAGS = $trimmed;
        if ($inactivo) {
            $TAGS = $trimmed.'-inactivo';
        }
        return $TAGS;
    }

}
