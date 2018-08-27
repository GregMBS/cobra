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
    private $queryhead = <<<SQL
SELECT SQL_NO_CACHE numero_de_cuenta, nombre_deudor, cliente, id_cuenta, status_de_credito from resumen 
SQL;


    /**
     *
     * @var string
     */
    private $telstringNorm = <<<SQL
WHERE (concat_ws('', tel_1, tel_2, tel_3, tel_4, tel_1_alterno, tel_2_alterno, tel_3_alterno, tel_4_alterno, tel_1_laboral, tel_2_laboral, tel_1_verif, tel_2_verif, tel_3_verif, tel_4_verif) regexp :find) 
SQL;

    /**
     *
     * @var string
     */
    private $telstringRef1 = <<<SQL
 OR (id_cuenta IN (SELECT id_cuenta FROM referencias WHERE tel_1 REGEXP :find)) 
SQL;

    /**
     *
     * @var string
     */
    private $telstringRef2 = <<<SQL
 OR (id_cuenta IN (SELECT id_cuenta FROM referencias WHERE tel_2 REGEXP :find))
SQL;


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
            case 'TELS':
                $output = $this->telstringNorm . $this->telstringRef1 . $this->telstringRef2;
                break;
            default:
                $output = "where id_cuenta = :find order by id_cuenta ";
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
        $stm = $this->pdo->prepare($querymain);
        try {
            $stm->bindParam(':find', $find);
            if ($cliFlag == 1) {
                $stm->bindParam(':cliente', $CLIENTE);
            }
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            dd($e->getMessage(), $stm);
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
        $result = $stc->fetchAll(\PDO::FETCH_ASSOC);
        $clients = array_column($result, 'cliente');
        return $clients;
    }

}
