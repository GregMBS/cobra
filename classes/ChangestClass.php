<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

use PDOStatement;

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
            $clientStr = " and :cliente<>'AA'";
        } else {
            if (strlen($CLIENTE) > 1) {
                $clientStr = " and cliente=:cliente";
            } else {
                $clientStr = " and :cliente<>'AA'";
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
                $querymain = $this->reporthead . " where id_cuenta<0 and :find=:find" . $clientStr;
                break;
        }

        $stm = $this->pdo->prepare($querymain);
        $stm->bindParam(':find', $find);
        $stm->bindParam(':cliente', $CLIENTE);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @return false|PDOStatement
     */
    public function listClientes() {
        $querycl = "SELECT DISTINCT cliente FROM resumen ORDER BY cliente LIMIT 1000";
        return $this->pdo->query($querycl);
    }

}
