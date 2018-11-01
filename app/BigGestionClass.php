<?php

namespace App;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Database queries for 'big' reports
 *
 * @author gmbs
 *
 */
class BigGestionClass extends BaseClass
{

    /**
     *
     * @param string $direction
     * @return string
     */
    private function cleanDirection($direction)
    {
        $haystack = array('asc', 'ASC', 'desc', 'DESC');
        if (!in_array($direction, $haystack)) {
            $direction = 'ASC';
        }
        return $direction;
    }

    /**
     *
     * @param string $queryFront
     * @param string $queryBack
     * @param BigDataClass $bdc
     * @return array
     */
    private function getHistoria($queryFront, $queryBack, BigDataClass $bdc)
    {
        $gestorstr = $bdc->getGestorString();
        $clientestr = $bdc->getClienteString();
        $userTypeString = $bdc->getTipoString();
        $query = $queryFront . $gestorstr . $clientestr . $userTypeString . $queryBack;
        $stq = $this->pdo->prepare($query);
        $stq->bindValue(':fecha1', $bdc->fecha1);
        $stq->bindValue(':fecha2', $bdc->fecha2);
        if ($bdc->hasGestor()) {
            $stq->bindValue(':gestor', $bdc->gestor);
        }
        if ($bdc->hasCliente()) {
            $stq->bindValue(':cliente', $bdc->cliente);
        }
        $stq->execute();
        $data = $stq->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     *
     * @param BigDataClass $bdc
     * @return array
     */
    public function getAllGestiones(BigDataClass $bdc)
    {
        $queryFront = "SELECT numero_de_cuenta,nombre_deudor,
            resumen.cliente,status_de_credito,saldo_total,queue,h1.*
    from resumen join historia h1 on c_cont=id_cuenta
join dictamenes on status_aarsa=dictamen
where d_fech between :fecha1 and :fecha2
";

        $queryBack = "and status_de_credito not regexp '-'
ORDER BY d_fech,c_hrin";
        $data = $this->getHistoria($queryFront, $queryBack, $bdc);
        return $data;
    }

    /**
     *
     * @param string $direction
     * @return array
     */
    public function getGestionDates($direction)
    {
        $dir = $this->cleanDirection($direction);
        $start = "SELECT distinct d_fech FROM historia
        WHERE d_fech>LAST_DAY(CURDATE()-INTERVAL 1 YEAR)
        ORDER BY d_fech ";
        $end = " LIMIT 360";
        $query = $start . $dir . $end;
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_BOTH);
        return $result;
    }

    /**
     *
     * @return string[]
     */
    public function getGestionClientes()
    {
        $query = "SELECT distinct c_cvba FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        limit 10
	";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $clientes = array_column($result, 'c_cvba');
        return $clientes;
    }

    /**
     *
     * @return string[]
     */
    public function getGestionGestores()
    {
        $query = "SELECT c_cvge, count(1) FROM historia
        where d_fech>last_day(curdate()-interval 2 month)
        group by c_cvge";
        $stq = $this->pdo->query($query);
        $result = $stq->fetchAll(\PDO::FETCH_ASSOC);
        $gestores = array_column($result, 'c_cvge');
        return $gestores;
    }

}
