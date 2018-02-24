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
     * @param string $TAGS
     * @param int $C_CONT
     */
    public function updateResumen($TAGS, $C_CONT) {
        $queryup = "UPDATE resumen
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
        $stu = $this->pdo->prepare($queryup);
        $stu->bindParam(':tags', $TAGS);
        $stu->bindParam(':C_CONT', $C_CONT);
        $stu->execute();
    }
    
    /**
     * 
     * @param string $sdc
     * @param bool $inactivo
     * @return string
     */
    public function getTags($sdc,$inactivo) {
        $tagArray      = explode('-', $sdc);
        $trimmed       = trim($tagArray[0]);
        if ($inactivo) {
            $TAGS = $trimmed.'-inactivo';
        } else {
            $TAGS = $trimmed;
        }
        return $TAGS;
    }

    /**
     * 
     * @param string $TAGS
     * @param int $C_CONT
     */
    public function updateRlook($TAGS, $C_CONT) {
        $queryup = "UPDATE rlook
SET status_de_credito=:tags
WHERE id_cuenta=:C_CONT";
        $stu = $this->pdo->prepare($queryup);
        $stu->bindParam(':tags', $TAGS);
        $stu->bindParam(':C_CONT', $C_CONT);
        $stu->execute();
    }

    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $CLIENTE
     * @return array
     */
    public function getReport($field, $find, $CLIENTE) {
        $bc = new BuscarClass();
        $result = $bc->searchAccounts($field, $find, $CLIENTE);
        return $result;
    }

    /**
     * 
     * @return string[]
     */
    public function listClientes() {
        $bc = new BuscarClass();
        $resultcl = $bc->listClients();
        return $resultcl;
    }

}
