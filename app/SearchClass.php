<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of SearchClass
 *
 * @author gmbs
 */
class SearchClass extends BaseClass
{

    /**
     *
     * @var string
     */
    private $queryHead = <<<SQL
SELECT SQL_NO_CACHE numero_de_cuenta, nombre_deudor, cliente, id_cuenta, status_de_credito from resumen 
SQL;


    /**
     *
     * @var string
     */
    private $telString = "WHERE (concat_ws(',', tel_1, tel_2, tel_3, tel_4) regexp :find)";

    /**
     *
     * @var string
     */
    private $telString1 = " JOIN referencias USING (id_cuenta)";

    /**
     *
     * @var string
     */
    private $telString2 = " WHERE (concat_ws(',', referencias.tel_1, referencias.tel_2) regexp :find)";


    /**
     *
     * @var string
     */
    /*
    private $robotstring = "SELECT SQL_NO_CACHE
			distinct numero_de_cuenta,nombre_deudor, cliente,
			id_cuenta, status_de_credito
			FROM resumen, historia
			WHERE c_tele REGEXP :find and c_cont=id_cuenta";
    */
    /**
     *
     * @param string $field
     * @return string
     */
    private function searchField($field)
    {
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
                $output = $this->telString;
                break;
            case 'REFS':
                $output = $this->telString1 . $this->telString2;
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
     * @param string $client
     * @return array
     */
    public function searchAccounts(string $field, string $find, string $client)
    {
        $cliFlag = 0;
        $query = $this->queryHead . $this->searchField($field);

        if ((isset($query)) && (strlen($client) > 1)) {
            $query = $query . " and cliente = :client ";
            $cliFlag = 1;
        }
        $query .= " LIMIT 10000";
        $stm = $this->pdo->prepare($query);
        $stm->bindValue(':find', $find);
        if ($cliFlag === 1) {
            $stm->bindValue(':client', $client);
        }
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     *
     * @return array
     */
    public function listClients()
    {
        $query = "SELECT cliente FROM clientes";
        $stc = $this->pdo->prepare($query);
        $stc->execute();
        $result = $stc->fetchAll(\PDO::FETCH_ASSOC);
        $clients = array_column($result, 'cliente');
        return $clients;
    }

}
