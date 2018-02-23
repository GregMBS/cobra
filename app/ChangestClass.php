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
     * @var string 
     */
    private $reporthead = "SELECT SQL_NO_CACHE numero_de_cuenta,nombre_deudor,cliente,
id_cuenta,status_de_credito,status_aarsa from resumen";

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
     * @param string $CLIENTE
     * @return string
     */
    private function getClientString($CLIENTE) {
        $clientStr = " and :cliente<>'AA'";
        if (!empty($CLIENTE)) {
            if (strlen($CLIENTE) > 1) {
                $clientStr = " and cliente=:cliente";
            } 
        }
        return $clientStr;
    }

    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $CLIENTE
     * @return array
     */
    public function getReport($field, $find, $CLIENTE) {
        $clientStr = $this->getClientString($CLIENTE);
        switch ($field) {
            case 'nombre_deudor':
                $querymain = $this->reporthead . " where nombre_deudor regexp :find" . $clientStr;
                break;

            case 'id_cuenta':
                $querymain = $this->reporthead . " where id_cuenta = :find" . $clientStr;
                break;

            case 'numero_de_cuenta':
                $querymain = $this->reporthead . " where numero_de_cuenta = :find order by numero_de_cuenta" . $clientStr;
                break;

            default:
                $find = 0;
                $CLIENTE = '';
                $querymain = $this->reporthead . " where id_cuenta<0 and :find<>'QQ'" . $clientStr;
                break;
        }

        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':find', $find);
        $stm->bindParam(':cliente', $CLIENTE);
        try {
            $stm->execute();
        } catch (\PDOException $e) {
            dd($stm,$e);
        }
        
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * 
     * @return string[]
     */
    public function listClientes() {
        $query = "SELECT DISTINCT cliente FROM resumen ORDER BY cliente LIMIT 1000";
        $stc = $this->pdo->prepare($query);
        $stc->execute();
        $resultcl = $stc->fetchColumn(0);
        return $resultcl;
    }

}
