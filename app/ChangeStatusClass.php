<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of ChangeStatusClass
 *
 * @author gmbs
 */
class ChangeStatusClass extends BaseClass {

    /**
     *
     * @param bool $inactive
     * @param int $id
     * @return bool
     */
    public function updateDebtor($inactive, $id) {
        $tags = $this->getTags($id, $inactive);
        $query = "UPDATE resumen
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
        $stu = $this->pdo->prepare($query);
        $stu->bindValue(':tags', $tags);
        $stu->bindValue(':C_CONT', $id);
        $stu->execute();
        $queryCheck = "SELECT COUNT(1) as ct FROM resumen 
WHERE status_de_credito=:tags
AND id_cuenta=:C_CONT";
        $stc = $this->pdo->prepare($queryCheck);
        $stc->bindValue(':tags', $tags);
        $stc->bindValue(':C_CONT', $id);
        $stc->execute();
        $count = $stc->fetch(\PDO::FETCH_ASSOC);
        return ($count['ct'] === 1);
    }
    
    /**
     * 
     * @param int $id
     * @param bool $inactive
     * @return string
     */
    private function getTags($id, $inactive) {
        $query = "SELECT status_de_credito FROM resumen where id_cuenta = :id_cuenta";
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':id_cuenta', $id, \PDO::PARAM_INT);
        $stq->execute();
        $debtor = $stq->fetch(\PDO::FETCH_ASSOC);
        $sdc = $debtor['status_de_credito'];
        $tagArray      = explode('-', $sdc);
        $trimmed       = trim($tagArray[0]);
        $TAGS = $trimmed;
        if ($inactive) {
            $TAGS = $trimmed.'-inactivo';
        }
        return $TAGS;
    }

}
