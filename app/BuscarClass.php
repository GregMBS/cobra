<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of BuscarClass
 *
 * @author gmbs
 */
class BuscarClass extends BaseClass {

    /**
     *
     * @var string
     */
    private $queryhead = "SELECT SQL_NO_CACHE numero_de_cuenta, nombre_deudor,
cliente, id_cuenta, status_de_credito from resumen ";

    /**
     *
     * @var string
     */
    private $refstring = "WHERE
(id_cuenta IN (
    SELECT id_cuenta FROM referencias
    WHERE nombre REGEXP :find
    )
)";

    /**
     *
     * @var string
     */
    private $telstring = "WHERE
(tel_1 regexp :find or
tel_2 regexp :find or
tel_3 regexp :find or
tel_4 regexp :find or
tel_1_alterno regexp :find or
tel_2_alterno regexp :find or
tel_3_alterno regexp :find or
tel_4_alterno regexp :find or
tel_1_laboral regexp :find or
tel_2_laboral regexp :find or
tel_1_verif regexp :find or
tel_2_verif regexp :find or
tel_3_verif regexp :find or
tel_4_verif regexp :find or
telefonos_marcados regexp :find) or 
(id_cuenta IN (
    SELECT id_cuenta FROM referencias
    WHERE tel_1 REGEXP :find
    )
) OR 
(id_cuenta IN (
    SELECT id_cuenta FROM referencias
    WHERE tel_2 REGEXP :find
    )
)";

    /**
     *
     * @var string
     */
    private $robotstring = "SELECT SQL_NO_CACHE
			distinct numero_de_cuenta,nombre_deudor, cliente,
			id_cuenta, status_de_credito
			FROM resumen, historia
			WHERE c_tele REGEXP :find and c_cont=id_cuenta";

    /**
     * 
     * @param string $field
     * @return string
     */
    private function searchField($field) {
        switch ($field) {
            case 'id_cuenta':
                $output = "where id_cuenta = :find order by id_cuenta ";
                break;
            case 'nombre_deudor':
                $output = "where nombre_deudor regexp :find ";
                break;
            case 'numero_de_cuenta':
                $output = "where numero_de_cuenta regexp :find ";
                break;
            case 'numero_de_credito':
                $output = "where numero_de_credito regexp :find ";
                break;
            case 'domicilio_deudor':
                $output = "where domicilio_deudor regexp :find ";
                break;
            case 'REFS':
                $output = $this->refstring;
                break;
            case 'TELS':
                $output = $this->telstring;
                break;
            default:
                $output = '';
                break;
        }
        return $output;
    }

    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $CLIENTE
     * @return array
     */
    public function searchAccounts($field, $find, $CLIENTE) {
        if ($field == 'ROBOT') {
            $querymain = $this->robotstring;
        } else {
            $querymain = $this->queryhead . $this->searchField($field);
        }
        $cliFlag = 0;
        if ((isset($querymain)) && (strlen($CLIENTE) > 1)) {
            $querymain = $querymain . " and cliente = :cliente ";
            $cliFlag = 1;
        }
        $querymain .= " LIMIT 10000";
        try {
            $stm = $this->pdo->prepare($querymain);
            $stm->bindParam(':find', $find);
            if ($cliFlag == 1) {
                $stm->bindParam(':cliente', $CLIENTE);
            }
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $result = array();
        }

        return $result;
    }

    /**
     * 
     * @return array
     */
    public function listClients() {
        $query = "SELECT cliente FROM clientes";
        $stc = $this->pdo->prepare($query);
        $stc->execute();
        $result = $stc->fetchColumn(0);
        return $result;
    }

}
