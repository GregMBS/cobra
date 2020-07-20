<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDO;

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
        if (empty($CLIENTE)) {
            return " and :cliente<>'AA'";
        } else {
            if (strlen($CLIENTE) > 1) {
                return " and cliente=:cliente";
            } else {
                return " and :cliente<>'AA'";
            }
        }
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
                $querymain = $this->reporthead . " where id_cuenta<0 and :find=:find" . $clientStr;
                break;
        }

        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':find', $find);
        $stm->bindParam(':cliente', $CLIENTE);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @return array
     */
    public function listClientes() {
        $query = "SELECT DISTINCT cliente FROM resumen ORDER BY cliente LIMIT 1000";
        $stm = $this->pdo->query($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

}
